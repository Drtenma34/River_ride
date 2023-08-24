<?php
if (isset($_GET["key"])){
    $key = intval($_GET["key"]);

    include("includes/db.php");

    $q = 'SELECT * FROM users WHERE confirmed_key = ?'; //  ?  sera remplacé $email
    $req = $bdd->prepare($q);
    $req->execute([$key]);

    $user_exist = $req->rowCount(); //renvoie le nb de lignes où la clé de confirmation est égale à $key
    if($user_exist == 1){
        $data = $req->fetch(PDO::FETCH_ASSOC);
        //var_dump($data);
        if($data["is_valid"] == 0){
            $update_user = $bdd ->prepare("UPDATE users SET is_valid = 1 WHERE confirmed_key= ?");
            $update_user -> execute([$key]);

            header('location: connexion.php?message=compte confirmé, vous pouvez vous connecter');

        }
        else{

            header('location: connexion.php?message=cet utilisateur a déjà été vérifié');
            exit;
        }
    }
}
?>
