<?php include 'includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>BugBusters | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>BugBusters</h1>
        <p>Debugging: The quest to find and fix every flaw.</p>
    </div>
</div>

<div class="container" style="margin-top: 60px; margin-bottom: 60px;">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: stretch;">
        
        <!-- Rules & Description -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; height: 100%; border-left: 6px solid var(--primary); background: #fff;">
                <h2 style="font-size: 28px; margin-bottom: 25px; color: var(--primary);">BugBusters</h2>
                <p style="margin-bottom: 30px; font-size: 17px; line-height: 1.8;">
                    <strong>BugBusters</strong> tests your core programming logic and attention to detail. Identify logical and syntax errors in code snippets across various languages and fix them as fast as you can.
                </p>

                <h3 style="color: var(--secondary); margin-bottom: 20px; font-size: 20px; display: flex; align-items: center; gap: 10px;">
                    📜 Rules & Guidelines
                </h3>
                <ul style="padding-left: 20px; line-height: 2; color: var(--text-muted); font-size: 16px;">
                    <li>Individual event.</li>
                    <li>Prelims consist of multiple-choice and short bug-hunt questions.</li>
                    <li>Finalists will fix bugs in functional code on a live terminal.</li>
                    <li>Scoring based on accuracy and speed.</li>
                </ul>
            </div>
        </div>

        <!-- Image & Quick Info -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; padding: 0; height: 100%; display: flex; flex-direction: column; background: transparent; box-shadow: none;">
                <img src="includes/images/event_bugbusters.png" alt="BugBusters" 
                     style="width: 100%; height: 320px; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-strong);">
                
                <div style="margin-top: 30px; padding: 30px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); flex-grow: 1; display: flex; flex-direction: column; justify-content: center; border: 1px solid rgba(0,0,0,0.05);">
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(210, 87%, 16%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 20px;">⏱</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Duration</small>
                                <strong style="font-size: 16px;">1 Hour (Finals)</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(355, 78%, 56%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary); font-size: 20px;">📍</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Venue</small>
                                <strong style="font-size: 16px;">Fr. T.N. Siqueira Computer Centre</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: #2ecc7120; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #27ae60; font-size: 20px;">🕥</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Event Time</small>
                                <strong style="font-size: 16px;">11.45 AM – 12.45 PM</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
