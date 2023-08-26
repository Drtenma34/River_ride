<!DOCTYPE html>
<html>
<head>
    <title>Edition d'étape</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}


include("includes/db.php");

// Vérifiez si l'ID de l'étape est passé dans l'URL
if (!isset($_GET['id'])) {
    die("ID de l'étape manquant!");
}

$stageId = $_GET['id'];

// Récupérer les détails de l'étape depuis la BDD
$q = 'SELECT * FROM travel_stages WHERE id = ?';
$req = $bdd->prepare($q);
$req->execute([$stageId]);
$stage = $req->fetch();

if (!$stage) {
    die("Étape non trouvée!");
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $photo = $_FILES['photo'];
    $description = $_POST['description'];
    $description_activite = $_POST['description_activite'];

    $photoName = $stage['photo']; // Par défaut, conservez l'ancienne photo

    // Si une nouvelle photo est téléchargée
    if ($photo['error'] == 0) {
        $originalName = pathinfo($photo['name'], PATHINFO_FILENAME);
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $photoName = 'images_stages/' . uniqid($originalName . '_') . '.' . $extension;
        move_uploaded_file($photo['tmp_name'], $photoName);

        // Optionnel : supprimer l'ancienne photo (si vous le souhaitez)
        if (file_exists($stage['photo'])) {
            unlink($stage['photo']);
        }
    }

    // Mettre à jour la base de données
    $q = 'UPDATE travel_stages SET nom = ?, description = ?, photo = ?, description_activite = ? WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute([$nom, $description, $photoName, $description_activite, $stageId]);

    // Redirection vers le back office après la mise à jour
    header('Location: manage_stages.php');
    exit;
}

include 'header_back_office.php';
?>

<h2>Modifier l'étape : <?= $stage['nom'] ?></h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'étape</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $stage['nom'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description de l'étape</label>
        <textarea class="form-control" id="description" name="description" rows="5"><?= $stage['description'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="description_activite" class="form-label">Description des activités</label>
        <textarea class="form-control" id="description_activite" name="description_activite" rows="5"><?= $stage['description_activite'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo actuelle</label><br>
        <img src="<?= $stage['photo'] ?>" alt="<?= $stage['nom'] ?>" width="200"><br><br>
        <label for="photo" class="form-label">Changer la photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>


