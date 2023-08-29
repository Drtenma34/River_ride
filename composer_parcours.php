<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection des étapes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body>

<?php include("includes/header_menu.php"); ?>



<div class="content-wrapper">
    <main class="container mt-5">
    <h2 class="mb-4">Sélection des étapes</h2>
    <form action="select_accommodations.php" method="post">
        <?php

        include ("includes/db.php");

        try {
            $stmt = $bdd->prepare("SELECT * FROM travel_stages");
            $stmt->execute();

            $stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur: " . $e->getMessage());
        }

        foreach ($stages as $row) {
            echo '<section class="mb-4">';
            echo '<div class="d-flex align-items-center">';
            echo '<img src="' . $row['photo'] . '" alt="' . $row['nom'] . '" width="100" height="100" class="me-3 rounded-circle">';
            echo '<div>';
            echo '<h4>' . $row['nom'] . '</h4>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<label class="form-check"><input type="checkbox" class="form-check-input" name="selected_stages[]" value="' . $row['id'] . '"> Sélectionner</label>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
        }
        ?>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Continuer</button>
        </div>
    </form>
</main>

</div>

</body>
</html>
