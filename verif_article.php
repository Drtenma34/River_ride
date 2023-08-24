<?php 
session_start();
include("database.php");

//if(!empty($_SESSION['user_id'])){
//	$user_id=$_SESSION['user_id'];
	if(isset($_POST['submit'])){

		if (!empty($_POST['title']) && !empty($_POST['content'])) {
		$title= htmlspecialchars($_POST['title']);
		$content =nl2br(htmlspecialchars($_POST['content']));
		date_default_timezone_set('Europe/Paris');
		$time=date('Y-m-d H-i-s');

		$req= $bdd-> prepare('INSERT INTO article(title, content, time_creation) VALUES (?,?,?)'); 
		$resultats=$req->execute(array($title,$content, $time));

		echo" Votre acticle a été publié avec succès ";

		header('location:page_utilisateur.php');
		exit();

	

		} else {  
			$erreur = "Veuillez remplir tous les champs.";
			$title_w =$_POST['title'];
			$content_w =$_POST['content'];

    header('location: nouvel_article.php?erreur=' . urlencode($erreur));
    echo $erreur;

    exit();
				}
	} 
//} else { echo "Veuillez vous connecter  à votre compte .;}


?>