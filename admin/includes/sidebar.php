<div class="sidebar">
    <div class="sidebar-logo">
        <h2>ICAPO</h2>
    </div>
    <ul class="nav-links">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="registrations.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'registrations.php' ? 'active' : ''; ?>">
                <span>Registrations</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="schedule.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'schedule.php' ? 'active' : ''; ?>">
                <span>Schedule</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_staff.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_staff.php' ? 'active' : ''; ?>">
                <span>Manage Staff</span>
            </a>
        </li>
        <li class="nav-item">
            <?php
            // Get unread messages count
            $unread_query = "SELECT COUNT(*) as unread_count FROM contacts WHERE status = 'UNREAD'";
            $unread_result = mysqli_query($conn, $unread_query);
            $unread_row = mysqli_fetch_assoc($unread_result);
            $unread_count = $unread_row['unread_count'] ?? 0;
            ?>
            <a href="messages.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : ''; ?>" style="display: flex; justify-content: space-between; align-items: center;">
                <span>Messages</span>
                <?php if ($unread_count > 0) { ?>
                    <span style="background: var(--danger); color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;">
                        <?php echo $unread_count; ?>
                    </span>
                <?php } ?>
            </a>
        </li>
        <li class="nav-item">
            <a href="settings.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                <span>Settings</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="logout.php" class="nav-link" style="color: var(--danger);">
            <span>Logout</span>
        </a>
    </div>
</div>
