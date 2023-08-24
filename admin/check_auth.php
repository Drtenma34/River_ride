

<?php 


 if (!isset($_SESSION['admin_id'])) {
    // L'admin n'est pas connecté, rediriger vers la page de connexion
    header('Location: co_admin.php');
    exit; // Terminer l'exécution du script pour éviter que le reste de la page soit chargé
}

?>