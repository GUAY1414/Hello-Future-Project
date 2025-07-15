<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Hello, future!</title>
  <link rel="stylesheet" href="/APPDEV/HelloFutureProject/styles.css">
</head>
<body>
  <header>
    <h1>Hello, future! 📦</h1>
    <nav>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/APPDEV/HelloFutureProject/dashboard.php">Dashboard</a>
        <a href="/APPDEV/HelloFutureProject/create.php">New Memory</a>
        <a href="/APPDEV/HelloFutureProject/logout.php">Logout</a>
      <?php else: ?>
        <a href="/APPDEV/HelloFutureProject/login.php">Login</a>
        <a href="/APPDEV/HelloFutureProject/register.php">Register</a>
      <?php endif; ?>
    </nav>
      <hr>
    </header>
  </body>
  </html>
