<?php

require_once("models/model_post.php");
require_once("models/model_comments.php");

// SI IL EST CONNECTE MAIS EST PAS ADMIN ON RENVOIE A ACCUEIL ET SI PAS CONNECTE ON RENVOIE A PAGE LOGIN
if (!isset($_SESSION['infos_user']['login']) || ($_SESSION['infos_user']['role'] !== "admin")){
    if (isset($_SESSION['infos_user']['login'])) {
        header("Location: $webroot");
        exit();
    } else {
        header("Location: login");
        exit();
    }
}

switch ($controlleurDemande){
    case "create":
        if (isset($_POST["titre"],$_POST["contenu"],$_SESSION['infos_user']["id_utilisateur"])){
            if (addOneBillet(trim($_POST["titre"]),$_POST["contenu"],$_SESSION['infos_user']["id_utilisateur"])){
                header("Location: $webroot");
                exit();
            }
        } else{
            require("views/creation_post.php");
        }   
        break;
        
    case "delete":
        if (isset($_POST["idBillet"])){
            deleteBillet($_POST["idBillet"]);
            deleteComment($_POST["idBillet"]);

            if (isset($_SESSION['current_page']) && $_SESSION['current_page'] === 'archives') {
                header("Location: archives");
            } else {
                header("Location: $webroot");
            }
            
            unset($_SESSION['current_page']); // Supprimez la variable de session après la redirection
            exit();
        }
        break;
} 

