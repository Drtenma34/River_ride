<!DOCTYPE html>
<html>
<head>
    <title>Edition du logement</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php

session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: identification_process/connexion.php');
    exit;
}

include("includes/db.php");

// Check if the accommodation ID is passed in the URL
if (!isset($_GET['id'])) {
    die("ID du logement manquant!");
}

$accommodationId = $_GET['id'];

// Fetch accommodation details from the database
$q = 'SELECT * FROM accommodations WHERE id = ?';
$req = $bdd->prepare($q);
$req->execute([$accommodationId]);
$accommodation = $req->fetch();

if (!$accommodation) {
    die("Logement non trouvé!");
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $photo = $_FILES['photo'];
    $description = $_POST['description'];
    $max_pers = $_POST['max_pers'];
    $adresse = $_POST['adresse'];
    $price_per_night = $_POST['price_per_night'];
    $travel_stage_id = $_POST['travel_stage_id'];

    $photoName = $accommodation['photo']; // By default, keep the old photo

    // If a new photo is uploaded
    if ($photo['error'] == 0) {
        $originalName = pathinfo($photo['name'], PATHINFO_FILENAME);
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $photoName = 'images_accommodations/' . uniqid($originalName . '_') . '.' . $extension;
        move_uploaded_file($photo['tmp_name'], $photoName);

        // Optionally delete the old photo (if you want to)
        if (file_exists($accommodation['photo'])) {
            unlink($accommodation['photo']);
        }
    }

    // Update the database
    $q = 'UPDATE accommodations SET nom = ?, description = ?, max_pers = ?, adresse = ?, photo = ?, price_per_night = ?, travel_stage_id = ? WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute([$nom, $description, $max_pers, $adresse, $photoName, $price_per_night, $travel_stage_id, $accommodationId]);

    // Redirect to the back office after the update
    header('Location: manage_accommodations.php');
    exit;
}

include 'header_back_office.php';
?>

<h2>Modifier le logement : <?= $accommodation['nom'] ?></h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom du logement</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $accommodation['nom'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description du logement</label>
        <textarea class="form-control" id="description" name="description" rows="5"><?= $accommodation['description'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="max_pers" class="form-label">Nombre maximum de personnes</label>
        <input type="number" class="form-control" id="max_pers" name="max_pers" value="<?= $accommodation['max_pers'] ?>">
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $accommodation['adresse'] ?>">
    </div>
    <div class="mb-3">
        <label for="price_per_night" class="form-label">Prix par nuit (€)</label>
        <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="<?= $accommodation['price_per_night'] ?>">
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo actuelle</label><br>
        <img src="<?= $accommodation['photo'] ?>" alt="<?= $accommodation['nom'] ?>" width="200"><br><br>
        <label for="photo" class="form-label">Changer la photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <div class="mb-3">
        <label for="travel_stage_id" class="form-label">Étape associée</label>
        <select class="form-select" id="travel_stage_id" name="travel_stage_id">
            <!-- Fetch stages from the database and populate the dropdown -->
            <?php
            $q_stages = 'SELECT * FROM travel_stages';
            $req_stages = $bdd->prepare($q_stages);
            $req_stages->execute();
            $stages = $req_stages->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stages as $stage): ?>
                <option value="<?= $stage['id'] ?>" <?= ($accommodation['travel_stage_id'] == $stage['id']) ? 'selected' : '' ?>><?= $stage['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

