<?php
session_start();
include 'includes/dbconnection.php';


if (isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "  dashboard.php");
    exit();
}

include 'header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hello, future!</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles.css">
</head>
<body>
    <h1>📦 Hello, future!</h1>
    <p>Store your present memories and open them in the future.</p>

    <a href="/Hello-Future-Project/login.php">🔑 Login</a> |
    <a href="register.php">📝 Register</a>
</body>
</html>
<?php
include 'footer.php';
?>
