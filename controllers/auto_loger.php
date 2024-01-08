<?php

require_once("models/model_login.php");

if (isset($_COOKIE["token_connexion"])){
    $testToken = verifyToken($_COOKIE["token_connexion"]);

    if ($testToken){
        $result = getUserFromId($testToken["id_utilisateur"]);
        unset($result['mot_de_passe']);
        $_SESSION['infos_user'] = $result;
        
    } else{
        setCookie('token_connexion','',time()-3600,'/'); // on supprime son cookie token de connexion
    }
}