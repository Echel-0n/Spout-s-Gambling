<?php
    if (isset($_POST['erreur'])){$r_erreur = $_POST['erreur'] ;}
    if (isset($_POST['last_page'])){$r_last_page = $_POST['last_page'] ;}
    if (isset($_POST['email'])){$r_email = $_POST['email'] ;}
    if (isset($_POST['mdp'])){$r_mdp = $_POST['mdp'] ;}
?>

<form id="formulaire_form" action="/ressources/fonctions/reception_form_con.php" method="post">
    <div class="form_centre clair_sombre">
        <div class="form_section form_connexion <?php if(isset($r_erreur)){ echo "erreur" ;};?>" id="form_connexion">
            <?php if (isset($r_last_page)){ ?>
                <input type="hidden" name="last_page" value="<?php echo $r_last_page ;?>">
            <?php } else if (isset($_SERVER['HTTP_REFERER'])){ ?>
                <input type="hidden" name="last_page" value="<?php echo $_SERVER['HTTP_REFERER'] ;?>">
            <?php };?>
            <input type="hidden" name="lang" value="<?php echo $lang ?>">
            <div class="form_section_content" id="form_moving_part">
                <div class="form_email_con form_page clair_sombre" id="page1">
                    <a href="/<?php echo $lang ;?>/">
                        <div class="form_pres_site">
                            <div>
                                <img class="form_logo_site" src="/ressources/img/logo/logo_spoutsgambling.png" alt="Spout's Gambling Logo">
                            </div>
                            <div>
                                <span class="form_nom_site">Spout's <br> Gambling</span>
                            </div>
                        </div>
                    </a>
                    <div>
                        <span class="form_nom_formulaire"><?php echo w_form_connexion ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_email)){echo $r_email;}; ?>" name="email_con" class="form_input clair_sombre" id="form_input_con_email" type="text" autocomplete="username" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                        <?php echo w_form_adresse_email ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_email_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_con_email_vide ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_email_invalide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_con_email_invalide ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <a href="/<?php echo $lang?>/inscription/">
                            <div class="form_bouton_bas form_redir_inscription form_bouton_bas_gauche clair_sombre">
                                <?php echo w_form_creer_compte ?>
                            </div>
                        </a>
                        <div class="form_bouton_bas form_suivant form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>
                <div class="form_mdp_con form_page clair_sombre" id="page2">
                    <a href="/<?php echo $lang ;?>/">
                        <div class="form_pres_site">
                            <div>
                                <img class="form_logo_site" src="/ressources/img/logo/logo_spoutsgambling.png" alt="Spout's Gambling Logo">
                            </div>
                            <div>
                                <span class="form_nom_site">Spout's <br> Gambling</span>
                            </div>
                        </div>
                    </a>
                    <div class="form_ligne_nom_formulaire">
                        <div class="form_bouton_retour clair_sombre" onclick="form_navig_pages(this)">
                            <div class="form_fleche_bouton_retour"></div>
                        </div>
                        <span class="form_nom_formulaire"><?php echo w_form_connexion ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input name="mdp_con" class="form_input clair_sombre form_affichermotdepasse" id="form_input_con_mdp" type="password" autocomplete="current-password" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_mot_de_passe ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_con_mdp_vide ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_invalide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_con_mdp_invalide ?>
                        </div>
                    </div>
                    <div class="form_option_cocher">
                        <div class="case_a_cocher" onclick="affiche_mdp(this), activation_case(this)">
                            <div class="fond_case">
                                <div class="coche_case"></div>
                            </div>
                        </div>
                        <div class="form_text_option_cocher" onclick="affiche_mdp(this), activation_case(this)">
                            <?php echo w_form_afficher_mdp ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <a href="#">
                            <div class="form_bouton_bas form_redir_mdp_forget form_bouton_bas_gauche clair_sombre">
                            <?php echo w_form_mdp_oublie ?>
                            </div>
                        </a>
                        <div class="form_bouton_bas form_suivant form_validation form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($r_erreur)){?>
                <div class="form_message_erreur" id="form_message_erreur_retour">
                    <div class="form_div_logo_erreur">
                        <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                    </div>
                    <div class="form_erreur_text">
                        <?php echo w_form_con_email_mdp_incorrect ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</form>

<script>
    document.title = '<?php echo w_form_connexion ?> - Spout\'s Gambling'
</script>

<script src="/ressources/js/formulaire.js"></script>
<link rel="stylesheet" href="/ressources/css/formulaire.css">