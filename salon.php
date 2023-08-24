<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Salons de Mangas - Évènements</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/Anime.css">
    <link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">

    <style>
        p {
            color: #000;
        }
    </style>
</head>

<?php
include('includes/header_complet_season_panel.php');
?>

<body class="corp">
    <h1>Évènements</h1>

    <h2>Évènement 1</h2>
    <img src="image anime/salon.webp" alt="Faubourg Mangas" style="width:250px;">
    <p>Date : 15 juillet 2023</p>
    <p>Lieu : Salle des expositions</p>
    <p>Description : Venez rencontrer vos artistes de mangas préférés, participer à des conférences, et découvrir les dernières nouveautés du monde des mangas.</p>
    <button onclick="rejoindre('fb-message.php')">Rejoindre</button>


    <h2>Évènement 2</h2>
    <img src="image anime/salon2.jpeg" alt="Salon Mangas" style="width:250px;">
    <p>Date : 22 août 2023</p>
    <p>Lieu : Centre des congrès</p>
    <p>Description : Participez à des ateliers de dessin, des démonstrations de cosplay, des projections de films et des concours de quiz manga.</p>
    <button onclick="rejoindre('salon-message.php')">Rejoindre</button>

    <h2>Évènement 3</h2>
    <img src="image anime/salon3.webp" alt="Japan Expo" style="width:250px;">
    <p>Date : 5 septembre 2023</p>
    <p>Lieu : Parc des expositions</p>
    <p>Description : Plongez dans l'univers des mangas avec des stands de vente, des expositions d'art, des séances de dédicaces et des animations en réalité virtuelle.</p>
    <button onclick="rejoindre('japan-message.php')">Rejoindre</button>

    <script>
        function rejoindre(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
