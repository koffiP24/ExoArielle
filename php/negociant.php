<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEGOCIANT</title>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/negociant.css">
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
        <legend>NEGOCIANT</legend>
        <form action="negociant.php" method="POST">
            <table cell-padding="5" coll-padding="5">
                <tr>
                    <td>IDENTIFIANT</td>
                    <td><input type="text" name="idNegociant"></td>
                </tr>
                <tr>
                    <td>NOM</td>
                    <td><input type="text" name="nom"></td>
                </tr>
                <tr>
                    <td>PRENOM</td>
                    <td><input type="text" name="prenom"></td>
                </tr>
                <tr>
                    <td>TELEPHONE</td>
                    <td><input type="text" name="tel"></td>
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

        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel']) && isset($_POST['idNegociant']))
        {
            
            $idNegociant = $_POST['idNegociant'];
            $nomNegociant = $_POST['nom'];
            $preNegociant = $_POST['prenom'];
            $telNegociant = $_POST['tel'];

            if ($bd)
            {
                echo "connexion etablie";
                // requête d'insertion dans la bd
                $sql = "INSERT INTO negociant (idNegociant, nomNegociant, preNegociant, telNegociant)
                    VALUES('$idNegociant', '$nomNegociant', '$preNegociant', '$telNegociant')";

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