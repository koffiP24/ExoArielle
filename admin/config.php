<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_viticole";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erreur de connexion: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

function postValue($key) {
    return isset($_POST[$key]) ? $_POST[$key] : "";
}

function arrayValue($array, $key, $default = "") {
    return isset($array[$key]) ? $array[$key] : $default;
}

function isUserLoggedIn() {
    return isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true;
}

function isAdminLoggedIn() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

function isUserAdmin() {
    return isUserLoggedIn() && isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin";
}

function requireAdmin() {
    if (!isAdminLoggedIn() && !isUserAdmin()) {
        header("Location: ../php/connexion.php");
        exit();
    }
}

function adminDb()
{
    global $servername, $username, $password, $dbname;

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
    }

    return $conn;
}

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
