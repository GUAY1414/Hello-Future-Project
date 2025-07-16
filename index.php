<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
include 'database.php';
include 'header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hello, future!</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>📦 Hello, future!</h1>
    <p>Store your present memories and open them in the future.</p>

    <a href="login.php">🔑 Login</a> |
    <a href="register.php">📝 Register</a>
</body>
</html>
<?php
include 'footer.php';
?>
