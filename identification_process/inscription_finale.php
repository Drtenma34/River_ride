<?php
ob_start(); // Ajout de cette ligne pour démarrer la mise en mémoire tampon et ne pas afficher l'output de sendmail

include("../includes/db.php");

/*Enregistrement dans la bdd se fait à la fin du fil d'Arianne donc dans verification_inscription3.php*/

$_SESSION['email'] = $_POST['email'];
$_SESSION['pseudo'] = $_POST['pseudo'];

$


$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$key=""; //Création de la clé aléatoire à mettre das le fichier inscription finale
for($i=1; $i<12; $i++){
    $key=$key.mt_rand(0,9);
}

$q = 'INSERT INTO users (email, password, phone, date_de_naissance, nom, prenom, confirmed_key) VALUES (?, ?, ?, ?, ?, ?, ?)';
$req = $bdd->prepare($q);

$users = $req->execute([$email, $password, $phone, $date_de_naissance, $nom, $prenom, $key]);

//Fin création de la clé

//ENVOI DES MAILS à mettre dans le fichier inscription finale
include("includes/phpmailer.php");

$objet = "confirmation de compte" ;
$message = "Bonjour veuillez vérifier votre compte avec ce lien : http://localhost:8888/Projet_Annuel_GIT/verif_mail.php?key=" . $key;
$destinataire = $_POST["email"];

sendmail($message, $objet, $destinataire);

//VERSION APACHE

$objet = "confirmation de compte" ;
$message = "Bonjour veuillez vérifier votre compte avec ce lien : http://anisite.fr/verif_mail.php?key=" . $key;
$destinataire = $_POST["email"];

sendmail($message, $objet, $destinataire);

//ob_end_flush();  /*Vide la mémoire tampon et arrête le tamponnage de la sortie*/

header('location:connexion.php?message=Compte créé avec succès. Veuillez confirmer votre compte via e-mail.');

//Je détruis ma session et mes données stockées pour le fil d'Arianne

session_unset();
session_destroy();
exit;
}
?>
