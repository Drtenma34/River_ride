<?php

include("phpmailer.php");
sendmail("coucou", "Premier test" ,"david_vu_cong@outlook.fr");

header("location: ../connexion.php");
?>
