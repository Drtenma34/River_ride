<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/chateau.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="ml-2 text-uppercase">RIVER RIDE</span>
            </a>
            <button class="navbar-toggler" type="button" id="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto" id="navbarList">
                    <li class="nav-item active">
                        <a class="nav-link" href="identification_process/connexion.php">Connexion</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="identification_process/inscription.php">Inscription</a>
                    </li>
                    <?php if ($userId !== null) : ?>
                        <!-- ne s'affiche pas si aucun user connecté -->
                    <!--<li class="nav-item active">
                        <a class="nav-link" href="print_pdf.php">Fiche pdf</a>
                    </li>-->
                    <?php endif; ?>
                </ul>

                <?php
                // On vérifie si l'utilisateur est connecté
                if(isset($_SESSION['id'])) {
                    echo "<ul class='navbar-nav ml-auto'>
                            <li class='nav-item dropdown' id='navbarDropdown'>
                                <div class='w-100 text-right'>
                                    <span style='color:green'>Connecté</span>
                                   
                                    <span class='ml-2'>".$_SESSION['email']."</span>
                                </div>
                                <div class='dropdown-menu' id='dropdownMenu'>
                                    <a class='dropdown-item' href='profile.php'>Mon Profil</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='deconnexion.php'>Déconnexion</a>
                                </div>
                            </li>
                        </ul>";
                }
                ?>
            </div>
            <!--Barre AJAX-->
            <?php
            include ("includes/db.php");
            ?>
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="form">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control form-input" placeholder="Chercher un anime" id="search" oninput="search()">
                    <div class="list-group list-group-item-action" id="content">
                    </div>
                </div>
            </div>
            <!--Barre AJAX-->
        </div>
    </nav>
</header>

