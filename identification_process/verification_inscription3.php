<?php
session_start();

include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialiser le message d'erreur à null
    $message = null;

    // Vérifier si les champs sont vides
    if (empty($_POST['nom']) || empty($_POST['prenom'])) {
        $message = 'Veuillez remplir tous les champs.';
    }
    // Vérifier le format du nom
    elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nom'])) {
        $message = 'Format du nom invalide. Seuls les lettres et les espaces blancs sont autorisés.';
    }
    // Vérifier le format du prénom
    elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['prenom'])) {
        $message = 'Format du prénom invalide. Seuls les lettres et les espaces blancs sont autorisés.';
    }

    // Si un message d'erreur est défini, rediriger vers la page d'inscription avec le message d'erreur
    if ($message) {
        header("Location: inscription2.php?message=" . urlencode($message));
        exit;
    }

    // Stocker les données dans la session
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];

    header('location:inscription_finale.php?message=Inscription réussi, veuillez vous connecter');
    exit;
}
?>