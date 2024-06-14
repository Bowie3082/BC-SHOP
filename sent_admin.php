<?php 
session_start();
include("conn.php");
$action = isset($_GET['action']) ? $_GET['action'] : "";
	$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
	$_SESSION['formid'] = sha1('itoffside.com' . microtime());
	if (isset($_SESSION['qty'])) {
			$meQty = 0;
			foreach ($_SESSION['qty'] as $meItem) {
				$meQty = $meQty + $meItem;
			}
	} else {
		$meQty = 0;
	}
	if (isset($_SESSION['cart']) and $itemCount > 0) {
			$itemIds = "";
			foreach ($_SESSION['cart'] as $itemId) {
				$itemIds = $itemIds . $itemId . ",";
	}
			$inputItems = rtrim($itemIds, ",");
			$meSql = "SELECT * FROM tb_product WHERE pid in ({$inputItems})";
			$meQuery = mysqli_query($conn,$meSql);
			$meCount = mysqli_num_rows($meQuery);
	} else {
			$meCount = 0;
	}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="java.js"></script>

</head>
<body>
 <!-- ==========Header============== -->
 <div class="card">
    <?php include("header_admin.php"); ?>
  </div>

<div class="container">

  <!-- ==========Menu bar============== -->
  <div class="navbar navbar-light"  role="navigation">
    <?php include("menubar_admin.html"); ?>
  </div>
<hr>
  </div>
		<br>
     

		<?php

//ตรวจสอบว่ามีค่า Search หรือไม่
if(isset($_POST['search'])){
   $search = $_POST['search'];
   $where = "Where order_id Like '%$search%'";
 
 }else{ 
   $where="";
   $search="";
 }

 $table = "tb_order";
 $where = "WHERE order_status = 2";

//คำสั่ง select ข้อมูล
   $sql_select = "SELECT * FROM $table $where ORDER BY order_id DESC";
   $result = mysqli_query($conn, $sql_select);

 
  ?>
 <div class="card text-center">
	 <div class="card-header">
	   <div class="label">รายการจัดส่งแล้ว</div>
	 </div> 

   <!-- Content here -->


 <div class="container"><br>

	   <!-- Search Form -->
	  <form action="" class="form-inline justify-content-center" method="post">
		<label for="">  ค้นหาชื่อสินค้า</label>
	   <div class="form-group mx-sm-3 mb-2">

	   <input type="search" name="search" class="form-control"  placeholder="กรอกชื่อสินค้า" value="<?=$search?>">
	 </div>
	 <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>

	
   </form> <br>

	 <!-- หัวตาราง --------------------->
	   <table class="table margin=30">
		 <thead class="thead-dark">
		   <tr>
			<th scope="col">#</th>
			 <th scope="col">รหัสคำสั่งซื้อ</th>
			 <th scope="col">ชื่อลูกค้า</th>
			 <th scope="col">เวลาที่สั่ง</th>
			 <th scope="col">เบอร์ติดต่อ</th>
			 <th scope="col">สถานะการสั่งซื้อ</th>
			 <th scope="col">การจัดการ</th>
		   </tr>
		 </thead>
		 <?php
		 if (mysqli_num_rows($result) > 0) {
	   $num=1; 

	   while($row = mysqli_fetch_array($result)) {

	 ?>
		 <tbody>      
			 <tr>
			 <th scope='row'><?= $num ?></th>
			   <td><?= $row[0]; ?></td>
			   <td><?= $row[3]; ?></td>
			   <td><?= $row[2]; ?></td>
			   <td><?= $row[6]; ?></td>
			   <td><?= $row[8]; ?></td>
			   <td>
				<a href='order_all.php?order_id=<?= $row[0]; ?>'onClick="return confirm('คุณต้องการที่จะลบข้อมูลสินค้านี้หรือไม่ ?')" class='btn btn-danger')'>ลบ</a>
				</td>
			 </tr>
		 </tbody>
		 <?php
		 //ส่วนของ-----delete------------
		//ตรวจว่ามีค่า mid ส่งมาจากปุ่มลบหรือไม่
	 
			 
	 
	 //ปิด loop while
	 $num++;
	  }
   }

		 //คำสั่ง delete ข้อมูล
		 if (isset($_GET['order_id'])){
		   $orderid = $_GET['order_id']; 
		   $sql_delete = "DELETE FROM $table Where order_id='$orderid'";
		 //ถ้า Query ทำงานสำเร็จ 
		if (mysqli_query($conn, $sql_delete)) {
		 echo "<script>alert('ลบข้อมูลสินค้า $orderid สำเร็จ!')</script>!";
		   //refresh after delete
		 echo "<script>window.location='$_SERVER[PHP_SELF]'</script>";
	   } else {
		 echo "Error deleting record: " . mysqli_error($conn);
	   }
	   mysqli_close($conn);
	 
	 //ส่วนของ-----จบ delete------------
   }
	 ?>
		 </table>
		 <!-- จบตาราง  -->


	 </div>

 </div>
</body>
</html>

