jQuery(document).ready(function ($) {
    var mediaUploader;

    //// 
    // Upload Publisher Logo Settings Page
    $('#publisher_image_button').click(function (e) {
        e.preventDefault();
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function () {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#publisher_image').val(attachment.url);
        });
        // Open the uploader dialog
        mediaUploader.open();
    });

    // Tab based navigation on settings page
    $( '.wrap .nav-tab-wrapper a' ).click( function( e )
    {
        e.preventDefault();

		var Elm = $( this );

		Elm.blur();

		$( '.wrap .nav-tab-wrapper a' ).removeClass( 'nav-tab-active' );
		$( '.wrap .nav-tab-wrapper a' ).eq( Elm.index() ).addClass( 'nav-tab-active' );

        $('.wrap section').hide();
        $('.wrap section').eq(Elm.index()).show();
    });

    // Switch to a specific tab on page load
    function schemaLoadSwitchTab() {
        var tabIndex = 1;                               // Default to Settings tab
        $( "section[id^='schema-app']" ).each(function (index) {
            if ($(this)[0].id === schemaData.tab) {
                tabIndex = index;
            }
        });
        $( "section[id^='schema-app']" ).hide();
        $( "section[id^='schema-app']" ).eq(tabIndex).show();
    };

    schemaLoadSwitchTab();

});