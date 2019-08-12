<?php



if ( is_admin() ) {

	add_action( 'admin_menu', 'wpgpxmaps_admin_menu' );

}



function wpgpxmaps_admin_menu() {

	/*

	All roles/capabilities:

	https://wordpress.org/support/article/roles-and-capabilities/

	*/

	if ( current_user_can( 'manage_options' ) ) {
		/* Only Administrators and Super Administrators */
		add_options_page( 'WP GPX Maps', 'WP GPX Maps', 'manage_options', 'WP-GPX-Maps', 'WP_GPX_Maps_html_page' );

	}
	elseif ( current_user_can( 'publish_posts' ) ) {
		/* Contributor Authors and */

		$allow_users_upload 	= get_option( 'wpgpxmaps_allow_users_view' ) === "true";

		if ($allow_users_upload == 1)
		{
			add_menu_page( 'WP GPX Maps', 'WP GPX Maps', 'publish_posts', 'WP-GPX-Maps', 'WP_GPX_Maps_html_page' );
		}

	}

}



function wpgpxmaps_ilc_admin_tabs( $current  ) {

	if ( current_user_can( 'manage_options' ) ) {

		$tabs = array(
			'tracks'   => __( 'Tracks', 'wp-gpx-maps' ),
			'settings' => __( 'Settings', 'wp-gpx-maps' ),
			'help'     => __( 'Help', 'wp-gpx-maps' ),
		);
	} elseif ( current_user_can( 'publish_posts' ) ) {

		$tabs = array(
			'tracks' => __( 'Tracks', 'wp-gpx-maps' ),
			'help'   => __( 'Help', 'wp-gpx-maps' ),
		);
	}

	echo '<h2 class="nav-tab-wrapper">';

	foreach ( $tabs as $tab => $name ) {

	$class = ( $tab == $current ) ? ' nav-tab-active' : '';

		echo "<a class='nav-tab$class' href='?page=WP-GPX-Maps&tab=$tab'>$name</a>";

	}

	echo '</h2>';

}



function WP_GPX_Maps_html_page() {

	$realGpxPath = gpxFolderPath();

	$cacheGpxPath = gpxCacheFolderPath();

	$relativeGpxPath = relativeGpxFolderPath();

	$relativeGpxPath = str_replace( "\\","/", $relativeGpxPath );

	$relativeGpxCachePath = relativeGpxCacheFolderPath();

	$relativeGpxCachePath = str_replace( "\\","/", $relativeGpxCachePath );

	$tab = $_GET['tab'];


	if ( $tab == '' )

		$tab = 'tracks';

	?>

	<div id="icon-themes" class="icon32"><br></div>

		<h2><?php _e( 'Settings', 'wp-gpx-maps' ); ?></h2>

	<?php

	if ( file_exists( $realGpxPath ) && is_dir( $realGpxPath ) ) {

		/* Directory exist! */

	} else {

		if ( ! @mkdir( $realGpxPath, 0755, true ) ) {
			echo '<div class=" notice notice-error"><p>';
			printf(
				/* translators: Relative path of the GPX folder */
				__( 'Can not create the folder %1s for GPX files. Please create the folder and make it writable! If not, you will must update the files manually!', 'wp-gpx-maps' ),
				'<span class="code"><strong>' . esc_html( $relativeGpxPath ) . '</strong></span>'
			);
			echo '</p></div>';
		}
	}

	if ( file_exists( $cacheGpxPath ) && is_dir( $cacheGpxPath ) ) {

		/* Directory exist! */

	} else {

		if ( ! @mkdir( $cacheGpxPath, 0755, true ) ) {
			echo '<div class=" notice notice-error"><p>';
			printf(
				/* translators: Relative path of the GPX cache folder */
				__( 'Can not create the cache folder %1s for the GPX files. Please create the folder and make it writable! If not, you will must update the files manually!', 'wp-gpx-maps' ),
				'<span class="code"><strong>' . esc_html( $relativeGpxCachePath ) . '</strong></span>'
			);
			echo '</p></div>';
		}
	}

	wpgpxmaps_ilc_admin_tabs( $tab );

	if ( $tab == 'tracks' ) {
		include 'wp-gpx-maps_admin_tracks.php';

	} elseif ( $tab == 'settings' ) {
		include 'wp-gpx-maps_admin_settings.php';

	} elseif ( $tab == 'help' ) {
		include 'wp-gpx-maps_help.php';
	}
}

?>
