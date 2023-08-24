<?php 

include("database.php");
session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Activités récentes</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/css_projet.css">
</head>
<body>

	<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<ul class="navbar-nav list-unstyled d-flex justify-content-between align-items-center ml-auto">
			<li class="nav-item"><a class="nav-link" href="membre.php">afficher les membres</a></li>
			<li class="nav-item"><a class="nav-link" href="liste_signalement.php">Signalement</a></li>
			<li class="nav-item"><a class="nav-link" href="activite_recente.php">Activités récentes</a></li>
			<li class="nav-item"><a class="nav-link" href="edition.php">Edition</a></li>
			<li class="nav-item"><a class="nav-link" href="statistiques.php">Rapports et statistiques</a></li>
			<li class="nav-item "><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
		</ul>
	</nav>
</header>

<main class="container align-items-center flex-column">
<div class="container align-items-center justify-content-center flex-column col-md-8"">



	
<div class=" row   align-items-center justify-content-center">
	<h3>Derniers utilisateurs inscrit</h3>
<?php 

$req=$bdd->prepare('SELECT * FROM users ORDER BY id DESC LIMIT 10 ');
$req->execute();

while($results=$req->fetch()){
$id=$results['id'];
$pseudo=$results['pseudo'];

echo '<div>';
echo "<a href='fiche_utilisateur.php?id=" . $id . "'>" . $id . ' ' . $pseudo . "</a><br>";


}

 ?>

</div>

<div class=" row align-items-center justify-content-center">
	<h3>Derniers articles créés</h3>
<?php 

$req=$bdd->prepare('SELECT * FROM article ORDER BY id DESC LIMIT 10 ');
$req->execute();

while($results=$req->fetch()){
$id=$results['user_id'];
$title=$results['title'];


echo '<div>';
echo "<a href='fiche_utilisateur.php?id=" . $id . "'>" . $id . ' ' . $title . "</a><br>";


}
 ?>

</div>

<div class=" row  div_recommandation_news align-items-center justify-content-center">
	<h3>Derniers forums créés</h3>
<?php 

$req=$bdd->prepare('SELECT * FROM forum ORDER BY id DESC LIMIT 10 ');
$req->execute();

while($results=$req->fetch()){
$id=$results['id'];
$name=$results['name'];


echo '<div>';
echo "<a href='forum.php?id=". $id. "'>" . $name . "</a><br>";


}

 ?>

</div>
</div>

</div>
</main>
</body>
</html>