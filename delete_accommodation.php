<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}

include("includes/db.php");

// Vérifiez si l'ID du logement est passé dans l'URL
if (!isset($_GET['id'])) {
    die("ID du logement manquant!");
}

$accommodationId = $_GET['id'];

// Supprimer d'abord toutes les réservations associées à ce logement
$q = 'DELETE FROM accommodation_reservations WHERE accommodation_id = ?';
$req = $bdd->prepare($q);
$req->execute([$accommodationId]);

// Ensuite, supprimez le logement lui-même
$q = 'DELETE FROM accommodations WHERE id = ?';
$req = $bdd->prepare($q);
$req->execute([$accommodationId]);

// Redirection vers la page de gestion des logements après la suppression
header('Location: manage_accommodations.php');
exit;


