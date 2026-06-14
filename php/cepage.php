<?php
require_once __DIR__ . "/auth.php";
requireUser();

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enregistrer'])) {
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($bd && isset($_POST['nom']) && isset($_POST['couleur']) && isset($_POST['sucre']) && isset($_POST['region'])) {
        $nomCepage = mysqli_real_escape_string($bd, $_POST['nom']);
        $couleurCepage = mysqli_real_escape_string($bd, $_POST['couleur']);
        $teneurSucre = (int)$_POST['sucre'];
        $regionOrigine = mysqli_real_escape_string($bd, $_POST['region']);
        $sql = "INSERT INTO cepage (nomCepage, couleurCepage, teneurSucre, regionOrigine) VALUES ('$nomCepage', '$couleurCepage', '$teneurSucre', '$regionOrigine')";
        if (mysqli_query($bd, $sql)) {
            $message = "Cépage enregistré avec succès.";
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
    <title>CEPAGE</title>
    <link rel="stylesheet" href="../style/cepage.css">
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
         <legend>CEPAGE</legend>
         <form action="cepage.php" method="POST">
             <table>
                 <tr>
                     <td>NOM DU CEPAGE </td>
                     <td><input type="text" name="nom" required></td>
                 </tr>
                 <tr>
                     <td>COULEUR</td>
                     <td><input type="text" name="couleur" required></td>
                 </tr>
                 <tr>
                     <td>TENEUR EN SUCRE</td>
                     <td><input type="number" name="sucre" required></td>
                 </tr>
                 <tr>
                     <td>REGION D'ORIGINE</td>
                     <td><input type="text" name="region" required></td>
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



