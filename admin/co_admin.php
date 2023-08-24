<?php 
session_start();
include("database.php");

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>connexion admin</title>
</head>


<body>

	<h1> Bienvenue </h1>
<form method="POST" action="verif_co_admin.php">
	
<input type="text" name="identifiant"><br>
<input type="password" name="password"><br>
<input type="submit" name="submit" value="se connecter">



</form>
</body>
</html>