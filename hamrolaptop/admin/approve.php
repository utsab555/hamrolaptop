<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}


$id = $_GET['id'];
$sql = "update laptops set approval_status='approved' where l_id=$id and category='second-hand'";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: viewuploadlaptop.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>