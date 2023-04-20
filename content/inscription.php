<?php
    if (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['birth']) && isset($_POST['cgu'])){
        $r_email = $_POST['email'] ;
        $r_pseudo = $_POST['pseudo'];
        $r_mdp = $_POST['mdp'] ;
        $r_nom = $_POST['nom'] ;
        $r_prenom = $_POST['prenom'] ;
        $r_birth = $_POST['birth'] ;
        $r_cgu = $_POST['cgu'] ;
    }
    if (isset($_POST['last_page'])){$r_last_page = $_POST['last_page'] ;}
?>

<form id="formulaire_form" action="/ressources/fonctions/reception_form_ins.php" method="post">
    <div class="form_centre clair_sombre">
        <div class="form_section form_inscription <?php if(isset($_POST['erreur_email'])||isset($_POST['erreur_pseudo'])||isset($_POST['erreur_mdp'])||isset($_POST['erreur_birth'])||isset($_POST['erreur_nom'])||isset($_POST['erreur_prenom'])||isset($_POST['erreur_cgu'])||isset($_POST['erreur_general'])){ echo "erreur" ;}; ?>" id="form_inscription">
            <?php
                if (isset($r_last_page)){ ?>
                    <input type="hidden" name="last_page" value="<?php echo $r_last_page ;?>">
                <?php } else if (isset($_SERVER['HTTP_REFERER'])){ ?>
                    <input type="hidden" name="last_page" value="<?php echo $_SERVER['HTTP_REFERER'] ;?>">
                <?php };
            ?>
            <input type="hidden" name="lang" value="<?php echo $lang ?>">
            <div class="form_section_content" id="form_moving_part">
                <div class="form_email_ins form_page clair_sombre" id="page1">
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
                        <span class="form_nom_formulaire"><?php echo w_form_inscription ; ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_email)&&!isset($_POST["erreur_email"])){echo $r_email;}; ?>" name="email_inscr" class="form_input clair_sombre" type="text" id="form_input_ins_email" name="email" autocomplete="email" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_adresse_email ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_email_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_email_vide ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_email_invalide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_email_invalide ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <a href="/<?php echo $lang?>/connexion/">
                            <div class="form_bouton_bas form_redir_inscription form_bouton_bas_gauche clair_sombre">
                                <?php echo w_form_deja_compte ?>
                            </div>
                        </a>
                        <div class="form_bouton_bas form_suivant form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>

                <div class="form_pseudo_ins form_page clair_sombre" id="page2">
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
                        <span class="form_nom_formulaire"><?php echo w_form_inscription ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_pseudo)&&!isset($_POST["erreur_pseudo"])){echo $r_pseudo;}; ?>" name="pseudo_inscr" class="form_input clair_sombre" type="text" id="form_input_ins_pseudo" name="pseudo" autocomplete="username" onkeyup="verif_ins_pseudo_dispo()" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_pseudo ?>
                        </div>
                    </div>
                    <!-- Messages d'erreurs -->
                        <div class="form_message_erreur" id="form_message_erreur_pseudo_alreadyExist">
                            <div class="form_div_logo_erreur">
                                <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                            </div>
                            <div class="form_erreur_text">
                                <?php echo w_form_ins_pseudo_alreadyExist ?>
                            </div>
                        </div>
                        <div class="form_message_erreur" id="form_message_erreur_pseudo_noExist">
                            <div class="form_div_logo_erreur">
                                <img class="form_logo_erreur" src="/ressources/img/form/validate.png">
                            </div>
                            <div class="form_erreur_text">
                                <?php echo w_form_ins_pseudo_noExist ?>
                            </div>
                        </div>
                        <div class="form_message_erreur" id="form_message_erreur_pseudo_vide">
                            <div class="form_div_logo_erreur">
                                <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                            </div>
                            <div class="form_erreur_text">
                                <?php echo w_form_ins_pseudo_vide ?>
                            </div>
                        </div>
                        <div class="form_message_erreur" id="form_message_erreur_pseudo_invalide">
                            <div class="form_div_logo_erreur">
                                <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                            </div>
                            <div class="form_erreur_text">
                                <?php echo w_form_ins_pseudo_invalide ?>
                            </div>
                        </div>
                        <div class="form_div_bouton_bas">
                            <a href="/<?php echo $lang?>/connexion/">
                                <div class="form_bouton_bas form_redir_inscription form_bouton_bas_gauche clair_sombre">
                                    <?php echo w_form_deja_compte ?>
                                </div>
                            </a>
                            <div class="form_bouton_bas form_suivant form_bouton_bas_droite" onclick="form_navig_pages(this)">
                                <?php echo w_form_suivant ?>
                            </div>
                        </div>
                </div>

                <div class="form_mdp_ins form_page clair_sombre" id="page3">
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
                        <span class="form_nom_formulaire"><?php echo w_form_inscription ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input name="mdp_inscr" class="form_input form_notLast_input clair_sombre form_affichermotdepasse" type="password" id="form_input_ins_mdp" name="mdp_inscr" autocomplete="new-password" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_mot_de_passe ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_mdp_vide ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_court">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_mdp_court ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_invalide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_mdp_invalide ?>
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
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input name="confirm_mdp_inscr" class="form_input clair_sombre" type="password" id="form_input_ins_mdp_conf" name="confirm_mdp_inscr" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_confirm_mdp ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_mdp_nonIdentique">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_nonIdentique_mdp ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <div class="form_bouton_bas form_suivant form_validation form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>

                <div class="form_identite_ins form_page clair_sombre" id="page4">
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
                        <span class="form_nom_formulaire"><?php echo w_form_inscription ?></span>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_nom)&&!isset($_POST["erreur_nom"])){echo $r_nom ;} ;?>" name="nom_inscr" class="form_input form_notLast_input clair_sombre" type="text" id="form_input_ins_nom" name="nom" autocomplete="family-name" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_user_nom ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_nom_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_nom_vide ?>
                        </div>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_prenom)&&!isset($_POST["erreur_prenom"])){echo $r_prenom ;} ;?>" name="prenom_inscr" class="form_input form_notLast_input clair_sombre" type="text" id="form_input_ins_prenom" name="prenom" autocomplete="given-name" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_user_prenom ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_prenom_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_prenom_vide ?>
                        </div>
                    </div>
                    <div class="form_encadr_input" onclick="form_focus_input(this)">
                        <input value="<?php if(isset($r_birth)&&!isset($_POST["erreur_birth"])){echo $r_birth ;};?>" name="birth_inscr" class="form_input clair_sombre" type="text" id="form_input_ins_birth" name="birthday" autocomplete="bday" maxlength="10" onfocus="form_focus_input(this)" onfocusout="form_focusout_input(this)">
                        <div class="form_input_text_fond clair_sombre">
                            <?php echo w_form_user_birthDate ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_bday_vide">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_bday_vide ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_bday_invalid_format">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_bday_invalid_format ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_bday_notExist">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_bday_notExist ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_bday_inFuture">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_bday_inFuture ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <div class="form_bouton_bas form_suivant form_validation form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>

                <div class="form_cgu_ins form_page clair_sombre" id="page5">
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
                        <span class="form_nom_formulaire"><?php echo w_form_inscription ?></span>
                    </div>
                    <div class="form_encadr_input form_encadr_text">
                        <div class="form_absolute_text scrollbar">
                        <?php include $link_include."/ressources/text/privacy_policy.php" ?>
                        </div>
                    </div>
                    <div class="form_option_cocher" id='form_option_cocher_cgu' onclick="accept_cgu(this)">
                        <input type="checkbox" name="cgu_inscr" style="display:none;" id="form_ins_checkCGU_accept" <?php if(isset($r_cgu)&&!isset($_POST["erreur_cgu"])&&$r_cgu=="on"){echo "checked";};?>>
                        <div class="case_a_cocher">
                            <div class="fond_case">
                                <div class="coche_case"></div>
                            </div>
                        </div>
                        <div class="form_text_option_cocher">
                            <?php echo w_form_cgu_accept ?>
                        </div>
                    </div>
                    <div class="form_message_erreur" id="form_message_erreur_cgu_notAccepted">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php echo w_form_ins_cgu_notAccepted ?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <a href="/<?php $lang?>/">
                            <div class="form_bouton_bas form_redir_inscription form_bouton_bas_gauche clair_sombre">
                                <?php echo w_form_cgu_refuse ?>
                            </div>
                        </a>
                        <div class="form_bouton_bas form_suivant form_bouton_bas_droite" onclick="form_navig_pages(this)">
                            <?php echo w_form_suivant ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(isset($_POST['erreur_email'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_email = $_POST['erreur_email'] ;
                                if($e_email == 'vide'){
                                    echo w_form_ins_erreur_email_vide ;
                                } else if($e_email == 'invalid'){
                                    echo w_form_ins_erreur_email_invalid ;
                                } else if($e_email == 'alreadyExist'){
                                    echo w_form_ins_erreur_email_alreadyExist ;
                                };
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_pseudo'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_pseudo = $_POST['erreur_pseudo'] ;
                                if($e_pseudo == 'vide'){
                                    echo w_form_ins_erreur_pseudo_vide ;
                                } else if($e_pseudo == 'invalid'){
                                    echo w_form_ins_erreur_pseudo_invalid ;
                                } else if($e_pseudo == 'alreadyExist'){
                                    echo w_form_ins_erreur_pseudo_alreadyExist ;
                                };
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_mdp'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_mdp = $_POST['erreur_mdp'] ;
                                if($e_mdp == 'vide'){
                                    echo w_form_ins_erreur_mdp_vide ;
                                } else if($e_mdp == 'invalid'){
                                    echo w_form_ins_erreur_mdp_invalid ;
                                } else if($e_mdp == 'noMatch'){
                                    echo w_form_ins_erreur_mdp_noMatch ;
                                };
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_birth'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_birth = $_POST['erreur_birth'] ;
                                if($e_birth == 'vide'){
                                    echo w_form_ins_erreur_birth_vide ;
                                } else if($e_birth == 'invalid'){
                                    echo w_form_ins_erreur_birth_invalid ;
                                } else if($e_birth == 'noExist'){
                                    echo w_form_ins_erreur_birth_noExist ;
                                } else if($e_birth == 'futur'){
                                    echo w_form_ins_erreur_birth_futur ;
                                };
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_nom'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_nom = $_POST['erreur_nom'] ;
                                if($e_nom == 'vide'){
                                    echo w_form_ins_erreur_nom_vide ;
                                }
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_prenom'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_prenom = $_POST['erreur_prenom'] ;
                                if($e_prenom == 'vide'){
                                    echo w_form_ins_erreur_prenom_vide ;
                                }
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_cgu'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_cgu = $_POST['erreur_cgu'] ;
                                if($e_cgu == 'vide'){
                                    echo w_form_ins_erreur_cgu_vide ;
                                }
                            ?>
                        </div>
                    </div>
                <?php };
                if(isset($_POST['erreur_general'])){?>
                    <div class="form_message_erreur" id="form_message_erreur_retour">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php
                                $e_general = $_POST['erreur_general'] ;
                                if($e_general == 'vide'){
                                    echo w_form_ins_erreur_general ;
                                }
                            ?>
                        </div>
                    </div>
                <?php };
            ?>
        </div>
    </div>
</form>

<script>
    document.title = '<?php echo w_form_inscription ?> - Spout\'s Gambling'
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/formulaire.js"></script>
<link rel="stylesheet" href="/ressources/css/formulaire.css">