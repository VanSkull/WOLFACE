<?php
    //echo "Page d'amis.";
    if(!(isset($_SESSION["id"])) || !(isset($_SESSION["login"]))){
            //message("Création de la session");
            header('Location: index.php?action=connexion_inscription');
    }
?>

<!-- <body> -->
<!--PAGE D'AMIS-->
<div id="sidebar-menu">
    <div id="profil">
        <img id="photoDeProfil" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $_SESSION["login"]; ?>" />
        <p id="prenomNom" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)"><?php echo str_replace("_", " ", $_SESSION["login"]); ?></p>
    </div>
    
    <nav id="menu-liens">
        <a href="index.php?action=accueil">Accueil</a>
        <a href="index.php?action=amis">Notifications</a>
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
    <div class="contain contain-amis">
        <?php
            $sql2 = "SELECT * FROM users WHERE id != ?";
        
            $q2 = $pdo->prepare($sql2);
        
            $q2->execute(array($_SESSION["id"]));
            
            while($line2 = $q2->fetch()){
                echo "<pre>";
                var_dump($line2);
                echo "</pre>";
        ?>

        <div class="carte-ami">
            <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $line2["family_name"]."_".$line2["user_name"]; ?>" />
            <span class="nom-ami"><?php echo $line2["family_name"]." ".$line2["user_name"]; ?></span>
            <span class="status-ami">Demande envoyée</span>
        </div>
        
        <?php
            }
        ?>
        
        <!-- Mettre le code ici -->        
    </div>
    <div id="copyright">
        <a id="lien-accueil" href="index.php?action=accueil"><img id="logo" src="images/logo.png" alt="Logo_Wolface" /></a>
        <p id="copyright-text">
            Copyright ©2020<br/>
            Tout droits réservés à Wolface
        </p>
    </div>
</div>
<!-- </body> -->