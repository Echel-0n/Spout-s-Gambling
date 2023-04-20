<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
?>
<?php
    // Connexion à la base de donnée
        $bdd = $access_bdd ;

    // On récupère les informations donner lors de l'inscription
    if (isset($_POST['email_inscr']) && isset($_POST['pseudo_inscr']) && isset($_POST['mdp_inscr']) && isset($_POST['confirm_mdp_inscr']) && isset($_POST['nom_inscr']) && isset($_POST['prenom_inscr']) && isset($_POST['birth_inscr'])){
        $email = $_POST['email_inscr'];
        $pseudo = $_POST['pseudo_inscr'];
        $mdp = $_POST['mdp_inscr'];
        $mdp_conf = $_POST['confirm_mdp_inscr'];
        $nom = $_POST['nom_inscr'];
        $prenom = $_POST['prenom_inscr'];
        $dateNais = $_POST['birth_inscr'];

        // On vérifie les informations

        //Vérification email

            if ($email != ''){ // Il y a une adresse e-mail
                if(filter_var($email , FILTER_VALIDATE_EMAIL)){ // Elle est aux normes

                    $prep_req_email = "SELECT * FROM `user` WHERE user_email = '$email'";
                    $req_email = $bdd -> query($prep_req_email);
                    $r_email = $req_email->fetch();

                    if ($r_email == ''){ // Elle n'existe pas dans la base de données
                        $verif_email = true ;
                    } else{ // Elle existe dans la base de données
                        $verif_email = false ;
                        $erreur['email'] = 'email|alreadyExist' ;
                    };
                }else{ // Elle n'est pas normal
                    $verif_email = false ;
                    $erreur['email'] = 'email|invalid' ;
                };
            }else{ // Il n'y a pas d'adresse e-mail
                $verif_email = false ;
                $erreur['email'] = 'email|vide' ;
            };

        //Vérification pseudo

            if ($pseudo != ''){ // Il y a un pseudo
                if (preg_match("/[a-zA-Z0-9À-ÿ\/\_\-\.]{4,12}/", $mdp) ){ // Il correspond au pattern donné

                    $prep_req_pseudo = "SELECT * FROM `user` WHERE user_pseudo = '$pseudo'";
                    $req_pseudo = $bdd -> query($prep_req_pseudo);
                    $r_pseudo = $req_pseudo->fetch();

                    if ($r_pseudo == ''){ // Il n'existe pas déjà dans la base de données
                        $verif_pseudo = true ;
                    } else{ // Il existe déjà dans la base de données
                        $verif_pseudo = false ;
                        $erreur['pseudo'] = 'pseudo|alreadyExist' ;
                    };
                } else{ // Il ne correspond pas au pattern
                    $verif_pseudo = false ;
                    $erreur['pseudo'] = 'pseudo|invalid' ;
                };
            } else{ // Il n'y a pas de pseudo
                $verif_pseudo = false ;
                $erreur['pseudo'] = 'pseudo|vide' ;
            };

        //Vérification mdp
        
            if  ($mdp != ''){ // Le mot de passe n'est pas vide
                if ($mdp == $mdp_conf){ // Le mot de passe et sa confirmation sont identiques
                    if(preg_match("/[a-zA-Z0-9à-ÿ\/\_\-\.\,]{6,}/", $mdp) ){ // Le mot de passe correspond au pattern donné
                        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT) ;
                        $verif_mdp = true ;
                    } else{ // Le mot de passe ne correspond pas au pattern
                        $verif_mdp = false ;
                        $erreur['mdp'] = 'mdp|invalid' ;
                    };
                } else { // Les deux mots de passe donnés sont différents
                    $verif_mdp = false ;
                    $erreur['mdp'] = 'mdp|noMatch' ;
                };
            } else { // Le mot de passe est inexistant
                $verif_mdp = false ;
                $erreur['mdp'] = 'mdp|vide' ;
            };

        //Vérification date de naissance

            if ($dateNais != ""){ // La date de naissance n'est pas vide
                if(preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $dateNais)){ // La date de naissance correspond au pattern donné
                    $date_nais_list = explode('/', $dateNais);
                    if (count($date_nais_list) == 3){ // La date de naissance est bien composée de 3 parties
                        $jour_nais = $date_nais_list[0];
                        $mois_nais = $date_nais_list[1];
                        $annee_nais = $date_nais_list[2];
    
                        $dateNaisSQL = $annee_nais.'-'.$mois_nais.'-'.$jour_nais ;
    
                        if (checkdate(intval($mois_nais), intval($jour_nais), intval($annee_nais))){ // La date indiquée existe
                            if (strtotime(date('Y-m-j')) > strtotime($dateNaisSQL)){ // La date indiquée est inférieure à la date actuelle
                                $verif_dateNais = true ;
                            } else{ // La date indiquée est future
                                $verif_dateNais = false ;
                                $erreur['birth'] = 'birth|futur' ;
                            }
                        } else{ // La date n'existe pas
                            $verif_dateNais = false ;
                            $erreur['birth'] = 'birth|noExist' ;
                        }
                    } else{ // La date n'est pas composée de 3 parties
                        $verif_dateNais = false ;
                        $erreur['birth'] = 'birth|invalid' ;
                    };
                } else{ // La date ne correspond pas au pattern
                    $verif_dateNais = false ;
                    $erreur['birth'] = 'birth|invalid' ;
                };
            } else{ // La date est vide
                $verif_dateNais = false ;
                $erreur['birth'] = 'birth|vide' ;
            };

        //Vérification nom
            if ($nom != ''){
                $verif_nom = true ;
            } else {
                $verif_nom = false ;
                $erreur['nom'] = 'nom|vide' ;
            };

        //Vérification prénom
            if ($prenom != ''){
                $verif_prenom = true ;
            } else {
                $verif_prenom = false ;
                $erreur['prenom'] = 'prenom|vide' ;
            };

        //Vérification de l'acceptation des CGU

            if (isset($_POST['cgu_inscr'])){
                $verif_cgu = true ;
            } else {
                $verif_cgu = false ;
                $erreur['cgu'] = 'cgu|vide' ;
            };

        //Envoie des données à la base de données
            if(isset($_POST['lang'])){
                $lang = $_POST['lang'];
            }else{
                $lang = "fr";
            };

            if ($verif_email && $verif_pseudo && $verif_mdp && $verif_dateNais && $verif_nom && $verif_prenom && $verif_cgu){
                $req_inscription = $bdd->prepare("INSERT INTO user(user_email, user_mdp, user_pseudo, user_nb_jeton, user_admin, user_ban_def, user_nom, user_prenom, user_birth) VALUES (:email,:mdp,:pseudo,:nb_jeton,:user_admin,:ban_def,:nom,:prenom,:dateNais)");
                $req_inscription -> execute(array(
                    'email' => $email,
                    'mdp' => $mdp_hash,
                    'pseudo' => $pseudo,
                    'nb_jeton' => 1000,
                    'user_admin' => 0,
                    'ban_def' => 0,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'dateNais' => $dateNaisSQL
                ));
                
                header("Location: /$lang/connexion/");

            } else{ ?>
                <form name="form" action="/<?php echo $lang?>/inscription/" method="post">
                    <?php foreach($erreur as $e){
                        $a = explode('|',$e) ;
                        ?>
                        <input type="hidden" name="erreur_<?php echo $a[0] ;?>" value="<?php echo $a[1];?>">
                        <?php
                    }
                    ?>
                    <input type="hidden" name="last_page" value="<?php if(isset($_POST['last_page'])){echo $_POST['last_page'];};?>">
                    <input type="hidden" name="email" value="<?php if(isset($_POST['email_inscr'])){echo $_POST['email_inscr'];};?>">
                    <input type="hidden" name="pseudo" value="<?php if(isset($_POST['pseudo_inscr'])){echo $_POST['pseudo_inscr'];};?>">
                    <input type="hidden" name="nom" value="<?php if(isset($_POST['nom_inscr'])){echo $_POST['nom_inscr'];};?>">
                    <input type="hidden" name="prenom" value="<?php if(isset($_POST['prenom_inscr'])){echo $_POST['prenom_inscr'];};?>">
                    <input type="hidden" name="birth" value="<?php if(isset($_POST['birth_inscr'])){echo $_POST['birth_inscr'];};?>">
                    <input type="hidden" name="cgu" value="<?php if(isset($_POST['cgu_inscr'])){echo "on";};?>">
                </form>
                <<script>
                    document.form.submit()
                </script>
                <?php
            };
    } else{ ?>
        <form name="form" action="/<?php if(isset($_POST['lang'])){echo $_POST['lang'];}else{echo "fr";};?>/inscription/" method="post">
            <input type="hidden" name="erreur_general" value="missingInfo">
            <input type="hidden" name="last_page" value="<?php if(isset($_POST['last_page'])){echo $_POST['last_page'];};?>">
            <input type="hidden" name="email" value="<?php if(isset($_POST['email_inscr'])){echo $_POST['email_inscr'];};?>">
            <input type="hidden" name="pseudo" value="<?php if(isset($_POST['pseudo_inscr'])){echo $_POST['pseudo_inscr'];};?>">
            <input type="hidden" name="nom" value="<?php if(isset($_POST['nom_inscr'])){echo $_POST['nom_inscr'];};?>">
            <input type="hidden" name="prenom" value="<?php if(isset($_POST['prenom_inscr'])){echo $_POST['prenom_inscr'];};?>">
            <input type="hidden" name="birth" value="<?php if(isset($_POST['birth_inscr'])){echo $_POST['birth_inscr'];};?>">
            <input type="hidden" name="cgu" value="<?php if(isset($_POST['cgu_inscr'])){echo "on";};?>">
        </form>
        <script>
            document.form.submit()
        </script>
        <?php
    };
?>