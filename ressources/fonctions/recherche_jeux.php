<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";

    if(isset($_POST['lang'])){
        $lang = $_POST['lang'];
    } else {
        $lang = 'fr';
    };

    $DB_game = $access_bdd ;
    if (isset($_GET['search_game'])){
        $searched = $_GET['search_game'];
        $prep_req = "SELECT * FROM game WHERE nom_game LIKE '%$searched%' ";
        $req = $DB_game->query($prep_req);
        $req_list = $req->fetchAll();
        foreach($req_list as $r){
            ?>

            <div class="jeux_grille_case">
                <div class="jeux_grille_relative">
                    <div class="jeux_grille_absolute">
                        <a href="/<?php echo $lang;?>/game/<?php echo $r['id_game'];?>">
                            <div class="jeux_pres_content">
                                <div class="jeux_pres_titre"><?php echo $r['nom_game'];?></div>
                                <div class="jeux_pres_img">
                                    <img class="jeux_img_fichier" src="<?php echo $r['image_game']; ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        }
    };
?>