<?php
session_start();
include("database.php");

//if(!empty($_SESSION['user_id'])){
//	$user_id=$_SESSION['user_id'];
if(isset($_GET['id']) && !empty($_GET['id'])){
	$getid= $_GET['id'];
	$req=$bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
	$req->execute(array($getid));

			if($req->rowCount()>0){


				$req= $bdd->prepare('UPDATE utilisateurs SET suspension=0 WHERE id=?');
				$req->execute(array($getid));

				header('location: membres.php');

			} else {
				echo "Aucun utilisateur n'a été trouvé!";
			}

} else {
	echo "L'identifiant de l'utilisateur pas pu être récupéré.";
}


//} else { echo "Veuillez vous connecter à votre compte .;}




 ?>