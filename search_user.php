<?php

include('includes/db.php');

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $stmt = $bdd->prepare("SELECT * FROM users WHERE nom LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        echo "<ul class='list-group'>";
        foreach ($users as $user) {
            echo "<li class='list-group-item'>";
            echo "ID: " . $user['id'] .
                " - Nom: " . $user['nom'] .
                " - Prénom: " . $user['prenom'] .
                " - Numéro de téléphone: " . $user['phone'] .
                " - Email: " . $user['email'] .
                " - Est banni? " . ($user['is_banned'] ? 'Oui' : 'Non');
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='text-muted'>Aucun utilisateur trouvé</p>";
    }
}
?>


