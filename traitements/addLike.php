<?php
    
    $action = $_POST["page"];
    $userNum = $_POST["userId"];
    $postNum = $_POST["postId"];
    
    $sql = "INSERT INTO likes VALUES(NULL, :idUser, :idPost)";

    $q = $pdo->prepare($sql);

    $q->execute(array(
        'idUser' => $userNum,
        'idPost' => $postNum
    ));

    header("Location: index.php?action=".$action."#post".$postNum);
?>