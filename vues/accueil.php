<?php
    //echo "Page d'accueil.";
    if(!(isset($_SESSION["id"])) || !(isset($_SESSION["login"]))){
            //message("Création de la session");
            header('Location: index.php?action=connexion_inscription');
    }
?>

<!-- <body> -->
<!--PAGE D'ACCUEIL-->
<div class="page_accueil">
    <div id="sidebar-menu">
        <div id="profil">
            <img id="photoDeProfil" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $_SESSION["login"]; ?>" />
            <p id="prenomNom" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)"><?php echo str_replace("_", " ", $_SESSION["login"]); ?></p>
        </div>

        <nav id="menu-liens">
            <a href="index.php?action=accueil">Accueil</a><br/>
            <a href="index.php?action=amis">Notifications</a><br/>
            <a href="index.php?action=profil&id_profil=<?php echo $_SESSION["id"]; ?>">Mon profil</a>
        </nav>

        <div id="liste-amis">
            <ul>
                <?php
                    $sql = "SELECT * FROM users WHERE id IN ( SELECT users.id FROM users INNER JOIN friends ON idUser1=users.id AND state='ami' AND idUser2=? UNION SELECT users.id FROM users INNER JOIN friends ON idUser2=users.id AND state='ami' AND idUser1=?) LIMIT 0, 5";
                    
                    $q = $pdo->prepare($sql);
                
                    $q->execute(array($_SESSION["id"], $_SESSION["id"]));
                
                    while($line = $q->fetch()){
                        /*echo "<pre>";
                        var_dump($line);
                        echo "</pre>";*/
                ?>
                <li><a href="index.php?action=profil&id_profil=<?php echo $line["id"]; ?>" class="ami-lien"><?php echo $line["family_name"]." ".$line["user_name"]; ?></a></li>
                <?php
                    }
                ?>
            </ul>
        </div>

        <a href="index.php?action=logout" id="lien-deconnexion">Déconnexion</a>
    </div>

    <div id="main-contain">
        
        
            <div id="recherche">
                <input type="search" id="friend-search" name="fs" placeholder="Rechercher un ami">
            </div>
        
        
        <div class="contain_contain-accueil">
            
            <div id="post">
                <img src="images/img_profil.png" alt="photoDeProfil" id="pdp">
                <div id="part-text">
                    <p id="name">PRENOM NOM</p>
                    <img src="images/gros_minet.jpg" alt="gros-minet">
                    <p id="quiQuand">Posté par le PRENOM NOM le DATE à HEURE</p>
                </div>
            </div>
            
            <div id="commentaires">
                <p>Commentaires</p>
                <div class="comm_text">
                    <img src="images/img_profil.png" alt="photoDeProfil" id="pdp">
                    <div id="part-text">
                        <p id="text">Quoi de neuf ?</p>
                        <p id="quiQuand">Posté par PRENOM NOM le DATE à HEURE</p>
                    </div>
                </div>
                
                <div class="comm_text">
                    <img src="images/img_profil.png" alt="photoDeProfil" id="pdp">
                    <div id="part-text">
                        <p id="text">Heu... J'ai cru voir un gros minet !!</p>
                        <p id="quiQuand">Posté par PRENOM NOM le DATE à HEURE</p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <div id="copyright">
            <a id="lien-accueil" href="index.php?action=accueil"><img id="logo" src="images/logo.png" alt="Logo_Wolface" /></a>
            <p id="copyright-text">
                Copyright ©2020<br/>
                Tout droits réservés à Wolface
            </p>
        </div>
    </div>
</div>
<!-- </body> -->