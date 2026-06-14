<?php
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (postValue("action") === "add") {
        $letCuve = mysqli_real_escape_string($conn, postValue("letCuve"));
        $capCuve = mysqli_real_escape_string($conn, postValue("capCuve"));
        $idCepage = mysqli_real_escape_string($conn, postValue("idCepage"));
        $sql = "INSERT INTO cuve (letCuve, capCuve, idCepage) VALUES ('$letCuve', '$capCuve', '$idCepage')";
        $success = mysqli_query($conn, $sql) ? "Cuve ajoutée avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM cuve WHERE idCuve = '$id'") ? "Cuve supprimée." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

$cuves = mysqli_query($conn, "SELECT cuve.*, cepage.nomCepage FROM cuve LEFT JOIN cepage ON cuve.idCepage = cepage.idCepage ORDER BY cuve.idCuve DESC");
$cepages = mysqli_query($conn, "SELECT idCepage, nomCepage FROM cepage ORDER BY nomCepage ASC");
adminPageStart("Gestion des cuves", "cuve", "fa-warehouse");
?>
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<section class="form-section">
    <h2>Ajouter une cuve</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="letCuve"><i class="fa-solid fa-barcode"></i> Lettre</label><input type="text" id="letCuve" name="letCuve" maxlength="10" required></div>
        <div class="form-group"><label for="capCuve"><i class="fa-solid fa-gauge-high"></i> Capacité</label><input type="number" id="capCuve" name="capCuve" min="1" required></div>
        <div class="form-group">
            <label for="idCepage"><i class="fa-solid fa-wine-bottle"></i> Cépage</label>
            <select id="idCepage" name="idCepage" required>
                <option value="">Sélectionner</option>
                <?php if ($cepages): while ($row = mysqli_fetch_assoc($cepages)): ?>
                    <option value="<?php echo e($row["idCepage"]); ?>"><?php echo e($row["nomCepage"]); ?></option>
                <?php endwhile; endif; ?>
            </select>
        </div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<section class="table-section">
    <h2>Liste des cuves</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th>ID</th><th>Lettre</th><th>Capacité</th><th>Cépage</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($cuves && mysqli_num_rows($cuves) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($cuves)): ?>
                        <tr>
                            <td><?php echo e($row["idCuve"]); ?></td>
                            <td><span class="color-badge"><?php echo e($row["letCuve"]); ?></span></td>
                            <td><?php echo e($row["capCuve"]); ?> L</td>
                            <td><?php echo e($row["nomCepage"] ?: $row["idCepage"]); ?></td>
                            <td><form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e($row["idCuve"]); ?>"><button class="btn-delete" onclick="return confirm('Confirmer la suppression ?')"><i class="fa-solid fa-trash"></i></button></form></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="no-data">Aucune cuve enregistrée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminPageEnd(); ?>
