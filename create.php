<?php
session_start(); // Needed for $_SESSION['user_id']

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hellofuturedb";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connection failed: {$conn->connect_error}");
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("❌ You must be logged in to add a memory.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $unlock_date = $conn->real_escape_string($_POST['unlock_date']);
    $user_id = $_SESSION['user_id']; // Now using session ID!

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $filename = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    $stmt = $conn->prepare("INSERT INTO memories (user_id, title, description, image_path, unlock_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $description, $image_path, $unlock_date);

    if ($stmt->execute()) {
        echo "✅ Memory added successfully!<br>";
    } else {
        echo "❌ Error: {$stmt->error}";
    }
    $stmt->close();
    echo '<a href="create.php">Add another memory</a>';
    $conn->close();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    echo "❌ Memory creation cancelled.<br>";
    echo '<a href="create.php">Back to form</a>';
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Memory</title>
</head>
<body>
    <h2>Add a Memory</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Title:<br>
            <input type="text" name="title" required>
        </label><br><br>
        <label>Description:<br>
            <textarea name="description" required></textarea>
        </label><br><br>
        <label>Unlock Date:<br>
            <input type="date" name="unlock_date" required>
        </label><br><br>
        <label>Image:<br>
            <input type="file" name="image" accept="image/*">
        </label><br><br>
        <button type="submit" name="confirm">Confirm</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
