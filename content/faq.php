<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
    $bdd = $access_bdd
?>

<div class="rech_jeux">
    <div class="div_barre_rech">
        <div class="barre_rech clair_sombre">
            <div class="barre_rech_loupe" onclick="animation_loupe(this)">
                <div class="cercle_loupe"></div>
                <div class="barre_loupe"></div>
            </div>
            <div></div>
            <div>
                <input type="text" name="recherche" placeholder="<?php echo w_text_faq_rechQuestion ;?>" class="rech_barre clair_sombre" id="search_question">
            </div>
        </div>
    </div>
    <div class="cont_faq clair_sombre">
        <div class="droite_relative_content">
            <div class="droite_part_content scrollbar" id="faq_parent">
                <?php
                    $prep_req = "SELECT * FROM faq_$lang" ;
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
                    <?php }; ?>
            </div>
        </div>
        <div class="faq_autre_quest">
            <div class="faq_autre_quest_text">
                <?php echo w_text_faq_autreQuestion__ ; ?>
                <a href="/<?php echo $lang;?>/ticket/question"><?php echo w_text_faq__poserLaNous ;?></a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/ressources/css/faq.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/faq.js"></script>
<script src="/ressources/js/barre_rech.js"></script>
<script>
    document.title = '<?php echo w_text_faq ?> - Spout\'s Gambling'
</script>