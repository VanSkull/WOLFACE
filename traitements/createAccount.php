<?php
$checkForm = true; //Vérification du formulaire
$error = "";

if(isset($_POST) && count($_POST)!=0){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    //Vérification du nom et prénom
    if(!isset($_POST["nom"]) || !isset($_POST["prenom"])){
        $checkForm = false;
        $error = $error . " Données invalides (identifiant).";
    }
    
    //Vérification du e-mail
    if(!isset($_POST["email"]) || filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)==false){
        $checkForm = false;
        $error = $error . " Données invalides (e-mail).";
    }
    
    //Vérification du mot de passe
    if(!isset($_POST["mdp"]) || !isset($_POST["mdpconf"]) || $_POST["mdp"]!=$_POST["mdpconf"]){
        $checkForm = false;
        $error = $error . " Données invalides (mots de passe).";
    }
    
    //Vérification de la date de naissance
    if(!isset($_POST["birth"]) /*|| strptime($_POST["birth"], "%Y-%m-%d")==false*/){
        $checkForm = false;
        $error = $error . " Données invalides (Date de naissance).";
    }
    
    if($checkForm == true){
        $family_name = $_POST["nom"];
        $user_name = $_POST["prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        
        $sql = "INSERT INTO users(login, mdp, email) VALUES(:login, PASSWORD(:mdp), :email)";

        // Etape 1  : preparation
        $q = $pdo->prepare($sql);

        // Etape 2 : execution : 2 paramètres dans la requêtes !!
        $q->execute(array(
            'login' => $login,
            'mdp' => $mdp,
            'email' => $email
        ));
        
        echo "Formulaire validé et enregistré dans la base de donnée.";
        //header("location: index.php?action=accueil");
        
    }else{
        echo "<b>Erreur dans la validation du formulaire ! Erreur(s) :$error</b><br/>";
        //header("location: index.php?action=connexion_inscription");
    }
    
}else{
    echo "Erreur !!! Aucun formulaire a été envoyé. Veuillez recommencer.";
    //header("location: index.php?action=connexion_inscription");
}

?>