<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $numberOfPeople = $_POST['number_of_people'];
    $packType = $_POST['packType'];

    // Vérifiez si toutes les données nécessaires ont été fournies
    if (!$startDate || !$endDate || !$numberOfPeople || !$packType) {
        echo json_encode([
            "status" => "error",
            "message" => "Veuillez remplir tous les champs."
        ]);
        exit;
    }

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

    // Tableau pour stocker les messages d'erreur pour chaque hébergement complet
    $fullAccommodations = [];


    // Vérification de chaque hébergement
    foreach ($accommodations as $index => $accommodationId) {
        $checkIn = date('Y-m-d', strtotime($startDate . "+$index days"));
        $checkOut = date('Y-m-d', strtotime($checkIn . "+$nightsPerAccommodation days"));

        // Vérification de la capacité
        $query = $bdd->prepare("SELECT max_pers FROM accommodations WHERE id = ?");
        $query->execute([$accommodationId]);
        $accommodation = $query->fetch(PDO::FETCH_ASSOC);
        /*
         * Résultat de la query :

         * le nombre total de personnes ayant déjà réservé cet hébergement pour la période spécifiée) sont
         * récupérés sous forme d'association*/


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
            $query = $bdd->prepare("SELECT nom FROM accommodations WHERE id = ?");
            $query->execute([$accommodationId]);
            $accommodationName = $query->fetchColumn();

            $fullAccommodations[] = "L'hébergement '$accommodationName' est complet pour les dates $checkIn à $checkOut.";
        }
    }

    if (count($fullAccommodations) > 0) {
        echo json_encode([
            "status" => "error",
            "message" => implode(" ", $fullAccommodations) . " Nous vous recommandons de composer votre itinéraire vous-même en choisissant votre hébergement et vos étapes de manière personnalisée dans le portail 'composer son propre parcours' pour plus de flexibilité."
        ]);
        exit;
    }

// Si tout est bon
    echo json_encode([
        "status" => "success",
        "message" => "Les hébergements sont disponibles pour les dates choisies."
    ]);
}
