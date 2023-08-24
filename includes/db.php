<?php

try {
    $bdd = new PDO(
        'mysql:host=5.196.27.192; 
        dbname=Riverride',
        'root',
        'MysqlRootRiverSide',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die($e->getMessage());
}