<?php
session_start();
include 'config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($conn) && $conn) {
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $username, $password);
                if ($stmt->execute()) {
                    $stmt->close();
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Registration failed.";
                }
                $stmt->close();
            } else {
                echo "Database error: " . $conn->error;
            }
        } else {
            echo "Database connection error.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
<form method="post">
    Username: <input name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
