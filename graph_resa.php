<?php
session_start();
include("includes/db.php");

//region Vérification de l'authentification admin

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: identification_process/connexion.php');
    exit;
}
//endregion

//region Récupération des hébergements

$q_accommodations = 'SELECT * FROM accommodations';
$req_accommodations = $bdd->prepare($q_accommodations);
$req_accommodations->execute();
$accommodations = $req_accommodations->fetchAll(PDO::FETCH_ASSOC);
//endregion

//region Récupération des réservations pour chaque hébergement entre septembre et octobre et calcul du taux d'occupation pour chaque jour.

// Dates de début et de fin pour la période de septembre à octobre, j'utilise la classe DateTime de PHP
$start_date = new DateTime('2023-09-01');
$end_date = new DateTime('2023-10-31');

// Initialisation du tableau des réservations
/*
 * Mon tableau aura cette structure :
$reservations_data = [
    'ID_hébergement_1' => [
        'name' => 'Nom de l'hébergement 1',
        'days' => [
            '2023-09-01' => pourcentage_d'occupation_1,
            '2023-09-02' => pourcentage_d'occupation_2,
            ...
            '2023-10-31' => pourcentage_d'occupation_n
        ]
    ],
    'ID_hébergement_2' => [
        'name' => 'Nom de l'hébergement 2',
        'days' => [
            '2023-09-01' => pourcentage_d'occupation_1,
            ...
            '2023-10-31' => pourcentage_d'occupation_n
        ]
    ],
    ...
]
*/

$reservations_data = [];
foreach ($accommodations as $accommodation) {
    $reservations_data[$accommodation['id']] = [
        'name' => $accommodation['nom'],
        'days' => []
    ];
    $current_date = clone $start_date;
    while ($current_date <= $end_date) {
        //Chaque hébergement a un tableau qui contient tous les objets "jours" de la période.
        //Je remplis mon tableau imbriqué de tous les objets "jours" en les incrémentant.
        //La valeur la plus imbriquée de mon tableau multidimensionnel sera le taux de personnes qui dormiront dans cet hébergement.
        $reservations_data[$accommodation['id']]['days'][$current_date->format('Y-m-d')] = 0;
        $current_date->modify('+1 day');
    }
}

// Je récupère les réservations pour la période
$q_reservations = 'SELECT * FROM accommodation_reservations WHERE (start_date BETWEEN ? AND ?) OR (end_date BETWEEN ? AND ?) OR (start_date <= ? AND end_date >= ?)';
$req_reservations = $bdd->prepare($q_reservations);
//Il faut que la réservation commence dans la période ou finisse dans la période
$req_reservations->execute([$start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $start_date->format('Y-m-d'), $end_date->format('Y-m-d')]);
$reservations = $req_reservations->fetchAll(PDO::FETCH_ASSOC);

// Parcourir chaque réservation et augmenter le comptage pour chaque jour
foreach ($reservations as $reservation) {
    $reservation_start = new DateTime($reservation['start_date']);
    $reservation_end = new DateTime($reservation['end_date']);

    $current_date = clone $reservation_start;
    while ($current_date <= $reservation_end) {
        if (isset($reservations_data[$reservation['accommodation_id']]['days'][$current_date->format('Y-m-d')])) {
            $reservations_data[$reservation['accommodation_id']]['days'][$current_date->format('Y-m-d')] += $reservation['number_of_people'];
        }
        /*Pour chaque réservation,
         *je vais aller dans mon tableau $reservations_data,
         *et rajouter dans le tableau de l'hébergement en question,
         * pour les jours de la période de la réservation en question (if isset permet de ne pas enregistrer les jours en dehors de Septembre et Octobre),
         * le nb de pers de la réservation()
        */
        $current_date->modify('+1 day');
    }
}

// Calcul du taux d'occupation

foreach ($reservations_data as $accommodation_id => $data) {
    $accommodation_max_pers = null;
    foreach ($accommodations as $accommodation) {
        if ($accommodation['id'] == $accommodation_id) {
            $accommodation_max_pers = $accommodation['max_pers'];
            break;  // Arrête la boucle une fois que l'hébergement correspondant est trouvé
        }
    }

    foreach ($data['days'] as $day => $number_of_people) {
        $reservations_data[$accommodation_id]['days'][$day] = ($number_of_people / $accommodation_max_pers) * 100;  // Pourcentage
    }
}

