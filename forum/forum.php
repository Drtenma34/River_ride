<?php
session_start();
 include("database.php");?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<main>

	<?php

	$forum_name=$_GET['forum'];

	$req= $bdd->prepare('SELECT * FROM forum WHERE name=:name');
	$req->execute(array('name' => $forum_name));

	$results=$req->fetch();

if($results){

	echo '<h1>'. $results['name'] .'</h1>';

	echo '<a href="nouveau_post.php"> créer un post</a><br>';


	$req=$bdd->prepare('SELECT * FROM post WHERE forum_name=:forum_name');
	$req->execute(array('forum_name' => $forum_name));

	while($results=$req->fetch()){
		

		echo	'<div>';
		echo    '<a href="forum.php?forum='.urlencode($results['user_pseudo']).'">'.$results['user_pseudo'].'</a>';
		echo    '<p>'. $results['content'] .'</p>';
        echo    '</div>';


	}


} else{

	echo "Ce forum n'a pas été trouvé.";
}


?>

</main>
</body>
</html>