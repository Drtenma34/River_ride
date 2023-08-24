<?php 
session_start();
include('database.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liste des forums</title>
</head>
<body>


<?php

	$category_id=$_GET['category'];

	$req= $bdd->prepare('SELECT * FROM category WHERE id=:id');
	$req->execute(array('id' => $category_id));

	$results=$req->fetch();

if($results){

	echo '<h1>'. $results['name'] .'</h1>';
	echo '<a href="nouveau_forum.php"> créer un forum</a><br>';

	$req=$bdd->prepare('SELECT * FROM forum WHERE category_id=:category_id');
	$req->execute(array('category_id' => $category_id));

	while($results=$req->fetch()){
		

		echo	'<div>';
		echo    '<a href="forum.php?forum='.urlencode($results['name']).'">'.$results['name'].'</a>';
		echo    '<p>'. $results['description'] .'</p>';
        echo    '</div>';


	}


} else{

	echo "Cette catégorie n'a pas été trouvé.";
}


?>
</body>
</html>