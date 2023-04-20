<?php
    session_start();

    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';

    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    } else{
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    };
    if(isset($_GET['content'])){
        $content = $_GET['content'];
    };
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    };
    if(isset($_GET['search'])){
        $searched = $_GET['search'];
    };

    // Si utilisateur connecté
    $connected = false ;
    if(isset($_SESSION['id']) && isset($_SESSION['email'])){
        $connected = true ;
        $user_id = $_SESSION['id'] ;
        $email = $_SESSION['email'] ;
        
        $prep_req = "SELECT * FROM `user` WHERE user_id = '$user_id'";
        $req = $access_bdd -> query($prep_req);
        $r = $req->fetch();

        $pseudo = $r['user_pseudo'];
        $nb_jeton = $r['user_nb_jeton'];
        $image = $r['user_image'];
    };

    $link_include = $_SERVER['DOCUMENT_ROOT']
?>

<?php
    // Préparation des différentes langues
        $text_chemin_lang = $link_include.'/ressources/lang/lang_'.$lang.'.php';
        if(file_exists($text_chemin_lang)){
            include $text_chemin_lang;
        } else{
            $lang = 'fr';
            $text_chemin_lang = $link_include.'/ressources/lang/lang_'.$lang.'.php';
            if(file_exists($text_chemin_lang)){
                include $text_chemin_lang;
            };
        }
?>

<head>
    <!-- Modifier image pour moins haute résolution-->
    <link rel="icon" type="image/png" sizes="16x16" href="/ressources/img/logo/logo_spoutsgambling.png">
    <title>Spout's Gambling</title>
    <link rel="stylesheet" href="/ressources/css/general.css">
    <link rel="stylesheet" href="/ressources/css/contenu.css">
    <link rel="stylesheet" href="/ressources/css/contenu_droite.css">
    <link rel="stylesheet" href="/ressources/css/barre_recherche.css">
    <link rel="stylesheet" href="/ressources/css/contenant_jeux.css">
    <link rel="stylesheet" href="/ressources/css/page_text.css">
    <!-- Import de la police d'écriture -->
    <link rel="stylesheet" href="https://use.typekit.net/gox3mgc.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>

<body aria-hidden="true" class="clair_sombre scrollbar">
    <?php
    if(isset($content) && $content == "inscription"){
        include $link_include."/content/inscription.php";
    }else if (isset($content) && $content == "connexion"){
        include $link_include."/content/connexion.php";
    }else if (isset($content) && $content == "ticket"){
        include $link_include."/content/ticket.php";
    }else if (isset($content) && $content == "result"){
        include $link_include."/content/result.php";
    }else{
    ?>
        <div class="body_equiv">
            <!-- Entête avec logo et nom du site -->

            <?php include $link_include."/element/entete.php" ;?>

            <!-- Contenu de la page (barre de gauche + barre de recherche + onglet des jeux + barre de droite) -->

            <div class="contenu_page clair_sombre">

                <?php include $link_include."/element/barre_gauche.php"; ?>

                <div class="contenu_droite clair_sombre">
                    <div class='contenu_centre'>
                        <?php
                            if (isset($_GET["content"])){
                                $inclut = $link_include."/content/".$_GET["content"].".php";
                                if (file_exists($inclut)) {
                                    include $inclut;
                                } else{
                                    include $link_include."/content/404.php" ;
                                }
                            } else {
                                    include $link_include."/content/carousel.php";
                            }
                        ?>
                    </div>
                    <div class="barre_droite"></div>
                </div>
            </div>

            <?php include $link_include."/element/pied_page.php"; ?>

        </div>
    <?php
    };
?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/ressources/js/mode_sombre.js"></script>
<script src="/ressources/js/contenu_page.js"></script>

</html>