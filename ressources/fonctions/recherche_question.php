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
    if (isset($_POST['search_question'])){
        $searched = $_POST['search_question'];
        $prep_req = "SELECT * FROM faq_$lang WHERE faq_question LIKE '$searched%'" ;
        $req = $bdd->query($prep_req);
        $req_list = $req->fetchAll();
        foreach ($req_list as $r){ ?>
            <div class="faq_part">
                <div class="faq_question" onclick="faq_afficheReponse(this)"><?php echo $r['faq_question'] ;?></div>
                <div class="faq_reponse">
                    <div class="faq_titre_reponse"><?php echo $r['faq_reponse'] ;?></div>
                    <div class="faq_detail_reponse"><?php echo $r['faq_reponseDetail'] ;?></div>
                </div>
            </div>
        <?php };
    };
?>