<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php get_header(); ?>
<?php get_template_part('slider', 'home'); ?>

<?php
    $theme_opts = get_option('mb_opts');
    $theme_opts_artiste = get_option('mb_opts_artiste');

?>
<section class="section artiste">
    <div class="container">
        <h2 class="front-page-titre mb-text-center">L'artiste</h2><hr>
        <div class="row">
            <img src="<?php echo $theme_opts_artiste["image_artiste_url"] ?>" alt="photo de l'artiste" class="mb-width-100">
            <p class="mb-text-center"><strong><?php echo $theme_opts_artiste["accroche_artiste"] ?></strong></p>
            <p class="mb-text-center"><?php echo $theme_opts_artiste["bio_artiste"] ?></p>
        </div>
    </div>
</section>
<section class=" section galerie">
    <div class="container">
        <?php if (have_posts()):
            while(have_posts()): the_post(); ?>
                <div class="row">
                    <div class="col-md-12">

                        <?php the_title('<h1>', '</h1>'); the_content(); ?>
                    </div>
                </div>
           <?php endwhile; ?>

        <?php else:?>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        pas d'articles ici
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div><!-- /container -->
</section>


<?php
    $date = date('Y-m-j');
    if($theme_opts['date_debut_expo'] < $date && $date < $theme_opts['date_fin_expo'] ){
        $titre = 'Exposition en cours';
    }
    if($date < $theme_opts['date_debut_expo'] ){
        $titre = 'Prochaine exposition';
    }
    $contenu = '<section class="section expo">
                    <div class="container">
                        <h2 class="front-page-titre mb-text-center">'. $titre .'</h2><hr>
                        <h4 class="mb-text-center">'.$theme_opts["titre_expo"].'</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="'. $theme_opts["image_expo_url"].'" alt="'. $theme_opts["description_expo"].'" class="mb-width-100">
                            </div>
                        </div>    
                        <div class="row mb-infoExpo">
                            <div class="col-md-8">
                                <p class="mb-text-center"><strong class="mb-titreinfoExpo">Description : </strong><br>'. $theme_opts["description_expo"].'</p>
                            </div>
                            <div class="col-md-4">
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