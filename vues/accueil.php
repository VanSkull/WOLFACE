<?php
    //echo "Page d'accueil.";

?>

<!-- <body> -->
<!--PAGE D'ACCUEIL-->
<div class="page_accueil">
    <div id="sidebar-menu">
        <div id="profil">
            <img id="photoDeProfil" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
            <p id="prenomNom">Prénom Nom</p>
        </div>

        <nav id="menu-liens">
            <a href="index.php?action=accueil">Accueil</a><br/>
            <a href="index.php?action=amis">Notifications</a><br/>
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