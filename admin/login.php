<?php
// Auto-Migration Check
include '../config/db.php';
$conn->query("CREATE TABLE IF NOT EXISTS contacts (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message TEXT NOT NULL, status VARCHAR(20) DEFAULT 'UNREAD', admin_reply TEXT NULL, replied_at TIMESTAMP NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
$conn->query("CREATE TABLE IF NOT EXISTS settings (config_key VARCHAR(50) PRIMARY KEY, config_value TEXT, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
$conn->query("INSERT IGNORE INTO settings (config_key, config_value) VALUES ('reg_status', 'open'), ('admin_email', 'admin@icapo.com'), ('portal_name', 'ICAPO Admin Portal')");

include 'includes/auth.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    include '../config/db.php';
    
    // Check staff table
    $stmt = $conn->prepare("SELECT id, password FROM staff WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Check password (matching plaintext for now as per previous logic, but ready for hashing)
        if ($pass === $row['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['staff_id'] = $row['id'];
            $_SESSION['username'] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | ICAPO</title>
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
            font-size: 32px;
            font-weight: 800;
        }
        .login-card p {
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 40px;
            font-size: 14px;
        }
        .form-group { margin-bottom: 25px; }
        .form-group label { color: var(--text-muted); display: block; margin-bottom: 10px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .form-group input {
            width: 100%;
            padding: 14px 18px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: all 0.3s ease;
            font-size: 15px;
        }
        .form-group input:focus { border-color: var(--primary); background: rgba(15, 23, 42, 0.8); }
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
        .btn-login:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(230, 126, 34, 0.5); }
        .error { color: var(--danger); text-align: center; margin-bottom: 25px; font-size: 14px; background: rgba(239, 68, 68, 0.1); padding: 10px; border-radius: 8px; border: 1px solid rgba(239, 68, 68, 0.2); }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>ICAPO Admin</h2>
        <p>Enter your credentials to manage the portal</p>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="e.g. admin" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
            <div style="text-align: center; margin-top: 20px;">
                <a href="forgot_password.php" style="color: var(--text-muted); text-decoration: none; font-size: 13px;">Forgot Password?</a>
            </div>
            <div style="text-align: center; margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px;">
                <a href="../index.php" style="color: var(--primary); text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>← Go to Home</span>
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
