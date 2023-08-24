<?php

$db_server="51.178.29.98";
$db_user="ecole";
$db_pass="ecole";
$db_name="projet";
$conn=NULL;
$bdd;


   try {
    $bdd = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die;
} 

?> 

