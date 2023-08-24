<?php
session_start();

include("../includes/db.php");

function isPhoneValid($phone) {
    return preg_match("/^(\+\d{1,3}[- ]?)?\d{10}$/", $phone);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification de la validité des données
    $message = '';
    if (empty($_POST['phone']) || empty($_POST['date_de_naissance'])) {
        $message = 'Veuillez remplir tous les champs.';
    } elseif (!isPhoneValid($_POST['phone'])) {
        $message = 'Format du numéro de téléphone invalide.';
    } elseif (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $_POST['date_de_naissance'])) {
        $message = 'Format de la date de naissance invalide.';
    }

    // Si une erreur est trouvée
    if ($message) {
        header("Location: inscription2.php?message=" . urlencode($message));
        exit;
    }

    // Si tout va bien
    $phone = $_POST['phone'];
    $date_de_naissance = date('Y-m-d', strtotime($_POST['naissance']));

    // Enregistrer les données du formulaire dans la session
    $_SESSION['phone'] = $phone;
    $_SESSION['date_de_naissance'] = $date_de_naissance;


    header('location: inscription3.php?message=Poursuivez votre inscription');
    exit;
}
?>
