<?php 
session_start();
include("database.php");

$title="";
$content="";

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];

    $req = $bdd->prepare('SELECT * FROM article WHERE id=?');
    $req->execute(array($getid));

    if($req->rowCount() > 0){
        $article = $req->fetch();
        $title = $article['title'];
        $content = $article['content'];

        if(isset($_POST['submit'])){
        	$newtitle=htmlspecialchars($_POST['title']);
        	$newcontent=nl2br(htmlspecialchars($_POST['content']));

        	$req= $bdd->prepare('UPDATE article SET title=?, content=? WHERE id=?');
        	$req->execute(array($newtitle, $newcontent, $getid));
        	header('location:mes_article.php');
        	exit();
        }
    } else {
        echo "Aucun article trouvé.";
    }
} else {
    echo "L'identifiant de l'article n'a pas pu être récupéré.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier article</title>
</head>
<body>

<form method="POST" action="verif_article.php">

    <input type="text" name="title" placeholder="Titre" value="<?php echo $title; ?>"><br>

    <textarea name="content" placeholder="Contenu de l'article"><?php echo $content; ?></textarea><br>

    <input type="submit" name="submit" value="Publier"><br>

</form>

</body>
</html>