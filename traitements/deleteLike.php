<?php

    $action = $_POST["page"];
    $userNum = $_POST["userId"];
    $postNum = $_POST["postId"];
    
    $sql = "DELETE FROM likes WHERE idUser=:idUser AND idPost=:idPost";

    $q = $pdo->prepare($sql);

    $q->execute(array(
        'idUser' => $userNum,
        'idPost' => $postNum
    ));

    header("Location: index.php?action=".$action."#post".$postNum);
?>