<?php
    //echo "Page de profil.";
    if(!(isset($_SESSION["id"])) || !(isset($_SESSION["login"]))){
            //message("Création de la session");
            header('Location: index.php?action=connexion_inscription');
    }
?>

<!-- <body> -->
<!--PAGE DE PROFIL UTILISATEUR-->

<div class="page_accueil">
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
        <div class="contain_contain-profil">
            <?php
                $sql = "SELECT * FROM users where id=?";
                
                $q = $pdo->prepare($sql);
                
                $q->execute(array($_GET["id_profil"]));
            
                $line = $q->fetch();
                /*echo "<pre>";
                print_r($line);
                echo "</pre>";*/
            
                if(!$line){
                    header("Location: index.php?action=accueil");
                }else{
                
            ?>
            <div id="profil-infos">
                <div id="profil-entete">
                    <img id="photoDeProfil-entete" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                    <div id="infos">
                        <span id="profil-prenomNom"><?php  echo ucwords($line["user_name"]." ".$line["family_name"]); ?></span>
                        <span id="profil-naissance"><?php $time = strtotime($line["dateOfBirth"]); $date = date('d-m-Y', $time); echo $date; ?></span>
                        <span id="profil-sexe"><?php echo ucwords($line["gender"]); ?></span>
                    </div>
                </div>
                <div id="profil-amis">
                    <h3 id="amis-titre">Mes amis</h3>
                    <?php
                    //Liste d'envoi d'amis
                    $sql_envoi = "SELECT users.* FROM users INNER JOIN friends ON users.id=idUser2 AND state='attente' AND idUser1=?";
                
                    $q2 = $pdo->prepare($sql_envoi);

                    $q2->execute(array($_SESSION["id"]));

                    while($line2 = $q2->fetch()){
                        /*echo "<pre>";
                        print_r($line2);
                        echo "</pre>";*/
                        ?>
                        <div class="carte-ami">
                            <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            <span class="nom-ami"><?php echo $line2["family_name"]." ".$line2["user_name"]; ?></span>
                            <span class="status-ami">Demande envoyée</span>
                        </div>
                        <?php
                    }                  
                    
                    ?>
                    <?php
                    //Liste de demande d'amis
                    $sql_demande = "SELECT users.* FROM users WHERE id IN(SELECT idUser1 FROM friends WHERE idUser2=? AND state='attente')";
                
                    $q3 = $pdo->prepare($sql_demande);

                    $q3->execute(array($_SESSION["id"]));

                    while($line3 = $q3->fetch()){
                        /*echo "<pre>";
                        print_r($line3);
                        echo "</pre>";*/
                        ?>
                        <div class="carte-ami">
                            <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            <span class="nom-ami"><?php echo $line3["family_name"]." ".$line3["user_name"]; ?></span>
                            <span class="status-ami">Demande reçu</span>
                            <a class="bouton-accept" href="index.php?action=accept&id=<?php echo $line3["id"]; ?>">Accepter</a>
                            <a class="bouton-reject" href="index.php?action=reject&id=<?php echo $line3["id"]; ?>">Refuser</a>
                        </div>
                        <?php
                    }                  
                    
                    ?>
                    <?php
                    //Liste d'amis confirmés
                    $sql_amis = "SELECT * FROM users WHERE id IN ( SELECT users.id FROM users INNER JOIN friends ON idUser1=users.id AND state='ami' AND idUser2=? UNION SELECT users.id FROM users INNER JOIN friends ON idUser2=users.id AND state='ami' AND idUser1=?)";
                
                    $q4 = $pdo->prepare($sql_amis);

                    $q4->execute(array($_SESSION["id"], $_SESSION["id"]));

                    while($line4 = $q4->fetch()){
                        /*echo "<pre>";
                        print_r($line4);
                        echo "</pre>";*/
                        ?>
                        <div class="carte-ami">
                            <img class="photo-profil-ami" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            <span class="nom-ami"><?php echo $line4["family_name"]." ".$line4["user_name"]; ?></span>
                            <span class="status-ami">Vous êtes amis</span>
                        </div>
                        <?php
                    }                  
                    
                    ?>
                    <!--<div class="carte-ami">
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
                    </div>-->
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
            <?php
                }
            ?>
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