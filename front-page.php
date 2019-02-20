<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php get_header(); ?>
<?php //get_template_part('slider', 'home'); ?>

<?php
    $theme_opts = get_option('mb_opts');
    $theme_opts_artiste = get_option('mb_opts_artiste');

?>
<section class="section artiste" id="artiste">
    <div class="container-fluid">
        <h2 class="front-page-titre mb-text-center">L'artiste</h2><hr>
        <div class="infoArtiste">
            <img src="<?php echo $theme_opts_artiste["image_artiste_url"] ?>" alt="photo de l'artiste" class="mb-width-100">
            <div class="container mb-container-info-artiste col-md-4">
                <p class="mb-text-center"><strong><?php echo $theme_opts_artiste["accroche_artiste"] ?></strong></p>
                <p class="mb-text-center"><?php echo $theme_opts_artiste["bio_artiste"] ?></p>
            </div>
        </div>
    </div>
</section>


<?php
$paged = (get_query_var ('paged'))? get_query_var ('paged'): 1;
$args= array(
    'post_type' => 'post',
    'paged' => $paged
);
$my_query = new WP_Query($args);

?>

<?php if ( $my_query ->have_posts() ): ?>

<section class=" section galerie" id="galerie">
    <div class="container">
        <h2 class="front-page-titre mb-text-center">Galerie de tableaux</h2><hr>
        <div class="row container-panels">


            <?php
                while($my_query ->have_posts()): $my_query ->the_post() ;
                $tableau_src = '';
                if($image_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'tableau')) {
                    $tableau_src = $image_html[0];
                }
            ?>
<!--                <div class="col-md-4 col-sm-6">-->
                    <div class="panel">

                        <div class="panel-image">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $tableau_src ?>" alt="image du tableau <?php echo $tableau_src; ?>"></a>
    <!--                        --><?php //the_post_thumbnail('medium', array('class'=>'mb-width-100')) ?>
                        </div>
                        <div class="panel-footer">
                            <h2 class="mb-text-center"><?php the_title(); ?></h2>
                            <p class="mb-text-center"><?php the_excerpt_max_charlength(140); ?></p>

                        </div>
                    </div>

<!--                </div>-->

            <?php endwhile; ?>


        </div>
    </div><!-- /container -->
</section>

<?php endif; ?>


<!--<section class=" section galerie" id="galerie">-->
<!--    <div class="container">-->
<!--        --><?php //if (have_posts()):
//            while(have_posts()): the_post(); ?>
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!---->
<!--                        --><?php //the_title('<h1>', '</h1>'); the_content(); ?>
<!--                    </div>-->
<!--                </div>-->
<!--           --><?php //endwhile; ?>
<!---->
<!--        --><?php //else:?>
<!--            <div class="row">-->
<!--                <div class="col-md-12">-->
<!--                    <p>-->
<!--                        pas d'articles ici-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        --><?php //endif; ?>
<!--    </div><!-- /container -->
<!--</section>-->


<?php
    $date = date('Y-m-j');
    if($theme_opts['date_debut_expo'] < $date && $date < $theme_opts['date_fin_expo'] ){
        $titre = 'Exposition en cours';
    }
    if($date < $theme_opts['date_debut_expo'] ){
        $titre = 'Prochaine exposition';
    }
    $contenu = '<section class="section expo" id="expo">
                    <div class="container-fluid">
                        <h2 class="front-page-titre mb-text-center">'. $titre .'</h2><hr>
                        <h4 class="mb-text-center">'.$theme_opts["titre_expo"].'</h4>
                        <div class="container-image">
                            <img src="'. $theme_opts["image_expo_url"].'" alt="'. $theme_opts["description_expo"].'" class="mb-width-100"> 
                        </div>   
                        <div class="row mb-infoExpo">
                            <div class="col-md-2 mb-descriptionExpo">
                                <p class="mb-text-center"><strong class="mb-titreinfoExpo">Description : </strong><br>'. $theme_opts["description_expo"].'</p>
                            </div>
                            <div class="col-md-2 mb-dateExpo">
                                <p class="mb-text-center"><strong class="mb-titreinfoExpo">Date : </strong><br>  du '.$theme_opts["date_debut_expo"].' au '. $theme_opts["date_fin_expo"].'</p>
                                <p class="mb-text-center"><strong class="mb-titreinfoExpo">Lieu : </strong><br>'. $theme_opts["lieu_expo"].'</p>  
                            </div>
                        </div>
                    </div>
                </section>';

    if($theme_opts['date_fin_expo']< $date){
        $contenu ='';
    }
 ?>

<?php echo $contenu ?>

<?php get_footer(); ?>

</body>
</html>