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
    $adresse = $_POST['adresse'];
    $price_per_night = $_POST['price_per_night'];
    $max_pers = $_POST['max_pers'];
    $travel_stage_id = $_POST['travel_stage_id'];  // Vous devez avoir un champ pour sélectionner l'étape de voyage associée

    // Traiter l'image (si vous en avez une)
    $photoName = '';
    if ($photo['error'] == 0) {
        $originalName = pathinfo($photo['name'], PATHINFO_FILENAME);
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        // Créer un nom unique pour le fichier
        $photoName = 'images_accommodations/' . uniqid($originalName . '_') . '.' . $extension;  // Assurez-vous que le dossier 'images_accommodations' existe
        move_uploaded_file($photo['tmp_name'], $photoName);
    }

    // Insertion dans la base de données
    $q = 'INSERT INTO accommodations (nom, adress, photo, price_per_night, max_pers, travel_stage_id) VALUES (?, ?, ?, ?, ?, ?)';
    $req = $bdd->prepare($q);
    $req->execute([$nom, $adresse, $photoName, $price_per_night, $max_pers, $travel_stage_id]);

    // Redirection vers la page de gestion des logements après l'ajout
    header('Location: manage_accommodations.php');
    exit;
}
?>
