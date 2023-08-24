<!DOCTYPE html>
<html>

<head>
    <title>Inscription3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/inscription_et_connexion.css">

    <style>
        <?php include("../css/inscription_et_connexion.css"); ?>
    </style>

</head>

<body>

<?php
include('../includes/header_inscription.php');
?>

<main>
    <?php
    if(isset($_GET['message']) && !empty($_GET['message'])){
    echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
    }

    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        // Vérifiez les informations ici
    }
    ?>

    <div class="container justify-content-center rounded div_bordure">
        <div class="row div_connexion w-100 align-items-center justify-content-center bg-light">
            <div class="col-sm-4">
                <img src="../images/inscription.png" alt="Image d'inscription" class="img_inscription" width="360px" height="600px">
            </div>
            <div class="col-sm-4 div_connexion flex-column">
                <h1 class="text-black">Bonjour !</h1>

                <form action="verification_inscription3.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nom" class="form-control mt-2 mb-2" placeholder="Votre nom" required>
                    <input type="text" name="prenom" class="form-control mt-2 mb-2" placeholder="Votre prénom" required>

                    <input type="submit" name="submit" class="btn btn-primary mt-4" value="Continuer">
                </form>

                <p style="color: black;">Compte existant? <strong><a href="connexion.php">Se connecter</a></strong></p>

            </div>
        </div>
    </div>

</main>

</body>

</html>