<?php
include 'config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_id VARCHAR(20) NOT NULL,
    event_name VARCHAR(100) NOT NULL,
    participant_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reg_id) REFERENCES registration(reg_id) ON DELETE CASCADE
)";

if ($conn->query($sql)) {
    echo "<h2 style='color:green;font-family:sans-serif;'>✅ participants table created successfully!</h2>";
} else {
    echo "<h2 style='color:red;font-family:sans-serif;'>❌ Error: " . $conn->error . "</h2>";
}
$conn->close();
?>
