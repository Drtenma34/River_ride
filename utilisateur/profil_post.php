<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Profil-Post </title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/css_projet.css">
</head>
	<body>
		
<header></header>

    <main class="container mx-0 flex-column">
		 
		<div  class="container col-md-12 mx-0 justify-content-center flex-column col-md-9" >

 	    <div  class=" row  w-100 div_recommandation_news  justify-content-center" >

			<div class= "col-md-2 bg-secondary div_utilisatuer rounded-top-pill mt-2 "> 
			
			<div class="col-md-2 bg-primary div_utilisateur" > <img  src="image_projet/DEKU.jfif"  alt="deku" class="img-fluid " ></div>

			<p> Utilisateur </p>

		 <a href="#"  >Mon activité </a>

		<div > 
			<a href="#"  class=" text-decoration-none ">Post </a><br>
			<a href="#" class="text-decoration-none"> Articles</a><br> 
		</div> 
		<a href="ma_liste.php" >Ma liste </a><br>
		 <a href="parametres.php" > Paramètres </a><br>
		 <a href="#"> Déconnexion</a><br>
		
			 </div>
			 <div class= "col-md-9  px-0" > 	
						<div class= "child-div  w-100">
							 
						</div>

			

						<div class= " bg-light w-100">
				
<div class="content_article">	
										<div><a href="#"> Nouvel article </a> </div>

										<div>
												<?php 
												$lien_article= "profil_post.php";
												$date_article = date('Y-m-d');
												$titre_article = "Titre de l'article";
												$article_content = "Contenu du post ";
												
												


												echo "<h6><a href='" . $lien_article . "'>" . $titre_article . "</a></h6>";
												echo "<h6>Date : " . $date_post . "</h6>";
												echo "<p>" . $article_content . "</p>";
													
													?>
											
										</div>

										<hr class="border-top border-dark border-1 ">
										<div>
												<?php
												echo "<h6><a href='" . $lien_article . "'>" . $titre_article . "</a></h6>";
												echo "<h6>Date : " . $date_post . "</h6>";
												echo "<p>" . $article_content . "</p>";
				              

												?>
										

										</div>
				

</div>

			 	 
				
				
			 			</div>
		</div>
</main>
	</body>
	</html>