<?php
session_start();
unset($_SESSION['user']);  // Remove the logged-in user data from the session
header("Location: login.php"); // Redirect to login page
exit();
?>
