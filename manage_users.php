<!DOCTYPE html>
<html>
<head>
    <title>Gestion des étapes - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        #searchResults {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>

</head>

<?php include 'header_back_office.php'; ?>

<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Si l'utilisateur n'est pas un admin, il est redirigé vers la page de connexion
    header('Location: identification_process/connexion.php');
    exit;
}

        include('includes/db.php');

        $q = 'SELECT nom, prenom, id, phone, email, is_banned FROM users';

        $req = $bdd->prepare($q);
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>

<input type="text" id="searchBar" placeholder="Recherche..." class="form-control mb-3">
<div id="searchResults"></div>

        <?php
        if (count($users) > 0) {
            echo '<table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro de tel</th>
                        <th>email</th>
                        <th>Actions</th>
                    </tr>';


            foreach ($users as $index => $user) {
                $action = ($user['is_banned'] == 1) ? 'Débannir' : 'Bannir';
                $actionClass = ($user['is_banned'] == 1) ? 'btn-success' : 'btn-warning';

                echo '<tr>
            <td>' . $user['id'] . '</td>
            <td>' . $user['nom'] . '</td>
            <td>' . $user['prenom'] . '</td>
            <td>' . $user['phone'] . '</td>
            <td>' . $user['email'] . '</td>
            <td>
                <a class="btn btn-primary btn-sm" href="modifier_users.php?id=' . $user['id'] . '">Modifier</a>
                <a class="btn btn-danger btn-sm" href="supprimer.php?id=' . $user['id'] . '">Supprimer</a>
                <a class="btn ' . $actionClass . ' btn-sm" href="ban_unban.php?id=' . $user['id'] . '&action=' . strtolower($action) . '">' . $action . '</a>
            </td>
          </tr>';
            }
        }

echo '</table>';
if (empty($users)) {
    echo '<p>Aucun utilisateur trouvé.</p>';
}
?>

<script>
    document.getElementById('searchBar').addEventListener('keyup', function() {//lorsqu'une touche est relâchée
        let query = this.value;

        if (query.length > 2) {
            fetch('search_user.php', {
                method: 'POST',
                body: new URLSearchParams('query=' + query), // On construit le corps de la requête
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'        // On définit l'en-tête de la requête pour informer le serveur que les données sont encodées comme un formulair
                }
            })
                .then(response => response.text())        // Une fois la requête est effectuée, on traite la réponse comme du texte
                .then(data => {
                    document.getElementById('searchResults').innerHTML = data;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        } else {    // Si la longueur de la requête est de 2 caractères ou moinsle contenu de 'searchResults est vidé
            document.getElementById('searchResults').innerHTML = '';
        }
    });
</script>

</body>
</html>

