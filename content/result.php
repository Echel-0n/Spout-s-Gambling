<?php
    $phrase_centre = "";
    $next = w_form_goHome;
    $previous = w_form_goHome;
    $next_link = "/".$lang."/";
    $previous_link = "/".$lang."/";
    $b = explode('_', $id);
    if(count($b) == 2){
        $bool = $b[0];
        $type = $b[1];
        echo $type;
        if($type == "question"){
            if ($bool == "success"){
                $phrase_centre = w_form_success_question;
                $next = w_form_success_question_next;
                $previous = w_form_success_question_previous;
                $next_link = "/".$lang."/";
                $previous_link = "/".$lang."/";
            } else if ($bool == "fail"){
                $phrase_centre = w_form_fail_question;
                $next = w_form_fail_question_next;
                $previous = w_form_fail_question_previous;
                $next_link = "/".$lang."/ticket/question";
                $previous_link = "/".$lang."/";
            }
        }
?>
    <form id="formulaire_form" action="/ressources/fonctions/reception_form_ticket.php" method="post">
        <div class="form_centre clair_sombre">
            <div class="form_section" id="form_ticket">
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
                            <span class="form_nom_formulaire"><?php echo $phrase_centre;?></span>
                        </div>
                        <div class="form_div_bouton_bas">
                            <?php if($bool == "fail"){?>
                                <a href="<?php echo $previous_link ?>">
                                    <div class="form_bouton_bas form_bouton_bas_gauche clair_sombre">
                                        <?php echo $previous ;?>
                                    </div>
                                </a>
                            <?php };?>
                            <a href="<?php echo $next_link ?>">
                                <div class="form_bouton_bas form_suivant form_bouton_bas_droite">
                                    <?php echo $next ;?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <link rel="stylesheet" href="/ressources/css/formulaire.css">
    <script>
        document.title = '<?php echo w_form_success ?> - Spout\'s Gambling'
    </script>
<?php }else{/*header("Location: /$lang/");*/};?>