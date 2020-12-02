<?php
    echo "Amitié établie !";
    
    $sql = "UPDATE friends SET state='refus' WHERE idUser1=? AND idUser2=?";

    $q = $pdo->prepare($sql);

    $q->execute(array($_GET["id"], $_SESSION["id"]));
    
    header("Location: index.php?action=profil");
?>