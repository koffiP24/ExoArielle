<?php
// Chargement des dépendances: configuration et layout commun
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

// Traitement des requêtes POST pour ajouter, modifier ou supprimer des contrats
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout d'un nouveau contrat
    if (postValue("action") === "add") {
        // Sécurisation des entrées et insertion en base de données
        $datecontrat = mysqli_real_escape_string($conn, postValue("datecontrat"));
        $echeContrat = mysqli_real_escape_string($conn, postValue("echeContrat"));
        $qtlivContrat = mysqli_real_escape_string($conn, postValue("qtlivContrat"));
        $datelivContrat = mysqli_real_escape_string($conn, postValue("datelivContrat"));
        $idNegociant = mysqli_real_escape_string($conn, postValue("idNegociant"));
        $sql = "INSERT INTO contrat (datecontrat, echeContrat, qtlivContrat, datelivContrat, idNegociant) VALUES ('$datecontrat', '$echeContrat', '$qtlivContrat', '$datelivContrat', '$idNegociant')";
        $success = mysqli_query($conn, $sql) ? "Contrat ajouté avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Modification d'un contrat existant
    if (postValue("action") === "edit") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $datecontrat = mysqli_real_escape_string($conn, postValue("datecontrat"));
        $echeContrat = mysqli_real_escape_string($conn, postValue("echeContrat"));
        $qtlivContrat = mysqli_real_escape_string($conn, postValue("qtlivContrat"));
        $datelivContrat = mysqli_real_escape_string($conn, postValue("datelivContrat"));
        $idNegociant = mysqli_real_escape_string($conn, postValue("idNegociant"));
        $sql = "UPDATE contrat SET datecontrat='$datecontrat', echeContrat='$echeContrat', qtlivContrat='$qtlivContrat', datelivContrat='$datelivContrat', idNegociant='$idNegociant' WHERE idContrat='$id'";
        $success = mysqli_query($conn, $sql) ? "Contrat modifié avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Suppression d'un contrat existant
    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM contrat WHERE idContrat = '$id'") ? "Contrat supprimé." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

// Récupération des contrats avec jointure sur les négociants, et liste des négociants pour le formulaire
$contrats = mysqli_query($conn, "SELECT contrat.*, negociant.nomNegociant, negociant.preNegociant FROM contrat LEFT JOIN negociant ON contrat.idNegociant = negociant.idNegociant ORDER BY contrat.datecontrat DESC");
$negociantsList = [];
$negociantsTmp = mysqli_query($conn, "SELECT idNegociant, nomNegociant, preNegociant FROM negociant ORDER BY nomNegociant ASC");
while ($row = mysqli_fetch_assoc($negociantsTmp)) {
    $negociantsList[] = $row;
}
adminPageStart("Gestion des contrats", "contrat", "fa-file-contract");
?>
<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<!-- Formulaire d'ajout d'un nouveau contrat -->
<section class="form-section">
    <h2>Ajouter un contrat</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="datecontrat"><i class="fa-solid fa-calendar"></i> Date de signature</label><input type="date" id="datecontrat" name="datecontrat" required></div>
        <div class="form-group"><label for="qtlivContrat"><i class="fa-solid fa-box"></i> Quantité livrée</label><input type="number" id="qtlivContrat" name="qtlivContrat" min="1" required></div>
        <div class="form-group"><label for="datelivContrat"><i class="fa-solid fa-truck"></i> Date de livraison</label><input type="date" id="datelivContrat" name="datelivContrat" required></div>
        <!-- Sélection du négociant lié au contrat -->
        <div class="form-group">
            <label for="idNegociant"><i class="fa-solid fa-handshake"></i> Négociant</label>
            <select id="idNegociant" name="idNegociant" required>
                <option value="">Sélectionner</option>
                <?php foreach ($negociantsList as $n): ?>
                    <option value="<?php echo e($n["idNegociant"]); ?>"><?php echo e($n["nomNegociant"] . " " . $n["preNegociant"]); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group"><label for="echeContrat"><i class="fa-solid fa-file-lines"></i> Échéance</label><textarea id="echeContrat" name="echeContrat" rows="3" required></textarea></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<!-- Tableau d'affichage des contrats existants -->
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
                            <!-- Bouton de suppression -->
                            <td>
                                <form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e(arrayValue($row, "idContrat")); ?>"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i></button></form>
                            </td>
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
