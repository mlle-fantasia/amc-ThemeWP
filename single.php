<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>

<?php if (get_header()) ?>


<section>
    <div class="container-fluid singleTableau">
        <?php if (have_posts()): ?>
            <?php  while(have_posts()): the_post(); ?>
        <div class="container">
            <div class="titre">
                <div class="titreItem"><h1 class="front-page-titre mb-text-center"><?php the_title() ?></h1> <hr></div>
            </div>
        </div>
    </div>

    <div class="container">
            <div class="row">
                <div class="col-md-12 containerImage">

                    <?php
                    if($thumbnail_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')):
                        $thumbnail_src = $thumbnail_html[0];
                        ?>
                        <img src="<?php echo $thumbnail_src ?>" alt="image principale de l'article" class="img_100">
                    <?php endif; ?>
                </div>
            </div><!-- /row -->
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

    <div class="container-fluid singleTableau">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 containerInfoTableau">
                    <p><?php the_content() ?></p><hr>
                    <p>
                        <?php
                            echo mb_get_meta_date_cat(  esc_attr(get_the_date('c')), //récupère la date au format iso
                                esc_html(get_the_date()),      //récupère la date au format demandé dans wp
                                get_the_category_list(', '), //récupère la liste des cat de l'article sous forme de lien
                                get_the_tag_list('', ', '));  //récupère la liste des tag de l'article sous forme de lien
                        ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>


<section>

    <?php get_template_part('slider', 'galerie'); ?>


</section>

<?php if (get_footer()) ?>

</body>
</html>