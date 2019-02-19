<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>

    <?php get_header(); ?>

    <?php
        $section = '';
        $currentPage = home_url( $wp->request );
        if($currentPage == 'http://amc/me-contacter'){
            $section = 'contact';
            $titre = 'Contactez-moi';
        }
        if($currentPage == 'http://amc/mentions-legales'){
            $titre = 'Mentions légales';
        }
    ?>

        <section class="section <?php echo $section; ?>">
            <div class="container">
                <h2 class="front-page-titre mb-text-center"><?php echo $titre; ?></h2><hr>
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/contact.jpg" alt="image de pinceaux posés sur une peinture" class="mb-width-100">
                    </div>
                </div>

                <?php if (have_posts()):
                    while(have_posts()): the_post();

                     the_content();

                 endwhile; ?>

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

    <?php if (get_footer()) ?>

    </body>
</html>