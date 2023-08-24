<?php
session_start();

include("../includes/db.php");

/* la verification de l'entrée de l'email reste */
if (empty($_POST['email']) ||  empty($_POST['password'])) {
    $message = 'Veuillez remplir tous les champs.';
    header("Location: inscription.php?message=" . urlencode($message));
    exit;
}

/* la verification de l'entrée de l'email reste */

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: inscription.php?message=email invalide.');
    exit;
}

/* la verification de l'entrée de l'email reste */

if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
    header('location: inscription.php?message=le mot de passe doit faire entre 8 et 20 caractères.');
    exit;
}

// Enregistrement des var dans la session fil d'Arianne
$_SESSION['email']= $_POST['email'];
$email = $_POST['email'];
$_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);


// Vérification de l'existence de l'e-mail dans la base de données


$q = 'SELECT id FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$email]);
$results = $req->fetchAll();

if (!empty($results)) {
    header('location:inscription.php?message=Email déjà utilisé');
    exit;
}

header('location:inscription2.php?message=Poursuivez votre inscription.');
exit;
?>
