<?php
    //echo "Page d'accueil.";
    if(!(isset($_SESSION["id"])) || !(isset($_SESSION["login"]))){
            //message("Création de la session");
            header('Location: index.php?action=connexion_inscription');
    }
?>

<!-- <body> -->
<!--PAGE DE PROFIL UTILISATEUR-->
<div id="sidebar-menu">
    <div id="profil">
        <img id="photoDeProfil" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $_SESSION["login"]; ?>" />
        <p id="prenomNom" onclick="viewProfil(<?php echo $_SESSION["id"]; ?>)"><?php echo $_SESSION["login"]; ?></p>
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
    <div class="contain contain-profil">
        <div id="profil-infos">
            <div id="profil-entete">
                <img id="photoDeProfil-entete" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                <div id="infos">
                    <span id="profil-prenomNom">Prénom Nom</span>
                    <span id="profil-naissance">Date de naissance</span>
                    <span id="profil-sexe">Sexe</span>
                </div>
            </div>
            <div id="profil-amis">
                <h3 id="amis-titre">Mes amis</h3>
                <div class="carte-ami">
                    <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                    <span class="nom-ami">Prénom Nom</span>
                    <span class="status-ami">Vous êtes déjà ami</span>
                </div>
                <div class="carte-ami">
                    <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                    <span class="nom-ami">Prénom Nom</span>
                    <span class="status-ami">Vous êtes déjà ami</span>
                </div>
                <div class="carte-ami">
                    <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                    <span class="nom-ami">Prénom Nom</span>
                    <span class="status-ami">Vous êtes déjà ami</span>
                </div>
            </div>
            <div id="profil-post">
                <h3 id="post-titre">Mes posts</h3>
                <div class="post-perso">
                    <div class="main-post">
                        <div class="photo-profil-auteur">
                            <img class="photo-auteur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                        </div>
                        <div class="text-post">
                            <p class="nom-auteur">PRENOM NOM</p>
                            <p class="post-auteur">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et enim neque. Cras tincidunt hendrerit dignissim. Integer et ligula porttitor, pharetra erat id, lacinia justo. Vivamus ipsum sapien, auctor quis lectus eget, volutpat feugiat nisl. Nam consectetur, mauris vitae aliquam sagittis, justo velit interdum felis, dapibus lacinia velit augue sit amet odio. Fusce bibendum congue leo sed vestibulum. Vivamus mauris quam, suscipit sed porta bibendum, ultricies eget sapien. Phasellus id tempus lorem. Morbi id gravida urna, eget semper leo. Donec eu volutpat enim.</p>
                            <p class="date-post">Posté par PRENOM NOM le DATE à HEURE</p>
                        </div>
                    </div>
                    <div class="commentaire-post">
                        <h4 class="titre-commentaire">Commentaires</h4>
                        <div class="commentaire">
                            <div class="photo-commentateur">
                                <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            </div>
                            <div class="main-commentaire">
                                <p class="commentaire-commentateur">Lorem ipsum aaaaaaaaaaa</p>
                                <p class="date-commentaire">Posté par PRENOM NOM le DATE à HEURE</p>
                            </div>
                        </div>
                        <div class="commentaire">
                            <div class="photo-commentateur">
                                <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            </div>
                            <div class="main-commentaire">
                                <p class="commentaire-commentateur">Lorem ipsum aaaaaaaaaaa</p>
                                <p class="date-commentaire">Posté par PRENOM NOM le DATE à HEURE</p>
                            </div>
                        </div>
                    </div>                            
                </div>
                <div class="post-perso">
                    <div class="main-post">
                        <div class="photo-profil-auteur">
                            <img class="photo-auteur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                        </div>
                        <div class="text-post">
                            <p class="nom-auteur">PRENOM NOM</p>
                            <p class="post-auteur">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et enim neque. Cras tincidunt hendrerit dignissim. Integer et ligula porttitor, pharetra erat id, lacinia justo. Vivamus ipsum sapien, auctor quis lectus eget, volutpat feugiat nisl. Nam consectetur, mauris vitae aliquam sagittis, justo velit interdum felis, dapibus lacinia velit augue sit amet odio. Fusce bibendum congue leo sed vestibulum. Vivamus mauris quam, suscipit sed porta bibendum, ultricies eget sapien. Phasellus id tempus lorem. Morbi id gravida urna, eget semper leo. Donec eu volutpat enim.</p>
                            <p class="date-post">Posté par PRENOM NOM le DATE à HEURE</p>
                        </div>
                    </div>
                    <div class="commentaire-post">
                        <h4 class="titre-commentaire">Commentaires</h4>
                        <div class="commentaire">
                            <div class="photo-commentateur">
                                <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            </div>
                            <div class="main-commentaire">
                                <p class="commentaire-commentateur">Lorem ipsum aaaaaaaaaaa</p>
                                <p class="date-commentaire">Posté par PRENOM NOM le DATE à HEURE</p>
                            </div>
                        </div>
                        <div class="commentaire">
                            <div class="photo-commentateur">
                                <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            </div>
                            <div class="main-commentaire">
                                <p class="commentaire-commentateur">Lorem ipsum aaaaaaaaaaa</p>
                                <p class="date-commentaire">Posté par PRENOM NOM le DATE à HEURE</p>
                            </div>
                        </div>
                    </div>                            
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
<!-- </body> -->