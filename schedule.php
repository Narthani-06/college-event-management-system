<?php include 'includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Event Schedule | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Event Schedule</h1>
        <p>Mark your calendars: September 19, 2025</p>
    </div>
</div>

<div class="container" style="margin-top: 60px;">

    <!-- Schedule Table -->
    <div class="content-card">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th>Venue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config/db.php';
                $result = $conn->query("SELECT * FROM schedule ORDER BY order_index ASC");
                if ($result->num_rows > 0):
                    $count = 1;
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td data-label="#"><?php echo $count++; ?></td>
                    <td data-label="Time" class="time"><?php echo $row['time_slot']; ?></td>
                    <td data-label="Event"><?php echo $row['event_name']; ?></td>
                    <td data-label="Venue"><?php echo $row['venue']; ?></td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: var(--text-muted);">No schedule data available.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="content-card" style="margin-top: 30px; background: hsla(210, 87%, 16%, 0.05); color: var(--primary);">
            <strong>Note:</strong> Timing of the events is subject to change. Kindly follow the announcements.
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
