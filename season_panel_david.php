<?php
include("includes/head_season_panel.php");
include("includes/header_season_panel.php");
include("includes/db.php");


try {
    $query = $bdd->query(
        "SELECT animes.name, animes.synopsis, animes.poster, animes.trailer, seasons.name AS Anime_season
FROM animes
INNER JOIN seasons ON animes.season_id = seasons.id;");
    $anime = $query->fetch();
} catch(PDOException $e) {
    echo $e->getMessage();
}

var_dump($anime);

?>

