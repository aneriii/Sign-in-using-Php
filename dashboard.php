<?php
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .container { width: 300px; margin: 50px auto; text-align: center; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>This is your secure dashboard.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>