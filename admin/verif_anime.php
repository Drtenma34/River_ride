<?php
include("database.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $saison = $_POST['saison'];
    $annee = $_POST['annee'];
    $synopsis = $_POST['synopsis'];

    if (empty($saison) || empty($annee) || empty($synopsis) || empty($_FILES['image'])) {
        echo 'Tous les champs sont requis.';
        exit;
    }

    // Vérification des fichiers téléchargés
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo 'Une erreur est survenue lors du téléchargement de l\'image.';
        exit;
    }


    $imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    $allowedImageExtensions = array('jpeg', 'jpg');

    if (!in_array($imageExtension, $allowedImageExtensions)) {
        echo 'Extension d\'image invalide. Seules les extensions jpeg et jpg sont autorisées.';
        exit;
    }


    // Déplacer les fichiers vers les répertoires de destination
    $imageDestination = '../images/image_animes/' . $_FILES['image']['name'];
   
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imageDestination)) {
        echo 'Erreur lors du téléchargement de l\'image.';
        exit;
    }

$query = $bdd->prepare("INSERT INTO anime (saison, annee, synopsis, image) VALUES (?, ?, ?, ?)");
$query->execute([$saison, $annee, $synopsis, $_FILES['image']['name']]);

    header('Location: edition.php');
    echo 'L\'animé a bien été ajouté.';
    exit;
}
?>
