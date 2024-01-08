<?php

function verifyLoginAlreadyExist($login){
    $db = dbConnect();
    $requete = "SELECT login FROM `utilisateurs` WHERE `login` = :login_utilisateur";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':login_utilisateur', $login, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;   
}

function addOneUser($nom, $prenom, $login){
    $db = dbConnect();
    $mdp_hache = password_hash($_POST["mdp"] , PASSWORD_DEFAULT);
    $requete = "INSERT INTO utilisateurs (nom, prenom, login, mot_de_passe, role) VALUES (:nom, :prenom, :login, :mdp, 'commentateur')";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $mdp_hache, PDO::PARAM_STR);
    return $stmt->execute();
}

function verifyConnexion($login){
    $db = dbConnect();
    $requete = "SELECT * FROM utilisateurs WHERE `login`= :login_utilisateur";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':login_utilisateur', $login, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function removeUserTokens($idUtilisateur){
    $db = dbConnect();
    $requete = "DELETE FROM cookie_login WHERE id_utilisateur = :id_utilisateur";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function addUserToken($idUser, $token ,$timestampExpiration){
    $db = dbConnect();
    $timestampExpiration = date('Y-m-d H:i:s',$timestampExpiration);

    $requete = "INSERT INTO cookie_login (id_utilisateur, token, expiration_session) VALUES (:id_utilisateur, :token, :expiration_session)";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_utilisateur', $idUser, PDO::PARAM_STR);
    $stmt->bindParam(':token',$token , PDO::PARAM_STR);
    $stmt->bindParam(':expiration_session', $timestampExpiration, PDO::PARAM_STR);
    return $stmt->execute();
}

function verifyToken($token){
    $db = dbConnect();
    $currentTimestamp = date('Y-m-d H:i:s', time()); 

    $requete = "SELECT * FROM cookie_login WHERE token = :token AND expiration_session > :currentTimestamp";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->bindParam(':currentTimestamp', $currentTimestamp, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUserFromId($idUser){
    $db = dbConnect();
    $requete = "SELECT * FROM utilisateurs WHERE `id_utilisateur`= :id_utilisateur";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_utilisateur', $idUser, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}