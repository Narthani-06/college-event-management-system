<?php
include("../../config/db.php");
$msg = "";

if(isset($_POST['reset'])){
    $username = $_POST['username'];
    $newpass = $_POST['newpass'];

    $sql = "UPDATE admin_staff SET password='$newpass' WHERE username='$username'";
    if(mysqli_query($conn,$sql)){
        $msg = "Password Updated Successfully";
    } else {
        $msg = "Error!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
</head>
<body>
<h2>Reset Password</h2>
<p><?php echo $msg; ?></p>

<form method="post">
<input type="text" name="username" placeholder="Username" required><br><br>
<input type="password" name="newpass" placeholder="New Password" required><br><br>
<button name="reset">Reset</button>
</form>
</body>
</html>
