<?php
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$args = array(
    'posts_per_page' => 4,
);
$wp_query->query($args);

while ($wp_query->have_posts()) : $wp_query->the_post();
    ?>
<div class="container">

    <?php the_title(); ?>


<?php endwhile; ?>

    <nav>
        <?php previous_posts_link('&laquo; Newer') ?>
        <?php next_posts_link('Older &raquo;') ?>
    </nav>
    </div>
<?php
$wp_query = null;
$wp_query = $temp;  // Reset
?>