<?php
//
$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$reg="#([^/]*)/$#";
preg_match($reg,$monUrl,$res);
if(strlen ($res[1]) === 1){
    $paged = $res[1];
}else{
    $paged = 1;
}



$args= array(
    'paged' => $paged,
    'post_type' => 'post',
    'posts_per_page' => 4,
//    'offset' => $offsetTableau,
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
<!--        <input type="text" value="--><?php //echo $paged ?><!--" >-->
        <div class="containerSliderGalerie <?php echo $paged ?>">
<!--        <div class="page prec" id="precedent">-->
<!--            Tableaux précédents-->
<!--        </div>-->
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
<!--            <div class="page suiv" id="suivant">-->
<!--                Tableaux suivants-->
<!--            </div>-->


    </div>

<!--    boutton de controle de page galerie pour des écrans de moins de 700px-->
<!--    <div class="row containerControlPage700">-->
<!--        <button class="page prec700 precedent" id="">-->
<!--            Tableaux suivants-->
<!--        </button>-->
<!--        <button class="page suiv700 suivant" id="">-->
<!--            Tableaux suivants-->
<!--        </button>-->
<!--    </div>-->

</div>

<?php endif;  wp_reset_postdata();  ?>

<div class="container containerPagination">
    <div class="controlePage precedent">
        <?php mb_previous_posts_link('Tableaux précédents', $paged);?>
    </div>
    <div class="controlePage suivant">
        <?php  mb_next_posts_link( 'Tableaux suivants' , $my_query->max_num_pages, $paged  ); ?>
    </div>
</div>
<?php
    $my_query = null;
    $wp_query = $temp_query;
?>