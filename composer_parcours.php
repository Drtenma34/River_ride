<?php
include("includes/db.php");  // Assurez-vous que le fichier `db.php` initialise une connexion PDO et non MySQLi

try {
    $stmt = $bdd->prepare("SELECT * FROM travel_stages");
    $stmt->execute();

    $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection des étapes</title>
    <?php include("includes/head.php"); ?>
    <style>
        /* Styles améliorés */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform .2s;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            width: 220px;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
        }

        img.card-img-top {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.5em;
            margin: 10px 0;
        }

        .card-text {
            margin-bottom: 20px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <form action="select_accommodations.php" method="post" class="card-container">
            <?php
            foreach ($stages as $row) {
                echo '<div class="card">';
                echo '<img class="card-img-top" src="' . $row['photo'] . '" alt="' . $row['nom'] . '">';
                echo '<h3 class="card-title">' . $row['nom'] . '</h3>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '<label><input type="checkbox" name="selected_stages[]" value="' . $row['id'] . '"> Sélectionner</label>';
                echo '</div>';
            }
            ?>
            <div style="width: 100%; text-align: center;">
                <input type="submit" value="Continuer">
            </div>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
