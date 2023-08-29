<!DOCTYPE html>
<html>
<head>
    <title>Modification utilisateur - Back Office</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<?php include 'header_back_office.php'; ?>

<?php

session_start();

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: identification_process/connexion.php');
    exit;
}

include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'utilisateur
    $q = 'SELECT nom, prenom, phone, email FROM users WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute(array($id));
    $user = $req->fetch();

    // Si le formulaire est soumis, mettez à jour les informations
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $q = 'UPDATE users SET nom = ?, prenom = ?, phone = ?, email = ? WHERE id = ?';
        $req = $bdd->prepare($q);
        $req->execute(array($nom, $prenom, $phone, $email, $id));

        echo "<div class='alert alert-success'>Informations mises à jour avec succès.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID utilisateur manquant.</div>";
    exit;
}
?>

<form method="POST">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $user['nom'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $user['prenom'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Numéro de téléphone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

</body>
</html>

