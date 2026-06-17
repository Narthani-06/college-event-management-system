<?php
include("../includes/auth_check.php");
include("../../config/db.php");

$res = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>View Events</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
table{width:90%;margin:30px auto;border-collapse:collapse;background:#fff;}
th,td{padding:10px;border:1px solid #ddd;text-align:left;}
a{margin-right:10px;}
.top{width:90%;margin:20px auto;}
.btn{padding:8px 12px;background:#0d1b42;color:#fff;text-decoration:none;}
</style>
</head>
<body>

<div class="top">
<a class="btn" href="add_event.php">+ Add Event</a>
<a class="btn" href="../dashboard.php">Dashboard</a>
</div>

<table>
<tr>
<th>ID</th><th>Name</th><th>Date</th><th>Venue</th><th>Action</th>
</tr>
<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['event_date']; ?></td>
<td><?php echo $row['venue']; ?></td>
<td>
<a href="edit_event.php?id=<?php echo $row['id']; ?>">Edit</a>
<a href="delete_event.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Delete this event?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>

</body>
</html>
