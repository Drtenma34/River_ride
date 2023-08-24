<?php
// Connexion à la base de données
try{
	$bdd = new PDO('mysql:host=5.196.27.192;dbname=riverride', 'root', 'todomundo34river', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e){
	die('Erreur : ' . $e->getMessage());
}
?>

