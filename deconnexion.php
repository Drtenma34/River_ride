<?php
session_start();

// Déréférence la session et détruit les données de la session.
$_SESSION = array();
session_destroy();

// Redirige vers la page d'accueil.
header("Location: index.php");
exit;
?>


