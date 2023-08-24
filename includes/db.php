<?php

try {
    $bdd = new PDO(
        'mysql:host=51.178.29.98; 
        dbname=projet',
        'root',
        'mysql_root_mdp',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die($e->getMessage());
}