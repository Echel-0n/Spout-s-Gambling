<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];

    include $link_include."/ressources/fonctions/info_base_donnee.php";
?>
<div class="rech_jeux">
    <div class="div_barre_rech">
        <div class="barre_rech clair_sombre">
            <div class="barre_rech_loupe" id="barre_rech_loupe" onclick="animation_loupe(this)">
                <div class="cercle_loupe"></div>
                <div class="barre_loupe"></div>
            </div>
            <div></div>
            <div>
                <input type="text" name="recherche" placeholder="<?php echo w_rb_rechecher?>" class="rech_barre clair_sombre" id="search_game" onfocus="anim_loupe()" onfocusout="stop_anim_loupe()">
            </div>
        </div>
    </div>
    <div class="cont_jeux clair_sombre" id="cont_jeux">
        <div class="cont_carousel">
            <div class="ratio_keeper">
                <div class="carousel_jeux">

                    <?php
                        $DB_game = $access_bdd ;
                        $game_carousel = "SELECT * FROM game ORDER BY id_game LIMIT 5";
                        $games_carousel = $DB_game->query($game_carousel);
                        $game_car_list = $games_carousel->fetchALL();
                    ?>

                    <div class="jeux_tendance c_dd" onclick="fleche_droite_action(this)">
                        <div class="car_droite_droite jeux_tendance_content clair_sombre" id="game_class_4">
                            <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $game_car_list[4]['id_game']; ?>">
                                <div class="jeux_pres_content">
                                    <div class="jeux_pres_titre"><?php echo $game_car_list[4]['nom_game']; ?></div>
                                    <div class="jeux_pres_img">
                                        <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$game_car_list[4]['image_game']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jeux_tendance c_gg" onclick="fleche_gauche_action(this)">
                        <div class="car_gauche_gauche jeux_tendance_content clair_sombre" id="game_class_-4">
                            <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $game_car_list[3]['id_game']; ?>">
                                <div class="jeux_pres_content">
                                    <div class="jeux_pres_titre"><?php echo $game_car_list[3]['nom_game']; ?></div>
                                    <div class="jeux_pres_img">
                                        <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$game_car_list[3]['image_game']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jeux_tendance c_d" onclick="fleche_droite_action(this)">
                        <div class="car_droite jeux_tendance_content clair_sombre" id="game_class_2">
                            <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $game_car_list[2]['id_game']; ?>">
                                <div class="jeux_pres_content">
                                    <div class="jeux_pres_titre"><?php echo $game_car_list[2]['nom_game']; ?></div>
                                    <div class="jeux_pres_img">
                                        <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$game_car_list[2]['image_game']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jeux_tendance c_g" onclick="fleche_gauche_action(this)">
                        <div class="car_gauche jeux_tendance_content clair_sombre" id="game_class_-2">
                            <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $game_car_list[1]['id_game']; ?>">
                                <div class="jeux_pres_content">
                                    <div class="jeux_pres_titre"><?php echo $game_car_list[1]['nom_game']; ?></div>
                                    <div class="jeux_pres_img">
                                        <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$game_car_list[1]['image_game']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jeux_tendance c_c">
                        <a class="lien_jeu_centre" href="/<?php echo $lang ?>/game/<?php echo $game_car_list[0]['id_game']; ?>">
                            <div class="car_centre jeux_tendance_content clair_sombre" id="game_class_0">
                                <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $game_car_list[0]['id_game']; ?>">
                                    <div class="jeux_pres_content">
                                        <div class="jeux_pres_titre"><?php echo $game_car_list[0]['nom_game']; ?></div>
                                        <div class="jeux_pres_img">
                                            <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$game_car_list[0]['image_game']; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div style="display:none;" class="droite_relative_content"></div>
            <div class="fleche_content fleche_gauche_content">
                <div class="fleche_rond ga clair_sombre" onclick="fleche_gauche_action(this)">
                    <div class="fleche_carre ga"></div>
                </div>
            </div>
            <div class="fleche_content fleche_droite_content">
                <div class="fleche_rond dr clair_sombre" onclick="fleche_droite_action(this)">
                    <div class="fleche_carre dr"></div>
                </div>
            </div>
        </div>
        <div class="div_bouton_plus_de_jeux bouton_plus" onclick="afficher_plus()">
            <?php echo w_carousel_affiche_plus ?>
        </div>
    </div>
</div>

<script>
    document.title = 'Spout\'s Gambling'
</script>

<link rel="stylesheet" href="/ressources/css/carousel.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/carousel.js"></script>
<script src="/ressources/js/barre_rech.js"></script>