//endregion
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gestion des réservations - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="graph.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>


</head>

<?php include 'header_back_office.php'; ?>

<body>
<div class="container mt-5">
    <h2>Gestion des réservations</h2>

    <!-- STEP : Contrôles pour filtrer les données semaine par semaine -->
    <label for="week">Choisir une semaine :</label>

    <select id="week" name="week" onchange="location = this.value;">
        <?php
        $base_start_date = new DateTime('2023-09-01');
        $base_end_date = new DateTime('2023-10-31');
        $week_number = 1;


        echo "<option value='?week=all'>Toutes les semaines</option>";
        while ($base_start_date <= $base_end_date) {
            echo "<option value='?week=$week_number'>" . $base_start_date->format('d/m') . " - " . $base_start_date->modify('+6 days')->format('d/m') . "</option>";
            $week_number++;
            $base_start_date->modify('+1 day');
        }
        ?>
    </select>


    <!-- TODO : Ajouter la logique pour filtrer les données -->
    <?php
    // Si l'utilisateur a choisi une semaine spécifique, ajustez les dates de début et de fin
    if (isset($_GET['week'])) {
        if ($_GET['week'] == 'all') {
            $start_date = new DateTime('2023-09-01');
            $end_date = new DateTime('2023-10-31');
        } else {
            $chosen_week = intval($_GET['week']); // Assurez-vous que c'est un entier

            // Ajustez les dates de début et de fin en fonction de la semaine choisie
            $start_date->modify('+' . ($chosen_week - 1) . ' weeks');
            $end_date = clone $start_date;
            $end_date->modify('+6 days');
        }
    }
    ?>


    <!-- Affichage du tableau des réservations -->
    <table class="table mt-5">
        <thead>
        <tr>
            <th>Hébergement</th>
            <?php
            $current_date = clone $start_date;
            while ($current_date <= $end_date):
                ?>
                <th><?= $current_date->format('d/m') ?></th>
                <?php $current_date->modify('+1 day'); ?>
            <?php endwhile; ?>
        </tr>
        </thead>
        <tbody>
        <!-- TODO : Ajouter les données pour chaque hébergement et chaque jour -->
        <?php foreach ($reservations_data as $accommodation_id => $data): ?>
            <tr>
                <td><?= $data['name'] ?></td>
                <?php
                $current_date = clone $start_date;
                while ($current_date <= $end_date):
                    ?>
                    <td>
                        <?= number_format($data['days'][$current_date->format('Y-m-d')], 2) ?>%
                    </td>
                    <?php $current_date->modify('+1 day'); ?>
                <?php endwhile; ?>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>


    <!--Graphique du taux d'occupation -->

    <!--Création de la liste de dates formatées pour la période-->
    <?php
    $formatted_dates = [];
    $current_date = clone $start_date;
    while ($current_date <= $end_date) {
        $formatted_dates[] = $current_date->format('Y-m-d');
        $current_date->modify('+1 day');
    }
    ?>

    <canvas id="occupancyChart" width="100%" height="80vh"></canvas>

</div>

<script>
    var ctx = document.getElementById('occupancyChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                $current_date = clone $start_date;
                while ($current_date <= $end_date):
                    echo json_encode($current_date->format('d/m')) . ",";
                    $current_date->modify('+1 day');
                endwhile;
                ?>
            ],
            datasets: [
                <?php foreach ($reservations_data as $accommodation_id => $data): ?>
                {
                    label: <?= json_encode($data['name']) ?>,
                    data: [
                        <?php
                        $current_date = clone $start_date;
                        while ($current_date <= $end_date):
                            echo $data['days'][$current_date->format('Y-m-d')] . ",";
                            $current_date->modify('+1 day');
                        endwhile;
                        ?>
                    ],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                },
                <?php endforeach; ?>
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
</script>


</body>
</html>