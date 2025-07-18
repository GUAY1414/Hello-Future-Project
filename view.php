<?php
$uploadDir = 'uploads/'; // Adjust path if needed

if (is_dir($uploadDir)) {
    $files = array_diff(scandir($uploadDir), array('.', '..'));
    if (count($files) > 0) {
        echo "<h2>Uploaded Files:</h2><ul>";
        foreach ($files as $file) {
            $filePath = $uploadDir . $file;
            echo "<li><a href='$filePath' target='_blank'>" . htmlspecialchars($file) . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No files uploaded yet.";
    }
} else {
    echo "Upload directory does not exist.";
}
?>