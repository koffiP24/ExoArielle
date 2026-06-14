<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVRAISON</title>
    <link rel="stylesheet" href="../style/livraison.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenu">
        <center>
       <fieldset class="formulaire">
        <legend>LIVRAISON</legend>
        <form action="livraison.php" method="POST">
            <table cell-padding="5" coll-padding="5">
                <tr>
                    <td>NUMERO DE LIVRAISON</td>
                    <td><input type="text" name="numLivraison "></td>
                </tr>
                <tr>
                    <td>DATE REEL LIVRAISON</td>
                    <td><input type="date" name="datereelLivraison"></td>
                </tr>
                
            </table>
            <div clas = "lesButton">
                <button type="submit" name="enregistrer" class="enr" >enregistrer</button>
                <button class="ann" >annuler</button>
            </div>
        </form>
       </fieldset>
       </center>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>

<?php

    if (isset($_POST['enregistrer'])) 
    {
        echo "enregistrer existe";
        // connexion à la bd
        $bd = mysqli_connect("localhost", "root", "", "bd_viticole");

        if (isset($_POST['numLivraison']) && isset($_POST['datereelLivraison']))
        {
            $numLivraison = $_POST['numLivraison'];
            $datereelLivraison = $_POST['datereelLivraison'];

            echo "tout est clean ";

            if ($bd)
            {
                echo "connexion etablie";
                // requête d'insertion dans la bd
                $sql = "INSERT INTO livraison (numLivraison, datereelLivraison)
                    VALUES('$numLivraison', '$datereelLivraison')";

                $exe = mysqli_query($bd, $sql);
                if ($exe) {
                    echo " felicitation";
                }
                else {
                    echo "erreur sql";
                }

            }
            else
            {
                echo "connexion echouée";
            }
        }
        
    }

    

?>