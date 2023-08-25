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

if ($users[0]['is_valid']!= 1){
    $confirmed_key = $users[0]['confirmed_key'];
    header('location: connexion.php?message=Votre mail n\'est pas confirmé, mail réenvoyé');

    include("includes/phpmailer.php");

    //ENVOI DES MAILS


    $objet = "confirmation de compte" ;
    $message = "Bonjour veuillez vérifier votre compte avec ce lien : http://localhost:8888/Projet_Annuel_GIT/verif_mail.php?key=" . $confirmed_key;
    $destinataire = $_POST["email"];

    sendmail($message, $objet, $destinataire);

//VERSION APACHE

    $objet = "confirmation de compte" ;
    $message = "Bonjour veuillez vérifier votre compte avec ce lien : http://anisite.fr/verif_mail.php?key=" . $confirmed_key;
    $destinataire = $_POST["email"];

    sendmail($message, $objet, $destinataire);

    exit;
}

writeLogLine(true, $email);

$_SESSION['email'] = $_POST['email'];
$_SESSION['nom'] = $users[0]['nom'];
$_SESSION['id'] = $users[0]['id'];

header('location: ../index.php?message=Bonjour' . '  ' . $users[0]['nom'] . ' '. 'd\' id =  ' . $users[0]['id']);

?>









/*CODE DE AISSE*/


<!--
-->
/*session_start();
<<<<<<< Updated upstream

function writeLogLine($success, $email) {
    $logFile = 'log.txt';
    $timestamp = date('Y-m-d H:i:s');
    $logLine = $timestamp . " - Success: " . ($success ? 'true' : 'false') . " Email: " . $email . PHP_EOL;
    file_put_contents($logFile, $logLine, FILE_APPEND);
}

if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 3600);
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    $message = 'Veuillez remplir tous les champs.';
    header("Location: connexion.php?message=" . urlencode($message));
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $message = 'Adresse e-mail invalide.';
    header("Location: connexion.php?message=" . urlencode($message));
    exit;
}

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "Projet";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);



if ($result->num_rows == 0) {
    $message = 'Identifiants invalides. Veuillez vérifier votre email et votre mot de passe.';
    header("Location: connexion.php?message=" . urlencode($message));
    exit;
}

$row = $result->fetch_assoc();

if (hash('sha256', $password) !== $row['password']) {
    $message = 'Identifiants invalides. Veuillez vérifier votre email et votre mot de passe.';
    header("Location: connexion.php?message=" . urlencode($message));
    exit;
}


writeLogLine(true, $email);

$_SESSION['email'] = $email;

header('Location: profil.php');
exit;
?>*/


