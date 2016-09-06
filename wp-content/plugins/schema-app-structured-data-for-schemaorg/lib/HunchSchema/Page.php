<?php

defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Description of Article
 *
 * @author mark
 */
class HunchSchema_Page extends HunchSchema_Thing {

    public $schemaType = "Article";

    /**
     * Get Default Schema.org for Resource
     * 
     * @param type boolean
     * @return type string
     */
    public function getResource($pretty = false) {
        global $post;
        $Permalink = get_permalink();
        if (is_front_page()) {
            $Permalink = get_site_url();
        }
        $MarkupType = get_post_meta($post->ID, '_HunchSchemaType', true);
        
        if (is_admin()) {
            $description = "DESCRIPTION IS EMPTY WHILE EDITING";
        } else {
            $description = wp_trim_excerpt();
        }
        
        $this->schema = array(
            '@context' => 'http://schema.org/',
            '@type' => $MarkupType ? $MarkupType : $this->schemaType,
            'mainEntityOfPage' => array (
                "@type" => "WebPage",
                "@id" => $Permalink,
            ),
            'headline' => get_the_title(),
            'description' => $description,
            'datePublished' => get_the_date('Y-m-d'),
            'dateModified' => get_the_modified_date('Y-m-d'),
            'author' => $this->getAuthor(),
            'publisher' => $this->getPublisher(),
            'image' => $this->getImage(),
        );

        return $this->toJson($pretty);
    }

}
