<?php

    include 'config/config_db.php';

    // récupération des données
    if(isset($_POST['mark']) && isset($_POST['model']) && isset($_POST['color']) && isset($_POST['imat']) && !empty($_POST['mark']) && !empty($_POST['model']) && !empty($_POST['color']) && !empty($_POST['imat']))
    {
        // nettoyage des données
        $new_mark = htmlentities($_POST['mark']);
        $new_model = htmlentities($_POST['model']);
        $new_color = htmlentities($_POST['color']);
        $new_imat = htmlentities($_POST['imat']);

        print_r($new_mark.$new_model.$new_color.$new_imat);
        
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

        // requête de modification
        $reqModif = $bdd->prepare('UPDATE vehicule SET marque=:marque, modele=:modele, couleur=:couleur, immatriculation=:immatriculation WHERE id_vehicule=:vid');
        $reqModif->execute([
            'marque' => $new_mark,
            'modele' => $new_model,
            'couleur' => $new_color,
            'immatriculation' => $new_imat,
            'vid' => $_GET['id'],
        ]);

        // fermeture du curseur
        $reqModif->closeCursor();

        // redirection vers conducteur.php après l'enregistrement
        header("location:vehicule.php?feedback=modified");

    }
    else
    {
        echo "Attention, tous les champs sont obligatoires !";
        die();
    }