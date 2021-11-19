<?php

    session_start();

    include 'config/config_db.php';

    // Vérification des données
    if(isset($_POST['email']) && isset($_POST['passwd']) && !empty($_POST['email']) && !empty($_POST['passwd']))
    {
        // nettoyage des données
        $email = htmlentities($_POST['email']);
        $pswd = htmlentities($_POST['passwd']);

        // CONNEXION BDD
        try
        {
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $bdd = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', USER, PSWD, $options);
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }

        // Requête pour savoir si l'utilisateur est bien dans la base de données
        $user = $bdd->prepare("SELECT * from utilisateurs WHERE email = :email AND password = :password ");
        $user->execute(array(
            'email' => $email,
            'password' => $pswd,
        ));

        $utilisateur = $user->fetch();

        // Si l'utilsiateur existe, on créé une session sinon on le redirige vers la page de connexion
        if($utilisateur)
        {
            $_SESSION['user'] = $utilisateur;
            header("location:conducteur.php");
        }
        else{
            header("location:index.php");
        }

        // fermeture du curseur
        $user->closeCursor();

    }
    else
    {
        die("Attention, tous les champs sont obligatoires !");
    }