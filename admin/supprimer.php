<?php
session_start();
include("database.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    
    $selectReq = $bdd->prepare('SELECT * FROM users WHERE id=?');
    $selectReq->execute(array($getid));

    if ($selectReq->rowCount() > 0) {
        $deleteReq = $bdd->prepare('DELETE FROM users WHERE id=?');
        $deleteReq->execute(array($getid));

        header('location:membre.php');
    } else {
        echo "Aucun utilisateur n'a été trouvé !";
    }
} else {
    echo "L'identifiant de l'utilisateur n'a pas pu être récupéré.";
}
?>
