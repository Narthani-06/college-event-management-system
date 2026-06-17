<?php
include 'includes/header.php';
include 'config/db.php';


// ─── Main Logic ──────────────────────────────────────────────────────────────
$error = '';
$registration = null;
$participants = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg_id = trim($_POST['reg_id'] ?? '');
    $amount = trim($_POST['amount'] ?? '');

    if ($reg_id && $amount) {
        // 1. Update payment status
        $stmt = $conn->prepare(
            "UPDATE registration SET payment_status = 'SUCCESS', amount = ?, payment_date = NOW() WHERE reg_id = ?"
        );
        $stmt->bind_param("is", $amount, $reg_id);
        $stmt->execute();
        $stmt->close();

        // 2. Fetch full registration row
        $stmt = $conn->prepare("SELECT * FROM registration WHERE reg_id = ?");
        $stmt->bind_param("s", $reg_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $registration = $result->fetch_assoc();
        $stmt->close();

        // 4. Fetch participants
        $stmt = $conn->prepare(
            "SELECT event_key, participant_name FROM participants WHERE reg_id = ? ORDER BY event_key"
        );
        $stmt->bind_param("s", $reg_id);
        $stmt->execute();
        $pResult = $stmt->get_result();
        while ($row = $pResult->fetch_assoc()) {
            $participants[$row['event_key']][] = $row['participant_name'];
        }
        $stmt->close();

    } else {
        $error = 'Invalid payment data received.';
    }
} else {
    $error = 'Invalid Access';
}

// ─── Event Icons ─────────────────────────────────────────────────────────────
$eventIcons = [
    'BugBusters (Debugging)' => '🐛',
    'Think a Thon (Quiz)' => '🧠',
    'Design Hack (UI/UX Designing)' => '🎨',
    'Script Clash (Paper Presentation)' => '📜',
    'Promoware (Software Marketing)' => '📢',
    'Trash to Treasure (Art from E Waste)' => '♻️',
    'Clip Carnival (Reels Making)' => '🎬',
];
?>

