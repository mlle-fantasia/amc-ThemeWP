<footer>
    <?php $theme_opts = get_option('mb_opts'); ?>
    <div class="container-fluid footer">
        <div class="row">

            <div class="col-md-12">
                <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/assets/logo-blanc.png" alt="logo amc" class="mx-auto d-block"></a>
                <nav class="navbar navbar-expand-lg navbar-light mb-text-center">

                    <?php
                    wp_nav_menu(array(
                        'menu'               => 'top-menu', // 'top-menu' est le nom que l'on donne a notre menu
                        'theme_location'     => 'footer_menu', // 'primary' correspond à ce qu'oon a écrit dans register_nav_menus() dans functions.php
                        'depth'              => 2,
                        'container'          => 'div',
                        'container_class'    => 'navbar-collapse',
                        'container_id'       => 'navbarSupportedContent',
                        'menu_class'         => 'navbar-nav margin-auto',
                        'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                        'walker'             => new wp_bootstrap_navwalker()
                    ));
                    ?>
                </nav>
            </div>

        </div>
    </div>
    <div class="container-fluid footer-barre">
        <p class="mb-text-center">Thème wordpress créé par Marina Front <a href="https://github.com/mlle-fantasia/amc-ThemeWP" target="_blank">( Dépôt Github )</a></p>
        <p class="mb-text-center"><a href="http://www.marinafront.fr" target="_blank">www.marinafront.fr</a></p>
    </div>
</footer>

<?php wp_footer(); ?>
