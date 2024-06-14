<?php include("function.inc.php");
session_start();
include("conn.php");
//ตรวจสอบการกระทำ และนับจำนวนสินค้าที่ถูกกดเลือก
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    if(isset($_SESSION['qty'])){
        $meQty = 0;
        foreach($_SESSION['qty'] as $meItem){
            $meQty = $meQty + $meItem;
        }
    }else{
        $meQty=0;
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta  charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="java.js"></script>
  <link rel="stylesheet" href="BarMember.css">
    <link rel="stylesheet" href="footer.css">

  </head>
<body>

<!-- ==========Header============== -->
<?php include("order_chk.php"); ?>
  <div class="card">
    <?php include("header_member.php"); ?>
  </div>
 
<div class="container">
  <!-- ==========Menu bar============== -->
  <div class="navbar navbar-light"  role="navigation">
    <?php include("menubar.html"); 
    if(isset($_SESSION["logtype"])){
      if($_SESSION["logtype"]=="admin"){
        include("menubar_admin.html"); 
      }
    }
    ?>
  </div>
  </div>

		<hr>
<p>หน้าแรกสมาชิก</p>
<div class="">
<a href="member_edit.php">- แก้ไขข้อมูลส่วนตัว</a><br>
<a href="member_order_mid.php">- รายการสั่งซื้อทั้งหมดของคุณ</a><br>
</div>
  </div>
  </div>


  <br> <div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
</body>
</html>
