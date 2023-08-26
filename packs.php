<!DOCTYPE html>
<html>
<head>
    <title>RIVER RIDE - Packs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">
</head>
<body>

<?php include('includes/header_menu.php'); ?>
<?php include('includes/db.php'); ?>

<main class="center-content mt-5">
    <div class="container mt-5">
        <h2 class="big-title">Nos Packs</h2>

        <!-- Pack Royal -->
        <div class="card mb-5">
            <h3 class="card-header">Pack "Royal"</h3>
            <div class="card-body">

                <!--Présentation générale--><h5>Profitez des visites des plus beaux châteaux de la Loire et résidez dans les hôtels les plus prestigieux.</h5>
                <p>Réservation possible pour groupe de 1 à 8 personnes.</p>
                <!-- Détails des étapes -->
                <h5>Étapes :</h5>
                <?php
                // Les étapes pour le Pack "Royal"
                $etapes_royal = [
                    [
                        "nom" => "Château de Chambord",
                        "description" => "L'un des châteaux les plus reconnaissables au monde grâce à son architecture de la Renaissance française unique et ses toits impressionnants.",
                        "activites" => "Visite du château, promenade dans les jardins, observation de la faune sauvage dans le domaine national de Chambord."
                    ],
                    [
                        "nom" => "Château de Chenonceau",
                        "description" => "Également connu sous le nom de \"château des dames\", il est construit sur le Cher et est célèbre pour ses magnifiques jardins et son histoire fascinante.",
                        "activites" => "Visite du château, promenade dans les jardins, balade en bateau sur le Cher pour admirer le château depuis l'eau."
                    ],
                    [
                        "nom" => "Château d'Amboise et Clos Lucé",
                        "description" => "Le château d'Amboise est un site historique majeur, tandis que le Clos Lucé est connu pour être la dernière résidence de Léonard de Vinci.",
                        "activites" => "Visite du château d'Amboise, exploration du Clos Lucé, découverte des inventions de Léonard de Vinci."
                    ]
                ];

                foreach ($etapes_royal as $etape): ?>
                    <h6><?= $etape["nom"] ?></h6>
                    <p><?= $etape["description"] ?></p>
                    <p><strong>Activités:</strong> <?= $etape["activites"] ?></p>
                <?php endforeach; ?>

                <!-- Détails des hébergements -->
                <h5>Hébergements :</h5>
                <?php
                // Les hébergements pour le Pack "Royal"
                $hebergements_royal = [
                    [
                        "nom" => "Hôtel proche de Chambord",
                        "description" => "Un hôtel de luxe situé à proximité du château, offrant des chambres spacieuses, un spa et une cuisine gastronomique."
                    ],
                    [
                        "nom" => "Hôtel proche de Chenonceau",
                        "description" => "Un établissement historique avec un charme d'antan, des jardins luxuriants et une vue imprenable sur le Cher."
                    ],
                    [
                        "nom" => "Hôtel à Amboise",
                        "description" => "Un palace élégant au cœur d'Amboise, à quelques minutes à pied du château et du Clos Lucé, offrant un confort haut de gamme."
                    ]
                ];

                foreach ($hebergements_royal as $hebergement): ?>
                    <h6><?= $hebergement["nom"] ?></h6>
                    <p><?= $hebergement["description"] ?></p>
                <?php endforeach; ?>

                <!-- Formulaire de réservation pour le Pack Royal -->
                <form action="reserver_pack.php" method="post">
                    <input type="hidden" name="pack" value="royal">
                    <div class="form-group">
                        <label>Date de début :</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>Date de fin :</label>
                        <input type="date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de personnes :</label>
                        <select name="number_of_people" required>
                            <?php for ($i = 1; $i <= 8; $i++) echo "<option value=\"$i\">$i</option>"; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </form>
            </div>
        </div>

        <!-- Pack Seigneur -->
        <div class="card mb-5">
            <h3 class="card-header">Pack "Seigneur"</h3>
            <div class="card-body">
                <!--Présentation générale--><h5>Profitez des visites des plus beaux châteaux de la Loire tout en logeant dans des lieux confortables.</h5>
                <p>Réservation possible pour groupe de 1 à 8 personnes.</p>

                <!-- Détails des étapes -->
                <h5>Étapes :</h5>
                <?php foreach ($etapes_royal as $etape): ?>
                    <h6><?= $etape["nom"] ?></h6>
                    <p><?= $etape["description"] ?></p>
                    <p><strong>Activités:</strong> <?= $etape["activites"] ?></p>
                <?php endforeach; ?>

                <!-- Détails des hébergements -->
                <h5>Hébergements :</h5>
                <?php
                // Les hébergements pour le Pack "Seigneur"
                $hebergements_seigneur = [
                    [
                        "nom" => "Auberge proche de Chambord",
                        "description" => "Une auberge chaleureuse et accueillante offrant des chambres confortables et une cuisine locale authentique."
                    ],
                    [
                        "nom" => "Maison d'hôtes près de Chenonceau",
                        "description" => "Une maison d'hôtes traditionnelle avec des chambres douillettes, un jardin pour se détendre et un petit-déjeuner fait maison."
                    ],
                    [
                        "nom" => "Chambres d'hôte à Amboise",
                        "description" => "Un hébergement familial situé dans le centre historique d'Amboise, à proximité des principales attractions."
                    ]
                ];

                foreach ($hebergements_seigneur as $hebergement): ?>
                    <h6><?= $hebergement["nom"] ?></h6>
                    <p><?= $hebergement["description"] ?></p>
                <?php endforeach; ?>

                <!-- Formulaire de réservation pour le Pack Seigneur -->
                <form action="reserver_pack.php" method="post">
                    <input type="hidden" name="pack" value="seigneur">
                    <div class="form-group">
                        <label>Date de début :</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>Date de fin :</label>
                        <input type="date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de personnes :</label>
                        <select name="number_of_people" required>
                            <?php for ($i = 1; $i <= 8; $i++) echo "<option value=\"$i\">$i</option>"; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="js/navbar.js"></script>
</body>
</html>