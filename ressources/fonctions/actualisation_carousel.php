<?php
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    };
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
?>
<?php
    $DB_game = $access_bdd ;
    if (isset($_GET['needed_game'])){
        $ng = intval($_GET['needed_game']);

        $num_max = $DB_game -> query("SELECT COUNT(*) AS num FROM game") ;
        $nmax = $num_max -> fetchColumn();
        $nm = intval($nmax);

        if ($ng < 0){
            $ng = -$ng -1 ;
            if ( (intdiv($ng, $nm) % 2) == 0){
                $searched = ($ng % $nm) ;
            } else {
                $searched = $nm - ($ng % $nm) - 1 ;
            };
        } else {
            if ( (intdiv($ng, $nm) % 2) == 0){
                $searched = ($ng % $nm) ;
            } else {
                $searched = $nm - ($ng % $nm) - 1 ;
            };
        };

        $prep_req = "SELECT * FROM game ORDER BY id_game LIMIT 1 OFFSET $searched ";

        $req = $DB_game-> query($prep_req);

        $r = $req -> fetchAll();
        ?>

        <div class="jeux_tendance_contenu clair_sombre" id="/<?php echo $lang ?>/game/<?php echo $r[0]['id_game']; ?>">
            <div class="jeux_pres_content">
                <div class="jeux_pres_titre"><?php echo $r[0]['nom_game'] ?></div>
                <div class="jeux_pres_img">
                    <img class="jeux_img_fichier" src="<?php echo "/ressources/img/game/".$r[0]['image_game']; ?>" alt="">
                </div>
            </div>
        </div>

        <?php
    };
?>