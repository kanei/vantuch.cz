<?php

if(!class_exists('KcSeoOutput')):

    class KcSeoOutput
    {
        function __construct()
        {
            add_action('wp_footer', array($this,'load_schema'), 1);
        }

        function load_schema(){
            global $KcSeoWPSchema, $post;
            $schemaModel = new KcSeoSchemaModel;
            $html = null;
            $settings = get_option($KcSeoWPSchema->options['settings']);
            if(is_home() || is_front_page()){
                $metaData = array();

                $metaData["@context"] = "http://schema.org/";
                $metaData["@type"] = "WebSite";

                if(!empty($settings['homeonly'])){
                    $author_url = (!empty($settings['siteurl']) ? $settings['siteurl'] : get_home_url());
                    $to_remove = array( 'http://', 'https://','www.' );
                    foreach ( $to_remove as $item ) {
                        $author_url = str_replace($item, '', $author_url); // to: www.example.com
                    }
                    $metaData["url"] = $author_url;
                    $metaData["name"] = !empty($settings['sitename']) ? $settings['sitename'] : null;
                    $metaData["alternateName"] = !empty($settings['siteaname']) ? $settings['siteaname'] : null;
                    $html .= $schemaModel->get_jsonEncode($metaData);
                }else{
                    $metaData["url"] = get_home_url();
                    $metaData["potentialAction"] = array(
                        "@type" => "SearchAction",
                        "target" => get_home_url() ."/?s={query}",
                        "query-input" => "required name=query"
                    );
                    $html .= $schemaModel->get_jsonEncode($metaData);
                }
            }
            $webMeta = array();
            $webMeta["@context"] = "http://schema.org";
            $siteType = !empty($settings['site_type']) ? esc_attr($settings['site_type']) : null;
            $webMeta["@type"] = $siteType;

            if(!empty($settings['additionalType'])){
                $aType = explode("\r\n", $settings['additionalType']);
                if(!empty($aType) && is_array($aType)){
                    if(count($aType) == 1){
                        $webMeta["additionalType"] = $aType[0];
                    }else if(count($aType) > 1){
                        $webMeta["additionalType"] = $aType;
                    }
                }
            }

            if($siteType == 'Person'){
                $webMeta["name"] = !empty($settings['person']['name']) ? esc_attr( $settings['person']['name']) : null;
                $webMeta["worksFor"] = !empty($settings['person']['worksFor']) ? esc_attr( $settings['person']['worksFor']) : null;
                $webMeta["jobTitle"] = !empty($settings['person']['jobTitle']) ? esc_attr($settings['person']['jobTitle']): null;
                $webMeta["image"] = !empty($settings['person']['image']) ? esc_attr( $settings['person']['image']) : null;
                $webMeta["description"] = !empty($settings['person']['description']) ? esc_attr( $settings['person']['description']) : null;
                $webMeta["birthDate"] = !empty($settings['person']['birthDate']) ? esc_attr( $settings['person']['birthDate']) : null;
            }else{
                $webMeta["name"] = !empty($settings['type_name']) ? esc_attr($settings['type_name']) : null;
                $webMeta["logo"] = !empty($settings['logo_url']) ? esc_attr( $settings['logo_url'] ) : null;
            }
            if($siteType != "Organization" && $siteType != "Person"){
                $webMeta["description"] = !empty($settings['business_info']['description']) ? esc_attr( $settings['business_info']['description'] ) : null;
                if(!empty($settings['business_info']['openingHours'])){
                    $aOhour = explode("\r\n", $settings['business_info']['openingHours']);
                    if(!empty($aOhour) && is_array($aOhour)){
                        if(count($aOhour) == 1){
                            $webMeta["openingHours"] = $aOhour[0];
                        }else if(count($aOhour) > 1){
                            $webMeta["openingHours"] = $aOhour;
                        }
                    }
                }
                $webMeta["geo"] = array(
                    "@type" => "GeoCoordinates",
                    "longitude" => !empty($settings['business_info']['longitude']) ? esc_attr( $settings['business_info']['longitude'] ) : null,
                    "latitude" => !empty($settings['business_info']['latitude']) ? esc_attr( $settings['business_info']['latitude'] ) : null
                );
            }

            $webMeta["url"] = !empty($settings['web_url']) ? esc_attr( $settings['web_url']) : get_home_url() ;
            if(!empty($settings['social']) && is_array($settings['social'])){
                $link = array();
                foreach ($settings['social'] as $socialD) {
                    if($socialD['link']){
                        $link[] =  $socialD['link'];
                    }
                }
                if(!empty($link)){
                    $webMeta["sameAs"] = $link;
                }
            }

            $webMeta["contactPoint"] = array(
                "@type" => "ContactPoint",
                "telephone" => !empty($settings['contact']['telephone']) ? esc_attr($settings['contact']['telephone']): null,
                "contactType" => !empty($settings['contact']['contactType']) ? esc_attr($settings['contact']['contactType']) : null,
                "contactOption" => !empty($settings['contact']['contactOption']) ? esc_attr($settings['contact']['contactOption']):null,
                "areaServed" => !empty($settings['area_served'] ) ? implode(',', !empty($settings['area_served']) ? $settings['area_served'] : array()) : null,
                "availableLanguage" => !empty($settings['availableLanguage']) ? @implode(',', !empty($settings['availableLanguage']) ? $settings['availableLanguage'] : array()) : null
            );
            $webMeta["address"] = array(
                "@type" => "PostalAddress",
                "addressCountry" => !empty($settings['address']['country']) ? esc_attr($settings['address']['country']) : null,
                "addressLocality" => !empty($settings['address']['locality']) ? esc_attr($settings['address']['locality']) : null,
                "addressRegion" => !empty($settings['address']['region']) ? esc_attr($settings['address']['region']) : null,
                "postalCode" => !empty($settings['address']['postalcode']) ? esc_attr($settings['address']['postalcode']) : null,
                "streetAddress" => !empty($settings['address']['street']) ? esc_attr($settings['address']['street']) : null
            );
            if($webMeta["@type"]) {
                $html .= $schemaModel->get_jsonEncode($webMeta);
            }

            if(is_single() || is_page()){

                foreach($schemaModel->schemaTypes() as $schemaID => $schema){
                    $schemaMetaId = $KcSeoWPSchema->KcSeoPrefix.$schemaID;
                    $getRawMeta = get_post_meta($post->ID, $schemaMetaId, true );
                    $metaData = array();
                    if(!empty($getRawMeta)) {
                        if ($KcSeoWPSchema->isValidBase64($getRawMeta)) {
                            $metaData = unserialize(base64_decode($getRawMeta));
                        } else {
                            $metaData = unserialize($getRawMeta);
                        }
                    }
                    $metaData = (!empty($metaData) ? $metaData : array());
                    $firstItem = null;
                    if(!empty($metaData) && is_array($metaData)){
                        $firstItem = current($metaData);
                    }

                    if(!empty($metaData) && is_array($metaData) && $firstItem){
                        $html .= $schemaModel->schemaOutput($schemaID, $metaData);
                    }
                }
            }
            echo $html;
        }
    }
endif;