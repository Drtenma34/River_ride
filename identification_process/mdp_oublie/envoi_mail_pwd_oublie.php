<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

ob_start(); // Ajout de cette ligne pour démarrer la mise en mémoire tampon et ne pas afficher l'output de sendmail.


if (empty($_POST['email'])) {
    header("location: formulaire_mdp.php?message=Erreur, veuillez remplir le champ&type=fail");
    exit; // Ajout d'une instruction exit pour arrêter l'exécution du script après la redirection
}

//include("../includes/db.php");
include("../../includes/phpmailer.php");

include("../../includes/db.php");

$q = $bdd->prepare("SELECT confirmed_key FROM users WHERE email=?");
$q->execute([$_POST['email']]);
$q = $q->fetchAll();

if (count($q) > 0) {
    $confirmed_key = $q[0]['confirmed_key'];
    //var_dump($confirmed_key);

    $message = "Bonjour, veuillez changer votre mot de passe en utilisant ce lien : http://localhost:80/River_ride_GIT/identification_process/mdp_oublie/verif_pwd.php?key=" . $confirmed_key;

    $objet = "Changement de mot de passe River Ride";
    $destinataire = $_POST['email'];

    sendmail($message, $objet, $destinataire);

    // Serveur Apache (envoie 2 mails un pour local host et un pour le serveur Apache )

    $message = "Bonjour, veuillez changer votre mot de passe en utilisant ce lien : https://riverride-david.fr/identification_process/mdp_oublie/verif_pwd.php?key=" . $confirmed_key;
    /*http://anisite.fr/mdp_oublie/verif_pwd.php?key=" . $confirmed_key;*/

    $objet = "Changement de mot de passe River Ride";
    $destinataire = $_POST['email'];

    sendmail($message, $objet, $destinataire);


    header("location: ../connexion.php?message=Un email a été envoyé pour réinitialiser votre mot de passe");
    exit;
} else {
    header("location: formulaire_mdp.php?message=Adresse email non trouvée&type=fail");
    exit;
}


ob_end_flush();  /*Vide la mémoire tampon et arrête le tamponnage de la sortie*/

?>


