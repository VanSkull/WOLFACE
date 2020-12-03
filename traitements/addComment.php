<?php
    date_default_timezone_set('Europe/Paris');
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "Commentaire envoyé !";

    $IDUser = $_SESSION["id"];
    $content = $_POST["content"];
    $IDPost = $_POST["idPost"];
    $date = date('d/m/y à H\hi');
    $image = "";
    
    var_dump($date);
    
    $sql = "INSERT INTO comments VALUES(NULL, :idUser, :content, :idPost, :date, :image)";

    $q = $pdo->prepare($sql);

    $q->execute(array(
        'idUser' => $IDUser,
        'content' => $content,
        'idPost' => $IDPost,
        'date' => $date,
        'image' => $image
    ));
    
    header("Location: index.php?action=accueil");

?>