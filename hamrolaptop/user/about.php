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
    <title>Hamro _Laptop_about_page</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <style>

.profile-container {
  position: relative;
}

.profile-pic {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  object-fit: cover;
  cursor: pointer;
  border: 2px solid #ddd;
  margin-top: 10px;
}

.dropdown {
  display: none;
  position: absolute;
  top: 50px;
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px;
  width: 150px;
  z-index: 100;
}

.dropdown a {
  width: 100%;
  padding: 10px;
  border: none;
  background-color: transparent;
  text-align: left;
  cursor: pointer;
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
              <li><a href="index.php"><i class="fas fa-solid fa-house"></i>Home</a></li>
              <li><a href="budget.php"><i class="fa-solid fa-laptop-code"></i>Budget Laptops</a></li>
              <li><a href="buy.php"><i class="fa-solid fa-laptop"></i>Second-hand Laptops</a></li>
              <div class="gapbuysell">

              <li><a href="buy.php"><i class="fa-solid fa-cart-plus"></i>Buy</a></li>
              <li><a href="sell.php"><i class="fa-solid fa-sack-dollar"></i></i>Sell</a></li>
          </div>

              <li><a href="userprofile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
              <li><a href="about.php"><i class="fa-solid fa-info"></i>About</a></li>
          </ul>
      </div>
  </label>
<!--side bar Nav ends here-->

<!--Nav bar-->
<nav class="navbar">
<div class="navdiv">
  <div class="logo">

    <a href="index.php" class="title">Hamro laptop

    </a>
    <a style="margin-left: 190px;"> <img src="logo.jpg" height="30" /></a>
  </div>
  <ul>

  <div class="profile-container">
      <img src="../<?php echo $_SESSION['imageUrl']?>" alt="Profile Picture" class="profile-pic" id="profilePic">
      <div class="dropdown" id="dropdown">
        <a href="userprofile.php"><i class="fa-solid fa-user"></i> Your Profile</a>
        <hr style="color: white;">
        <a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
      </div>
    </div>

  </ul>
</div>
</nav>
<br />
<!--nav bar ends here-->
  
<!-- about page starts here-->
<!--about us section starts here-->
<div class="heading">
    <h1>About Us</h1>
    <p><span class="bigletter">W</span>elcome to Hamro Laptop, your trusted partner for quality second-hand laptops.
<br>At Hamro Laptop, we believe that everyone deserves access to reliable and affordable technology without
 compromising on quality. Our mission is to bridge the gap between premium computing and cost-effectiveness by 
 offering refurbished laptops that meet modern demands at a fraction of the price.</p>
</div>
<div class="container">
    <section class="about">
        <div class="about-img">
            <img src="about_us_img.jpg">
        </div>
        <div class="about-content">
            <h2>Why Choose Us?</h2>
<p>
    Every laptop in our inventory undergoes a rigorous testing process to ensure it performs flawlessly.
    From hardware checks to software optimization, we leave no detail overlooked.
    Whether you’re a student, a professional, or someone seeking a reliable laptop for personal use, 
    our diverse collection caters to all needs and budgets.
    Our dedicated team is here to assist you every step of the way. From selecting the perfect laptop to 
    after-sales support, your satisfaction is our priority.
</p>      
  
    <h2>Our Vision</h2>
    <p>We envision a world where technology is accessible to all, empowering individuals and businesses alike. By providing top-notch second-hand laptops, we aim to make technology affordable, reliable, and sustainable.</p>
       <h2>Join the Hamro Laptop family</h2>
       <p> When you shop with us, you're not just buying a laptop – you're investing in quality, sustainability,
         and a commitment to excellence. Explore our range of refurbished laptops and find the perfect device 
         for your needs today!
         Thank you for trusting Hamro Laptop. Let's power up your tech journey together.
        </p> 
</div>
    </section>
</div>

<!--about us section ends here-->

<!--contact us section starts here-->
<div class="heading">
<h1>Contact Us</h1>
</div>
<div class="contact-section">
  <div class="contact-item">
    <i class="fa-solid fa-phone"></i>
     <button class="shopbtn"><a href="https//:www.facebook.com/hamrolaptop">01-5353308, 01-5348500</a></button> 
  </div>
  <div class="contact-item">
    <i class="fa-solid fa-envelope"></i>
      <button class="shopbtn"><a href="https//:www.x.com/hamrolaptop">hamro_laptop@gmail.com</a></button> 
    </div>
  <div class="contact-item">
    <i class="fa-sharp fa-solid fa-location-dot"></i>
      <button class="shopbtn"><a href="https//:www.instagram.com/hamrolaptop">Newroad, Kathmandu</a></button> 
    </div>

</div>
<br>
<br>
<!--contact us section ends here-->

<!--Social media section starts here-->



<div class="contact-section">
  <div class="contact-item">
      <i class="fab fa-facebook"></i>
     <button class="shopbtn"><a href="https//:www.facebook.com/hamrolaptop">Facebook</a></button> 
  </div>
  <div class="contact-item">
      <i class="fab fa-twitter"></i>
      <button class="shopbtn"><a href="https//:www.x.com/hamrolaptop">X</a></button> 
    </div>
  <div class="contact-item">
      <i class="fab fa-instagram"></i>
      <button class="shopbtn"><a href="https//:www.instagram.com/hamrolaptop">Instagram</a></button> 
    </div>
  <div class="contact-item">
      <i class="fab fa-linkedin"></i>
      <button class="shopbtn"><a href="https//:www.linkedin.com/hamrolaptop">Linkedin</a></button> 
    </div>
  <div class="contact-item">
      <i class="fab fa-youtube"></i>
      <button class="shopbtn"><a href="https//:www.youtube.com/hamrolaptop">Youtube</a></button> 
    </div>
</div>
<br>
<br>
<!--social media section ends here-->



<!--about page ends here-->

    <footer>
        <marquee class="marquee">
            Hurry Up!! / / Signup for deals / / Contact No.9861599807 / / Email:
            hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
            No.9861599807 / / Email: hamro_laptop@gmail.com
          </marquee>
      </footer>
      <script src="script.js"></script> 

      <script>
        
        const profilePic = document.getElementById("profilePic");
const dropdown = document.getElementById("dropdown");

// Toggle the dropdown visibility
profilePic.addEventListener("click", () => {
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Close the dropdown if clicked outside
document.addEventListener("click", (e) => {
  if (!profilePic.contains(e.target) && !dropdown.contains(e.target)) {
    dropdown.style.display = "none";
  }
});

// Example functions for buttons
function viewProfile() {
  alert("Redirecting to your profile...");
  // Add logic for redirecting to the user's profile page
}

function logout() {
  alert("Logging out...");
  // Add logic for logging the user out
}

      
      </script>

</body>
</html>