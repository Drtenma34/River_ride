<!DOCTYPE html>
<html>
<head>
    <title>BACK OFFICE - Gestion des Points d'Arrêt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Back Office</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5">
    <h2>Gestion des Points d'Arrêt</h2>

    <!-- Formulaire pour ajouter/modifier un point d'arrêt -->
    <form>
        <!-- Champs pour les informations du point d'arrêt -->
        <!-- ... (nom, adresse, etc.) -->
        <button type="submit" class="btn btn-primary">Ajouter/Modifier Point d'Arrêt</button>
    </form>

    <hr>

    <h3>Liste des Points d'Arrêt</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Liste des points d'arrêt depuis la base de données -->
        <!-- Utilisez une boucle pour afficher chaque point d'arrêt -->
        <!-- Pour chaque point d'arrêt, affichez les informations et des boutons pour gérer les logements -->
        <!-- Exemple : -->
        <tr>
            <td>Nom du Point d'Arrêt</td>
            <td>Adresse du Point d'Arrêt</td>
            <td>
                <a href="#" class="btn btn-primary">Modifier</a>
                <a href="#" class="btn btn-danger">Supprimer</a>
                <a href="#" class="btn btn-secondary">Gérer Logements</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>
</body>
</html>
