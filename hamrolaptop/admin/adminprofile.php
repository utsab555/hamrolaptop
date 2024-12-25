<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hamro _Laptop_home_page</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>
        
/*your profile section starts*/


.card {
  background-color:dare;
  border-radius: var(--border-radius);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 20px;
}

.profile-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.profile-avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-right: 20px;
}

.profile-info h1 {
  margin: 0;
  font-size: 24px;
}

.profile-info p {
  margin: 5px 0;
  color: var(--text-muted);
}

.profile-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 10px;
}

.stat-item {
  background-color: var(--background-color);
  padding: 10px;
  border-radius: var(--border-radius);
  text-align: center;
}

.stat-value {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 5px;
  color:black;
}

.stat-label {
  font-size: 14px;
  color: var(--text-muted);
}

.quick-actions {
  margin-top: 20px;
}

.btn {
  display: inline-block;
  background-color: var(--primary-color);
  color: white;
  padding: 10px 15px;
  border-radius: var(--border-radius);
  text-decoration: none;
  margin-right: 10px;
  margin-bottom: 10px;
}

.recent-activity {
  list-style-type: none;
  padding: 0;
  color: #0a0d0c;
}

.activity-item {
  background-color: var(--background-color);
  padding: 10px;
  border-radius: var(--border-radius);
  margin-bottom: 10px;
}

.activity-item h4 {
  margin: 0 0 5px 0;
}

.activity-item p {
  margin: 0;
  font-size: 14px;
  color: var(--text-muted);
}
    </style>
  </head>


  <body>
    <!--side bar Nav starts here-->
    <label>
        <input type="checkbox" class="checkbox">
        <div class="toggle">
            <span class="top_line common"></span>
            <span class="middle_line common"></span>
            <span class="bottom_line common"></span>
        </div>
        <div class="slide">
            <br><br>
            <ul>
                <li><a href="admindashboard.php"><i class="fas fa-solid fa-house"></i>Home</a></li>

                <li><a href="adminprofile.php"><i class="fa-solid fa-user"></i>Admin Profile</a></li>
            </ul>
        </div>
    </label>
<!--side bar Nav ends here-->

<!--Nav bar-->
<nav class="navbar">
  <div class="navdiv">
    <div class="logo">

      <a href="admindashboard.php" class="title">Hamro laptop

      </a>
      <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
    </div>
    <ul>
      <button><a href="../logout.php">Logout</a></button>
  
    </ul>
  </div>
</nav>
<br />
<!--nav bar ends here-->

<!--your profile section starts-->
    <div class="indexcontainer">
        <div class="card">
            <div class="profile-header">
                <div class="profile-info">
                    <h1>Utsab Nepal</h1>
                    <p>Member since November 2024</p>
                </div>
            </div>
            <div class="profile-content">
                <div class="account-overview">
                    <h2>Account Overview</h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">3</div>
                            <div class="stat-label">Cart Items</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">7</div>
                            <div class="stat-label">Wishlist</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">8</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                    <div class="quick-actions">
                        <h3>Quick Actions</h3>
                        <a href="#" class="btn">View Cart</a>
                        <a href="#" class="btn">View Wishlist</a>
                        <a href="#" class="btn">Account Settings</a>
                        <a href="#" class="btn">Log Out</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
<!--your profile section starts-->

    <footer>
        <marquee class="marquee">
          Hurry Up!! / / Signup for deals / / Contact No.9861599807 / / Email:
          hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
          No.9861599807 / / Email: hamro_laptop@gmail.com
        </marquee>
      </footer>
      <script src="script.js"></script>
</body>
</html>