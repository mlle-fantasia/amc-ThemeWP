<?php

function mb_save_options(){

    if(!current_user_can('publish_pages')){ // verifie que l'utilisateur a les bon accès
        wp_die('vous n\'êtes pas autorisé à éffectuer cette oppération');
    }
    check_admin_referer('mb_options_verify'); // verifie que la personnes est autorisé

    $opts = get_option('mb_opts');

    //sauvegarde image
    $opts['image_01_url'] = sanitize_text_field($_POST["mb_image_url_01"]);


    update_option('mb_opts', $opts);

    wp_redirect(admin_url('admin.php?page=mb_theme_opts&status=1'));
    exit;

} // fin de la function mb_save_options()



function mb_save_option_expo(){

    if(!current_user_can('publish_pages')){
        wp_die('vous n\'êtes pas autorisé à éffectuer cette oppération');
    }
    check_admin_referer('mb_options_verify');

    $opts = get_option('mb_opts');

    //sauvegarde image expo
    $opts['image_expo_url'] = sanitize_text_field($_POST["mb_image_url_expo"]);

    //sauvegarde image vignette expo
    $opts['image_expo_url_thumbnail'] = sanitize_text_field($_POST["mb_image_url_expo_thumbnail"]);

    //sauvegarde date expo
    $opts['date_debut_expo'] = sanitize_text_field($_POST["mb_date_debut_expo"]);
    $opts['date_fin_expo'] = sanitize_text_field($_POST["mb_date_fin_expo"]);

    //sauvegarde titre expo
    $opts['titre_expo'] = sanitize_text_field($_POST["mb_titre_expo"]);

    //sauvegarde lieu expo
    $opts['lieu_expo'] = sanitize_text_field($_POST["mb_lieu_expo"]);

    //sauvegarde description expo
    $opts['description_expo'] = sanitize_text_field($_POST["mb_description_expo"]);

    update_option('mb_opts', $opts);

    wp_redirect(admin_url('admin.php?page=mb_theme_opts&status=2'));
    exit;

} // fin de la function mb_save_options_expo


function mb_save_option_artiste(){

    if(!current_user_can('publish_pages')){
        wp_die('vous n\'êtes pas autorisé à éffectuer cette oppération');
    }
    check_admin_referer('mb_options_verify');

    $opts = get_option('mb_opts_artiste');

    //sauvegarde image expo
    $opts['image_artiste_url'] = sanitize_text_field($_POST["mb_image_url_artiste"]);

    //sauvegarde image vignette expo
    $opts['image_artiste_url_thumbnail'] = sanitize_text_field($_POST["mb_image_url_artiste_thumbnail"]);

    //sauvegarde accroche
    $opts['accroche_artiste'] = sanitize_text_field($_POST["mb_accroche_artiste"]);

    //sauvegarde bio
    $opts['bio_artiste'] = sanitize_text_field($_POST["mb_bio_artiste"]);



    update_option('mb_opts_artiste', $opts);

    wp_redirect(admin_url('admin.php?page=mb_theme_opts&status=3'));
    exit;

} // fin de la function mb_save_options_expo