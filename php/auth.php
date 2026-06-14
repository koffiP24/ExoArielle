<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function publicDb()
{
    $conn = mysqli_connect("localhost", "root", "", "bd_viticole");

    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
    }

    return $conn;
}

function publicEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

function isUserLoggedIn()
{
    return isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true;
}

function isUserAdmin()
{
    return isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin";
}

function requireUser()
{
    if (!isUserLoggedIn()) {
        header("Location: connexion.php");
        exit();
    }
}
?>
