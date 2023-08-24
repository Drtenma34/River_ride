<?php
ob_start(); // Ajout de cette ligne pour démarrer la mise en mémoire tampon et ne pas afficher l'output de sendmail

include("includes/db.php");


if (empty($_POST['email']) || empty($_POST['pseudo']) || empty($_POST['password'])) {
    $message = 'Veuillez remplir tous les champs.';
    header("Location: inscription.php?message=" . urlencode($message));
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: inscription.php?message=email invalide.');
    exit;
}

if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
    header('location: inscription.php?message=le mot de passe doit faire entre 8 et 20 caractères.');
    exit;
}

$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Vérification de l'existence de l'e-mail dans la base de données

$q = 'SELECT id FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$email]);
$results = $req->fetchAll();

if (!empty($results)) {
    header('location:inscription2.php?message=Email déjà utilisé');
    exit;
}

$key=""; //Création de la clé aléatoire
for($i=1; $i<12; $i++){
    $key=$key.mt_rand(0,9);
}

$q = 'INSERT INTO users (email, pseudo, password, confirmed_key) VALUES (?, ?, ?, ?)';
$req = $bdd->prepare($q);

$users = $req->execute([$email, $pseudo, $password, $key]);

//Fin création de la clé

//ENVOI DES MAILS
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

header('location:inscription2.php?message=Étape créée avec succès. Veuillez vérifier vos e-mail.');
exit;
?>
