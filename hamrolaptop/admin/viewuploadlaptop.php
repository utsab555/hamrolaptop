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
    <title>User_Uploaded_Laptop_list</title>
    <link rel="website icon" href="logo.jpg" type="h/jpg" />
    <link rel="stylesheet" href="../style.css" />
    <style>
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
                <li><a href="admindashboard.php"><i class="fas fa-solid fa-house"></i>Home</a></li>
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
    <h1 align="center">Pending User Uploaded Laptops<button><a href="admindashboard.php" style="font-size:30px; color:darkred;">X</a></button> </h1>
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
                <th scope="col">Uploaded By</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT s.l_id,s.l_name,u.fullname as username,s.l_model,s.l_processor,s.l_ram,s.l_storage,s.l_display,s.l_amount,s.l_addinfo,s.l_image,s.l_uploaddate,s.approval_status from laptops s join users u on s.l_userid = u.id where s.approval_status = 'pending' and s.category='second-hand'";
                $result = mysqli_query($conn, $sql);

               

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
                        $username = $row['username'];
                        
                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$l_id</th>
                            <td>$l_name</td>
                            <td>$l_model $l_processor $l_ram $l_storage $l_display</td>
                            <td>$l_addinfo</td>
                            <td>$l_amount</td>
                              <td><img src='../second_hand_laptops/$imageUrl' alt='Image' style='width: 100px; height: auto;'></td>
                            <td>$uploaddate</td>
                            <td>$username</td>
                            <td>$status</td>
                            <td>
                                 <a href='approve.php?id=$l_id' class='colorupdate' />Approve</a>
                            <a href='reject.php?id=$l_id' class='colordelete'  onclick='return confirmDelete()'>Reject</a>
                            </td>
                        </tr>
                        ";
                    }
                }
                else {
                    echo "<tr><td colspan='6'>No laptops found.</td></tr>";
                }

                
            ?>
            </tbody>
        </table>




        <h1 align="center">Approved User Uploaded Laptops</h1>
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
                <th scope="col">Uploaded By</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT s.l_id,s.l_name,u.fullname as username,s.l_model,s.l_processor,s.l_ram,s.l_storage,s.l_display,s.l_amount,s.l_addinfo,s.l_image,s.l_uploaddate,s.approval_status from laptops s join users u on s.l_userid = u.id where s.category='second-hand' and s.approval_status='approved'";
                $result = mysqli_query($conn, $sql);

               

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
                        $username = $row['username'];
                        $status = $row['approval_status'];
                        
                        // Display each row
                        echo "
                        <tr>
                            <th scope='row'>$l_id</th>
                            <td>$l_name</td>
                            <td>$l_model $l_processor $l_ram $l_storage $l_display</td>
                            <td>$l_addinfo</td>
                            <td>$l_amount</td>
                              <td><img src='../second_hand_laptops/$imageUrl' alt='Image' style='width: 100px; height: auto;'></td>
                            <td>$uploaddate</td>
                            <td>$username</td>
                            <td>$status</td>
                            <td><a href='reject.php?id=$l_id' class='colordelete'  onclick='return confirmDelete()'>Reject</a></td>
                        </tr>
                        ";
                    }
                }
                else {
                    echo "<tr><td colspan='6'>No laptops found.</td></tr>";
                }

                // Close the connection
                mysqli_close($conn);
            ?>
            </tbody>
        </table>




        
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to reject the laptop uploaded by user?");
            };
        </script>
</body>

</html>