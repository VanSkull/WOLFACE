<?php
// Voici la liste des actions possibles avec la page à charger associée

$listeDesActions = array(
    "accueil" => "vues/accueil.php",
    "amis" => "vues/amis.php",
    "connexion_inscription" => "vues/connexion.php",
    "profil" => "vues/profil.php",
    
    "ajoutCommentaire" => "traitement/addComment.php",
    "modifCommentaire" => "traitement/modifyComment.php",
    "supprCommentaire" => "traitement/deleteComment.php",
    "ajoutPost" => "traitement/addPost.php",
    "modifPost" => "traitement/modifyPost.php",
    "supprPost" => "traitement/deletePost.php",
    "ajoutLike" => "traitement/addLike.php",
    "supprLike" => "traitement/deleteLike.php",
    "login" => "traitement/connexion.php",
    "logout" => "traitement/deconnexion.php",
    "inscription" => "traitement/createAccount.php"
);

?>