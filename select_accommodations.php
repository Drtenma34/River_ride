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
        /* ... [Existing styles] ... */

        .date-input {
            margin-top: 10px;
        }
    </style>
    <script>
    window.onload = function() {
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.setAttribute('min', today);
        });
    };
</script>

</head>

<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <h2>Hébergements disponibles</h2>

        <form action="select_services.php" method="post">
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

                    echo '<div class="date-input">';
                    echo '<label>De: <input type="date" name="dates[' . $accommodation['id'] . '][from]"></label>';
                    echo '<label>À: <input type="date" name="dates[' . $accommodation['id'] . '][to]"></label>';
                    echo '<label><input type="checkbox" name="selected_hotels[]" value="' . $accommodation['id'] . '"> Sélectionner</label>';
                    echo '</div>';

                    echo '</div>';
                }

                echo '</div>';  // End of card-container
            }

            echo '<div style="text-align: center; margin-top: 20px;">';
            echo '<input type="submit" value="Continuer avec les dates sélectionnées">';
            echo '</div>';
            ?>
        </form>

    </main>
    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
