<?php
// Chargement des fonctions d'authentification et vérification de connexion
require_once __DIR__ . "/auth.php";
requireUser();

// Récupération de la liste des négociants pour le formulaire
$conn = publicDb();
$negociants = [];
if ($conn) {
    $result = mysqli_query($conn, "SELECT idNegociant, nomNegociant, preNegociant FROM negociant ORDER BY nomNegociant");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $negociants[] = $row;
        }
    }
}

// Traitement de l'enregistrement d'un contrat
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enregistrer'])) {
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($bd && isset($_POST['datecontrat']) && isset($_POST['echeContrat']) && isset($_POST['qtlivContrat']) && isset($_POST['datelivContrat']) && isset($_POST['idNegociant'])) {
        // Sécurisation des entrées et insertion en base de données
        $datecontrat = mysqli_real_escape_string($bd, $_POST['datecontrat']);
        $echeContrat = mysqli_real_escape_string($bd, $_POST['echeContrat']);
        $qtlivContrat = (int)$_POST['qtlivContrat'];
        $datelivContrat = mysqli_real_escape_string($bd, $_POST['datelivContrat']);
        $idNegociant = mysqli_real_escape_string($bd, $_POST['idNegociant']);
        $sql = "INSERT INTO contrat (datecontrat, echeContrat, qtlivContrat, datelivContrat, idNegociant) VALUES ('$datecontrat', '$echeContrat', '$qtlivContrat', '$datelivContrat', '$idNegociant')";
        if (mysqli_query($bd, $sql)) {
            $message = "Contrat enregistré avec succès.";
        } else {
            $message = "Erreur: " . mysqli_error($bd);
        }
    }
}
?>
<!-- Page HTML pour la gestion des contrats -->
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
        <!-- Affichage du message de succès ou d'erreur -->
        <?php if ($message): ?>
            <div class="message-box <?php echo strpos($message, 'succès') !== false ? 'success auto-hide' : 'error'; ?>">
                <i class="fa-solid <?php echo strpos($message, 'succès') !== false ? 'fa-check-circle' : 'fa-circle-exclamation'; ?>"></i>
                <?php echo publicEscape($message); ?>
            </div>
        <?php endif; ?>
        <!-- Formulaire d'ajout d'un contrat -->
        <center>
            <fieldset class="formulaire">
                <legend>CONTRAT</legend>
                <form action="contrat.php" method="POST">
                    <table cell-padding="5" coll-padding="5">
                        <tr>
                            <td>DATE DE SIGNATURE</td>
                            <td><input type="date" name="datecontrat" required></td>
                        </tr>
                        <tr>
                            <td>ECHEANCE</td>
                            <td><textarea name="echeContrat" rows="4" cols="20" required></textarea></td>
                        </tr>
                        <tr>
                            <td>QUANTITE LIVREE</td>
                            <td><input type="number" name="qtlivContrat" required></td>
                        </tr>
                        <tr>
                            <td>DATE DE LIVRAISON</td>
                            <td><input type="date" name="datelivContrat" required></td>
                        </tr>
                        <tr>
                            <td>NEGOCIANT</td>
                            <td>
                                <!-- Sélection du négociant lié au contrat -->
                                <select name="idNegociant" required>
                                    <option value="">Sélectionner un négociant</option>
                                    <?php foreach ($negociants as $negociant): ?>
                                        <option value="<?php echo publicEscape($negociant['idNegociant']); ?>">
                                            <?php echo publicEscape($negociant['nomNegociant'] . ' ' . $negociant['preNegociant']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
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