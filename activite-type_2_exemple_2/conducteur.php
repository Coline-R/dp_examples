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
    $donnees = $bdd->query("SELECT * FROM conducteur");
    $reqNbr = $bdd->query("SELECT COUNT(*) FROM conducteur");
    $nbr_conducteur = $reqNbr->fetch();    

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

            <?php bddFeedback(); ?>

            <!-- formulaire d'ajout de données -->
            <h2>Ajout d'un conducteur</h2>
            <form action="save_conducteur.php" method='post'>
                <div class="mb-3">
                    <label for="first-name" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" required />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required />
                </div>
                <button type="submit" class="btn btn-dark">Enregistrer</button>
            </form>

           <!-- tableau des données dejà présentes dans la bdd-->
           <section class="mt-5">
                <h2>Liste des conducteurs</h2>
                <p>Il y a actuellement <?php echo $nbr_conducteur[0]; ?> conducteurs dans la base</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- affichage de la liste de véhicules avec les données récupérées en BDD -->
                        <?php while($conducteurs = $donnees->fetch()): ?>
                            <tr>
                                <td><?php echo $conducteurs['id_conducteur']; ?></td>
                                <td><?php echo $conducteurs['prenom']; ?></td>
                                <td><?php echo $conducteurs['nom']; ?></td>
                                <td>
                                    <a class="btn btn-outline-dark mt-auto btn-sm" href="form_modif_conducteur.php?id=<?php echo $conducteurs["id_conducteur"]; ?>">Modification</a>
                                    <a class="btn btn-outline-danger mt-auto btn-sm" onclick="return confirm('Etes vous sûr de vouloir supprimer le conducteur ?')" href="delete_conducteur.php?id=<?php echo $conducteurs["id_conducteur"]; ?>">Supression</a>
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