<?php
require_once __DIR__ . "/auth.php";
requireUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stockage et negoce</title>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenu">
        <div class="contient">
            
            <div class="carte" onclick="window.location.href='cepage.php'">
                <div class="image">
                    <img src="../image/cepage.png" alt="">
                </div>
                <h3>CEPAGE</h3>
            </div>

            <div class="carte" onclick="window.location.href='cuve.php'">
                <div class="image">
                    <img src="../image/cuve.png" alt="">
                </div>
                <h3>CUVE</h3>
            </div>

            <div class="carte" onclick="window.location.href='negociant.php'">
                <div class="image">
                    <img src="../image/negociant.png" alt="">
                </div>
                <h3>NEGOCIANT</h3>
            </div>

            <div class="carte" onclick="window.location.href='contrat.php'">
                <div class="image">
                    <img src="../image/contrat.png" alt="contrat">
                </div>
                <h3>CONTRAT</h3>
            </div>

            <div class="carte" onclick="window.location.href='livraison.php'">
                <div class="image">
                    <img src="../image/livraison.png" alt="livraison">
                </div>
                <h3>LIVRAISON</h3>
            </div>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
