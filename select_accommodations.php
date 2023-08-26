<?php
include("includes/db.php");  // Assuming that the file `db.php` initializes a PDO connection

// Fetching selected stages from the POST data
$selected_stages = isset($_POST['selected_stages']) ? $_POST['selected_stages'] : [];

// Fetch the details of selected stages
$stages = [];
if (!empty($selected_stages)) {
    try {
        $placeholders = str_repeat('?,', count($selected_stages) - 1) . '?';
        $stmt = $bdd->prepare("SELECT * FROM travel_stages WHERE id IN ($placeholders)");
        $stmt->execute($selected_stages);
        $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hébergements disponibles</title>
    <?php include("includes/head.php"); ?>
    <style>
        /* Existing CSS styles for the accommodations display */
        .card-img-top {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        /* ... [you might want to add other styles from the previous code or customize as needed] ... */

        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform .2s;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            width: 220px;
            text-align: center;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <h2>Hébergements disponibles</h2>
        <?php
        foreach ($stages as $stage) {
            echo '<h3>Étape: ' . $stage['nom'] . '</h3>';
            echo '<div class="card-container">';

            // Fetching accommodations for this specific stage
            $accommodations = [];
            try {
                $stmt = $bdd->prepare("SELECT * FROM accommodations WHERE travel_stage_id = ?");
                $stmt->execute([$stage['id']]);
                $accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erreur: " . $e->getMessage());
            }

            foreach ($accommodations as $accommodation) {
                echo '<div class="card">';
                echo '<img class="card-img-top" src="' . $accommodation['photo'] . '" alt="' . $accommodation['nom'] . '">';
                echo '<h3 class="card-title">' . $accommodation['nom'] . '</h3>';
                echo '<p>Adresse: ' . $accommodation['adresse'] . '</p>';
                echo '<p>Prix par nuit: ' . $accommodation['price_per_night'] . '€</p>';

                // Form for hotel selection
                echo '<form action="select_services.php" method="post">';
                echo '<input type="hidden" name="selected_hotel" value="' . $accommodation['id'] . '">';
                echo '<input type="submit" value="Sélectionner">';
                echo '</form>';

                echo '</div>';
            }

            echo '</div>';  // End of card-container
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
