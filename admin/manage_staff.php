<?php
include 'includes/auth.php';
check_auth();
include '../config/db.php';

$page_title = "Manage Staff";
$message = "";
$message_type = "success";

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id !== $_SESSION['staff_id']) { // Don't delete yourself
        $conn->query("DELETE FROM staff WHERE id = $id");
        $message = "Staff account removed!";
        $message_type = "success";
    }
}

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
    $name = $_POST['staff_name'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO staff (staff_name, username, password, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $user, $pass, $email, $role);
    
    try {
        if ($stmt->execute()) {
            $message = "New staff account created!";
            $message_type = "success";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            $message = "Error: Username '$user' already exists!";
        } else {
            $message = "Error: " . $e->getMessage();
        }
        $message_type = "danger";
    }
}

$staff_list = $conn->query("SELECT * FROM staff ORDER BY created_at DESC");

include 'includes/header.php';
?>

<div class="admin-card" style="margin-bottom: 40px;">
    <h3>Add New Staff Member</h3>
    <form method="POST" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px;">
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Full Name</label>
            <input type="text" name="staff_name" class="form-control" placeholder="e.g. John Doe" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="e.g. john@icapo.com" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Initial Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Role</label>
            <select name="role" class="form-control">
                <option value="staff">Staff</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <div style="display: flex; align-items: flex-end;">
            <button type="submit" name="add_staff" class="btn-primary" style="width: 100%;">Create Account</button>
        </div>
    </form>
</div>

<?php if ($message): ?>
    <div class="status-badge status-<?php echo $message_type; ?>" style="display: block; margin-bottom: 20px; text-align: center; padding: 12px; border-radius: 12px;">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="admin-card">
    <h3>Staff Directory</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $staff_list->fetch_assoc()): ?>
            <tr>
                <td><strong><?php echo $row['staff_name']; ?></strong><br><small style="color: var(--text-muted);"><?php echo $row['email']; ?></small></td>
                <td><?php echo $row['username']; ?></td>
                <td><span class="status-badge" style="background: rgba(255,255,255,0.05);"><?php echo strtoupper($row['role']); ?></span></td>
                <td><?php echo date('d M, Y', strtotime($row['created_at'])); ?></td>
                <td style="text-align: right;">
                    <?php if ($row['id'] !== $_SESSION['staff_id']): ?>
                        <a href="?delete=<?php echo $row['id']; ?>" class="status-badge status-danger" style="text-decoration: none;" onclick="return confirm('Remove this staff account?')">Delete</a>
                    <?php else: ?>
                        <span class="status-badge status-success">Active</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
