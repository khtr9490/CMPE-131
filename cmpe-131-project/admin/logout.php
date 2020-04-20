<?php
session_start();
session_destroy();
header("Location: ../emp-login.php"); // Redirecting To Home Page
?>