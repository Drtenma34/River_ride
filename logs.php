<?php
/*

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if (isset($_SESSION['email'])) {

    $ip = getIp();
    $date = Date('Y-m-d');
    $heure = Date("H:i:s");
    $page = "Activites";

    $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
    $req = $db->prepare($q);
    $reponse = $req->execute([
        'page' => $page,
        'date' => $date,
        'heure' => $heure,
        'ip' => $ip
    ]);

}
*/
