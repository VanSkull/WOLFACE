<?php
    define('TARGET', './images/imgProfil/');
    define('MAX_size', 2000000);

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    
    echo "<pre>";
    var_dump($_FILES);
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

    if(empty($_POST)){
        
      // On verifie si le champ est rempli        
      if( !empty($_FILES['photo-avatar']['name']) ){
          
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($_FILES['photo-avatar']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if(in_array(strtolower($extension),$tabExt)){
            
          // On recupere les dimensions du fichier
          if($_FILES['photo-avatar']['tmp_name'] != ""){
            $infosImg = getimagesize($_FILES['photo-avatar']['tmp_name']);
          }

          // On verifie le type de l'image
          if(!empty($infosImg) && count($infosImg) > 0 && $infosImg[2] >= 1 && $infosImg[2] <= 14){
              
            // On vérifie la taille du fichier
            if(isset($_FILES['photo-avatar']['size']) && $_FILES['photo-avatar']['size'] <= 2000000 && $_FILES['photo-avatar']['size'] > 0){
              // Parcours du tableau d'erreurs
              if(isset($_FILES['photo-avatar']['error']) 
                && UPLOAD_ERR_OK === $_FILES['photo-avatar']['error']){
                  
                // On renomme le fichier
                $nomImage = md5(uniqid()) .'.'. $extension;

                // Si c'est OK, on teste l'upload
                if(move_uploaded_file($_FILES['photo-avatar']['tmp_name'], TARGET.$nomImage)){
                  $message = 'Upload réussi !';
                }else{
                  // Sinon on affiche une erreur systeme
                  $message = 'Problème lors de l\'upload !';
                }
              }else{
                $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
              }                    
            }else{
                // Sinon erreur sur la taille de l'image        
                $message = 'Le fichier à uploader est beaucoup trop lourd !';
            }
              
          }else{
            // Sinon erreur sur le type de l'image
            $message = 'Le fichier à uploader n\'est pas une image ou beaucoup trop lourd !';
          }
        }else{
          // Sinon on affiche une erreur pour l'extension
          $message = 'L\'extension du fichier est incorrecte ou beaucoup trop lourd !';
        }
      }else{
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
      }
    }
    
    echo "<pre>";
    var_dump($infosImg);
    echo "</pre>";
    var_dump($message);
    var_dump($nomImage);

    if($nomImage != ""){
        $lienImage = "./images/imgProfil/".$nomImage;
    }else{
        $lienImage = "image";
    }
    
    var_dump($lienImage);
    ///////////////////////////////////////////////////////////////////////////////
    
    $sql = "UPDATE users SET avatar=? WHERE id=".$_SESSION["id"];

    $q = $pdo->prepare($sql);

    $q->execute(array($lienImage));
    
    header("Location: index.php?action=profil&id_profil=".$_SESSION["id"]);

?>