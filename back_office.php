<!DOCTYPE html>
<html>
<head>
    <title>BACK OFFICE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php
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
                    <!-- Les boutons pour modifier et supprimer -->
                    <!-- Exemple: <a href="modify.php?id=<?= $stage['id'] ?>">Modifier</a> -->
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulaire pour ajouter une étape -->
    <form action="path_to_your_php_script" method="post" enctype="multipart/form-data">
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

    <h2 class="mt-5">Gestion des logements</h2>
    <!-- Sélection de l'étape pour laquelle gérer les logements -->
    <div class="mb-3">
        <label for="selectEtape" class="form-label">Sélectionnez une étape</label>
        <select class="form-select" id="selectEtape">
            <option value="1">Chambord</option>
            <option value="2">Village 1</option>
            <!-- Autres options des étapes depuis la BDD -->
        </select>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Prix par nuit</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Liste des logements pour l'étape sélectionnée depuis la BDD -->
        </tbody>
    </table>

    <!-- Formulaire pour ajouter un logement -->
    <form action="path_to_your_php_script_for_logements" method="post">
        <div class="mb-3">
            <label for="logementNom" class="form-label">Nom du logement</label>
            <input type="text" class="form-control" id="logementNom" name="logementNom">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix par nuit</label>
            <input type="number" class="form-control" id="prix" name="prix">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
</body>
</html>

