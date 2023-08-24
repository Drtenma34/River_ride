<?php
session_start();
include('includes/db.php');

$userId = $_SESSION['id'];

if (!isset($_POST['anime_id'], $_POST['anime_name'], $_POST['already_liked'])) {
    throw new Exception('Missing POST data.');
}

$animeId = $_POST['anime_id'];
$animeName = $_POST['anime_name'];
$alreadyLiked = $_POST['already_liked'];

try {
    if ($alreadyLiked == '1') {
        // L'utilisateur a déjà aimé cet anime, supprimons le "like"
        $likeQuery = $bdd->prepare("DELETE FROM user_likes_anime WHERE user_id = :userId AND anime_id = :animeId");
        $likeQuery->execute(['userId' => $userId, 'animeId' => $animeId]);
        $message = "Vous avez supprimé votre 'like' de $animeName";
    } else {
        // L'utilisateur n'a pas encore aimé cet anime, ajoutons un "like"
        $likeQuery = $bdd->prepare("INSERT INTO user_likes_anime (user_id, anime_id) VALUES (:userId, :animeId)");
        $likeQuery->execute(['userId' => $userId, 'animeId' => $animeId]);
        $message = "Vous avez aimé $animeName";
    }
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) { // error code for a unique key violation
        $message = "Une erreur est survenue. Veuillez réessayer.";
    } else {
        throw $e; // rethrows the exception for higher-up error handling
    }
}

header('location: index.php?message=' . $message);


