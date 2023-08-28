<?php
$dates = isset($_POST['dates']) ? $_POST['dates'] : [];

include("includes/db.php");

$baggage_supplements = isset($_POST['baggage_supplement']) ? $_POST['baggage_supplement'] : [];
$hotel_prices = isset($_POST['hotel_price']) ? $_POST['hotel_price'] : [];
$dates = isset($_POST['dates']) ? $_POST['dates'] : []; // This line gets the dates



// Get baggage supplements and hotel prices from POST data
$baggage_supplements = isset($_POST['baggage_supplement']) ? $_POST['baggage_supplement'] : [];
$hotel_prices = isset($_POST['hotel_price']) ? $_POST['hotel_price'] : [];

// Fetch the details of hotels based on the ids from baggage_supplement
$hotel_ids = array_keys($baggage_supplements);
$placeholders = str_repeat('?,', count($hotel_ids) - 1) . '?';
$stmt = $bdd->prepare("SELECT * FROM accommodations WHERE id IN ($placeholders)");
$stmt->execute($hotel_ids);
$hotel_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de la réservation</title>
    <?php include("includes/head.php"); ?>
</head>
<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <h2>Récapitulatif de la réservation</h2>
        
        <?php
        $total_cost = 0;
        foreach ($hotel_details as $hotel) {
            echo '<div class="hotel-section">';
            echo '<h3>' . $hotel['nom'] . '</h3>';
            echo '<p>Adresse: ' . $hotel['adresse'] . '</p>';
            
            $supplement_cost = $baggage_supplements[$hotel['id']];
            if($supplement_cost == 10) {
                echo '<p>Supplément bagage: 10€ pour 10kg supplémentaires</p>';
            } elseif($supplement_cost == 20) {
                echo '<p>Supplément bagage: 20€ pour 20kg supplémentaires</p>';
            } else {
                echo '<p>Aucun supplément bagage sélectionné</p>';
            }
            
            // Calculate hotel price and total cost
            $nights = (strtotime($dates[$hotel['id']]['to']) - strtotime($dates[$hotel['id']]['from'])) / (60 * 60 * 24);
            $total_hotel_price = $nights * $hotel_prices[$hotel['id']];
            echo '<p>Coût de l\'hôtel: ' . $total_hotel_price . '€ (' . $nights . ' nuits à ' . $hotel_prices[$hotel['id']] . '€/nuit)</p>';

            $total_cost += $supplement_cost + $total_hotel_price;

            echo '</div>';
        }
        ?>

        <div style="text-align: center; margin-top: 20px;">
            <h3>Total à payer: <?php echo $total_cost; ?>€</h3>
            <!-- Here, you can add a payment gateway or any other form of finalizing the booking -->
        </div>

    </main>
    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
