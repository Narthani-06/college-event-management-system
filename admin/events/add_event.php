<?php
include("../includes/auth_check.php");
include("../../config/db.php");
$msg="";

if(isset($_POST['save'])){
    $name=$_POST['name'];
    $sub=$_POST['sub'];
    $desc=$_POST['desc'];
    $venue=$_POST['venue'];
    $date=$_POST['date'];
    $time=$_POST['time'];

    $sql="INSERT INTO events
    (event_name,subtitle,description,venue,event_date,event_time,created_by)
    VALUES('$name','$sub','$desc','$venue','$date','$time','Admin')";

    if(mysqli_query($conn,$sql)){
        $msg="Event Added Successfully";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Event</title></head>
<body>
<h2>Add Event</h2>
<p><?php echo $msg; ?></p>

<form method="post">
<input name="name" placeholder="Event Name" required><br><br>
<input name="sub" placeholder="Subtitle"><br><br>
<textarea name="desc" placeholder="Description"></textarea><br><br>
<input name="venue" placeholder="Venue"><br><br>
<select name="venue">
<?php
$v=mysqli_query($conn,"SELECT * FROM venue");
while($row=mysqli_fetch_assoc($v)){
    echo "<option>".$row['venue_name']."</option>";
}
?>
</select>

<input type="date" name="date"><br><br>
<input name="time" placeholder="Time"><br><br>
<button name="save">Save</button>
</form>

<a href="view_events.php">Back</a>
</body>
</html>
