<?php
// Voici la liste des actions possibles avec la page à charger associée

$listeDesActions = array(
    "accueil" => "vues/accueil.php",
    "amis" => "vues/amis.php",
    "connexion_inscription" => "vues/connexion.php",
    "profil" => "vues/profil.php",
    
    "ajoutCommentaire" => "traitements/addComment.php",
    "modifCommentaire" => "traitements/modifyComment.php",
    "supprCommentaire" => "traitements/deleteComment.php",
    "ajoutPost" => "traitements/addPost.php",
    "modifPost" => "traitements/modifyPost.php",
    "supprPost" => "traitements/deletePost.php",
    "ajoutLike" => "traitements/addLike.php",
    "supprLike" => "traitements/deleteLike.php",
    "login" => "traitements/connexion.php",
    "logout" => "traitements/deconnexion.php",
    "inscription" => "traitements/createAccount.php"
);

?>