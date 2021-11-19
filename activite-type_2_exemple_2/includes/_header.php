<header>
    <nav>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="conducteur.php">Conducteurs</a>
            </li>
             <li class="nav-item">
                 <a class="nav-link" href="vehicule.php">Véhicules</a>
            </li>
            <li class="nav-item">
                <?php if(isset($_SESSION['user'])) { ?>
                    <a class="nav-link" href="logout.php">Se deconnecter</a>
                <?php } ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>