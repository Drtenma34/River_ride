<?php
session_start();

include("includes/db.php");

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}

// Récupération des étapes depuis la BDD
$q_stages = 'SELECT * FROM travel_stages';
$req_stages = $bdd->prepare($q_stages);
$req_stages->execute();
$stages = $req_stages->fetchAll(PDO::FETCH_ASSOC);

// Récupération des logements pour l'étape sélectionnée
$selected_stage = $_POST['selected_stage'] ?? $stages[0]['id'];  // Par défaut, la première étape est sélectionnée
$q_accommodations = 'SELECT * FROM accommodations WHERE travel_stage_id = ?';
$req_accommodations = $bdd->prepare($q_accommodations);
$req_accommodations->execute([$selected_stage]);
$accommodations = $req_accommodations->fetchAll(PDO::FETCH_ASSOC);


// Pour chaque logement, calculez le nombre de places disponibles
foreach ($accommodations as $key => $accommodation) {
    $q_reservations = 'SELECT COUNT(*) as total_reservations FROM accommodation_reservations WHERE accommodation_id = ?';
    $req_reservations = $bdd->prepare($q_reservations);
    $req_reservations->execute([$accommodation['id']]);
    $reservation = $req_reservations->fetch(PDO::FETCH_ASSOC);
    $accommodations[$key]['available_places'] = $accommodation['max_pers'] - $reservation['total_reservations'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des logements - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php include 'header_back_office.php'; ?>

<body>
<div class="container mt-5">
    <h2>Gestion des logements</h2>

    <!-- Sélection de l'étape pour laquelle gérer les logements -->
    <div class="mb-3">
        <label for="selectEtape" class="form-label">Sélectionnez une étape</label>
        <select class="form-select" id="selectEtape" name="selected_stage" onchange="this.form.submit()">
            <?php foreach($stages as $stage): ?>
                <option value="<?= $stage['id'] ?>" <?= ($selected_stage == $stage['id']) ? 'selected' : '' ?>><?= $stage['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Liste des logements avec options pour "Gérer" et "Supprimer" -->
    <table class="table mt-5">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Prix par nuit</th>
            <th>Places disponibles</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $accommodationNumber = 1;

        foreach($accommodations as $accommodation): ?>
            <tr>
                <td><?= $accommodationNumber ?></td>
                <td><?= $accommodation['nom'] ?></td>
                <td><?= $accommodation['adresse'] ?></td> <!-- Ligne corrigée -->
                <td><?= $accommodation['price_per_night'] ?>€</td>
                <td><?= $accommodation['available_places'] ?>/<?= $accommodation['max_pers'] ?></td>
                <td>
                    <a href="edit_accommodation.php?id=<?= $accommodation['id'] ?>" class="btn btn-warning">Gérer</a>
                    <a href="delete_accommodation.php?id=<?= $accommodation['id'] ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
            <?php $accommodationNumber++;?>
        <?php endforeach; ?>
        </tbody>
    </table>


    <?php
    //fonction pour valider les données du formulaire
    function validateFormData($data) {
        $errors = [];

        // Vérifiez le nom du logement
        if (empty($data['nom'])) {
            $errors[] = "Le nom du logement est requis.";
        }

        // Vérifiez l'adresse
        if (empty($data['adresse'])) {
            $errors[] = "L'adresse est requise.";
        }

        // ... Ajoutez d'autres vérifications ici ...

        return $errors;
    }

    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = validateFormData($_POST);
        if (empty($errors)) {
            // Si tout est valide, redirigez vers add_accommodation.php pour l'insertion dans la base de données
            header('Location: add_accommodation.php');
            exit;
        }
    }

    // Dans votre code HTML :
    if (!empty($errors)) {
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
    ?>

    <!-- Début de la partie "Ajouter un logement" -->
    <div class="card mt-5">
        <div class="card-header">
            Ajouter un logement
        </div>
        <div class="card-body">
            <!-- Formulaire pour ajouter un logement -->
            <form action="add_accommodation.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du logement</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="mb-3">
                    <label for="max_pers" class="form-label">Nombre maximum de personnes</label>
                    <input type="number" class="form-control" id="max_pers" name="max_pers" required>
                </div>
                <div class="mb-3">
                    <label for="price_per_night" class="form-label">Prix par nuit (€)</label>
                    <input type="number" class="form-control" id="price_per_night" name="price_per_night" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo du logement</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>

                <div class="mb-3">
                    <label for="selectEtape" class="form-label">Étape associée</label>
                    <select class="form-select" id="selectEtape" name="travel_stage_id">
                        <?php foreach($stages as $stage): ?>
                            <option value="<?= $stage['id'] ?>"><?= $stage['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter le logement</button>
            </form>
        </div>
    </div>
    <!-- Fin de la partie "Ajouter un logement" -->


    <script>
        document.getElementById('selectEtape').addEventListener('change', function() {
            let stageId = this.value;

            fetch(`get_accommodations.php?stage_id=${stageId}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.querySelector('table tbody');
                    tableBody.innerHTML = ''; // vider le tableau actuel

                    // Initialisation de la variable pour compter les hébergements
                    let accommodationNumber = 1;

                    data.forEach(accommodation => {
                        let row = `
                    <tr>
                        <!-- Affichage du numéro d'ordre du hébergement -->
                        <td>${accommodationNumber}</td>
                        <td>${accommodation.nom}</td>
                        <td>${accommodation.adresse}</td>
                        <td>${accommodation.price_per_night}€</td>
                        <td>${accommodation.available_places}/${accommodation.max_pers}</td>
                        <td>
                            <a href="edit_accommodation.php?id=${accommodation.id}" class="btn btn-warning">Gérer</a>
                            <a href="delete_accommodation.php?id=${accommodation.id}" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                `;

                        tableBody.innerHTML += row;

                        // Augmentation de la variable pour le prochain hébergement
                        accommodationNumber++;
                    });
                });
        });

    </script>
