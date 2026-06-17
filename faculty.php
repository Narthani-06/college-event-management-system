<?php include 'includes/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Faculty | ICAPO</title>
</head>

<body>

<div class="page-banner">
    <div class="container">
        <h1>Our Faculty</h1>
        <p>Expert guidance and mentorship for future IT professionals.</p>
    </div>
</div>

<div class="container" style="margin-top: 60px; margin-bottom: 60px;">
    <div class="grid-cols-3">
        <?php
        $faculty = [
            ["name" => "Dr. S. Chidambaranathan", "role" => "Associate Professor", "img" => "includes/images/nathansir.png"],
            ["name" => "Dr. A. Regita Thangam", "role" => "Head Of the Department", "img" => "includes/images/regita.png"],
            ["name" => "Dr. S. Saraswathi", "role" => "Assistant Professor", "img" => "includes/images/saraswathi.png"],
            ["name" => "Dr. R. Geetha", "role" => "Assistant Professor", "img" => "includes/images/geetha.png"],
            ["name" => "Ms. S. Arul Vallarasi", "role" => "Assistant Professor", "img" => "includes/images/arul.png"],
            ["name" => "Dr. K. Joy Alfia", "role" => "Assistant Professor", "img" => "includes/images/alfi.png"],
            ["name" => "Mr. E. Alex Prabhahar", "role" => "Assistant Professor", "img" => "includes/images/alex.png"],
            ["name" => "Mrs. J. Justus Jency", "role" => "Assistant Professor", "img" => "includes/images/jensi.png"],
            ["name" => "Ms. D. Jemima Jenifer", "role" => "Assistant Professor", "img" => "includes/images/jenifer.png"]
        ];

        foreach($faculty as $f){
            echo '
            <div class="content-card text-center">
                <div class="flex-center" style="margin-bottom: 20px;">
                    <img src="'.$f['img'].'" alt="'.$f['name'].'" style="width: 100%; max-width: 180px; border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; border: 4px solid var(--bg-light);">
                </div>
                <h3 style="color: var(--white); margin-bottom: 8px;">'.$f['name'].'</h3>
                <p style="color: var(--text-muted); font-size: 15px;">'.$f['role'].'</p>
            </div>';
        }
        ?>
    </div>
</div>

</body>


<?php include 'includes/footer.php'; ?>
