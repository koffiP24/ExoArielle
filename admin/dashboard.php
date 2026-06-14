<?php
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

$stats = [
    ["Cépages", "cepage", "fa-wine-bottle", "manage-cepage.php"],
    ["Cuves", "cuve", "fa-warehouse", "manage-cuve.php"],
    ["Négociants", "negociant", "fa-handshake", "manage-negociant.php"],
    ["Contrats", "contrat", "fa-file-contract", "manage-contrat.php"],
    ["Livraisons", "livraison", "fa-truck", "manage-livraison.php"],
];

adminPageStart("Tableau de bord", "dashboard", "fa-chart-line");
?>
<div class="stats-grid">
    <?php foreach ($stats as $stat): ?>
        <a class="stat-card" href="<?php echo $stat[3]; ?>" style="text-decoration:none;">
            <i class="fa-solid <?php echo $stat[2]; ?>"></i>
            <h3><?php echo e($stat[0]); ?></h3>
            <p class="stat-number"><?php echo tableCount($conn, $stat[1]); ?></p>
        </a>
    <?php endforeach; ?>
</div>

<section class="dashboard-section">
    <h2>Accès rapide</h2>
    <div class="quick-access">
        <a href="manage-cepage.php" class="quick-btn"><i class="fa-solid fa-plus"></i> Ajouter un cépage</a>
        <a href="manage-cuve.php" class="quick-btn"><i class="fa-solid fa-plus"></i> Ajouter une cuve</a>
        <a href="manage-negociant.php" class="quick-btn"><i class="fa-solid fa-plus"></i> Ajouter un négociant</a>
        <a href="manage-contrat.php" class="quick-btn"><i class="fa-solid fa-plus"></i> Ajouter un contrat</a>
        <a href="manage-livraison.php" class="quick-btn"><i class="fa-solid fa-plus"></i> Ajouter une livraison</a>
    </div>
</section>
<?php adminPageEnd(); ?>
