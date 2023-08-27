<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $numberOfPeople = $_POST['number_of_people'];
    $packType = $_POST['packType'];

    $accommodations = [];
    if ($packType == "Royal") {
        $accommodations = [
            $_POST['accommodation_id_chambord'],
            $_POST['accommodation_id_chenonceau'],
            $_POST['accommodation_id_amboise']
        ];
    } elseif ($packType == "Seigneur") {
        $accommodations = [
            $_POST['accommodation_id_chambord'],
            $_POST['accommodation_id_chenonceau'],
            $_POST['accommodation_id_amboise']
        ];
    }

    $numNights = (strtotime($endDate) - strtotime($startDate)) / 60 / 60 / 24;
    if ($numNights < 3 || count($accommodations) != 3) {
        echo json_encode([
            "status" => "error",
            "message" => "La durée minimale du séjour est de 3 nuits."
        ]);
        exit;
    }

    $nightsPerAccommodation = floor($numNights / 3);

    // Vérification de chaque hébergement
    foreach ($accommodations as $index => $accommodationId) {
        $checkIn = date('Y-m-d', strtotime($startDate . "+$index days"));
        $checkOut = date('Y-m-d', strtotime($checkIn . "+$nightsPerAccommodation days"));

        // Vérification de la capacité
        $query = $bdd->prepare("SELECT max_pers FROM accommodations WHERE id = ?");
        $query->execute([$accommodationId]);
        $accommodation = $query->fetch(PDO::FETCH_ASSOC);

        if (!$accommodation || $numberOfPeople > $accommodation['max_pers']) {
            echo json_encode([
                "status" => "error",
                "message" => "Le nombre de personnes dépasse la capacité de l'hébergement choisi pour les dates $checkIn à $checkOut."
            ]);
            exit;
        }

        // Vérification des réservations existantes
        $query = $bdd->prepare("
            SELECT SUM(number_of_people) as total_people 
            FROM accommodation_reservations 
            WHERE accommodation_id = ? 
            AND start_date <= ? 
            AND end_date >= ?
        ");
        $query->execute([$accommodationId, $checkOut, $checkIn]);
        $existingReservations = $query->fetch(PDO::FETCH_ASSOC);

        $totalPeople = $existingReservations['total_people'] + $numberOfPeople;

        if ($totalPeople > $accommodation['max_pers']) {
            echo json_encode([
                "status" => "error",
                "message" => "L'hébergement est complet pour les dates $checkIn à $checkOut."
            ]);
            exit;
        }
    }

    // Si tout est bon
    echo json_encode([
        "status" => "success",
        "message" => "Les hébergements sont disponibles pour les dates choisies."
    ]);
}
?>
