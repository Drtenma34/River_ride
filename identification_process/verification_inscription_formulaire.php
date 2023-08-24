<?php
session_start();

include("includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['naissance'])) {
        $message = 'Veuillez remplir tous les champs.';
        header("Location: inscription2.php?message=" . urlencode($message));
        exit;
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $naissance = date('Y-m-d', strtotime($_POST['naissance']));

    $q = 'INSERT INTO users (nom, prenom, naissance) VALUES (:nom, :prenom, :naissance)';
    $req = $bdd->prepare($q);

    $results = $req->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'naissance' => $naissance,
       
    ]);

    header('location: inscription3.php?message=Étape 2 créée avec succès.');
    exit;
}
?>
