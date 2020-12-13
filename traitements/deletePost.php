<?php
    $action = $_GET["page"];
    $postNum = $_GET["id"];

    $sql_post = "DELETE FROM posts WHERE id=?";

    $q_post = $pdo->prepare($sql_post);

    $q_post->execute(array($postNum));

    $sql_comment = "DELETE FROM comments WHERE idPost=?";

    $q_comment = $pdo->prepare($sql_comment);

    $q_comment->execute(array($postNum));

    header("Location: index.php?action=".$action."#post".$postNum);
?>