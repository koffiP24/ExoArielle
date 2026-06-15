<?php
// Chargement des dépendances: configuration et layout commun
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

// Traitement des requêtes POST pour ajouter, modifier ou supprimer des cuves
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout d'une nouvelle cuve
    if (postValue("action") === "add") {
        // Sécurisation des entrées et insertion en base de données
        $letCuve = mysqli_real_escape_string($conn, postValue("letCuve"));
        $capCuve = mysqli_real_escape_string($conn, postValue("capCuve"));
        $idCepage = mysqli_real_escape_string($conn, postValue("idCepage"));
        $sql = "INSERT INTO cuve (letCuve, capCuve, idCepage) VALUES ('$letCuve', '$capCuve', '$idCepage')";
        $success = mysqli_query($conn, $sql) ? "Cuve ajoutée avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Modification d'une cuve existante
    if (postValue("action") === "edit") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $letCuve = mysqli_real_escape_string($conn, postValue("letCuve"));
        $capCuve = mysqli_real_escape_string($conn, postValue("capCuve"));
        $idCepage = mysqli_real_escape_string($conn, postValue("idCepage"));
        $sql = "UPDATE cuve SET letCuve='$letCuve', capCuve='$capCuve', idCepage='$idCepage' WHERE idCuve='$id'";
        $success = mysqli_query($conn, $sql) ? "Cuve modifiée avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Suppression d'une cuve existante
    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM cuve WHERE idCuve = '$id'") ? "Cuve supprimée." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

// Récupération des cuves avec jointure sur les cépages, et liste des cépages pour le formulaire
$cuves = mysqli_query($conn, "SELECT cuve.*, cepage.nomCepage FROM cuve LEFT JOIN cepage ON cuve.idCepage = cepage.idCepage ORDER BY cuve.idCuve DESC");
$cepagesList = [];
$cepagesTmp = mysqli_query($conn, "SELECT idCepage, nomCepage FROM cepage ORDER BY nomCepage ASC");
while ($row = mysqli_fetch_assoc($cepagesTmp)) {
    $cepagesList[] = $row;
}
adminPageStart("Gestion des cuves", "cuve", "fa-warehouse");
?>
<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<!-- Formulaire d'ajout d'une nouvelle cuve -->
<section class="form-section">
    <h2>Ajouter une cuve</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="letCuve"><i class="fa-solid fa-barcode"></i> Lettre</label><input type="text" id="letCuve" name="letCuve" maxlength="10" required></div>
        <div class="form-group"><label for="capCuve"><i class="fa-solid fa-gauge-high"></i> Capacité</label><input type="number" id="capCuve" name="capCuve" min="1" required></div>
        <!-- Sélection du cépage lié à la cuve -->
        <div class="form-group">
            <label for="idCepage"><i class="fa-solid fa-wine-bottle"></i> Cépage</label>
            <select id="idCepage" name="idCepage" required>
                <option value="">Sélectionner</option>
                <?php foreach ($cepagesList as $c): ?>
                    <option value="<?php echo e($c["idCepage"]); ?>"><?php echo e($c["nomCepage"]); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<!-- Tableau d'affichage des cuves existantes -->
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
                            <!-- Lettre d'identification avec badge coloré -->
                            <td><span class="color-badge"><?php echo e($row["letCuve"]); ?></span></td>
                            <td><?php echo e($row["capCuve"]); ?> L</td>
                            <td><?php echo e($row["nomCepage"] ?: $row["idCepage"]); ?></td>
<!-- Bouton de suppression -->
                            <td>
                                <form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e($row["idCuve"]); ?>"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i></button></form>
                            </td>
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
