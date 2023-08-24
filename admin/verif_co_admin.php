<?php
include("database.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

var_dump($identifiant); 
    var_dump($password); 
    $req = $bdd->prepare("SELECT id FROM admin WHERE identifiant = '$identifiant' AND password = '$password'");
    $req->execute([$identifiant, $password]);

    if ($req->rowCount() > 0) {
        $result = $req->fetch();
        $adminId = $result['id'];
        $_SESSION['id'] = $adminId;
        header('Location:index_admin.php');
        exit;
    } else {
        echo 'Identifiants invalides. Veuillez réessayer.';
    }
}
?>
