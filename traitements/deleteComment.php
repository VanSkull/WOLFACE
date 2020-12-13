<?php
    $action = $_GET["page"];
    $postNum = $_GET["postId"];
    $idComment = $_GET["id"];
    if(isset($_GET["idProfil"])){
        $action = $action."&id_profil=".$_GET["idProfil"];
    }

    $sql = "DELETE FROM comments WHERE id=?";

    $q = $pdo->prepare($sql);

    $q->execute(array($idComment));

    header("Location: index.php?action=".$action."#post".$postNum);
?>