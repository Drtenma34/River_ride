<?php
session_start();

function writeLogLine($success, $email) {
    $logFile = 'log.txt';
    $timestamp = date('Y-m-d H:i:s');
    $logLine = $timestamp . " - Success: " . ($success ? 'true' : 'false') . " Email: " . $email . PHP_EOL;
    file_put_contents($logFile, $logLine, FILE_APPEND);
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: connexion.php?message=Veuillez remplir tous les champs.");
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    header("Location: connexion.php?message=Le format pour Email est invalide.");
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

include("../includes/db.php");

$query = 'SELECT * FROM users WHERE email = :email';
$req = $bdd -> prepare($query);
$req -> execute(['email' => $email]);
$users = $req->fetchAll();

if (count($users) == 0) {
    header('location: connexion.php?message=Cet email \'n est associé à aucun compte');
    exit;
}

if (!password_verify($password, $users[0]['password'])) {
    header('location: connexion.php?message=Mot de passe incorrect');
    exit;
}

// Vérification si l'utilisateur est banni
if ($users[0]['is_banned'] == 1) {
    header('location: connexion.php?message=Vous avez été banni. Vous ne pouvez pas vous connecter.');
    exit;
}

if ($users[0]['is_valid']!= 1){
    $confirmed_key = $users[0]['confirmed_key'];
    header('location: connexion.php?message=Votre mail n\'est pas confirmé, mail réenvoyé');

    include("includes/phpmailer.php");

    //ENVOI DES MAILS

    $objet = "confirmation de compte" ;
    $message = "Bonjour veuillez vérifier votre compte avec ce lien : http://localhost:80/River_ride_GIT/identification_process/verif_mail.php?key=" . $confirmed_key;

    $destinataire = $_POST["email"];

    sendmail($message, $objet, $destinataire);

//VERSION APACHE

    /*$objet = "confirmation de compte" ;
    $message = "Bonjour veuillez vérifier votre compte avec ce lien : https://riverride-david.fr/identification_process/verif_mail.php?key=" . $confirmed_key;

    $destinataire = $_POST["email"];

    sendmail($message, $objet, $destinataire);*/

    exit;
}

writeLogLine(true, $email);

$_SESSION['email'] = $_POST['email'];
$_SESSION['nom'] = $users[0]['nom'];
$_SESSION['id'] = $users[0]['id'];

if ($users[0]['is_admin'] == 1) {
    $_SESSION['is_admin'] = true;
} else {
    $_SESSION['is_admin'] = false;
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header('Location: ../manage_stages.php'); // Redirige l'administrateur vers la page de back office
    exit;
}

header('location: ../index.php?message=Bonjour' . '  ' . $users[0]['nom'] . ' '. 'd\' id =  ' . $users[0]['id']);

?>


