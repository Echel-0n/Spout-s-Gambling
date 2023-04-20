<form id="formulaire_form" action="/ressources/fonctions/reception_form_ticket.php" method="post">
    <div class="form_centre clair_sombre">
        <div class="form_section" id="form_ticket">
            <?php if (isset($id)){?>
                <input type="hidden" name="type" value="<?php echo $id;?>">
            <?php };?>
            <?php if (isset($lang)){?>
                <input type="hidden" name="lang" value="<?php echo $lang;?>">
            <?php };?>
            <div class="form_section_content">
                <div class="form_identifiant_con form_page clair_sombre" id="page1">
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
                        <span class="form_nom_formulaire"><?php echo w_form_tic_posezVotreQuestion ;?></span>
                    </div>
                    <div class="form_encadr_input ticket_encadr_input">
                        <textarea class="scrollbar" name="ticket" id="input_ticket" maxlength="1500" placeholder=" <?php echo w_form_tic_preventionAbus ;?>" rows="15" autofocus></textarea>
                    </div>
                    <div class="form_message_erreur form_message_erreur_id">
                        <div class="form_div_logo_erreur">
                            <img class="form_logo_erreur" src="/ressources/img/form/erreur_exclamation.png">
                        </div>
                        <div class="form_erreur_text">
                            <?php w_form_tic_saisissezMessage ;?>
                        </div>
                    </div>
                    <div class="form_div_bouton_bas">
                        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                            <div class="form_bouton_bas form_bouton_bas_gauche clair_sombre">
                                <?php echo w_form_retour ;?>
                            </div>
                        </a>
                        <button type="submit" id="form_bouton_submit">
                            <div class="form_bouton_bas form_suivant form_bouton_bas_droite">
                                <?php echo w_form_envoyer ;?>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<link rel="stylesheet" href="/ressources/css/formulaire.css">
<script>
    document.title = '<?php echo w_form_tic_ticket ?> - Spout\'s Gambling'
</script>