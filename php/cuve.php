<?php
require_once __DIR__ . "/auth.php";
requireUser();

$conn = publicDb();
$cepages = [];
if ($conn) {
    $result = mysqli_query($conn, "SELECT idCepage, nomCepage FROM cepage ORDER BY nomCepage");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cepages[] = $row;
        }
    }
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enregistrer'])) {
    $bd = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($bd && isset($_POST['letCuve']) && isset($_POST['capCuve']) && isset($_POST['idCepage'])) {
        $letCuve = mysqli_real_escape_string($bd, $_POST['letCuve']);
        $capCuve = (int)$_POST['capCuve'];
        $idCepage = (int)$_POST['idCepage'];
        $sql = "INSERT INTO cuve (letCuve, capCuve, idCepage) VALUES('$letCuve', '$capCuve', '$idCepage')";
        if (mysqli_query($bd, $sql)) {
            $cepageName = "";
            foreach ($cepages as $c) {
                if ($c['idCepage'] == $idCepage) {
                    $cepageName = $c['nomCepage'];
                    break;
                }
            }
            $message = "Cuve enregistrée avec succès.";
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
    <title>CUVE</title>
    <link rel="stylesheet" href="../style/cuve.css">
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
         <legend>CUVE</legend>
         <form action="cuve.php" method="POST">
             <table cell-padding="5" coll-padding="5">
                 <tr>
                     <td>LETTRE D'IDENTIFICATION</td>
                     <td><input type="text" name="letCuve" required></td>
                 </tr>
                 <tr>
                     <td>CAPACITE DE STOCKAGE</td>
                     <td><input type="number" name="capCuve" required></td>
                 </tr>
                 <tr>
                     <td>CEPAGE</td>
                     <td>
                         <select name="idCepage" required>
                             <option value="">Sélectionner un cépage</option>
                             <?php foreach ($cepages as $cepage): ?>
                                 <option value="<?php echo $cepage['idCepage']; ?>"><?php echo publicEscape($cepage['nomCepage']); ?></option>
                             <?php endforeach; ?>
                         </select>
                     </td>
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



