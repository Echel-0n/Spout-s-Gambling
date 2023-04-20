<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";
    $bdd = $access_bdd;

    session_start();

    $valid = true;

    if(isset($_POST['lang'])){
        $lang = $_POST['lang'];
    } else{
        $lang = 'fr';
    };

    $ficher_lang = "$link_include/ressources/games/yams/lang/lang_$lang.php";
    if(file_exists($ficher_lang)){
        include $ficher_lang ;
    }

    if(isset($_SESSION['id'])){

    $id = $_SESSION['id'];

    if(isset($_POST['action'])&&isset($_POST['value'])){
        $prep_num_game = "SELECT * FROM game WHERE code_game='yams'";
        $req_num_game = $bdd->query($prep_num_game);
        $num_game = $req_num_game->fetch();

        if($num_game == ''){
            $valid = false;
            $validInfo = "redirect:/$lang/|";
        } else{
            $game = $num_game['id_game'];
        }

        
        $newActionUser = $_POST['action'];

        $value = $_POST['value'];
        

        $prep_donnee_game = "SELECT * FROM partie WHERE user_id=$id AND game_id=$game AND partie_fini=0";
        $req_donnee_game = $bdd->query($prep_donnee_game);
        $donnee_game = $req_donnee_game->fetch();
        
        if($donnee_game == ''){
            $valid = false;
            $validInfo = "redirect:/$lang/game/$game|";
        } else {
            $partie_id = $donnee_game['partie_id'];
            $prep_donnee_partie = "SELECT * FROM partie_evolution WHERE partie_id=$partie_id ORDER BY partie_evolution_id DESC";
            $req_donnee_partie = $bdd->query($prep_donnee_partie);
            $donnee_partie = $req_donnee_partie->fetchAll();

            if(count($donnee_partie) >= 1){
                $last_action1 = $donnee_partie[0]['partie_evolution_action'];
                $last_value =  $donnee_partie[0]['partie_evolution_value'];

                if(count($donnee_partie) >= 2){
                    $last_action2 = $donnee_partie[1]['partie_evolution_action'];

                    if(count($donnee_partie) >= 3){
                        $last_action3 = $donnee_partie[2]['partie_evolution_action'];
                    } else {
                        $last_action3 ='';
                    }

                } else {
                    $last_action2 ='';
                }

        // 4 actions :
        //   - 1er tirage : fst_tir
        //   - 2dn tirage : snd_tir
        //   - 3em tirage : trd_tir
        //   - Selection tableau (score) : sel_tab

        if($last_action1 == "fst_tir"){
            if($newActionUser == "sel_tab"){
                $newAction = "fst_tir";
                $newSelectScore = true;
            } else{
                $newAction = "snd_tir";
                $newSelectScore = false;
            }
        } else if ($last_action1 == "snd_tir"){
            if($newActionUser == "sel_tab"){
                $newAction = "fst_tir";
                $newSelectScore = true;
            } else{
                $newAction = "trd_tir";
                $newSelectScore = false;
            }
        } else if ($last_action1 == "trd_tir"){
            if($newActionUser == "sel_tab"){
                $newAction = "fst_tir";
                $newSelectScore = true;
            } else{
                $valid = false;
                $validInfo = 'message:Error 101 - '.w_game_yams_aucuneScoreSelection.'|';
            }
        }

        // Décomposition du dernier historique des valeurs
        
        $za_str = $last_value;
        $verifZ = '';
        $za = explode('|',$last_value);

        for($a=0;$a<count($za);$a++){
            $zb = explode('!',$za[$a]);

            for($b=0;$b<count($zb);$b++){
                $zc = explode('~',$zb[$b]);

                for($c=0;$c<count($zc);$c++){
                    $zd = explode(':',$zc[$c]);

                    for($d=0;$d<count($zd);$d++){
                        $z[$a][$b][$c][$d] = $zd[$d];
                        if($zd[$d] != "keep" && $zd[$d] != "keepUser"){
                            $verifZ = $verifZ.$zd[$d];
                            $prepNewInsertInBdd[$a][$b][$c][$d] = $zd[$d];
                        }
                    }
                }

            }

        };

        // Décomposition des valeurs envoyées par l'utilisateur

        $va_str = $value;
        $verifV = '';
        $va = explode('|',$value);

        for($a=0;$a<count($va);$a++){
            $vb = explode('!',$va[$a]);

            for($b=0;$b<count($vb);$b++){
                $vc = explode('~',$vb[$b]);

                for($c=0;$c<count($vc);$c++){
                    $vd = explode(':',$vc[$c]);

                    for($d=0;$d<count($vd);$d++){
                        $v[$a][$b][$c][$d] = $vd[$d];
                        if($vd[$d] != "keep" & $vd[$d] != "keepUser"){
                            $verifV = $verifV.$vd[$d];
                        }
                    }
                }

            }

        };

        // Comparaison des valeurs

        $verifV = str_replace(' ','',$verifV);
        $verifZ = str_replace(' ','',$verifZ);

        if($verifV != $verifZ){ // Si l'historique des nombres renvoyé par l'utilisateur ne correspond pas à celui de la base de données
            $valid = false;
            $validInfo = "message:Error 167 - ".w_game_yams_valeursModifiees.'|';
        }

        // Prise en compte de la selection si l'utilisateur à selectionner un score

        if($newSelectScore){
            for($i = 0; $i < count($v[1]); $i++){
                if($i != 6){ // L'utilisateur ne peut pas sélectionner le bonus
                    if (count($v[1][$i]) > 1 && $v[1][$i][1][0] == "keepUser"){
                        $memSelectedScore = $i;
                    }
                }
            }
            if($memSelectedScore != 0 && $memSelectedScore == ""){
                $valid = false;
                $validInfo = 'message: Error 182 - '.w_game_yams_aucuneScoreSelection.'|';
            } else{
                $v[1][$memSelectedScore][1][0] = "keepPHP";
                $prepNewInsertInBdd[1][$memSelectedScore][1][0] = "keepPHP";
            }
        }

        // Prise en compte de la selection si l'utilisateur à selectionner un ou plusieurs dés

        for($i = 0; $i < count($v[0]); $i++){
            if (count($v[0][$i]) > 1 && $v[0][$i][1][0] == "keep"){
                $prepNewInsertInBdd[0][$i][1][0] = "keep";
            }
        }

        // Code des dés

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

        if($valid){

            // Lancement des tirages de dés
            $des1Keep = "";
            $des2Keep = "";
            $des3Keep = "";
            $des4Keep = "";
            $des5Keep = "";
            if ($newAction != "fst_tir"){ // Sauf si 3e tir passé ou selection dans tableau
                if(count($v[0][0]) == 2 && $v[0][0][1][0] == 'keep'){
                    $des1 = $v[0][0][0][1];
                    $des1Keep = "~keep";
                    $des1_selected = 'selected_des';
                } else{
                    $des1 = rand(1,6);
                    $des1_selected = '';
                };
                if(count($v[0][1]) == 2 && $v[0][1][1][0] == 'keep'){
                    $des2 = $v[0][1][0][1];
                    $des2Keep = "~keep";
                    $des2_selected = 'selected_des';
                } else{
                    $des2 = rand(1,6);
                    $des2_selected = '';
                };
                if(count($v[0][2]) == 2 && $v[0][2][1][0] == 'keep'){
                    $des3 = $v[0][2][0][1];
                    $des3Keep = "~keep";
                    $des3_selected = 'selected_des';
                } else{
                    $des3 = rand(1,6);
                    $des3_selected = '';
                };
                if(count($v[0][3]) == 2 && $v[0][3][1][0] == 'keep'){
                    $des4 = $v[0][3][0][1];
                    $des4Keep = "~keep";
                    $des4_selected = 'selected_des';
                } else{
                    $des4 = rand(1,6);
                    $des4_selected = '';
                };
                if(count($v[0][4]) == 2 && $v[0][4][1][0] == 'keep'){
                    $des5 = $v[0][4][0][1];
                    $des5Keep = "~keep";
                    $des5_selected = 'selected_des';
                } else{
                    $des5 = rand(1,6);
                    $des5_selected = '';
                };
            } else{
                $des1 = rand(1,6);
                $des2 = rand(1,6);
                $des3 = rand(1,6);
                $des4 = rand(1,6);
                $des5 = rand(1,6);
                $des1_selected = '';
                $des2_selected = '';
                $des3_selected = '';
                $des4_selected = '';
                $des5_selected = '';
            }

            $des1_str = "des_val".strval($des1);
            $des2_str = "des_val".strval($des2);
            $des3_str = "des_val".strval($des3);
            $des4_str = "des_val".strval($des4);
            $des5_str = "des_val".strval($des5);
            
            $PHP_RETURN_DES = "
                <div id='PHP_RETURN_DES'>
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
                    </div>
                </div> ";

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

            // Mise en lien avec la base de données

            $compteurFin = 0;

            $sTotal = 0;
            $calcBonus = 0;

            if(count($prepNewInsertInBdd[1][0]) == 2 && $prepNewInsertInBdd[1][0][1][0] == "keepPHP"){
                $s1 = $prepNewInsertInBdd[1][0][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][0][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][0][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][1]) == 2 && $prepNewInsertInBdd[1][1][1][0] == "keepPHP"){
                $s2 = $prepNewInsertInBdd[1][1][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][1][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][1][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][2]) == 2 && $prepNewInsertInBdd[1][2][1][0] == "keepPHP"){
                $s3 = $prepNewInsertInBdd[1][2][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][2][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][2][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][3]) == 2 && $prepNewInsertInBdd[1][3][1][0] == "keepPHP"){
                $s4 = $prepNewInsertInBdd[1][3][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][3][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][3][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][4]) == 2 && $prepNewInsertInBdd[1][4][1][0] == "keepPHP"){
                $s5 = $prepNewInsertInBdd[1][4][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][4][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][4][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][5]) == 2 && $prepNewInsertInBdd[1][5][1][0] == "keepPHP"){
                $s6 = $prepNewInsertInBdd[1][5][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][5][0][1]);
                $calcBonus += intval($prepNewInsertInBdd[1][5][0][1]);
                $compteurFin += 1;
            };
            if( $calcBonus > 62 ){
                $sBonus = "35~keepPHP";
                $prepNewInsertInBdd[1][6][1][0] = "keepPHP";
                $compteurFin += 1;
            } else {
                $sBonus = "0~keepPHP";
                $prepNewInsertInBdd[1][6][1][0] = "keepPHP";
                $compteurFin += 1;
            }
            if(count($prepNewInsertInBdd[1][7]) == 2 && $prepNewInsertInBdd[1][7][1][0] == "keepPHP"){
                $sBrelan = $prepNewInsertInBdd[1][7][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][7][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][8]) == 2 && $prepNewInsertInBdd[1][8][1][0] == "keepPHP"){
                $sCarre = $prepNewInsertInBdd[1][8][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][8][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][9]) == 2 && $prepNewInsertInBdd[1][9][1][0] == "keepPHP"){
                $sFull = $prepNewInsertInBdd[1][9][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][9][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][10]) == 2 && $prepNewInsertInBdd[1][10][1][0] == "keepPHP"){
                $sPetiteSuite = $prepNewInsertInBdd[1][10][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][10][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][11]) == 2 && $prepNewInsertInBdd[1][11][1][0] == "keepPHP"){
                $sGrandeSuite = $prepNewInsertInBdd[1][11][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][11][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][12]) == 2 && $prepNewInsertInBdd[1][12][1][0] == "keepPHP"){
                $sYams = $prepNewInsertInBdd[1][12][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][12][0][1]);
                $compteurFin += 1;
            };
            if(count($prepNewInsertInBdd[1][13]) == 2 && $prepNewInsertInBdd[1][13][1][0] == "keepPHP"){
                $sChance = $prepNewInsertInBdd[1][13][0][1]."~keepPHP";
                $sTotal += intval($prepNewInsertInBdd[1][13][0][1]);
                $compteurFin += 1;
            };

            if ($compteurFin == 14){
                $partieFini = true;
            } else {
                $partieFini = false;
            }

            echo $PHP_RETURN_DES;
            echo "</br>";
            echo "<div id='PHP_RETURN_TABL'>$s1|$s2|$s3|$s4|$s5|$s6|$sBonus|$sBrelan|$sCarre|$sFull|$sPetiteSuite|$sGrandeSuite|$sYams|$sChance</div>";
            echo "</br>";
            echo "<div id='PHP_RETURN_TABL_BUTTON'>$newAction</div>";
            echo "</br>";
            echo "<div id='PHP_RETURN_TABL_TOTAL'>$sTotal</div>";

            // Ajout du nouvel historique à la base de données

            $BDDaction = $newAction;
            $BDDvalue = "1:$des1$des1Keep!2:$des2$des2Keep!3:$des3$des3Keep!4:$des4$des4Keep!5:$des5$des5Keep|1:$s1!2:$s2!3:$s3!4:$s4!5:$s5!6:$s6!7:$sBonus!8:$sBrelan!9:$sCarre!10:$sFull!11:$sPetiteSuite!12:$sGrandeSuite!13:$sYams!14:$sChance|total:$sTotal";
            
            echo "</br>";
            echo "<div id='PHP_RETURN_BUG'>$partieFini</div>";

            $newHistorique = $bdd->prepare("INSERT INTO partie_evolution(partie_id,partie_evolution_action,partie_evolution_value) VALUES (:partie_id,:action_,:value_)");
            $newHistorique -> execute(array(
                'partie_id' => $partie_id,
                'action_' => $BDDaction,
                'value_' => $BDDvalue
            ));

            if($partieFini){
                $miseStr = $donnee_game['partie_jetonMise'] ;
                $mise = intval($donnee_game['partie_jetonMise']) ;
                $result = intval($sTotal) ;
                if($mise > $result){
                    $gain = $result - $mise;
                } else if ($mise == $result){
                    $gain = $mise * 2 ;
                } else if ($mise > 250){
                    $gain = ($result - $mise) * (1 - (375 - $mise) / 375) * 10 ;
                } else {
                    $gain = ($result - $mise) * (1 - (375 - $mise) / 375) * 3 ;
                }

                if($gain >= $mise){
                    $gagne = 1;
                } else {
                    $gagne = 0;
                }

                $fin = $bdd->prepare("UPDATE partie SET partie_fin = CURRENT_TIMESTAMP(), partie_gagne = :partie_gagne, partie_fini = :partie_fini, partie_jetonGagne = :partie_jetonGagne WHERE partie_id = :partie_id");
                $fin -> execute(array(
                    'partie_gagne' => $gagne,
                    'partie_fini' => 1,
                    'partie_jetonGagne' => $gain,
                    'partie_id' => $partie_id
                ));

                $prep_req_infoUtilisateur = "SELECT * FROM user WHERE user_id=$id";
                $req_req_infoUtilisateur = $bdd->query($prep_req_infoUtilisateur);
                $req_infoUtilisateur = $req_req_infoUtilisateur->fetch();

                $nbJeton_str = $req_infoUtilisateur['user_nb_jeton'];
                $nbJeton = intval($nbJeton_str);

                $addGain = $nbJeton + $gain ;

                $finPts = $bdd->prepare("UPDATE user SET user_nb_jeton = :addGain WHERE user_id = :user_id");
                $finPts -> execute(array(
                    'addGain' => $addGain,
                    'user_id' => $id
                ));

                echo "<div id='PHP_RETURN_ERROR'>redirect:/$lang/game/$game</div>";
            }
        }

            } else {
                // Historique de la partie vide
                $valid = false ;
                $validInfo = "redirect:/$lang/game/$game|";
            }
        }
    }
        
    } else {
        $valid = false;
        $validInfo = "redirect:/$lang/connexion/|";
    }
    if ($valid == false){
        echo "<div id='PHP_RETURN_ERROR'>$validInfo</div>";
    }
?>

