<?php

if(!class_exists('KcSeoSchemaModel')):
    class KcSeoSchemaModel
    {
        function __construct()
        {

        }

        function schemaOutput($schemaID, $metaData){
            $html = null;

            if($schemaID){
                switch($schemaID){
                    case "article":
                        $article = array();
                        $article["@context"] = "http://schema.org";
                        $article["@type"] = "Article";
                        if(!empty($metaData['headline'])){
                            $article["headline"] = esc_attr($metaData['headline']);
                        }if(!empty($metaData['mainEntityOfPage'])){
                            $article["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id" => esc_attr($metaData["mainEntityOfPage"])
                            );
                        }if(!empty($metaData['author'])){
                            $article["author"] = esc_attr($metaData['author']);
                        }if(!empty($metaData['publisher'])){
                            if(!empty($metaData['publisherImage'])){
                                $img = $this->imgInfo($metaData['publisherImage']);
                                $plA = array(
                                    "@type" => "ImageObject",
                                    "url" => esc_attr($metaData['publisherImage']),
                                    "height" => intval($img['height']),
                                    "width" => intval($img['width']),
                                );
                            }else{
                                $plA = array();
                            }
                            $article["publisher"] = array(
                                "@type" => "Organization",
                                "name" => esc_attr($metaData['publisher']),
                                "logo" => $plA
                            );
                        }if(!empty($metaData['alternativeHeadline'])){
                            $article["alternativeHeadline"] = esc_attr($metaData['alternativeHeadline']);
                        }if(!empty($metaData['image'])){
                            $img = $this->imgInfo($metaData['image']);
                            $article["image"] = array(
                                "@type" => "ImageObject",
                                "url" => esc_attr($metaData['image']),
                                "height" => $img['height'],
                                "width" =>$img['width']
                            );
                        }if(!empty($metaData['datePublished'])){
                            $article["datePublished"] = esc_attr($metaData['datePublished']);
                        }if(!empty($metaData['dateModified'])){
                            $article["dateModified"] = esc_attr($metaData['dateModified']);
                        }if(!empty($metaData['description'])){
                            $article["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['articleBody'])){
                            $article["articleBody"] = esc_attr($metaData['articleBody']);
                        }
                        $html .= $this->get_jsonEncode($article);
                        break;

                    case "news_article":
                        $newsArticle = array();
                        $newsArticle["@context"] = "http://schema.org";
                        $newsArticle["@type"] = "NewsArticle";
                        if(!empty($metaData['headline'])){
                            $newsArticle["headline"] = esc_attr($metaData['headline']);
                        }if(!empty($metaData['mainEntityOfPage'])){
                            $newsArticle["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id" => esc_attr($metaData["mainEntityOfPage"])
                            );
                        }if(!empty($metaData['author'])){
                            $newsArticle["author"] = esc_attr($metaData['author']);
                        }if(!empty($metaData['image'])){
                            $img = $this->imgInfo($metaData['image']);
                            $newsArticle["image"] = array(
                                "@type" => "ImageObject",
                                "url" => esc_attr($metaData['image']),
                                "height" => $img['height'],
                                "width" =>$img['width']
                            );
                        }if(!empty($metaData['datePublished'])){
                            $newsArticle["datePublished"] = esc_attr($metaData['datePublished']);
                        }if(!empty($metaData['dateModified'])){
                            $newsArticle["dateModified"] = esc_attr($metaData['dateModified']);
                        }if(!empty($metaData['publisher'])){
                            if(!empty($metaData['publisherImage'])){
                                $img = $this->imgInfo($metaData['publisherImage']);
                                $plA = array(
                                    "@type" => "ImageObject",
                                    "url" => esc_attr($metaData['publisherImage']),
                                    "height" => intval($img['height']),
                                    "width" => intval($img['width']),
                                );
                            }else{
                                $plA = array();
                            }
                            $newsArticle["publisher"] = array(
                                "@type" => "Organization",
                                "name" => esc_attr($metaData['publisher']),
                                "logo" => $plA
                            );
                        }if(!empty($metaData['description'])){
                            $newsArticle["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['articleBody'])){
                            $newsArticle["articleBody"] = esc_attr($metaData['articleBody']);
                        }
                        $html .= $this->get_jsonEncode($newsArticle);
                        break;

                    case "blog_posting":
                        $blogPosting = array();
                        $blogPosting["@context"] = "http://schema.org";
                        $blogPosting["@type"] = "BlogPosting";
                        if(!empty($metaData['headline'])){
                            $blogPosting["headline"] = esc_attr($metaData['headline']);
                        }if(!empty($metaData['mainEntityOfPage'])){
                            $blogPosting["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id" => esc_attr($metaData["mainEntityOfPage"])
                            );
                        }if(!empty($metaData['author'])){
                            $blogPosting["author"] = esc_attr($metaData['author']);
                        }if(!empty($metaData['image'])){
                            $img = $this->imgInfo($metaData['image']);
                            $blogPosting["image"] = array(
                                "@type" => "ImageObject",
                                "url" => esc_attr($metaData['image']),
                                "height" => $img['height'],
                                "width" =>$img['width']
                            );
                        }if(!empty($metaData['datePublished'])){
                            $blogPosting["datePublished"] = esc_attr($metaData['datePublished']);
                        }if(!empty($metaData['dateModified'])){
                            $blogPosting["dateModified"] = esc_attr($metaData['dateModified']);
                        }if(!empty($metaData['publisher'])){
                            if($metaData['publisherImage']){
                                $img = $this->imgInfo($metaData['publisherImage']);
                                $plA = array(
                                    "@type" => "ImageObject",
                                    "url" => esc_attr($metaData['publisherImage']),
                                    "height" => intval($img['height']),
                                    "width" => intval($img['width']),
                                );
                            }else{
                                $plA = array();
                            }
                            $blogPosting["publisher"] = array(
                                "@type" => "Organization",
                                "name" => esc_attr($metaData['publisher']),
                                "logo" => $plA
                            );
                        }if(!empty($metaData['description'])){
                            $blogPosting["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['articleBody'])){
                            $blogPosting["articleBody"] = esc_attr($metaData['articleBody']);
                        }
                        $html .= $this->get_jsonEncode($blogPosting);
                        break;

                    case 'event':
                        $event = array();
                        $event["@context"] = "http://schema.org";
                        $event["@type"] = "Event";
                        if(!empty($metaData['name'])){
                            $event["name"] = esc_attr($metaData['name']);
                        }if(!empty($metaData['startDate'])){
                            $event["startDate"] = esc_attr($metaData['startDate']);
                        }if(!empty($metaData['locationName'])){
                            $event["location"] = array(
                                "@type" => "Place",
                                "name"  => esc_attr($metaData['locationName']),
                                "address" => esc_attr($metaData['locationAddress'])
                            );
                        }if(!empty($metaData['price'])){
                            $event["offers"] = array(
                                "@type" => "Offer",
                                "price" => esc_attr($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? esc_attr($metaData['priceCurrency']) : null,
                                "url" => !empty($metaData['url']) ? esc_attr($metaData['url']) : null
                            );
                        }
                        $html .= $this->get_jsonEncode($event);
                        break;

                    case 'product':
                        $product = array();
                        $product["@context"] = "http://schema.org";
                        $product["@type"] = "Product";
                        if (!empty($metaData['name'])) {
                            $product["name"] = esc_attr($metaData['name']);
                        }
                        if (!empty($metaData['image'])) {
                            $product["image"] = esc_attr($metaData['image']);
                        }
                        if (!empty($metaData['description'])) {
                            $product["description"] = esc_attr($metaData['description']);
                        }
                        if (!empty($metaData['brand'])) {
                            $product["brand"] = array(
                                "@type" => "Thing",
                                "name" => esc_attr($metaData['brand'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $product["aggregateRating"] = array(
                                "@type" => "AggregateRating",
                                "ratingValue" => !empty($metaData['ratingValue']) ? esc_attr($metaData['ratingValue']) : null,
                                "reviewCount" => !empty($metaData['reviewCount']) ? esc_attr($metaData['reviewCount']) : null
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $product["offers"] = array(
                                "@type" => "Offer",
                                "price" => esc_attr($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? esc_attr($metaData['priceCurrency']) : null,
                                "itemCondition" => !empty($metaData['itemCondition']) ? esc_attr($metaData['itemCondition']) : null,
                                "availability" => !empty($metaData['availability']) ? esc_attr($metaData['availability']) : null,
                                "url" => !empty($metaData['url']) ? esc_attr($metaData['url']) : null
                            );
                        }
                        $html .= $this->get_jsonEncode($product);
                        break;

                    case 'video':
                        $video = array();
                        $video["@context"] = "http://schema.org";
                        $video["@type"] = "VideoObject";
                        if(!empty($metaData['name'])){
                            $video["name"] = esc_attr($metaData['name']);
                        }if(!empty($metaData['description'])){
                            $video["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['description'])){
                            $video["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['thumbnailUrl'])){
                            $video["thumbnailUrl"] = esc_attr($metaData['thumbnailUrl']);
                        }if(!empty($metaData['uploadDate'])){
                            $video["uploadDate"] = esc_attr($metaData['uploadDate']);
                        }if(!empty($metaData['duration'])){
                            $video["duration"] = esc_attr($metaData['duration']);
                        }if(!empty($metaData['contentUrl'])){
                            $video["contentUrl"] = esc_attr($metaData['contentUrl']);
                        }if(!empty($metaData['interactionCount'])){
                            $video["interactionCount"] = esc_attr($metaData['interactionCount']);
                        }if(!empty($metaData['expires'])){
                            $video["expires"] = esc_attr($metaData['expires']);
                        }
                        $html .= $this->get_jsonEncode($video);
                        break;

                    case 'service':
                        $service = array();
                        $service["@context"] = "http://schema.org";
                        $service["@type"] = "Service";
                        if(!empty($metaData['name'])){
                            $service["name"] = esc_attr($metaData['name']);
                        }if(!empty($metaData['serviceType'])){
                            $service["serviceType"] = esc_attr($metaData['serviceType']);
                        }if(!empty($metaData['locationName'])){
                            $service["location"] = array(
                                "@type" => "Place",
                                "name"  => esc_attr($metaData['locationName']),
                                "address" => esc_attr($metaData['locationAddress'])
                            );
                        }if(!empty($metaData['award'])){
                            $service["award"] = esc_attr($metaData['award']);
                        }if(!empty($metaData['category'])){
                            $service["category"] = esc_attr($metaData['category']);
                        }if(!empty($metaData['providerMobility'])){
                            $service["providerMobility"] = esc_attr($metaData['providerMobility']);
                        }if(!empty($metaData['additionalType'])){
                            $service["additionalType"] = esc_attr($metaData['additionalType']);
                        }if(!empty($metaData['alternateName'])){
                            $service["alternateName"] = esc_attr($metaData['alternateName']);
                        }if(!empty($metaData['image'])){
                            $service["image"] = esc_attr($metaData['image']);
                        }if(!empty($metaData['mainEntityOfPage'])){
                            $service["mainEntityOfPage"] = esc_attr($metaData['mainEntityOfPage']);
                        }if(!empty($metaData['sameAs'])){
                            $service["sameAs"] = esc_attr($metaData['sameAs']);
                        }if(!empty($metaData['url'])){
                            $service["url"] = esc_attr($metaData['url']);
                        }
                        $html .= $this->get_jsonEncode($service);
                        break;

                    case 'review':
                        $review = array();
                        $review["@context"] = "http://schema.org";
                        $review["@type"] = "Review";
                        if(!empty($metaData['itemName'])){
                            $review["itemReviewed"] = array(
                                "@type" => "Thing",
                                "name"  => esc_attr($metaData['itemName'])
                            );
                        }if(!empty($metaData['ratingValue'])){
                            $review["reviewRating"] = array(
                                "@type" => "Rating",
                                "ratingValue" => esc_attr($metaData['ratingValue']),
                                "bestRating" => esc_attr($metaData['bestRating']),
                                "worstRating" => esc_attr($metaData['worstRating'])
                            );
                        }if(!empty($metaData['name'])){
                            $review["name"] = esc_attr($metaData['name']);
                        }if(!empty($metaData['author'])){
                            $review["author"] = array(
                                "@type" => "Person",
                                "name"  => esc_attr($metaData['author'])
                            );
                        }if(!empty($metaData['reviewBody'])){
                            $review["reviewBody"] = esc_attr($metaData['reviewBody']);
                        }if(!empty($metaData['datePublished'])){
                            $review["datePublished"] = esc_attr($metaData['datePublished']);
                        }if(!empty($metaData['publisher'])){
                            $review["publisher"] = array(
                                "@type" => "Organization",
                                "name" => esc_attr($metaData['publisher'])
                            );
                        }
                        $html .= $this->get_jsonEncode($review);
                        break;
                    case 'aggregate_rating':
                        $aRating = array();
                        $aRating["@context"] = "http://schema.org";
                        $aRating["@type"] = !empty($metaData['schema_type']) ? $metaData['schema_type'] : "LocalBusiness";
                        if(!empty($metaData['name'])){
                            $aRating["name"] = esc_attr($metaData['name']);
                        }if(!empty($metaData['description'])){
                            $aRating["description"] = esc_attr($metaData['description']);
                        }if(!empty($metaData['ratingValue'])){
                            $rValue = array();
                            $rValue["@type"] = "AggregateRating";
                            $rValue["ratingValue"] = esc_attr($metaData['ratingValue']);
                            if(!empty($metaData['bestRating'])){
                                $rValue["bestRating"] = esc_attr($metaData['bestRating']);
                            }if(!empty($metaData['worstRating'])){
                                $rValue["worstRating"] = esc_attr($metaData['worstRating']);
                            }if(!empty($metaData['ratingCount'])){
                                $rValue["ratingCount"] = esc_attr($metaData['ratingCount']);
                            }

                            $aRating["aggregateRating"] = $rValue;
                        }
                        $html .= $this->get_jsonEncode($aRating);
                        break;

                    default:
                        break;
                }

            }
            return $html;
        }

        function get_field($fieldId,$data,$pid = null){
            $html = null;
            if($fieldId){
                global $KcSeoWPSchema;
                $schemaId = $KcSeoWPSchema->KcSeoPrefix.$data['schemaId'];
                $id = $KcSeoWPSchema->KcSeoPrefix.$data['schemaId']."_".$fieldId;
                $name = $schemaId."[{$fieldId}]";
                $getRawMeta = get_post_meta($pid, $schemaId, true );
                $metaData = array();
                if(!empty($getRawMeta)) {
                    if ($KcSeoWPSchema->isValidBase64($getRawMeta)) {
                        $metaData = unserialize(base64_decode($getRawMeta));
                    } else {
                        $metaData = unserialize($getRawMeta);
                    }
                }
                $value = (isset($metaData[$fieldId]) ? ($metaData[$fieldId] ? esc_attr($metaData[$fieldId]) : null) : null);
                $class = isset($data['class']) ? ($data['class'] ? $data['class'] : null) : null;
                $require = (isset($data['required']) ? ($data['required'] ? "<span class='required'>*</span>" : null ) : null);
                $title = (isset($data['title']) ? ($data['title'] ? $data['title'] : null ) : null);
                $desc = (isset($data['desc']) ? ($data['desc'] ? $data['desc'] : null ) : null);

                $html .="<div class='field-container' id='".$id.'-container'."'>";
                    $html .="<label class='field-label' for='{$id}'>{$title}{$require}</label>";
                    $html .="<div class='field-content' id='".$id.'-content'."'>";
                    switch($data['type']){
                        case 'text':
                            $html .= "<input type='text' id='{$id}' class='{$class}' name='{$name}' value='{$value}' />";
                            break;

                        case 'number':
                            if($fieldId == 'price'){
                                $html .= "<input type='number' step='any' id='{$id}' class='{$class}' name='{$name}' value='{$value}' />";
                            }else{
                                $html .= "<input type='number' id='{$id}' class='{$class}' name='{$name}' value='{$value}' />";
                            }
                            break;
                        case 'textarea':
                            $html .= "<textarea id='{$id}' class='{$class}' name='{$name}' >{$value}</textarea>";
                            break;
                        case 'select':
                            $html .="<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                            if(!empty($data['empty'])){
                                $html .="<option value=''>{$data['empty']}</option>";
                            }
                            if(!empty($data['options']) && is_array($data['options'])) {
                                if ($this->isAssoc($data['options'])) {
                                    foreach ($data['options'] as $optKey => $optValue) {
                                        $slt = ($optKey == $value ? "selected" : null);
                                        $html .= "<option value='{$optKey}' {$slt}>{$optValue}</option>";
                                    }
                                } else {
                                    foreach ($data['options'] as $optValue) {
                                        $slt = ($optValue == $value ? "selected" : null);
                                        $html .= "<option value='{$optValue}' {$slt}>{$optValue}</option>";
                                    }
                                }
                            }
                            $html .="</select>";
                            break;
                        default:
                            $html .= "<input id='{$id}' type='{$data['type']}' value='{$value}' name='$name' />";
                            break;

                    }
                    $html .= "<p class='description'>{$desc}</p>";
                    $html .="</div>";
                $html .="</div>";
            }

            return $html;
        }

        public function schemaTypes(){
            return array(
                'article' => array(
                    'title' => "Article",
                    'fields' => array(
                        'headline'      => array(
                            'title' => 'Headline',
                            'type'  => 'text',
                            'desc'  => 'Article title',
                            'required' => true
                        ),
                        'mainEntityOfPage'=> array(
                            'title' => 'Page URL',
                            'type'  => 'url',
                            'desc'  => 'The canonical URL of the article page',
                            'required' => true
                        ),
                        'author'        => array(
                            'title' => 'Author Name',
                            'type'  => 'text',
                            'desc'  => 'Author display name',
                            'required' => true
                        ),
                        'image'         => array(
                            'title' => 'Image URL',
                            'type'  => 'url',
                            'desc'  => 'Image url',
                            'required' => true
                        ),
                        'datePublished' => array(
                            'title' => 'Published date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'required' => true,
                            'desc'  => 'Like this: 2015-12-25'
                        ),
                        'dateModified' => array(
                            'title' => 'Modified date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'required' => true,
                            'desc'  => 'Like this: 2015-12-25'
                        ),
                        'publisher'        => array(
                            'title' => 'Publisher',
                            'type'  => 'text',
                            'desc'  => 'Publisher name or Organization name',
                            'required' => true
                        ),
                        'publisherImage'         => array(
                            'title' => 'Publisher Logo',
                            'type'  => 'url',
                            'desc'  => 'Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>',
                            'required' => true
                        ),
                        'description'   => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'desc'  => 'Short description'
                        ),
                        'articleBody'   => array(
                            'title' => 'Article body',
                            'type'  => 'textarea',
                            'desc'  => 'Article content'
                        ),
                        'alternativeHeadline'   => array(
                            'title' => 'Alternative headline',
                            'type'  => 'text',
                            'desc'  => 'A secondary headline for the article.'
                        ),
                    )
                ),
                'blog_posting' => array(
                    'title'      => 'Blog Posting',
                    'fields' => array(
                        'headline'      => array(
                            'title' => 'Headline',
                            'type'  => 'text',
                            'desc'  => 'Blog posting title',
                            'required' => true
                        ),
                        'mainEntityOfPage'=> array(
                            'title' => 'Page URL',
                            'type'  => 'url',
                            'desc'  => 'The canonical URL of the article page',
                            'required' => true
                        ),
                        'author'        => array(
                            'title' => 'Author name',
                            'type'  => 'text',
                            'desc'  => 'Author display name',
                            'required' => true
                        ),
                        'image'         => array(
                            'title' => 'Image URL',
                            'type'  => 'url',
                            'desc'  => 'Image url',
                            'required' => true
                        ),
                        'datePublished' => array(
                            'title' => 'Published date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => 'Like this: 2015-12-25',
                            'required' => true
                        ),
                        'dateModified' => array(
                            'title' => 'Modified date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => 'Like this: 2015-12-25',
                            'required' => true
                        ),
                        'publisher' => array(
                            'title' => 'Publisher',
                            'type'  => 'text',
                            'desc'  => 'Publisher name or Organization name',
                            'required' => true
                        ),
                        'publisherImage' => array(
                            'title' => 'Publisher Logo',
                            'type'  => 'url',
                            'desc'  => 'Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>',
                            'required' => true
                        ),
                        'description'   => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'desc'  => 'Short description'
                        ),
                        'articleBody'   => array(
                            'title' => 'Article body',
                            'type'  => 'textarea',
                            'desc'  => 'Article content'
                        )
                    )
                ),
                'news_article' => array(
                    'title'      => 'News Article',
                    'fields' => array(
                        'headline'      => array(
                            'title' => 'Headline',
                            'type'  => 'text',
                            'desc'  => 'Article title',
                            'required' => true
                        ),
                        'mainEntityOfPage'=> array(
                            'title' => 'Page URL',
                            'type'  => 'url',
                            'desc'  => 'The canonical URL of the article page',
                            'required' => true
                        ),
                        'author'        => array(
                            'title' => 'Author',
                            'type'  => 'text',
                            'desc'  => 'Author display name',
                            'required' => true
                        ),
                        'image'         => array(
                            'title' => 'Image',
                            'type'  => 'url',
                            'desc'  => 'Image url',
                            'required' => true
                        ),
                        'datePublished' => array(
                            'title' => 'Published date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => 'Like this: 2015-12-25',
                            'required' => true
                        ),
                        'dateModified' => array(
                            'title' => 'Modified date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'required' => true,
                            'desc'  => 'Like this: 2015-12-25'
                        ),
                        'publisher'        => array(
                            'title' => 'Publisher',
                            'type'  => 'text',
                            'desc'  => 'Publisher name or Organization name',
                            'required' => true
                        ),
                        'publisherImage'         => array(
                            'title' => 'Publisher Logo',
                            'type'  => 'url',
                            'desc'  => 'Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>',
                            'required' => true
                        ),
                        'description'   => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'desc'  => 'Short description'
                        ),
                        'articleBody'   => array(
                            'title' => 'Article body',
                            'type'  => 'textarea',
                            'desc'  => 'Article body content'
                        )
                    )
                ),
                'event'    => array(
                    'title'     => 'Event',
                    'fields' => array(
                        'name'      => array(
                            'title' => 'Name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The name of the event."
                        ),
                        'locationName'  => array(
                            'title' => 'Location name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "Event Location name"
                        ),
                        'locationAddress'  => array(
                            'title' => 'Location address',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The location of for example where the event is happening, an organization is located, or where an action takes place."
                        ),
                        'startDate'  => array(
                            'title' => 'Start date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'required' => true,
                            'desc'  => "Event start date"
                        ),
                        'price'  => array(
                            'title' => 'Price (Recommended)',
                            'type'  => 'number',
                            'desc'  => "This is highly recommended. The lowest available price, including service charges and fees, of this type of ticket. <span class='required'>Not required but (Recommended)</span>"
                        ),
                        'priceCurrency'  => array(
                            'title' => 'Price currency',
                            'type'  => 'text',
                            'desc'  => "The 3-letter currency code. (USD)"
                        ),
                        'url'  =>  array(
                            'title' => 'URL (Recommended)',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'desc'  => "A link to the event's details page. <span class='required'>Not required but (Recommended)</span>"
                        ),
                    )
                ),
                'product'    => array(
                    'title'     => 'Product',
                    'fields' => array(
                        'name'      => array(
                            'title' => 'Name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The name of the product."
                        ),
                        'image'       =>  array(
                            'title' => 'Image URL',
                            'type'  => 'url',
                            'desc'  => "The URL of a product photo. Pictures clearly showing the product, e.g. against a white background, are preferred."
                        ),
                        'description'  => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'desc'  => "Product description."
                        ),
                        'brand'  => array(
                            'title' => 'Brand',
                            'type'  => 'text',
                            'desc'  => "The brand of the product."
                        ),
                        'ratingValue'  => array(
                            'title' => 'Ratting value',
                            'type'  => 'text',
                            'desc'  => "Rating value. (1 , 2.5, 3, 5 etc)"
                        ),
                        'reviewCount'  => array(
                            'title' => 'Total review count',
                            'type'  => 'number',
                            'desc'  => "Rating ratting value. <span class='required'>This is required if (Ratting value) is given</span>"
                        ),
                        'price'  => array(
                            'title' => 'Price',
                            'type'  => 'number',
                            'desc'  => "The lowest available price, including service charges and fees, of this type of ticket."
                        ),
                        'priceCurrency'  => array(
                            'title' => 'Price currency',
                            'type'  => 'text',
                            'desc'  => "The 3-letter currency code."
                        ),
                        'availability'  => array(
                            'title' => 'Availability',
                            'type'  => 'select',
                            'empty' => "Select one",
                            'options' => array(
                                'http://schema.org/InStock' => 'InStock',
                                'http://schema.org/InStoreOnly' => 'InStoreOnly',
                                'http://schema.org/OutOfStock' => 'OutOfStock',
                                'http://schema.org/SoldOut' => 'SoldOut',
                                'http://schema.org/OnlineOnly' => 'OnlineOnly',
                                'http://schema.org/LimitedAvailability' => 'LimitedAvailability',
                                'http://schema.org/Discontinued' => 'Discontinued',
                                'http://schema.org/PreOrder' => 'PreOrder',
                            ),
                            'desc'  => "Select a availability type",
                        ),
                        'itemCondition'  => array(
                            'title' => 'Product condition',
                            'type'  => 'select',
                            'empty' => "Select one",
                            'options' => array(
                                'http://schema.org/NewCondition' => 'NewCondition',
                                'http://schema.org/UsedCondition' => 'UsedCondition',
                                'http://schema.org/DamagedCondition' => 'DamagedCondition',
                                'http://schema.org/RefurbishedCondition' => 'RefurbishedCondition',
                            ),
                            'desc'  => "Select a condition"
                        ),
                        'url'  => array(
                            'title' => 'Product URL',
                            'type'  => 'url',
                            'desc'  => "A URL to the product web page (that includes the Offer). (Don't use offerURL for markup that appears on the product page itself.)"
                        ),
                    )
                ),
                'video'    => array(
                    'title'     => 'Video',
                    'fields' => array(
                        'name'      => array(
                            'title' => 'Name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The title of the video"
                        ),
                        'description'  => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'required' => true,
                            'desc'  => "The description of the video"
                        ),
                        'thumbnailUrl'       =>  array(
                            'title' => 'Thumbnail URL',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'required' => true,
                            'desc'  => "A URL pointing to the video thumbnail image file. Images must be at least 160x90 pixels and at most 1920x1080 pixels."
                        ),
                        'uploadDate' => array(
                            'title' => 'Updated date',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => '2015-02-05T08:00:00+08:00'
                        ),
                        'duration'  => array(
                            'title' => 'Duration',
                            'type'  => 'text',
                            'desc'  => "The duration of the video in ISO 8601 format.(PT1M33S)"
                        ),
                        'contentUrl'  => array(
                            'title' => 'Content URL',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'desc'  => "A URL pointing to the actual video media file. This file should be in .mpg, .mpeg, .mp4, .m4v, .mov, .wmv, .asf, .avi, .ra, .ram, .rm, .flv, or other video file format."
                        ),
                        'embedUrl'  => array(
                            'title' => 'Embed URL',
                            'placeholder' => 'URL',
                            'type'  => 'url',
                            'desc'  => "A URL pointing to a player for the specific video. Usually this is the information in the src element of an < embed> tag.Example: Dailymotion: http://www.dailymotion.com/swf/x1o2g."
                        ),
                        'interactionCount'  => array(
                            'title' => 'Interaction count',
                            'type'  => 'text',
                            'desc'  => "The number of times the video has been viewed."
                        ),
                        'expires'  => array(
                            'title' => 'Expires',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => "Like this: 2015-12-25"
                        ),
                    )
                ),
                'service'    => array(
                    'title'     => 'Service',
                    'fields' => array(
                        'name'      => array(
                            'title' => 'Name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The name of the Service."
                        ),
                        'serviceType' => array(
                            'title' => 'Service type',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The type of service being offered, e.g. veterans' benefits, emergency relief, etc."
                        ),
                        'additionalType'       =>  array(
                            'title' => 'Additional type',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'desc'  => "An additional type for the service, typically used for adding more specific types from external vocabularies in microdata syntax."
                        ),
                        'locationName' => array(
                            'title' => 'Served location name ',
                            'type'  => 'text',
                            'desc'  => "The geographic area where a service or offered item is provided."
                        ),
                        'locationAddress' => array(
                            'title' => 'Served location address',
                            'type'  => 'text',
                            'desc'  => "The geographic area where a service or offered item is provided.<span class='required'>This field is required when location name is set</span>"
                        ),
                        'award' => array(
                            'title' => 'Award',
                            'type'  => 'text',
                            'desc'  => "An award won by or for this service."
                        ),
                        'category'  => array(
                            'title' => 'Category',
                            'type'  => 'text',
                            'desc'  => "A category for the service."
                        ),
                        'providerMobility'  => array(
                            'title' => 'Provider mobility',
                            'type'  => 'text',
                            'desc'  => "Indicates the mobility of a provided service (e.g. 'static', 'dynamic')."
                        ),
                        'description'  => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'require' => true,
                            'desc'  => "A short description of the service."
                        ),
                        'image'       =>  array(
                            'title' => 'Image URL',
                            'type'  => 'url',
                            'require' => false,
                            'desc'  => "An image of the service. This should be a URL."
                        ),
                        'mainEntityOfPage' =>  array(
                            'title' => 'Main entity of page URL',
                            'type'  => 'url',
                            'require' => false,
                            'desc'  => "Indicates a page (or other CreativeWork) for which this thing is the main entity being described."
                        ),
                        'sameAs'  => array(
                            'title' => 'Same as URL',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'desc'  => "URL of a reference Web page that unambiguously indicates the service's identity. E.g. the URL of the service's Wikipedia page, Freebase page, or official website."
                        ),
                        'url'  => array(
                            'title' => 'Url of the service',
                            'type'  => 'url',
                            'placeholder' => 'URL',
                            'desc'  => "URL of the service."
                        ),
                        'alternateName' => array(
                            'title' => 'Alternate name',
                            'type'  => 'text',
                            'desc'  => 'An alias for the service.'
                        ),
                    )
                ),
                'review'    => array(
                    'title'     => 'Review',
                    'fields' => array(
                        'itemName'      => array(
                            'title' => 'Name of the reviewed item',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The item that is being reviewed."
                        ),
                        'reviewBody' => array(
                            'title' => 'Review body',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The actual body of the review."
                        ),
                        'name' => array(
                            'title' => 'Review name',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "A particular name for the review."
                        ),
                        'author' => array(
                            'title' => 'Author',
                            'type'  => 'text',
                            'required' => true,
                            'author' => 'Author name',
                            'desc'  => "The author of the review. The reviewer’s name needs to be a valid name."
                        ),
                        'datePublished'  => array(
                            'title' => 'Date of Published',
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => "Like this: 2015-12-25"
                        ),
                        'ratingValue'  => array(
                            'title' => 'Rating value',
                            'type'  => 'number',
                            'desc'  => "A numerical quality rating for the item."
                        ),
                        'bestRating'       =>  array(
                            'title' => 'Best rating',
                            'type'  => 'number',
                            'desc'  => "The highest value allowed in this rating system."
                        ),
                        'worstRating'       =>  array(
                            'title' => 'Worst rating',
                            'type'  => 'number',
                            'desc'  => "The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed."
                        ),
                        'publisher' => array(
                            'title' => 'Name of the organization',
                            'type'  => 'text',
                            'desc'  => 'The publisher of the review.'
                        )
                    )
                ),
                'aggregate_rating'    => array(
                    'title'     => 'Aggregate Ratings',
                    'fields' => array(
                        'schema_type'      => array(
                            'title' => 'Schema type',
                            'type'  => 'select',
                            'required' => true,
                            'options'   => $this->site_type(),
                            'empty' => "Select one",
                            'desc'  => "Use the most appropriate schema type for what is being reviewed."
                        ),
                        'name'      => array(
                            'title' => 'Name of the item',
                            'type'  => 'text',
                            'required' => true,
                            'desc'  => "The item that is being rated."
                        ),
                        'description'      => array(
                            'title' => 'Description',
                            'type'  => 'textarea',
                            'desc'  => "Description for thr review"
                        ),
                        'ratingCount' => array(
                            'title' => 'Rating Count',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "The total number of ratings for the item on your site. <span class='required'>* At least one of ratingCount or reviewCount is required.</span>"
                        ),
                        'reviewCount' => array(
                            'title' => 'Review Count',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "Specifies the number of people who provided a review with or without an accompanying rating. At least one of ratingCount or reviewCount is required."
                        ),
                        'ratingValue' => array(
                            'title' => 'Rating Value',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "A numerical quality rating for the item."
                        ),
                        'ratingValue' => array(
                            'title' => 'Rating Value',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "A numerical quality rating for the item."
                        ),
                        'bestRating' => array(
                            'title' => 'Best Rating',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "The highest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If bestRating is omitted, 5 is assumed."
                        ),
                        'worstRating' => array(
                            'title' => 'Worst Rating',
                            'type'  => 'number',
                            'required' => true,
                            'desc'  => "The lowest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If worstRating is omitted, 1 is assumed."
                        )
                    )
                )
            );
        }

        function get_jsonEncode($data = array()){
            $html = null;
            /** @var TYPE_NAME $data */
            if(!empty($data) && is_array($data)){
                $html .= '<script type="application/ld+json">' .json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
            }
            return $html;
        }

        function site_type(){
            return array(
                'Organization',
                'LocalBusiness',
                'AccountingService',
                'Attorney',
                'AutoBodyShop',
                'AutoDealer',
                'AutoPartsStore',
                'AutoRental',
                'AutoRepair',
                'AutoWash',
                'Bakery',
                'BarOrPub',
                'BeautySalon',
                'BedAndBreakfast',
                'BikeStore',
                'BookStore',
                'CafeOrCoffeeShop',
                'ChildCare',
                'ClothingStore',
                'ComputerStore',
                'DaySpa',
                'Dentist',
                'DryCleaningOrLaundry',
                'Electrician',
                'ElectronicsStore',
                'EmergencyService',
                'EntertainmentBusiness',
                'EventVenue',
                'ExerciseGym',
                'FinancialService',
                'Florist',
                'FoodEstablishment',
                'FurnitureStore',
                'GardenStore',
                'GeneralContractor',
                'GolfCourse',
                'HairSalon',
                'HardwareStore',
                'HealthAndBeautyBusiness',
                'HobbyShop',
                'Store',
                'HomeAndConstructionBusiness',
                'HomeGoodsStore',
                'Hospital',
                'Hotel',
                'HousePainter',
                'HVACBusiness',
                'HVACBusiness',
                'InsuranceAgency',
                'JewelryStore',
                'LiquorStore',
                'Locksmith',
                'LodgingBusiness',
                'MedicalClinic',
                'MensClothingStore',
                'MobilePhoneStore',
                'Motel',
                'MotorcycleDealer',
                'MotorcycleRepair',
                'MovingCompany',
                'MusicStore',
                'NailSalon',
                'NightClub',
                'Notary',
                'OfficeEquipmentStore',
                'Optician',
                'Person',
                'PetStore',
                'Physician',
                'Plumber',
                'ProfessionalService',
                'RealEstateAgent',
                'Residence',
                'Restaurant',
                'RoofingContractor',
                'RVPark',
                'School',
                'SelfStorage',
                'ShoeStore',
                'SkiResort',
                'SportingGoodsStore',
                'SportsClub',
                'Store',
                'TattooParlor',
                'Taxi',
                'TennisComplex',
                'TireShop',
                'ToyStore',
                'TravelAgency',
                'VeterinaryCare',
                'WholesaleStore',
                'Winery'
            );
        }

        function countryList(){
            return array(
                "AF" => "Afghanistan",
                        "AX" => "Aland Islands",
                        "AL" => "Albania",
                        "DZ" => "Algeria",
                        "AS" => "American Samoa",
                        "AD" => "Andorra",
                        "AO" => "Angola",
                        "AI" => "Anguilla",
                        "AQ" => "Antarctica",
                        "AG" => "Antigua and Barbuda",
                        "AR" => "Argentina",
                        "AM" => "Armenia",
                        "AW" => "Aruba",
                        "AU" => "Australia",
                        "AT" => "Austria",
                        "AZ" => "Azerbaijan",
                        "BS" => "Bahamas",
                        "BH" => "Bahrain",
                        "BD" => "Bangladesh",
                        "BB" => "Barbados",
                        "BY" => "Belarus",
                        "BE" => "Belgium",
                        "BZ" => "Belize",
                        "BJ" => "Benin",
                        "BM" => "Bermuda",
                        "BT" => "Bhutan",
                        "BO" => "Bolivia, Plurinational State of",
                        "BQ" => "Bonaire, Sint Eustatius and Saba",
                        "BA" => "Bosnia and Herzegovina",
                        "BW" => "Botswana",
                        "BV" => "Bouvet Island",
                        "BR" => "Brazil",
                        "IO" => "British Indian Ocean Territory",
                        "BN" => "Brunei Darussalam",
                        "BG" => "Bulgaria",
                        "BF" => "Burkina Faso",
                        "BI" => "Burundi",
                        "KH" => "Cambodia",
                        "CM" => "Cameroon",
                        "CA" => "Canada",
                        "CV" => "Cape Verde",
                        "KY" => "Cayman Islands",
                        "CF" => "Central African Republic",
                        "TD" => "Chad",
                        "CL" => "Chile",
                        "CN" => "China",
                        "CX" => "Christmas Island",
                        "CC" => "Cocos (Keeling) Islands",
                        "CO" => "Colombia",
                        "KM" => "Comoros",
                        "CG" => "Congo",
                        "CD" => "Congo, the Democratic Republic of the",
                        "CK" => "Cook Islands",
                        "CR" => "Costa Rica",
                        "CI" => "Côte d Ivoire",
                        "HR" => "Croatia",
                        "CU" => "Cuba",
                        "CW" => "Curaçao",
                        "CY" => "Cyprus",
                        "CZ" => "Czech Republic",
                        "DK" => "Denmark",
                        "DJ" => "Djibouti",
                        "DM" => "Dominica",
                        "DO" => "Dominican Republic",
                        "EC" => "Ecuador",
                        "EG" => "Egypt",
                        "SV" => "El Salvador",
                        "GQ" => "Equatorial Guinea",
                        "ER" => "Eritrea",
                        "EE" => "Estonia",
                        "ET" => "Ethiopia",
                        "FK" => "Falkland Islands (Malvinas)",
                        "FO" => "Faroe Islands",
                        "FJ" => "Fiji",
                        "FI" => "Finland",
                        "FR" => "France",
                        "GF" => "French Guiana",
                        "PF" => "French Polynesia",
                        "TF" => "French Southern Territories",
                        "GA" => "Gabon",
                        "GM" => "Gambia",
                        "GE" => "Georgia",
                        "DE" => "Germany",
                        "GH" => "Ghana",
                        "GI" => "Gibraltar",
                        "GR" => "Greece",
                        "GL" => "Greenland",
                        "GD" => "Grenada",
                        "GP" => "Guadeloupe",
                        "GU" => "Guam",
                        "GT" => "Guatemala",
                        "GG" => "Guernsey",
                        "GN" => "Guinea",
                        "GW" => "Guinea-Bissau",
                        "GY" => "Guyana",
                        "HT" => "Haiti",
                        "HM" => "Heard Island and McDonald Islands",
                        "VA" => "Holy See (Vatican City State)",
                        "HN" => "Honduras",
                        "HK" => "Hong Kong",
                        "HU" => "Hungary",
                        "IS" => "Iceland",
                        "IN" => "India",
                        "ID" => "Indonesia",
                        "IR" => "Iran, Islamic Republic of",
                        "IQ" => "Iraq",
                        "IE" => "Ireland",
                        "IM" => "Isle of Man",
                        "IL" => "Israel",
                        "IT" => "Italy",
                        "JM" => "Jamaica",
                        "JP" => "Japan",
                        "JE" => "Jersey",
                        "JO" => "Jordan",
                        "KZ" => "Kazakhstan",
                        "KE" => "Kenya",
                        "KI" => "Kiribati",
                        "KP" => "Korea, Democratic People's Republic of",
                        "KR" => "Korea, Republic of,",
                        "KW" => "Kuwait",
                        "KG" => "Kyrgyzstan",
                        "LA" => "Lao Peoples Democratic Republic",
                        "LV" => "Latvia",
                        "LB" => "Lebanon",
                        "LS" => "Lesotho",
                        "LR" => "Liberia",
                        "LY" => "Libya",
                        "LI" => "Liechtenstein",
                        "LT" => "Lithuania",
                        "LU" => "Luxembourg",
                        "MO" => "Macao",
                        "MK" => "Macedonia, the former Yugoslav Republic of",
                        "MG" => "Madagascar",
                        "MW" => "Malawi",
                        "MY" => "Malaysia",
                        "MV" => "Maldives",
                        "ML" => "Mali",
                        "MT" => "Malta",
                        "MH" => "Marshall Islands",
                        "MQ" => "Martinique",
                        "MR" => "Mauritania",
                        "MU" => "Mauritius",
                        "YT" => "Mayotte",
                        "MX" => "Mexico",
                        "FM" => "Micronesia, Federated States of",
                        "MD" => "Moldova, Republic of",
                        "MC" => "Monaco",
                        "MN" => "Mongolia",
                        "ME" => "Montenegro",
                        "MS" => "Montserrat",
                        "MA" => "Morocco",
                        "MZ" => "Mozambique",
                        "MM" => "Myanmar",
                        "NA" => "Namibia",
                        "NR" => "Nauru",
                        "NP" => "Nepal",
                        "NL" => "Netherlands",
                        "NC" => "New Caledonia",
                        "NZ" => "New Zealand",
                        "NI" => "Nicaragua",
                        "NE" => "Niger",
                        "NG" => "Nigeria",
                        "NU" => "Niue",
                        "NF" => "Norfolk Island",
                        "MP" => "Northern Mariana Islands",
                        "NO" => "Norway",
                        "OM" => "Oman",
                        "PK" => "Pakistan",
                        "PW" => "Palau",
                        "PS" => "Palestine, State of",
                        "PA" => "Panama",
                        "PG" => "Papua New Guinea",
                        "PY" => "Paraguay",
                        "PE" => "Peru",
                        "PH" => "Philippines",
                        "PN" => "Pitcairn",
                        "PL" => "Poland",
                        "PT" => "Portugal",
                        "PR" => "Puerto Rico",
                        "QA" => "Qatar",
                        "RE" => "Reunion",
                        "RO" => "Romania",
                        "RU" => "Russian Federation",
                        "RW" => "Rwanda",
                        "BL" => "Saint Barthélemy",
                        "SH" => "Saint Helena, Ascension and Tristan da Cunha",
                        "KN" => "Saint Kitts and Nevis",
                        "LC" => "Saint Lucia",
                        "MF" => "Saint Martin (French part)",
                        "PM" => "Saint Pierre and Miquelon",
                        "VC" => "Saint Vincent and the Grenadines",
                        "WS" => "Samoa",
                        "SM" => "San Marino",
                        "ST" => "Sao Tome and Principe",
                        "SA" => "Saudi Arabia",
                        "SN" => "Senegal",
                        "RS" => "Serbia",
                        "SC" => "Seychelles",
                        "SL" => "Sierra Leone",
                        "SG" => "Singapore",
                        "SX" => "Sint Maarten (Dutch part)",
                        "SK" => "Slovakia",
                        "SI" => "Slovenia",
                        "SB" => "Solomon Islands",
                        "SO" => "Somalia",
                        "ZA" => "South Africa",
                        "GS" => "South Georgia and the South Sandwich Islands",
                        "SS" => "South Sudan",
                        "ES" => "Spain",
                        "LK" => "Sri Lanka",
                        "SD" => "Sudan",
                        "SR" => "Suriname",
                        "SJ" => "Svalbard and Jan Mayen",
                        "SZ" => "Swaziland",
                        "SE" => "Sweden",
                        "CH" => "Switzerland",
                        "SY" => "Syrian Arab Republic",
                        "TW" => "Taiwan, Province of China",
                        "TJ" => "Tajikistan",
                        "TZ" => "Tanzania, United Republic of",
                        "TH" => "Thailand",
                        "TL" => "Timor-Leste",
                        "TG" => "Togo",
                        "TK" => "Tokelau",
                        "TO" => "Tonga",
                        "TT" => "Trinidad and Tobago",
                        "TN" => "Tunisia",
                        "TR" => "Turkey",
                        "TM" => "Turkmenistan",
                        "TC" => "Turks and Caicos Islands",
                        "TV" => "Tuvalu",
                        "UG" => "Uganda",
                        "UA" => "Ukraine",
                        "AE" => "United Arab Emirates",
                        "GB" => "United Kingdom",
                        "US" => "United States",
                        "UM" => "United States Minor Outlying Islands",
                        "UY" => "Uruguay",
                        "UZ" => "Uzbekistan",
                        "VU" => "Vanuatu",
                        "VE" => "Venezuela, Bolivarian Republic of",
                        "VN" => "Viet Nam",
                        "VG" => "Virgin Islands, British",
                        "VI" => "Virgin Islands, U.S.",
                        "WF" => "Wallis and Futuna",
                        "EH" => "Western Sahara",
                        "YE" => "Yemen",
                        "ZM" => "Zambia",
                        "ZW" => "Zimbabwe",
            );
        }

        function contactType(){
            return array(
                "Customer Service",
                "Technical Support",
                "Billing Support",
                "Bill Payment",
                "Sales",
                "Reservations",
                "Credit Card Support",
                "Emergency",
                "Baggage Tracking",
                "Roadside Assistance",
                "Package Tracking"
            );
        }

        function languageList(){
            return array(
                "Akan",
                "Amharic",
                "Arabic",
                "Assamese",
                "Awadhi",
                "Azerbaijani",
                "Balochi",
                "Belarusian",
                "Bengali",
                "Bhojpuri",
                "Burmese",
                "Cantonese",
                "Cebuano",
                "Chewa",
                "Chhattisgarhi",
                "Chittagonian",
                "Czech",
                "Deccan",
                "Dhundhari",
                "Dutch",
                "English",
                "French",
                "Fula",
                "Gan",
                "German",
                "Greek",
                "Gujarati",
                "Haitian Creole",
                "Hakka",
                "Haryanvi",
                "Hausa",
                "Hiligaynon",
                "Hindi / Urdu",
                "Hmong",
                "Hungarian",
                "Igbo",
                "Ilokano",
                "Italian",
                "Japanese",
                "Javanese",
                "Jin",
                "Kannada",
                "Kazakh",
                "Khmer",
                "Kinyarwanda",
                "Kirundi",
                "Konkani",
                "Korean",
                "Kurdish",
                "Madurese",
                "Magahi",
                "Maithili",
                "Malagasy",
                "Malay/Indonesian",
                "Malayalam",
                "Mandarin",
                "Marathi",
                "Marwari",
                "Min Bei",
                "Min Dong",
                "Min Nan",
                "Mossi",
                "Nepali",
                "Oriya",
                "Oromo",
                "Pashto",
                "Persian",
                "Polish",
                "Portuguese",
                "Punjabi",
                "Quechua",
                "Romanian",
                "Russian",
                "Saraiki",
                "Serbo-Croatian",
                "Shona",
                "Sindhi",
                "Sinhalese",
                "Somali",
                "Spanish",
                "Sundanese",
                "Swahili",
                "Swedish",
                "Sylheti",
                "Tagalog",
                "Tamil",
                "Telugu",
                "Thai",
                "Turkish",
                "Ukrainian",
                "Uyghur",
                "Uzbek",
                "Vietnamese",
                "Wu",
                "Xhosa",
                "Xiang",
                "Yoruba",
                "Zulu",
            );
        }

        function socialList(){
            return array(
                'facebook' => __('Facebook'),
                'twitter'   => __('Twitter'),
                'google-plus' =>  __('Google+'),
                'instagram' =>  __('Instagram'),
                'youtube' =>  __('Youtube'),
                'linkedin' =>  __('LinkedIn'),
                'myspace' =>  __('Myspace'),
                'pinterest' =>  __('Pinterest'),
                'soundcloud' =>  __('SoundCloud'),
                'tumblr' =>  __('Tumblr'),
                'wikidata' =>  __('Wikidata'),
            );
        }

        function imgInfo($url = null){
            $img = array();
            if($url){
                $imgA = @getimagesize($url);
                if(is_array($imgA) && !empty($imgA)){
                    $img['width'] = $imgA[0];
                    $img['height'] = $imgA[1];
                }else{
                    $img['width'] = 0;
                    $img['height'] = 0;
                }
            }
            return $img;
        }
        function isAssoc($array)
        {
            $keys = array_keys($array);
            return $keys !== array_keys($keys);
        }


    }
endif;