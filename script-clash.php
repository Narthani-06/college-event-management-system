<?php include 'includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Script Clash | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Script Clash</h1>
        <p>Paper Presentation: Presenting innovative ideas to the tech world.</p>
    </div>
</div>

<div class="container" style="margin-top: 60px; margin-bottom: 60px;">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: stretch;">
        
        <!-- Rules & Description -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; height: 100%; border-left: 6px solid var(--primary); background: #fff;">
                <h2 style="font-size: 28px; margin-bottom: 25px; color: var(--primary);">Script Clash</h2>
                <p style="margin-bottom: 30px; font-size: 17px; line-height: 1.8;">
                    <strong>Script Clash</strong> is a stage for technical excellence. Present your research, innovative concepts, and future visions in the field of computer applications and information technology.
                </p>

                <h3 style="color: var(--secondary); margin-bottom: 20px; font-size: 20px; display: flex; align-items: center; gap: 10px;">
                    📜 Rules & Guidelines
                </h3>
                <ul style="padding-left: 20px; line-height: 2; color: var(--text-muted); font-size: 16px;">
                    <li>A team can consist of an individual or maximum 2 members.</li>
                    <li>Time limit: 7 minutes for presentation + 3 minutes for Q&A.</li>
                    <li>Abstract submission is mandatory before the event date.</li>
                    <li>PPT and necessary presentation materials should be brought.</li>
                </ul>
            </div>
        </div>

        <!-- Image & Quick Info -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; padding: 0; height: 100%; display: flex; flex-direction: column; background: transparent; box-shadow: none;">
                <img src="includes/images/event_script_clash.png" alt="Script Clash" 
                     style="width: 100%; height: 320px; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-strong);">
                
                <div style="margin-top: 30px; padding: 30px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); flex-grow: 1; display: flex; flex-direction: column; justify-content: center; border: 1px solid rgba(0,0,0,0.05);">
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(210, 87%, 16%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 20px;">⏱</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Duration</small>
                                <strong style="font-size: 16px;">10 Mins per Team</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(355, 78%, 56%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary); font-size: 20px;">📍</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Venue</small>
                                <strong style="font-size: 16px;">Loyola Hall</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: #2ecc7120; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #27ae60; font-size: 20px;">🕥</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Event Time</small>
                                <strong style="font-size: 16px;">10.15 AM – 11.30 AM</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Suggested Topics Section -->
    <div class="content-card" style="margin-top: 50px; border-top: 5px solid var(--secondary);">
        <h3 style="color: var(--primary); margin-bottom: 25px; font-size: 22px; display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 26px;">💡</span> Suggested Topics
        </h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px 40px;">
            <ul style="padding-left: 20px; line-height: 2; color: var(--text-muted); font-size: 16px;">
                <li>Artificial Intelligence in Healthcare</li>
                <li>Blockchain for Secure Digital Voting</li>
                <li>Zero Trust Cybersecurity Architecture</li>
                <li>IoT and Smart City Solutions</li>
                <li>Edge Computing vs. Cloud Computing</li>
            </ul>
            <ul style="padding-left: 20px; line-height: 2; color: var(--text-muted); font-size: 16px;">
                <li>Quantum Computing: Future Challenges</li>
                <li>Ethical Hacking and Data Privacy</li>
                <li>Green Computing & Sustainable Tech</li>
                <li>AR/VR in Modern Education</li>
                <li>NLP and Large Language Models</li>
            </ul>
        </div>
        <p style="margin-top: 25px; font-style: italic; color: var(--text-muted); font-size: 14px; border-top: 1px solid var(--bg-light); padding-top: 15px;">
            * Participants can also choose their own innovative topics related to Information Technology.
    </div>

</div>

<?php include 'includes/footer.php'; ?>
