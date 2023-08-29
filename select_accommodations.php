<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hébergements disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <?php include("includes/head.php"); ?>
<<<<<<< Updated upstream
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

=======
>>>>>>> Stashed changes
</head>

<body>
<?php include("includes/header_menu.php"); ?>

<main class="container mt-5">
    <h2 class="mb-4">Hébergements disponibles</h2>
    <form action="select_services.php" method="post">
        <?php

        // Fetching accommodations for this specific stage
        $accommodations = [];
        try {
            $stmt = $bdd->prepare("SELECT * FROM accommodations WHERE travel_stage_id = ?");
            $stmt->execute([$stage['id']]);
            $accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur: " . $e->getMessage());
        }
        
        foreach ($stages as $stage) {
            echo '<section class="mb-4">';
            echo '<h3>Étape: ' . $stage['nom'] . '</h3>';

            $accommodations = [];
            try {
                $stmt = $bdd->prepare("SELECT * FROM accommodations WHERE travel_stage_id = ?");
                $stmt->execute([$stage['id']]);
                $accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Erreur: " . $e->getMessage());
            }

            foreach ($accommodations as $accommodation) {
                echo '<div class="d-flex align-items-center mb-3">';
                echo '<img src="' . $accommodation['photo'] . '" alt="' . $accommodation['nom'] . '" width="100" height="100" class="me-3 rounded-circle">';
                echo '<div>';
                echo '<h4>' . $accommodation['nom'] . '</h4>';
                echo '<p>Adresse: ' . $accommodation['adresse'] . '</p>';
                echo '<p>Prix par nuit: ' . $accommodation['price_per_night'] . '€</p>';

                echo '<div class="date-input">';
                echo '<label class="me-2">De: <input type="date" name="dates[' . $accommodation['id'] . '][from]"></label>';
                echo '<label class="me-2">À: <input type="date" name="dates[' . $accommodation['id'] . '][to]"></label>';
                echo '<label><input type="checkbox" name="selected_hotels[]" value="' . $accommodation['id'] . '"> Sélectionner</label>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
            }
            echo '</section>';
        }
        ?>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Continuer avec les dates sélectionnées</button>
        </div>
    </form>
</main>
<footer class="mt-5 text-center bg-dark text-white py-3">
    <p>&copy; 2023 Tous droits réservés.</p>
</footer>
</body>
</html>
