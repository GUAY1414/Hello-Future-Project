<?php
session_start();
include 'config/db.php';
$id = $_GET['id'];
if ($conn->query("DELETE FROM memories WHERE id=$id") === TRUE) {
	header("Location: dashboard.php");
	exit();
} else {
	echo "Error deleting record: " . $conn->error;
}
$stmt->execute();
$stmt->close();
header("Location: dashboard.php");
?>
