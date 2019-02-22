<?php
//
//$postsParPage = '';
//if(!isset($_GET['r']))
//{
//    echo "<script language=\"JavaScript\"> document.location=\"$PHP_SELF?r=1&Largeur=\"+screen.width;</script>";
//}
//
//// Code à afficher en cas de détection de la résolution d'affichage
//    if (isset($_GET['Largeur'])) {
//// Résolution détectée
//        if ($_GET['Largeur'] > 1780) {
//            $postsParPage = 4;
//        }
//        if ($_GET['Largeur'] < 1780) {
//            $postsParPage = 3;
//        }
//        if ($_GET['Largeur'] < 1250) {
//            $postsParPage = 2;
//        }
//        if ($_GET['Largeur'] < 1000) {
//            $postsParPage = 1;
//        }
//    } else {
//// Résolution non détectée
//        $postsParPage = 4;
//    }
//
//// calcule de l'offset en fonction du numéro de la page dans l'url
//if(isset($_GET['Page'])) {
//    $page = (int)$_GET['Page'];
//    $offsetTableau = $postsParPage*($page-1);
//}

$args= array(
    'paged' => $paged,
    'post_type' => 'post',
    'posts_per_page' => 4,
//    'offset' => $offsetTableau,
    'order' => 'DESC', // 'ASC'
    'orderby' => 'date' // modified | title | name | ID | rand
);

$my_query = new WP_Query($args);

//// Pagination fix
//$temp_query = $wp_query;
//$wp_query   = NULL;
//$wp_query   = $my_query;

?>
<?php if ( $my_query ->have_posts() ): ?>

<div class="container-fluid" id="slideGalerie">
    <div class="row">
        <input type="text" id="nbPosts" value="<?php echo $my_query->found_posts?>" hidden >
        <input type="text" id="nbPostsParPage" value="<?php echo $my_query->query_vars['posts_per_page'] ?>" hidden >
        <div class="containerSliderGalerie <?php echo $paged ?>">

        <button class="page prec precedent" id="">
            Tableaux précédents
        </button>
            <?php
            while($my_query ->have_posts()):
                $my_query ->the_post();
                $tableau_src = '';
                if($image_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'tableau')) {
                    $tableau_src = $image_html[0];
                }

                ?>

                <div class="panel">

                    <div class="panel-image">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $tableau_src ?>" alt="image du tableau <?php echo $tableau_src; ?>"></a>
                        <!--                        --><?php //the_post_thumbnail('medium', array('class'=>'mb-width-100')) ?>
                    </div>
                    <div class="panel-footer">
                        <h2 class="mb-text-center"><?php the_title(); ?></h2>

                    </div>
                </div>


            <?php endwhile; ?>
            <button class="page suiv suivant" id="">
                Tableaux suivants
            </button>

        </div>

    </div>

<!--    boutton de controle de page galerie pour des écrans de moins de 700px-->
    <div class="row containerControlPage700">
        <button class="page prec700 precedent" id="">
            Tableaux suivants
        </button>
        <button class="page suiv700 suivant" id="">
            Tableaux suivants
        </button>
    </div>

</div>

<?php endif;
wp_reset_postdata();


//// Reset main query object
//$wp_query = NULL;
//$wp_query = $temp_query;

?>