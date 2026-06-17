<?php
include 'config/db.php';

// Show participants table structure
$result = $conn->query("DESCRIBE participants");
if ($result) {
    echo "<h3 style='font-family:sans-serif;'>participants table columns:</h3><pre>";
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
    echo "</pre>";
} else {
    echo "<h3 style='color:red;font-family:sans-serif;'>Table not found or error: " . $conn->error . "</h3>";
}
?>
