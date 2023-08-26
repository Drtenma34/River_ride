<?php
include("includes/db.php");  // Assuming that the file `db.php` initializes a PDO connection

// Get selected hotels and dates from the POST data
$selected_hotels = isset($_POST['selected_hotels']) ? $_POST['selected_hotels'] : [];
$dates = isset($_POST['dates']) ? $_POST['dates'] : [];

// Fetch the details of selected hotels
$hotel_details = [];
if (!empty($selected_hotels)) {
    try {
        $placeholders = str_repeat('?,', count($selected_hotels) - 1) . '?';
        $stmt = $bdd->prepare("SELECT * FROM accommodations WHERE id IN ($placeholders)");
        $stmt->execute($selected_hotels);
        $hotel_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services supplémentaires</title>
    <?php include("includes/head.php"); ?>
    <style>
        /* You can add additional styles here */
    </style>
</head>
<body>
    <?php include("includes/header_menu.php"); ?>
    <main>
        <h2>Services supplémentaires</h2>
        <p>Choisissez des suppléments de bagage pour vos réservations d'hôtel.</p>
        
        <form action="checkout.php" method="post"> <!-- Assuming there's a page named finalize_booking.php where the booking will be finalized -->
            <?php
            foreach ($hotel_details as $hotel) {
                echo '<div class="hotel-section">';
                echo '<h3>' . $hotel['nom'] . '</h3>';
                echo '<p>Adresse: ' . $hotel['adresse'] . '</p>';
                echo '<p>Réservé du ' . $dates[$hotel['id']]['from'] . ' au ' . $dates[$hotel['id']]['to'] . '</p>';
                
                echo '<div class="baggage-option">';
                echo '<label>Supplément bagage: ';
                echo '<select name="baggage_supplement[' . $hotel['id'] . ']">';
                echo '<option value="0">Aucun</option>';
                echo '<option value="10">10€ - 10kg supplémentaires</option>';
                echo '<option value="20">20€ - 20kg supplémentaires</option>';
                echo '</select>';
                echo '</label>';
                echo '</div>';

                echo '</div>';
            }
            ?>

            <div style="text-align: center; margin-top: 20px;">
                <input type="submit" value="Finaliser la réservation">
            </div>
        </form>

    </main>
    <footer>
        <p>&copy; 2023 Tous droits réservés.</p>
    </footer>
</body>
</html>
