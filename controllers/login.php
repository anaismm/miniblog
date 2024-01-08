<?php

require_once("models/model_login.php");


switch ($controlleurDemande){
    case "signup":
        if (isset($_SESSION['infos_user']['login'])){ //FAUDRA REMPLACER LE FALSE CAR C'EST LE CAS SI IL EST DEJA CONNECTE
            header("Location: $webroot");
            exit();
        }
       
        if ($_SERVER["REQUEST_METHOD"]==="POST"){    // LE PREMIER IF C'EST POUR SAVOIR SI LE FORMULAIRE A BIEN ETE ENVOYE
            $result = verifyLoginAlreadyExist($_POST["login"]);

            if ($result !== false) { // SI LE LOGIN EXISTE DEJA RENVOYE ERREUR
                $errorMessageLogin = "Le login existe déjà !";
                require("views/signup.php");
            } else{
                if ($_POST["mdp"] === $_POST["confmdp"]) { // VERIFIER QUE MDP ET CONFMDP SONT LES MEMES
                    if (addOneUser($_POST["nom"],$_POST["prenom"],$_POST["login"])){  // VERIFIER SI UTILISATEUR A BIEN ETE AJOUTE CAR FONCTION RENVOIE TRUE SI C'EST FAIT
                        header("Location: login");
                        exit();
                    }
                } else{
                    $errorMessageMdp = "Confirmation du mot de passe est incorecte";
                    require("views/signup.php");
                }
            }
        } else{
            require("views/signup.php");
            
        }
        break;

    case "login":
        if (isset($_SESSION['infos_user']['login'])){ //FAUDRA REMPLACER LE FALSE CAR C'EST LE CAS SI IL EST DEJA CONNECTE
            header("Location: $webroot");
            exit();
        }

        if (isset($_POST["login"])){  // SAVOIR SI MA DEMANDE DE CONNEXION A BIEN ETE ENVOYE
            $result = verifyConnexion($_POST["login"]); //RECUPERE LE LOGIN DANS LA BDD
            if (isset($result["login"])){  // SAVOIR SI LE LOGIN EST BON 
                if (password_verify($_POST["mdp"], $result['mot_de_passe'])){
                    unset($result['mot_de_passe']);
                    $_SESSION['infos_user'] = $result;

                    if (isset($_COOKIE["token_connexion"])){
                        setCookie('token_connexion','',time()-3600,'/'); // on supprime son cookie token de connexion
                    }

                    $token = bin2hex(random_bytes(128));
                    $expiration = time() + (86400*7);

                    removeUserTokens($_SESSION['infos_user']["id_utilisateur"]);

                    addUserToken($_SESSION['infos_user']["id_utilisateur"], $token, $expiration); //ajoute token a la table
                    setCookie('token_connexion', $token, $expiration, '/');

                    header("Location: $webroot");
                    exit();

                    

                } else{
                    $errorMessageConnexion = "Le login ou le mot de passe est incorrect"; //Mdp incorrect
                    require("views/login.php");
                } 
            } else{
                $errorMessageConnexion = "Le login ou le mot de passe est incorrect"; //Login incorect
                require("views/login.php");
            }

        } else{
            require("views/login.php");
        }
        break;

    case "logout":
        removeUserTokens($_SESSION['infos_user']["id_utilisateur"]);
        session_destroy();
        header("Location: $webroot");
        exit();
        break;
}
