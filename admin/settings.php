<?php
include 'includes/auth.php';
check_auth();
include '../config/db.php';

$page_title = "Settings";
$message = "";
$message_type = "success";

// Handle POST request to save settings
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save_settings'])) {
        $reg_status = $_POST['reg_status'];
        $admin_email = $_POST['admin_email'];
        $portal_name = $_POST['portal_name'];

        $stmt = $conn->prepare("UPDATE settings SET config_value = ? WHERE config_key = ?");
        
        $settings = [
            'reg_status' => $reg_status,
            'admin_email' => $admin_email,
            'portal_name' => $portal_name
        ];

        foreach ($settings as $key => $value) {
            $stmt->bind_param("ss", $value, $key);
            $stmt->execute();
        }

        $message = "Portal settings updated successfully!";
    }

    if (isset($_POST['update_password'])) {
        $new_pass = $_POST['new_password'];
        $confirm_pass = $_POST['confirm_password'];

        if ($new_pass === $confirm_pass && !empty($new_pass)) {
            $staff_id = $_SESSION['staff_id'];
            $stmt = $conn->prepare("UPDATE staff SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_pass, $staff_id);
            if ($stmt->execute()) {
                $message = "Password updated successfully!";
            }
        } else {
            $message = "Passwords do not match!";
            $message_type = "danger";
        }
    }
}

// Fetch Current Settings
$settings_res = $conn->query("SELECT * FROM settings");
$config = [];
while ($row = $settings_res->fetch_assoc()) {
    $config[$row['config_key']] = $row['config_value'];
}

include 'includes/header.php';
?>

<?php if ($message): ?>
    <div class="status-badge status-<?php echo $message_type; ?>" style="display: block; margin-bottom: 25px; text-align: center; padding: 12px; border-radius: 12px;">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
    
    <!-- Portal Configuration -->
    <div class="admin-card">
        <h3>Portal Configuration</h3>
        <p style="color: var(--text-muted); margin-bottom: 30px;">Global settings for the ICAPO website and administration.</p>

        <form method="POST">
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Portal Name</label>
                <input type="text" name="portal_name" class="form-control" value="<?php echo htmlspecialchars($config['portal_name'] ?? ''); ?>" required>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Registration Status</label>
                <select name="reg_status" class="form-control">
                    <option value="open" <?php echo ($config['reg_status'] ?? '') == 'open' ? 'selected' : ''; ?>>Opened (Allow Registrations)</option>
                    <option value="closed" <?php echo ($config['reg_status'] ?? '') == 'closed' ? 'selected' : ''; ?>>Closed (Maintenance Mode)</option>
                </select>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Official Support Email</label>
                <input type="email" name="admin_email" class="form-control" value="<?php echo htmlspecialchars($config['admin_email'] ?? ''); ?>" required>
            </div>

            <button type="submit" name="save_settings" class="btn-primary" style="width: 100%;">Save Portal Settings</button>
        </form>
    </div>

    <!-- Security Settings -->
    <div class="admin-card" style="height: fit-content;">
        <h3>Security</h3>
        <p style="color: var(--text-muted); margin-bottom: 30px;">Update your account password.</p>

        <form method="POST">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" name="update_password" class="btn-primary" style="width: 100%; border: none; background: #6366f1;">Update Password</button>
        </form>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
