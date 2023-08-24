<?php
session_start();

include("includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['preference']) || empty($_POST['genre']) || empty($_POST['manga'])) {
        $message = 'Veuillez remplir tous les champs.';
        header("Location: inscription3.php?message=" . urlencode($message));
        exit;
    }

    $preference = $_POST['preference'];
    $genre = $_POST['genre'];
    $manga = $_POST['manga'];
    
    $q = 'INSERT INTO users (preference, genre, manga) VALUES (:preference, :genre, :manga)';
    $req = $bdd->prepare($q);

    $results = $req->execute([
        'preference' => $preference,
        'genre' => $genre,
        'manga' => $manga,
       
    ]);

    header('location:connexion.php?message=Inscription réussi, veuillez vous connecter');
    exit;
}
?>
