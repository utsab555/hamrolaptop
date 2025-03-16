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
    <title>Your_Uploaded_laptops</title>
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


   table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 30px;
            margin-left: 30px;
            font-size: 18px;
            text-align: left;

        }
        table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

table tr:hover {
    background-color: rgb(4, 33, 36);
}

table a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    display: inline-block;
    margin-right: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.colorupdate {
    background-color: blue;
    border: 2px solid blue;
    padding: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    transition: background-color 0.3s ease;
}

.colorupdate:hover {
    background-color: darkblue;
}

.colordelete {
    background-color: red;
    border: 2px solid red;
    padding: 10px ;
    
    margin-right: 10px;
   
    transition: background-color 0.3s ease;
}

.colordelete:hover {
    background-color: darkred;
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
        <h1 align="center">Your Uploaded Laptops <button><a href="userprofile.php" style="font-size:30px; color:darkgreen;">X</a></button> </h1>
        <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Laptop Name</th>
                <th scope="col">Laptop Specifications</th>
                <th scope="col">Laptop Additional Details</th>
                <th scope="col">Amount</th>
                <th scope="col">Image</th>
                <th scope="col">Upload Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['id'];
        
                $sql = "SELECT l_id,l_name,l_model,l_processor,l_ram,l_storage,l_display,l_amount,l_addinfo,l_image,l_uploaddate,approval_status from laptops where l_userid = $user_id and category='second-hand'";
                $result = mysqli_query($conn, $sql);

                $orderlaptop = "SELECT * FROM orders WHERE seller_id = $user_id";
                $orderresult = mysqli_query($conn, $orderlaptop);
                
                // Check if query executed successfully
                if (!$orderresult) {
                    die("Error executing query: " . mysqli_error($conn));
                }
                
                // Fetch order details
                $orderrow = mysqli_fetch_assoc($orderresult);
                
                // Check if the order exists
                if ($orderrow) {
                    $buyerid = $orderrow['buyer_id'];
                
                    // Fetch buyer details
                    $buyername = "SELECT * FROM users WHERE id = $buyerid";
                    $buyerresult = mysqli_query($conn, $buyername);
                
                    // Check if query executed successfully
                    if (!$buyerresult) {
                        die("Error executing query: " . mysqli_error($conn));
                    }
                
                    // Fetch buyer data
                    $buyerrow = mysqli_fetch_assoc($buyerresult);
                    $buyername = $buyerrow['fullname'];
                } else {
                    // Handle case where no orders are found for this seller
                    echo "Noone has ordered your laptop yet.";
                }
                

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $l_id = $row['l_id'];
                        $l_name = $row['l_name'];
                        $l_model = $row['l_model'];
                        $l_processor = $row['l_processor'];
                        $l_ram = $row['l_ram'];
                        $l_storage = $row['l_storage'];
                        $l_display = $row['l_display'];
                        $l_amount = $row['l_amount'];
                        $l_addinfo = $row['l_addinfo'];
                        $imageUrl = $row['l_image'];
                        $uploaddate = $row['l_uploaddate'];
                        $status = $row['approval_status'];

                        if ($status == 'ordered') {
                          $text = "
                              <p>$status</p>
                              <p>by <a href='buyerprofile.php?user_id=$buyerid'>$buyername</a></p>
                          ";
                          $button = "";

                      } else {
                          $text = "
                            <p>$status</p>
                          ";
                          $button="    <a href='modifyuploadlaptop.php?id=$l_id' class='colorupdate' />Update</a>
                            <a href='deleteuploadlaptop.php?id=$l_id' class='colordelete'  onclick='return confirmDelete()'>Delete</a>
                            ";
                      }
                        
                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$l_id</th>
                            <td>$l_name</td>
                            <td>$l_model $l_processor $l_ram $l_storage $l_display</td>
                            <td>$l_addinfo</td>
                            <td>$l_amount</td>
                              <td><img src='../laptops/$imageUrl' alt='Image' style='width: 100px; height: auto;'></td>
                            <td>$uploaddate</td>
                            <td>$text</td>
                            <td>$button</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No blog entries found.</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
            ?>
            </tbody>
        </table>

        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete the laptop?");
            };
        </script>

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