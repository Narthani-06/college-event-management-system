<?php
include 'includes/auth.php';
check_auth();
include '../config/db.php';

$page_title = "Manage Registrations";

// Search and Filter logic
$search = $_GET['search'] ?? '';
$where = "WHERE 1=1";
if ($search) {
    $where .= " AND (college_name LIKE '%$search%' OR reg_id LIKE '%$search%' OR staff_name LIKE '%$search%')";
}

$regs = $conn->query("SELECT * FROM registration $where ORDER BY created_at DESC");

include 'includes/header.php';
?>

<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h3>Registrations List</h3>
        <form method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="search" class="form-control" placeholder="Search college or ID..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn-primary">Search</button>
        </form>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Reg ID</th>
                <th>College Name</th>
                <th>Department</th>
                <th>Staff Name</th>
                <th>Participants</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_participants = 0;
            $total_veg = 0;
            $total_nonveg = 0;
            $total_amount = 0;
            
            if ($regs->num_rows > 0): 
                while($row = $regs->fetch_assoc()): 
                    $total_participants += $row['total'];
                    $total_veg += $row['veg'];
                    $total_nonveg += $row['nonveg'];
                    $total_amount += $row['amount'];
            ?>
                <tr>
                    <td><strong><?php echo $row['reg_id']; ?></strong></td>
                    <td><?php echo $row['college_name']; ?></td>
                    <td><?php echo htmlspecialchars($row['department'] ?? '—'); ?></td>
                    <td><?php echo $row['staff_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td>₹<?php echo number_format($row['amount']); ?></td>
                    <td>
                        <span class="status-badge <?php echo $row['payment_status'] == 'SUCCESS' ? 'status-success' : 'status-pending'; ?>">
                            <?php echo $row['payment_status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="view_registration.php?id=<?php echo $row['reg_id']; ?>" class="status-badge" style="background: rgba(255,255,255,0.05); text-decoration: none; color: var(--primary);">View Details</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">No registration records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if ($regs->num_rows > 0): ?>
        <tfoot style="border-top: 2px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.02);">
            <tr style="font-weight: bold; color: var(--primary);">
                <td colspan="4" style="text-align: right; padding: 15px;">TOTALS:</td>
                <td style="padding: 15px;"><?php echo $total_participants; ?></td>
                <td style="padding: 15px;">₹<?php echo number_format($total_amount); ?></td>
                <td colspan="2" style="padding: 15px; font-size: 0.85em; color: var(--text-muted);">
                    Veg: <span style="color: var(--text);"><?php echo $total_veg; ?></span> | 
                    Non-Veg: <span style="color: var(--text);"><?php echo $total_nonveg; ?></span>
                </td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
