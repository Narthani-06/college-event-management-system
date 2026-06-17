<?php include 'includes/header.php'; ?>

<!-- ===== IMAGE SLIDER START ===== -->
<div class="slider">
    <div class="slides">
        <img src="includes/images/staff.jpeg" class="slide active">
        <img src="includes/images/mca2.jpeg" class="slide">
        <img src="includes/images/mca1.jpeg" class="slide">
        <img src="includes/images/bca3.jpeg" class="slide">
        <img src="includes/images/bca1.jpeg" class="slide">

    </div>
</div>
<!-- ===== IMAGE SLIDER END ===== -->


<div class="container" style="margin-top: 60px;">
    <div class="grid-cols-2" style="align-items: stretch; gap: 40px;">
        <div class="content-card"
            style="padding: 0; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.4); border: 1px solid var(--secondary); display: flex; flex-direction: column; justify-content: center; height: 100%; background: #1a1a1a;">
            <img src="includes/images/1234.jpeg" alt="ICAPO Campus"
                style="width: 100%; height: 100%; max-height: 100%; object-fit: contain; display: block;">
        </div>
        <div class="content-card"
            style="padding: 40px; display: flex; flex-direction: column; justify-content: center; height: 100%;">
            <h2 style="font-size: 32px; margin-bottom: 25px;">Welcome to <span class="section-underline">ICAPO</span>
            </h2>
            <p style="font-size: 16px; line-height: 1.8; color: var(--text-muted);">
                ICAPO is the premier intercollegiate technical symposium hosted by the <strong>Department of Computer
                    Applications</strong>, St. Xavier's College (Autonomous).
                More than just a competition, it's a celebration of innovation, creativity, and technological
                brilliance.
            </p>
            <p style="font-size: 16px; line-height: 1.8; color: var(--text-muted); margin-top: 20px;">
                We ignite the spark of innovation, providing a high-octane platform for the bright minds of the computer
                applications community to showcase their skills,
                solve real-world challenges, and lead the future of technology.
            </p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 40px; margin-bottom: 80px;">
    <div class="grid-cols-2">
        <!-- Column 1 -->
        <div class="content-card" style="padding: 0; overflow: hidden;">
            <img src="includes/images/" alt="Rose Marry College" style="width: 100%; height: 250px; object-fit: cover;">
            <div style="padding: 20px;">
                <p style="color: var(--text-muted);">We proudly congratulate our 1st Winner for their outstanding
                    performance.</p>
            </div>
        </div>

        <!-- Column 2 -->
        <div class="content-card" style="padding: 0; overflow: hidden;">
            <img src="includes/images/" alt="Description of Image 2"
                style="width: 100%; height: 250px; object-fit: cover;">
            <div style="padding: 20px;">
                <p style="color: var(--text-muted);">Congratulations to our Runner-Up for an exceptional performance.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ===== SLIDER SCRIPT (Pure JS) ===== -->
<script>
    let slideIndex = 0;
    let slides = document.querySelectorAll(".slide");

    function showSlides() {
        slides.forEach(slide => slide.classList.remove("active"));

        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        slides[slideIndex - 1].classList.add("active");

        setTimeout(showSlides, 3000); // 3 seconds
    }

    showSlides();
</script>

