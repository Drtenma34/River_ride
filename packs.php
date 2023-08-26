<!DOCTYPE html>
<html>

<head>
    <title>RIVER RIDE - Packs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">
</head>

<body>

<?php include('includes/header_menu.php'); ?>

<?php
include("includes/db.php");

try {
    $accommodationsQuery = $bdd->prepare(
        "SELECT photo 
            FROM accommodations
            WHERE photo IS NOT NULL;"
    );
    $accommodationsQuery->execute();
    $accommodationPhotos = $accommodationsQuery->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo $e->getMessage();
}

try {
    $stagesQuery = $bdd->prepare(
        "SELECT photo 
            FROM travel_stages
            WHERE photo IS NOT NULL;"
    );
    $stagesQuery->execute();
    $stagePhotos = $stagesQuery->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<main class="container mt-5">
    <h2 class="big-title">Nos Packs</h2>

    <!-- Pack Royal -->
    <section class="mb-5 p-3 border rounded bg-dark-subtle">
        <div class="d-flex justify-content-between">
            <h3>
                Pack "Royal"<img src="images/royal-crown-of-sharp-black-design-svgrepo-com.svg" alt="Icône Royal"
                                 width="30" height="30">
            </h3>
            <button class="btn btn-primary" onclick="toggleContent('detailsRoyal')">Voir détails</button>
        </div>
        <div id="detailsRoyal" style="display: none;">
            <h5>Profitez des visites des plus beaux châteaux de la Loire en logeant dans des hôtels luxueux.</h5>
            <p>Réservation possible pour groupe de 1 à 8 personnes.</p>
            <h5>Étapes :</h5>

            <!-- Château de Chambord -->
            <div>
                <img src="<?php echo $stagePhotos[0]; ?>" alt="Photo de Château de Chambord" width="300">
                <h6>Château de Chambord</h6>
                <p>L'un des châteaux les plus reconnaissables au monde grâce à son architecture de la Renaissance
                    française unique et ses toits impressionnants.</p>
                <p><strong>Activités:</strong> Visite du château, promenade dans les jardins, observation de la faune
                    sauvage dans le domaine national de Chambord.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[0]; ?>" alt="Photo de l'hôtel proche de Chambord" width="300">
                <h6>Hôtel proche de Chambord</h6>
                <p>Un hôtel de luxe situé à proximité du château, offrant des chambres spacieuses, un spa et une cuisine
                    gastronomique.</p>
            </div>

            <!-- Château de Chenonceau -->
            <div>
                <img src="<?php echo $stagePhotos[1]; ?>" alt="Photo de Château de Chenonceau" width="300">
                <h6>Château de Chenonceau</h6>
                <p>Également connu sous le nom de "château des dames", il est construit sur le Cher et est célèbre pour
                    ses magnifiques jardins et son histoire fascinante.</p>
                <p><strong>Activités:</strong> Visite du château, promenade dans les jardins, balade en bateau sur le
                    Cher pour admirer le château depuis l'eau.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[1]; ?>" alt="Photo de l'hôtel proche de Chenonceau"
                     width="300">
                <h6>Hôtel proche de Chenonceau</h6>
                <p>Un établissement historique avec un charme d'antan, des jardins luxuriants et une vue imprenable sur
                    le Cher.</p>
            </div>

            <!-- Château d'Amboise et Clos Lucé -->
            <div>
                <img src="<?php echo $stagePhotos[2]; ?>" alt="Photo de Château d'Amboise et Clos Lucé" width="300">
                <h6>Château d'Amboise et Clos Lucé</h6>
                <p>Le château d'Amboise est un site historique majeur, tandis que le Clos Lucé est connu pour être la
                    dernière résidence de Léonard de Vinci.</p>
                <p><strong>Activités:</strong> Visite du château d'Amboise, exploration du Clos Lucé, découverte des
                    inventions de Léonard de Vinci.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[2]; ?>" alt="Photo de l'hôtel à Amboise" width="300">
                <h6>Hôtel à Amboise</h6>
                <p>Un palace élégant au cœur d'Amboise, à quelques minutes à pied du château et du Clos Lucé, offrant un
                    confort haut de gamme.</p>
            </div>


            <section class="mb-5 p-3 border rounded text-bg-light">
                <div class="d-flex justify-content-between">
                    <!-- Form pour le Pack Royal -->
                    <form action="check_availability.php" method="post" class="mt-3">
                        <h4>Réserver le Pack "Royal"</h4>
                        <div class="mb-3">
                            <label for="dateRoyal" class="form-label">Choisissez une date :</label>
                            <input type="date" class="form-control" id="dateRoyal" name="dateRoyal" min="2023-09-01"
                                   max="2023-10-31" required>
                        </div>
                        <div class="mb-3">
                            <label for="numberRoyal" class="form-label">Nombre de personnes :</label>
                            <input type="number" class="form-control" id="numberRoyal" name="numberRoyal" min="1"
                                   max="8" required>
                        </div>
                        <input type="hidden" name="packType" value="Royal">
                        <button type="submit" class="btn btn-primary">Vérifier la disponibilité</button>
                    </form>

                </div>
            </section>


        </div>
    </section>

    <!-- Pack Seigneur -->
    <section class="mb-5 p-3 border rounded bg-dark-subtle">
        <div class="d-flex justify-content-between">
            <h3>
                Pack "Seigneur"
                <img src="images/castle-svgrepo-com.svg" alt="Icône Royal" width="30" height="30">
            </h3>
            <button class="btn btn-primary" onclick="toggleContent('detailsSeigneur')">Voir détails</button>
        </div>
        <div id="detailsSeigneur" style="display: none;">
            <h5>Profitez des visites des plus beaux châteaux de la Loire tout en logeant dans des lieux
                confortables.</h5>
            <p>Réservation possible pour groupe de 1 à 8 personnes.</p>
            <h5>Étapes :</h5>

            <!-- Château de Chambord -->
            <div>
                <img src="<?php echo $stagePhotos[0]; ?>" alt="Photo de Château de Chambord" width="300">
                <h6>Château de Chambord</h6>
                <p>L'un des châteaux les plus reconnaissables au monde grâce à son architecture de la Renaissance
                    française unique et ses toits impressionnants.</p>
                <p><strong>Activités:</strong> Visite du château, promenade dans les jardins, observation de la faune
                    sauvage dans le domaine national de Chambord.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[0]; ?>" alt="Photo de l'auberge proche de Chambord"
                     width="300">
                <h6>Auberge proche de Chambord</h6>
                <p>Une auberge chaleureuse et accueillante offrant des chambres confortables et une cuisine locale
                    authentique.</p>
            </div>

            <!-- Château de Chenonceau -->
            <div>
                <img src="<?php echo $stagePhotos[1]; ?>" alt="Photo de Château de Chenonceau" width="300">
                <h6>Château de Chenonceau</h6>
                <p>Également connu sous le nom de "château des dames", il est construit sur le Cher et est célèbre pour
                    ses magnifiques jardins et son histoire fascinante.</p>
                <p><strong>Activités:</strong> Visite du château, promenade dans les jardins, balade en bateau sur le
                    Cher pour admirer le château depuis l'eau.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[1]; ?>" alt="Photo de la maison d'hôtes près de Chenonceau"
                     width="300">
                <h6>Maison d'hôtes près de Chenonceau</h6>
                <p>Une maison d'hôtes traditionnelle avec des chambres douillettes, un jardin pour se détendre et un
                    petit-déjeuner fait maison.</p>
            </div>

            <!-- Château d'Amboise et Clos Lucé -->
            <div>
                <img src="<?php echo $stagePhotos[2]; ?>" alt="Photo de Château d'Amboise et Clos Lucé" width="300">
                <h6>Château d'Amboise et Clos Lucé</h6>
                <p>Le château d'Amboise est un site historique majeur, tandis que le Clos Lucé est connu pour être la
                    dernière résidence de Léonard de Vinci.</p>
                <p><strong>Activités:</strong> Visite du château d'Amboise, exploration du Clos Lucé, découverte des
                    inventions de Léonard de Vinci.</p>
            </div>

            <div>
                <img src="<?php echo $accommodationPhotos[2]; ?>" alt="Photo des chambres d'hôte à Amboise" width="300">
                <h6>Chambres d'hôte à Amboise</h6>
                <p>Un hébergement familial situé dans le centre historique d'Amboise, à proximité des principales
                    attractions.</p>
            </div>

            <section class="mb-5 p-3 border rounded text-bg-light">
                <div class="d-flex justify-content-between">
                    <!-- Form pour le Pack Seigneur -->
                    <form action="check_availability.php" method="post" class="mt-3">
                        <h4>Réserver le Pack "Seigneur"</h4>
                        <div class="mb-3">
                            <label for="dateSeigneur" class="form-label">Choisissez une date :</label>
                            <input type="date" class="form-control" id="dateSeigneur" name="dateSeigneur"
                                   min="2023-09-01"
                                   max="2023-10-31" required>
                        </div>
                        <div class="mb-3">
                            <label for="numberSeigneur" class="form-label">Nombre de personnes :</label>
                            <input type="number" class="form-control" id="numberSeigneur" name="numberSeigneur" min="1"
                                   max="8" required>
                        </div>
                        <input type="hidden" name="packType" value="Seigneur">
                        <button type="submit" class="btn btn-primary">Vérifier la disponibilité</button>
                    </form>
                </div>
            </section>

        </div>
    </section>
</main>

<script>
    function toggleContent(id) {
        var content = document.getElementById(id);
        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    }
</script>

</body>

</html>
