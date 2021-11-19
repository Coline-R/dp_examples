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
 
    // REQUETES
    $donnees = $bdd->query("SELECT * FROM vehicule");
    $reqNbr = $bdd->query("SELECT COUNT(*) FROM vehicule");
    $nbr_vehicule = $reqNbr->fetch();
    

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

            <?php bddFeedback(); ?>

            <!-- formulaire d'ajout de données -->
            <h2>Ajout d'un véhicule</h2>
            <form action="save_vehicule.php" method="post">
                <div class="mb-3">
                    <label for="mark" class="form-label">Marque</label>
                    <input type="text" class="form-control" id="mark" name="mark" required />
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Modèle</label>
                    <input type="text" class="form-control" id="model" name="model" required />
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Couleur</label>
                    <input type="text" class="form-control" id="color" name="color" required />
                </div>
                <div class="mb-3">
                    <label for="imat" class="form-label">Immariculation</label>
                    <input type="text" class="form-control" id="imat" name="imat" required />
                </div>
                <button type="submit" class="btn btn-dark">Enregistrer</button>
            </form>

            <!-- tableau des données dejà présentes dans la bdd-->
            <section class="mt-5">
                <h2>Liste des Véhicules</h2>
                <p>Il y a actuellement <?php echo $nbr_vehicule[0]; ?> véhicules dans la base</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marque</th>
                            <th scope="col">Modèle</th>
                            <th scope="col">Couleur</th>
                            <th scope="col">Immatriculation</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- affichage de la liste de véhicules avec les données récupérées en BDD -->
                        <?php while($vehicules = $donnees->fetch()): ?>
                            <tr>
                                <td><?php echo $vehicules['id_vehicule']; ?></td>
                                <td><?php echo $vehicules['marque']; ?></td>
                                <td><?php echo $vehicules['modele']; ?></td>
                                <td><?php echo $vehicules['couleur']; ?></td>
                                <td><?php echo $vehicules['immatriculation']; ?></td>
                                <td>
                                    <a class="btn btn-outline-dark mt-auto btn-sm" href="form_modif_vehicule.php?id=<?php echo $vehicules["id_vehicule"]; ?>">Modification</a>
                                    <a class="btn btn-outline-danger mt-auto btn-sm" onclick="return confirm('Etes vous sûr de vouloir supprimer le véhicule ?')" href="delete_vehicule.php?id=<?php echo $vehicules["id_vehicule"]; ?>">Supression</a>
                                </td>
                            </tr>
                        <?php 
                            endwhile;
                            // fermeture du curseur
                            $donnees->closeCursor();
                            $reqNbr->closeCursor();
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
        
        <!-- Scripts -->
        <!-- bootstrap script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>