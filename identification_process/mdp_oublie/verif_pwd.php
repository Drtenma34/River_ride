<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Email de confirmation

// On récupère la clé et on vérifie les trucs bizarres

if (isset($_GET['key'])) {

    $key = $_GET['key'];

    include("../../includes/db.php");

    $requser = $bdd->prepare("SELECT * FROM users WHERE confirmed_key = ?");

    $requser->execute([$key]);

    $userexists = $requser->rowCount();
    }


// UPDATE de la table SI l'utilisateur existe


    if ($userexists != 1) {
        header("location: ../connexion.php?message=mail de vérification invalide");
        exit;

} else {
    include("../../includes/head.php");
    // header("location: ../index.php");
}
?>

<main class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Réinitialiser le mot de passe</h5>
                        <form action="update_pwd.php" method="POST">
                            <?php
                            // Utilisation de la fonction showMessage pour afficher les messages
                            if (isset($_GET['message'])) {
                                showMessage($_GET['message']);
                            }
                            ?>
                            <div class="form-group">
                                <input type="password" class="form-control" name="pwd" placeholder="Votre mot de passe">
                            </div>
                            <input type="hidden" name="key" value="<?= $_GET['key'] ?? ''; ?>">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>