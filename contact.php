<?php
include 'includes/header.php';
include 'config/db.php';

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        $successMsg = "Thank you! Your message has been sent successfully.";
    } else {
        $errorMsg = "Sorry, something went wrong. Please try again later.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Contact Us | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We would love to hear from you. Get in touch with our team.</p>
    </div>
</div>

<section class="container" style="margin-top: 60px;">
    <div class="grid-cols-3" style="grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">

        <!-- Left Box -->
        <div class="content-card">
            <h2>Get in Touch</h2>
            <p style="margin-bottom: 30px;">
                If you have any questions regarding ICAPO events, registration,
                or general inquiries, feel free to contact us. Our team will get
                back to you as soon as possible.
            </p>

            <div class="contact-details">
                <p><strong>Address:</strong><br>
                Department of Computer Applications,<br>
                St. Xavier’s College (Autonomous),<br>
                Palayamkottai, Tamil Nadu – 627002</p>

                <p style="margin-top: 20px;"><strong>Phone:</strong><br>
                +91 98426 08882<br>
                +91 99439 52643</p>

                <p style="margin-top: 20px;"><strong>Email:</strong><br>
                <a href="https://mail.google.com/mail/?view=cm&to=sxcicapo@gmail.com&su=ICAPO+Inquiry" target="_blank" rel="noopener noreferrer" style="color: var(--secondary); text-decoration: none;">sxcicapo@gmail.com</a></p>
            </div>
        </div>

        <!-- Right Box -->
        <div class="content-card">
            <h2>Send a Message</h2>

            <?php if($successMsg){ ?>
                <div class="alert-box alert-success">
                    <?php echo $successMsg; ?>
                </div>
            <?php } ?>

            <?php if($errorMsg){ ?>
                <div class="alert-box alert-error">
                    <?php echo $errorMsg; ?>
                </div>
            <?php } ?>

            <form method="post" class="form-modern">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label>Your Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="What is this about?" required>
                </div>
                <div class="form-group">
                    <label>Your Message</label>
                    <textarea name="message" placeholder="Type your message here..." style="height: 150px;" required></textarea>
                </div>
                <button type="submit" class="reg-btn" style="border: none; cursor: pointer; text-align: center;">Send Message</button>
            </form>
        </div>

    </div>
</section>

<!-- Auto hide success message -->
<script>
setTimeout(() => {
    const msg = document.querySelector('.success-msg');
    if(msg) msg.style.display = 'none';
}, 3000);

// Prevent resubmission on refresh
if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
