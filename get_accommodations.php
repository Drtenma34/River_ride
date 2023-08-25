<?php

include("includes/db.php");

$stageId = $_GET['stage_id'];

$q_accommodations = 'SELECT * FROM accommodations WHERE travel_stage_id = ?';
$req_accommodations = $bdd->prepare($q_accommodations);
$req_accommodations->execute([$stageId]);
$accommodations = $req_accommodations->fetchAll(PDO::FETCH_ASSOC);

// Pour chaque logement, calculez le nombre de places disponibles
foreach ($accommodations as $key => $accommodation) {
    $q_reservations = 'SELECT COUNT(*) as total_reservations FROM accommodation_reservations WHERE accommodation_id = ?';
    $req_reservations = $bdd->prepare($q_reservations);
    $req_reservations->execute([$accommodation['id']]);
    $reservation = $req_reservations->fetch(PDO::FETCH_ASSOC);
    $accommodations[$key]['available_places'] = $accommodation['max_pers'] - $reservation['total_reservations'];
}

echo json_encode($accommodations);
?>
