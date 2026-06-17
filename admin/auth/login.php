<?php
session_start();
include("../../config/db.php");

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_staff WHERE username='$username' AND status=1";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);

        if($password == $row['password']){ // simple password (lab safe)
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "Invalid Username";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login | ICAPO</title>
<style>
body{font-family:Arial;background:#f4f6f9;}
.login-box{
    width:350px;margin:100px auto;
    background:#fff;padding:30px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
input,button{
    width:100%;padding:10px;margin:10px 0;
}
button{background:#0d1b42;color:#fff;border:none;}
.error{color:red;text-align:center;}
</style>
</head>
<body>

<div class="login-box">
<h2>Admin Login</h2>

<?php if($error!=""){ echo "<p class='error'>$error</p>"; } ?>

<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<a href="forgot_password.php">Forgot Password?</a>
</div>

</body>
</html>
