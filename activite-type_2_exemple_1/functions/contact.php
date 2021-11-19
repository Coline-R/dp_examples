<?php

    // Récupération des données envoyées par le formulaire
    $new_name = $_POST['nom'];
    $new_subject = $_POST['sujet'];
    $new_email = $_POST['email'];
    $new_message = $_POST['message'];

    // connexion à la base de données
    $conn = new PDO("mysql:host=localhost:3306;dbname=formation_tp", "root", "");

    // Ajout des données dans la base de données
    $req_add = $conn->prepare("INSERT INTO contact (nom, sujet, email, message) VALUES (:nom, :sujet, :email, :message)");
    $req_add->bindParam(':nom', $new_name);
    $req_add->bindParam(':sujet', $new_subject);
    $req_add->bindParam(':email', $new_email);
    $req_add->bindParam(':message', $new_message);
    $req_add->execute();

    // Fermeture de la connexion à la base de données
    $conn = null;

    // Redirection vers la page contact
    header('Location: ../index.php');