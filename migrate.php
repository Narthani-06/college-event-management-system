<?php
include 'config/db.php';

echo "<div style='font-family: sans-serif; padding: 20px;'>";
echo "<h2 style='color: #2c3e50;'>ICAPO Database Migration</h2>";
echo "<hr>";

if ($conn->connect_error) {
    die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// 1. Create Contacts Table
$sql1 = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'UNREAD',
    admin_reply TEXT NULL,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql1) === TRUE) {
    echo "<p style='color: green;'>✅ Table 'contacts' created or already exists.</p>";
} else {
    echo "<p style='color: red;'>❌ Error 'contacts': " . $conn->error . "</p>";
}

// 2. Create Settings Table
$sql2 = "CREATE TABLE IF NOT EXISTS settings (
    config_key VARCHAR(50) PRIMARY KEY,
    config_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql2) === TRUE) {
    echo "<p style='color: green;'>✅ Table 'settings' created or already exists.</p>";
    
    // Insert Default Settings
    $conn->query("INSERT IGNORE INTO settings (config_key, config_value) VALUES 
    ('reg_status', 'open'),
    ('admin_email', 'admin@icapo.com'),
    ('portal_name', 'ICAPO Admin Portal')");
    echo "<p style='color: blue;'>ℹ️ Default settings checked/inserted.</p>";
} else {
    echo "<p style='color: red;'>❌ Error 'settings': " . $conn->error . "</p>";
}

echo "<hr>";
echo "<p><strong>Migration Finished.</strong> You can now delete this file (migrate.php) and go back to the <a href='admin/login.php'>Admin Panel</a>.</p>";
echo "</div>";
?>
