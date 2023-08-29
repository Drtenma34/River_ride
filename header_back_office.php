<?php $current_page = basename($_SERVER['REQUEST_URI']); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">River Ride</a>
        <a class="navbar-brand" href="#">- Back Office</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'manage_stages.php' ? 'active' : '') ?>" aria-current="page" href="manage_stages.php">Étapes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'manage_accommodations.php' ? 'active' : '') ?>" aria-current="page" href="manage_accommodations.php">Logements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'graph_resa.php' ? 'active' : '') ?>" href="graph_resa.php">Occupation des logements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'promos.php' ? 'active' : '') ?>" href="promos.php">Offres promotionnelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'manage_users.php' ? 'active' : '') ?>" href="manage_users.php">Utilisateurs</a>
                </li>

                <!-- Ajoutez d'autres liens de navigation si nécessaire -->
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
