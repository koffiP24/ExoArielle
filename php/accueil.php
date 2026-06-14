<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stockage et negoce</title>
    <link rel="stylesheet" href="../style/global.css">
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
                    <img src="../image/contrat.png" alt="livraison">
                </div>
                <h3>LIVRAISON</h3>
            </div>

        </div>
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