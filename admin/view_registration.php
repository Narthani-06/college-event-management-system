<?php
session_start();
include 'includes/auth.php';
check_auth();
include '../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: registrations.php");
    exit();
}

$reg_id = $_GET['id'];
$message = "";

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $new_status = $_POST['payment_status'];
    $update_stmt = $conn->prepare("UPDATE registration SET payment_status = ? WHERE reg_id = ?");
    $update_stmt->bind_param("ss", $new_status, $reg_id);
    if ($update_stmt->execute()) {
        $message = "Registration status updated successfully!";
    }
}

$stmt = $conn->prepare("SELECT * FROM registration WHERE reg_id = ?");
$stmt->bind_param("s", $reg_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Registration not found.";
    exit();
}

$data = $result->fetch_assoc();
$page_title = "Registration Details: " . $reg_id;
include 'includes/header.php';
?>

<?php if ($message): ?>
    <div class="status-badge status-success" style="display: block; margin-bottom: 25px; text-align: center; padding: 12px; border-radius: 12px;">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div style="display: flex; gap: 30px; align-items: flex-start;">
    <!-- Main Details -->
    <div style="flex: 2;">
        <div class="admin-card" style="margin-bottom: 30px;">
            <h3 style="margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">Event Breakdown</h3>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                <div class="stat-card" style="padding: 20px;">
                    <h4>BugBusters</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['debugging']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Think a Thon</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['quiz']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Design Hack</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['web_design']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Script Clash</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['paper_present']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Promoware</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['best_manager']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Trash to Treasure</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['connection_game']; ?></div>
                </div>
                <div class="stat-card" style="padding: 20px;">
                    <h4>Clip Carnival</h4>
                    <div class="value" style="font-size: 24px;"><?php echo $data['short_film']; ?></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <h3 style="margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">Food Preferences</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div style="background: rgba(46, 204, 113, 0.1); padding: 30px; border-radius: 15px; text-align: center; border: 1px solid rgba(46, 204, 113, 0.2);">
                    <h4 style="color: var(--success); margin-bottom: 10px;">VEG</h4>
                    <div style="font-size: 42px; font-weight: 800;"><?php echo $data['veg']; ?></div>
                </div>
                <div style="background: rgba(231, 76, 60, 0.1); padding: 30px; border-radius: 15px; text-align: center; border: 1px solid rgba(231, 76, 60, 0.2);">
                    <h4 style="color: var(--danger); margin-bottom: 10px;">NON-VEG</h4>
                    <div style="font-size: 42px; font-weight: 800;"><?php echo $data['nonveg']; ?></div>
                </div>
            </div>
        </div>

        <!-- Participant Names Section -->
        <?php
        $p_stmt = $conn->prepare("SELECT event_key, participant_name FROM participants WHERE reg_id = ? ORDER BY event_key, id");
        $p_stmt->bind_param("s", $reg_id);
        $p_stmt->execute();
        $p_result = $p_stmt->get_result();
        $participants_by_event = [];
        while ($p_row = $p_result->fetch_assoc()) {
            $participants_by_event[$p_row['event_key']][] = $p_row['participant_name'];
        }
        ?>
        <?php if (!empty($participants_by_event)): ?>
        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">
                🏆 Participant Names <span style="font-size: 13px; color: var(--text-muted); font-weight: 400;">(for certificates)</span>
            </h3>
            <?php foreach ($participants_by_event as $event => $names): ?>
                <div style="margin-bottom: 22px;">
                    <div style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: var(--accent, #D4AF37); font-weight: 700; margin-bottom: 10px;">
                        <?php echo htmlspecialchars($event); ?>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <?php foreach ($names as $i => $name): ?>
                            <div style="background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 8px; padding: 8px 16px; font-size: 15px; font-weight: 600;">
                                <?php echo ($i + 1) . '. ' . htmlspecialchars($name); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="admin-card" style="margin-top: 30px; text-align: center; color: var(--text-muted); padding: 30px;">
            <p>No individual participant names recorded for this registration.</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Info Sidebar -->
    <div style="flex: 1;">
        <div class="admin-card" style="position: sticky; top: 40px;">
            <h3 style="margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">Institution Info</h3>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">College Name</label>
                <div style="font-weight: 600; font-size: 18px; color: var(--primary);"><?php echo htmlspecialchars($data['college_name']); ?></div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Department</label>
                <div style="font-weight: 600; font-size: 16px;"><?php echo htmlspecialchars($data['department'] ?? '—'); ?></div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Staff Coordinator</label>
                <div style="font-weight: 600; font-size: 18px;"><?php echo htmlspecialchars($data['staff_name']); ?></div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Contact</label>
                <div style="font-weight: 600; font-size: 18px;"><?php echo htmlspecialchars($data['phone']); ?></div>
            </div>

            <div style="margin-bottom: 20px; border-top: 1px solid var(--border); padding-top: 20px;">
                <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 10px;">Summary</label>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Total Participants:</span>
                    <strong style="color: var(--text-main);"><?php echo $data['total']; ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Registration Fee:</span>
                    <strong style="color: var(--success);">₹<?php echo number_format($data['amount']); ?></strong>
                </div>
                <div style="margin-top: 15px; border-top: 1px dashed var(--border); padding-top: 15px;">
                    <form method="POST">
                        <label style="display: block; color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 10px;">Update Payment Status</label>
                        <div style="display: flex; gap: 10px;">
                            <select name="payment_status" class="form-control" style="flex: 1;">
                                <option value="PENDING" <?php echo $data['payment_status'] == 'PENDING' ? 'selected' : ''; ?>>PENDING</option>
                                <option value="SUCCESS" <?php echo $data['payment_status'] == 'SUCCESS' ? 'selected' : ''; ?>>SUCCESS</option>
                                <option value="FAILED" <?php echo $data['payment_status'] == 'FAILED' ? 'selected' : ''; ?>>FAILED</option>
                            </select>
                            <button type="submit" name="update_status" class="btn-primary" style="padding: 10px 15px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="registrations.php" class="btn-primary" style="display: block; text-align: center; margin-top: 30px; text-decoration: none;">Back to List</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
