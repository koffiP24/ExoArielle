<?php
// Démarrage de la session et chargement des fonctions d'authentification
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/auth.php";
?>
<!-- En-tête du site avec navigation principale -->
<header class="entete">
    <div class="contenu-entete">
        <!-- Logo et titre du site -->
        <a class="brand" href="accueil.php">
            <strong>Stock & Négociant</strong>
            <span>Gestion viticole</span>
        </a>
        <!-- Menu de navigation -->
        <nav class="menu">
            <!-- Affichage du message de bienvenue si connecté -->
            <?php if (isUserLoggedIn()): ?>
                <div class="welcome-message">
                    <i class="fa-solid fa-user"></i>
                    <span>Bienvenue <?php echo publicEscape($_SESSION["user_name"] ?? ""); ?></span>
                </div>
            <?php endif; ?>
            <!-- Liens vers les pages principales -->
            <a href="accueil.php"><i class="fa-solid fa-house"></i> ACCUEIL</a>
            <a href="cepage.php"><i class="fa-solid fa-wine-bottle"></i> CEPAGE</a>
            <a href="cuve.php"><i class="fa-solid fa-warehouse"></i> CUVE</a>
            <a href="negociant.php"><i class="fa-solid fa-handshake"></i> NEGOCIANT</a>
            <a href="contrat.php"><i class="fa-solid fa-file-contract"></i> CONTRAT</a>
            <a href="livraison.php"><i class="fa-solid fa-truck"></i> LIVRAISON</a>
            <a href="deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> DECONNEXION</a>
            <!-- Lien vers l'administration (visible uniquement pour les admins) -->
            <?php if (isUserLoggedIn() && isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin"): ?>
                <a href="../admin/dashboard.php" class="admin-link"><i class="fa-solid fa-screwdriver-wrench"></i> Administrateur</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
