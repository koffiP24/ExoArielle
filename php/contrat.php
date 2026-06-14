<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stockage et negoce</title>
    <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/contrat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />

</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenu">
        <center>
       <fieldset class="formulaire">
        <legend>CONTRAT</legend>
        <form action="contrat.php" method="POST">
            <table cell-padding="5" coll-padding="5">
                <tr>
                    <td>DATE DE SIGNATURE</td>
                    <td><input type="date" name="datecontrat"></td>
                </tr>
                <tr>
                    <td>ECHEANCE</td>
                    <td><textarea name="echeContrat" rows="4" cols="20" ></textarea></td>
                </tr>
                <tr>
                    <td>QUANTITE LIVREE</td>
                    <td><input type="number" name="qtlivContrat"></td>
                </tr>
                <tr>
                    <td>DATE DE LIVRAISON</td>
                    <td><input type="date" name="datelivContrat"></td>
                </tr>
                <tr>
                    <td>IDENTIFIANT DU NEGOCIANT</td>
                    <td><input type="text" name="idNegociant"></td>
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

        // connexion à la bd
        $bd = mysqli_connect("localhost", "root", "", "bd_viticole");

        if (isset($_POST['datecontrat']) && isset($_POST['echeContrat']) && isset($_POST['qtlivContrat']) && isset($_POST['datelivContrat']) && isset($_POST['idNegociant']))
        {
            $datecontrat = $_POST['datecontrat'];
            $echeContrat = $_POST['echeContrat'];
            $qtlivContrat = $_POST['qtlivContrat'];
            $datelivContrat = $_POST['datelivContrat'];
            $idNegociant = $_POST['idNegociant'];

            if ($bd)
            {
                echo "connexion etablie";
                // requête d'insertion dans la bd
                $sql = "INSERT INTO contrat (datecontrat, echeContrat, qtlivContrat, datelivContrat, idNegociant)
                    VALUES('$datecontrat', '$echeContrat', '$qtlivContrat', '$datelivContrat', '$idNegociant')";

                $exe = mysqli_query($bd, $sql);
                if ($exe) {
                    echo "felicitation";
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