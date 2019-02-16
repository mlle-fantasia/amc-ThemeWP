<?php
function mb_build_option_page(){

    $theme_opts = get_option('mb_opts');
?>

    <div class="wrap">
        <div class="container">
            <h1 class="titre">Gestion du contenu</h1>
            <div class="row">
                <div class="mb-set-opt">
                    <div class="titre-admin">
                        <h2 class="sous-titre"> Image d'entête </h2>
                    </div>
                    <?php
                    if(isset($_GET['status']) && $_GET['status']==1){
                        echo '<div class="alert-success">Mise à jour éffectuée avec succès</div>';
                    }
                    ?>

                    <form id="form-mb-options" action="admin-post.php" method="post" class="form-horizontal" >
                      <input type="hidden" name="action" value="mb_save_options"> <!--  création d'un hook personnalisé admin_post_[value]  -->
                        <?php wp_nonce_field('mb_options_verify'); ?>

                        <div class="row">

                            <div class="col-md-3">
                                <h3 class="petit-titre"> Image du logo</h3>
                                <div>
                                    <img src="<?php echo $theme_opts['image_01_url']; ?>" alt="" class="mx-auto d-block" id="img_preview_01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button id="btn_img_01" class="btn btn-primary btn-select-img btn-submit-admin">Choisir une image</button>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="mb_image_01" name="mb_image_01" value="<?php echo $theme_opts['image_01_url']; ?>" disabled/>
                                        <input type="hidden" id="mb_image_url_01" name="mb_image_url_01" value="<?php echo $theme_opts['image_01_url']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button id="validator" type="submit" class="btn btn-success btn-submit-admin">Enregistrer</button>
                            </div>

                        </div>

                    </form>
                </div><!--   fin mb-set-opt   -->
            </div>

            <div class="row">
                <div class="mb-set-opt">
                    <div class="titre-admin">
                        <h2 class="sous-titre"> Exposition </h2>
                    </div>
                    <?php
                    if(isset($_GET['status']) && $_GET['status']==2){
                        echo '<div class="alert-success">Mise à jour éffectuée avec succès</div>';
                    }
                    ?>
                    <form id="form-mb-options-expo" action="admin-post.php" method="post" class="form-horizontal" >
                        <input type="hidden" name="action" value="mb_save_options_expo">
                        <?php wp_nonce_field('mb_options_verify'); ?>

                        <div class="row">

                            <div class="col-md-3">
                                <h3 class="petit-titre">Affiche de l'exposition</h3>
                                <img src="<?php echo $theme_opts['image_expo_url_thumbnail']; ?>" alt="" class="mx-auto d-block" id="img_preview_expo">
                                <button id="btn_img_expo" class="btn btn-primary btn-select-img btn-submit-admin">Choisir une image</button>
                                <input type="text" id="mb_image_expo" name="mb_image_expo" value="<?php echo $theme_opts['image_expo_url']; ?>" disabled/>
                                <input type="hidden" id="mb_image_url_expo" name="mb_image_url_expo" value="<?php echo $theme_opts['image_expo_url']; ?>"/>
                                <input type="hidden" id="mb_image_url_expo_thumbnail" name="mb_image_url_expo_thumbnail" value="<?php echo $theme_opts['image_expo_url_thumbnail']; ?>"/>
                            </div>

                            <div class="col-md-6">
                                <h3 class="petit-titre">Renseignements complémentaires sur l'expo</h3>
                                <div>
                                    <label for="mb_titre_expo" class="control-label col-md-3">Titre</label>
                                    <input type="text" id="mb_titre_expo" name="mb_titre_expo" value="<?php echo $theme_opts['titre_expo']; ?>" class="mb-width-100 col-md-8">
                                </div>
                                <div>
                                    <label for="mb_lieu_expo" class="control-label col-md-3">Description</label>
                                    <input type="text" id="mb_description_expo" name="mb_description_expo" value="<?php echo $theme_opts['description_expo']; ?>" class="mb-width-100 col-md-8">
                                </div>
                                <div>
                                    <label for="mb_date_debut_expo" class="control-label col-md-3">Date de début</label>
                                    <input type="date" id="mb_date_debut_expo" name="mb_date_debut_expo" value="<?php echo $theme_opts['date_debut_expo']; ?>" class="mb-width-100 col-md-8">
                                    <label for="mb_date_fin_expo" class="control-label col-md-3">Date de fin</label>
                                    <input type="date" id="mb_date_fin_expo" name="mb_date_fin_expo" value="<?php echo $theme_opts['date_fin_expo']; ?>" class="mb-width-100 col-md-8">
                                </div>
                                <div>
                                    <label for="mb_lieu_expo" class="control-label col-md-3">Lieu</label>
                                    <input type="text" id="mb_lieu_expo" name="mb_lieu_expo" value="<?php echo $theme_opts['lieu_expo']; ?>" class="mb-width-100 col-md-8">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="container-btn-submit-admin">
                                    <button id="validator_expo" type="submit" class="btn btn-success btn-submit-admin">Enregistrer l'expo</button>
                                </div>
                                <div class="container-btn-submit-admin">
                                    <button id="reset_expo" type="submit" class="btn btn-danger btn-submit-admin">Supprimer l'expo</button>
                                </div>
                            </div>
                        </div>


            </div>
         </div><!--   fin row-->
        </div><!--   fin container-->
    </div>




<?php
}// fin de mb_build_option_page()
