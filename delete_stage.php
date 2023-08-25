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

// Supprimer d'abord tous les logements associés à cette étape
$q = 'DELETE FROM accommodations WHERE travel_stage_id = ?';
$req = $bdd->prepare($q);
$req->execute([$stageId]);

// Ensuite, supprimez l'étape elle-même
$q = 'DELETE FROM travel_stages WHERE id = ?';
$req = $bdd->prepare($q);
$req->execute([$stageId]);

// Redirection vers le back office après la suppression
header('Location: manage_stages.php');
exit;

