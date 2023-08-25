<?php

ob_start();

session_start(); // Démarrer la session

$session_keys = ['email', 'password', 'phone', 'date_de_naissance', 'nom', 'prenom'];

$all_keys_present = true;

foreach ($session_keys as $key) {
    if (!isset($_SESSION[$key])) {
        $all_keys_present = false;
        break;
    }
}

if (!$all_keys_present) {
    echo "Il manque une ou plusieurs clés de session. Voici les données de la session actuelle:<br><pre>";
    print_r($_SESSION);
    echo "</pre>";
    header('location:inscription.php?message= Recommencez l\'inscription ');
    exit; // Ou vous pouvez rediriger ou faire d'autres actions
}


include("../includes/db.php");

if (
    !isset($_SESSION['email']) ||
    !isset($_SESSION['password']) ||
    !isset($_SESSION['phone']) ||
    !isset($_SESSION['date_de_naissance']) ||
    !isset($_SESSION['nom']) ||
    !isset($_SESSION['prenom'])
) {
    // Si les données requises ne sont pas dans la session, redirigez ou arrêtez le script
    die("Les données requises ne sont pas disponibles.");
}

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$phone = $_SESSION['phone'];
$date_de_naissance = $_SESSION['date_de_naissance'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

$key = "";
for ($i = 1; $i < 12; $i++) {
    $key .= mt_rand(0, 9);
}

try {
    $q = 'INSERT INTO users (email, password, phone, date_de_naissance, nom, prenom, confirmed_key) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $req = $bdd->prepare($q);
    $users = $req->execute([$email, $password, $phone, $date_de_naissance, $nom, $prenom, $key]);
} catch (PDOException $e) {
    die("Erreur lors de l'insertion dans la base de données : " . $e->getMessage());
}

include("../includes/phpmailer.php");

if (!isset($_SESSION["email"])) {
    die("Email non fourni.");
}

$destinataire = $_POST["email"];
$objet = "confirmation de compte";
$message = "Bonjour veuillez vérifier votre compte avec ce lien : http://localhost:80/River_ride_GIT/identification_process/verif_mail.php?key=" . $key;

sendmail($message, $objet, $destinataire);


//VERSION APACHE

$objet = "confirmation de compte" ;
$message = "Bonjour veuillez vérifier votre compte avec ce lien : https://riverride-david.fr/identification_process/verif_mail.php?key=" . $key;

$destinataire = $_POST["email"];

sendmail($message, $objet, $destinataire);

//ob_end_flush();  /*Vide la mémoire tampon et arrête le tamponnage de la sortie*/

header('location:connexion.php?message=Compte créé avec succès. Veuillez confirmer votre compte via e-mail.');


session_unset();
session_destroy();

exit;


