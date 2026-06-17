<?php
include 'includes/header.php';
require_once 'config/settings.php';

$is_closed = ($portal_config['reg_status'] ?? 'open') == 'closed';
?>

<head>
    <meta charset="UTF-8">
    <title>Registration | ICAPO</title>
</head>

<body>

    <div class="page-banner">
        <div class="container">
            <h1>Registration</h1>
            <p>Join the innovative computer application professionals ordeal.</p>
        </div>
    </div>

    <div class="container" style="margin-top: 60px; max-width: 900px;">

        <!-- Notice Box -->
        <div class="alert-box alert-info">
            <h3 style="color: var(--secondary); margin-bottom: 15px; font-size: 22px;">Registration Instructions</h3>
            <ul style="padding-left: 20px; color: var(--text-main);">
                <li style="margin-bottom: 8px;">Registration fee <strong>₹ 200/- per person</strong> will be paid on
                    <strong>date will be annoced later</strong>.</li>
                <li style="margin-bottom: 8px;">Enter college name, staff name, and phone number.</li>
                <li style="margin-bottom: 8px;">Select participant count per event — name fields will appear
                    automatically.</li>
                <li style="margin-bottom: 8px;">Enter each participant's <strong>full name exactly as it should appear
                        on their certificate</strong>.</li>
                <li style="margin-bottom: 8px;">Each participant can be registered for <strong>only one event</strong>.
                </li>
                <li style="margin-bottom: 8px;">You will receive a <strong>Unique Registration ID</strong> after
                    submission.</li>
                <li style="margin-bottom: 8px;">Avoid pressing the back button during registration.</li>
                <li style="margin-bottom: 8px;">Save your <strong>Registration ID</strong> for future reference.</li>
            </ul>
        </div>

        <div class="content-card">
            <h2 style="text-align: center; margin-bottom: 40px;">Registration Form</h2>

            <?php if ($is_closed): ?>
                <div
                    style="text-align: center; padding: 40px 20px; background: rgba(239, 68, 68, 0.05); border: 2px dashed rgba(239, 68, 68, 0.2); border-radius: 20px;">
                    <div style="font-size: 50px; margin-bottom: 20px;">🔒</div>
                    <h3 style="color: #ef4444; margin-bottom: 15px; font-size: 24px;">Registration is Currently Closed</h3>
                    <p style="color: #64748b; font-size: 16px; max-width: 500px; margin: 0 auto 25px;">
                        We are no longer accepting new registrations at this time. Please contact the administrators if you
                        have any questions.
                    </p>
                    <a href="index.php" class="btn-primary" style="display: inline-block; text-decoration: none;">Return to
                        Home</a>
                </div>
            <?php else: ?>
                <form method="POST" action="register_action.php" class="form-modern" id="regForm">

                    <div class="form-group">
                        <label>College Name</label>
                        <input type="text" name="college" placeholder="Enter your college name" required>
                    </div>

                    <div class="form-group">
                        <label>Department</label>
                        <select name="department" required>
                            <option value="">-- Select Department --</option>
                            <option value="B.Sc Computer Science">B.Sc Computer Science</option>
                            <option value="B.Sc Information Technology">B.Sc Information Technology</option>
                            <option value="BCA">BCA</option>
                            <option value="B.Sc Data Science">B.Sc Data Science</option>
                            <option value="B.Sc Artificial Intelligence">B.Sc Artificial Intelligence</option>
                            <option value="MCA">MCA</option>
                            <option value="M.Sc Computer Science">M.Sc Computer Science</option>
                            <option value="M.Sc Information Technology">M.Sc Information Technology</option>
                            <option value="BE Computer Science">BE Computer Science</option>
                            <option value="BE Information Technology">BE Information Technology</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Staff Coordinator Name</label>
                        <input type="text" name="staff" placeholder="Enter coordinator name" required>
                    </div>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="phone" placeholder="Enter 10-digit phone number" required maxlength="10"
                            pattern="\d{10}" title="Please enter exactly 10 digits"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>



                    <h3 style="margin: 30px 0 8px; color: var(--secondary); font-size: 18px;">Event-wise Participants</h3>
                    <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">
                        👇 Click an event card to participate. Name fields will appear automatically.
                    </p>

                    <?php
                    $events = [
                        "debugging"       => ["label" => "BugBusters (Debugging)",              "info" => "Individual — 1 Participant",  "slots" => 1, "icon" => "🐛"],
                        "quiz"            => ["label" => "Think a Thon (Quiz)",                  "info" => "Team — 2 Participants",        "slots" => 2, "icon" => "🧠"],
                        "web_design"      => ["label" => "Design Hack (UI/UX Designing)",        "info" => "Individual — 1 Participant",  "slots" => 1, "icon" => "🎨"],
                        "paper_present"   => ["label" => "Script Clash (Paper Presentation)",    "info" => "Max 2 per Team",              "slots" => 2, "icon" => "📄", "optional_from" => 2],
                        "best_manager"    => ["label" => "Promoware (Software Marketing)",       "info" => "Team — 2 Participants",        "slots" => 2, "icon" => "📣"],
                        "connection_game" => ["label" => "Trash to Treasure (Art from E Waste)", "info" => "Team — 2 Participants",        "slots" => 2, "icon" => "♻️"],
                        "short_film"      => ["label" => "Clip Carnival (Reels Making)",         "info" => "Team — 2 Participants",        "slots" => 2, "icon" => "🎬"]
                    ];

                    foreach ($events as $key => $data) {
                        $label        = $data['label'];
                        $info         = $data['info'];
                        $slots        = $data['slots'];
                        $icon         = $data['icon'];
                        $opt_from     = $data['optional_from'] ?? 0; // slot number from which fields become optional

                        $nameFields = '';
                        for ($i = 1; $i <= $slots; $i++) {
                            $isOptional   = ($opt_from > 0 && $i >= $opt_from);
                            $reqAttr      = $isOptional ? '' : 'data-required="1"';
                            $placeholder  = $isOptional
                                ? "Participant $i — Full name (Optional)"
                                : "Participant $i — Full name as on certificate";
                            $nameFields  .= "<div class='name-row'><span class='name-index'>$i</span><input type='text' name='participants[{$key}][]' placeholder='$placeholder' $reqAttr oninput='checkDuplicates()'></div>";
                        }

                        echo "
                    <div class='event-card' id='card_{$key}'>
                        <div class='event-card-header' onclick='toggleEvent(\"{$key}\", {$slots})'>
                            <div class='event-card-info'>
                                <span class='event-card-icon'>{$icon}</span>
                                <div>
                                    <div class='event-card-name'>{$label}</div>
                                    <div class='event-card-type'>{$info}</div>
                                </div>
                            </div>
                            <div class='event-toggle-wrap'>
                                <div class='event-toggle' id='toggle_{$key}'>
                                    <div class='toggle-knob'></div>
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name='{$key}' id='val_{$key}' value='0'>
                        <div class='event-name-fields' id='names_{$key}'>
                            {$nameFields}
                        </div>
                    </div>
                    ";
                    }
                    ?>

                    <!-- Total Participants (auto-calculated from events) -->
                    <div class="form-group" style="margin-top: 10px;">
                        <label>Total Participants <small style="color: var(--text-muted); font-size: 12px; font-weight: 400;">(Auto-calculated from event selections above)</small></label>
                        <input type="number" id="total_participants" name="total_participants" readonly
                            style="background: rgba(212,175,55,0.08); border-color: rgba(212,175,55,0.3); cursor: not-allowed;">
                    </div>

                    <div class="form-group">
                        <label>Total Amount <small style="color: var(--text-muted); font-size: 12px; font-weight: 400;">(₹ 200 per person)</small></label>
                        <input type="text" id="amount_display" readonly
                            style="background: rgba(212,175,55,0.08); border-color: rgba(212,175,55,0.3); cursor: not-allowed;">
                        <input type="hidden" id="amount" name="amount">
                    </div>

                    <h3 style="margin: 30px 0 8px; color: var(--secondary); font-size: 18px;">Food Preference</h3>
                    <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 16px;">
                        ℹ️ Veg + Non-Veg total must equal the total participants above.
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                        <div class="form-group">
                            <label>Veg Count</label>
                            <input type="number" id="veg_count" name="veg_count" value="0" min="0" oninput="validateFood()">
                        </div>
                        <div class="form-group">
                            <label>Non-Veg Count</label>
                            <input type="number" id="nonveg_count" name="nonveg_count" value="0" min="0" oninput="validateFood()">
                        </div>
                    </div>
                    <!-- Food mismatch warning -->
                    <div id="foodWarning"
                        style="display:none; background: rgba(239,68,68,0.1); border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 8px; color: #ef4444; margin-bottom: 15px; font-size: 14px;">
                        ⚠️ <strong>Mismatch:</strong> Veg + Non-Veg count (<span id="foodTotal">0</span>) does not match Total Participants (<span id="ptotalDisplay">0</span>).
                    </div>

                    <!-- Duplicate name warning -->
                    <div id="nameWarning"
                        style="display:none; background: rgba(239,68,68,0.1); border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 8px; color: #ef4444; margin-bottom: 15px; font-size: 14px;">
                        ⚠️ <strong>Warning:</strong> A participant cannot be registered for more than one event. Please
                        check the names below.
                    </div>

                    <button type="submit" class="reg-btn"
                        style="border: none; cursor: pointer; text-align: center; margin-top: 20px;"
                        onclick="return validateNames()">Proceed to Payment</button>

                </form>
            <?php endif; ?>
        </div>

    </div>

    <style>
        /* ── Event Toggle Cards ── */
        .event-card {
            background: rgba(255,255,255,0.03);
            border: 1.5px solid rgba(212,175,55,0.15);
            border-radius: 14px;
            margin-bottom: 12px;
            overflow: hidden;
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
        }
        .event-card.active {
            border-color: rgba(212,175,55,0.55);
            background: rgba(212,175,55,0.06);
            box-shadow: 0 4px 20px rgba(212,175,55,0.08);
        }
        .event-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            cursor: pointer;
            user-select: none;
        }
        .event-card-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .event-card-icon { font-size: 26px; }
        .event-card-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--white);
        }
        .event-card-type {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
        }
        /* Toggle switch */
        .event-toggle-wrap { flex-shrink: 0; }
        .event-toggle {
            width: 50px;
            height: 27px;
            background: rgba(255,255,255,0.12);
            border-radius: 14px;
            position: relative;
            transition: background 0.3s;
        }
        .event-card.active .event-toggle { background: var(--secondary, #D4AF37); }
        .toggle-knob {
            width: 21px;
            height: 21px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 3px;
            left: 3px;
            transition: left 0.3s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.3);
        }
        .event-card.active .toggle-knob { left: 26px; }
        /* Name fields inside card */
        .event-name-fields {
            display: none;
            padding: 6px 20px 18px;
            border-top: 1px solid rgba(212,175,55,0.12);
        }
        .event-card.active .event-name-fields { display: block; }
        .name-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        .name-index {
            width: 26px;
            height: 26px;
            background: rgba(212,175,55,0.18);
            color: var(--secondary, #D4AF37);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .event-name-fields input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            color: var(--white);
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        .event-name-fields input[type="text"]:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
        }
        .event-name-fields input[type="text"].duplicate-warning {
            border-color: #ef4444;
            background: rgba(239,68,68,0.06);
        }
    </style>

    <script>
        // Toggle event participation on card click
        function toggleEvent(key, slots) {
            const card       = document.getElementById('card_' + key);
            const valInput   = document.getElementById('val_'  + key);
            const nameFields = document.getElementById('names_' + key);
            const isActive   = card.classList.contains('active');

            if (isActive) {
                // Deactivate: clear & disable required
                card.classList.remove('active');
                valInput.value = 0;
                nameFields.querySelectorAll('input[type="text"]').forEach(inp => {
                    inp.required = false;
                    inp.value    = '';
                    inp.classList.remove('duplicate-warning');
                });
            } else {
                // Activate: set count & enable required on mandatory fields
                card.classList.add('active');
                valInput.value = slots;
                nameFields.querySelectorAll('input[type="text"]').forEach(inp => {
                    if (inp.dataset.required === '1') inp.required = true;
                });
            }

            calculateTotal();
            checkDuplicates();
        }

        function checkDuplicates() {
            const allInputs = document.querySelectorAll('.event-name-fields input[type="text"]');
            const nameMap   = {};
            let hasDuplicate = false;

            allInputs.forEach(inp => {
                inp.classList.remove('duplicate-warning');
                const val = inp.value.trim().toLowerCase();
                if (!val) return;
                if (!nameMap[val]) nameMap[val] = [];
                nameMap[val].push(inp);
            });

            for (const val in nameMap) {
                if (nameMap[val].length > 1) {
                    hasDuplicate = true;
                    nameMap[val].forEach(inp => inp.classList.add('duplicate-warning'));
                }
            }

            document.getElementById('nameWarning').style.display = hasDuplicate ? 'block' : 'none';
        }

        function validateNames() {
            // At least one event must be selected
            const total = parseInt(document.getElementById('total_participants').value) || 0;
            if (total === 0) {
                alert('குறைந்தது ஒரு event-ஐயாவது select பண்ணவும்.');
                return false;
            }

            const nameMap = {};
            const activeCards = document.querySelectorAll('.event-card.active');

            for (const card of activeCards) {
                const inputs = card.querySelectorAll('.event-name-fields input[type="text"]');
                for (const inp of inputs) {
                    // Only validate required fields
                    if (inp.dataset.required === '1' && !inp.value.trim()) {
                        alert('அனைத்து required participant பெயர்களையும் fill பண்ணவும்.');
                        inp.focus();
                        return false;
                    }
                    const val = inp.value.trim().toLowerCase();
                    if (!val) continue; // optional & empty — skip
                    if (nameMap[val]) {
                        alert(`"${inp.value.trim()}" என்பவர் ஒரே நேரத்தில் இரண்டு events-ல் register ஆக முடியாது.`);
                        inp.focus();
                        return false;
                    }
                    nameMap[val] = true;
                }
            }

            // Food total must match participant total
            const veg     = parseInt(document.getElementById('veg_count').value)    || 0;
            const nonveg  = parseInt(document.getElementById('nonveg_count').value) || 0;
            const foodSum = veg + nonveg;
            if (foodSum !== total) {
                alert(`Food count mismatch!\nVeg (${veg}) + Non-Veg (${nonveg}) = ${foodSum}\nTotal Participants = ${total}\n\nFood count-ஐ சரி பண்ணவும்.`);
                document.getElementById('veg_count').focus();
                return false;
            }

            return true;
        }

        function calculateTotal() {
            // Sum hidden val inputs of all active event cards
            let total = 0;
            document.querySelectorAll('.event-card.active').forEach(card => {
                const key = card.id.replace('card_', '');
                total += parseInt(document.getElementById('val_' + key).value) || 0;
            });

            document.getElementById('total_participants').value = total;
            const amount = total * 200;
            document.getElementById('amount_display').value = '₹ ' + amount.toLocaleString('en-IN');
            document.getElementById('amount').value = amount;
            document.getElementById('ptotalDisplay').textContent = total;
            validateFood();
        }

        function validateFood() {
            const veg     = parseInt(document.getElementById('veg_count').value)    || 0;
            const nonveg  = parseInt(document.getElementById('nonveg_count').value) || 0;
            const foodSum = veg + nonveg;
            const total   = parseInt(document.getElementById('total_participants').value) || 0;

            document.getElementById('foodTotal').textContent    = foodSum;
            document.getElementById('ptotalDisplay').textContent = total;

            const warn = document.getElementById('foodWarning');
            warn.style.display = (total > 0 && foodSum !== total) ? 'block' : 'none';
        }
    </script>

    <?php include 'includes/footer.php'; ?>