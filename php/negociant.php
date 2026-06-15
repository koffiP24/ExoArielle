<?php
// Chargement des fonctions d'authentification et vérification de connexion
require_once __DIR__ . "/auth.php";
requireUser();

// Traitement de l'enregistrement d'un négociant
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enregistrer'])) {
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($bd && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel']) && isset($_POST['idNegociant'])) {
        // Sécurisation des entrées et insertion en base de données
        $idNegociant = mysqli_real_escape_string($bd, $_POST['idNegociant']);
        $nomNegociant = mysqli_real_escape_string($bd, $_POST['nom']);
        $preNegociant = mysqli_real_escape_string($bd, $_POST['prenom']);
        $telNegociant = mysqli_real_escape_string($bd, $_POST['tel']);
        $sql = "INSERT INTO negociant (idNegociant, nomNegociant, preNegociant, telNegociant) VALUES ('$idNegociant', '$nomNegociant', '$preNegociant', '$telNegociant')";
        if (mysqli_query($bd, $sql)) {
            $message = "Négociant enregistré avec succès.";
        } else {
            $message = "Erreur: " . mysqli_error($bd);
        }
    }
}
?>
<!-- Page HTML pour la gestion des négociants -->
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
        <!-- Affichage du message de succès ou d'erreur -->
        <?php if ($message): ?>
            <div class="message-box <?php echo strpos($message, 'succès') !== false ? 'success auto-hide' : 'error'; ?>">
                <i class="fa-solid <?php echo strpos($message, 'succès') !== false ? 'fa-check-circle' : 'fa-circle-exclamation'; ?>"></i>
                <?php echo publicEscape($message); ?>
            </div>
        <?php endif; ?>
        <!-- Formulaire d'ajout d'un négociant -->
        <center>
            <fieldset class="formulaire">
                <legend>NEGOCIANT</legend>
                <form action="negociant.php" method="POST">
                    <table cell-padding="5" coll-padding="5">
                        <tr>
                            <td>IDENTIFIANT</td>
                            <td><input type="text" name="idNegociant" required></td>
                        </tr>
                        <tr>
                            <td>NOM</td>
                            <td><input type="text" name="nom" required></td>
                        </tr>
                        <tr>
                            <td>PRENOM</td>
                            <td><input type="text" name="prenom" required></td>
                        </tr>
                        <tr>
                            <td>TELEPHONE</td>
                            <td><input type="text" name="tel" required></td>
                        </tr>
                    </table>
                    <div class="lesButton">
                        <button type="submit" name="enregistrer" class="enr">enregistrer</button>
                        <button type="reset" class="ann">annuler</button>
                    </div>
                </form>
            </fieldset>
        </center>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>