<head>
    <meta charset="UTF-8">
    <title>Payment Successful | ICAPO</title>
    <style>
        /* ════════════════════════════════════════
       SCREEN STYLES
    ════════════════════════════════════════ */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 30px;
            text-align: left;
        }

        @media (max-width: 600px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .detail-row {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .detail-label {
            font-size: 12px;
            color: var(--text-muted, #888);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 15px;
            color: var(--white, #fff);
            font-weight: 600;
            margin-top: 2px;
        }

        .participant-tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 13px;
            color: var(--text-main, #ddd);
            margin: 3px 3px 3px 0;
        }

        .pdf-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #1d976c, #00c9a7);
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(29, 151, 108, 0.35);
        }

        .pdf-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(29, 151, 108, 0.5);
        }

        /* ════════════════════════════════════════
       PRINT / PDF STYLES
    ════════════════════════════════════════ */
        .print-header {
            display: none;
        }

        @media print {

            .no-print,
            nav,
            header,
            footer,
            .page-banner,
            #mainNav {
                display: none !important;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            html,
            body {
                background: #fff !important;
                color: #111 !important;
                font-size: 13px !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print-header {
                display: block !important;
                text-align: center;
                padding: 16px 0 10px;
                border-bottom: 3px solid #1d976c;
                margin-bottom: 18px;
            }

            .print-header h2 {
                font-size: 20px;
                margin: 0 0 4px;
                color: #1d976c !important;
                font-weight: 800;
            }

            .print-header p {
                font-size: 12px;
                color: #555 !important;
                margin: 0;
            }

            .container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 16px !important;
            }

            .content-card,
            .print-card {
                background: #fff !important;
                border: 1.5px solid #1d976c !important;
                border-top: 6px solid #1d976c !important;
                box-shadow: none !important;
                border-radius: 10px !important;
                padding: 20px !important;
                margin: 0 !important;
            }

            h2 {
                color: #1d976c !important;
                font-size: 18px !important;
            }

            h3 {
                color: #c8950e !important;
                font-size: 14px !important;
                border-bottom: 1px solid #e5c46a !important;
                padding-bottom: 6px !important;
            }

            .pay-strip {
                background: #f0fdf6 !important;
                border: 1px solid #1d976c !important;
                border-radius: 8px !important;
                padding: 14px 18px !important;
                display: flex !important;
                justify-content: space-between !important;
                flex-wrap: wrap !important;
                gap: 10px !important;
                margin-bottom: 20px !important;
            }

            .strip-label {
                font-size: 10px !important;
                color: #666 !important;
                text-transform: uppercase !important;
            }

            .strip-val-id {
                font-size: 18px !important;
                font-weight: 800 !important;
                color: #1d976c !important;
            }

            .strip-val-amt {
                font-size: 22px !important;
                font-weight: 900 !important;
                color: #111 !important;
            }

            .strip-val-date {
                font-size: 13px !important;
                font-weight: 600 !important;
                color: #333 !important;
            }

            .success-badge {
                background: #d1fae5 !important;
                color: #065f46 !important;
                border: 1px solid #6ee7b7 !important;
                border-radius: 20px !important;
                padding: 4px 14px !important;
                font-size: 12px !important;
                font-weight: 700 !important;
                align-self: center !important;
            }

            .detail-grid {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 8px 24px !important;
            }

            .detail-row {
                border-bottom: 1px solid #e5e7eb !important;
                padding: 6px 0 !important;
            }

            .detail-label {
                font-size: 10px !important;
                color: #666 !important;
            }

            .detail-value {
                font-size: 13px !important;
                color: #111 !important;
                font-weight: 600 !important;
            }

            .event-card {
                background: #f9fafb !important;
                border: 1px solid #d1d5db !important;
                border-radius: 8px !important;
                padding: 10px 14px !important;
                margin-bottom: 8px !important;
            }

            .event-card strong {
                color: #111 !important;
                font-size: 13px !important;
            }

            .event-count-badge {
                background: #fef9c3 !important;
                color: #713f12 !important;
                border: 1px solid #fde68a !important;
                border-radius: 12px !important;
                padding: 2px 10px !important;
                font-size: 11px !important;
                font-weight: 700 !important;
            }

            .participant-tag {
                background: #f3f4f6 !important;
                border: 1px solid #d1d5db !important;
                color: #374151 !important;
                font-size: 11px !important;
                padding: 3px 10px !important;
                border-radius: 12px !important;
            }

            .print-footer {
                display: block !important;
                text-align: center;
                margin-top: 24px;
                padding-top: 12px;
                border-top: 1px solid #e5e7eb;
                font-size: 11px;
                color: #666 !important;
            }

            @page {
                margin: 15mm 12mm;
            }
        }
    </style>
</head>

<body>

    <div class="page-banner no-print" style="background: linear-gradient(135deg, #1d976c 0%, #1a1a1a 100%);">
        <div class="container">
            <h1 style="color: #fff !important;">Payment Successful</h1>
            <p style="color: rgba(255,255,255,0.8) !important;">Thank you for your registration. We look forward to
                seeing you at ICAPO!</p>
        </div>
    </div>

    <div class="container" style="max-width: 760px; margin-top: 60px; margin-bottom: 60px;">

        <?php if ($error): ?>
            <div class="content-card" style="text-align:center; border-top: 6px solid #ef4444;">
                <div style="font-size:50px; margin-bottom:15px;">❌</div>
                <p style="color: #ef4444; font-size:18px;"><?= htmlspecialchars($error) ?></p>
                <a href="registration.php" class="reg-btn"
                    style="padding:12px 30px; text-decoration:none; margin-top:20px; display:inline-block;">Go to
                    Registration</a>
            </div>

        <?php elseif ($registration): ?>

            <!-- Print Header (only shows when printing) -->
            <div class="print-header">
                <h2>🏆 ICAPO 2025 — Registration Confirmation</h2>
                <p>SXC Computer Science Department &nbsp;|&nbsp; 19-September-2025</p>
                <hr style="margin: 12px 0; border-color: #ccc;">
            </div>

            <!-- Success Card -->
            <div class="content-card print-card" style="border-top: 6px solid #1d976c;">

                <!-- Top section -->
                <div style="text-align:center; margin-bottom:35px;">
                    <div style="font-size:64px; margin-bottom:12px;">✅</div>
                    <h2 style="color: #1d976c; margin-bottom:6px;">Transaction Confirmed</h2>
                    <p style="color: var(--text-muted); font-size:14px;">Your registration for ICAPO 2025 has been recorded
                        successfully.</p>
                </div>


                <!-- Payment Summary Strip -->
                <div class="pay-strip"
                    style="background: linear-gradient(135deg,rgba(29,151,108,0.15),rgba(0,0,0,0)); border: 1px solid rgba(29,151,108,0.3); border-radius: 14px; padding: 20px 28px; margin-bottom: 30px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <div>
                        <div class="strip-label"
                            style="font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
                            Registration ID</div>
                        <div class="strip-val-id"
                            style="font-size:22px; font-weight:800; color:#1d976c; letter-spacing:1px;">
                            <?= htmlspecialchars($registration['reg_id']) ?>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div class="strip-label"
                            style="font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
                            Amount Paid</div>
                        <div class="strip-val-amt" style="font-size:28px; font-weight:900; color:var(--white);">₹
                            <?= number_format((float) $registration['amount'], 0) ?>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div class="strip-label"
                            style="font-size:12px; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
                            Payment Date</div>
                        <div class="strip-val-date" style="font-size:15px; font-weight:600; color:var(--text-main);">
                            <?= !empty($registration['payment_date']) ? date('d M Y, h:i A', strtotime($registration['payment_date'])) : date('d M Y') ?>
                        </div>
                    </div>
                    <div>
                        <span class="success-badge"
                            style="background:rgba(29,151,108,0.2); color:#1d976c; border:1px solid #1d976c; border-radius:20px; padding:5px 16px; font-size:13px; font-weight:700;">✔
                            SUCCESS</span>
                    </div>
                </div>

                <!-- Registration Details -->
                <h3
                    style="color:var(--secondary); font-size:16px; margin-bottom:18px; padding-bottom:8px; border-bottom:1px solid rgba(212,175,55,0.25);">
                    📋 Registration Details</h3>

                <div class="detail-grid" style="margin-bottom: 28px;">
                    <div class="detail-row">
                        <div class="detail-label">College Name</div>
                        <div class="detail-value"><?= htmlspecialchars($registration['college_name']) ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Staff Coordinator</div>
                        <div class="detail-value"><?= htmlspecialchars($registration['staff_name']) ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Contact Number</div>
                        <div class="detail-value">📞 <?= htmlspecialchars($registration['phone']) ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Participants</div>
                        <div class="detail-value"><?= (int) $registration['total'] ?> persons</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Veg / Non-Veg</div>
                        <div class="detail-value">🥦 <?= (int) $registration['veg'] ?> &nbsp;/&nbsp; 🍗
                            <?= (int) $registration['nonveg'] ?>
                        </div>
                    </div>
                </div>

                <!-- Events Registered -->
                <h3
                    style="color:var(--secondary); font-size:16px; margin-bottom:18px; padding-bottom:8px; border-bottom:1px solid rgba(212,175,55,0.25);">
                    🏆 Events Registered</h3>

                <?php
                $eventColumns = [
                    'debugging' => ['BugBusters (Debugging)', 'count' => (int) $registration['debugging']],
                    'quiz' => ['Think a Thon (Quiz)', 'count' => (int) $registration['quiz']],
                    'web_design' => ['Design Hack (UI/UX Designing)', 'count' => (int) $registration['web_design']],
                    'paper_present' => ['Script Clash (Paper Presentation)', 'count' => (int) $registration['paper_present']],
                    'best_manager' => ['Promoware (Software Marketing)', 'count' => (int) $registration['best_manager']],
                    'connection_game' => ['Trash to Treasure (Art from E Waste)', 'count' => (int) $registration['connection_game']],
                    'short_film' => ['Clip Carnival (Reels Making)', 'count' => (int) $registration['short_film']],
                ];
                $anyEvent = false;
                foreach ($eventColumns as $key => $info):
                    if ($info['count'] > 0):
                        $anyEvent = true;
                        ?>
                        <div class="event-card"
                            style="background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.07); border-radius:12px; padding:16px 20px; margin-bottom:14px;">
                            <div
                                style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px; margin-bottom:<?= !empty($participants[$info[0]]) ? '12px' : '0' ?>;">
                                <div>
                                    <span style="font-size:18px;"><?= $eventIcons[$info[0]] ?? '🎯' ?></span>
                                    <strong
                                        style="color:var(--white); font-size:15px; margin-left:8px;"><?= htmlspecialchars($info[0]) ?></strong>
                                </div>
                                <span class="event-count-badge"
                                    style="background:rgba(212,175,55,0.15); color:var(--secondary); border-radius:20px; padding:3px 12px; font-size:13px; font-weight:700;">
                                    <?= $info['count'] ?> participant<?= $info['count'] > 1 ? 's' : '' ?>
                                </span>
                            </div>
                            <?php if (!empty($participants[$info[0]])): ?>
                                <div
                                    style="display:flex; flex-wrap:wrap; gap:6px; margin-top:8px; padding-top:10px; border-top:1px solid rgba(255,255,255,0.05);">
                                    <?php foreach ($participants[$info[0]] as $pName): ?>
                                        <span class="participant-tag">👤 <?= htmlspecialchars($pName) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; endforeach; ?>
                <?php if (!$anyEvent): ?>
                    <p style="color:var(--text-muted); font-style:italic;">No events were registered.</p>
                <?php endif; ?>

                <!-- Action Buttons -->
                <div style="text-align:center; margin-top:36px; display:flex; justify-content:center; gap:16px; flex-wrap:wrap;"
                    class="no-print">
                    <button onclick="window.print()" class="pdf-btn">📄 Download PDF Receipt</button>
                    <a href="index.php" class="reg-btn" style="padding:14px 32px; text-decoration:none;">🏠 Back to Home</a>
                </div>

                <!-- Screen footer -->
                <div style="text-align:center; margin-top:28px; padding-top:20px; border-top:1px solid rgba(255,255,255,0.06); color:var(--text-muted); font-size:13px;"
                    class="no-print">
                    📅 Event Date: <strong style="color:var(--text-main);">19 September 2026</strong> &nbsp;|&nbsp;
                    📍 Department of Computer Applications
                </div>

                <!-- Print-only footer -->
                <div class="print-footer" style="display:none;">
                    <strong>ICAPO 2026</strong> &nbsp;|&nbsp; SXC Department of Computer Applications &nbsp;|&nbsp; 19
                    September 2026<br>
                    This is an official registration confirmation. Please keep it for your records.
                </div>
            </div>

        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>