<section class="container" style="margin-bottom: 80px;">
    <h2 style="font-size: 32px; text-align: center; margin-bottom: 50px;">Upcoming <span
            class="section-underline-center">Events</span></h2>

    <div class="event-carousel-wrapper">
        <div class="event-track" id="eventTrack">
            <!-- Event 1 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_clip_carnival.png" alt="Clip Carnival"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Clip Carnival</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Reels Making</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="clip-carnival.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 2 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_design_hack.png" alt="Event 2"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Design Hack</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">UI/UX Designing</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="design-hack.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 3 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_script_clash.png" alt="Event 3"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Script Clash</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Paper Presentation</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="script-clash.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 4 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_think_a_thon.png" alt="Event 4"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Think a Thon</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Quiz</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="think-a-thon.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 5 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_bugbusters.png" alt="Event 5"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">BugBusters</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Debugging</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="bugbusters.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 6 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <img src="includes/images/event_trash_to_treasure.png" alt="Event 6"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Trash to Treasure</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Art from E Waste</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="trash-to-treasure.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>

            <!-- Event 7 -->
            <div class="content-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                <div
                    style="width: 100%; height: 200px; background: linear-gradient(135deg, #1a1a2e, #16213e); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                    <div style="font-size: 50px; animation: float 3s ease-in-out infinite;">🚀</div>
                    <div
                        style="position: absolute; bottom: 15px; width: 60%; height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px; overflow: hidden;">
                        <div
                            style="width: 80%; height: 100%; background: #e67e22; animation: slide 2s ease-in-out infinite;">
                        </div>
                    </div>
                </div>
                <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <h3 class="text-center">Promoware</h3>
                    <p class="text-center" style="color: var(--text-muted); margin-bottom: 15px;">Software Marketing</p>
                    <div style="margin-top: auto; width: 100%;">
                        <a href="promoware.php" class="reg-btn"
                            style="display: block; text-align: center; text-decoration: none; padding: 10px; font-size: 14px;">Read
                            More</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-dots" id="sliderDots">
            <!-- Dots will be generated by JS -->
        </div>
    </div>

    <div style="text-align: center; margin-top: 50px;">
        <a href="events.php" class="reg-btn"
            style="padding: 15px 40px; font-size: 16px; text-decoration: none; border: 2px solid var(--secondary); background: transparent; color: var(--secondary);">View
            All Events</a>
    </div>
</section>

<!-- ===== ACHIEVEMENTS SECTION START ===== -->
<div class="section-container" style="margin-bottom: 100px;">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 50px; font-size: 32px;">Our <span
                class="section-underline-center">Achievements</span></h2>
        <div class="grid-cols-3">
            <div class="stat-box">
                <h2 style="color: var(--secondary); font-size: 48px; margin-bottom: 10px;">600+</h2>
                <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted);">
                    Students Placed</p>
            </div>
            <div class="stat-box">
                <h2 style="color: var(--secondary); font-size: 48px; margin-bottom: 10px;">20+</h2>
                <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted);">
                    Participating Colleges</p>
            </div>
            <div class="stat-box">
                <h2 style="color: var(--secondary); font-size: 48px; margin-bottom: 10px;">25+</h2>
                <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted);">
                    Years of Excellence</p>
            </div>
        </div>
    </div>
</div>
<!-- ===== ACHIEVEMENTS SECTION END ===== -->

<!-- ===== CAROUSEL SCRIPT ===== -->
<script>
    const track = document.getElementById('eventTrack');
    const dotsContainer = document.getElementById('sliderDots');
    const cards = track.querySelectorAll('.content-card');
    let currentIndex = 0;

    function getItemsPerPage() {
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 1024) return 2;
        return 3;
    }

    function initDots() {
        dotsContainer.innerHTML = '';
        const itemsPerPage = getItemsPerPage();
        const totalSlides = Math.ceil(cards.length / itemsPerPage);

        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
    }

    function goToSlide(index) {
        const itemsPerPage = getItemsPerPage();
        const totalSlides = Math.ceil(cards.length / itemsPerPage);
        if (index >= totalSlides) index = 0;
        if (index < 0) index = totalSlides - 1;

        currentIndex = index;
        const offset = currentIndex * 100;
        track.style.transform = `translateX(-${offset}%)`;

        // Update dots
        const dots = dotsContainer.querySelectorAll('.dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    // Auto slide
    let autoSlideInterval = setInterval(() => {
        goToSlide(currentIndex + 1);
    }, 5000);

    // Reset auto slide on manual interaction
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, 5000);
    }

    window.addEventListener('resize', () => {
        initDots();
        goToSlide(0);
    });

    initDots();
</script>


<?php include 'includes/footer.php'; ?>