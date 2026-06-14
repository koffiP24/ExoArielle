<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stockage et negoce</title>
    <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/contrat.css">

</head>
<body>

    <header class="entete">
        <div class="contenu-entete">

            <nav class="menu">
                <a href="accueil.php">ACCEUIL</a>
                <a href="#">CEPAGE</a>
                <a href="#">CUVE</a>
                <a href="#">NEGOCIANT</a>
                <a href="#">CONTRAT</a>
            </nav>
        </div>
    </header>

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

    <footer class="footer">
        <div class="footers">
            <p><strong>Nos contacts 👉👉</strong></p>
            <p><strong>téléphone :</strong></p>
            <p>+225 05 66 95 96 25</p>
        </div>
        <div class="footers">
            <p><strong>adresse email :</strong></p>
            <p>info@stocketnegoce.com</p>
            <p><strong>WHATSAPP :</strong></p>
            <p>+225 07 12 17 13 25</p>
        </div>
    </footer>

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