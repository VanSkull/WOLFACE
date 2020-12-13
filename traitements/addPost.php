<?php
    date_default_timezone_set('Europe/Paris');

    define('TARGET', './images/posts/');
    define('MAX_size', 1000000);

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "Post envoyé !";

    //Script pour uploader l'image
    $tabExt = array('jpg', 'gif', 'png', 'jpeg');
    $infosImg = array();
    $extension = '';
    $message = '';
    $nomImage = '';

    if( !is_dir(TARGET) ) {
      if( !mkdir(TARGET, 0755) ) {
        exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
      }
    }

    if(!empty($_POST)){
        
      // On verifie si le champ est rempli        
      if( !empty($_FILES['image']['name']) ){
          
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if(in_array(strtolower($extension),$tabExt)){
            
          // On recupere les dimensions du fichier
          $infosImg = getimagesize($_FILES['image']['tmp_name']);

          // On verifie le type de l'image
          if($infosImg[2] >= 1 && $infosImg[2] <= 14){
                
              // Parcours du tableau d'erreurs
              if(isset($_FILES['image']['error']) 
                && UPLOAD_ERR_OK === $_FILES['image']['error']){
                  
                // On renomme le fichier
                $nomImage = md5(uniqid()) .'.'. $extension;

                // Si c'est OK, on teste l'upload
                if(move_uploaded_file($_FILES['image']['tmp_name'], TARGET.$nomImage)){
                  $message = 'Upload réussi !';
                }else{
                  // Sinon on affiche une erreur systeme
                  $message = 'Problème lors de l\'upload !';
                }
              }else{
                $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
              }
          }else{
            // Sinon erreur sur le type de l'image
            $message = 'Le fichier à uploader n\'est pas une image !';
          }
        }else{
          // Sinon on affiche une erreur pour l'extension
          $message = 'L\'extension du fichier est incorrecte !';
        }
      }else{
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
      }
    }

    var_dump($message);
    var_dump($nomImage);

    if($nomImage != ""){
        $lienImage = "./images/posts/".$nomImage;
    }else{
        $lienImage = "";
    }
    
    var_dump($lienImage);
    ////////////////////////////////////////////////////////////////
    
    $nextPage = $_POST["page"];
    if($nextPage == "profil"){
        $nextPage = $nextPage."&id_profil=".$_POST["idProfil"];
    }else{
        $nextPage = "accueil";
    }
        
    
    $title = $_POST["title"];
    $content = $_POST["content"];
    $date = date('d/m/y à H\hi');
    $image = $lienImage;
    $auteur = $_SESSION["id"];
    if(isset($_POST["idAmi"]) && is_numeric($_POST["idAmi"])){
        $ami = $_POST["idAmi"];
    }else{
        $ami = $_SESSION["id"];
    }
    
    var_dump($date);
    
    $sql = "INSERT INTO posts VALUES(NULL, :title, :content, :date, :image, :idAuteur, :idAmi)";

    $q = $pdo->prepare($sql);

    $q->execute(array(
        'title' => $title,
        'content' => $content,
        'date' => $date,
        'image' => $image,
        'idAuteur' => $auteur,
        'idAmi' => $ami
    ));
    
    header("Location: index.php?action=$nextPage");

?>