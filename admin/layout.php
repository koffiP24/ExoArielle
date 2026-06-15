<?php
// Génère la navigation latérale de l'administration
function adminNav($active = "") {
    // Tableau des liens de navigation avec icône et clé d'activation
    $items = [
        "dashboard.php" => ["Tableau de bord", "fa-chart-line", "dashboard"],
        "manage-cepage.php" => ["Cépages", "fa-wine-bottle", "cepage"],
        "manage-cuve.php" => ["Cuves", "fa-warehouse", "cuve"],
        "manage-negociant.php" => ["Négociants", "fa-handshake", "negociant"],
        "manage-contrat.php" => ["Contrats", "fa-file-contract", "contrat"],
        "manage-livraison.php" => ["Livraisons", "fa-truck", "livraison"],
    ];
    ?>
    <aside class="admin-sidebar">
        <!-- En-tête avec logo et titre -->
        <div class="sidebar-header">
            <h2><i class="fa-solid fa-wine-bottle"></i> <span>Stock & Négoce</span></h2>
            <p>Administration</p>
        </div>

        <!-- Menu de navigation principal -->
        <nav class="sidebar-nav">
            <?php foreach ($items as $href => $item): ?>
                <a href="<?php echo $href; ?>" class="nav-item <?php echo $active === $item[2] ? "active" : ""; ?>">
                    <i class="fa-solid <?php echo $item[1]; ?>"></i>
                    <span><?php echo $item[0]; ?></span>
                </a>
            <?php endforeach; ?>
            <!-- Lien vers le site public -->
            <a href="../php/accueil.php" class="nav-item">
                <i class="fa-solid fa-eye"></i>
                <span>Voir le site</span>
            </a>
            <!-- Bouton de déconnexion -->
            <a href="logout.php" class="nav-item logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Déconnexion</span>
            </a>
        </nav>
    </aside>
    <?php
}

// Génère l'en-tête HTML et le début de page admin
function adminPageStart($title, $active, $icon) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo e($title); ?></title>
        <link rel="stylesheet" href="../style/admin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
    </head>
    <body class="admin-page">
        <div class="admin-container">
            <?php adminNav($active); ?>
            <main class="admin-main">
                <header class="admin-header">
                    <div>
                        <p class="admin-kicker">Espace administrateur</p>
                        <h1><i class="fa-solid <?php echo $icon; ?>"></i> <?php echo e($title); ?></h1>
                    </div>
                    <!-- Affichage des informations utilisateur connecté -->
                    <div class="admin-user-info">
                        <i class="fa-solid fa-user-circle"></i>
                        <span><?php echo e(isset($_SESSION["admin_nom"]) ? $_SESSION["admin_nom"] : (isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "admin")); ?></span>
                    </div>
                </header>
                <div class="admin-content">
    <?php
}

// Génère la fin de page HTML
function adminPageEnd() {
    ?>
                </div>
            </main>
        </div>
    </body>
    </html>
    <?php
}
?>
