<?php
$conn = new mysqli("localhost", "root", "", "icapo_db");
if ($conn->connect_error) die("Connection failed");
$res = $conn->query("SELECT email, username FROM staff");
while($row = $res->fetch_assoc()) {
    echo "Email: " . $row['email'] . " | Username: " . $row['username'] . PHP_EOL;
}
?>
