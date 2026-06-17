<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title><?php echo $page_title ?? 'Admin Dashboard'; ?> | ICAPO</title>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main-wrapper">
    <div class="admin-header">
        <h1><?php echo $page_title ?? 'Dashboard'; ?></h1>
        <div class="admin-user">
            <span style="color: var(--text-muted);">Welcome,</span> <strong>Admin</strong>
        </div>
    </div>
