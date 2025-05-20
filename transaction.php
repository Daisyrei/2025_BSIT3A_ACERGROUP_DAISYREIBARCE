<?php
// You can add PHP logic here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iPawnshop - Transaction</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #1d4b0b;
      color: #333;
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
    }
    
    .navbar nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }
    
    .navbar nav ul li {
      cursor: pointer;
    }
    
    .navbar nav ul li.active {
      border-bottom: 2px solid #f5b60f;
    }
    
    .navbar .user {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .navbar .user button {
      background-color: white;
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .container {
      max-width: 900px;
      margin: 30px auto;
      padding: 20px;
    }
    
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #fff; /* Ginawang white ang title na New Transaction */
    }
    
    .card {
      background: #f5b60f;
      padding: 20px;
      margin-bottom: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .card h3 {
      margin-top: 0;
      margin-bottom: 15px;
      color: #1d4b0b; 
    }
    
    .form-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
      align-items: center; /* Center align all children horizontally */
    }
    
    .form-group label {
      font-weight: 600;
      margin-bottom: 5px;
      align-self: flex-start; /* Align label to the left */
    }
    
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select,
    textarea {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 15px;
      width: 100%;
      max-width: 900px; /* Consistent width for all inputs */
      box-sizing: border-box;
      margin-bottom: 5px;
    }
    
    textarea {
      resize: vertical;
      height: 80px;
    }
    
    .form-actions {
      text-align: center;
      margin-top: 20px;
    }
    
    .submit-btn,
    .clear-btn {
      padding: 10px 20px;
      font-size: 16px;
      margin: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    
    .submit-btn {
      background-color: #197d50;
      color: white;
    }
    
    .clear-btn {
      background-color: #e53935;
      color: white;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Navbar -->
  <div class="navbar" style="display: flex; justify-content: flex-end; align-items: center; background-color: #0e2f1c; padding: 20px 20px; color: white; position: sticky; top: 0; z-index: 1000;">
    <div class="nav-icons" style="display: flex; gap: 20px; margin-right: 30px;">
      <a href="home.php" data-tooltip="Home" style="color: white; text-decoration: none; font-size: 20px;">Home</a>
      <a href="marketplace.php" data-tooltip="Marketplace" style="color: white; text-decoration: none; font-size: 20px;">Marketplace</a>
      <a href="branch.php" data-tooltip="Branches" style="color: white; text-decoration: none; font-size: 20px;">Branch</a>
      <a href="about.php" data-tooltip="About" style="color: white; text-decoration: none; font-size: 20px;">About Us</a>
    </div>
    <!-- Cart Icon (katabi ng profile) -->
    <a href="cart.php" class="cart-icon" style="margin-right:20px;">
      <i class="fa fa-shopping-cart" style="font-size: 24px; color: white;"></i>
    </a>
    <!-- Profile Menu -->
    <div class="profile-menu" style="position: relative;">
      <div class="profile-icon" onclick="toggleProfileMenu()" style="width: 40px; height: 40px; background-color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; overflow: hidden;">
        <img src="name.png.png" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div class="dropdown" style="display: none; position: absolute; top: 50px; right: 0; background-color: white; color: black; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); border-radius: 5px; overflow: hidden; z-index: 1000;">
        <a href="profile.php" style="display: block; padding: 10px 20px; text-decoration: none; color: black; font-size: 14px;">Profile</a>
        <a href="transactions.php" style="display: block; padding: 10px 20px; text-decoration: none; color: black; font-size: 14px;">Transactions</a>
        <a href="loan.php" style="display: block; padding: 10px 20px; text-decoration: none; color: black; font-size: 14px;">Loan</a>
        <a href="payments.php" style="display: block; padding: 10px 20px; text-decoration: none; color: black; font-size: 14px;">Payments</a>
        <a href="sss.php" style="display: block; padding: 10px 20px; text-decoration: none; color: black; font-size: 14px;">Log Out</a>
      </div>
    </div>
  </div>
  <!-- End Navbar -->

  <main class="container">
    <h2>New Transaction</h2>

    <!-- Customer Info -->
    <section class="card">
      <h3>Customer Information</h3>
      <div class="form-group">
        <label>Name</label>
        <input type="text" placeholder="Full Name" />
      </div>
      <div class="form-group">
        <label>Contact No</label>
        <input type="text" placeholder="09XXXXXXXXX" />
      </div>
      <div class="form-group">
        <label>Address</label>
        <input type="text" placeholder="Address" />
      </div>
      <div class="form-group" style="align-items: flex-start;">
        <label>Valid ID</label>
        <input type="file" style="max-width: 300px;" />
      </div>
    </section>

    <!-- Pawn Item Info -->
    <section class="card">
      <h3>Pawn Item Details</h3>
      <div class="form-group">
        <label>Item Type</label>
        <select>
          <option>Necklace</option>
          <option>Bracelet</option>
          <option>Earings</option>
          <option>Wrist Watch</option>
        </select>
      </div>
      <div class="form-group">
        <label>Description</label>
        <input type="text" placeholder="E.g. Gold ring, iPhone 13" />
      </div>
      <div class="form-group">
        <label>Appraised Value (₱)</label>
        <input type="number" />
      </div>
      <div class="form-group">
        <label>Loan Amount (₱)</label>
        <input type="number" />
      </div>
      <div class="form-group">
        <label>Interest Rate (%)</label>
        <input type="number" value="3" />
      </div>
      <div class="form-group">
        <label>Term (Months)</label>
        <select>
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
    </section>

    <!-- Schedule & Notes -->
    <section class="card">
      <h3>Schedule & Notes</h3>
      <div class="form-group">
        <label>Transaction Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" />
      </div>
      <div class="form-group">
        <label>Maturity Date</label>
        <input type="date" />
      </div>
      <div class="form-group">
        <label>Notes</label>
        <textarea placeholder="Additional notes..."></textarea>
      </div>
      <!-- Ilagay dito ang form actions -->
      <div class="form-actions">
        <button class="submit-btn">Submit Transaction</button>
        <button class="clear-btn">Clear Form</button>
      </div>
    </section>
  </main>

  <script>
    function toggleProfileMenu() {
      const profileMenu = document.querySelector('.profile-menu');
      const dropdown = profileMenu.querySelector('.dropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }
    document.addEventListener('click', function (event) {
      const profileMenu = document.querySelector('.profile-menu');
      if (profileMenu && !profileMenu.contains(event.target)) {
        const dropdown = profileMenu.querySelector('.dropdown');
        if(dropdown) dropdown.style.display = 'none';
      }
    });
  </script>
</body>
</html>