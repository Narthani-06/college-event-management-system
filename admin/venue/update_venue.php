<?php
include("../includes/auth_check.php");
include("../../config/db.php");

if(isset($_POST['add'])){
    $v=$_POST['venue'];
    mysqli_query($conn,"INSERT INTO venue(venue_name) VALUES('$v')");
}

if(isset($_GET['del'])){
    $id=$_GET['del'];
    mysqli_query($conn,"DELETE FROM venue WHERE id=$id");
}

$res=mysqli_query($conn,"SELECT * FROM venue");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Venue</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.box{width:400px;margin:30px auto;background:#fff;padding:20px;}
</style>
</head>
<body>

<div class="box">
<h2>Venue Management</h2>

<form method="post">
<input name="venue" placeholder="New Venue" required>
<button name="add">Add</button>
</form>

<hr>

<?php while($r=mysqli_fetch_assoc($res)){ ?>
<p>
<?php echo $r['venue_name']; ?>
<a href="?del=<?php echo $r['id']; ?>" onclick="return confirm('Delete?')">❌</a>
</p>
<?php } ?>

<a href="../dashboard.php">Back</a>
</div>

</body>
</html>
