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
        <a href="index.php?action=amis">Amis</a>
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
    
    <div class="contain contain-amis">
        <?php
            $sql2 = "SELECT users.id AS IDUser, users.* FROM users WHERE users.id != ? ORDER BY users.family_name, users.user_name";
            //INNER JOIN friends ON users.id=friends.idUser1 OR users.id=friends.idUser2     
        
            $q2 = $pdo->prepare($sql2);
        
            $q2->execute(array($_SESSION["id"]));
            
            while($line2 = $q2->fetch()){
                /*echo "<pre>";
                var_dump($line2);
                echo "</pre>";*/
        ?>

        <div class="carte-ami" onclick="viewProfil(<?php echo $line2["IDUser"]; ?>);">
            <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $line2["family_name"]."_".$line2["user_name"]; ?>" />
            <span class="nom-ami"><?php echo $line2["family_name"]." ".$line2["user_name"]; ?></span>
            <?php
                //Attribution de l'état de l'amitié                
                $sql3 = "SELECT * FROM friends WHERE (idUser1=? AND idUser2=?) OR (idUser1=? AND idUser2=?)";
                     

                $q3 = $pdo->prepare($sql3);

                $q3->execute(array($_SESSION["id"], $line2["IDUser"], $line2["IDUser"], $_SESSION["id"]));
                
                $line3 = $q3->fetch();

                /*echo "<pre>";
                var_dump($line3);
                echo "</pre>";*/
                
                if(!$line3){
            ?>
                    <span class="status-ami">Inconnu</span>
            <?php
                }else{
                    if($line3["state"]=="ami"){
            ?>
                    <span class="status-ami">Vous êtes amis</span>
            <?php
                    }else if($line3["idUser1"]==$_SESSION["id"] && $line3["state"]=="attente"){
            ?>
                    <span class="status-ami">Demande envoyée</span>
            <?php
                    }else if($line3["idUser2"]==$_SESSION["id"] && $line3["state"]=="attente"){
            ?>
                    <span class="status-ami">Demande reçue</span>
                    <a class="bouton-accept" href="index.php?action=accept&id=<?php echo $line3["idUser1"]; ?>">Accepter</a>
                    <a class="bouton-reject" href="index.php?action=reject&id=<?php echo $line3["idUser1"]; ?>">Refuser</a>
            <?php
                    }else if($line3["state"]=="refus"){
            ?>
                    <span class="status-ami">Vous n'êtes pas amis</span>
            <?php  
                    }
                }
            ?>
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