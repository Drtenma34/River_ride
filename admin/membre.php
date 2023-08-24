<?php



 include("database.php");
  
?>
<?php session_start();
if(empty($_SESSION['id'])){

 	header('location: co_admin.php');
}?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Membres</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/css_projet.css">

	

</head>
<body >
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




<main>
	<h3>Liste des membres</h3><br>

<?php 
$req=$bdd -> query('SELECT * FROM users');
$results;
while($results =$req-> fetch()){


		

		 echo '<p><a href="fiche_utilisateur.php?id=' . $results['id'] . '">' . $results['pseudo'] . '</a>
          <a href="avertissement.php?id=' . $results['id'] . '"><button>avertissement</button></a>
          <a href="suspendre.php?id=' . $results['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir suspendre cet utilisateur ?\')"><button>suspendre</button></a>
          <a href="supprimer.php?id=' . $results['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')"><button>supprimer</button></a></p><br>';
									
}
?>

</main>

</body>
</html>