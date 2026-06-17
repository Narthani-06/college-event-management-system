<?php
include 'includes/auth.php';
include '../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: messages.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// If reply submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_reply'])) {
    $reply = mysqli_real_escape_string($conn, $_POST['admin_reply']);
    $update_sql = "UPDATE contacts SET admin_reply = '$reply', status = 'REPLIED', replied_at = NOW() WHERE id = '$id'";
    mysqli_query($conn, $update_sql);
} else {
    // Mark as read if it was unread
    mysqli_query($conn, "UPDATE contacts SET status = 'READ' WHERE id = '$id' AND status = 'UNREAD'");
}

$sql = "SELECT * FROM contacts WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$message = mysqli_fetch_assoc($result);

if (!$message) {
    header("Location: messages.php");
    exit();
}

include 'includes/header.php';
?>


    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1>Message Details</h1>
            <p>From <?php echo $message['name']; ?> (<?php echo $message['email']; ?>)</p>
        </div>
        <a href="messages.php" style="text-decoration: none; color: var(--text-muted);">← Back to Messages</a>
    </div>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px;">
            <div class="content-card">
                <h3 style="margin-bottom: 20px;">Inquiry Content</h3>
                <div style="background: var(--bg-light); padding: 25px; border-radius: 12px; margin-bottom: 25px;">
                    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 10px;">Subject:</p>
                    <p style="font-weight: 600; font-size: 18px; margin-bottom: 20px;"><?php echo $message['subject']; ?></p>
                    
                    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 10px;">Message:</p>
                    <p style="line-height: 1.6; white-space: pre-wrap;"><?php echo $message['message']; ?></p>
                </div>

                <div style="font-size: 14px; color: var(--text-muted);">
                    Received on: <?php echo date('d M Y, h:i A', strtotime($message['created_at'])); ?>
                </div>
            </div>

            <div class="content-card">
                <h3 style="margin-bottom: 20px;">Admin Actions</h3>
                
                <?php if ($message['status'] == 'REPLIED') { ?>
                    <div style="background: #dcfce7; color: #166534; padding: 20px; border-radius: 12px; margin-bottom: 25px;">
                        <p style="font-weight: 600; margin-bottom: 10px;">Reply Sent:</p>
                        <p style="font-size: 15px; line-height: 1.5; font-style: italic;">"<?php echo $message['admin_reply']; ?>"</p>
                        <p style="font-size: 12px; margin-top: 15px; opacity: 0.8;">Replied on: <?php echo date('d M Y, h:i A', strtotime($message['replied_at'])); ?></p>
                    </div>
                <?php } ?>

                <form method="post" class="form-modern">
                    <div class="form-group">
                        <label>Enter Reply (Internal Note/Email Draft)</label>
                        <textarea name="admin_reply" style="height: 150px;" placeholder="Type your response here..." required><?php echo $message['admin_reply']; ?></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; border: none; padding: 12px; cursor: pointer;">
                        <?php echo ($message['status'] == 'REPLIED') ? 'Update Reply' : 'Send & Mark as Replied'; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
