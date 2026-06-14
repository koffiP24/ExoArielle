<?php
session_start();

unset($_SESSION["admin_logged_in"]);
unset($_SESSION["admin_id"]);
unset($_SESSION["admin_username"]);
unset($_SESSION["admin_nom"]);
unset($_SESSION["user_logged_in"]);
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["user_email"]);
unset($_SESSION["user_role"]);

header("Location: ../php/connexion.php");
exit();
?>
