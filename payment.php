<?php include 'includes/header.php'; ?>

<?php
// Validation
if (!isset($_GET['reg_id']) || !isset($_GET['amount'])) {
    echo "<script>
        alert('Invalid access!');
        window.location.href = 'registration.php';
    </script>";
    exit;
}

$reg_id = $_GET['reg_id'];
$amount = $_GET['amount'];
?>

<head>
    <meta charset="UTF-8">
    <title>Payment | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Secure Payment</h1>
        <p>Complete your registration for ICAPO events.</p>
    </div>
</div>

<div class="container" style="max-width: 600px; margin-top: 60px; margin-bottom: 60px;">
    <div class="content-card" style="text-align: center;">
        <h2 style="margin-bottom: 30px; color: var(--secondary);">Registration Payment</h2>

        <div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: var(--radius-md); margin-bottom: 30px; border: 1px solid var(--glass-border);">
            <p style="font-size: 16px; margin-bottom: 15px; color: var(--text-main);"><strong>Registration ID:</strong> <span style="color: var(--secondary);"><?php echo htmlspecialchars($reg_id); ?></span></p>
            <p style="font-size: 26px; font-weight: 800; color: var(--white);">Total Amount: ₹ <?php echo htmlspecialchars($amount); ?></p>
        </div>

        <form action="payment_success.php" method="POST" id="payForm">
            <input type="hidden" name="reg_id" value="<?php echo htmlspecialchars($reg_id); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">

            <button type="button" onclick="paySuccess()" class="reg-btn" style="width: 100%; padding: 16px; font-size: 18px; cursor: pointer; border: none;">Proceed to Payment</button>
        </form>
        
        <p style="margin-top: 20px; font-size: 14px; color: var(--text-muted);">
            By clicking "Proceed to Payment", you will simulate a successful transaction.
        </p>
    </div>
</div>

<script>
function paySuccess() {
    alert("✅ Payment Successful!");
    document.getElementById("payForm").submit();
}
</script>

<?php include 'includes/footer.php'; ?>
