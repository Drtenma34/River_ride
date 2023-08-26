<?php
include("includes/db.php");  // Assuming that the file `db.php` initializes a PDO connection

// Supposing that the data from previous steps are stored in session or POST variables
session_start();

$selected_stages = $_SESSION['selected_stages'] ?? [];
$selected_hotels = $_SESSION['selected_hotels'] ?? [];
$dates = $_SESSION['dates'] ?? [];
$baggage_supplement = $_SESSION['baggage_supplement'] ?? [];

// Fetch the details of selected stages
$stages_details = [];
if (!empty($selected_stages)) {
    // ... fetch from DB, similar to previous logic ...
}

// Fetch the details of selected hotels
$hotel_details = [];
if (!empty($selected_hotels)) {
    // ... fetch from DB, similar to previous logic ...
}

$total_cost = 0; // This will be computed based on the selected options

// For simplicity, we'll just add 10 or 20 to the total cost for baggage. In a real-world scenario, you'd fetch these from the database.
foreach ($baggage_supplement as $supplement) {
    $total_cost += $supplement;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif et Paiement</title>
    <?php include("includes/head.php"); ?>
</head>
<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <h2>Récapitulatif de votre réservation</h2>
        
        <section>
            <h3>Étapes Sélectionnées</h3>
            <ul>
                <?php foreach ($stages_details as $stage) {
                    echo '<li>' . $stage['nom'] . '</li>';
                } ?>
            </ul>
        </section>

        <section>
            <h3>Hébergements</h3>
            <?php foreach ($hotel_details as $hotel) {
                echo '<div>';
                echo '<h4>' . $hotel['nom'] . '</h4>';
                echo '<p>Adresse: ' . $hotel['adresse'] . '</p>';
                echo '<p>Dates: Du ' . $dates[$hotel['id']]['from'] . ' au ' . $dates[$hotel['id']]['to'] . '</p>';
                echo '<p>Supplément bagage: ' . $baggage_supplement[$hotel['id']] . '€</p>';
                $total_cost += $hotel['price_per_night']; // Assuming 'price_per_night' is the cost per night
                echo '</div>';
            } ?>
        </section>

        <!-- Add other sections for other services like activities if needed -->

        <section>
            <h3>Total à payer: <?php echo $total_cost; ?>€</h3>

            <!-- You would integrate your payment gateway here, be it Stripe, PayPal, or others. This is a complex process and often requires backend handling for security reasons. -->
            <p>Intégrez ici votre passerelle de paiement.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
