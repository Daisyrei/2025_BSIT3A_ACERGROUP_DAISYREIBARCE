<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User - Submit Transaction</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Navbar Styles */
    .navbar {
      display: flex;
      justify-content: flex-end; 
      align-items: center;
      background-color: #0e2f1c;
      padding: 20px 20px;
      color: white;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-icons {
      display: flex;
      gap: 20px;
      margin-right: 30px;
    }

    .nav-icons a {
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .nav-icons a:hover {
      color: #f5b60f;
    }

    .profile-menu {
      position: relative;
    }

    .profile-icon {
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

    .profile-icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .dropdown {
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

    .dropdown a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: black;
      font-size: 14px;
    }

    .dropdown a:hover {
      background-color: #f5f5f5;
    }

    .profile-menu.active .dropdown {
      display: block;
    }

    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #1d4b0b;
    }

    .form-section {
      background: #1d4b0b;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      margin: 40px auto;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-container > div {
      padding: 20px;
      border: 1px solid #f5b60f;
      border-radius: 8px;
    }

    .personal-info {
      background-color: #f5b60f;
    }

    .item-info {
      background-color: #f5b60f;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .form-group {
      margin-bottom: 15px;
      max-width: 750px;
      margin-left: auto;
      margin-right: auto;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .submit-btn {
      width: 100%;
      padding: 10px;
      background-color: #197d50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background-color: #197d50;
    }

    img#item-preview {
      display: none;
      max-width: 100%;
      margin-top: 10px;
    }

    .personal-info h3,
    .item-info h3 {
      color: #1d4b0b; /* Bagong kulay para sa title lang */
    }
  </style>
</head>
<body>

  <!-- Navbar from about.php -->
  <div class="navbar">
    <!-- Navigation Icons -->
    <div class="nav-icons">
      <a href="home.php" data-tooltip="Home">Home</a>
      <a href="marketplace.php" data-tooltip="Marketplace">Marketplace</a>
      <a href="branch.php" data-tooltip="Branches">Branch</a>
      <a href="about.php" data-tooltip="About">About Us</a>
    </div>

    <!-- Cart Icon (katabi ng profile) -->
    <a href="cart.php" class="cart-icon" style="margin-right:20px;">
      <i class="fa fa-shopping-cart" style="font-size: 24px; color: white;"></i>
    </a>

    <!-- Profile Menu -->
    <div class="profile-menu">
      <div class="profile-icon" onclick="toggleProfileMenu()">
        <img src="name.png.png" alt="Profile">
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
  <!-- End Navbar -->

  <section class="form-section">
    <form class="form-container">
      <div class="personal-info">
        <h3>Personal Information</h3>
        <div class="form-group">
          <label for="name">Your Name</label>
          <input id="name" type="text" placeholder="Enter your full name" required />
        </div>
        <div class="form-group">
          <label for="contact">Contact Number</label>
          <input id="contact" type="text" placeholder="Enter your contact number (09XXXXXXXXX)" required />
        </div>
      </div>

      <div class="item-info">
        <h3>Item Information</h3>
        <div class="form-group">
          <label for="item-type">Item Type</label>
          <select id="item-type" required>
            <option value="">Select Type</option>
            <option>Necklace</option>
            <option>Bracelet</option>
            <option>Earrings</option>
            <option>Wrist Watch</option>
          </select>
        </div>
        <div class="form-group">
          <label for="item-description">Item Description</label>
          <input id="item-description" type="text" placeholder="E.g. Gold, Silver, Diamond" required />
        </div>
        <div class="form-group">
          <label for="item-photo">Upload Item Photo</label>
          <input id="item-photo" type="file" accept="image/*" required />
          <img id="item-preview" src="#" alt="Item Preview" />
        </div>
        <div class="form-group">
          <label for="valid-id">Upload Valid ID</label>
          <input id="valid-id" type="file" accept="image/*" required />
        </div>
        <div class="form-group">
          <label for="transaction-date">Transaction Date</label>
          <input id="transaction-date" type="date" readonly />
        </div>
        <button type="submit" class="submit-btn">Submit Request</button>
      </div>
    </form>
  </section>

  <script>
    // Profile dropdown toggle
    function toggleProfileMenu() {
      const profileMenu = document.querySelector('.profile-menu');
      profileMenu.classList.toggle('active');
    }
    document.addEventListener('click', function (event) {
      const profileMenu = document.querySelector('.profile-menu');
      if (profileMenu && !profileMenu.contains(event.target)) {
        profileMenu.classList.remove('active');
      }
    });

    document.getElementById('item-photo').addEventListener('change', function(event) {
      const preview = document.getElementById('item-preview');
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
    // Set today's date for transaction-date
    document.getElementById('transaction-date').value = new Date().toISOString().split('T')[0];
  </script>

</body>
</html>
