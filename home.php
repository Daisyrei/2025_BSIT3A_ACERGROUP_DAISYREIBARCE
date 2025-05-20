<?php
// Include the database connection
include 'db.php';

// Handle search functionality
$search_results = [];
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql = "SELECT * FROM homepage_content WHERE section = 'items' AND title LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPawnshop - Home</title>
    <link rel="stylesheet" href="home.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdfdfd;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: #0e2f1c;
            padding: 10px 20px;
            color: white;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 20px;
            padding: 5px 10px;
            width: 200px;
        }

        .navbar .search-bar input {
            border: none;
            outline: none;
            width: 100%;
            padding: 5px;
            font-size: 14px;
        }

        .navbar .search-bar button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #4267B2;
        }

        .navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .navbar .nav-icons {
            display: flex;
            gap: 20px;
        }

        .navbar .nav-icons a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            position: relative;
        }

        .navbar .nav-icons a:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
        }

        .navbar .nav-icons a:hover {
            color: #f5cc59; /* Highlight on hover */
        }

        .navbar .profile-menu {
            position: relative;
        }

        .navbar .profile-menu .profile-icon {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            overflow: hidden;
        }

        .navbar .profile-menu .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .navbar .profile-menu .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            color: black;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1000;
        }

        .navbar .profile-menu .dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            font-size: 14px;
        }

        .navbar .profile-menu .dropdown a:hover {
            background-color: #f5f5f5;
        }

        .navbar .profile-menu.active .dropdown {
            display: block;
        }

        /* Slider Section */
        .slider {
            position: relative;
            width: 100%;
            height: 500px; /* Keep the slider height */
            overflow: hidden;
            background-color: #fdfdfd; /* Background color for empty space */
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            width: 100%;
            flex-shrink: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fdfdfd; /* Background color for empty space */
        }

        .slide img {
            width: 100%; /* Stretch the image to fill the width of the slide */
            height: 100%; /* Stretch the image to fill the height of the slide */
            object-fit: cover; /* Ensure the image fills the slide while maintaining aspect ratio */
            object-position: center; /* Center the image within the slide */
        }

        .slider .button {
            position: absolute;
            bottom: 20px; /* Position the button inside the slider */
            left: 50%;
            transform: translateX(-50%);
            background-color: #f5cc59;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            z-index: 2; /* Ensure the button is above the image */
        }

        .slider .button:hover {
            background-color: #d4a437;
        }

        /* Remove any margin or padding between sections */
        body, html {
            margin: 0;
            padding: 0;
        }

        .slider, .slides, .slide {
            margin: 0;
            padding: 0;
        }

        /* Navigation Arrows */
        .slider .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 1000;
        }

        .slider .arrow.left {
            left: 10px;
        }

        .slider .arrow.right {
            right: 10px;
        }

        .slider .arrow:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Items Section */
        .items-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color:rgb(216, 190, 58) !important; /* Deep green background */
            padding: 3rem 2rem;
        }

        .items-section h2 {
            color: #fff;
        }

        .items-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 200px;
            cursor: pointer;
        }

        .item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .item p {
            margin: 1rem 0;
            font-size: 1.1rem;
            color: #333;
            font-weight: bold;
        }

        .estimator-form {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 1rem 2rem;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(40,167,69,0.06);
            transition: box-shadow 0.3s, transform 0.3s, background 0.3s;
        }
        .estimator-form:hover {
            box-shadow: 0 8px 24px rgba(40,167,69,0.18), 0 1.5px 8px rgba(40,167,69,0.10);
            background: #f6fff8;
            transform: translateY(-4px) scale(1.015);
            border: 1.5px solid #28a745;
        }
        .estimator-form .form-row {
            display: contents;
        }
        .estimator-form label {
            align-self: center;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.3rem;
            text-align: left;      /* <-- Make label text left-aligned */
            padding-right: 0.5rem;
        }
        .estimator-form input[type="text"],
        .estimator-form input[type="number"],
        .estimator-form select,
        .estimator-form textarea,
        .estimator-form input[type="file"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .estimator-form textarea {
            resize: vertical;
        }
        .estimator-form .form-row.buttons-row {
            grid-column: 1 / -1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            gap: 1.5rem;
        }
        .estimator-form .form-row.buttons-row a,
        .estimator-form .form-row.buttons-row button {
            min-width: 140px;
            max-width: 200px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .estimator-form {
                grid-template-columns: 1fr;
            }
            .estimator-form label {
                text-align: left;
                padding-right: 0;
            }
            .estimator-form .form-row.buttons-row {
                flex-direction: column;
                gap: 1rem;
            }
        }

        .estimator-form select:focus,
        .estimator-form input[type="text"]:focus,
        .estimator-form input[type="number"]:focus,
        .estimator-form textarea:focus {
            outline: 2px solid #d4a437;
            background-color: #fffde7;
            transition: background 0.2s, outline 0.2s;
        }
        .estimator-form input[type="file"]::-webkit-file-upload-button {
            background: #d4a437;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }
        .estimator-form input[type="file"]::file-selector-button {
            background: #d4a437;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }

        .estimator-form .form-row > * {
            transition: box-shadow 0.2s, background 0.2s, border-color 0.2s;
        }

        .estimator-form .form-row:hover > * {
            box-shadow: 0 2px 12px rgba(40,167,69,0.10);
            background: #f6fff8;
            border-color: #28a745;
        }

        /* Make Back and Estimate Now buttons hoverable */
        .estimator-form .form-row.buttons-row a.button,
        .estimator-form .form-row.buttons-row button.button {
            transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        .estimator-form .form-row.buttons-row a.button:hover {
            background: #555;
            color: #fff;
            box-shadow: 0 4px 16px rgba(40,167,69,0.15);
            transform: translateY(-2px) scale(1.04);
            text-decoration: none;
        }

        .estimator-form .form-row.buttons-row button.button:hover {
            background: #218838;
            color: #fff;
            box-shadow: 0 4px 16px rgba(40,167,69,0.15);
            transform: translateY(-2px) scale(1.04);
        }

        .items-section#items-section {
            background-color: #1d4b0b !important;
        }
        .items-section#items-section h2,
        .items-section#items-section p {
            color: #fff;
        }

        /* Move navigation icons to the right, beside the profile menu */
        .navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }
    </style>
    <script>
        // Toggle profile dropdown visibility
        function toggleProfileMenu() {
            const profileMenu = document.querySelector('.profile-menu');
            profileMenu.classList.toggle('active');
        }

        // Close the dropdown if clicked outside
        document.addEventListener('click', function (event) {
            const profileMenu = document.querySelector('.profile-menu');
            if (!profileMenu.contains(event.target)) {
                profileMenu.classList.remove('active');
            }
        });

        let currentSlide = 0;
        let isDragging = false;
        let startPos = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            const slidesContainer = document.querySelector('.slides');
            const totalSlides = slidesContainer.children.length;
            currentSlide = (index + totalSlides) % totalSlides;
            slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function touchStart(index) {
            return function (event) {
                isDragging = true;
                startPos = getPositionX(event);
                animationID = requestAnimationFrame(animation);
                slides[index].classList.add('grabbing');
            };
        }

        function touchEnd() {
            isDragging = false;
            cancelAnimationFrame(animationID);
            const movedBy = currentTranslate - prevTranslate;

            if (movedBy < -100 && currentSlide < slides.length - 1) nextSlide();
            if (movedBy > 100 && currentSlide > 0) prevSlide();

            setPositionByIndex();
            slides.forEach(slide => slide.classList.remove('grabbing'));
        }

        function touchMove(event) {
            if (isDragging) {
                const currentPosition = getPositionX(event);
                currentTranslate = prevTranslate + currentPosition - startPos;
            }
        }

        function getPositionX(event) {
            return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
        }

        function animation() {
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.style.transform = `translateX(${currentTranslate}px)`;
            if (isDragging) requestAnimationFrame(animation);
        }

        function setPositionByIndex() {
            currentTranslate = currentSlide * -window.innerWidth;
            prevTranslate = currentTranslate;
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.style.transform = `translateX(${currentTranslate}px)`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.addEventListener('mousedown', touchStart(0));
            slidesContainer.addEventListener('mouseup', touchEnd);
            slidesContainer.addEventListener('mousemove', touchMove);
            slidesContainer.addEventListener('mouseleave', touchEnd);

            slidesContainer.addEventListener('touchstart', touchStart(0));
            slidesContainer.addEventListener('touchend', touchEnd);
            slidesContainer.addEventListener('touchmove', touchMove);

            setInterval(nextSlide, 5000); // Auto-slide every 5 seconds
        });

        // Simple estimator logic
        const multipliers = {
            "18k": 1800,
            "22k": 2200,
            "24k": 2500
        };

        function updateEstimate() {
            const grams = parseFloat(document.getElementById('grams').value) || 0;
            const model = document.getElementById('model').value;
            let estimate = 0;
            if (grams > 0 && multipliers[model]) {
                estimate = grams * multipliers[model];
            }
            document.getElementById('estimateResult').textContent = "Estimated Value: ₱" + estimate.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
        }

        document.getElementById('grams').addEventListener('input', updateEstimate);
        document.getElementById('model').addEventListener('change', updateEstimate);
    </script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <!-- Search Bar -->
        <!-- <form class="search-bar" method="GET" action="">
            <input type="text" name="search" placeholder="Search items..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">🔍</button>
        </form> -->

        <!-- Navigation Icons -->
        <div class="nav-right">
            <div class="nav-icons">
                <a href="home.php" data-tooltip="Home">Home</a>
                <a href="marketplace.php" data-tooltip="Marketplace">Marketplace</a>
                <a href="branch.php" data-tooltip="Branches">Branches</a>
                <a href="about.php" data-tooltip="About">About Us</a>
            </div>
            <!-- Cart Icon -->
            <a href="cart.php" class="cart-icon" data-tooltip="Cart" style="margin-left:15px;display:flex;align-items:center;">
                <span style="font-size: 24px; color: white;">🛒</span>
            </a>
            <!-- Profile Menu -->
            <div class="profile-menu">
                <div class="profile-icon" onclick="toggleProfileMenu()">
                    <img src="profile.jpg" alt="Profile">
                </div>
                <div class="dropdown">
                    <a href="profile.php">Profile</a>
                    <a href="transactions.php">Transactions</a>
                    <a href="loan.php">Loan</a>
                    <a href="payments.php">Payments</a>
                    <a href="sss.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- First Section: Slider -->
    <div class="slider">
        <div class="slides">
            <div class="slide">
                <img src="images/slider.png" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="Slider1.png" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="https://via.placeholder.com/1200x400.png?text=Slide+3" alt="Slide 3">
            </div>
        </div>
        <button class="button" onclick="window.location.href='marketplace.php'">SANGLA NOW</button>
        <button class="arrow left" onclick="prevSlide()">&#10094;</button>
        <button class="arrow right" onclick="nextSlide()">&#10095;</button>
    </div>
    
    <!-- Sangla Estimator Section -->
