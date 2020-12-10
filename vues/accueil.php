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
            <a href="index.php?action=amis">Amis</a><br/>
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
        
        <div class="contain_contain-accueil">
            <div id="ecrit-post">
                <form action="index.php?action=ajoutPost" method="post">
                    <input type="text" id="title" name="title" placeholder="Écrivez un titre..." required/><br/>
                    <textarea id="content" name="content" placeholder="Écrivez votre poste ici..." required></textarea><br/>
                    <input id="send-post" type="submit" value="Envoyer">
                </form>
            </div>
            
            <?php
                //Liste des posts
                $sql_posts = "SELECT posts.*, users.*, posts.id AS IDPost, likes.*, likes.id AS idLike FROM posts JOIN users ON users.id=posts.idAmi JOIN likes ON users.id=likes.idUser WHERE posts.idAuteur=? OR posts.idAmi=? ORDER BY posts.datePost DESC";
                $q_posts = $pdo->prepare($sql_posts);
                
                $q_posts->execute(array($_SESSION["id"], $_SESSION["id"]));
                
                while($line_posts = $q_posts->fetch()){
                    /*echo "<pre>";
                    var_dump($line_posts);
                    echo "</pre>";*/
            ?>
            <div class="post-perso" id="post<?php echo $line_posts["IDPost"]; ?>">
                <div class="main-post">
                    <div class="photo-profil-auteur">
                        <img class="photo-auteur" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $line_posts["family_name"]."_".$line_posts["user_name"]; ?>" />
                    </div>
                    <div class="text-post">
                        <p class="nom-auteur"><?php echo $line_posts["family_name"]." ".$line_posts["user_name"]; ?></p>
                        <p class="titre-auteur"><?php echo $line_posts["title"]; ?></p>
                        <p class="post-auteur"><?php echo $line_posts["content"]; ?></p>
                        
                        <form action="index.php?action=ajoutLike" method="post">
                            <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>" />
                            <input type="hidden" name="userId" value="<?php echo $_SESSION["id"]; ?>" />
                            <input type="hidden" name="postId" value="<?php echo $line_posts["IDPost"]; ?>" />
                            <button type="submit" class="like-button"><i class="fa fa-thumbs-up" style="color: red;"></i></button>
                        </form>
                        
                        <p class="date-post">Posté par <?php echo $line_posts["family_name"]." ".$line_posts["user_name"]; ?> le <?php echo $line_posts["datePost"]; ?></p>
                    </div>
                </div>
                <div class="commentaire-post">
                    <h4 class="titre-commentaire">Commentaires</h4>
                    
                    <div id="ecrit-commentaire">
                        <form action="index.php?action=ajoutCommentaire" method="post">
                            <textarea id="content" name="content" placeholder="Écrivez votre poste ici..." required></textarea>
                            <input type="hidden" name="idPost" value="<?php echo $line_posts["IDPost"]; ?>" />
                            <input id="send-commentaire" type="submit" value="Envoyer">
                        </form>
                    </div>
                    
                    <?php
                        //Liste des commentaires
                        $sql_comments = "SELECT comments.*, users.* FROM comments JOIN users ON users.id=comments.idUser WHERE comments.idPost=? ORDER BY comments.dateComment DESC";

                        $q_comments = $pdo->prepare($sql_comments);
                        $q_comments->execute(array($line_posts["IDPost"]));

                        while($line_comments = $q_comments->fetch()){
                            /*echo "<pre>";
                            var_dump($line_comments);
                            echo "</pre>";*/
                    ?>
                    <div class="commentaire">
                        <div class="photo-commentateur">
                            <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_<?php echo $line_comments["family_name"]."_".$line_comments["user_name"]; ?>" />
                        </div>
                        <div class="main-commentaire">
                            <p class="commentaire-commentateur"><?php echo $line_comments["content"]; ?></p>
                            <p class="date-commentaire">Posté par <?php echo $line_comments["family_name"]." ".$line_comments["user_name"]; ?> le <?php echo $line_comments["dateComment"]; ?></p>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <!--<div class="commentaire">
                            <div class="photo-commentateur">
                                <img class="photo-profil-commentateur" src="images/img_profil.png" alt="Photo_de_profil_de_#" />
                            </div>
                            <div class="main-commentaire">
                                <p class="commentaire-commentateur">Lorem ipsum aaaaaaaaaaa</p>
                                <p class="date-commentaire">Posté par PRENOM NOM le DATE à HEURE</p>
                            </div>
                        </div>-->
                </div>                            
            </div>
            
            <?php
                }
            ?>                     
                
            <!--<div class="post-perso">
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
                </div>-->
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