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
        <h2 class="front-page-titre mb-text-center">Prochaine Exposition</h2>
        <div class="row">
            <div class="col-md-3">
                <p><?php echo $theme_opts['titre_expo']; ?></p>
            </div>
            <div class="col-md-3">
                <p>Date : <?php echo $theme_opts['date_expo']; ?></p>
            </div>
            <div class="col-md-3">
                <div class="detail-expo">
                    <p>Lieu : <?php echo $theme_opts['lieu_expo']; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Description : <?php echo $theme_opts['description_expo']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo $theme_opts['image_expo_url']; ?>" alt="<?php echo $theme_opts['description_expo']; ?>" class="mb-width-100">
            </div>
        </div>

    </div>
</section>


<?php get_footer(); ?>

</body>
</html>