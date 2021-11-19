<?php

    // connexion à la base de données
    $conn = new PDO("mysql:host=localhost:3306;dbname=formation_tp", "root", "");

    // Récupération des données nécessaires dans la base de données
    $req_take = $conn->prepare("SELECT * FROM experiences ORDER BY date DESC"); // J'ai choisi de trier les expériences par dates décroissantes, comme on le voit dans les CV par exemple.
    $req_take->execute();

    $experiences = $req_take->fetchAll();

    // Fermeture de la connexion à la base de données
    $conn = null;

