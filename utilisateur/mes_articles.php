
<?php 
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mes article</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/css_projet.css">
</head>
<body>

<button onclick="window.location.href='nouvel_article.php'"> Nouvel article</button>
	<?php 
$req=$bdd -> query('SELECT * FROM article');
while($results =$req-> fetch()){
	?>
<div class="border border-secondary border-2">
	<h5><?=$results['title']; ?></h5>
	 <P><?= $results['time_creation'] ?></p><br>
	<p><?=$results['content']; ?></p>
	<button class="btn btn-danger" onclick="window.location.href='supprimer_article.php?id='">Supprimer</button>
	<button class="btn btn-info"onclick="window.location.href='Modifier_article.php?id='">Modifier</button> 
</div>
	<?php
}
?>
</body>
</html>