<?php include 'includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Promoware | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Promoware</h1>
        <p>Software Marketing: Pitching the next big digital solution.</p>
    </div>
</div>

<div class="container" style="margin-top: 60px; margin-bottom: 60px;">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: stretch;">
        
        <!-- Rules & Description -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; height: 100%; border-left: 6px solid var(--primary); background: #fff;">
                <h2 style="font-size: 28px; margin-bottom: 25px; color: var(--primary);">Promoware</h2>
                <p style="margin-bottom: 30px; font-size: 17px; line-height: 1.8;">
                    <strong>Promoware</strong> is where business meets technology. Pitch your software idea, product, or solution to a panel of experts. Focus on your marketing strategy, unique value proposition, and business viability.
                </p>

                <h3 style="color: var(--secondary); margin-bottom: 20px; font-size: 20px; display: flex; align-items: center; gap: 10px;">
                    📜 Rules & Guidelines
                </h3>
                <ul style="padding-left: 20px; line-height: 2; color: var(--text-muted); font-size: 16px;">
                    <li>Two members per team.</li>
                    <li>Pitch duration: 5 minutes followed by 2 minutes Q&A.</li>
                    <li>Participants can present posters, prototypes, or marketing materials.</li>
                    <li>Focus on innovation and real-world applicability.</li>
                </ul>
            </div>
        </div>

        <!-- Image & Quick Info -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <div class="content-card" style="margin: 0; padding: 0; height: 100%; display: flex; flex-direction: column; background: transparent; box-shadow: none;">
                <!-- Premium CSS Illustration for Promoware -->
                <div class="promoware-illus" style="width: 100%; height: 320px; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; box-shadow: var(--shadow-strong);">
                    <!-- Decorative Elements -->
                    <div style="position: absolute; top: -50px; left: -50px; width: 150px; height: 150px; background: radial-gradient(circle, rgba(230, 126, 34, 0.2) 0%, transparent 70%);"></div>
                    <div style="position: absolute; bottom: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(52, 152, 219, 0.2) 0%, transparent 70%);"></div>
                    
                    <!-- Main Graphic Container -->
                    <div style="position: relative; z-index: 1; text-align: center;">
                        <!-- Rocket Animation -->
                        <div style="font-size: 80px; margin-bottom: 20px; filter: drop-shadow(0 0 20px rgba(230, 126, 34, 0.5)); animation: float 3s ease-in-out infinite;">🚀</div>
                        
                        <!-- Sales Chart Visual -->
                        <div style="display: flex; align-items: flex-end; justify-content: center; gap: 8px; height: 60px; margin-bottom: 20px;">
                            <div style="width: 12px; height: 30%; background: #e67e22; border-radius: 4px 4px 0 0; animation: grow 1.5s ease-out forwards; animation-delay: 0.2s;"></div>
                            <div style="width: 12px; height: 50%; background: #e67e22; border-radius: 4px 4px 0 0; animation: grow 1.5s ease-out forwards; animation-delay: 0.4s;"></div>
                            <div style="width: 12px; height: 40%; background: #e67e22; border-radius: 4px 4px 0 0; animation: grow 1.5s ease-out forwards; animation-delay: 0.6s;"></div>
                            <div style="width: 12px; height: 80%; background: #e67e22; border-radius: 4px 4px 0 0; animation: grow 1.5s ease-out forwards; animation-delay: 0.8s;"></div>
                            <div style="width: 12px; height: 100%; background: #2ecc71; border-radius: 4px 4px 0 0; animation: grow 1.5s ease-out forwards; animation-delay: 1.0s;"></div>
                        </div>
                        
                        <h4 style="font-size: 28px; color: white; margin: 0; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">Promoware</h4>
                        <p style="font-size: 16px; color: rgba(255,255,255,0.7); margin-top: 5px;">Software Marketing Battle</p>
                    </div>

                    <style>
                        @keyframes float {
                            0%, 100% { transform: translateY(0); }
                            50% { transform: translateY(-15px); }
                        }
                        @keyframes grow {
                            from { height: 0; }
                        }
                        .promoware-illus::before {
                            content: '';
                            position: absolute;
                            width: 200%;
                            height: 200%;
                            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.05), transparent);
                            top: -50%;
                            left: -50%;
                            transform: rotate(45deg);
                            animation: sweep 5s linear infinite;
                        }
                        @keyframes sweep {
                            from { transform: translateX(-100%) rotate(45deg); }
                            to { transform: translateX(100%) rotate(45deg); }
                        }
                    </style>
                </div>
                
                <div style="margin-top: 30px; padding: 30px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-soft); flex-grow: 1; display: flex; flex-direction: column; justify-content: center; border: 1px solid rgba(0,0,0,0.05);">
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(210, 87%, 16%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 20px;">⏱</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Duration</small>
                                <strong style="font-size: 16px;">1.5 Hours (Finals)</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: hsla(355, 78%, 56%, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--secondary); font-size: 20px;">📍</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Venue</small>
                                <strong style="font-size: 16px;">MCA Seminar Hall</strong>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 45px; height: 45px; background: #2ecc7120; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #27ae60; font-size: 20px;">🕥</div>
                            <div>
                                <small style="display: block; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 1px; font-weight: 700;">Event Time</small>
                                <strong style="font-size: 16px;">02.00 PM – 03.30 PM</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
