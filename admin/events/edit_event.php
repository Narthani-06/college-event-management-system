<?php
include("../includes/auth_check.php");
include("../../config/db.php");

$id=$_GET['id'];
$row=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM events WHERE id=$id"));

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $venue=$_POST['venue'];
    $date=$_POST['date'];

    mysqli_query($conn,"UPDATE events SET
    event_name='$name', venue='$venue', event_date='$date'
    WHERE id=$id");

    header("Location: view_events.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Event</title></head>
<body>
<h2>Edit Event</h2>

<form method="post">
<input name="name" value="<?php echo $row['event_name']; ?>"><br><br>
<input name="venue" value="<?php echo $row['venue']; ?>"><br><br>
<input type="date" name="date" value="<?php echo $row['event_date']; ?>"><br><br>
<button name="update">Update</button>
</form>

</body>
</html>
