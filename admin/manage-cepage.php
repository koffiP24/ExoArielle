<?php
// Chargement des dépendances: configuration et layout commun
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

// Traitement des requêtes POST pour ajouter, modifier ou supprimer des cépages
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout d'un nouveau cépage
    if (postValue("action") === "add") {
        // Sécurisation des entrées et insertion en base de données
        $nom = mysqli_real_escape_string($conn, postValue("nom"));
        $couleur = mysqli_real_escape_string($conn, postValue("couleur"));
        $sucre = mysqli_real_escape_string($conn, postValue("sucre"));
        $region = mysqli_real_escape_string($conn, postValue("region"));
        $sql = "INSERT INTO cepage (nomCepage, couleurCepage, teneurSucre, regionOrigine) VALUES ('$nom', '$couleur', '$sucre', '$region')";
        $success = mysqli_query($conn, $sql) ? "Cépage ajouté avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Modification d'un cépage existant
    if (postValue("action") === "edit") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $nom = mysqli_real_escape_string($conn, postValue("nom"));
        $couleur = mysqli_real_escape_string($conn, postValue("couleur"));
        $sucre = mysqli_real_escape_string($conn, postValue("sucre"));
        $region = mysqli_real_escape_string($conn, postValue("region"));
        $sql = "UPDATE cepage SET nomCepage='$nom', couleurCepage='$couleur', teneurSucre='$sucre', regionOrigine='$region' WHERE idCepage='$id'";
        $success = mysqli_query($conn, $sql) ? "Cépage modifié avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Suppression d'un cépage existant
    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM cepage WHERE idCepage = '$id'") ? "Cépage supprimé." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

// Récupération des cépages depuis la base de données (tri par ID décroissant)
$cepages = mysqli_query($conn, "SELECT * FROM cepage ORDER BY idCepage DESC");
adminPageStart("Gestion des cépages", "cepage", "fa-wine-bottle");
?>
<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<!-- Formulaire d'ajout d'un nouveau cépage -->
<section class="form-section">
    <h2>Ajouter un cépage</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="nom"><i class="fa-solid fa-wine-bottle"></i> Nom</label><input type="text" id="nom" name="nom" required></div>
        <div class="form-group"><label for="couleur"><i class="fa-solid fa-palette"></i> Couleur</label><input type="text" id="couleur" name="couleur" required></div>
        <div class="form-group"><label for="sucre"><i class="fa-solid fa-percent"></i> Teneur en sucre</label><input type="number" id="sucre" name="sucre" min="0" required></div>
        <div class="form-group"><label for="region"><i class="fa-solid fa-map-marker-alt"></i> Région d'origine</label><input type="text" id="region" name="region" required></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<!-- Tableau d'affichage des cépages existants -->
<section class="table-section">
    <h2>Liste des cépages</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th><i class="fa-solid fa-id-card"></i>ID</th><th>Nom</th><th>Couleur</th><th>Sucre</th><th>Région</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($cepages && mysqli_num_rows($cepages) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($cepages)): ?>
                        <tr>
                            <td><?php echo e($row["idCepage"]); ?></td>
                            <td><?php echo e($row["nomCepage"]); ?></td>
                            <!-- Affichage de la couleur avec badge coloré -->
                            <td><span class="color-badge"><?php echo e($row["couleurCepage"]); ?></span></td>
                            <td><?php echo e($row["teneurSucre"]); ?>%</td>
                            <td><?php echo e($row["regionOrigine"]); ?></td>
                            <!-- Bouton de suppression -->
                            <td>
                                <form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e($row["idCepage"]); ?>"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i></button></form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="no-data">Aucun cépage enregistré.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminPageEnd(); ?>
