<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVRAISON</title>
    <link rel="stylesheet" href="../style/livraison.css">
    <link rel="stylesheet" href="../style/global.css">
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

    <footer class="footer">
        <div class="footers">
            <p><strong>Nos contacts 👉👉</strong></p>
            <p><strong>téléphone :</strong></p>
            <p>+225 05 55 88 45 24</p>
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