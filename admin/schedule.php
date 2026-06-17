<?php
include 'includes/auth.php';
check_auth();
include '../config/db.php';

$page_title = "Event Schedule";

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM schedule WHERE id = $id");
    header("Location: schedule.php");
    exit();
}

// Handle add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_event'])) {
    $time = $_POST['time_slot'];
    $event = $_POST['event_name'];
    $venue = $_POST['venue'];
    $order = intval($_POST['order_index']);

    $sql = "INSERT INTO schedule (time_slot, event_name, venue, order_index) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $time, $event, $venue, $order);
    $stmt->execute();
}

$schedule = $conn->query("SELECT * FROM schedule ORDER BY order_index ASC");

include 'includes/header.php';
?>

<div class="admin-card" style="margin-bottom: 40px;">
    <h3>Add New Schedule Item</h3>
    <form method="POST" style="display: grid; grid-template-columns: repeat(3, 1fr) 100px auto; gap: 15px; margin-top: 20px; align-items: end;">
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Time Slot</label>
            <input type="text" name="time_slot" class="form-control" placeholder="e.g. 10:00 AM" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Event Name</label>
            <input type="text" name="event_name" class="form-control" placeholder="e.g. BugBusters" required>
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Venue</label>
            <input type="text" name="venue" class="form-control" placeholder="e.g. Loyola Hall">
        </div>
        <div>
            <label style="display: block; margin-bottom: 8px; font-size: 13px; color: var(--text-muted);">Order</label>
            <input type="number" name="order_index" class="form-control" value="10">
        </div>
        <button type="submit" name="add_event" class="btn-primary">Add Slot</button>
    </form>
</div>

<div class="admin-card">
    <h3>Current Schedule</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Time Slot</th>
                <th>Event</th>
                <th>Venue</th>
                <th style="text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $schedule->fetch_assoc()): ?>
            <tr>
                <td><strong><?php echo $row['order_index']; ?></strong></td>
                <td><?php echo $row['time_slot']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo $row['venue']; ?></td>
                <td style="text-align: right;">
                    <a href="?delete=<?php echo $row['id']; ?>" class="status-badge status-danger" style="text-decoration: none;" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
