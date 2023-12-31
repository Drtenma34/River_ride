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

<?php
include('includes/header_menu.php');
include("includes/db.php");
?>

//élément pour stocker l'état de connexion de l'utilisateur
<input type="hidden" id="isUserLoggedIn" value="<?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>">

//On recup les photos des stages.
<?php
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
            <div class="d-flex justify-content-between">
            <h5>Profitez des visites des plus beaux châteaux de la Loire en logeant dans des hôtels luxueux.</h5>
            </div>
            <button class="btn btn-primary" onclick="toggleContent('detailsRoyal')">Voir détails</button>
        </div>
        <div id="detailsRoyal" style="display: none;">

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
                <img src="images_accommodations/Hotel-Chambord-Brussels-Exterior_64eab6bf7d9f3.jpeg?>" alt="Photo de l'hôtel proche de Chambord" width="300">
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
                <img src="images_accommodations/hotel_chenonceaux_64eac3aa729e7.jpg" alt="Photo de l'hôtel proche de Chenonceau"
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
                <img src="images_accommodations/hotel-amboise_64eac07d4910d.jpg" alt="Photo de l'hôtel à Amboise" width="300">
                <h6>Hôtel à Amboise</h6>
                <p>Un palace élégant au cœur d'Amboise, à quelques minutes à pied du château et du Clos Lucé, offrant un
                    confort haut de gamme.</p>
            </div>

            <section class="mb-5 p-3 border rounded text-bg-light">
                <div class="d-flex justify-content-between">

                    <!-- Form pour le Pack Royal -->
                    <form action="register_acco_reservations.php" method="post" id="formRoyal" class="mt-3" onsubmit="return handleFormSubmission(this);">

                    <h4>Réserver le Pack "Royal"</h4>
                        <div class="mb-3">
                            <label for="startDateRoyal" class="form-label">Date de début :</label>
                            <input type="date" class="form-control" id="startDateRoyal" name="start_date"
                                   min="2023-09-01" max="2023-10-31" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDateRoyal" class="form-label">Date de fin :</label>
                            <input type="date" class="form-control" id="endDateRoyal" name="end_date" min="2023-09-02"
                                   max="2023-11-01" required>
                        </div>
                        <div class="mb-3">
                            <label for="numberRoyal" class="form-label">Nombre de personnes :</label>
                            <input type="number" class="form-control" id="numberRoyal" name="number_of_people" min="1"
                                   max="8" required>
                        </div>
                        <input type="hidden" name="accommodation_id_chambord" value="17">
                        <input type="hidden" name="accommodation_id_chenonceau" value="18">
                        <input type="hidden" name="accommodation_id_amboise" value="19">
                        <input type="hidden" name="packType" value="Royal">
                        <input type="hidden" name="availability" value="0" id="availabilityRoyal">

                        <div id="availabilityMessage"></div>
                        <button type="submit" class="btn btn-success">Réserver</button>

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
                <h5>Profitez des visites des plus beaux châteaux de la Loire tout en logeant dans des lieux
                    confortables.</h5>
            </h3>
            <button class="btn btn-primary" onclick="toggleContent('detailsSeigneur')">Voir détails</button>
        </div>
        <div id="detailsSeigneur" style="display: none;">


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
                <img src="images_accommodations/image_auberge_chambord_64eab71fec3fb.jpg" alt="Photo de l'auberge proche de Chambord"
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
                <img src="images_accommodations/auberge_chenonceau_64eac3ce7ddb7.jpg" alt="Photo de la maison d'hôtes près de Chenonceau"
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
                <img src="images_accommodations/auberge-amboise_64eac09f42459.jpeg" alt="Photo des chambres d'hôte à Amboise" width="300">
                <h6>Chambres d'hôte à Amboise</h6>
                <p>Un hébergement familial situé dans le centre historique d'Amboise, à proximité des principales
                    attractions.</p>
            </div>

            <section class="mb-5 p-3 border rounded text-bg-light">
                <div class="d-flex justify-content-between">


                    <!-- Form pour le Pack Seigneur -->
                    <form action="register_acco_reservations.php" method="post" id="formSeigneur" class="mt-3" onsubmit="return handleFormSubmission(this);">
                    <h4>Réserver le Pack "Seigneur"</h4>
                        <div class="mb-3">
                            <label for="dateSeigneurStart" class="form-label">Date de début :</label>
                            <input type="date" class="form-control" id="dateSeigneurStart" name="start_date"
                                   min="2023-09-01"
                                   max="2023-10-31" required>
                        </div>
                        <div class="mb-3">
                            <label for="dateSeigneurEnd" class="form-label">Date de fin :</label>
                            <input type="date" class="form-control" id="dateSeigneurEnd" name="end_date"
                                   min="2023-09-01"
                                   max="2023-10-31" required>
                        </div>
                        <div class="mb-3">
                            <label for="numberSeigneur" class="form-label">Nombre de personnes :</label>
                            <input type="number" class="form-control" id="numberSeigneur" name="number_of_people"
                                   min="1"
                                   max="8" required>
                        </div>
                        <input type="hidden" name="accommodation_id_chambord" value="20">
                        <input type="hidden" name="accommodation_id_chenonceau" value="21">
                        <input type="hidden" name="accommodation_id_amboise" value="22">
                        <input type="hidden" name="packType" value="Seigneur">
                        <input type="hidden" name="availability" value="0" id="availabilitySeigneur">

                        <div id="availabilityMessage"></div>
                        <button type="submit" class="btn btn-success">Réserver</button>

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

<script>

    function checkAvailability(formElement) {
        // Récupération des données du formulaire
        let formData = new FormData(formElement);

        // Envoi de la requête AJAX
        fetch('check_availability.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Affichage du message de disponibilité
                let messageElement = formElement.querySelector('#availabilityMessage');
                if (data.status === "success") {
                    messageElement.textContent = data.message;
                    messageElement.style.color = "green";
                    formElement.querySelector('[name="availability"]').value = "1";
                } else {
                    messageElement.textContent = data.message;
                    messageElement.style.color = "red";
                    formElement.querySelector('[name="availability"]').value = "0";
                }
            })
            .catch(error => {
                console.error("Une erreur s'est produite:", error);
            });
    }

    // Écouteurs d'événements pour les modifications du formulaire
    document.getElementById('formRoyal').addEventListener('change', function() {
        checkAvailability(this);
    });

    document.getElementById('formSeigneur').addEventListener('change', function() {
        checkAvailability(this);
    });

    function handleFormSubmission(form) {
        let isUserLoggedIn = document.getElementById('isUserLoggedIn').value;

        if (isUserLoggedIn === 'false') {
            window.location.href = 'identification_process/connexion.php';  // Redirige vers la page de connexion
            return false;  // Empêche la soumission du formulaire
        }

        let availabilityInput = form.querySelector('[name="availability"]');
        if (availabilityInput.value !== "1") {
            alert('Vous ne pouvez que réserver à une période où des c\'est possible.');
            return false;  // Empêche la soumission du formulaire
        }

        return true;  // Autorise la soumission du formulaire
    }

</script>

<script src="js/navbar.js"></script>

</body>
</html>

