<?php

$sql = "SELECT * FROM users WHERE email=? AND password=PASSWORD(?)";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_POST["login"], $_POST["password"]));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.

// un seul fetch
$line=$q->fetch();
echo "<pre>";
var_dump($line);
echo "</pre>";

if(!$line){
    // Si $line est faux le couple login mdp est mauvais, on retourne au formulaire
    header("Location: index.php?action=login");
}else{
    // sinon on crée les variables de session $_SESSION['id'] et $_SESSION['login'] et on va à la page d'accueil
    $_SESSION["id"] = $line["id"];
    $_SESSION["login"] = $line["user_name"]." ".$line["family_name"];
    header("Location: index.php");
}


?>