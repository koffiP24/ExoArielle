<?php
require_once __DIR__ . "/auth.php";

if (isUserLoggedIn()) {
    header("Location: accueil.php");
    exit();
}

$mode = isset($_GET["mode"]) && $_GET["mode"] === "inscription" ? "inscription" : "connexion";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "connexion";
    $email = trim(isset($_POST["email"]) ? $_POST["email"] : "");
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $conn = publicDb();

    if (!$conn) {
        $error = "Connexion à la base de données impossible.";
    } elseif ($action === "inscription") {
        $mode = "inscription";
        $nom = trim(isset($_POST["nom"]) ? $_POST["nom"] : "");

        if ($nom === "" || $email === "" || $password === "") {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } elseif (strlen($password) < 6) {
            $error = "Le mot de passe doit contenir au moins 6 caractères.";
        } else {
            $emailSql = mysqli_real_escape_string($conn, $email);
            $exists = mysqli_query($conn, "SELECT idUtilisateur FROM utilisateur WHERE email = '$emailSql' LIMIT 1");

            if ($exists && mysqli_num_rows($exists) > 0) {
                $error = "Un compte existe déjà avec cette adresse email.";
            } else {
                $nomSql = mysqli_real_escape_string($conn, $nom);
                $passwordHash = mysqli_real_escape_string($conn, password_hash($password, PASSWORD_DEFAULT));
                $sql = "INSERT INTO utilisateur (nomUtilisateur, email, motDePasse) VALUES ('$nomSql', '$emailSql', '$passwordHash')";

                if (mysqli_query($conn, $sql)) {
                    $success = "Compte créé avec succès. Vous pouvez vous connecter.";
                    $mode = "connexion";
                } else {
                    $error = "Erreur lors de la création du compte.";
                }
            }
        }
    } else {
        $mode = "connexion";

        if ($email === "" || $password === "") {
            $error = "Email et mot de passe obligatoires.";
        } else {
            $emailSql = mysqli_real_escape_string($conn, $email);
            $result = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email = '$emailSql' LIMIT 1");

            if ($result && mysqli_num_rows($result) === 1) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user["motDePasse"])) {
                    $_SESSION["user_logged_in"] = true;
                    $_SESSION["user_id"] = $user["idUtilisateur"];
                    $_SESSION["user_name"] = $user["nomUtilisateur"];
                    $_SESSION["user_email"] = $user["email"];
                    $_SESSION["user_role"] = $user["role"];
                    if ($user["role"] === "admin") {
                        header("Location: ../admin/dashboard.php");
                    } else {
                        header("Location: accueil.php");
                    }
                    exit();
                }
            }

            $error = "Email ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Stock & Négoce</title>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" crossorigin="anonymous" />
</head>
<body class="auth-page">
    <main class="auth-shell">
        <section class="auth-panel">
            <div class="auth-brand">
                <i class="fa-solid fa-wine-bottle"></i>
                <h1>Stock & Négoce</h1>
                <p>Accès sécurisé à la gestion viticole</p>
            </div>

            <div class="auth-tabs">
                <a class="<?php echo $mode === "connexion" ? "active" : ""; ?>" href="connexion.php">Connexion</a>
                <a class="<?php echo $mode === "inscription" ? "active" : ""; ?>" href="connexion.php?mode=inscription">Inscription</a>
            </div>

            <?php if ($error): ?>
                <div class="auth-message error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo publicEscape($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="auth-message success"><i class="fa-solid fa-check-circle"></i> <?php echo publicEscape($success); ?></div>
            <?php endif; ?>

            <form method="POST" class="auth-form">
                <input type="hidden" name="action" value="<?php echo $mode; ?>">

                <?php if ($mode === "inscription"): ?>
                    <label for="nom">Nom complet</label>
                    <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
                <?php endif; ?>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="exemple@email.com" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Minimum 6 caractères" required>

                <button type="submit" class="auth-submit">
                    <i class="fa-solid <?php echo $mode === "inscription" ? "fa-user-plus" : "fa-arrow-right-to-bracket"; ?>"></i>
                    <?php echo $mode === "inscription" ? "Créer mon compte" : "Se connecter"; ?>
                </button>
            </form>
        </section>
    </main>
</body>
</html>