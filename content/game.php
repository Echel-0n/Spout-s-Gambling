<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";
    $bdd = $access_bdd;

    if (isset($id)){
        $infoIdList = explode('-',$id);
        if (count($infoIdList) == 2 && $infoIdList[1] == "play"){
            $id = $infoIdList[0];
            $prep_game = "SELECT * FROM game WHERE id_game = $id";
            $req_game = $bdd->query($prep_game);
            $game = $req_game->fetch();
            if($game == ''){
                header("Location: /$lang/");
            } else {
                $game_ref = $game['code_game'];
                include $link_include."/ressources/games/$game_ref/game.php";
            }
        } else if (count($infoIdList) == 1) {
            $id = $infoIdList[0];
            include $link_include."/ressources/games/game_pres.php";
        } else{
            header("Location: /$lang/");
        }
    } else {
        header("Location: /$lang/");
    }
?>
