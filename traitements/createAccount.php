<?php
$checkForm = true; //Vérification du formulaire
$error = "";

if(isset($_POST) && count($_POST)!=0){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    if(!isset($_POST["login"])){
        $checkForm = false;
        $error = $error . " Données invalides (identifiant).";
    }
    
    if(!isset($_POST["email"]) || !isset($_POST["emailVerif"]) || filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)==false || filter_var($_POST["emailVerif"], FILTER_VALIDATE_EMAIL)==false || $_POST["email"]!=$_POST["emailVerif"]){
        $checkForm = false;
        $error = $error . " Données invalides (e-mail).";
    }
    
    if(!isset($_POST["mdp"]) || !isset($_POST["mdpVerif"]) || $_POST["mdp"]!=$_POST["mdpVerif"]){
        $checkForm = false;
        $error = $error . " Données invalides (mots de passe).";
    }
    
    if($checkForm == true){
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        $email = $_POST["email"];
        
        $sql = "INSERT INTO user(login, mdp, email) VALUES(:login, PASSWORD(:mdp), :email)";

        // Etape 1  : preparation
        $q = $pdo->prepare($sql);

        // Etape 2 : execution : 2 paramètres dans la requêtes !!
        $q->execute(array(
            'login' => $login,
            'mdp' => $mdp,
            'email' => $email
        ));
        
        echo "Formulaire validé et enregistré dans la base de donnée.";
        header("location: index.php?action=login&display=sucess");
        
    }else{
        echo "<b>Erreur dans la validation du formulaire ! Erreur(s) :$error</b><br/>";
        header("location: index.php?action=logup&display=error");
    }
    
}else{
    echo "Erreur !!! Aucun formulaire a été envoyé. Veuillez recommencer.";
    header("location: index.php?action=logup&display=error");
}

?>