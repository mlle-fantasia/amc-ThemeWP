<?php

//==================================================
// ===========   chargement des scripts
//==================================================

define('MB_VERSION','1.0.0');

// ajout ses styles et des script dans mon thème
function mb_scripts(){
    wp_enqueue_style('mb_bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), 'MB_VERSION', 'all');

    wp_enqueue_style('mb_custom', get_template_directory_uri().'/style.css', array('mb_bootstrap'), 'MB_VERSION', 'all');

    wp_enqueue_script('mb_bootstrap_js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), 'MB_VERSION', true);

    wp_enqueue_script('mb_custom_js', get_template_directory_uri().'/js/marinabay.js', array('jquery', 'mb_bootstrap_js'), 'MB_VERSION', true);
}

add_action('wp_enqueue_scripts', 'mb_scripts');



// Ajout ses styles et script dans l'administration de wp
//======================================================================

function mb_admin_init()
{

    //action 1 : ajout de bootstrap
    function mb_admin_scripts()
    {
        if (!isset($_GET['page']) || $_GET['page'] != "mb_theme_opts") {
            return;
        }
        wp_enqueue_style('mb_admin_custom', get_template_directory_uri().'/css/admin-style.css', array('mb_admin_bootstrap'), 'MB_VERSION', 'all');

        wp_enqueue_style('mb_admin_bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'MB_VERSION', 'all');

        //chargement des script admin
        wp_enqueue_media();
        wp_enqueue_script('mb-admin-int', get_template_directory_uri() . '/js/admin-options.js', array(), MB_VERSION, true);

    }
    add_action('admin_enqueue_scripts', 'mb_admin_scripts');


    include('includes/save_options-page.php'); //contient les fonctions de sauvegarde des options

    //action 2 : ajout options logo
    add_action('admin_post_mb_save_options', 'mb_save_options');

    //action 3 : ajout options expo
    add_action('admin_post_mb_save_options_expo', 'mb_save_option_expo');

    //action 4 : ajout options artiste
    add_action('admin_post_mb_save_options_artiste', 'mb_save_option_artiste');


}

add_action('admin_init', 'mb_admin_init');


//==================================================
// ===========   utilitaires
//==================================================

function mb_setup(){

    //permet d'ajouter un image à la une sur les articles
    add_theme_support('post-thumbnails');

    // creer format image slider front
    add_image_size('front-slider', 1140, 420, true);

    //enlève le générateur de version
    remove_action('wp_head', 'wp_generator');

    //enlever les guillemets à la française
    //remove_filter('the_content', 'wptexturize');

    // ajoute le titre
    add_theme_support('title-tag');

    //lier le menu wp avec la structure bootstrap
    require_once('includes/class-wp-bootstrap-navwalker.php');

    //active menu
    register_nav_menus(array(
            'primary'=> 'principal',
            'footer_menu' => 'Footer Menu',
    ));
}

add_action('after_setup_theme', 'mb_setup' );


//=================================================================
// ===========   ajoute un taille medium large dans la selection des images
//=================================================================

function my_image_size($sizes){
    $addsizes = array(
        "medium_large" => "Medium Large"
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}

add_filter('image_size_names_choose', 'my_image_size' );


//=================================================================
// ===========  activation d'option
//=================================================================
//création de l'option une seule fois quand on change de theme grace au hook : after_switch_theme
function mb_activ_options(){

    $theme_opt = get_option('mb_opts');
    if(!$theme_opt){       // pour le pas recréer l'option a chaque rendu on test si elle existe déjà
        $opts = array(
            'image_01_url' =>'',
            'image_expo_url' => '',
            'image_expo_url_thumbnail' => '',
            'date_debut_expo' => '',
            'date_fin_expo' => '',
            'lieu_expo' => '',
            'description_expo' => '',
            'titre_expo' => ''
        );
        add_action('mb_opts', $opts);
    }

    $theme_opt_artiste = get_option('mb_opts_artiste');
    if(!$theme_opt_artiste){
        $opts_artiste = array(
            'photo_artiste_url' =>'',
            'photo_artiste_url_thumbnail' => '',
            'accroche_artiste' =>'',
            'bio_artiste' => ''
        );
        add_action('mb_opts_artiste', $opts_artiste);
    }

}

add_action('after_switch_theme', 'mb_activ_options');


//=================================================================
// ===========  ajouter l'option de menu dans l'administration
//=================================================================

function mb_admin_menu(){

    add_menu_page(
        'marinabay Option',
        'options du theme',  // titre affiché
        'publish_pages',     // accessibilité de l'utilisateur : ok pour l'éditeur
        'mb_theme_opts',     //slug
        'mb_build_option_page'  // fonction appelée
    );

    include('includes/build-options-page.php');
}

add_action('admin_menu', 'mb_admin_menu');


//=================================================================
// ===========  ajouter l'option des widgets dans l'administration
//=================================================================

function mb_admin_widget() {
    register_sidebar(array(
        'name'          =>'Footer Widget Zone',
        'description'   =>'widget affichés dans le footer : 4 au maximum',
        'id'            =>'widgetized-footer',
        'before_widget' =>'<div id="%1$s" class="%2$s" ><div class="inside-widget"> ',
        'after_widget'  =>'</div></div>',
        'before_title'  =>'<h2 class=""> ',
        'after_title'   =>'</h2>'
    ));

}
add_action('widgets_init', 'mb_admin_widget');




//=================================================================
//=================================================================
//============      Fonctions d'affichage
//=================================================================
//=================================================================


//=================================================================
// ===========   affichage de la date et des catégories
//=================================================================

function mb_get_meta_date_cat($date1, $date2, $cat, $tags){

    $chaine = 'publié le <time class="entry-date" datetime="';
    $chaine .= $date1;
    $chaine .= '">';
    $chaine .= $date2;
    $chaine .= '</time> dans la catégorie : ';
    $chaine .= $cat;
    if(strlen($tags)>0):
        $chaine .= ' avec les étiquettes : '.$tags;
    endif;
    return $chaine;
}

//=================================================================
// ===========   modifie le texte de suite de l'excerpt
//=================================================================

function mb_excerpt_more($more){
    return'<a class="more-link" href="'.get_permalink().'">' .' [lire la suite]'.'</a>';
}

add_filter('excerpt_more','mb_excerpt_more' );



//=================================================================
// ===========  ajouter pagination
//=================================================================

function mb_pagination()
{
    global $wp_query;
    $big = 999999999; // need an unlikely intege
    $total_page = $wp_query->max_num_pages;

    if ($total_page > 1): ?>
        <div class="col-md-12 mb-pagination">
            <?php echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $total_page,
                'prev_next' => true,
                'prev_text' => '<- Page pécédente ',
                'next_text' => ' Page suivante ->',
            )); ?>
        </div>
    <?php endif;
}


//=================================================================
// ===========  cpt slider frontal front page
//=================================================================

function mb_front_slider_init() {
    $labels = array(
        'name'               =>  'images carousel accueil',
        'singular_name'      =>  'image accueil',
        'menu_name'          =>  'carousel accueil',
        'name_admin_bar'     =>  'carousel accueil',
        'add_new'            =>  'Add image',
        'add_new_item'       =>  'Add New image',
        'new_item'           =>  'New image',
        'edit_item'          =>  'Edit image',
        'view_item'          =>  'View image',
        'all_items'          =>  'All images',
        'search_items'       =>  'Search images',
        'parent_item_colon'  =>  'Parent images:',
        'not_found'          =>  'No images found.',
        'not_found_in_trash' =>  'No images found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => get_stylesheet_directory_uri().'/assets/croissant.png',
        'publicly_queryable' => false,
        'exclude_from_search'=> true,
        'supports'           => array( 'title', 'page-attributes', 'thumbnail' )
    );

    register_post_type( 'mb_slider', $args );
}

add_action( 'init', 'mb_front_slider_init' );


// ===========  ajout image et ordre pour slider
//=================================================================

add_filter('manage_edit-mb_slider_columns', 'mb_col_change'); //change nom colonnes

function mb_col_change($columns){
    $columns['mb_slider_image_order'] = "ordre";
    $columns['mb_slider_image'] = "image";

    return $columns;
}

add_action('manage_mb_slider_posts_custom_column', 'mb_content_show', 10, 2); //affichage du contenu des colonnes

function mb_content_show($column, $post_id){
    global $post;
    if($column == 'mb_slider_image'){
        echo the_post_thumbnail(array(200,100));
    }
    if($column == 'mb_slider_image_order'){
        echo $post ->menu_order;
    }
}

// ===========  trie auto ordre slider front
//=================================================================

 function  mb_change_slides_ordrer ($query){
    global $post_type, $pagenow;

    if($pagenow == 'edit.php' && $post_type == 'mb_slider'){
        $query -> query_vars['orderby'] = 'menu_order';
        $query -> query_vars['order'] = 'asc';
    }
}
add_action('pre_get_posts', 'mb_change_slides_ordrer');
