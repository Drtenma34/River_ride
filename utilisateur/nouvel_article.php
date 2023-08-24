<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nouvel article</title>
</head>
<body>
<form method="POST"  action="verif_article.php" >

	<input type="text"  name="title"  placeholder="titre" value="<?php echo $title_w; ?>"><br>

	<textarea name="content" placeholder="contenu de l'article" value="<?php echo $content_w; ?>"></textarea><br>

	<input type="submit" name="submit" value="Publier"><br>

</form> <br> 
<?php
if (isset($_GET['erreur'])) {
    $erreur = $_GET['erreur'];
    
    echo $erreur;

    $title_w =isset($_GET['title']) ? $_GET['title']:'';
    $content_w =isset($_GET['content']) ? $_GET['content']:'';

}
?>



</body>
</html>


			 	 
				
				
			 			