<section class="items-section" style="background-color:#fefefe; padding: 3rem 2rem;">
    <h2 style="color:#fffff;">Sangla Estimator</h2>
    <form id="sanglaForm" action="estimate_process.php" method="POST" enctype="multipart/form-data" class="estimator-form">
        <div class="form-row">
            <label for="item_type">Item Type</label>
            <select name="item_type" id="item_type" required>
                <option value="">Select item type</option>
                <option value="earrings">Earrings</option>
                <option value="necklace">Necklace</option>
                <option value="bracelet">Bracelet</option>
                <option value="wristwatch">Wristwatch</option>
                <option value="rings">Rings</option>
            </select>
        </div>
        <div class="form-row">
            <label for="branch">Branch</label>
            <select name="branch" id="branch" required>
                <option value="">Select branch</option>
                <option value="ligao">Ligao</option>
                <option value="polangui">Polangui</option>
                <option value="libon">Libon</option>
            </select>
        </div>
        <div class="form-row">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" placeholder="e.g., Mitana, Tala" required>
        </div>
        <div class="form-row">
            <label for="model">Model</label>
            <select name="model" id="model" required>
                <option value="">Select model</option>
                <option value="18k">18K</option>
                <option value="22k">22K</option>
                <option value="24k">24K</option>
            </select>
        </div>
        <div class="form-row">
            <label for="grams">Grams</label>
            <input type="number" step="0.01" name="grams" id="grams" placeholder="Weight in grams" required>
        </div>
        <div class="form-row">
            <label for="remarks">Remarks / Description</label>
            <textarea name="remarks" id="remarks" placeholder="Provide a short description..." rows="3" required></textarea>
        </div>
        <div class="form-row">
            <label for="photo">Photo (optional)</label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>
        <div class="form-row buttons-row">
            <a href="home.php" class="button" style="background-color: #888; color: white; padding: 10px 28px; text-decoration: none; border-radius: 5px; font-weight:bold;">Back</a>
            <button type="submit" class="button" style="background-color: #1d4b0b; color: white; padding: 12px 32px; border: none; border-radius: 5px; font-size: 1.1rem; font-weight: bold;">Estimate Now</button>
        </div>
    </form>
