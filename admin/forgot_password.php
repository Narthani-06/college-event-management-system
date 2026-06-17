<?php
session_start();
include '../config/db.php';

$error = "";
$success = "";
$step = 1; // 1: Email Form, 2: Reset Form

// Step 1: Verify Identity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_email'])) {
    $identity = trim($_POST['email']); // Can be email or username

    $stmt = $conn->prepare("SELECT id FROM staff WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $identity, $identity);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['reset_user_id'] = $user['id'];
        $step = 2;
    } else {
        $error = "Account not found! Please check your email or username.";
    }
}

// Step 2: Update Password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    if (isset($_SESSION['reset_user_id'])) {
        $new_pass = $_POST['password'];
        $confirm_pass = $_POST['confirm_password'];
        $user_id = $_SESSION['reset_user_id'];

        if ($new_pass === $confirm_pass) {
            $stmt = $conn->prepare("UPDATE staff SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_pass, $user_id);
            if ($stmt->execute()) {
                $success = "Password has been reset successfully! You can now login.";
                unset($_SESSION['reset_user_id']);
                $step = 1; // Back to start but with success
            } else {
                $error = "Something went wrong. Please try again.";
                $step = 2;
            }
        } else {
            $error = "Passwords do not match!";
            $step = 2;
        }
    } else {
        header("Location: forgot_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | ICAPO</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }
        .login-card h2 {
            font-family: 'Outfit', sans-serif;
            color: white;
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 800;
        }
        .login-card p {
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .error { color: #ef4444; text-align: center; margin-bottom: 20px; font-size: 14px; background: rgba(239, 68, 68, 0.1); padding: 10px; border-radius: 8px; border: 1px solid rgba(239, 68, 68, 0.2); }
        .success { color: #10b981; text-align: center; margin-bottom: 20px; font-size: 14px; background: rgba(16, 185, 129, 0.1); padding: 10px; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.2); }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        
        <?php if ($success): ?>
            <h2>Success!</h2>
            <div class="success"><?php echo $success; ?></div>
            <a href="login.php" class="btn-login" style="display: block; text-align: center; text-decoration: none;">Go to Login</a>
        <?php elseif ($step == 1): ?>
            <h2>Reset Password</h2>
            <p>Enter your email or username to reset your account</p>
            <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Email or Username</label>
                    <input type="text" name="email" class="form-control" placeholder="e.g. admin or staff@icapo.com" required>
                </div>
                <button type="submit" name="verify_email" class="btn-login">Next Step</button>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="login.php" style="color: var(--text-muted); text-decoration: none; font-size: 14px;">Back to Login</a>
                </div>
            </form>
        <?php elseif ($step == 2): ?>
            <h2>New Password</h2>
            <p>Create a strong password for your account</p>
            <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
            <form method="POST">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" name="reset_password" class="btn-login">Change Password</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
