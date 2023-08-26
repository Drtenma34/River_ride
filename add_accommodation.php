<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("includes/db.php");

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}

function validateFormData($data)
{
    $errors = [];

    if (empty($data['nom'])) {
        $errors[] = "Le nom du logement est requis.";
    }

    if (empty($data['adresse'])) {
        $errors[] = "L'adresse est requise.";
    }

    if (empty($data['max_pers']) || $data['max_pers'] <= 0) {
        $errors[] = "Le nombre maximum de personnes doit être un nombre positif.";
    }

    if (empty($data['price_per_night']) || $data['price_per_night'] <= 0) {
        $errors[] = "Le prix par nuit doit être un nombre positif.";
    }

    return $errors;
}

$errors = validateFormData($_POST);

if (empty($errors)) {
    // Upload de l'image (si elle est fournie)
    $photo_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $photo_path = $upload_dir . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
    }

    // Insertion dans la BDD
    $q_insert = 'INSERT INTO accommodations (nom, adresse, max_pers, price_per_night, photo, travel_stage_id) VALUES (?, ?, ?, ?, ?, ?)';
    $req_insert = $bdd->prepare($q_insert);
    $req_insert->execute([
        $_POST['nom'],
        $_POST['adresse'],
        $_POST['max_pers'],
        $_POST['price_per_night'],
        $photo_path,
        $_POST['travel_stage_id']
    ]);

    // Redirection vers la page de gestion des logements avec un message de succès
    $_SESSION['success'] = "Logement ajouté avec succès !";
    header('Location: manage_accommodations.php');
    exit;
} else {
    // Si des erreurs sont trouvées, stockez-les dans la session et redirigez vers manage_accommodations.php pour les afficher
    $_SESSION['errors'] = $errors;
    header('Location: manage_accommodations.php');
    exit;
}
