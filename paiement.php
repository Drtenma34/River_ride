<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Place Évenement</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <h1>Formulaire de paiement</h1>
        <form>
            <div class="form-group">
                <label for="cardNumber">Numéro de carte:</label>
                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-group">
                <label for="expiryDate">Date d'expiration:</label>
                <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA">
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" placeholder="123">
            </div>
            <div class="form-group">
                <label for="cardholderName">Nom du titulaire de la carte:</label>
                <input type="text" class="form-control" id="cardholderName" placeholder="John Doe">
            </div>
            <button type="submit" class="btn btn-primary">Payer</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
