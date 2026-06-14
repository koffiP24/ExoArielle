<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUVE</title>
    <link rel="stylesheet" href="../style/cuve.css">
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
        <legend>CUVE</legend>
        <form action="cuve.php" method="POST">
            <table cell-padding="5" coll-padding="5">
                <tr>
                    <td>LETTRE D'IDENTIFICATION</td>
                    <td><input type="text" name="letCuve"></td>
                </tr>
                <tr>
                    <td>CAPACITE DE STOCKAGE</td>
                    <td><input type="number" name="capCuve"></td>
                </tr>
                <tr>
                    <td>IDENTIFIANT CEPAGE</td>
                    <td><input type="text" name="idCepage"></td>
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

        if (isset($_POST['letCuve']) && isset($_POST['capCuve']) && isset($_POST['idCepage']))
        {
            $letCuve = $_POST['letCuve'];
            $capCuve = $_POST['capCuve'];
            $idCepage = $_POST['idCepage'];

            if ($bd)
            {
                echo "connexion etablie";
                // requête d'insertion dans la bd
                $sql = "INSERT INTO cuve (letCuve, capCuve, idCepage)
                    VALUES('$letCuve', '$capCuve', '$idCepage')";

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