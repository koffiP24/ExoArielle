<?php
require_once __DIR__ . "/auth.php";
requireUser();

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enregistrer'])) {
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($bd && isset($_POST['numLivraison']) && isset($_POST['datereelLivraison'])) {
        $numLivraison = mysqli_real_escape_string($bd, $_POST['numLivraison']);
        $datereelLivraison = mysqli_real_escape_string($bd, $_POST['datereelLivraison']);
        $sql = "INSERT INTO livraison (numLivraison, datereelLivraison) VALUES ('$numLivraison', '$datereelLivraison')";
        if (mysqli_query($bd, $sql)) {
            $message = "Livraison enregistrée avec succès.";
        } else {
            $message = "Erreur: " . mysqli_error($bd);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVRAISON</title>
    <link rel="stylesheet" href="../style/livraison.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenu">
        <?php if ($message): ?>
            <div class="message-box <?php echo strpos($message, 'succès') !== false ? 'success auto-hide' : 'error'; ?>">
                <i class="fa-solid <?php echo strpos($message, 'succès') !== false ? 'fa-check-circle' : 'fa-circle-exclamation'; ?>"></i>
                <?php echo publicEscape($message); ?>
            </div>
        <?php endif; ?>
        <center>
       <fieldset class="formulaire">
         <legend>LIVRAISON</legend>
         <form action="livraison.php" method="POST">
             <table cell-padding="5" coll-padding="5">
                 <tr>
                     <td>NUMERO DE LIVRAISON</td>
                     <td><input type="text" name="numLivraison" required></td>
                 </tr>
                 <tr>
                     <td>DATE REEL LIVRAISON</td>
                     <td><input type="date" name="datereelLivraison" required></td>
                 </tr>
                 
             </table>
             <div class="lesButton">
                 <button type="submit" name="enregistrer" class="enr" >enregistrer</button>
                 <button type="reset" class="ann" >annuler</button>
             </div>
         </form>
       </fieldset>
       </center>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>



