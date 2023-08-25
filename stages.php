<?php 
    include("includes/db.php");


    $q = $bdd -> prepare("SELECT DISTINCT nom FROM travel_stages");

    $q -> execute([]);

    $data = $q -> fetchAll(PDO::FETCH_ASSOC);




?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/head.php");
?>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
  }

  .section {
    background-color: white;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .read-more-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
</style>
<title>Page avec Rubriques</title>
</head>

<?php include("includes/header_menu.php"); ?>
<body>


  <?php
    foreach($data as $value){
  
    echo '
    <div class="section">
      <h2> '. $value['nom'] .'</h2>
      <p>Contenu de la rubrique...</p>
      <button class="read-more-btn"><a href = "stage_info.php?inf='. $value['nom'] . '">En savoir plus </a></button>
    </div>
    
    
    ';

    }
  ?>

  </div>
</body>
</html>
