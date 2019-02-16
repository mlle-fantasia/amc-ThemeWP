<?php

function mb_save_options(){

    if(!current_user_can('publish_pages')){
        wp_die('vous n\'êtes pas autorisé à éffectuer cette oppération');
    }
    check_admin_referer('mb_options_verify');

    $opts = get_option('mb_opts');
    var_dump($opts);

    //sauvegarde légende
    $opts['legend_01'] = sanitize_text_field($_POST["mb_legend_01"]);

    //sauvegarde image
    $opts['image_01_url'] = sanitize_text_field($_POST["mb_image_url_01"]);

    //sauvegarde image expo
    $opts['image_expo_url'] = sanitize_text_field($_POST["mb_image_url_expo"]);

    //sauvegarde image vignette expo
    $opts['image_expo_url_thumbnail'] = sanitize_text_field($_POST["mb_image_url_expo_thumbnail"]);

    //sauvegarde date expo
    $opts['date_expo'] = sanitize_text_field($_POST["mb_date_expo"]);

    //sauvegarde titre expo
    $opts['titre_expo'] = sanitize_text_field($_POST["mb_titre_expo"]);

    //sauvegarde lieu expo
    $opts['lieu_expo'] = sanitize_text_field($_POST["mb_lieu_expo"]);

    //sauvegarde description expo
    $opts['description_expo'] = sanitize_text_field($_POST["mb_description_expo"]);

    update_option('mb_opts', $opts);

    wp_redirect(admin_url('admin.php?page=mb_theme_opts&status=1'));
    exit;

} // fin de la function mb_save_options()