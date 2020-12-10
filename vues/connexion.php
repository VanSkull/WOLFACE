<?php
    /*if(isset($_POST) && count($_POST)!=0){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        if(checkdate(31, 12, 2000)){
            echo "Date bien écrite";
        }else{
            echo "Erreur! Date invalide!";
        }
    }*/
?>

<!-- <body> -->
    <div class="page_connexion">
        <div class="connexion">
            <form method="post" action="index.php?action=login">
                <h1>CONNEXION</h1> 
                <input type="text" name="login" id="email" value="" placeholder="E-mail"/> <br/>
                <input type="password" name="password" id="mdp" value="" placeholder="Mot de passe"/> <br/>
                <a href="#">Mot de passe oublié ?</a><br/>
                <input id="connexion-button" type="submit" value="Connexion"/>
            </form>
        </div>
        
        <div class="logo">
            <img src="images/logo.png" alt="logo" width="250px" height="250px">
        </div>
      
        <div class="inscription">
            <form method="post" action="index.php?action=inscription">
                <h1>INSCRIPTION</h1>
                <input type="text" name="nom" id="nom" value="" placeholder="Nom"/>
                <input type="text" name="prenom" id="prenom" value="" placeholder="Prénom"/> <br/>
                <input type="text" name="email" id="email" value="" placeholder="E-mail"/><br/>
                <input type="password" name="mdp" id="mdp" value="" placeholder="Mot de passe"/><br/>
                <input type="password" name="mdpconf" id="mdpconf" value="" placeholder="Confirmation mot de passe"/> <br/>
                <label for="birth">Date de naissance : </label>
                <input type="date" name="birth" id="birth" /> <br/>
                <ul>
                    <ul>
                        <label for="sexe">Sexe :</label>
                        <input type="radio" id="masculin" name="sexe" value="homme" checked>
                        <label for="maculin">Masculin</label>
                    </ul>
                    <ul>
                        <input type="radio" id="feminin" name="sexe" value="femme">
                        <label for="feminin">Féminin</label>
                    </ul>
                    <ul>
                        <input type="radio" id="autre" name="sexe" value="autre">
                        <label for="autre">Autre</label>
                    </ul>
                </ul>
                <input id="inscription-button" type="submit" value="Inscription"/>
            </form>
        </div>
    </div>
<!-- </body> -->
