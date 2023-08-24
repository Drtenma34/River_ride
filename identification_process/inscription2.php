<!DOCTYPE html>
<html>
<head>
  <title>Page d'accueil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="../css/inscription_et_connexion.css">

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</head>
<header>
  <nav class="navbar navbar-expand-lg bg-pink pt-0">
    <div class="container ps-0">
      <img src="image anime/pika.gif" alt="Logo" style="width:200px; height: 150px;">
    </div>
      
  <div class="container mt-4">
    <ul class="nav nav-pills d-flex justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="connexion.php">Se connecter</a>
      </li>      
      <li><a class="nav-link" href="../index.php">Accueil</a></li>
      </li>
    </ul>
    </div>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Rechercher">
      <button class="btn btn-primary" type="button">Rechercher</button>
    </div>
</header>
<body >
<div>
  
</div>
    <main>
        
        <?php

            if(isset($_GET['message']) && !empty($_GET['message'])){
                echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
            }
   ?>
   <?php
if(isset($_POST['submit'])){
   $nom = $_POST['nom'];
   $prenom = $_POST['prenom'];
   $naissance = $_POST['naissance'];
}
?>

   <div class="container justify-content-center rounded div_bordure">
  <div class="row div_connexion w-100   align-items-center justify-content-center bg-light " >
      <div class="col-sm-4">
    <img src="image anime/connexion.png" alt="Image de connexion" class="img_connexion" width="360px" height="600px">
    </div>
    <div class="col-sm-4 div_connexion flex-column">
      <h1 class = "text-black">Bonjour !</h1>
      

<form action="verification_inscription_formulaire.php" method="POST" enctype="multipart/form-data">
<input type="nom" name="nom" class="form-control mt-6 mb-3" placeholder="Quel est votre Nom?" value="<?= (isset($_COOKIE['nom']) ? $_COOKIE['nom'] : '') ?>">
<input type="prenom" name="prenom" class="form-control mt-6 mb-3" placeholder="Quel est votre Prénom?" value="<?= (isset($_COOKIE['prenom']) ? $_COOKIE['prenom'] : '') ?>">
<input type="naissance" name="naissance" placeholder=" Date / Mois / Année " value="<?php echo date('d/m/Y'); ?>" />
<input type="submit" class="btn btn-primary mt-4"><a href="inscription3.php" class = "text-white"></a>
</form>
    </main>

    </body>
</html>
