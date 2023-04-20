<?php
 $link_include = $_SERVER['DOCUMENT_ROOT'];
 include $link_include."/ressources/fonctions/info_base_donnee.php";
 $bdd = $access_bdd;

 if(!isset($lang)){
    $lang = 'fr';
 }
 $fichier_lang = "$link_include/ressources/games/yams/lang/lang_$lang.php";
 if(file_exists($fichier_lang)){
    include $fichier_lang ;
 }
    
 if(isset($_SESSION['id'])){
    $user_id_ = $_SESSION['id'];

    $prep_num_game = "SELECT * FROM game WHERE code_game='yams'";
    $req_num_game = $bdd->query($prep_num_game);
    $num_game = $req_num_game->fetch();
    if($num_game == ''){
        header("Location: /$lang/");
    } else{
        $game = $num_game['id_game'];
    }

    $prep_donnee_game = "SELECT * FROM partie WHERE user_id=$user_id_ AND game_id=$game AND partie_fini=0";
    $req_donnee_game = $bdd -> query($prep_donnee_game);
    $donnee_game = $req_donnee_game->fetch();

    if(!$donnee_game){
        if(isset($_POST['mise'])){
           $mise = $_POST['mise'];
        }else{
            header("Location: /$lang/game/$id");
        }
        $creationPartie = $bdd -> prepare("INSERT INTO partie(user_id, game_id, partie_jetonMise) VALUES (:user_id_, :game_id, :mise)");
        $creationPartie -> execute(array(
            'user_id_' => $user_id_,
            'game_id' => $game,
            'mise' => $mise // A MODIFIER
        ));

        $prep_donnee_newPartie = "SELECT * FROM partie WHERE user_id=$user_id_ AND game_id=$game AND partie_fini=0";
        $req_donnee_newPartie = $bdd -> query($prep_donnee_newPartie);
        $donnee_newPartie = $req_donnee_newPartie->fetch();

        $partie_id = $donnee_newPartie['partie_id'];
        
        $newAction = "fst_tir";
        $newGame = true;
    }else{
        $partie_id = $donnee_game['partie_id'];
        $prep_donnee_partie = "SELECT * FROM partie_evolution WHERE partie_id=$partie_id ORDER BY partie_evolution_id DESC";
        $req_donnee_partie = $bdd->query($prep_donnee_partie);
        $donnee_partie = $req_donnee_partie->fetchAll();
        //echo $donnee_partie[0]['partie_evolution_id'];
        if(count($donnee_partie) == 0){
            $newAction = "fst_tir";
            $newGame = true;
        }else{
            $newAction = "";
            $newGame = false;
        }
    }

    $des_code = array(
        'des_val1' => '
            <div id="game_yams_des_val1" class="game_yams_des_val">
                <div class="game_yams_des_val_pointCentre game_yams_des_val_point"></div>
            </div>',
        'des_val2' => '
            <div id="game_yams_des_val2" class="game_yams_des_val">
                <div class="game_yams_des_val_pointHautGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasDroite game_yams_des_val_point"></div>
            </div>',
        'des_val3' => '
            <div id="game_yams_des_val3" class="game_yams_des_val">
                <div class="game_yams_des_val_pointCentre game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointHautGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasDroite game_yams_des_val_point"></div>
            </div>',
        'des_val4' => '
            <div id="game_yams_des_val4" class="game_yams_des_val">
                <div class="game_yams_des_val_pointHautGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointHautDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasGauche game_yams_des_val_point"></div>
            </div>',
        'des_val5' => '
            <div id="game_yams_des_val5" class="game_yams_des_val">
                <div class="game_yams_des_val_pointCentre game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointHautGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointHautDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasGauche game_yams_des_val_point"></div>
            </div>',
        'des_val6' => '
            <div id="game_yams_des_val6" class="game_yams_des_val">
                <div class="game_yams_des_val_pointHautGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointHautDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointBasGauche game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointDroite game_yams_des_val_point"></div>
                <div class="game_yams_des_val_pointGauche game_yams_des_val_point"></div>
            </div>',
    );

    if($newGame){
        $action = $newAction;

        // Lancement des tirages de dés

        $des1 = rand(1,6);
        $des2 = rand(1,6);
        $des3 = rand(1,6);
        $des4 = rand(1,6);
        $des5 = rand(1,6);
        $des6 = rand(1,6);

        $des1_str = "des_val".strval($des1);
        $des2_str = "des_val".strval($des2);
        $des3_str = "des_val".strval($des3);
        $des4_str = "des_val".strval($des4);
        $des5_str = "des_val".strval($des5);
        
        $PHP_RETURN_DES = "
                <div id='game_yams_partDes' class='clair_sombre sombre'>
                    <div class='game_yams_des_parent ' id='game_yams_des_parent_1' onclick='select_des(this)'>
                        <div class='game_yams_des'>$des_code[$des1_str]</div>
                    </div>
                    <div class='game_yams_des_parent' id='game_yams_des_parent_2' onclick='select_des(this)'>
                        <div class='game_yams_des'>$des_code[$des2_str]</div>
                    </div>
                    <div class='game_yams_des_parent' id='game_yams_des_parent_3' onclick='select_des(this)'>
                        <div class='game_yams_des'>$des_code[$des3_str]</div>
                    </div>
                    <div class='game_yams_des_parent' id='game_yams_des_parent_4' onclick='select_des(this)'>
                        <div class='game_yams_des'>$des_code[$des4_str]</div>
                    </div>
                    <div class='game_yams_des_parent' id='game_yams_des_parent_5' onclick='select_des(this)'>
                        <div class='game_yams_des'>$des_code[$des5_str]</div>
                    </div>
                </div>";

        $des = array($des1,$des2,$des3,$des4,$des5);
        $somme_des = array_sum($des);
        $s1 = 0;
        $s2 = 0;
        $s3 = 0;
        $s4 = 0;
        $s5 = 0;
        $s6 = 0;

        foreach($des as $d){ // Points à gagner dans la colonne de gauche (sauf dernière ligne)
            if ($d == 1) {
                $s1 += 1;
            }
            if ($d == 2) {
                $s2 += 2;
            }
            if ($d == 3) {
                $s3 += 3;
            }
            if ($d == 4) {
                $s4 += 4;
            }
            if ($d == 5) {
                $s5 += 5;
            }
            if ($d == 6) {
                $s6 += 6;
            }
        }

        // Vérification brelan et carré et full
        $sBrelan = 0;
        $sCarre = 0;
        $sFull = 0;
        for ($i = 0; $i<count($des); $i++){ 
            for ($j = 0; $j<count($des); $j++){
                for ($k = 0; $k < count($des); $k++){
                    if($k != $j && $k != $i && $j != $i){ // Vérification Brelan
                        if($des[$i] == $des[$j] && $des[$j] == $des[$k]){
                            $sBrelan = $somme_des;
                            for($l = 0; $l < count($des); $l++){ // Vérification Carré
                                if($l != $i && $l != $j && $l != $k){
                                    if ($des[$i] == $des[$l]){
                                        $sCarre = $somme_des;
                                    }
                                    for($m = 0; $m < count($des); $m++){ // Vérification Full
                                        if($m != $i && $m != $j && $m != $k && $m != $l){
                                            if($des[$l] == $des[$m]){
                                                $sFull = 25;
                                            }
                                        }
                                    }
                                }
                            };
                        }
                    }
                }
            }
        }

        // Vérification Suites

        $sPetiteSuite = 0;
        $sGrandeSuite = 0;

        foreach($des as $d){
            $pSuiteExemple1 = array(1,2,3,4,$d);
            $pSuiteExemple2 = array(2,3,4,5,$d);
            $pSuiteExemple3 = array(3,4,5,6,$d);
            $compare1 = array_intersect($pSuiteExemple1, $des);
            $compare2 = array_intersect($pSuiteExemple2, $des);
            $compare3 = array_intersect($pSuiteExemple3, $des);
            if(count($compare1) == count($pSuiteExemple1) || count($compare2) == count($pSuiteExemple2) || count($compare3) == count($pSuiteExemple3)){
                $sPetiteSuite = 30;
            }
        }
        
        $gSuiteExemple1 = array(1,2,3,4,5);
        $gSuiteExemple2 = array(2,3,4,5,6);

        $compare1 = array_intersect($gSuiteExemple1, $des);
        $compare2 = array_intersect($gSuiteExemple2, $des);

        if(count($compare1) == count($gSuiteExemple1) || count($compare2) == count($gSuiteExemple2)){
            $sGrandeSuite = 40;
        }

        // Vérification Yams
        if ($des1 == $des2 && $des2 == $des3 && $des3 == $des4 && $des4 == $des5){
            $sYams = 50 ;
        } else {
            $sYams = 0 ;
        }

        // Chance
        $sChance = $somme_des;

        $sTotal = 0;
        $sBonus = 0;

        $BDDaction = $newAction;
        $BDDvalue = "1:$des1!2:$des2!3:$des3!4:$des4!5:$des5|1:$s1!2:$s2!3:$s3!4:$s4!5:$s5!6:$s6!7:$sBonus!8:$sBrelan!9:$sCarre!10:$sFull!11:$sPetiteSuite!12:$sGrandeSuite!13:$sYams!14:$sChance|total:$sTotal";

        $newHistorique = $bdd->prepare("INSERT INTO partie_evolution(partie_id,partie_evolution_action,partie_evolution_value) VALUES (:partie_id,:action_,:value_)");
        $newHistorique -> execute(array(
            'partie_id' => $partie_id,
            'action_' => $BDDaction,
            'value_' => $BDDvalue
        ));

    } else {
        $action = $donnee_partie[0]['partie_evolution_action'];
        $value = $donnee_partie[0]['partie_evolution_value'];

        $za = explode('|',$value);

        for($a=0;$a<count($za);$a++){
            $zb = explode('!',$za[$a]);

            for($b=0;$b<count($zb);$b++){
                $zc = explode('~',$zb[$b]);

                for($c=0;$c<count($zc);$c++){
                    $zd = explode(':',$zc[$c]);

                    for($d=0;$d<count($zd);$d++){
                        $v[$a][$b][$c][$d] = $zd[$d];
                        if($zd[$d] != "keep" && $zd[$d] != "keepUser"){
                            $z[$a][$b][$c][$d] = $zd[$d];
                        }
                    }
                }

            }

        };

        $des1 = $v[0][0][0][1];
        $des2 = $v[0][1][0][1];
        $des3 = $v[0][2][0][1];
        $des4 = $v[0][3][0][1];
        $des5 = $v[0][4][0][1];

        if(count($v[0][0]) == 2 && $v[0][0][1][0] == 'keep'){
            $des1_selected = 'selected_des';
        } else{
            $des1_selected = '';
        };
        if(count($v[0][1]) == 2 && $v[0][1][1][0] == 'keep'){
            $des2_selected = 'selected_des';
        } else{
            $des2_selected = '';
        };
        if(count($v[0][2]) == 2 && $v[0][2][1][0] == 'keep'){
            $des3_selected = 'selected_des';
        } else{
            $des3_selected = '';
        };
        if(count($v[0][3]) == 2 && $v[0][3][1][0] == 'keep'){
            $des4_selected = 'selected_des';
        } else{
            $des4_selected = '';
        };
        if(count($v[0][4]) == 2 && $v[0][4][1][0] == 'keep'){
            $des5_selected = 'selected_des';
        } else{
            $des5_selected = '';
        };

        $des1_str = "des_val".strval($des1);
        $des2_str = "des_val".strval($des2);
        $des3_str = "des_val".strval($des3);
        $des4_str = "des_val".strval($des4);
        $des5_str = "des_val".strval($des5);

        $PHP_RETURN_DES = "
            <div id='game_yams_partDes' class='clair_sombre sombre'>
                <div class='game_yams_des_parent $des1_selected' id='game_yams_des_parent_1' onclick='select_des(this)'>
                    <div class='game_yams_des'>$des_code[$des1_str]</div>
                </div>
                <div class='game_yams_des_parent $des2_selected' id='game_yams_des_parent_2' onclick='select_des(this)'>
                    <div class='game_yams_des'>$des_code[$des2_str]</div>
                </div>
                <div class='game_yams_des_parent $des3_selected' id='game_yams_des_parent_3' onclick='select_des(this)'>
                    <div class='game_yams_des'>$des_code[$des3_str]</div>
                </div>
                <div class='game_yams_des_parent $des4_selected' id='game_yams_des_parent_4' onclick='select_des(this)'>
                    <div class='game_yams_des'>$des_code[$des4_str]</div>
                </div>
                <div class='game_yams_des_parent $des5_selected' id='game_yams_des_parent_5' onclick='select_des(this)'>
                    <div class='game_yams_des'>$des_code[$des5_str]</div>
                </div>
            </div> ";
        
        $s1 = $v[1][0][0][1];
        $s2 = $v[1][1][0][1];
        $s3 = $v[1][2][0][1];
        $s4 = $v[1][3][0][1];
        $s5 = $v[1][4][0][1];
        $s6 = $v[1][5][0][1];
        $sBonus = $v[1][6][0][1];

        $sBrelan = $v[1][7][0][1];
        $sCarre = $v[1][8][0][1];
        $sFull = $v[1][9][0][1];
        $sPetiteSuite = $v[1][10][0][1];
        $sGrandeSuite = $v[1][11][0][1];
        $sYams = $v[1][12][0][1];
        $sChance = $v[1][13][0][1];

        $sTotal = $v[2][0][0][1];

        if (count($v[1][0]) == 2 && $v[1][0][1][0] == 'keepPHP'){
            $s1_selected = 'selected_score_byPHP';
        } else {
            $s1_selected = '';
        }
        if (count($v[1][1]) == 2 && $v[1][1][1][0] == 'keepPHP'){
            $s2_selected = 'selected_score_byPHP';
        } else {
            $s2_selected = '';
        }
        if (count($v[1][2]) == 2 && $v[1][2][1][0] == 'keepPHP'){
            $s3_selected = 'selected_score_byPHP';
        } else {
            $s3_selected = '';
        }
        if (count($v[1][3]) == 2 && $v[1][3][1][0] == 'keepPHP'){
            $s4_selected = 'selected_score_byPHP';
        } else {
            $s4_selected = '';
        }
        if (count($v[1][4]) == 2 && $v[1][4][1][0] == 'keepPHP'){
            $s5_selected = 'selected_score_byPHP';
        } else {
            $s5_selected = '';
        }
        if (count($v[1][5]) == 2 && $v[1][5][1][0] == 'keepPHP'){
            $s6_selected = 'selected_score_byPHP';
        } else {
            $s6_selected = '';
        }
        if (count($v[1][6]) == 2 && $v[1][6][1][0] == 'keepPHP'){
            $sBonus_selected = 'selected_score_byPHP';
        } else {
            $sBonus_selected = '';
        }
        if (count($v[1][7]) == 2 && $v[1][7][1][0] == 'keepPHP'){
            $sBrelan_selected = 'selected_score_byPHP';
        } else {
            $sBrelan_selected = '';
        }
        if (count($v[1][8]) == 2 && $v[1][8][1][0] == 'keepPHP'){
            $sCarre_selected = 'selected_score_byPHP';
        } else {
            $sCarre_selected = '';
        }
        if (count($v[1][9]) == 2 && $v[1][9][1][0] == 'keepPHP'){
            $sFull_selected = 'selected_score_byPHP';
        } else {
            $sFull_selected = '';
        }
        if (count($v[1][10]) == 2 && $v[1][10][1][0] == 'keepPHP'){
            $sPetiteSuite_selected = 'selected_score_byPHP';
        } else {
            $sPetiteSuite_selected = '';
        }
        if (count($v[1][11]) == 2 && $v[1][11][1][0] == 'keepPHP'){
            $sGrandeSuite_selected = 'selected_score_byPHP';
        } else {
            $sGrandeSuite_selected = '';
        }
        if (count($v[1][12]) == 2 && $v[1][12][1][0] == 'keepPHP'){
            $sYams_selected = 'selected_score_byPHP';
        } else {
            $sYams_selected = '';
        }
        if (count($v[1][13]) == 2 && $v[1][13][1][0] == 'keepPHP'){
            $sChance_selected = 'selected_score_byPHP';
        } else {
            $sChance_selected = '';
        }
        if (count($v[2][0]) == 2 && $v[2][0][1][0] == 'keepPHP'){
            $sTotal_selected = 'selected_score_byPHP';
        } else {
            $sTotal_selected = '';
        }
    }

    if ($action == 'fst_tir'){
        $buttonRelance_possibleToClick = "possibleToClick";
        $buttonRelance_fst_tir = "display: none;";
        $buttonRelance_snd_tir = "";
        $buttonRelance_trd_tir = "display: none;";
    } else if ($action == 'snd_tir'){
        $buttonRelance_possibleToClick = "possibleToClick";
        $buttonRelance_fst_tir = "display: none;";
        $buttonRelance_snd_tir = "display: none;";
        $buttonRelance_trd_tir = "";
    } else if ($action == 'trd_tir'){
        $buttonRelance_possibleToClick = "";
        $buttonRelance_fst_tir = "display: none;";
        $buttonRelance_snd_tir = "display: none;";
        $buttonRelance_trd_tir = "display: none;";
    } else {
        header("Location: /$lang/game/$game;");
    }
 ?>

<div id="game_yams_parent">
    <div id="game_yams_partDes_parent">
        <?php echo $PHP_RETURN_DES?>
     </div>
    <div id="game_yams_partTabl_parent">
        <div id="game_yams_partTabl">
            <div id="game_yams_tabl_titre">
                <?php echo w_game_yams_tableau_score ; ?>
            </div>
            <div id="game_yams_tabl_score">
                <div id="game_yams_tabl_grillePoints">
                    <div id="game_yams_tabl_grillePoints_ColGauche" class="game_yams_tabl_grillePoints_Col">
                        <div id="game_yams_tabl_grillePoints_ColGauche_1" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_1_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case" value="1">
                                <?php echo w_game_yams_tableau_1 ; ?>
                            </div>
                            <div id="game_yams_tabl_score1" class="game_yams_tabl_grillePoints_ColGauche_1_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s1_selected;?>" onclick="select_score(this)">
                                <?php echo $s1;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_2" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_2_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_2 ; ?>
                            </div>
                            <div id="game_yams_tabl_score2" class="game_yams_tabl_grillePoints_ColGauche_2_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s2_selected;?>" onclick="select_score(this)">
                                <?php echo $s2;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_3" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_3_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_3 ; ?>
                            </div>
                            <div id="game_yams_tabl_score3" class="game_yams_tabl_grillePoints_ColGauche_3_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s3_selected;?>" onclick="select_score(this)">
                                <?php echo $s3;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_4" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_4_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_4 ; ?>
                            </div>
                            <div id="game_yams_tabl_score4" class="game_yams_tabl_grillePoints_ColGauche_4_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s4_selected;?>" onclick="select_score(this)">
                                <?php echo $s4;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_5" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_5_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_5 ; ?>
                            </div>
                            <div id="game_yams_tabl_score5" class="game_yams_tabl_grillePoints_ColGauche_5_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s5_selected;?>" onclick="select_score(this)">
                                <?php echo $s5;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_6" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_6_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_6 ; ?>
                            </div>
                            <div id="game_yams_tabl_score6" class="game_yams_tabl_grillePoints_ColGauche_6_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $s6_selected;?>" onclick="select_score(this)">
                                <?php echo $s6;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColGauche_7" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColGauche_7_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_bonus ; ?>
                            </div>
                            <div id="game_yams_tabl_score7" class="game_yams_tabl_grillePoints_ColGauche_7_score game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sBonus_selected;?>">
                                <?php echo $sBonus;?>                             
                            </div>
                        </div>
                    </div>
                    <div id="game_yams_tabl_grillePoints_ColDroite" class="game_yams_tabl_grillePoints_Col">
                        <div id="game_yams_tabl_grillePoints_ColDroite_1" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_1_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_brelan ; ?>
                            </div>
                            <div id="game_yams_tabl_score8" class="game_yams_tabl_grillePoints_ColDroite_1_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sBrelan_selected;?>" onclick="select_score(this)">
                                <?php echo $sBrelan;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_2" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_2_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_carre ; ?>
                            </div>
                            <div id="game_yams_tabl_score9" class="game_yams_tabl_grillePoints_ColDroite_2_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sCarre_selected;?>" onclick="select_score(this)">
                                <?php echo $sCarre;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_3" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_3_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_full ; ?>
                            </div>
                            <div id="game_yams_tabl_score10" class="game_yams_tabl_grillePoints_ColDroite_3_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sFull_selected;?>" onclick="select_score(this)">
                                <?php echo $sFull;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_4" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_4_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_pSuite ; ?>
                            </div>
                            <div id="game_yams_tabl_score11" class="game_yams_tabl_grillePoints_ColDroite_4_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sPetiteSuite_selected;?>" onclick="select_score(this)">
                                <?php echo $sPetiteSuite;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_5" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_5_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_gSuite ; ?>
                            </div>
                            <div id="game_yams_tabl_score12" class="game_yams_tabl_grillePoints_ColDroite_5_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sGrandeSuite_selected;?>" onclick="select_score(this)">
                                <?php echo $sGrandeSuite;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_6" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_6_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_yams ; ?>
                            </div>
                            <div id="game_yams_tabl_score13" class="game_yams_tabl_grillePoints_ColDroite_6_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sYams_selected;?>" onclick="select_score(this)">
                                <?php echo $sYams;?>
                            </div>
                        </div>
                        <div id="game_yams_tabl_grillePoints_ColDroite_7" class="game_yams_tabl_grillePoints_ligne">
                            <div id="game_yams_tabl_grillePoints_ColDroite_7_nom" class="game_yams_tabl_grillePoints_ligne_nom game_yams_tabl_grillePoints_case">
                                <?php echo w_game_yams_tableau_chance ; ?>
                            </div>
                            <div id="game_yams_tabl_score14" class="game_yams_tabl_grillePoints_ColDroite_7_score canSelectScore game_yams_tabl_grillePoints_ligne_score game_yams_tabl_grillePoints_case <?php echo $sChance_selected;?>" onclick="select_score(this)">
                                <?php echo $sChance;?>
                            </div>
                        </div>
                    </div>
                 </div>
                <div id="game_yams_tabl_bas">
                    <div id="game_yams_tabl_buttons">
                        <div id="game_yams_tabl_buttonRelance" class="game_yams_tabl_button <?php echo $buttonRelance_possibleToClick;?>" onclick="envoie('new_tir',this)">
                            <?php echo w_game_yams_tableau_relancer ; ?><br>
                            <span class="game_yams_tabl_buttonRelance_tir" id="game_yams_tabl_buttonRelance_fst_tir" style="<?php echo $buttonRelance_fst_tir;?>"><?php echo w_game_yams_tableau_relancer_1;?></span>
                            <span class="game_yams_tabl_buttonRelance_tir" id="game_yams_tabl_buttonRelance_snd_tir" style="<?php echo $buttonRelance_snd_tir;?>"><?php echo w_game_yams_tableau_relancer_2;?></span>
                            <span class="game_yams_tabl_buttonRelance_tir" id="game_yams_tabl_buttonRelance_trd_tir" style="<?php echo $buttonRelance_trd_tir;?>"><?php echo w_game_yams_tableau_relancer_3;?></span>
                        </div>
                        <div id="game_yams_tabl_buttonValider" class="game_yams_tabl_button" onclick="envoie('sel_tab',this)">
                            <?php echo w_game_yams_tableau_validRelanc ;?>
                        </div>
                     </div>
                    <div id="game_yams_tabl_totalPoints">
                        <div id="game_yams_tabl_totalPoints_titre"><?php echo w_game_yams_tableau_total ;?>:</div>
                        <div id="game_yams_tabl_totalPoints_inter"></div>
                        <div id="game_yams_tabl_totalPoints_score"><?php echo $sTotal;?></div>
                        <div id="game_yams_tabl_totalPoints_scoreStockage" style="display: none;"><?php echo $sTotal;?></div>
                     </div>
                 </div>
            </div>
        </div>
     </div>
    <div id="game_yams_mess_erreur" style="display:none;">
        <div class="parent_charg"> <div class="animation_chargement"></div> </div>
    </div>
 </div>
<?php
 } else{
    header("Location: /$lang/connexion/");
 };
 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="/ressources/games/yams/game.css">
<script src="/ressources/games/yams/game.js"></script>