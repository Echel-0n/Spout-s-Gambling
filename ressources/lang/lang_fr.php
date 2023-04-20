<?php
    // Base
        // Barre Gauche
            define('w_bg_mode_sombre','Mode sombre');
            define('w_bg_mode_daltonien','Mode daltonien');
            define('w_bg_langue','Langue');
            define('w_bg_connexion','Connexion');
            define('w_bg_inscription','Inscription');
            define('w_bg_deconnexion','Déconnexion');
        // Pied de page
            define('w_pp_politique_conf','Politique De Confidentialité');
            define('w_pp_term_cond','Termes et Conditions');
            define('w_pp_faq','FAQ');
            define('w_pp_contact_us','Nous contacter');
    // Barre de recherche
        define('w_rb_rechecher', 'Rechercher');
    // Menu (Carousel)
        define('w_carousel_affiche_plus','Afficher plus +');
        define('w_carousel_affiche_moins','Afficher moins -');
        define('w_recherche_aucun_resultat','Aucun résultat');
    // Utilisateurs
        define('w_user_user','Utilisateur');
    // Page texte
        // FAQ
            define('w_text_faq', 'FAQ');
            define('w_text_faq_rechQuestion', 'Rechercher une question');
            define('w_text_faq_autreQuestion__', 'Une autre question?');
            define('w_text_faq__poserLaNous', 'Posez-la nous');
        // Politique de confidentialité
            define('w_text_privacy_policy', 'Politique de Confidentialité');
    // Page utilisateur$
        define('w_user_rechercher', 'Rechercher un utilisateur');
        define('w_user_rechercher_noResult', 'Pas de résultat');
        define('w_user_friends', 'Amis');
        define('w_user_addFriends_noConnect', 'Connectez-vous');
        define('w_user_addFriend_add', 'Ajouter en ami');
        define('w_user_addFriend_already', 'Déja ami');
        define('w_user_addFriend_already_delete', 'Déja ami <br> Supprimer ?');
        define('w_user_addFriend_himself', 'C\'est votre profil');
        define('w_user_stat_gameStats','Statistiques de jeux');
        define('w_user_stat_indisponibles','Actuellement INDISPONIBLE');
    // Page jeux
        define('w_game_rechercher', 'Rechercher un jeu');
        define('w_game_rechercher_noResult', 'Pas de résultat');
        define('w_game_friends', 'Amis');
        define('w_game_noConnect', 'Connectez-vous');
        define('w_game_play', 'Jouer');
        define('w_game_nbParties', 'Nombres de parties en cour');
        define('w_game_infos', 'Infos');
        define('w_game_rules', 'Règles');
        define('w_game_continue', 'Continuer');
        define('w_game_info_indisponibles','Actuellement INDISPONIBLE');
    // Formulaire
        define('w_form_goHome', 'Retour au menu');
        define('w_form_success', 'Succès');
        define('w_form_fail', 'Erreur');
        define('w_form_suivant','Suivant');
        define('w_form_retour', 'Retour');
        define('w_form_envoyer', 'Envoyer');
        define('w_form_adresse_email','Adresse e-mail');
        define('w_form_mot_de_passe','Mot de passe');
        define('w_form_afficher_mdp','Afficher le mot de passe');
        define('w_form_terminer', 'Terminer');
        // Connexion
            define('w_form_connexion','Connexion');
            define('w_form_creer_compte','Créer un compte');
            define('w_form_mdp_oublie','Mot de passe oublié ?');
            // Erreurs
                define('w_form_con_email_vide','Saisissez une adresse e-mail');
                define('w_form_con_email_invalide','Saisissez une adresse e-mail valide');
                define('w_form_con_mdp_vide','Saisissez un mot de passe');
                define('w_form_con_mdp_invalide','Mot de passe trop court');
                define('w_form_con_email_mdp_incorrect','Adresse e-mail ou mot de passe incorrect');
        // Inscription
            define('w_form_inscription', 'Inscription');
            define('w_form_deja_compte','Déjà un compte? <br> Connexion');
            define('w_form_pseudo', 'Pseudo');
            define('w_form_pseudo_invalide', 'Saisissez un pseudo valide');
            define('w_form_confirm_mdp','Confirmez le mot de passe');
            define('w_form_user_nom', 'Nom');
            define('w_form_user_prenom', 'Prénom');
            define('w_form_user_birthDate', 'Date de naissance');
            define('w_form_cgu_accept', 'Accepter les termes et conditions');
            define('w_form_cgu_refuse', 'Refuser et annuler');
            // Erreurs
                define('w_form_ins_email_vide','Saisissez une adresse e-mail');
                define('w_form_ins_email_invalide','Saisissez une adresse e-mail valide');
                define('w_form_ins_pseudo_vide','Saisissez un pseudo');
                define('w_form_ins_pseudo_invalide','Pseudo incorrect (entre 4 et 12 caractères, sont autorisés les lettres minuscules, majuscules, accentées, les - , _ , et les / , ainsi que les chiffres)');
                define('w_form_ins_pseudo_alreadyExist','Pseudo déjà utilisé');
                define('w_form_ins_pseudo_noExist','Pseudo libre');
                define('w_form_ins_mdp_vide','Saisissez un mot de passe');
                define('w_form_ins_mdp_court','Mot de passe trop court (min. 6 caractères)');
                define('w_form_ins_mdp_invalide','Mot de passe invalide (min. 6 caractères, sont autorisés les lettres minuscules, majuscules, accentées, les "," , - , _ , . , et les / , ainsi que les chiffres)');
                define('w_form_ins_nonIdentique_mdp','Les mots de passe ne sont pas identiques');
                define('w_form_ins_nom_vide','Saisissez votre Nom');
                define('w_form_ins_prenom_vide','Saisissez votre Prénom');
                define('w_form_ins_bday_vide','Saisissez votre date de naissance');
                define('w_form_ins_bday_invalid_format','La date de naissance doit être au format jj/mm/aaaa');
                define('w_form_ins_bday_notExist','La date saisie n\'existe pas');
                define('w_form_ins_bday_inFuture','La date est ultérieure à la date actuelle');
                define('w_form_ins_cgu_notAccepted','Veuillez accepter les CGU en cochant la case ci-dessus');

                define('w_form_ins_erreur_email_vide','Adresse e-mail manquante');
                define('w_form_ins_erreur_email_invalid','Adresse e-mail invalide');
                define('w_form_ins_erreur_email_alreadyExist','Un compte existe déjà avec cette adresse e-mail');
                define('w_form_ins_erreur_pseudo_vide','Pseudo manquante');
                define('w_form_ins_erreur_pseudo_invalid','Pseudo invalide');
                define('w_form_ins_erreur_pseudo_alreadyExist','Un compte existe déjà avec ce pseudo');
                define('w_form_ins_erreur_mdp_vide','Mot de passe manquant');
                define('w_form_ins_erreur_mdp_invalid','Mot de passe invalide');
                define('w_form_ins_erreur_mdp_noMatch','Les deux mots de passe donnés ne se correspondent pas');
                define('w_form_ins_erreur_birth_vide','Date de naissance manquante');
                define('w_form_ins_erreur_birth_invalid','Date de naissance invalide (jj/mm/aaaa)');
                define('w_form_ins_erreur_birth_noExist','La date de naissance indiquée n\'existe pas');
                define('w_form_ins_erreur_birth_futur','La date de naissance indiquée se situe dans le futur');
                define('w_form_ins_erreur_nom_vide','Nom manquant');
                define('w_form_ins_erreur_prenom_vide','Prénom manquant');
                define('w_form_ins_erreur_cgu_vide','Veuillez valider nos CGU');
                define('w_form_ins_erreur_general','Partie du formulaire manquante');
        // Ticket
            define('w_form_tic_ticket', 'Ticket');
            define('w_form_tic_posezVotreQuestion', 'Posez votre question');
            define('w_form_tic_preventionAbus', 'Notez que tout abus aboutira à une sanction  (1500 car. max)');
            define('w_form_tic_saisissezMessage', 'Saisissez un message');
        // Résultat
            // Ticket - Question
                define('w_form_success_question', 'Votre question a bien été envoyée (Une réponse vous sera sûrement envoyée par e-mail)');
                define('w_form_fail_question', 'Il y a eu une erreur, veuillez recommencer');
                define('w_form_success_question_next', 'Retour au menu');
                define('w_form_success_question_previous', 'Retour au menu');
                define('w_form_fail_question_next', 'Réessayer');
                define('w_form_fail_question_previous', 'Retour au menu');
?>