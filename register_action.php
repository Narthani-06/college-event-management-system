<?php
include 'config/db.php';
require_once 'config/settings.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Extra security check for registration status
    if (($portal_config['reg_status'] ?? 'open') == 'closed') {
        die("Registration is currently closed. Your submission was not processed.");
    }

    $college     = trim($_POST['college']);
    $department  = trim($_POST['department'] ?? '');
    $staff       = trim($_POST['staff']);
    $phone       = trim($_POST['phone']);

    $debugging   = (int)($_POST['debugging']   ?? 0);
    $quiz        = (int)($_POST['quiz']        ?? 0);
    $web         = (int)($_POST['web_design']  ?? 0);
    $paper       = (int)($_POST['paper_present'] ?? 0);
    $manager     = (int)($_POST['best_manager']  ?? 0);
    $connection  = (int)($_POST['connection_game'] ?? 0);
    $shortfilm   = (int)($_POST['short_film']  ?? 0);

    $veg         = (int)($_POST['veg_count']   ?? 0);
    $nonveg      = (int)($_POST['nonveg_count'] ?? 0);

    // Total participants is the SUM of all event counts (not food counts)
    $total = $debugging + $quiz + $web + $paper + $manager + $connection + $shortfilm;
    $amount = $total * 200;

    $reg_id      = "ICAPO" . rand(100000, 999999);
    $payment_status = "PENDING";

    // Insert main registration row
    $sql = "INSERT INTO registration 
    (reg_id, college_name, department, staff_name, phone,
     debugging, quiz, web_design, paper_present,
     best_manager, connection_game, short_film,
     veg, nonveg, total, amount, payment_status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssiiiiiiiiiiis",
        $reg_id,
        $college,
        $department,
        $staff,
        $phone,
        $debugging,
        $quiz,
        $web,
        $paper,
        $manager,
        $connection,
        $shortfilm,
        $veg,
        $nonveg,
        $total,
        $amount,
        $payment_status
    );

    if (!$stmt->execute()) {
        die("ERROR saving registration: " . $stmt->error);
    }

    // Human-readable event labels for display
    $event_labels = [
        "debugging"       => "BugBusters (Debugging)",
        "quiz"            => "Think a Thon (Quiz)",
        "web_design"      => "Design Hack (UI/UX Designing)",
        "paper_present"   => "Script Clash (Paper Presentation)",
        "best_manager"    => "Promoware (Software Marketing)",
        "connection_game" => "Trash to Treasure (Art from E Waste)",
        "short_film"      => "Clip Carnival (Reels Making)"
    ];

    // Save participant names
    if (!empty($_POST['participants']) && is_array($_POST['participants'])) {
        $pstmt = $conn->prepare("INSERT INTO participants (reg_id, event_key, participant_name) VALUES (?, ?, ?)");

        foreach ($_POST['participants'] as $event_key => $names) {
            $event_display = $event_labels[$event_key] ?? $event_key;
            if (is_array($names)) {
                foreach ($names as $name) {
                    $name = trim($name);
                    if ($name !== '') {
                        $pstmt->bind_param("sss", $reg_id, $event_display, $name);
                        $pstmt->execute();
                    }
                }
            }
        }
        $pstmt->close();
    }

    header("Location: payment.php?reg_id=$reg_id&amount=$amount");
    exit();
}
?>
