

<?php 
session_start();

if(isset($_POST['case1'])) {
     
     $description=$_POST['description'];
     $maxcharactere= 100;

     if (empty($_POST['description'])) {

     	echo "La description est obligatoire.";
     	
     }

	elseif(isset($_POST['description']) && strlen($description) > $maxcharactere){

		echo "La description dépasse les 100 charactères autorisés! ";

	} 


 elseif (empty($_FILES['preuve']['name']) || $_FILES['preuve']['error'] !== UPLOAD_ERR_OK) {
        echo "Veuillez joindre une preuve adéquate.";
    } else {
        $autorisation = array('image/jpeg', 'image/png', 'application/pdf');
        $typefichier = $_FILES['preuve']['type'];
        
        if (in_array($typefichier, $autorisation)) {
            // Le type de fichier est autorisé, vous pouvez procéder au traitement du fichier
            echo "Votre signalement a bien été pris en compte. Nous le traiterons rapidement !";
        } else {
            echo "Erreur : Le type de fichier n'est pas autorisé.";
        }
    }
} else {
    echo "Une erreur est survenue lors du signalement. Veuillez réessayer.";
}
?>
