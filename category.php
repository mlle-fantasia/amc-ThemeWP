<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>


<?php if (get_header()) ?>



<section>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h2 class="front-page-titre mb-text-center">
                    Les <?php single_cat_title('', true); ?>
                </h2><hr>
            </div>
        </div>


        <?php if (have_posts()): ?>
            <?php  while(have_posts()): the_post();
                get_template_part('content');
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