<?php 
session_start();
include("database.php");?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thèmes</title>
</head>
<body>

<?php 

$req=$bdd->query('SELECT * FROM category');
while($results=$req->fetch()){
	$category_id=$results['id'];
	$category_name=$results['name'];
?>

	<div> 
		<?= '<a href="liste_forum.php?category='.urlencode($category_id).'">'.$category_name. '</a><br>';?>
	</div>

<?php
}

?>

</body>
</html>