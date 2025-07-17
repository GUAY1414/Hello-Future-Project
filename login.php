<?php
session_start();
include 'includes/dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
    } else {
        echo "Invalid credentials.";
    }
}
?>
<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <button type="submit">Login</button>
</form>
