<?php

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    $userId = null;
}
include("includes/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>RIVER RIDE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">
    <!--<script src="js/alert_message.js"></script>-->
</head>
<body>

<?php include('includes/header_menu.php');

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
header('Location: back_office.php'); // Redirige l'administrateur vers la page de back office
exit;
}
?>

<main class="center-content mt-5">
    <div class="container mt-5">
        <h2 class="big-title">Préparez des vacances en kayak sur la Loire inoubliables</h2>
        <div class="row">
            <!-- Portail pour composer son propre parcours -->
            <div class="col-lg-6 col-md-12 mb-4 d-flex">
                <div class="card flex-fill">
                    <img src="images/composer.jpg" class="card-img-top" alt="Composer son propre parcours">
                    <div class="card-body">
                        <h3 class="card-title">Composer son propre parcours</h3>
                        <p class="card-text">Choisissez vos étapes et hébergements pour une durée libre.</p>
                        <a href="composer_parcours.php" class="btn btn-primary">Commencer</a>
                    </div>
                </div>
            </div>
            <!-- Portail pour choisir un pack -->
            <div class="col-lg-6 col-md-12 mb-4 d-flex">
                <div class="card flex-fill">
                    <img src="images/packs.jpg" class="card-img-top" alt="Choisir un pack">
                    <div class="card-body">
                        <h3 class="card-title">Choisir un pack</h3>
                        <p class="card-text">Explorez nos packs préétablis d'étapes et hébergements.</p>
                        <a href="choisir_pack.php" class="btn btn-primary">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="js/navbar.js"></script>
</body>
</html>

