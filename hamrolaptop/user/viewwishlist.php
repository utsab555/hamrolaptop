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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
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

      #cardcontainer {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* Center-align the cards */
  gap: 20px; /* Space between cards */
  padding: 20px;
}

#cardcontainer div {
  flex: 1 1 calc(33.33% - 40px); /* Three cards in a row */
  max-width: 300px;
  height:auto;
  background: #013244;
  color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

#cardcontainer img {
  max-width: 100%; /* Ensure images fit within their containers */
  height: auto;
  object-fit: contain;
  border-radius: 5px;
  margin-bottom: 10px;
}

.cardspancolor {
  background: #377299;
  padding: 8px;
  border-radius: 5px;
  display: inline-block;
  margin: 10px auto;
  color: white;
}

.buy-btn,
.cart-btn {
  text-decoration: none;
  padding: 10px 15px;
  margin: 5px;
  border-radius: 5px;
  display: inline-block;
  font-size: 14px;
  color: white;
  transition: 0.3s;
}

.buy-btn {
  background-color: #28a745;
}

.cart-btn {
  background-color:rgb(17, 190, 167);
}

.buy-btn:hover {
  background-color: #218838;
}

.cart-btn:hover {
  background-color: #e0a800;
}

.parag{
  font-size: 15px;
  font-weight: bold;
  font-family: Arial, sans-serif;
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

<h1 align="center">Your Wishlist <button><a href="userprofile.php" style="font-size:40px; color:darkgreen;">X</a></button> </h1>



<div id="cardcontainer">
            <?php
            


            $user_id = $_SESSION['id'];

           
            $sql = "
            SELECT 
                w.wishlist_id, 
                w.laptop_id, 
                w.added_at,
                -- Laptop Details
                l.l_name AS laptop_name, 
                l.l_model AS laptop_model, 
                l.l_processor AS laptop_processor,
                l.l_ram AS laptop_ram, 
                l.l_storage AS laptop_storage, 
                l.l_display AS laptop_display, 
                l.l_amount AS laptop_amount, 
                l.l_addinfo AS laptop_addinfo, 
                l.l_image AS laptop_image,
                -- Category (Budget or Displayed)
                l.category AS laptop_category
            FROM 
                wishlist w 
            LEFT JOIN 
                laptops l ON w.laptop_id = l.l_id 
            WHERE 
                w.user_id = '$user_id';
            ";
            
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $wishlist_id = $row['wishlist_id'];
                    $added_at = $row['added_at'];
            
                    // Laptop Details
                    $laptop_name = $row['laptop_name'];
                    $laptop_model = $row['laptop_model'];
                    $laptop_processor = $row['laptop_processor'];
                    $laptop_ram = $row['laptop_ram'];
                    $laptop_storage = $row['laptop_storage'];
                    $laptop_display = $row['laptop_display'];
                    $laptop_amount = $row['laptop_amount'];
                    $laptop_addinfo = $row['laptop_addinfo'];
                    $laptop_image = $row['laptop_image'];
                    $laptop_category = $row['laptop_category']; // 'budget' or 'displayed'
            
                    // Display laptop information based on category
                    if ($laptop_category == 'budget') {
                        echo "
                        <div>
                            <b>$laptop_name (Budget)</b>
                            <img src='../laptops/$laptop_image' alt='$laptop_name'>
                            <div class='parag'>
                                <p>Price: रु. $laptop_amount</p>
                                <br>
                                <p style='text-align:left; color: #28a745;'>Specification:</p>
                                <p style='text-align:left;'>Model: $laptop_model</p>
                                <p style='text-align:left;'>Processor: $laptop_processor</p>
                                <p style='text-align:left;'>Ram: $laptop_ram</p>
                                <p style='text-align:left;'>Storage: $laptop_storage</p>
                                <p style='text-align:left;'>Display: $laptop_display</p>
                                <p style='text-align:left;'>Added on: $added_at</p>
                                <br>
                                <a href='removewishlist.php?id=$wishlist_id' class='buy-btn'>Remove from Wishlist</a>
                            </div>
                        </div>";
                    }
            
                    if ($laptop_category == 'displayed') {
                        echo "
                        <div>
                            <b>$laptop_name (Displayed)</b>
                            <img src='../laptops/$laptop_image' alt='$laptop_name'>
                            <div class='parag'>
                                <p>Price: रु. $laptop_amount</p>
                                <br>
                                <p style='text-align:left; color: #28a745;'>Specification:</p>
                                <p style='text-align:left;'>Model: $laptop_model</p>
                                <p style='text-align:left;'>Processor: $laptop_processor</p>
                                <p style='text-align:left;'>Ram: $laptop_ram</p>
                                <p style='text-align:left;'>Storage: $laptop_storage</p>
                                <p style='text-align:left;'>Display: $laptop_display</p>
                                <p style='text-align:left;'>Added on: $added_at</p>
                                <br>
                                <a href='removewishlist.php?id=$wishlist_id' class='buy-btn'>Remove from Wishlist</a>
                            </div>
                        </div>";
                    }
                }
            }
            

            ?>
          </div>
  
      

      <!--body part ends-->

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