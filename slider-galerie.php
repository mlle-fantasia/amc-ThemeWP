<?php


if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$args= array(
    'paged' => $paged,
    'post_type' => 'post',
    'posts_per_page' => 4,
    'order' => 'DESC', // 'ASC'
    'orderby' => 'date' // modified | title | name | ID | rand
);

$my_query = new WP_Query($args);

// Pagination fix
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $my_query;
?>




<?php if ( $my_query ->have_posts() ): ?>

<div class="container-fluid" id="slideGalerie">
    <div class="row">
        <input type="text" value="<?php echo $paged ?>" >
        <div class="containerSliderGalerie <?php echo $paged ?>">
        <div class="page prec" id="precedent">
            Tableaux précédents
        </div>
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
            <div class="page suiv" id="suivant">
                Tableaux suivants
            </div>

        </div>

    </div>
<!--    --><?php //mb_pagination($my_query); ?>
</div>

<?php endif;
wp_reset_postdata();


previous_posts_link('Tableaux précédents');
next_posts_link( 'Tableaux suivants' , $my_query->max_num_pages );

// Reset main query object
$wp_query = NULL;
$wp_query = $temp_query;

?>