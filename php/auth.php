<?php
// Démarrage de la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données pour l'espace public
function publicDb()
{
    $conn = mysqli_connect("localhost", "root", "", "bd_viticole");
    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
    }
    return $conn;
}

// Fonction d'échappement HTML pour la sécurité des affichages publics
function publicEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

// Vérifie si un utilisateur est connecté
function isUserLoggedIn()
{
    return isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true;
}

// Vérifie si l'utilisateur a le rôle administrateur
function isUserAdmin()
{
    return isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin";
}

// Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
function requireUser()
{
    if (!isUserLoggedIn()) {
        header("Location: connexion.php");
        exit();
    }
}
?>
