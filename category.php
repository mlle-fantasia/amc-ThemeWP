<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php if (get_header()) ?>


<?php if (have_posts()): ?>

<section class=" section galerie">
    <div class="container">
    <h2 class="front-page-titre mb-text-center">Les <?php single_cat_title('', true); ?></h2><hr>

        <div class="row container-panels">

            <?php
                while(have_posts()): the_post();
                $tableau_src = '';
                if($thumbnail_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'tableau')){
                    $tableau_src = $thumbnail_html[0];
                }
                ?>
                <div class="panel">
                    <div class="panel-image">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $tableau_src ?>" alt="image du tableau <?php echo the_title(); ?>"></a>
                    </div>
                    <div class="panel-footer">
                        <h2 class="mb-text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="mb-text-center"><?php the_excerpt_max_charlength(140); ?></p>
                        <p><?php echo mb_get_meta_date_cat(esc_attr(get_the_date('c')), esc_html(get_the_date()), get_the_category_list(', '), get_the_tag_list('', ', ') ); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div><!-- /container -->
</section>
<?php endif; ?>

<?php if (get_footer()) ?>

</body>
</html>