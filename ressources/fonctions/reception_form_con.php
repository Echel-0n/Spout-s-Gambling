<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
?>
<?php
    // Connexion à la base de donnée
        $bdd = $access_bdd ;
        
    // On récupère les informations donner lors de l'inscription
    if (isset($_POST['email_con']) && isset($_POST['mdp_con'])){
        $email = $_POST['email_con'];
        $mdp = $_POST['mdp_con'];

        $prep_req = "SELECT * FROM `user` WHERE user_email = '$email'";
        $req = $bdd -> query($prep_req);
        $r = $req->fetch();

        $mdp_correct = password_verify($mdp, $r['user_mdp']);

        if (!$r){ //email incorrect
            $mess = "w_form_con_email_mdp_incorrect" ;
            error($mess) ;
        } else {
            if ($mdp_correct){ // Tout est bon
                session_start();
                $_SESSION['id'] = $r['user_id'];
                $_SESSION['email'] = $r['user_email'];
                if (isset($_POST['last_page'])){
                    $NoInsLastPag = str_replace('inscription/','',$_POST['last_page']);
                    $NoInsLastPage = str_replace('inscription','',$NoInsLastPag);
                    header('Location: '. $NoInsLastPage) ;
                } else{
                    if (isset($_POST['lang'])){
                        header('Location: /'.$_POST['lang'].'/') ;
                    } else {
                        header('Location: /') ;
                    };
                };
            } else{ //mot de passe incorrect
                $mess = "w_form_con_email_mdp_incorrect" ;
                error($mess) ;
            };
        };
    };
?>

<?php function error($info){ ?>

    <form name="form" action="/<?php if(isset($_POST['lang'])){echo $_POST['lang'];}else{echo "fr";};?>/connexion/" method="post">
        <input type="hidden" name="erreur" value="<?php echo $info ?>">
        <?php if (isset($_POST['last_page'])){?>
            <input type="hidden" name="last_page" value="<?php echo $_POST['last_page'] ;?>">
        <?php } ?>
        <input type="hidden" name="email" value="<?php if(isset($_POST['email_con'])){echo $_POST['email_con'];};?>">
    </form>
    <script>
        document.form.submit()
    </script>

<?php }; ?>