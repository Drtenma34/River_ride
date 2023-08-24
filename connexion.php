
<?php $title = "Page de connexion";
include("includes/head.php")
?>
<style>
  <?php include("css/Anime.css"); ?>
</style>

<?php
include('includes/header_david.php');
?>


<body >
<div>
  
</div>
    <main>


     <!--Affichage dans l'Alert en JAVASCRIPT-->

      <script src="js/alert_message.js"></script>

      <?php

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $password = $_POST['password'];
   // Vérifiez les informations de connexion ici
}
?>

<div class="container justify-content-center rounded div_bordure">
  <div class="row div_connexion w-100   align-items-center justify-content-center bg-light " >
      <div class="col-sm-4">
    <img src="image anime/connexion.png" alt="Image de connexion" class="img_connexion" width="360px" height="600px">
    </div>
    <div class="col-sm-4 div_connexion flex-column">
      <h1 class = "text-black">Bonjour !</h1>
      

      <form action="verification_connexion.php" method="POST">
    
      <input type="email" name="email" class="form-control mt-6 mb-3 " placeholder="Email">
      <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe">

      <input type="submit" class="btn btn-primary mt-4">

    </form>

      <p style="color: black;">Vous n'avez pas de compte? <strong><a href="captcha/index.php">Inscrivez-vous!</a></strong></p>
      <p>  <strong><a href="mdp_oublie/formulaire_mdp.php"> Mot de passe oublié ?</a></strong></p>

    </main>
    </body>
</html>

