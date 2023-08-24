<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/inscription_et_connexion.css">

</head>

<style>
  <?php include("../css/inscription_et_connexion.css"); ?>
</style>

<body>
<?php
include('../includes/header_inscription.php');
?>
<main>

  <?php

  if(isset($_GET['message']) && !empty($_GET['message'])){
    echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
  }
  if(isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $date_de_naissance = $_POST['date_de_naissance'];
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

        <form action="verification_inscription2.php" method="POST" enctype="multipart/form-data">
          <input type="tel" name="phone" class="form-control mt-6 mb-3" placeholder="Votre numéro de téléphone">
          <input type="date" name="date_de_naissance" class="form-control mt-6 mb-3" placeholder="Votre date de naissance">
          <input type="submit" class="btn btn-primary mt-4" value="Continuer">
        </form>

        <p style="color: black;">Compte existant? <strong><a href="connexion.php">Se connecter</a></strong></p>

      </div>
    </div>
  </div>

</main>

</body>
</html>
