<!DOCTYPE html>
<html>
<head>
    <title>Gestion des étapes - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php include 'header_back_office.php'; ?>

<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}

include("includes/db.php");

// Exécuter la requête pour obtenir toutes les étapes en utilisant une requête préparée
$q = 'SELECT * FROM travel_stages';
$req = $bdd->prepare($q);
$req->execute();
$stages = $req->fetchAll();
?>

<body>
<div class="container mt-5">
    <h2>Gestion des étapes</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Parcourir les résultats et les afficher dans le tableau -->
        <?php foreach ($stages as $stage): ?>
            <tr>
                <td><?= $stage['id'] ?></td>
                <td><?= $stage['nom'] ?></td>
                <td><img src="<?= $stage['photo'] ?>" alt="<?= $stage['nom'] ?>" width="100"></td>
                <td>
                    <!-- Bouton pour modifier -->
                    <a href="edit_travel_stage.php?id=<?= $stage['id'] ?>" class="btn btn-warning">Modifier</a>
                    <!-- Bouton pour supprimer -->
                    <a href="delete_stage.php?id=<?= $stage['id'] ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Début de la partie "Ajouter une étape" -->
    <div class="card mt-5">
        <div class="card-header">
            Ajouter une étape
        </div>
        <div class="card-body">
            <!-- Formulaire pour ajouter une étape -->
            <form action="add_travel_stage.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'étape</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
    <!-- Fin de la partie "Ajouter une étape" -->
</body>
</html>

