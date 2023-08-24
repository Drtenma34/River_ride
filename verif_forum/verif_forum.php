<?php 
session_start();
include("database.php");?>

<?php

//if(!empty($_SESSION['user_id'])){

	//$user_id=$_SESSION['user_id'];
	if(isset($_POST['submit'])){

		if (!empty($_POST['name']) && !empty($_POST['description'])) {
		$name =nl2br(htmlspecialchars($_POST['name']));
		$description =nl2br(htmlspecialchars($_POST['description']));
		$time=date('Y-m-d H-i-s');
		$user=$_SESSION['id'];

		$req= $bdd-> prepare('INSERT INTO forum(name, description, creation_date, ) VALUES (?,?,?)'); 
		$resultats=$req->execute(array($name, $description, $time));

		} else {  echo $erreur="veuillez remplir tous les champs"; 
				}
	}			
	
//} else { echo "Connectez-vous pour créer un forum";}


?>