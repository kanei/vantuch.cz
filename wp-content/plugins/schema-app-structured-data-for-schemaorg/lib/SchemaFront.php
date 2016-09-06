<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of schema-editor
 *
 * @author Mark van Berkel
 */
class SchemaFront {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        
    }

    /**
     * hunch_schema_add is called to lookup schema.org or add default markup 
     */
    public function hunch_schema_add()
    {
		global $post;

		$DisableMarkup = is_singular() ? get_post_meta( $post->ID, '_HunchSchemaDisableMarkup', true ) : false;

		if ( ! $DisableMarkup )
		{
			$server = new SchemaServer();
			$jsonLd = $server->getResource();
			if ($jsonLd === "") {
				$postType = get_post_type();
				$schemaObj = HunchSchema_Thing::factory($postType);
				if ( isset( $schemaObj )) {
					$jsonLd = $schemaObj->getResource();
				}
			}
			if ( $jsonLd !== "" ) {
				echo "<script type='application/ld+json'>" . $jsonLd . "</script>";
			}
		}     
    }


	function AdminBarMenu( $wp_admin_bar )
	{
		$Permalink = HunchSchema_Thing::getPermalink();

		if ( $Permalink )
		{
			$args = array
			(
				'id'    => 'Hunch-Schema',
				'title' => 'Test Schema',
				'href'  => 'https://developers.google.com/structured-data/testing-tool?url=' . urlencode( $Permalink ),
				'meta'  => array
				(
					'class' => 'Hunch-Schema',
					'target' => '_blank',
				),
			);

			$wp_admin_bar->add_node( $args );
		}
	}

}