<?php
include ("includes/head.php");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo Anisite.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Anisite
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Seasons
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach($seasons as $season): ?>
                            <li><a class="dropdown-item" href="?season=<?php echo $season['name']; ?>"><?php echo $season['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>















        </div>
    </div>
</nav>



