<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of schema-editor
 *
 * @author Mark van Berkel
 */
class SchemaFront
{
    public $Settings;

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct()
    {
		$this->Settings = get_option( 'schema_option_name' );
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
			$PostType = get_post_type();
			$SchemaThing = HunchSchema_Thing::factory( $PostType );

			$SchemaServer = new SchemaServer();
			$SchemaMarkup = $SchemaServer->getResource();

			if ( $SchemaMarkup === "" )
			{
				if ( isset( $SchemaThing ) )
				{
					$SchemaMarkup = $SchemaThing->getResource();
				}
			}

			if ( $SchemaMarkup !== "" )
			{
				printf( '<script type="application/ld+json">%s</script>', $SchemaMarkup );
			}

			if ( ! empty( $this->Settings['SchemaBreadcrumb'] ) )
			{
				$SchemaMarkupBreadcrumb = $SchemaThing->getBreadcrumb();

				if ( ! empty( $SchemaMarkupBreadcrumb ) )
				{
					printf( '<script type="application/ld+json">%s</script>', $SchemaMarkupBreadcrumb );
				}
			}
		}     
    }


	function AdminBarMenu( $WPAdminBar )
	{
		$Permalink = HunchSchema_Thing::getPermalink();

		if ( $Permalink )
		{
			$Node = array
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

			$WPAdminBar->add_node( $Node );
		}
	}

}