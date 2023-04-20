<div class="menu_gauche clair_sombre">
    <div class="">
        <div class="button_carre" onclick="barre_gauche_deploiement(this)">
            <div class="button_bar1"></div>
            <div class="button_bar2"></div>
            <div class="button_bar3"></div>
        </div>
        <div class="absolute_home_button">
            <div class="relative_home_button">
                <a href="/<?php echo $lang ?>/">
                    <div class="home_button_walls home_button_content"></div>
                    <div class="home_button_roof_inner home_button_content"></div>
                    <div class="home_button_roof home_button_content"></div>
                    <div class="home_button_door home_button_content"></div>
                </a>
            </div>
        </div>
    </div>

    <div class="menu_gauche_content scrollbar">
        <?php
        if($connected){
        ?>
        <div class="menu_utilisateur">
            <!-- div intégrant l'avatar de l'utilisateur -->
            <div class="img_prof_utilisateur cercle menu_inline">
                <!-- Intégration de l'image de profil (à mettre en format circulaire) -->
                <a href="/<?php echo $lang;?>/user/<?php echo $user_id;?>">
                    <img class="img_prof_utilisateur_img" src="/ressources/img/user/<?php echo $image ?>" alt="picture_id">
                </a>
            </div>
            <!-- div intégrant le pseudo de l'utilisateur et le nombre de points -->
            <div class="info_prof_utilisateur menu_inline">
                    <div class="pseudo_barre_gauche">
                        <a class="lien_profil" href="/<?php echo $lang;?>/user/<?php echo $user_id;?>">
                            <?php echo htmlspecialchars($pseudo) ;?>
                        </a>
                    </div>
                <div class="points_barre_gauche">
                    <div class="clair_sombre logo_points_barre_gauche menu_inline">
                        <img class="logo_points_barre_gauche_img" src="/ressources/img/jeton_points.png" alt="logo_points">
                    </div>
                    <div class="nb_points_barre_gauche menu_inline">
                        <?php echo $nb_jeton ;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu_gauche_inter"></div>
        <div class="bg_bouton_deconnexion">
            <a href="/ressources/fonctions/reception_decon.php">
                <div class="menu_deconnexion">
                    <div class="menu_deconnexion_centre">
                        <?php echo w_bg_deconnexion ;?>
                    </div>
                </div>
            </a>
        </div>
        <?php
        } else {
        ?>
        <div class="menu_inscription_connexion">
            <a href="/<?php echo $lang?>/connexion/">
                <div class="menu_inscription_connexion_inner menu_connexion">
                    <div class="menu_inscription_connexion_inner_centre">
                        <?php echo w_bg_connexion?>
                    </div>
                </div>
            </a>
            <a href="/<?php echo $lang?>/inscription/">
                <div class="menu_inscription_connexion_inner menu_inscription">
                    <div class="menu_inscription_connexion_inner_centre">
                        <?php echo w_bg_inscription?>
                    </div>
                </div>
            </a>
        </div>
        <?php };?>
        <div class="menu_gauche_inter"></div>
        <div class="parametres_barre_gauche">
            <div class="para_mod_bg mode_sombre_barre_gauche">
                <div><?php echo w_bg_mode_sombre?></div>
                <div class="right_align">
                    <div class="para_mod_bg_button but_mode_sombre">
                        <div class="rond_para_mod_bg_button rond_but_mode_sombre clair_sombre"></div>
                    </div>
                </div>
            </div>
            <div class="para_mod_bg mode_daltonien_barre_gauche">
                <div><?php echo w_bg_mode_daltonien?></div>
                <div class="right_align">
                    <div class="para_mod_bg_button">
                        <div class="rond_para_mod_bg_button clair_sombre"></div>
                    </div>
                </div>
            </div>
            <div class="para_mod_bg langue_barre_gauche">
                <div><?php echo w_bg_langue?></div>
                <div class="right_align">
                    <select class="right_align bg_selection" id='lang_selection' name="langue" onchange="change_langue(this)">
                        <option value="fr" <?php if(isset($_GET['lang'])){if($_GET['lang']=='fr'){echo 'selected';}}?>>FR</option>
                        <option value="en" <?php if(isset($_GET['lang'])){if($_GET['lang']=='en'){echo 'selected';}}?>>EN</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/ressources/css/barre_gauche.css">
<script src="/ressources/js/barre_gauche.js"></script>