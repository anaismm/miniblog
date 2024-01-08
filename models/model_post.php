<?php

function bindTitle($titrePost){
    $db = dbConnect();
    $requete = "SELECT * FROM `billets` WHERE `titre` LIKE :titre";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':titre', $titrePost, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;   
}

function addOneBillet($titre, $contenu, $idAuteur){
    $db = dbConnect();
    $datePost = date('Y-m-d H:i:s');
    $requete = "INSERT INTO billets (titre, date_post, contenu, id_auteur) VALUES (:titre, :date_post, :contenu, :id_auteur)";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':date_post', $datePost, PDO::PARAM_STR);
    $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    $stmt->bindParam(':id_auteur', $idAuteur, PDO::PARAM_STR);
    $success = $stmt->execute();

    if ($success) {
        // Stocker le message dans la session avec une durée de vie de 5 secondes
        session_start();
        $_SESSION['message'] = 'Votre post a bien été créé !';
        $_SESSION['message_expire'] = time() + 5;  // 5 secondes
        session_write_close();
    }
    return $success;
}

function getAllBillets(){
    $db = dbConnect();
    $requete = "SELECT * FROM billets ORDER BY date_post DESC";
    $stmt=$db->query($requete);
    $result=$stmt-> fetchall(PDO::FETCH_ASSOC);
    return $result;
}

function getLastBillets(){
    $db = dbConnect();
    $requete = "SELECT * FROM billets ORDER BY date_post DESC LIMIT 3";
    $stmt=$db->query($requete);
    $result=$stmt-> fetchall(PDO::FETCH_ASSOC);
    return $result;
}

function deleteBillet($idBillet) {
    $db = dbConnect();
    $requete = "DELETE FROM billets WHERE id_billet = :idBillet";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':idBillet', $idBillet, PDO::PARAM_INT);
    $stmt->execute();
}
