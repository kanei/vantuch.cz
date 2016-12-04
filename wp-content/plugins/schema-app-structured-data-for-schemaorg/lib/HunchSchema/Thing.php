<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of SchemaThing
 *
 * @author mark
 */
class HunchSchema_Thing {

    /**
     * Schema.org Array
     * 
     * @var type 
     */
    protected $schema;
    protected $SchemaBreadcrumb;
    protected $Settings;

    /**
     * Construuctor
     */
    public function __construct() {
        $this->Settings = get_option('schema_option_name');
    }

    public static function factory($postType) {
        // Check for specific Page Types
        if (is_search()) {
            $postType = 'Search';
        } elseif (is_author()) {
            $postType = 'Author';
        } elseif (is_category()) {
            $postType = 'Category';
        } elseif (!is_front_page() && is_home() || is_home()) {
            $postType = 'Blog';
        }

        $class = 'HunchSchema_' . $postType;

        if (class_exists($class)) {
            return new $class;
        }
    }

    /**
     * 
     */
    public function getResource($pretty = false) {
        // To override in child classes
    }

    /**
     * getWebSite sets up site search box and site name features
     * 
     * @param type $Pretty
     * @return type
     */
    public function getWebSite($Pretty = false) {
        $this->SchemaWebSite['@context'] = 'http://schema.org';
        $this->SchemaWebSite['@type'] = 'WebSite';
        $this->SchemaWebSite['@id'] = get_site_url() . "#website";
        $this->SchemaWebSite['name'] = get_bloginfo('name');
        $this->SchemaWebSite['url'] = get_site_url();
        $this->SchemaWebSite['potentialAction'] = array (
            '@type' => 'SearchAction',
            'target' => get_site_url(null, '?s={search_term_string}'),
            'query-input' => 'required name=search_term_string',
        );

        return $this->toJson($this->SchemaWebSite, $Pretty);
    }

    public function getBreadcrumb($Pretty = false) {
        return false;
    }

    public static function getPermalink() {
        $Permalink = '';

        if (is_author()) {
            $Permalink = get_author_posts_url(get_the_author_meta('ID'));
        } elseif (is_category()) {
            $Permalink = get_category_link(get_query_var('cat'));
        } elseif (is_singular()) {
            $Permalink = get_permalink();
        } elseif (is_front_page() && is_home() || is_front_page()) {
            $Permalink = get_site_url();
        } elseif (is_home()) {
            $Permalink = get_permalink(get_option('page_for_posts'));
        }

        return $Permalink;
    }

    protected function getImage() {
        if (has_post_thumbnail()) {
            $Image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail');

            return array(
                '@type' => 'ImageObject',
                'url' => $Image[0],
                'height' => $Image[2],
                'width' => $Image[1]
            );
        } else {
            global $post;

            if ($post->post_content) {
                $Document = new DOMDocument();
                @$Document->loadHTML($post->post_content);
                $DocumentImages = $Document->getElementsByTagName('img');

                if ($DocumentImages->length) {
                    return array (
                        '@type' => 'ImageObject',
                        'url' => $DocumentImages->item(0)->getAttribute('src'),
                        'height' => $DocumentImages->item(0)->getAttribute('height'),
                        'width' => $DocumentImages->item(0)->getAttribute('width')
                    );
                }
            }
        }
    }

    protected function getTags() {
        global $post;

        $Tags = wp_get_post_terms($post->ID, 'post_tag', array('fields' => 'names'));

        if ($Tags && !is_wp_error($Tags)) {
            return $Tags;
        }
    }

    protected function getComments() {
        global $post;

        $Comments = array();
        $PostComments = get_comments(array('post_id' => $post->ID, 'number' => 10, 'status' => 'approve', 'type' => 'comment'));

        if (count($PostComments)) {
            foreach ($PostComments as $Item) {
                $Comments[] = array (
                    '@type' => 'Comment',
                    'dateCreated' => $Item->comment_date,
                    'description' => $Item->comment_content,
                    'author' => array (
                        '@type' => 'Person',
                        'name' => $Item->comment_author,
                        'url' => $Item->comment_author_url,
                    ),
                );
            }

            return $Comments;
        }
    }

    protected function getAuthor() {
        global $post;

        $Author = array (
            '@type' => 'Person',
            'name' => get_the_author_meta('display_name', $post->post_author),
            'url' => esc_url(get_author_posts_url(get_the_author_meta('ID', $post->post_author))),
        );

        if (get_the_author_meta('description')) {
            $Author['description'] = get_the_author_meta('description');
        }

        if (version_compare(get_bloginfo('version'), '4.2', '>=')) {
            $AuthorImage = get_avatar_url(get_the_author_meta('user_email', $post->post_author), 96);

            if ($AuthorImage) {
                $Author['image'] = array (
                    '@type' => 'ImageObject',
                    'url' => $AuthorImage,
                    'height' => 96,
                    'width' => 96
                );
            }
        }

        return $Author;
    }

    protected function getPublisher() {
        static $publisher;

        if (!$publisher) {
            $options = get_option('schema_option_name');

            if (isset($options['publisher_type'])) {

                // Basic publisher information
                $publisher = array(
                    '@type' => $options['publisher_type'],
                );

                if (isset($options['publisher_name'])) {
                    $publisher['name'] = $options['publisher_name'];
                }

                // Get Publisher Image Attributes
                if (isset($options['publisher_image'])) {
                    global $wpdb;

                    $imgProperty = ($options['publisher_type'] === 'Person') ? 'image' : 'logo';

                    $pubimage = $wpdb->get_row($wpdb->prepare(
                                    "SELECT ID FROM $wpdb->posts WHERE guid = %s", $options['publisher_image']
                    ));

                    // Publisher image found, add it to schema
                    if (isset($pubimage)) {
                        $imgAttributes = wp_get_attachment_image_src($pubimage->ID, "full");
                        $publisher[$imgProperty] = array(
                            "@type" => "ImageObject",
                            "url" => $options['publisher_image'],
                            "width" => $imgAttributes[1],
                            "height" => $imgAttributes[2]
                        );
                    } else {
                        $publisher[$imgProperty] = array(
                            "@type" => "ImageObject",
                            "url" => $options['publisher_image'],
                            "width" => 600,
                            "height" => 60
                        );
                    }
                }
            }
        }

        return $publisher;
    }

    /**
     * Converts the schema information to JSON-LD
     * 
     * @return string
     */
    protected function toJson($Array = array(), $pretty = false) {

        foreach ($Array as $key => $value) {
            if ($value === null) {
                unset($Array[$key]);
            }
        }

        if (isset($Array)) {
            if ($pretty && strnatcmp(phpversion(), '5.4.0') >= 0) {
                $jsonLd = json_encode($Array, JSON_PRETTY_PRINT);
            } else {
                $jsonLd = json_encode($Array);
            }
            return $jsonLd;
        }
    }

}
