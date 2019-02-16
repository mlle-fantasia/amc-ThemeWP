jQuery(document).ready(function($){

    if ($('.alert-success')){
        $('.alert-success').hide();
    }

    //************* ajout logo  **************

    var frame = wp.media({
        title: 'selectionner une image',
        button: {
            text: 'Utiliser ce média'
        },
        multiple: false
    });

    $("#form-mb-options #btn_img_01").click(function(e){
        e.preventDefault();
        frame.open();
    });

    frame.on( 'select', function() {

        var objImg = frame.state().get('selection').first().toJSON();
        var img_url = objImg.sizes.full.url;

        $("img#img_preview_01").attr('src', img_url);
        $("input#mb_image_01").attr('value', img_url);
        $("input#mb_image_url_01").attr('value', img_url);
    });



    //************* ajout expo **************


    var frameExpo = wp.media({
        title: 'selectionner une image',
        button: {
            text: 'Utiliser ce média'
        },
        multiple: false
    });

    $("#form-mb-options-expo #btn_img_expo").click(function(e){
        e.preventDefault();
        frameExpo.open();
    });

    frameExpo.on( 'select', function() {

        var objImg = frameExpo.state().get('selection').first().toJSON();
        var img_full_url = objImg.sizes.full.url;
        var img_thumbnail_url = objImg.sizes.thumbnail.url;

        $("img#img_preview_expo").attr('src', img_thumbnail_url);
        $("input#mb_image_expo").attr('value', img_full_url);
        $("input#mb_image_url_expo").attr('value', img_full_url);
        $("input#mb_image_url_expo_thumbnail").attr('value', img_thumbnail_url);

    });




});