<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: identification_process/connexion.php');
    exit;
}

include('includes/db.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'bannir') {
        $q = 'UPDATE users SET is_banned = 1 WHERE id = ?';
    } else {
        $q = 'UPDATE users SET is_banned = 0 WHERE id = ?';
    }

    $req = $bdd->prepare($q);
    $req->execute(array($id));
}

header('Location: manage_users.php');
exit;

?>
</body>
</html>


