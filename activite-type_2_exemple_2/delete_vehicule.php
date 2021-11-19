<?php

    // Vérification de l'id
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = htmlentities($_GET['id']);

        // appel du config_db
        include 'config/config_db.php';

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

        // requête de supression
        $reqSuppr = $bdd->prepare('DELETE FROM vehicule WHERE id_vehicule=:vid');
        $reqSuppr->execute([
            'vid' => $id
        ]);

        header("location:vehicule.php?feedback=deleted");
        // fermeture du curseur
        $reqSuppr->closeCursor();
    }
    else
    {
        die('Erreur à la supression, ID inconnu');
    }