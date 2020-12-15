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
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            
            //Preview de la photo sur la page "Profil"
            let input = document.querySelector('#input-file');
            let preview = document.querySelector('#preview-file');
            input.style.opacity = 0;
            input.addEventListener('change', updateImageDisplay);
            
            function updateImageDisplay() {
                while(preview.firstChild) {
                    preview.removeChild(preview.firstChild);
                }

                let curFiles = input.files;
                console.log(curFiles);
                if(curFiles.length === 0) {
                    let para = document.createElement('p');
                    para.textContent = 'Aucune photo sélectionnée';
                    preview.appendChild(para);
                }else{
                    let list = document.createElement('ol');
                    list.style.listStyleType = "none";
                    preview.appendChild(list);
                    for(let i = 0; i < curFiles.length; i++) {
                        let listItem = document.createElement('li');
                        let para = document.createElement('p');
                        para.style.wordBreak = 'normal';

                        if(validFileType(curFiles[i])) {
                            para.textContent = 'Nom : ' + curFiles[i].name + ', taille : ' + returnFileSize(curFiles[i].size) + '.';
                            let image = document.createElement('img');
                            image.style.width = '50px';
                            image.style.height = '50px';
                            image.style.borderRadius = '5px';
                            image.src = window.URL.createObjectURL(curFiles[i]);

                            listItem.appendChild(image);
                            listItem.appendChild(para);

                        }else{
                            para.textContent = 'Nom : ' + curFiles[i].name + ': Type de fichier non accepté ou trop lourd (> 2Mo). Changez votre photo.';
                            listItem.appendChild(para);
                        }
                        list.appendChild(listItem);
                    }
                }
            }
            
            let fileTypes = [
              'image/jpeg',
              'image/jpg',
              'image/gif',
              'image/png'
            ]

            function validFileType(file) {
              //Vérification du format
              if(file.size > 2000000){
                return false;   
              }
                
              //Vérification du format
              for(let i = 0; i < fileTypes.length; i++) {
                if(file.type === fileTypes[i]) {
                  return true;
                }
              }
              return false;
            }
            
            function returnFileSize(number) {
              if(number < 1024) {
                return number + ' octets';
              } else if(number >= 1024 && number < 1048576) {
                return (number/1024).toFixed(1) + ' Ko';
              } else if(number >= 1048576) {
                return (number/1048576).toFixed(1) + ' Mo';
              }
            }
        </script>
    </body>
</html>