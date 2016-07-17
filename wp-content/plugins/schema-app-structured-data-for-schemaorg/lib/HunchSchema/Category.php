<?php

defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Description of Category
 *
 * @author mark
 */
class HunchSchema_Category extends HunchSchema_Thing {

    public $schemaType = "CollectionPage";
    
    public function getResource($pretty = false) {
        $hasPart = array();

        while (have_posts()) : the_post();

            $hasPart[] = array
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

        // Get Category Properties
        $category_link = get_category_link(get_the_category());
        $category_headline = single_cat_title('', false) . " Category";

        $this->schema = array
            (
            '@context' => 'http://schema.org/',
            '@type' => $this->schemaType,
            'headline' => $category_headline,
            'description' => category_description(),
            'url' => $category_link,
            'hasPart' => $hasPart
        );

        return $this->toJson($pretty);
    }

}
