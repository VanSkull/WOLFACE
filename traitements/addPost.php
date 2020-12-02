<?php
    date_default_timezone_set('Europe/Paris');
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "Post envoyé !";

    $title = $_POST["title"];
    $content = $_POST["content"];
    $date = date('d/m/y à H\hi');
    $image = "";
    $auteur = $_SESSION["id"];
    if(isset($_POST["idAmi"]) && is_numeric($_POST["idAmi"])){
        $ami = $_POST["idAmi"];
    }else{
        $ami = $_SESSION["id"];
    }
    
    var_dump($date);
    
    $sql = "INSERT INTO posts VALUES(NULL, :title, :content, :date, :image, :idAuteur, :idAmi)";

    $q = $pdo->prepare($sql);

    $q->execute(array(
        'title' => $title,
        'content' => $content,
        'date' => $date,
        'image' => $image,
        'idAuteur' => $auteur,
        'idAmi' => $ami
    ));
    
    header("Location: index.php?action=accueil");

?>