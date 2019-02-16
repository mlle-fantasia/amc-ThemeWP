<?php
$args= array(
        'post_type'     => 'mb_slider',
        'post_per_page' => -1,
        'orderby'       => 'menu_order',
        'order'         => 'ASC'
);
$slider_query = new WP_Query($args);


if($slider_query-> have_posts()): ?>
<section>
    <div class="container-fluid carousel-home">
        <div id="slider-01" class="carousel slide" data-ridex="carousel">
            <ol class="carousel-indicators">
                <?php
                    $indicator_index = 0 ;
                    while($slider_query->have_posts()): $slider_query->the_post();
                    echo'<li data-target="#slider-01" data-slide-to="'.$indicator_index .'" 
                    class="'. ($indicator_index == 0 ? "active" : "" ) .'"></li>';

                    $indicator_index ++ ;
                    endwhile;
                ?>
            </ol>
            <?php rewind_posts(); ?>
            <div class="carousel-inner">
                <?php
                    $active_test = true;
                    while($slider_query->have_posts()): $slider_query->the_post();
                        if($image_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'front-slider')):
                            $image_src = $image_html[0];
                            $alt_image = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt');
                            $alt_image = $alt_image[0];
                            if($active_test ? $theclass= " active" : $theclass= "")
                            ?>
                            <div class="carousel-item<?php echo $theclass ?>">
                                <img src="<?php echo $image_src; ?>" class="d-block w-100" alt="<?php echo $alt_image; ?>">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo the_title(); ?></h5>
                                    <p><?php echo the_field('sous_titre'); ?></p>
                                </div>
                            </div>
                            <?php
                            $active_test = false;
                        endif;
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
            <a class="carousel-control-prev" href="#slider-01" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider-01" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>