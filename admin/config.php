<?php
// Démarrage de la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_viticole";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion et arrêt en cas d'erreur
if (!$conn) {
    die("Erreur de connexion: " . mysqli_connect_error());
}

// Définition du charset pour la gestion des caractères spéciaux
mysqli_set_charset($conn, "utf8mb4");

// Fonction d'échappement HTML pour la sécurité
function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

// Fonction pour récupérer une valeur POST avec valeur par défaut
function postValue($key) {
    return isset($_POST[$key]) ? $_POST[$key] : "";
}

// Fonction pour récupérer une valeur dans un tableau avec valeur par défaut
function arrayValue($array, $key, $default = "") {
    return isset($array[$key]) ? $array[$key] : $default;
}

// Vérifie si l'utilisateur est connecté
function isUserLoggedIn() {
    return isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true;
}

// Vérifie si l'administrateur est connecté
function isAdminLoggedIn() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

// Vérifie si l'utilisateur a le rôle administrateur
function isUserAdmin() {
    return isUserLoggedIn() && isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin";
}

// Redirige vers la page de connexion si l'utilisateur n'est pas admin
function requireAdmin() {
    if (!isAdminLoggedIn() && !isUserAdmin()) {
        header("Location: ../php/connexion.php");
        exit();
    }
}

// Crée une nouvelle connexion admin à la base de données
function adminDb()
{
    global $servername, $username, $password, $dbname;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
    }

    return $conn;
}

// Compte le nombre d'enregistrements dans une table (sécurité: liste blanche)
function tableCount($conn, $table) {
    $allowed = ["cepage", "cuve", "negociant", "contrat", "livraison"];

    if (!in_array($table, $allowed, true)) {
        return 0;
    }

    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `$table`");
    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return (int) arrayValue($row, "total", 0);
}
?>
