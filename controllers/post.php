<?php

require_once("models/model_post.php");
require_once("models/model_comments.php");


switch ($controlleurDemande){
    case "post":
        $titrePost = urldecode($requeteDecomposee[2]);
        $post = bindTitle($titrePost);

        if ($post === false) {
            header("Location: $webroot");
            exit();
        }

        if (isset($_SESSION["infos_user"]["login"])){
            if (isset($_POST['comment'])){
                addAuthorComment($_SESSION["infos_user"]["id_utilisateur"], $_POST['comment'],$post['id_billet'] );
            }
        }

        $allComments = getAllCommentsOneBillet($post['id_billet']);
    
        require("views/post.php");
        break;

    case "archives":
        $allBillets = getAllBillets();
        require("views/archives.php");
        break;
        
} 
