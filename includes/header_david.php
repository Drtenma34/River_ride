<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="index.php">
            <img src="images/image_identification.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="ml-2 text-uppercase">RIVER RIDE</span>
        </a>
        <button class="navbar-toggler" type="button" id="navbarToggler" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto" id="navbarList">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="captcha/captcha.php">Inscription</a>
                </li>
            </ul>
            <?php
            // On vérifie si l'utilisateur est connecté
            if(isset($_SESSION['id'])) {
                echo "<ul class='navbar-nav ml-auto '>
                        <li class='nav-item dropdown' id='navbarDropdown'>
                            <div class='w-100 text-right'> 
                                <span style='color:green'>Connecté</span>
                                <span class='ml-2'>".$_SESSION['pseudo']."</span>
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
    </nav>
</header>
