<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts: Inter and Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/icapowebsite/assets/css/style.css?v=1.1">
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <div class="top-content">
        <span><i class="far fa-calendar-alt"></i> <?php echo date("l, M d, Y"); ?></span>
        <span>
            <i class="fas fa-phone-alt"></i> +91 98426 08882 &nbsp; | &nbsp; 
            <i class="far fa-envelope"></i> sxcicapo@gmail.com
        </span>
    </div>
</div>

<!-- Navigation Menu -->
<header class="main-header">
    <div class="container">
        <a href="index.php" class="logo">
            <img src="includes/images/logo.png" alt="XCAPA Logo" class="logo-img">
            <span>ICAPO 2026</span>
        </a>

        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li class="dropdown">
                    <a href="#">Team ▾</a>
                    <ul class="dropdown-menu">
                        <li><a href="administrators.php">Administrators</a></li>
                        <li><a href="faculty.php">Faculty</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="events.php">Events ▾</a>
                    <ul class="dropdown-menu">
                        <?php 
                        require_once __DIR__ . '/../config/settings.php';
                        $reg_is_closed = ($portal_config['reg_status'] ?? 'open') == 'closed';
                        if (!$reg_is_closed): 
                        ?>
                        <li><a href="registration.php">Registration</a></li>
                        <?php endif; ?>
                        <li><a href="rules.php">General Rules</a></li>
                        <li><a href="schedule.php">Schedule</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        
        <div class="header-actions">
            <?php if ($reg_is_closed): ?>
                <span class="reg-btn" style="background: #475569 !important; cursor: not-allowed; color: #fff;">Closed</span>
            <?php else: ?>
                <a href="registration.php" class="reg-btn">Register Now</a>
            <?php endif; ?>
            <a href="admin/login.php" class="admin-btn">Admin</a>
        </div>
    </div>
</header>
