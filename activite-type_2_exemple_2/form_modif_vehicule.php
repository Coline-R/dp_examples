<?php

    session_start();

    include 'config/config_db.php';
    include 'includes/_functions.php';

    isUserAdmin();

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

    // REQUETE, récupération des données du vehicule concerné via l'id
    $donnees = $bdd->prepare("SELECT * FROM vehicule WHERE id_vehicule=:vid");
    $donnees->execute(array("vid" => $_GET['id']));
    $vehicule = $donnees->fetch();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Véhicules</title>
        <!-- bootstrap link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <!-- HEADER -->
        <?php include 'includes/_header.php'; ?>

        <!-- MAIN -->
        <div class="container">
            <h1>Véhicule</h1>
            <!-- formulaire de modifications de données -->
            <h2>Modification d'un véhicule</h2>
            <form action="form_modif_vehicule_save.php?id=<?php echo $vehicule['id_vehicule'] ?>" method="post">
                <div class="mb-3">
                    <label for="mark" class="form-label">Marque</label>
                    <input type="text" class="form-control" id="mark" name="mark" required value="<?php echo $vehicule['marque'] ?>" />
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Modèle</label>
                    <input type="text" class="form-control" id="model" name="model" required value="<?php echo $vehicule['modele'] ?>" />
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Couleur</label>
                    <input type="text" class="form-control" id="color" name="color" required value="<?php echo $vehicule['couleur'] ?>" />
                </div>
                <div class="mb-3">
                    <label for="imat" class="form-label">Immariculation</label>
                    <input type="text" class="form-control" id="imat" name="imat" required value="<?php echo $vehicule['immatriculation'] ?>" />
                </div>
                <?php 
                    // fermeture du curseur
                    $donnees->closeCursor();
                ?>
                <button type="submit" class="btn btn-dark">Modifier</button>
            </form>
        </div>
        
        <!-- Scripts -->
        <!-- bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

