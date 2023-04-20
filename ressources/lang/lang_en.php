<?php
    // Base
        // Barre Gauche
            define('w_bg_mode_sombre','Dark mode');
            define('w_bg_mode_daltonien','Colorblind mode');
            define('w_bg_langue','Language');
            define('w_bg_connexion','Sign-In');
            define('w_bg_inscription','Create account');
            define('w_bg_deconnexion','Disconnect');
        // Pied de page
            define('w_pp_politique_conf','Privacy policy');
            define('w_pp_term_cond','Terms and conditions');
            define('w_pp_faq','FAQ');
            define('w_pp_contact_us','Contact us');
    // Barre de recherche
        define('w_rb_rechecher', 'Search');
    // Menu (Carousel)
        define('w_carousel_affiche_plus','Show more +');
        define('w_carousel_affiche_moins','Show less -');
        define('w_recherche_aucun_resultat','No result');
    // Utilisateurs
        define('w_user_user','User');
    // Page texte
        // FAQ
            define('w_text_faq', 'FAQ');
            define('w_text_faq_rechQuestion', 'Search a question');
            define('w_text_faq_autreQuestion__', 'An other question ?');
            define('w_text_faq__poserLaNous', 'Ask us');
        // Politique de confidentialité
            define('w_text_privacy_policy', 'Privacy policy');
    // Page utilisateur
        define('w_user_rechercher', 'Search a user');
        define('w_user_rechercher_noResult', 'No result');
        define('w_user_friends', 'Friends');
        define('w_user_addFriends_noConnect', 'Log in');
        define('w_user_addFriend_add', 'Add a friend');
        define('w_user_addFriend_already', 'Already friend');
        define('w_user_addFriend_already_delete', 'Already friend <br> Delete ?');
        define('w_user_addFriend_himself', 'It\'s your profile page');
        define('w_user_stat_gameStats','Game statistics');
        define('w_user_stat_indisponibles','Curently UNAVAILABLE');
    // Page jeux
        define('w_game_rechercher', 'Search a game');
        define('w_game_rechercher_noResult', 'No result');
        define('w_game_friends', 'Friends');
        define('w_game_noConnect', 'Log in');
        define('w_game_play', 'Play');
        define('w_game_nbParties', 'Number of games in progress');
        define('w_game_infos', 'Infos');
        define('w_game_rules', 'Rules');
        define('w_game_continue', 'Continue');
        define('w_game_info_indisponibles','Currently UNAVAILABLE');
    // Formulaire
        define('w_form_goHome', 'Back to the menu');
        define('w_form_success', 'Success');
        define('w_form_fail', 'Error');
        define('w_form_suivant','Next');
        define('w_form_retour', 'Back');
        define('w_form_envoyer', 'Send');
        define('w_form_adresse_email','E-mail adress');
        define('w_form_mot_de_passe','Password');
        define('w_form_afficher_mdp','Show password');
        define('w_form_terminer', 'Finish');
        // Connexion
            define('w_form_connexion','Sign-In');
            define('w_form_creer_compte','Create account');
            define('w_form_mdp_oublie','Forgot your password ?');
            // Erreurs
                define('w_form_con_email_vide','Enter an E-mail adress');
                define('w_form_con_email_invalide','Enter a valid E-mail adress');
                define('w_form_con_mdp_vide','Enter a password');
                define('w_form_con_mdp_invalide','Password too short');
                define('w_form_con_email_mdp_incorrect','E-mail or password wrong');
        // Inscription
            define('w_form_inscription', 'Inscription');
            define('w_form_deja_compte','Already an account? <br> Sign in');
            define('w_form_pseudo', 'Username');
            define('w_form_pseudo_invalide', 'Enter a valid username');
            define('w_form_confirm_mdp','Confirm password');
            define('w_form_user_nom', 'Last name');
            define('w_form_user_prenom', 'First name');
            define('w_form_user_birthDate', 'date of birth');
            define('w_form_cgu_accept', 'Accept terms and conditions');
            define('w_form_cgu_refuse', 'Refuse and cancel');
            // Erreurs
                define('w_form_ins_email_vide','Enter an E-mail adress');
                define('w_form_ins_email_invalide','Enter a valid E-mail adress');
                define('w_form_ins_pseudo_vide','Enter a username');
                define('w_form_ins_pseudo_invalide','Incorect username (between 4 and 12 characters, you can use capitals, lower keys, - , _ , / , and numbers)');
                define('w_form_ins_pseudo_alreadyExist','Username already used');
                define('w_form_ins_pseudo_noExist','Username available');
                define('w_form_ins_mdp_vide','Enter a password');
                define('w_form_ins_mdp_court','Password too short (6 characters or more)');
                define('w_form_ins_mdp_invalide','password incorrect (6 characters or more, you can use capitals, lower keys, "," , - , _ , . , / , and numbers)');
                define('w_form_ins_nonIdentique_mdp','Password are not exactly the same');
                define('w_form_ins_nom_vide','Enter your last name');
                define('w_form_ins_prenom_vide','Enter your first name');
                define('w_form_ins_bday_vide','enter your date of birth');
                define('w_form_ins_bday_invalid_format','The date of birth format is not correct');
                define('w_form_ins_bday_notExist','The date don\'t exist');
                define('w_form_ins_bday_inFuture','The date is on the future');
                define('w_form_ins_cgu_notAccepted','Please, accept terms and conditions by checking the box');

                define('w_form_ins_erreur_email_vide','Missing E-mail adress');
                define('w_form_ins_erreur_email_invalid','Incorrect E-mail adress');
                define('w_form_ins_erreur_email_alreadyExist','This E-mail adress is already used by an account');
                define('w_form_ins_erreur_pseudo_vide','Missing username');
                define('w_form_ins_erreur_pseudo_invalid','Incorrect username');
                define('w_form_ins_erreur_pseudo_alreadyExist','This username is already used by an account');
                define('w_form_ins_erreur_mdp_vide','Missing password');
                define('w_form_ins_erreur_mdp_invalid','Incorrect password');
                define('w_form_ins_erreur_mdp_noMatch','Passwords aren\'t exactly the same');
                define('w_form_ins_erreur_birth_vide','Missing date of birth');
                define('w_form_ins_erreur_birth_invalid','The date of birth is incorrect (dd/mm/yyyy)');
                define('w_form_ins_erreur_birth_noExist','The date of birth doesn\'t exist');
                define('w_form_ins_erreur_birth_futur','The date of birth is on the future');
                define('w_form_ins_erreur_nom_vide','Missing last name');
                define('w_form_ins_erreur_prenom_vide','Missing first name');
                define('w_form_ins_erreur_cgu_vide','Please, accept the terms and conditions');
                define('w_form_ins_erreur_general','Missing part of the form');
        // Ticket
            define('w_form_tic_ticket', 'Ticket');
            define('w_form_tic_posezVotreQuestion', 'Ask your question');
            define('w_form_tic_preventionAbus', 'Notice that all abuse will end in consequence (1500 car. max)');
            define('w_form_tic_saisissezMessage', 'Enter your message');
        // Résultat
            // Ticket - Question
                define('w_form_success_question', 'Your question has been sent (You will have an answer by E-mail)');
                define('w_form_fail_question', 'There\'s an error, please retry');
                define('w_form_success_question_next', 'Back to the menu');
                define('w_form_success_question_previous', 'Back to the menu');
                define('w_form_fail_question_next', 'Restart');
                define('w_form_fail_question_previous', 'Back to the menu');
?>