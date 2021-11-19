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

    // REQUETE, récupération des données du conducteur concerné via l'id
    $donnees = $bdd->prepare("SELECT * FROM conducteur WHERE id_conducteur=:cid");
    $donnees->execute(array("cid" => $_GET['id']));
    $conducteur = $donnees->fetch();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Conducteur</title>
        <!-- bootstrap link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <!-- HEADER -->
        <?php include 'includes/_header.php'; ?>

        <!-- MAIN -->
        <div class="container">
            <h1>Conducteur</h1>
            <!-- formulaire de modifications de données -->
            <h2>Modification d'un conducteur</h2>
            <form action="form_modif_conducteur_save.php?id=<?php echo $conducteur['id_conducteur'] ?>" method="post">
                <div class="mb-3">
                    <label for="first-name" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" required value="<?php echo $conducteur['prenom'] ?>" />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo $conducteur['nom'] ?>" />
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

