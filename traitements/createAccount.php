<?php
$checkForm = true; //Vérification du formulaire
$error = "";

if(isset($_POST) && count($_POST)!=0){
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/
    
    //Vérification du nom et prénom
    if(!isset($_POST["nom"]) || !isset($_POST["prenom"])){
        $checkForm = false;
        $error = $error . " Données invalides (identifiant).";
    }
    
    //Vérification du genre
    if(!isset($_POST["sexe"]) || ($_POST["sexe"] != "homme" && $_POST["sexe"] != "femme" && $_POST["sexe"] != "autre")){
        $checkForm = false;
        $error = $error . " Données invalides (genre).";
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
        $family_name = ucfirst(strtolower($_POST["nom"]));
        $user_name = ucfirst(strtolower($_POST["prenom"]));
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $avatar = "image";
        $gender = $_POST["sexe"];
        $birth = $_POST["birth"];
        
        
        $sql = "SELECT * FROM users WHERE family_name = :family AND user_name = :name AND email = :email AND password = PASSWORD(:mdp) AND gender = :gender AND dateOfBirth = :date";
        
        // Etape 1  : preparation
        $q = $pdo->prepare($sql);

        // Etape 2 : execution
        $q->execute(array(
            'family' => $family_name,
            'name' => $user_name,
            'email' => $email,
            'mdp' => $mdp,
            'gender' => $gender,
            'date' => $birth
        ));
        
        $line=$q->fetch();
        echo "<pre>";
        var_dump($line);
        echo "</pre>";
        
        if($line){
            
            //Redirection si compte déjà existant
            echo "Compte déjà existant. Redirection vers le formulaire d'inscription.";
            header("location: index.php?action=connexion_inscription&message=existant");
            
        }else{
            
            //Création du compte si non existant
            $sql = "INSERT INTO users(family_name, user_name, email, password, avatar, gender, dateOfBirth) VALUES(:family, :name, :email, PASSWORD(:mdp), :avatar, :gender, :date)";

            // Etape 1  : preparation
            $q = $pdo->prepare($sql);

            // Etape 2 : execution : 7 paramètres dans la requêtes !!
            $q->execute(array(
                'family' => $family_name,
                'name' => $user_name,
                'email' => $email,
                'mdp' => $mdp,
                'avatar' => $avatar,
                'gender' => $gender,
                'date' => $birth
            ));

            echo "Formulaire validé et enregistré dans la base de donnée.";
            header("location: index.php?action=accueil");
            
        }
        
    }else{
        echo "<b>Erreur dans la validation du formulaire ! Erreur(s) :$error</b><br/>";
        header("location: index.php?action=connexion_inscription");
    }
    
}else{
    echo "Erreur !!! Aucun formulaire a été envoyé. Veuillez recommencer.";
    header("location: index.php?action=connexion_inscription");
}

?>