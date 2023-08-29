<!DOCTYPE html>
<html>
<head>
    <title>Suppression d'utilisateur - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php include 'header_back_office.php'; ?>

<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: identification_process/connexion.php');
    exit;
}

include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Suppression de l'utilisateur
    $q = 'DELETE FROM users WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute(array($id));

    echo "<div class='alert alert-success'>Utilisateur supprimé avec succès.</div>";
} else {
    echo "<div class='alert alert-danger'>ID utilisateur manquant.</div>";
    exit;
}

?>

<a href="manage_users.php" class="btn btn-primary">Retour à la gestion des utilisateurs</a>

</body>
</html>

