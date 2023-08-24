
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signaler un compte</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/css_projet.css">
</head>

<body>
	<div class="text-center mb-3">
	<h1 > Signaler </h1>
</div>
	<div class="container  ml-2">
<div class= " row col-md-9">
	<p> Pour quelle raison signalez-vous @utilisateur? </p>
	<p> Votre signalement aide à la préservation de la sécurité sur le site. La personne à l'origine du contenu ne sera pas informée de l'envoi du signalement. Après examination, nous prendrons les mesures nécessaires.  </p>

<form method="POST"  action="verif_signalement.php" enctype="multipart/form-data">

	<p class="fw-bold">Harcèlement</p>
	
	<input type="radio" id="case1" name="case1" value="valeur1">
  	<label for="case1">Cette personne m'harcèle ou me menace</label><br> 

  	<input type="radio" id="case1" name="case1" value="valeur1">
 	 <label for="case1">Cette personne harcèle ou menace un autre utilisateur</label><br>
 	
	<p class="fw-bold">Contenus ou posts inappropriés</p>
	 <input type="radio" id="case1" name="case1" value="valeur1">
 	 <label for="case1">Cet utilisateur publie des contenus à caractère sexuel</label><br> 

	<input type="radio" id="case1" name="case1" value="valeur1">
  <label for="case1">Cet utilisateur me menace sexuellement</label><br>

  <input type="radio" id="case1" name="case1" value="valeur1">
  <label for="case1">Cette personne menace sexuellement un autre utilisateur</label><br>
	

	<p class="fw-bold"> Autres</p>
	<input type="radio" id="case1" name="case1" value="valeur1">
  <label for="case1">Partage de sites de stream illégaux</label><br>

  <input type="radio" id="case1" name="case1" value="valeur1">
  <label for="case1">Spoiler</label><br>
	
		 <div class="col-md-9 mt-4 mb-3 div_input">
		  <input type="text" name="description" placeholder="description de la situation" class="form-control hauteur_input border-secondary">
		 </div>
		 <input type="file" name="preuve" >
			    

 				<div class="news_form">
			        <input class="placehorder_form" type="submit" placeholder="s'inscrire" name="submit">
    			</div>
    	</form>

</div>
</body>
</html>