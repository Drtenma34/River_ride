<?php

session_start();
include ('includes/db.php');
require('fpdf/fpdf.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté.
    header("Location: connexion.php?message=Il faut vous connecter pour imprimer un pdf");
    exit;
}

// Récupérez l'utilisateur actuellement connecté
$userStmt = $bdd->prepare("SELECT * FROM users WHERE id = :id");
$userStmt->execute([':id' => $_SESSION['id']]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Créez un nouveau document PDF
$pdf = new FPDF();
$pdf->AddPage();

// Ajoutez le nom de l'utilisateur au document
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Animes de ' . $user['pseudo'], 0, 1);

// Récupérez tous les animes que l'utilisateur aime
$animesStmt = $bdd->prepare("SELECT a.* FROM animes a JOIN user_likes_anime u ON a.id = u.anime_id WHERE u.user_id = :id");
$animesStmt->execute([':id' => $user['id']]);

while ($anime = $animesStmt->fetch(PDO::FETCH_ASSOC)) {
    // Ajoutez le nom de l'anime au document
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, $anime['name'], 0, 1);

    // Ajoutez le synopsis de l'anime au document
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, $anime['synopsis']);

    // Ajoutez le lien du trailer de l'anime au document
    $pdf->SetFont('Arial', 'U', 12);
    $pdf->Cell(0, 10, $anime['trailer'], 0, 1, 'R');

    // Ajoutez une ligne vide pour la séparation
    $pdf->Cell(0, 10, '', 0, 1);
}

// Affichez le document PDF dans le navigateur
$pdf->Output('I', 'animes_de_' . $user['pseudo'] . '.pdf');

// Fermez la connexion à la base de données
$bdd = null;

?>