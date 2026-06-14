<?php
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (postValue("action") === "add") {
        $datecontrat = mysqli_real_escape_string($conn, postValue("datecontrat"));
        $echeContrat = mysqli_real_escape_string($conn, postValue("echeContrat"));
        $qtlivContrat = mysqli_real_escape_string($conn, postValue("qtlivContrat"));
        $datelivContrat = mysqli_real_escape_string($conn, postValue("datelivContrat"));
        $idNegociant = mysqli_real_escape_string($conn, postValue("idNegociant"));
        $sql = "INSERT INTO contrat (datecontrat, echeContrat, qtlivContrat, datelivContrat, idNegociant) VALUES ('$datecontrat', '$echeContrat', '$qtlivContrat', '$datelivContrat', '$idNegociant')";
        $success = mysqli_query($conn, $sql) ? "Contrat ajouté avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM contrat WHERE idContrat = '$id'") ? "Contrat supprimé." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

$contrats = mysqli_query($conn, "SELECT contrat.*, negociant.nomNegociant, negociant.preNegociant FROM contrat LEFT JOIN negociant ON contrat.idNegociant = negociant.idNegociant ORDER BY contrat.datecontrat DESC");
$negociants = mysqli_query($conn, "SELECT idNegociant, nomNegociant, preNegociant FROM negociant ORDER BY nomNegociant ASC");
adminPageStart("Gestion des contrats", "contrat", "fa-file-contract");
?>
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<section class="form-section">
    <h2>Ajouter un contrat</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="datecontrat"><i class="fa-solid fa-calendar"></i> Date de signature</label><input type="date" id="datecontrat" name="datecontrat" required></div>
        <div class="form-group"><label for="qtlivContrat"><i class="fa-solid fa-box"></i> Quantité livrée</label><input type="number" id="qtlivContrat" name="qtlivContrat" min="1" required></div>
        <div class="form-group"><label for="datelivContrat"><i class="fa-solid fa-truck"></i> Date de livraison</label><input type="date" id="datelivContrat" name="datelivContrat" required></div>
        <div class="form-group">
            <label for="idNegociant"><i class="fa-solid fa-handshake"></i> Négociant</label>
            <select id="idNegociant" name="idNegociant" required>
                <option value="">Sélectionner</option>
                <?php if ($negociants): while ($row = mysqli_fetch_assoc($negociants)): ?>
                    <option value="<?php echo e($row["idNegociant"]); ?>"><?php echo e($row["nomNegociant"] . " " . $row["preNegociant"]); ?></option>
                <?php endwhile; endif; ?>
            </select>
        </div>
        <div class="form-group"><label for="echeContrat"><i class="fa-solid fa-file-lines"></i> Échéance</label><textarea id="echeContrat" name="echeContrat" rows="3" required></textarea></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<section class="table-section">
    <h2>Liste des contrats</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th>ID</th><th>Signature</th><th>Échéance</th><th>Quantité</th><th>Livraison</th><th>Négociant</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($contrats && mysqli_num_rows($contrats) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($contrats)): ?>
                        <tr>
                            <td><?php echo e(arrayValue($row, "idContrat")); ?></td>
                            <td><?php echo e($row["datecontrat"]); ?></td>
                            <td><?php echo e($row["echeContrat"]); ?></td>
                            <td><?php echo e($row["qtlivContrat"]); ?> L</td>
                            <td><?php echo e($row["datelivContrat"]); ?></td>
                            <td><?php echo e(trim(arrayValue($row, "nomNegociant") . " " . arrayValue($row, "preNegociant")) ?: $row["idNegociant"]); ?></td>
                            <td><form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e(arrayValue($row, "idContrat")); ?>"><button class="btn-delete" onclick="return confirm('Confirmer la suppression ?')"><i class="fa-solid fa-trash"></i></button></form></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="no-data">Aucun contrat enregistré.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminPageEnd(); ?>
