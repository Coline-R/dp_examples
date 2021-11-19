<?php

    // Fermeture et destruction de session utilisateur à la deconnexion et redirection vers la page de connexion
    session_start();
    session_unset();
    session_destroy();
    header("location:index.php");