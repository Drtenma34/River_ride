//récuperation des posts de l'utilisateur dans la page utilisateurs
<?php 
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mes post</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/css_projet.css">
</head>
<body>
	<?php 
$req=$bdd -> query('SELECT * FROM post');;
while($results =$req-> fetch()){
	?>
<div class="border border-secondary border-2">
	<p><?=$results['forum_name']?></p><br>
	 <P><?= $results['time_post'] ?></p><br>
	<p><?=$results['content']; ?></p>
	<button class="btn btn-danger" onclick="window.location.href='supprimer_post.php?id='">Supprimer</button>
	
</div>
	<?php
}
?>
</body>
</html>