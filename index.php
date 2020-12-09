<?php

include("config/config.php");
include("config/bd.php"); // commentaire
include("divers/balises.php");
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées

    /*echo 'Tableau $_POST :';
     echo "<pre>";
     var_dump($_POST);
     echo "</pre>";
    echo "<br/>";
    echo 'Tableau $_SESSION :';
     echo "<pre>";
     var_dump($_SESSION);
     echo "</pre>";*/

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WOLFACE</title>
        
        <meta name="author" content="Valentin Vanhaecke, Fanny Gaudré" />
        <meta name="description" content="Mini Facebook personnalisé par Valentin V. et Fanny G." />
        <meta name="keywords" content="réseau social, projet, minifacebook" />
        <link rel="icon" href="images/favicon.png" type="image/png" />        
        
        <link href="css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        
        <script src="js/jquery-3.5.1.min.js"></script>
    </head>
    
    <body>
        <?php
            // Quelle est l'action à faire ?
            if (isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                $action = "accueil";
            }

            // Est ce que cette action existe dans la liste des actions
            if (array_key_exists($action, $listeDesActions) == false) {
                include("vues/error404.php"); // NON : page 404
            } else {
                include($listeDesActions[$action]); // Oui, on la charge
            }

            ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
        ?>
        <script>
            function viewProfil(id){
                document.location.href = "index.php?action=profil&id_profil="+id;
            }
            
            function searchPerson(regex){
                let patern = new RegExp(regex);
                console.log(patern);
                
                let allUsers = document.getElementsByClassName("carte-ami");
                /*console.log(allUsers);*/
                
                let allNomBrut = document.getElementsByClassName("nom-ami");
                let allNom = [];
                
                for(let i = 0; i < allNomBrut.length; i++){
                    allNom.push(allNomBrut[i].innerText.toLowerCase());
                }
                console.log(allNom);
                
                for(let i = 0; i < allNom.length; i++){
                    let matchText = patern.test(allNom[i]);
                    console.log(matchText);
                    if(matchText){
                       allUsers[i].style.display = "flex";
                    }else{
                       allUsers[i].style.display = "none";                       
                    }
                }
                
            }
        </script>
    </body>
</html>