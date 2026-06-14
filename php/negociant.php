<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEGOCIANT</title>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/negociant.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>

<body>

    <?php include 'header.php'; ?>

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
                    <div clas="lesButton">
                        <button type="submit" name="enregistrer" class="enr">enregistrer</button>
                        <button class="ann">annuler</button>
                    </div>
                </form>
            </fieldset>
        </center>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>

<?php

if (isset($_POST['enregistrer'])) {

    // connexion à la bd
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel']) && isset($_POST['idNegociant'])) {

        $idNegociant = $_POST['idNegociant'];
        $nomNegociant = $_POST['nom'];
        $preNegociant = $_POST['prenom'];
        $telNegociant = $_POST['tel'];

        if ($bd) {
            echo "connexion etablie";
            // requête d'insertion dans la bd
            $sql = "INSERT INTO negociant (idNegociant, nomNegociant, preNegociant, telNegociant)
                    VALUES('$idNegociant', '$nomNegociant', '$preNegociant', '$telNegociant')";

            $exe = mysqli_query($bd, $sql);
            if ($exe) {
                echo " felicitation";
            } else {
                echo "erreur sql";
            }
        } else {
            echo "connexion echouée";
        }
    }
}



?>