<?php
include "../connection.php";
session_start();
if (!isset($_SESSION['name'])) {
  header("location: ../login.php");
  exit();
}



    $laptopId = $_GET['id'];
    $sql = "delete from laptops where l_id=$laptopId and category='budget'";

    $result = mysqli_query($conn, $sql); // returns True if data is inserted
    if ($result) {
      header('Location: viewbudgetlaptop.php');
    }
?>