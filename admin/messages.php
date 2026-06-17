<?php
include 'includes/auth.php';
include '../config/db.php';
include 'includes/header.php';

$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>


    <div class="content-header">
        <h1>Contact Messages</h1>
        <p>View and manage inquiries from the contact form.</p>
    </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0) { 
                        while($row = mysqli_fetch_assoc($result)) { 
                            $status_class = strtolower($row['status']);
                        ?>
                        <tr>
                            <td><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td>
                                <span class="badge badge-<?php echo $status_class; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="view_message.php?id=<?php echo $row['id']; ?>" class="btn-view">View</a>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No messages found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>

<style>
.badge-unread { background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.badge-read { background: #f3f4f6; color: #374151; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.badge-replied { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.btn-view { color: var(--primary); text-decoration: none; font-weight: 600; }
.btn-view:hover { text-decoration: underline; }
</style>
