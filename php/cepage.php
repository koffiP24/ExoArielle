

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEPAGE</title>
    <link rel="stylesheet" href="../style/cepage.css">
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
        <legend>CEPAGE</legend>
        <form action="cepage.php" method="POST">
            <table>
                <tr>
                    <td>NOM DU CEPAGE </td>
                    <td><input type="text" name="nom" ></td>
                </tr>
                <tr>
                    <td>COULEUR</td>
                    <td><input type="text" name="couleur" ></td>
                </tr>
                <tr>
                    <td>TENEUR EN SUCRE</td>
                    <td><input type="number" name="sucre" ></td>
                </tr>
                <tr>
                    <td>REGION D'ORIGINE</td>
                    <td><input type="text" name="region" ></td>
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

        if (isset($_POST['nom']) && isset($_POST['couleur']) && isset($_POST['sucre']) && isset($_POST['region']))
        {
            $nomCepage = $_POST['nom'];
            $couleurCepage = $_POST['couleur'];
            $teneurSucre = $_POST['sucre'];
            $regionOrigine = $_POST['region'];

            if ($bd)
            {
                echo "connexion etablie";
                // requête d'insertion dans la bd
                $sql = "INSERT INTO cepage (nomCepage, couleurCepage, teneurSucre, regionOrigine)
                    VALUES('$nomCepage', '$couleurCepage', '$teneurSucre', '$regionOrigine')";

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