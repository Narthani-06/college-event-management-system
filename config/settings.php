<?php
if (!isset($conn)) {
    include_once __DIR__ . '/db.php';
}

/**
 * Fetches all settings from the database and returns them as an associative array.
 */
function get_portal_settings($conn) {
    $settings = [];
    $result = $conn->query("SELECT config_key, config_value FROM settings");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $settings[$row['config_key']] = $row['config_value'];
        }
    }
    return $settings;
}

// Pre-load settings if not already loaded in a global context
// (Useful for pages that just need one or two values)
$portal_config = get_portal_settings($conn);
?>
