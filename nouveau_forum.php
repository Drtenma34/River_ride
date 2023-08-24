
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



<form  method="POST"action="verif_forum.php">
	
<input type="text" name="name" placeholder="nom du forum"><br>
<input type="text" name="description"><br>
<input type="submit" name="submit" value="créer"><br>
</form>

</body>
</html>