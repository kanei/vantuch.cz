<?php

defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Description of Blog
 *
 * @author mark
 */
class HunchSchema_Blog extends HunchSchema_Thing {

    public $schemaType = "Blog";
    
    public function getResource($pretty = false) {
        $blogPost = array();

        while (have_posts()) : the_post();

            $blogPost[] = array
                (
                '@type' => 'BlogPosting',
                'headline' => get_the_title(),
                'url' => get_the_permalink(),
                'datePublished' => get_the_date('Y-m-d'),
                'dateModified' => get_the_modified_date('Y-m-d'),
                'mainEntityOfPage' => get_the_permalink(),
                'author' => $this->getAuthor(),
                'publisher' => $this->getPublisher(),
                'image' => $this->getImage(),
                'keywords' => $this->getTags(),
                'commentCount' => get_comments_number(),
                'comment' => $this->getComments(),
            );

        endwhile;

        $this->schema = array
            (
            '@context' => 'http://schema.org/',
            '@type' => $this->schemaType,
            'headline' => get_option('page_for_posts') ? get_the_title(get_option('page_for_posts')) : get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url' => get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : get_site_url(),
            'blogPost' => $blogPost,
        );

        return $this->toJson($pretty);
    }

}