<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUVE</title>
    <link rel="stylesheet" href="../style/cuve.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body>

    <?php include 'header.php'; ?>

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

    <?php include 'footer.php'; ?>

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