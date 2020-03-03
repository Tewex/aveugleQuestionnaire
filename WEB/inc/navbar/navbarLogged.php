<div class="container-fluid mb-5 text-light" style="background-color: #397367;">
    <nav class="container navbar navbar-expand">
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <h4><a class="nav-link text-light" href="">Bonjour <?= $_SESSION["pseudo"];?></a></h4>
            </li>
        </ul>
        <span class="navbar-text">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <h5><a class="nav-link text-light" href=".\classement.php">Classement</a></h5>
            </li>
            <li class="nav-item">
                <h5><a class="nav-link text-light" href=".\question.php">Jouer</a></h5>
            </li>
            <li class="nav-item">
                <h5><a class="nav-link text-light" href=".\logout.php">Déconnexion</a></h5>
            </li>
            </ul>
        </span>
        </div>
    </nav>
</div>

