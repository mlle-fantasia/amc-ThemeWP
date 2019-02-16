<?php
function mb_build_option_page(){

    $theme_opts = get_option('mb_opts');
?>

    <div class="wrap">
        <div class="container">
            <div class="mb-set-logo">

                <?php
                    if(isset($_GET['status']) && $_GET['status']==1){
                            echo '<div class="alert-success">Mise à jour éffectuée avec succès</div>';
                    }
                ?>

                <div class=" titre-admin">
                    <h1> image d'entête </h1>
                </div>
                <form id="form-mb-options" action="admin-post.php" method="post" class="form-horizontal" >
                    <input type="hidden" name="action" value="mb_save_options">
                    <?php wp_nonce_field('mb_options_verify'); ?>

                    <div class="clo-md-12">
                        <h1> image du logo</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo $theme_opts['image_01_url']; ?>" alt="" class="" id="img_preview_01">
                            </div>
                            <div class="col-md-4">
                                <button id="btn_img_01" class="btn btn-primary btn-select-img">Choisir une image pour le logo</button>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="mb_image_01" name="mb_image_01" value="<?php echo $theme_opts['image_01_url']; ?>" disabled/>
                                <input type="hidden" id="mb_image_url_01" name="mb_image_url_01" value="<?php echo $theme_opts['image_01_url']; ?>"/>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mb_legend_01" class="control-label col-md-2">légende</label>
                            <div class="col-md-10">
                                <label for="mb_legend_01" class="control-label col-md-2">légende</label>
                                <input type="text" id="mb_legend_01" name="mb_legend_01" value="<?php echo $theme_opts['legend_01']; ?>" class="mb-width-100">
                            </div>
                        </div>
                    </div>


                    <div>
                        <button id="validator" type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>

            <div class="mb-set-expo">
                <div class=" titre-admin">
                    <h1> exposition </h1>
                </div>

                <form id="form-mb-options-expo" action="admin-post.php" method="post" class="form-horizontal" >
                    <input type="hidden" name="action" value="mb_save_options">
                    <?php wp_nonce_field('mb_options_verify'); ?>

                    <div class="clo-md-12">
                        <h3>Affiche de l'exposition</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo $theme_opts['image_expo_url_thumbnail']; ?>" alt="" class="" id="img_preview_expo">
                            </div>
                            <div class="col-md-4">
                                <button id="btn_img_expo" class="btn btn-primary btn-select-img">Choisir une image pour le logo</button>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="mb_image_expo" name="mb_image_expo" value="<?php echo $theme_opts['image_expo_url']; ?>" disabled/>
                                <input type="hidden" id="mb_image_url_expo" name="mb_image_url_expo" value="<?php echo $theme_opts['image_expo_url']; ?>"/>
                                <?php echo $theme_opts['image_expo_url']; ?>
                                <input type="hidden" id="mb_image_url_expo_thumbnail" name="mb_image_url_expo_thumbnail" value="<?php echo $theme_opts['image_expo_url_thumbnail']; ?>"/>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <h3>Renseignements complémentaires sur l'exposition</h3>
                        <div class="form-group">

                            <div class="col-md-10">
                                <label for="mb_titre_expo" class="control-label col-md-2">Titre</label>
                                <input type="text" id="mb_titre_expo" name="mb_titre_expo" value="<?php echo $theme_opts['titre_expo']; ?>" class="mb-width-100">
                            </div>
                            <div class="col-md-10">
                                <label for="mb_lieu_expo" class="control-label col-md-2">Description</label>
                                <input type="text" id="mb_description_expo" name="mb_description_expo" value="<?php echo $theme_opts['description_expo']; ?>" class="mb-width-100">
                            </div>
                            <div class="col-md-10">
                                <label for="mb_date_expo" class="control-label col-md-2">Date</label>
                                <input type="date" id="mb_date_expo" name="mb_date_expo" value="<?php echo $theme_opts['date_expo']; ?>" class="mb-width-100">
                            </div>
                            <div class="col-md-10">
                                <label for="mb_lieu_expo" class="control-label col-md-2">Lieu</label>
                                <input type="text" id="mb_lieu_expo" name="mb_lieu_expo" value="<?php echo $theme_opts['lieu_expo']; ?>" class="mb-width-100">
                            </div>

                        </div>
                    </div>


                    <div>
                        <button id="reset_expo" type="submit" class="btn btn-danger ">Supprimer l'expo</button>
                        <button id="validator_expo" type="submit" class="btn btn-success ">Enregistrer l'expo</button>
                    </div>

            </div>

        </div>
    </div>




<?php
}// fin de mb_build_option_page()
