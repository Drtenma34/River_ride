<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}


include("includes/db.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $photo = $_FILES['photo'];

    // Traiter l'image (si vous en avez une)
    $photoName = '';
    if ($photo['error'] == 0) {
        $originalName = pathinfo($photo['name'], PATHINFO_FILENAME);
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        // Créer un nom unique pour le fichier
        $photoName = 'images_stages/' . uniqid($originalName . '_') . '.' . $extension;
        move_uploaded_file($photo['tmp_name'], $photoName);
    }

    // Insertion dans la base de données
    $q = 'INSERT INTO travel_stages (nom, photo) VALUES (?, ?)';
    $req = $bdd->prepare($q);
    $req->execute([$nom, $photoName]);

    // Redirection vers le back office après l'ajout
    header('Location: manage_stages.php');
    exit;
}

