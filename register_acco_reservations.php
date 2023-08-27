<?php

session_start();
// Connexion à la base de données
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id'];  // Cela devrait provenir de la session de l'utilisateur connecté
    $accommodationId = $_POST['accommodation_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $numberOfPeople = $_POST['number_of_people'];

    // Vérification de la capacité de l'hébergement
    $query = $bdd->prepare("SELECT max_pers FROM accommodations WHERE id = ?");
    $query->execute([$accommodationId]);
    $accommodation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$accommodation || $numberOfPeople > $accommodation['max_pers']) {
        echo "Le nombre de personnes dépasse la capacité de l'hébergement choisi.";
        exit;
    }

    // Vérification des réservations existantes pour cet hébergement pendant cette période
    $query = $bdd->prepare("
        SELECT SUM(number_of_people) as total_people 
        FROM accommodation_reservations 
        WHERE accommodation_id = ? 
        AND start_date <= ? 
        AND end_date >= ?
    ");
    $query->execute([$accommodationId, $endDate, $startDate]);
    $existingReservations = $query->fetch(PDO::FETCH_ASSOC);

    $totalPeople = $existingReservations['total_people'] + $numberOfPeople;

    if ($totalPeople > $accommodation['max_pers']) {
        echo "L'hébergement est complet pendant la période choisie.";
        exit;
    }

    // Si tout est bon, enregistrement de la nouvelle réservation
    $query = $bdd->prepare("
        INSERT INTO accommodation_reservations (user_id, accommodation_id, start_date, end_date, is_payed) 
        VALUES (?, ?, ?, ?, 0)
    ");
    $result = $query->execute([$userId, $accommodationId, $startDate, $endDate]);

    if ($result) {
        echo "Réservation effectuée avec succès!";
    } else {
        echo "Erreur lors de la réservation. Veuillez réessayer.";
    }
}



