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
     * Add schema.org MainEntityOfPage attribute to creative works
     * Changes $this->schema array
     * @return type null
     */
    protected function addMainEntity() {

        $Permalink = get_permalink();

        if (is_front_page() && is_home() || is_front_page()) {
            $Permalink = get_site_url();
        } elseif (is_home()) {
            $Permalink = get_permalink(get_option('page_for_posts'));
        }

        $this->schema['mainEntityOfPage'] = array(
            "@type" => "WebPage",
            "@id" => $Permalink
        );
    }

    /**
     * Get Default Schema.org for Resource
     * 
     * @param type boolean
     * @return type string
     */
    public function getResource($pretty = false) {

        global $post;

        $MarkupType = get_post_meta($post->ID, '_HunchSchemaType', true);

        if (is_admin()) {
            $description = "DESCRIPTION IS EMPTY WHILE EDITING";
        } else {
            $description = wp_trim_excerpt();
        }

        $this->schema = array(
            '@context' => 'http://schema.org/',
            '@type' => $MarkupType ? $MarkupType : $this->schemaType,
            'headline' => get_the_title(),
            'description' => $description,
            'datePublished' => get_the_date('Y-m-d'),
            'dateModified' => get_the_modified_date('Y-m-d'),
            'author' => $this->getAuthor(),
            'publisher' => $this->getPublisher(),
            'image' => $this->getImage(),
        );

        $this->addMainEntity();

        return $this->toJson($pretty);
    }

}
