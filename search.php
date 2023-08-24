<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require('includes/db.php');

$q = "SELECT id, name FROM animes WHERE name LIKE ?";
$req = $bdd->prepare($q);
$string = '%' . $_GET['value'] . '%';
$req->execute([$string]);

$res = $req->fetchAll();
if ($res) {
    echo '<table>';
    echo '<tr>';
    echo '<br>';
    echo '</tr>';
    foreach ($res as $key => $value) {
        echo '<tr>';
        echo '<td><a href="anime_template.php?anime=' . $value['id'] . '" target="_blank" class="list-group-item-action p-2">' . $value['name'] . '</a></td>';
        echo '</tr>';

    }
    echo '</table>';
} else {
    echo '<a href="#" class="list-group-item-action p-2">Aucun résultat trouvé</a>';
}

// Faut qu'il y ait des pages qui recense les infos de chaque animé. ligne l21 il faut des fichiers nommés par anime

