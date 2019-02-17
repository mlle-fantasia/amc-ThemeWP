<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php get_header(); ?>
<?php get_template_part('slider', 'home'); ?>

<?php
    $theme_opts = get_option('mb_opts');
    $theme_opts_artiste = get_option('mb_opts_artiste');

?>
<section>
    <div class="container">
        <h2 class="front-page-titre mb-text-center">L'artiste</h2><hr>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $theme_opts_artiste["image_artiste_url"] ?>" alt="photo de l'artiste" class="mb-width-100">
            </div>
            <div class="col-md-6">
                <p><strong><?php echo $theme_opts_artiste["accroche_artiste"] ?></strong></p>
                <p><?php echo $theme_opts_artiste["bio_artiste"] ?></p>
            </div>
        </div>
    </div>
</section>

<section>
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
    $contenu = '<section>
                    <div class="container">
                        <h2 class="front-page-titre mb-text-center">'. $titre .'</h2><hr>
                        <h4 class="mb-text-center">'.$theme_opts["titre_expo"].'</h4>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <img src="'. $theme_opts["image_expo_url"].'" alt="'. $theme_opts["description_expo"].'" class="mb-width-100">
                            </div>
                            <div class="col-md-2">
                                <p><strong>Date : </strong><br>  du '.$theme_opts["date_debut_expo"].' <br> au '. $theme_opts["date_fin_expo"].'</p>
                                <p><strong>Lieu : </strong><br>'. $theme_opts["lieu_expo"].'</p>
                                <p><strong>Description : </strong><br>'. $theme_opts["description_expo"].'</p>
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