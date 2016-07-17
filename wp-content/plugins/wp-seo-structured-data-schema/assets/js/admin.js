(function($){
    'use strict';
    $('.kcseo-date').datepicker({
        dateFormat : 'yy-mm-dd'
    });
    showHideType();
    $("#site_type").change(function(){
        showHideType();
    });

    $(".select2").select2({
        placeholder: "Select an item",
        theme: "classic",
        dropdownAutoWidth : true
    });

    $(".field-content .select2").select2({
        theme: "classic",
        dropdownAutoWidth : true,
        width: '100%'
    });

    $(".social-remove").on('click', function(){
        $(this).parent('.sfield').slideUp('slow').remove();
    });

    $("#social-add").on('click', function(){
        var bindElement = jQuery("#social-add");
        var count = $("#social-field-holder .sfield").length;
        var arg = 'id='+count;
        AjaxCall( bindElement, 'newSocial', arg, function(data){
            if(data.data){
                console.log(data.data);
                $("#social-field-holder").append(data.data);
            }
        });
    });

    $('.schema-tooltip').each(function() { // Notice the .each() loop, discussed below
        $(this).qtip({
            content: {
                text: $(this).next('div') // Use the "div" element next to this for the content
            },
            hide: {
                fixed: true,
                delay: 300
            }
        });
    });
    $(document).ready(function() {
        $(".rt-tab-nav li:first-child a").trigger('click');
    });
    $(".rt-tab-nav li").on('click', 'a', function(e){
        e.preventDefault();
        var container = $(this).parents('.rt-tab-container');
        var nav = container.children('.rt-tab-nav');
        var content = container.children(".rt-tab-content");
        var $this, $id;
        $this = $(this);
        $id = $this.attr('href');
        content.hide();
        nav.find('li').removeClass('active');
        $this.parent().addClass('active');
        container.find($id).show();
    });

})(jQuery);


function showHideType(){
    var id =  jQuery("#site_type option:selected").val();
    if(id == "Person"){
        jQuery(".form-table tr.person").show();
    }else{
        jQuery(".form-table tr.person").hide();
    }
    if(id == "Organization"){
        jQuery(".form-table tr.business-info").hide();
    }else{
        jQuery(".form-table tr.business-info").show();
    }
}
function wpSchemaSettings(e){

    jQuery('#response').hide();
    arg=jQuery( e ).serialize();
    bindElement = jQuery('#tlpSaveButton');
    AjaxCall( bindElement, 'kcSeoWpSchemaSettings', arg, function(data){
        console.log(data);
        jQuery('#response').addClass('updated');
        if(!data.error){
            jQuery('#response').removeClass('error');
            jQuery('#response').show('slow').text(data.msg);
        }else{
            jQuery('#response').addClass('error');
            jQuery('#response').show('slow').text(data.msg);
        }
    });

}

function AjaxCall( element, action, arg, handle){
    if(action) data = "action=" + action;
    if(arg)    data = arg + "&action=" + action;
    if(arg && !action) data = arg;
    data = data ;

    jQuery.ajax({
        type: "post",
        url: ajaxurl,
        data: data,
        beforeSend: function() { jQuery("<span class='wseo_loading'></span>").insertAfter(element); },
        success: function( data ){
            jQuery(".wseo_loading").remove();
            handle(data);
        }
    });
}
