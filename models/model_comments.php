<?php

function getAuthorComment($idAuteur){
    $db = dbConnect();
    $requete = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id_auteur";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_auteur', $idAuteur, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result; 
}

function getAllCommentsOneBillet($idPost){
    $db = dbConnect();
    $requete = "SELECT * FROM commentaires WHERE id_billet = :id_billet ORDER BY date_post_commentaire DESC";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_billet', $idPost, PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$row) {
        $row['auteur'] = getAuthorComment($row['id_auteur']);
        unset($row['auteur']['mot_de_passe']);
    }
    return $result;   
}

function addAuthorComment($idauteur,$contenuComment,$idBillet){
    $db = dbConnect();
    $dateComment = date('Y-m-d H:i:s');
    $contenuComment = strip_tags($contenuComment);
    $requete = "INSERT INTO commentaires (id_auteur, date_post_commentaire, contenu_commentaire, id_billet) VALUES (:id_auteur, :date_post_commentaire, :contenu_commentaire, :id_billet)";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':id_auteur', $idauteur, PDO::PARAM_STR);
    $stmt->bindParam(':date_post_commentaire',$dateComment, PDO::PARAM_STR); // strip_tags pour enlever toute les balises html
    $stmt->bindParam(':contenu_commentaire', $contenuComment, PDO::PARAM_STR);
    $stmt->bindParam(':id_billet', $idBillet, PDO::PARAM_STR);
    return $stmt->execute();
}

function deleteComment($idBillet) {
    $db = dbConnect();
    $requete = "DELETE FROM commentaires WHERE id_billet = :idBillet";
    $stmt = $db->prepare($requete);
    $stmt->bindParam(':idBillet', $idBillet, PDO::PARAM_INT);
    $stmt->execute();
}