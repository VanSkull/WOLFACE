<?php
    //echo "Page d'accueil.";

?>

<!-- <body> -->
<!--PAGE D'ACCUEIL-->
<div id="sidebar-menu">
    <div id="profil">
        <img id="photoDeProfil" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
        <p id="prenomNom">Prénom Nom</p>
    </div>
    
    <nav id="menu-liens">
        <a href="index.php?action=accueil">Accueil</a>
        <a href="index.php?action=amis">Notifications</a>
        <a href="index.php?action=profil">Mon profil</a>
    </nav>
    
    <div id="liste-amis">
        <ul>
            <li><a href="index.php?action=profil&id_profil=1" class="ami-lien">Ami 1</a></li>
            <li><a href="index.php?action=profil&id_profil=2" class="ami-lien">Ami 2</a></li>
            <li><a href="index.php?action=profil&id_profil=3" class="ami-lien">Ami 3</a></li>
        </ul>
    </div>
    
    <a href="index.php?action=logout" id="lien-deconnexion">Déconnexion</a>
</div>

<div id="main-contain">
    <div class="contain contain-accueil">
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