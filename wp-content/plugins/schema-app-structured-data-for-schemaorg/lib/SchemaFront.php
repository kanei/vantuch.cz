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

			$SchemaMarkup = apply_filters( 'hunch_schema_markup', $SchemaMarkup, $PostType );

			if ( $SchemaMarkup !== "" )
			{
				printf( '<script type="application/ld+json">%s</script>', $SchemaMarkup );
			}

			if ( ! empty( $this->Settings['SchemaWebSite'] ) && is_front_page() )
			{
				$SchemaMarkupWebSite = apply_filters( 'hunch_schema_markup_website', $SchemaThing->getWebSite(), $PostType );

				if ( ! empty( $SchemaMarkupWebSite ) )
				{
					printf( '<script type="application/ld+json">%s</script>', $SchemaMarkupWebSite );
				}
			}

			if ( ! empty( $this->Settings['SchemaBreadcrumb'] ) && method_exists( $SchemaThing, 'getBreadcrumb' ) )
			{
				$SchemaMarkupBreadcrumb = apply_filters( 'hunch_schema_markup_breadcrumb', $SchemaThing->getBreadcrumb(), $PostType );

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