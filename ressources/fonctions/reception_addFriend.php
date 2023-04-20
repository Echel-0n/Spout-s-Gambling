<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
    $bdd = $access_bdd;

    session_start();

    if(isset($_SERVER['HTTP_REFERER'])){$last_page=$_SERVER['HTTP_REFERER'];} ;
    if(isset($_POST['lang'])){
        $lang = $_POST['lang'];
     } else{
        $lang= "fr";
      };

    if(isset($_SESSION['id'])){
        if(isset($_POST['newFriend'])){
            $ajouteur = $_SESSION['id'] ;
            $newFriend = $_POST['newFriend'] ;

            $verif_prep_req = "SELECT * FROM `amis` WHERE amis_ajouteur=$ajouteur && amis_friend=$newFriend && amis_supprimer=0";
            $verif_req = $access_bdd -> query($verif_prep_req);
            $verif_r = $verif_req->fetch();

            if($verif_r == ''){
                $req_inscription = $bdd->prepare("INSERT INTO amis(amis_ajouteur, amis_friend) VALUES (:ajouteur,:newFriend)");
                $req_inscription -> execute(array(
                    'ajouteur' => $ajouteur,
                    'newFriend' => $newFriend
                ));
             }
         }
     }

    if(isset($last_page)){
        header("Location: $last_page");
     } else {
        header("Location: /$lang/");
      };
?>