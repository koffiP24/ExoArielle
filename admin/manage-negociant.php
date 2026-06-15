<?php
// Chargement des dépendances: configuration et layout commun
require_once __DIR__ . "/config.php";
requireAdmin();
require_once __DIR__ . "/layout.php";

// Traitement des requêtes POST pour ajouter, modifier ou supprimer des négociants
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ajout d'un nouveau négociant
    if (postValue("action") === "add") {
        // Sécurisation des entrées et insertion en base de données
        $id = mysqli_real_escape_string($conn, postValue("idNegociant"));
        $nom = mysqli_real_escape_string($conn, postValue("nom"));
        $prenom = mysqli_real_escape_string($conn, postValue("prenom"));
        $tel = mysqli_real_escape_string($conn, postValue("tel"));
        $sql = "INSERT INTO negociant (idNegociant, nomNegociant, preNegociant, telNegociant) VALUES ('$id', '$nom', '$prenom', '$tel')";
        $success = mysqli_query($conn, $sql) ? "Négociant ajouté avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Modification d'un négociant existant
    if (postValue("action") === "edit") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $nom = mysqli_real_escape_string($conn, postValue("nom"));
        $prenom = mysqli_real_escape_string($conn, postValue("prenom"));
        $tel = mysqli_real_escape_string($conn, postValue("tel"));
        $sql = "UPDATE negociant SET nomNegociant='$nom', preNegociant='$prenom', telNegociant='$tel' WHERE idNegociant='$id'";
        $success = mysqli_query($conn, $sql) ? "Négociant modifié avec succès." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }

    // Suppression d'un négociant existant
    if (postValue("action") === "delete") {
        $id = mysqli_real_escape_string($conn, postValue("id"));
        $success = mysqli_query($conn, "DELETE FROM negociant WHERE idNegociant = '$id'") ? "Négociant supprimé." : null;
        $error = $success ? null : "Erreur: " . mysqli_error($conn);
    }
}

// Récupération des négociants depuis la base de données (tri par ID décroissant)
$negociants = mysqli_query($conn, "SELECT * FROM negociant ORDER BY idNegociant DESC");
adminPageStart("Gestion des négociants", "negociant", "fa-handshake");
?>
<!-- Affichage des messages de succès ou d'erreur -->
<?php if (!empty($success)): ?><div class="success-message"><i class="fa-solid fa-check-circle"></i> <?php echo e($success); ?></div><?php endif; ?>
<?php if (!empty($error)): ?><div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> <?php echo e($error); ?></div><?php endif; ?>

<!-- Formulaire d'ajout d'un nouveau négociant -->
<section class="form-section">
    <h2>Ajouter un négociant</h2>
    <form method="POST" class="admin-form">
        <input type="hidden" name="action" value="add">
        <div class="form-group"><label for="idNegociant"><i class="fa-solid fa-id-card"></i> Identifiant</label><input type="text" id="idNegociant" name="idNegociant" required></div>
        <div class="form-group"><label for="nom"><i class="fa-solid fa-user"></i> Nom</label><input type="text" id="nom" name="nom" required></div>
        <div class="form-group"><label for="prenom"><i class="fa-solid fa-user"></i> Prénom</label><input type="text" id="prenom" name="prenom" required></div>
        <div class="form-group"><label for="tel"><i class="fa-solid fa-phone"></i> Téléphone</label><input type="tel" id="tel" name="tel" required></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Ajouter</button>
    </form>
</section>

<!-- Tableau d'affichage des négociants existants -->
<section class="table-section">
    <h2>Liste des négociants</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($negociants && mysqli_num_rows($negociants) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($negociants)): ?>
                        <tr>
                            <td><?php echo e($row["idNegociant"]); ?></td>
                            <td><?php echo e($row["nomNegociant"]); ?></td>
                            <td><?php echo e($row["preNegociant"]); ?></td>
                            <td><?php echo e($row["telNegociant"]); ?></td>
                            <!-- Bouton de suppression -->
                            <td>
                                <form method="POST"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo e($row["idNegociant"]); ?>"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i></button></form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="no-data">Aucun négociant enregistré.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminPageEnd(); ?>
