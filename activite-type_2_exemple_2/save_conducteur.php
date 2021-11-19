<?php

    include 'config/config_db.php';

    // récupération des données
    if(isset($_POST['first-name']) && isset($_POST['name']) && !empty($_POST['first-name']) && !empty($_POST['name']))
    {
        // nettoyage des données
        $new_first_name = htmlentities($_POST['first-name']);
        $new_name = htmlentities($_POST['name']);
        
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

        // requête d'insertion
        $reqInsert = $bdd->prepare('INSERT INTO conducteur(nom, prenom) VALUES(:nom, :prenom)');
        $reqInsert->execute([
            'nom' => $new_name,
            'prenom' => $new_first_name,
        ]);

        // fermeture du curseur
        $reqInsert->closeCursor();

        // redirection vers conducteur.php après l'enregistrement
        header("location:conducteur.php?feedback=added");

    }
    else
    {
        echo "Attention, tous les champs sont obligatoires !";
        die();
    }