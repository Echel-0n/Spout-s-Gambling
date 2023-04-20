<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
?>
<?php
    if(isset($_POST['pseudo'])){
        $pseudo = $_POST['pseudo'] ;
        // Connexion à la base de donnée
            $bdd = $access_bdd ;
        // Demande de vérification
            $prep_req_pseudo = "SELECT * FROM `user` WHERE user_pseudo = '$pseudo'";
            $req_pseudo = $bdd -> query($prep_req_pseudo);
            $r_pseudo = $req_pseudo->fetch();
            if ($r_pseudo == ""){
                echo false ;
            } else {
                echo true ;
            };
    }
?>