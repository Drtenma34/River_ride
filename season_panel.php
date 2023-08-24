<?php
session_start();


$title = "Anime Seasons Panel";
include("includes/head.php");

?>

<head>
<link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">
    <link rel="stylesheet" type="text/css" href="button_season_panel.css.css">
    <script src="js/alert_message.js"></script>
</head>

<?php
include("includes/db.php");

//Je vérifie si le User est connecté

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    $userId = null;
}

$currentSeason = isset($_GET['season']) ? $_GET['season'] : 'WINTER 2023';

try {                           // get all seasons

    $seasonsQuery = $bdd->query("SELECT * FROM seasons");
    $seasons = $seasonsQuery->fetchAll();


                                // get animes of current season

//:currentSeason est un marqueur nommé. Il représente le paramètre de la requête
//  qui sera remplacé par la valeur de la variable $currentSeason

$animeQuery = $bdd->prepare(
"SELECT animes.id, animes.name, animes.synopsis, animes.poster, animes.trailer, seasons.name AS Anime_season
        FROM animes
        INNER JOIN seasons ON animes.season_id = seasons.id
        WHERE seasons.name = :currentSeason;");
$animeQuery->execute(['currentSeason' => $currentSeason]);
$animes = $animeQuery->fetchAll();
} catch(PDOException $e) {
echo $e->getMessage();
}

            //Get animes that have been liked by user


try {
    $likeQuery = $bdd->prepare(
        "SELECT anime_id 
        FROM user_likes_anime
        WHERE user_id = :userId;"
    );
    $likeQuery->execute(['userId' => $userId]);
    $likedAnimes = $likeQuery->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    echo $e->getMessage();
}

function isAnimeLiked($animeId, $likedAnimes)
{
    return in_array($animeId, $likedAnimes);
}


/*var_dump($likedAnimes);
exit;*/

?>

<!--trouver l'ID de la saison actuelle et des saisons précédente et suivante.-->

<?php
$currentSeasonId = array_search($currentSeason, array_column($seasons, 'name'));

$previousSeason = $seasons[$currentSeasonId - 1] ?? null;
$nextSeason = $seasons[$currentSeasonId + 1] ?? null;
?>


<?php include('includes/header_complet_season_panel.php'); ?>

<!--Création du Main-->

<!-- Affichage des animes -->


<main class="container mt-5 pt-5">


    <h2 class="mb-3 text-center">
        <?php if ($previousSeason): ?>
            <a href="?season=<?= $previousSeason['name'] ?>">&larr;</a>
        <?php endif; ?>

        <?= $currentSeason; ?>

        <?php if ($nextSeason): ?>
            <a href="?season=<?= $nextSeason['name'] ?>">&rarr;</a>
        <?php endif; ?>
    </h2>
    <div class="row">
        <?php foreach ($animes as $anime): ?>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5><?= $anime['name'] ?></h5>
                        <p class="card-text">Genre: N/A</p>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-5">
                                <img src="<?= $anime['poster'] ?>" class="img-fluid" alt="<?= $anime['name'] ?>">
                            </div>
                            <div class="col-7">
                                <div class="mb-3">

                                    <?php if ($userId !== null) : ?>
                                    <form method="post" action="like_season_panel.php">
                                        <input type="hidden" name="anime_id" value="<?= $anime['id'] ?>">
                                        <input type="hidden" name="anime_name" value="<?= $anime['name'] ?>">
                                        <input type="hidden" name="current_season" value="<?= $currentSeason ?>">
                                        <input type="hidden" name="already_liked" value="<?= isAnimeLiked($anime['id'], $likedAnimes) ? '1' : '0' ?>">
                                        <button type="submit" class="btn btn-info btn-sm">Like</button>
                                        <?php if (isAnimeLiked($anime['id'], $likedAnimes)): ?>
                                            <span class="ml-2 text-success">You've liked this anime!</span>
                                        <?php else: ?>
                                            <span class="ml-2 text-muted">You haven't liked this anime yet.</span>
                                        <?php endif; ?>
                                    </form>
                                    <?php endif; ?>

                                </div>
                                <div class="flex-grow-1">
                                    <p><?= $anime['synopsis'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script src="js/navbar.js"></script>


<!--Javascript de ma barre AJAX-->

<script>
    async function search(){
        const input = document.getElementById('search').value;
        if(input.length > 2){
            const res = await fetch(`search.php?value=${input}`);
            const str = await res.text();
            const container = document.getElementById('content');
            container.innerHTML = str;
        } else {
            const container = document.getElementById('content');
            container.innerHTML = null;
        }
    }
</script>

<!--Javascript de ma barre AJAX-->
