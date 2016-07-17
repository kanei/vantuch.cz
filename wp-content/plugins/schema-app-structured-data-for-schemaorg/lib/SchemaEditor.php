<?php
defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Description of schema-editor
 * Inspired by http://codex.wordpress.org/Function_Reference/add_meta_box#Class
 *
 * @author Mark van Berkel
 */
class SchemaEditor {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
    }

     /**
     * Register javascript for media upload (Publisher Logo)
     */
    public function admin_assets($hook) {
        
        if ( ! in_array($hook, array('post.php', 'post-new.php' ) ) ) {
            return;
        }
        // Javascript
        wp_enqueue_media(); 
        wp_enqueue_script('schema-admin-funcs', WP_PLUGIN_URL.'/schema-app-structured-data-for-schemaorg/js/schemaAdmin.js', array('jquery','media-editor'), '20160712');
        
    }
    
    public function hunch_schema_edit() {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'ActionSavePost'));
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type) {
        $post_types = array('post', 'page');            //limit meta box to certain post types
        if (in_array($post_type, $post_types)) {
            add_meta_box(
                'schema_meta_json_ld'
                , __('Schema.org Structured Data', 'schema_textdomain')
                , array($this, 'render_meta_box_content')
                , $post_type
                , 'advanced'
                , 'high'
            );
        }
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content($post) {

        $PostType = get_post_type();
        $DisableMarkup = get_post_meta($post->ID, '_HunchSchemaDisableMarkup', true);
        $MarkupType = get_post_meta($post->ID, '_HunchSchemaType', true);

        // Add an nonce field so we can check for it later.
        wp_nonce_field('schema_inner_custom_box', 'schema_inner_custom_box_nonce');

        $server = new SchemaServer();
        // Use get_post_meta to retrieve an existing value from the database.       
        $jsonLd = $server->getResource(get_permalink($post->ID), true);

        if (empty($jsonLd)) {
            $schemaObj = HunchSchema_Thing::factory($PostType);
            $jsonLd = $schemaObj->getResource(TRUE);
            $replacelink = $server->createLink();
        } else {
            $editlink = $server->updateLink();
        }
        $testlink = "https://developers.google.com/structured-data/testing-tool?url=" . urlencode(get_permalink($post->ID));

        // Display the form, using the current value.
        ?>
        <style>
        #schemapostlinks {
            display: inline;
            float: right;
        }
        #schemapostlinks button {
            margin: 0 1em;
        }
        </style>
        <label for="schema_new_field"><span class="inside"><?php echo _e('Post JSON-LD', 'schema_textdomain') ?></span>
            <div id="schemapostlinks">
                <?php 
                if ( empty($replacelink) ) {
                    echo '<button><a target="_blank" href="' . $editlink . '">Edit</a></button>';
                } else {
                    ?>
                    <button><a target="_blank" href="<?php echo $replacelink; ?>">Use Different Schema.org Type</a></button>
                    <button id="extendSchema" value="Extend Markup"><a target="_blank" href="#">Add to <?php echo $schemaObj->schemaType; ?> Default Markup</a></button>
                    <input type="hidden" id="resourceURI" value="<?php echo get_permalink($post->ID); ?>"/>
                    <textarea id="resourceData" style="display:none"><?php echo esc_attr($jsonLd); ?></textarea> 
                    <?php 
                }
                ?>
                <button><a class="" target="_blank" href="<?php echo $testlink; ?>">Test with Google</a></button>
            </div>
        </label> 
        <p>
            <textarea disabled="" class="large-text metadesc" rows="6" id="schema_new_field" name="schema_new_field"><?php echo esc_attr($jsonLd); ?></textarea>
            <?php if (isset($schemaObj)): ?>
                <br/><strong>Note: </strong><span style="color: grey"><em>This is default markup. Extend this with Schema App Creator using Update linked above.</em></span>
            <?php endif; ?>
        </p>
        <h4>Markup Options</h4>
        <p>
            <label><input type="checkbox" name="HunchSchemaDisableMarkup" value="1" <?php $this->CheckSelected(1, $DisableMarkup, 'checkbox'); ?>> <?php _e('Disable Schema markup', 'schema_textdomain'); ?></label>
        </p>
        <?php if ($PostType == 'page') : ?>
            <p>
                <label>Select Type</label> 
                <select name="HunchSchemaType">
                    <option value="">Article</option>
                    <option value="BlogPosting" <?php $this->CheckSelected('BlogPosting', $MarkupType); ?>>Blog Posting</option>
                    <option value="LiveBlogPosting" <?php $this->CheckSelected('LiveBlogPosting', $MarkupType); ?>>&nbsp; Live Blog Posting</option>
                    <option value="NewsArticle" <?php $this->CheckSelected('NewsArticle', $MarkupType); ?>>News Article</option>
                    <option value="Report" <?php $this->CheckSelected('Report', $MarkupType); ?>>Report</option>
                    <option value="ScholarlyArticle" <?php $this->CheckSelected('ScholarlyArticle', $MarkupType); ?>>Scholarly Article</option>
                    <option value="MedicalScholarlyArticle" <?php $this->CheckSelected('MedicalScholarlyArticle', $MarkupType); ?>>&nbsp; Medical Scholarly Article</option>
                    <option value="SocialMediaPosting" <?php $this->CheckSelected('SocialMediaPosting', $MarkupType); ?>>Social Media Posting</option>
                    <option value="DiscussionForumPosting" <?php $this->CheckSelected('DiscussionForumPosting', $MarkupType); ?>>&nbsp; Discussion Forum Posting</option>
                    <option value="TechArticle" <?php $this->CheckSelected('TechArticle', $MarkupType); ?>>Tech Article</option>
                    <option value="APIReference" <?php $this->CheckSelected('APIReference', $MarkupType); ?>>&nbsp; API Reference</option>
                </select>
            </p>
        <?php endif; 
    }

    function ActionSavePost($PostId) {
        if (( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || wp_is_post_revision($PostId)) {
            return $PostId;
        }

        if (isset($_POST['schema_inner_custom_box_nonce'])) {
            if (isset($_POST['HunchSchemaDisableMarkup'])) {
                update_post_meta($PostId, '_HunchSchemaDisableMarkup', $_POST['HunchSchemaDisableMarkup']);
            } else {
                delete_post_meta($PostId, '_HunchSchemaDisableMarkup');
            }

            if (isset($_POST['HunchSchemaType'])) {
                update_post_meta($PostId, '_HunchSchemaType', $_POST['HunchSchemaType']);
            } else {
                delete_post_meta($PostId, '_HunchSchemaType');
            }
        }
    }

    function CheckSelected($SavedValue, $CurrentValue, $Type = 'select', $Display = true) {
        if (( is_array($SavedValue) && in_array($CurrentValue, $SavedValue) ) || ( $SavedValue == $CurrentValue )) {
            switch ($Type) {
                case 'select':
                    if ($Display) {
                        print 'selected="selected"';
                    } else {
                        return 'selected="selected"';
                    }
                    break;
                case 'radio':
                case 'checkbox':
                    if ($Display) {
                        print 'checked="checked"';
                    } else {
                        return 'checked="checked"';
                    }
                    break;
            }
        }
    }

}