</section>
<style>
    .estimator-form select:focus,
    .estimator-form input[type="text"]:focus,
    .estimator-form input[type="number"]:focus,
    .estimator-form textarea:focus {
        outline: 2px solid #d4a437;
        background-color: #fffde7;
        transition: background 0.2s, outline 0.2s;
    }
    .estimator-form input[type="file"]::-webkit-file-upload-button {
        background: #d4a437;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
    }
    .estimator-form input[type="file"]::file-selector-button {
        background: #d4a437;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>
<script>
    // No estimated value display
</script>

    <!-- Second Section: Items We Accept -->
    <section class="items-section" id="items-section">
        <h2>Items We Accept</h2>
        <div class="items-container">
            <div class="item" onclick="window.location.href='marketplace.php?category=necklace'">
                <img src="images/necklace.jpg" alt="Necklace">
                <p>Necklace</p>
            </div>
            <div class="item" onclick="window.location.href='marketplace.php?category=earrings'">
                <img src="images/earrings.jpg" alt="Earrings">
                <p>Earrings</p>
            </div>
            <div class="item" onclick="window.location.href='marketplace.php?category=ring'">
                <img src="images/ring.jpg" alt="Ring">
                <p>Ring</p>
            </div>
            <div class="item" onclick="window.location.href='marketplace.php?category=watch'">
                <img src="images/watch.jpg" alt="Watch">
                <p>Watch</p>
            </div>
            <div class="item" onclick="window.location.href='marketplace.php?category=bracelet'">
                <img src="images/bracelet.jpg" alt="Bracelet">
                <p>Bracelet</p>
            </div>
        </div>
    </section>


    <!-- Search Results Section -->
    <?php if (!empty($search_results)): ?>
        <div class="search-results">
            <h2>Search Results</h2>
            <div class="items-container">
                <?php foreach ($search_results as $item): ?>
                    <div class="item">
                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>" onclick="window.location.href='<?php echo $item['link_url']; ?>'">
                        <p><?php echo $item['title']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>