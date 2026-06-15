<?php
// Redirection vers la page de connexion si non authentifié
require_once __DIR__ . "/auth.php";
if (!isUserLoggedIn()) {
    header("Location: connexion.php");
    exit();
}
?>
<!-- Page d'accueil avec les cartes de navigation principale -->
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
    
    <!-- Contenu principal avec grille de navigation -->
    <main class="contenu">
        <div class="contient">

            <!-- Carte vers la gestion des cépages -->
            <a class="carte" href="cepage.php">
                <div class="image">
                    <img src="../image/cepage.png" alt="">
                </div>
                <h3>CEPAGE</h3>
            </a>

            <!-- Carte vers la gestion des cuves -->
            <a class="carte" href="cuve.php">
                <div class="image">
                    <img src="../image/cuve.png" alt="">
                </div>
                <h3>CUVE</h3>
            </a>

            <!-- Carte vers la gestion des négociants -->
            <a class="carte" href="negociant.php">
                <div class="image">
                    <img src="../image/negociant.png" alt="">
                </div>
                <h3>NEGOCIANT</h3>
            </a>
            <!-- Carte vers la gestion des contrats -->
            <a class="carte" href="contrat.php">
                <div class="image">
                    <img src="../image/contrat.png" alt="contrat">
                </div>
                <h3>CONTRAT</h3>
            </a>

            <!-- Carte vers la gestion des livraisons -->
            <a class="carte" href="livraison.php">
                <div class="image">
                    <img src="../image/livraison.png" alt="livraison">
                </div>
                <h3>LIVRAISON</h3>
            </a>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>

</html>