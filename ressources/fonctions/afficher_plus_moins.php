<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";

    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    } else{
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    };
    // Préparation des différentes langues
    $text_chemin_lang = $link_include.'/ressources/lang/lang_'.$lang.'.php';
    if(file_exists($text_chemin_lang)){
        include $text_chemin_lang;
    };
?>

<?php if($_GET['type'] == 'plus'){?>
    <div class="droite_relative_content">
        <div class="droite_part_content droite_part_noresult"> <?php echo w_recherche_aucun_resultat ?> </div>
        <div class="droite_part_content grille_jeux scrollbar">

            <?php
                $DB_game = $access_bdd ;
                $game_search = "SELECT * FROM game ORDER BY nom_game";
                $games = $DB_game->query($game_search);
                $game_list = $games->fetchALL();
                foreach ($game_list as $g){
                    ?>

                        <div class="jeux_grille_case">
                            <div class="jeux_grille_relative">
                                <div class="jeux_grille_absolute">
                                    <a href="/<?php echo $lang ?>/game/<?php echo $g['id_game']; ?>">
                                        <div class="jeux_pres_content">
                                            <div class="jeux_pres_titre"><?php echo $g['nom_game'];?></div>
                                            <div class="jeux_pres_img">
                                                <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$g['image_game']; ?>" alt="">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php
                };
            ?>

        </div>
    </div>
    <div class="div_bouton_plus_de_jeux bouton_moins" onclick="afficher_moins()">
        <?php echo w_carousel_affiche_moins ?>
    </div>

<?php }else if($_GET['type'] == 'moins'){?>

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

    <?php }; ?>