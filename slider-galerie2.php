<?php
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = array(
    'posts_per_page' => 4,
    'paged'          => $paged,
);
//save old query
$temp = $wp_query;
//clear $wp_query;
$wp_query= null;
//create a new instance
$my_query = new WP_Query( $args );


?>


<?php if ($my_query ->have_posts()): ?>

    <section class=" section galerie">
        <div class="container-fluid">
            <div class="row container-panels">

                <?php
                while($my_query ->have_posts()): $my_query ->the_post();
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
                        </div>
                    </div>

                <?php endwhile; ?>

<!--                --><?php
//                    $big = 999999999; // need an unlikely intege
//                    $total_page = $my_query->max_num_pages;
//                    echo $total_page;
//                    if ($total_page > 1): ?>
<!--                        <div class="col-md-12 mb-pagination">coucou-->
<!--                            --><?php //echo paginate_links(array(
//                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
//                                'format' => '?paged=%#%',
//                                'current' => max( 1, get_query_var('paged') ),
//                                'total' => $total_page,
////                                'prev_next' => true,
////                                'prev_text' => '<- Page pécédente ',
////                                'next_text' => ' Page suivante ->',
//                            )); ?>
<!--                        </div>-->
<!--                --><?php //endif;
                next_posts_link();
//                ?>



            </div>
        </div><!-- /container -->
    </section>
<?php
    endif;
    wp_reset_postdata();

//clear again
$my_query = null;
//reset
$wp_query = $temp;

?>