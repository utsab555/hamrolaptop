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
                <li><a href="about.html"><i class="fa-solid fa-info"></i>About</a></li>
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
      <button><a href="../logout.php">Logout</a></button>
  
    </ul>
  </div>
</nav>
<br />
<!--nav bar ends here-->

<h1 align="center">Your Cart <button><a href="userprofile.php" style="font-size:40px; color:darkgreen;">X</a></button> </h1>


<div id="cardcontainer">
            <?php
            


            $user_id = $_SESSION['id'];

           
    $sql = "SELECT c.cart_id, c.laptop_id,date(c.added_at) as added_at, l.l_name, l.l_model, l.l_processor, l.l_ram, l.l_storage, l.l_display, l.l_amount, l.l_addinfo, l.l_image 
        FROM cart c 
        JOIN second_hand_laptops l ON c.laptop_id = l.l_id 
        WHERE c.user_id = '$user_id'";

    $result = mysqli_query($conn, $sql);
  
            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                $cart_id = $row['cart_id'];
                $added_at = $row['added_at'];
                $l_name = $row['l_name'];
                $l_model = $row['l_model'];
                $l_processor = $row['l_processor'];
                $l_ram = $row['l_ram'];
                $l_storage = $row['l_storage'];
                $l_display = $row['l_display'];
                $l_amount = $row['l_amount'];
                $l_addinfo = $row['l_addinfo'];
                $imageUrl = $row['l_image'];
              

          
      
                echo "
                <div>
                  <b>$l_name</b>
                  <img src='../second_hand_laptops/$imageUrl' alt='$l_name'>
<div class='parag'>
                  <p>Price: रु. $l_amount</p>
                  <br>
                  <p style='text-align:left; color: #28a745;'>Specification:</p>
                  <p style='text-align:left;'>Model: $l_model</p>
                  <p style='text-align:left;'>Processor: $l_processor</p>
                  <p style='text-align:left;'>Ram: $l_ram</p>
                  <p style='text-align:left;'>Storage: $l_storage</p>
                  <p style='text-align:left;'>Display: $l_display</p>
                  <p style='text-align:left;'>Added on: $added_at</p>
                  <br>
                  <a href='buy.php' class='buy-btn'>Buy Now</a>
                  <a href='removecart.php?id=$cart_id' class='buy-btn'>Remove from Cart</a>
                </div></div>";
              }
            }
            ?>
          </div>
  
      

      <!--body part ends-->
    <footer>
      <marquee class="marquee">
        Hurry Up!! / / Signup for deals / / Contact No.9861599807, 9764395096 / / Email:
        hamro_laptop@gmail.com / / Hurry Up!! / / Signup for deals / / Contact
        No.9861599807, 9764395096 / / Email: hamro_laptop@gmail.com
      </marquee>
    </footer>
    <script src="script.js"></script>
  </body>
</html>