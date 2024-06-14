<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bcshop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}else{
    // echo "เชื่อมต่อสำเร็จ";
}
mysqli_set_charset($conn,"utf8"); //กำหนก  chaset เป็น Utf8