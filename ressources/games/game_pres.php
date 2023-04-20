<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";
    $bdd = $access_bdd;

    $prep_req = "SELECT * FROM game WHERE id_game = $id";
    $req = $bdd -> query($prep_req);
    $r = $req->fetch();

    if($r == ""){
        header("Location: /$lang/");
    }

    $game_id = $r['id_game'];
    $game_nom = $r['nom_game'];
    $game_descr = $r['description_game'];
    $game_image = $r['image_profil_game'];
    $game_code = $r['code_game'];

    $prep_req_nbParties = "SELECT COUNT(*) as nbParties FROM partie WHERE game_id = $game_id AND partie_fini = 0";
    $req_nbParties = $bdd -> query($prep_req_nbParties);
    $r_nbParties = $req_nbParties->fetch();

    $game_nombre_parties = $r_nbParties['nbParties'];

    if($connected){
        // Vérification de si une partie est déjà en cour
        $prep_donnee_verifPartie = "SELECT * FROM partie WHERE user_id=$user_id AND game_id=$game_id AND partie_fini=0";
        $req_donnee_verifPartie = $bdd -> query($prep_donnee_verifPartie);
        $donnee_verifPartie = $req_donnee_verifPartie->fetch();
        if($donnee_verifPartie != ""){
            $dejaUnePartie = true;
        } else {
            $dejaUnePartie = false;

            // Récupération de la dernière mise
            $prep_donnee_lastPartie = "SELECT * FROM partie WHERE user_id=$user_id AND game_id=$game_id AND partie_fini=1 ORDER BY partie_id DESC";
            $req_donnee_lastPartie = $bdd -> query($prep_donnee_lastPartie);
            $donnee_lastPartie = $req_donnee_lastPartie->fetchALL();

            if(count($donnee_lastPartie) != 0){
                $lastMise = $donnee_lastPartie[0]['partie_jetonMise'];
                $lastMise_bool = true;
            } else {
                $lastMise_bool = false;
            }
        }

    }
    
?>

<div id="game_content" class="scrollbar <?php if($a_game){echo "u_prop";}else{echo "u_view";};?>">
    <!--Profile visible par tout le monde-->
    <div id="game_profile">
        <div id="game_info">
            <div id="game_pres">
                <div id="game_profilImg_parent" class="game_info_content">
                    <div id="game_profilImg">
                        <img src="/ressources/img/game/<?php echo $game_image;?>" id="game_profilImg_img" alt="">
                        <img src="/ressources/img/logo/logo_spoutsgambling.png" id="game_certifiedImg" alt="">
                    </div>
                    </div>
                <div id="game_bigName_parent" class="game_info_content">
                    <div id="game_bigName">
                        <?php echo htmlspecialchars($game_nom);?>
                    </div>
                    </div>
                <div id="game_nombParties_parent" class="game_info_content">
                    <div id="user_nombPartiesImg">
                        <img id="user_nombPartiesImg_img" src="/ressources/img/jeton_jeux.png" title="<?php echo w_game_nbParties ;?>">
                    </div>
                    <div id="game_nombParties">
                        <?php echo htmlspecialchars($game_nombre_parties);?>
                    </div>
                    </div>
                <div id="game_play_parent" class="game_info_content">
                    <div id="game_play">
                        <?php 
                        if($connected){
                            if($dejaUnePartie){ ?>
                                <a href="<?php echo "/$lang/game/$game_id-play";?>">
                                    <button type="submit" id="game_play_button" class="clair_sombre" form="game_play_form">
                                    <?php
                                        echo w_game_continue ;
                                    ?>
                                    </button>
                                </a>
                            <?php } else{ ?>
                                <form id="game_play_form" action="<?php echo "/$lang/game/$game_id-play";?>" method="post">
                                    <div id="game_play_miseInput_parent">
                                        <input name="mise" type="range" min="75" max="375" step="1" id="game_play_miseInput" onchange="compteur_mise()" onmousemove="compteur_mise()" value="<?php if($lastMise_bool){echo $lastMise;}else{echo "150";};?>">
                                        <div id="game_play_miseInput_compteur"></div>
                                    </div>
                                </form>
                                <button type="submit" id="game_play_button" class="clair_sombre" form="game_play_form">
                                <?php
                                    echo w_game_play ;
                                ?>
                                </button>
                            <?php };
                        }else{?>
                            <a href="/<?php echo $lang;?>/connexion/">
                                <div id="game_play_button" class="clair_sombre">
                                    <?php echo w_game_noConnect ;?>
                                </div>
                            </a>
                        <?php }; ?>
                    </div>
                    </div>
                </div>
            </div>
        <div id="game_stat">
            <div id="game_stat_titre_parent">
                <div id="game_stat_titre">
                    <?php echo w_game_rules ;?>
                </div>
             </div>
            <div id="game_stat_contenu">
                <?php 
                    $linkRules = $link_include."/ressources/games/$game_code/rules.php";
                    if (file_exists($linkRules)){
                        include $linkRules ;
                    } else{
                    ?>
                    <div id="game_stat_indiponibles">
                        <?php echo w_game_info_indisponibles ;?>
                    </div>
                    <?php } ?>
             </div>
         </div>
     </div>
</div>

<link rel="stylesheet" href="/ressources/css/game.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/barre_rech.js"></script>
<script src="/ressources/js/game.js"></script>  
<script>
    document.title = "<?php echo $game_nom ;?> - Spout\'s Gambling"
</script>