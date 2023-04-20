<?php
    $link_include = $_SERVER['DOCUMENT_ROOT'];
    include $link_include.'/ressources/fonctions/info_base_donnee.php';
    $bdd = $access_bdd
?>
<?php
    session_start();
    if(isset($_POST['lang'])){
        $lang = $_POST['lang'];
    } else{
        $lang= "fr";
    };
    if (isset($_POST['type'])){
        $type = $_POST['type'] ;
        if(isset($_POST['ticket'])){
            $ticket = $_POST['ticket'] ;
        } else {
            header('Location: /result/fail_question');
        };
        if($type == "question"){
            $question = $ticket ;
            $user = $_SESSION['id'] ;
            $req = $bdd->prepare("INSERT INTO ticket(ticket_type,ticket_content,ticket_user) VALUES (:typeTicket,:question,:user)") ;
            $req -> execute(array(
                'typeTicket' => $type,
                'question' => $question,
                'user' => $user
            ));
            header("Location: /$lang/result/success_question");
        }
    } else {
        header("Location: /$lang/result/fail_question");
    };
?>