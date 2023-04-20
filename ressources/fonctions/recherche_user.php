<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include."/ressources/fonctions/info_base_donnee.php";
    
    $bdd = $access_bdd ;

    session_start();

    if(isset($_POST['lang'])){
        $lang = $_POST['lang'];
    } else {
        $lang = 'fr';
    };
    if (isset($_POST['search_user'])){
        $searched = $_POST['search_user'];
        $prep_req = "SELECT * FROM user WHERE user_pseudo LIKE '$searched%' ";
        $req = $bdd->query($prep_req);
        $req_list = $req->fetchAll();
        foreach($req_list as $r){
            ?>

            <a href="/<?php echo $lang;?>/user/<?php echo $r['user_id'];?>">
                <div class="result_searched_user">
                    <div class="result_searched_user_img_parent">
                        <img class="result_searched_user_img" src="/ressources/img/user/<?php echo $r['user_image'];?>" alt="">
                    </div>
                    <div class="result_searched_user_pseudo">
                        <?php echo $r['user_pseudo'];?>
                    </div>
                </div>
            </a>

            <?php
        }
    };
?>