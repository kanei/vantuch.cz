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

		add_action( 'init', array( $this, 'HandleCache' ) );
		add_action( 'wp', array( $this, 'LinkedOpenData' ), 10, 1 );
		add_action( 'wp_head', array( $this, 'hunch_schema_add' ) );

		if ( ! empty( $this->Settings['ToolbarShowTestSchema'] ) )
		{
			add_action( 'admin_bar_menu', array( $this, 'AdminBarMenu' ), 999 );
		}

		if ( function_exists( 'genesis' ) )
		{
			// Priority 15 ensures it runs after Genesis itself has setup.
			add_action( 'genesis_setup', array( $this, 'GenesisSetup' ), 15 );
		}
    }


	function HandleCache()
	{
		if ( isset( $_GET['Action'], $_GET['URL'] ) && $_GET['Action'] == 'HSDeleteMarkupCache' )
		{
			delete_transient( 'HunchSchema-Markup-' . md5( $_GET['URL'] ) );

			header( 'HTTP/1.0 202 Accepted', true, 202 );

			exit;
		}
	}


    /**
     * hunch_schema_add is called to lookup schema.org or add default markup 
     */
    public function hunch_schema_add( $JSON = false )
    {
		global $post;

		$DisableMarkup = is_singular() ? get_post_meta( $post->ID, '_HunchSchemaDisableMarkup', true ) : false;

		if ( ! $DisableMarkup )
		{
			$PostType = get_post_type();
			$SchemaThing = HunchSchema_Thing::factory( $PostType );

			$SchemaServer = new SchemaServer();
			$SchemaMarkup = $SchemaServer->getResource();

			$JSONSchemaMarkup = array();

			if ( $SchemaMarkup === "" )
			{
				$SchemaMarkupCustom = get_post_meta( $post->ID, '_HunchSchemaMarkup', true );

				if ( $SchemaMarkupCustom )
				{
					$SchemaMarkup = $SchemaMarkupCustom;
				}
				else if ( isset( $SchemaThing ) )
				{
					$SchemaMarkup = $SchemaThing->getResource();
				}
			}

			$SchemaMarkup = apply_filters( 'hunch_schema_markup', $SchemaMarkup, $PostType );

			if ( $SchemaMarkup !== "" )
			{
				if ( $JSON )
				{
					$JSONSchemaMarkup[] = $SchemaMarkup;
				}
				else
				{
					printf( '<script type="application/ld+json">%s</script>', $SchemaMarkup );
				}
			}

			if ( ! empty( $this->Settings['SchemaWebSite'] ) && is_front_page() )
			{
				$SchemaMarkupWebSite = apply_filters( 'hunch_schema_markup_website', $SchemaThing->getWebSite(), $PostType );

				if ( ! empty( $SchemaMarkupWebSite ) )
				{
					if ( $JSON )
					{
						$JSONSchemaMarkup[] = $SchemaMarkupWebSite;
					}
					else
					{
						printf( '<script type="application/ld+json">%s</script>', $SchemaMarkupWebSite );
					}
				}
			}

			if ( ! empty( $this->Settings['SchemaBreadcrumb'] ) && method_exists( $SchemaThing, 'getBreadcrumb' ) )
			{
				$SchemaMarkupBreadcrumb = apply_filters( 'hunch_schema_markup_breadcrumb', $SchemaThing->getBreadcrumb(), $PostType );

				if ( ! empty( $SchemaMarkupBreadcrumb ) )
				{
					if ( $JSON )
					{
						$JSONSchemaMarkup[] = $SchemaMarkupBreadcrumb;
					}
					else
					{
						printf( '<script type="application/ld+json">%s</script>', $SchemaMarkupBreadcrumb );
					}
				}
			}

			if ( $JSON && ! empty( $JSONSchemaMarkup ) )
			{
				print '[' . implode( '],[', $JSONSchemaMarkup  ) . ']';
			}
		}     
    }


	function LinkedOpenData( $WP )
	{
		if ( ! empty( $this->Settings['SchemaLinkedOpenData'] ) )
		{
			$RequestHeaders = array();

			if ( function_exists( 'apache_request_headers' ) )
			{
				$RequestHeaders = apache_request_headers();
			}

			// preg_match( '/\.jsonld$/i', $_SERVER['REQUEST_URI'] )
			if (  ( ! empty( $_GET['format'] ) && $_GET['format'] == 'jsonld' )  ||  ( ! empty( $RequestHeaders['Accept'] ) && $RequestHeaders['Accept'] == 'application/json' )  )
			{
				$this->hunch_schema_add( true );

				exit;
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


	function GenesisSetup()
	{
		$Attributes = get_option( 'schema_option_name_genesis' );

		if ( $Attributes )
		{
			foreach ( $Attributes as $Key => $Value )
			{
				add_filter( 'genesis_attr_' . $Key, array( $this, 'GenesisAttribute' ), 20 );
			}
		}
	}


	function GenesisAttribute( $Attribute )
	{
		$Attribute['itemtype'] = '';
		$Attribute['itemprop'] = '';
		$Attribute['itemscope'] = '';

		return $Attribute;
	}

}