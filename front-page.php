<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php get_header(); ?>
<?php get_template_part('slider', 'home'); ?>

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


<?php $theme_opts = get_option('mb_opts'); ?>
<section>
    <div class="container">

<!--        --><?php
//
//            if($theme_opts['date_expo']):
//
//        ?>

        <h2 class="front-page-titre mb-text-center">Prochaine Exposition</h2>
        <h4 class="mb-text-center"><?php echo $theme_opts['titre_expo']; ?></h4>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img src="<?php echo $theme_opts['image_expo_url']; ?>" alt="<?php echo $theme_opts['description_expo']; ?>" class="mb-width-100">
            </div>
            <div class="col-md-2">
                <p><strong>Date : </strong><br>  du <?php echo $theme_opts['date_debut_expo']; ?> <br> au <?php echo $theme_opts['date_fin_expo']; ?></p>
                <p><strong>Lieu : </strong><br><?php echo $theme_opts['lieu_expo']; ?></p>
                <p><strong>Description : </strong><br><?php echo $theme_opts['description_expo']; ?></p>
            </div>
        </div>


    </div>
</section>


<?php get_footer(); ?>

</body>
</html>