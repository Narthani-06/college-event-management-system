<?php
include 'includes/auth.php';
check_auth();
include '../config/db.php';

$page_title = "Overview";

// Fetch Statistics
$reg_query = "SELECT COUNT(*) as total, SUM(amount) as revenue FROM registration WHERE payment_status = 'SUCCESS'";
$res = $conn->query($reg_query);
$stats = $res->fetch_assoc();

$total_reg = $stats['total'] ?? 0;
$total_rev = $stats['revenue'] ?? 0;

$pending_query = "SELECT COUNT(*) as total FROM registration WHERE payment_status = 'PENDING'";
$res_p = $conn->query($pending_query);
$pending_count = $res_p->fetch_assoc()['total'] ?? 0;

include 'includes/header.php';
?>

<div class="stat-grid">
    <div class="stat-card">
        <h4>Confirmed</h4>
        <div class="value"><?php echo $total_reg; ?></div>
    </div>
    <div class="stat-card">                    
        <h4>Collection</h4>
        <div class="value">₹<?php echo number_format($total_rev); ?></div>
    </div>
    <div class="stat-card">
        <h4>Pending</h4>
        <div class="value"><?php echo $pending_count; ?></div>
    </div>
</div>

<div class="admin-card">
    <h3 style="margin-bottom: 20px;">Recent Registrations</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Reg ID</th>
                <th>College</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $recent = $conn->query("SELECT * FROM registration ORDER BY created_at DESC LIMIT 5");
            while($row = $recent->fetch_assoc()):
            ?>
            <tr>
                <td><strong><?php echo $row['reg_id']; ?></strong></td>
                <td><?php echo $row['college_name']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td>
                    <span class="status-badge <?php echo $row['payment_status'] == 'SUCCESS' ? 'status-success' : 'status-pending'; ?>">
                        <?php echo $row['payment_status']; ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
