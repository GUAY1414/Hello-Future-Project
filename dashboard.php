<?php
include 'header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include 'includes/dbconnection.php';

$id = $_SESSION['user_id'];
$res = $conn->query("SELECT * FROM memories WHERE user_id=$id ORDER BY created_at DESC");

echo "<a href='create.php'>Add New Memory</a> | <a href='logout.php'>Logout</a><hr>";

while ($row = $res->fetch_assoc()) {
    echo "<h3>{$row['title']}</h3>";
    echo "<p><b>To be opened on:</b> {$row['unlock_date']}</p>";
    echo "<p>" . ($row['unlock_date'] > date('Y-m-d') ? "<i>Locked</i>" : $row['content']) . "</p>";
    if ($row['file']) {
        echo "<a href='uploads/{$row['file']}'>View Attachment</a><br>";
    }
    echo "<a href='view.php?id={$row['id']}'>View</a> | ";
    echo "<a href='edit.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Delete</a>";
    echo "<hr>";
}
include 'footer.php';
