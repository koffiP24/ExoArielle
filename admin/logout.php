<?php
// Chargement des fonctions d'authentification
require_once __DIR__ . "/config.php";

// Suppression de toutes les variables de session
unset($_SESSION["user_logged_in"]);
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["user_email"]);
unset($_SESSION["user_role"]);
unset($_SESSION["admin_logged_in"]);
unset($_SESSION["admin_id"]);
unset($_SESSION["admin_username"]);
unset($_SESSION["admin_nom"]);

// Redirection vers la page de connexion
header("Location: ../php/connexion.php");
exit();
?>
