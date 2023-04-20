<?php
    $prep_req = "SELECT * FROM `user` WHERE user_id = '$id'";
    $req = $access_bdd -> query($prep_req);
    $r = $req->fetch();

    $a_user_id = $r['user_id'];
    $a_pseudo = $r['user_pseudo'];
    $a_nb_jeton = $r['user_nb_jeton'];
    $a_image = $r['user_image'];
    $a_user_admin = $r['user_admin'];

    $a_user = false ;
    if(isset($user_id) && isset($id) && $id == $user_id){
        $a_user = true ;
    };
?>


    
<div id="user_content" class="scrollbar <?php if($a_user){echo "u_prop";}else{echo "u_view";};?>">
    <!--Profile visible par tout le monde-->
    <div id="user_profile">
        <div id="userInfo_et_rechUser">
            <div class="div_barre_rech">
                <div id="barre_search_user" class="barre_rech clair_sombre">
                    <div class="barre_rech_loupe" id="barre_rech_loupe" onclick="animation_loupe(this)">
                        <div class="cercle_loupe"></div>
                        <div class="barre_loupe"></div>
                     </div>
                    <div></div>
                    <div>
                        <input type="text" name="recherche" placeholder="<?php echo w_user_rechercher?>" class="rech_barre clair_sombre" id="search_user">
                     </div>
                    <div id="affiche_searched_user" class="clair_sombre">
                        <div id="grille_searched_user" class="scrollbar"></div>
                        <div id="noResult_searched_user"><?php echo w_user_rechercher_noResult ;?></div>
                    </div>
                 </div>
             </div>
            <div id="user_info">
                <div id="user_pres">
                    <div id="user_profilImg_parent" class="user_info_content">
                        <div id="user_profilImg">
                            <img src="/ressources/img/user/<?php echo htmlspecialchars($a_image);?>" id="user_profilImg_img" alt="">
                            <?php if($a_user_admin){?>
                                <img src="/ressources/img/logo/logo_spoutsgambling.png" class="user_certifiedImg" alt="">
                            <?php }; ?>
                        </div>
                     </div>
                    <div id="user_bigPseudo_parent" class="user_info_content">
                        <div id="user_bigPseudo">
                            <?php echo htmlspecialchars($a_pseudo);?>
                        </div>
                     </div>
                    <div id="user_nombJeton_parent" class="user_info_content">
                        <div id="user_nombJetonImg">
                            <img src="/ressources/img/jeton_points.png" id="user_nombJetonImg_img" alt="">
                        </div>
                        <div id="user_nombJeton">
                            <?php echo htmlspecialchars($a_nb_jeton);?>
                        </div>
                     </div>
                    <div id="user_addFriend_parent" class="user_info_content">
                        <div id="user_addFriend">
                            <?php 
                            if($connected){
                            if($a_user){?>
                                <div id="user_addFriend_button" class="clair_sombre">
                                    <?php echo w_user_addFriend_himself ;?>
                                </div>
                            <?php }
                            else {
                                $ajouteur = $user_id ;
                                $newFriend = $a_user_id ;
                                $verif_prep_req = "SELECT * FROM amis WHERE amis_ajouteur=$ajouteur && amis_friend=$newFriend && amis_supprimer=0";
                                $verif_req = $access_bdd -> query($verif_prep_req);
                                $verif_r = $verif_req->fetch();
                                if($verif_r == ''){?>
                                    <form id="user_addFriend_form" action="/ressources/fonctions/reception_addFriend.php" method="post" style="display: none;">
                                        <input name="newFriend" type="hidden" value="<?php echo $id;?>">
                                    </form>
                                    <button type="submit" id="user_addFriend_button" class="clair_sombre" form="user_addFriend_form">
                                    <?php
                                        echo w_user_addFriend_add ;
                                    ?>
                                    </button>
                                    <?php }
                                    else { ?>
                                    <form id="user_removeFriend_form" action="/ressources/fonctions/reception_removeFriend.php" method="post" style="display: none;">
                                        <input name="removeFriend" type="hidden" value="<?php echo $id;?>">
                                    </form>
                                    <button type="submit" id="user_addFriend_button" class="clair_sombre" form="user_removeFriend_form">
                                    <?php
                                        echo w_user_addFriend_already_delete ;
                                    ?>
                                    </button>
                                <?php };
                            };
                            }else{?>
                                <a href="/<?php echo $lang;?>/connexion/">
                                    <div id="user_addFriend_button" class="clair_sombre">
                                        <?php echo w_user_addFriends_noConnect ;?>
                                    </div>
                                </a>
                            <?php }; ?>
                        </div>
                     </div>
                 </div>
                <div class="ligne_inter"></div>
                <div id="user_amis">
                    <div id="user_amis_titre_parent">
                        <div id="user_amis_titre">
                            <?php echo w_user_friends ;?>
                        </div>
                     </div>
                    <div id="user_amis_liste" class="scrollbar">

                        <?php
                        $prep_req_friendsOfProfil = "SELECT amis_friend FROM amis WHERE amis_ajouteur='$a_user_id' && amis_supprimer=0 LIMIT 5";
                        $req_friendsOfProfil = $access_bdd -> query($prep_req_friendsOfProfil);
                        $r_friendsOfProfil = $req_friendsOfProfil->fetchAll();

                        foreach($r_friendsOfProfil as $r){
                            $aa_user = $r['amis_friend'] ;
                            $prep_req_friendsOfProfil_info = "SELECT * FROM user WHERE user_id='$aa_user'";
                            $req_friendsOfProfil_info = $access_bdd -> query($prep_req_friendsOfProfil_info);
                            $r_friendsOfProfil_info = $req_friendsOfProfil_info->fetch();

                            $aa_user_id = $r_friendsOfProfil_info['user_id'];
                            $aa_pseudo = $r_friendsOfProfil_info['user_pseudo'];
                            $aa_nb_jeton = $r_friendsOfProfil_info['user_nb_jeton'];
                            $aa_image = $r_friendsOfProfil_info['user_image'];
                            $aa_user_admin = $r_friendsOfProfil_info['user_admin'];
                            
                            ?>
                            <div class="user_amis_partOfList">
                                <div class="user_amis_partOfList_photoProfil_parent">
                                    <a href="/<?php echo $lang;?>/user/<?php echo $aa_user_id;?>">
                                        <img class="user_amis_partOfList_photoProfil" src="/ressources/img/user/<?php echo $aa_image?>" alt="">
                                        <?php if($a_user_admin){?>
                                            <img src="/ressources/img/logo/logo_spoutsgambling.png" class="user_certifiedImg" alt="">
                                        <?php }; ?>
                                    </a>
                                 </div>
                                <div class="user_amis_partOfList_info">
                                    <div class="user_amis_partOfList_pseudo">
                                        <a href="/<?php echo $lang;?>/user/<?php echo $aa_user_id;?>">
                                            <?php echo $aa_pseudo;?>
                                        </a>
                                     </div>
                                    <div class="user_amis_partOfList_jetons_parent">
                                        <div class="user_amis_partOfList_jetons_img_parent">
                                            <img src="/ressources/img/jeton_points.png" class="user_amis_partOfList_jetons_img" alt="">
                                        </div>
                                        <div class="user_amis_partOfList_jetons">
                                            <?php echo $aa_nb_jeton;?>
                                        </div>
                                     </div>
                                    <?php
                                    if($connected){
                                    if($aa_user_id == $user_id){?>
                                        <div class="user_amis_partOfList_button">
                                            <?php echo w_user_addFriend_himself ;?>
                                        </div>
                                     <?php }
                                     else {
                                        $aa_ajouteur = $user_id ;
                                        $aa_newFriend = $aa_user_id ;
                                        $verif_prep_req = "SELECT * FROM amis WHERE amis_ajouteur=$aa_ajouteur && amis_friend=$aa_newFriend && amis_supprimer=0";
                                        $verif_req = $access_bdd -> query($verif_prep_req);
                                        $verif_r = $verif_req->fetch();
                                        if($verif_r == ''){?>
                                            <form id="user_amis_addFriend_form" action="/ressources/fonctions/reception_addFriend.php" method="post" style="display: none;">
                                                <input name="newFriend" type="hidden" value="<?php echo $aa_user_id;?>">
                                            </form>
                                            <button class="user_amis_partOfList_button clair_sombre" type="submit" form="user_amis_addFriend_form">
                                                <? echo w_user_addFriend_add ;?>
                                            </button>
                                         <?php }
                                         else{?>
                                            <div class="user_amis_partOfList_button">
                                                <? echo w_user_addFriend_already ;?>
                                            </div>
                                          <?php };
                                      };
                                      } else{ ?>
                                        <a href="/<?php echo $lang;?>/connexion/">
                                            <div class="user_amis_partOfList_button">
                                                <? echo w_user_addFriends_noConnect ;?>
                                            </div>
                                        </a>
                                      <?php }; ?>
                                 </div>
                             </div>
                        <?php };?>
                        </div>
                 </div>
             </div>
         </div>
        <div id="user_stat">
            <div id="user_stat_titre_parent">
                <div id="user_stat_titre">
                    <?php echo w_user_stat_gameStats ;?>
                </div>
             </div>
            <div id="user_stat_contenu">
                <?php // Il y aurait dû avoir les statistiques de jeu de l'utilisateur, mais faute de temps et de jeux, nous n'avons pas pû le faire ?>
                <div id="user_stat_indiponibles">
                    <?php echo w_user_stat_indisponibles ;?>
                </div>
             </div>
         </div>
     </div>
    <?php // Partie du profile visible uniquement par son propriétaire / Paramètre du compte ;
        // Il y aurait dû avoir les formulaires de changement de e-mail et de mot de passe, mais faute de temps, il n'a pas été possible de le faire
     if($a_user){ ?>
        <div id="user_settings">
        </div>
     <?php };?>
</div>

<link rel="stylesheet" href="/ressources/css/user.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/barre_rech.js"></script>
<script src="/ressources/js/user.js"></script>
<script>
    document.title = '<?php echo w_user_user ?> - Spout\'s Gambling'
</script>