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
<?php 
  include("chick_login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order_all</title>
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
		<hr>
      <!-- Main component for a primary marketing message or call to action -->
      <?php
//กำหนดชื่อตาราง
$table = "tb_order";
//คำสั่ง select ข้อมูล
$sql_select = "SELECT * FROM $table ";
// คำสั่ง Select ข้อมูล
$result = mysqli_query($conn, $sql_select);
?>

<div class="card text-center">
    <div class="card-header">
        <h4 class="label"> - รายการสั่งซื้อสินค้า -</h4>
    </div>
    <!-- Content here -->




	<br>
    <div class="container">
        <div class="nav justify-content-end"><a href="product.php">เพิ่มรายการสั่งซื้อ</a></div>
        <!-- หัวตาราง --------------------->
        <table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>รหัสสินค้า</th>
							<th>ชื่อสินค้า</th>
							<th>รายละเอียด</th>
							<th>จำนวน</th>
							<th>ราคาต่อหน่วย</th>
							<th>จำนวนเงิน</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_array($meQuery))
                            {
                                $key = array_search($meResult[0], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult[5] * $_SESSION['qty'][$key]);
                                ?>
						<tr>
							<td>
								<?php echo $meResult[0]; ?>
							</td>
							<td>
								<?php echo $meResult[1]; ?>
							</td>
							<td>
								<?php echo $meResult[3]; ?>
							</td>
							<td>
								<?php echo $_SESSION['qty'][$key]; ?>
								<input type="hidden" name="qty[]" value="<?php echo $_SESSION['qty'][$key]; ?>" />
								<input type="hidden" name="product_price[]" value="<?php echo $meResult[5]; ?>" />
								<input type="hidden" name="product_id[]" value="<?php echo $meResult[0]; ?>" />
								
							</td>
							<td>
								<?php echo number_format($meResult[5], 2); ?>
							</td>
							<td>
								<?php echo number_format(($meResult[5] * $_SESSION['qty'][$key]), 2); ?>
							</td>
						</tr>
						<?php
								$num++;
								}
                            ?>
						<tr>
							<td colspan="8" style="text-align: right;">
								<h4>จำนวนเงินรวมทั้งหมด
									<?php echo number_format($total_price, 2); ?> บาท</h4>
							</td>
						</tr> <br>


						
						<!-- <tr>
							<td colspan="8" style="text-align: center;">
								<input type="hidden" name="formid" value=" < echo $_SESSION['formid']; ?>"  />
								<a href="order_cart.php" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
								<a href="order_all.php" type="submit" class="btn btn-primary btn-lg">บันทึกการสั่งซื้อสินค้า </a>
							</td>
						</tr> -->
					</tbody>
				</table>


						<!-- paument -->
						<?php include("payment.php");
						?>     




						<footer>
    <br> <div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
    </footer>
</body>
</html>