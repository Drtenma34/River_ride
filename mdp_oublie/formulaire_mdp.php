<?php
if (isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
}

$title = "Mdp oublié";
include("../includes/head.php");
?>

<body>
<main class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Envoyer le mail de réinitialisation</h5>


                        <form method="POST" action="envoi_mail_pwd_oublie.php">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Entrez votre email">
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>



