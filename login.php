<?php
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = trim($_POST['username_email']);
    $password = trim($_POST['password']);

    if (empty($username_email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Check user existence
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_email, $username_email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Start session and redirect
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .container { width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Username/Email:</label>
                <input type="text" name="username_email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Signup</a></p>
    </div>
</body>
</html>