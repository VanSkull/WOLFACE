<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>WOLFACE / Connexion - Inscription</title>
        
        <meta name="author" content="Valentin Vanhaecke, Fanny Gaudré" />
        <meta name="description" content="Mini Facebook personnalisé par Valentin V. et Fanny G." />
        <meta name="keywords" content="réseau social, projet, minifacebook" />
        <link rel="icon" href="images/favicon.png" type="image/png" />        
        
        <link href="css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <?php
            if(isset($_POST) && count($_POST)!=0){
                echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                
                /*if(checkdate(31, 12, 2000)){
                    echo "Date bien écrite";
                }else{
                    echo "Erreur! Date invalide!";
                }*/
            }
        ?>
        
        <div class="page_connexion">
            
            <div class="connexion">
                <form method="post" action="#">
            
                    <h1>CONNEXION</h1> 
                    <input type="text" name="login" id="email" value="" placeholder="email"/> <br/>
                    <input type="text" name="password" id="mdp" value="" placeholder="mot de passe"/> <br/>
                    <a href="#">Mot de passe oublié ?</a><br/>
                    <input type="submit" name="connexion" value="Connexion"/>
                </form>
            </div>
        
            <div class="inscription">
                <form method="post" action="#">
        
                    <h1>INSCRIPTION</h1>
                    <input type="text" name="nom" id="nom" value="" placeholder="NOM"/>
                    <input type="text" name="prenom" id="prenom" value="" placeholder="PRENOM"/> <br/>
                    <input type="text" name="email" id="email" value="" placeholder="email"/><br/>
                    <input type="text" name="mdp" id="mdp" value="" placeholder="mot de passe"/><br/>
                    <input type="text" name="mdpconf" id="mdpconf" value="" placeholder="Confirmation mot de passe"/> <br/>
                    <label for="birth">Date de naissance</label>
                    <input type="date" name="birth" id="birth" value="Date de naissance :"/> <br/>
                    <label for="sexe">Sexe :</label>
                    <input type="radio" id="masculin" name="sexe" value="Masculin" checked>
                    <label for="maculin">Masculin</label>
                    <input type="radio" id="feminin" name="sexe" value="Féminin">
                    <label for="feminin">Féminin</label>
                    <input type="radio" id="autre" name="sexe" value="Autre">
                    <label for="autre">Autre</label>
                    <input type="submit" name="connexion" value="Connexion"/>
                </form>
            </div>
            
        </div>
        
    </body>
</html>