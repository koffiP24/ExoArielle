<?php
// Chargement des dépendances: configuration et layout commun
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

// Traitement des requêtes POST pour ajouter, modifier ou supprimer des livraisons
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout d'une nouvelle livraison
    if (postValue("action") === "add") {
        // Sécurisation des entrées et insertion en base de données
        $numLivraison = mysqli_real_escape_string($conn, postValue("numLivraison"));
        $datereelLivraison = mysqli_real_escape_string($conn, postValue("datereelLivraison"));
        $sql = "INSERT INTO livraison (numLivraison, datereelLivraison) VALUES ('$numLivraison', '$datereelLivraison')";
        $success = mysqli_query($conn, $sql) ? "Livraison enregistrée avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Modification d'une livraison existante
    if (postValue("action") === "edit") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $datereelLivraison = mysqli_real_escape_string($conn, postValue("datereelLivraison"));
        $success = mysqli_query($conn, "UPDATE livraison SET datereelLivraison = '$datereelLivraison' WHERE numLivraison = '$id'") ? "Livraison modifiée avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Suppression d'une livraison existante (suppression en base de données)
    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM livraison WHERE numLivraison = '$id'") ? "Livraison supprimée." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

// Récupération de toutes les livraisons depuis la base de données (tri par date décroissante)
$livraisons = mysqli_query($conn, "SELECT * FROM livraison ORDER BY datereelLivraison DESC");
adminPageStart("Gestion des livraisons", "livraison", "fa-truck");
?>
<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<!-- Formulaire d'ajout d'une nouvelle livraison -->
<section class="form-section">
    <h2>Enregistrer une livraison</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="numLivraison"><i class="fa-solid fa-barcode"></i> Numéro</label><input type="text" id="numLivraison" name="numLivraison" required></div>
        <div class="form-group"><label for="datereelLivraison"><i class="fa-solid fa-calendar"></i> Date réelle</label><input type="date" id="datereelLivraison" name="datereelLivraison" required></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Enregistrer</button>
    </form>
</section>

<!-- Tableau d'affichage des livraisons existantes -->
<section class="table-section">
    <h2>Liste des livraisons</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th>Numéro</th><th>Date réelle</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($livraisons && mysqli_num_rows($livraisons) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($livraisons)): ?>
                        <tr>
                            <!-- Affichage du numéro de livraison avec badge de couleur -->
                            <td><span class="color-badge"><?php echo e($row["numLivraison"]); ?></span></td>
                            <td><?php echo e($row["datereelLivraison"]); ?></td>
                            <!-- Bouton de suppression -->
                            <td>
                                <form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e($row["numLivraison"]); ?>"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i></button></form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="no-data">Aucune livraison enregistrée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminPageEnd(); ?>
