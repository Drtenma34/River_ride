<?php
session_start();
/*var_dump($_SESSION);
exit;*/
?>

<!DOCTYPE html>
<html>
<head>
  <title>ANISITE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/NavbarDropdown.css">

  <script src="js/alert_message.js"></script>

</head>

<body>


<?php
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
} else {
  $userId = null;
}

  include("includes/db.php");

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

function isAnimeLiked($animeId, $likedAnimes) {
    return in_array($animeId, $likedAnimes);
  }

?>

<?php
include('includes/header_complet_season_panel.php');
?>

<body>
<div class="container mt-5">
  <h1 class="text-center">Top 5 des animes les plus populaires</h1>

  <?php
  include ('includes/db.php');

  // Récupérer les 5 animes avec le plus de likes
  $stmt = $bdd->prepare("
            SELECT a.*, COUNT(u.anime_id) AS likes
            FROM animes AS a
            JOIN user_likes_anime AS u ON a.id = u.anime_id
            GROUP BY a.id
            ORDER BY likes DESC
            LIMIT 5
        ");
  $stmt->execute();

  $animes = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($animes as $i => $anime) :
    ?>

    <div class="card mb-4">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="<?= $anime['poster']; ?>" class="card-img" alt="<?= $anime['name']; ?>">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?= $anime['name']; ?></h5>
            <?php if ($userId !== null) : ?>
              <form method="post" action="likeIndex.php">
                <input type="hidden" name="anime_id" value="<?= $anime['id'] ?>">
                <input type="hidden" name="anime_name" value="<?= $anime['name'] ?>">
                <input type="hidden" name="already_liked" value="<?= isAnimeLiked($anime['id'], $likedAnimes) ? '1' : '0' ?>">
                <button type="submit" class="btn btn-info btn-sm"><?= isAnimeLiked($anime['id'], $likedAnimes) ? 'Unlike' : 'Like' ?></button>
              </form>
            <?php endif; ?>
            <p class="card-text"><?= $anime['synopsis']; ?></p>
            <p class="card-text"><small class="text-muted"><?= $anime['likes']; ?> likes</small></p>
          </div>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</div>

<script src="js/navbar.js"></script>

</body>
</html>
