<?php
include 'config.php';

// Destroy session
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>