<?php
session_start();
include 'includes/dbconnection.php';
$id = $_GET['id'];
if (!isset($_SESSION['user_id'])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $unlock = $_POST['unlock_date'];

    $stmt = $conn->prepare("UPDATE memories SET title=?, content=?, unlock_date=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $content, $unlock, $id);
    $stmt->execute();
    header("Location: dashboard.php");
}

$res = $conn->query("SELECT * FROM memories WHERE id=$id");
$row = $res->fetch_assoc();
?>
<form method="post">
    Title: <input name="title" value="<?= $row['title'] ?>"><br>
    Message: <textarea name="content"><?= $row['content'] ?></textarea><br>
    Unlock Date: <input type="date" name="unlock_date" value="<?= $row['unlock_date'] ?>"><br>
    <button type="submit">Update</button>
</form>
