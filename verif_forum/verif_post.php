// verif publication post 
<?php 
session_start();
include("database.php");

//if(!empty($_SESSION['user_id'])){
//	$user_id=$_SESSION['user_id'];
	if(isset($_POST['submit'])){

		if (!empty($_POST['content'])) {
		$content =nl2br(htmlspecialchars($_POST['content']));
		$time=date('Y-m-d H-i-s');

		$req= $bdd-> prepare('INSERT INTO post(content, time_post) VALUES (?,?,?)'); 
		$resultats=$req->execute(array($content, $time));

	

		} else {  echo $erreur="veuillez remplir tous les champs"; 
				}
	} 
//} else { echo "Connectez-vous pour écrire votre article";}


?>