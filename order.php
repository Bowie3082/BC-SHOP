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
			// ตารางข้อมูลที่เลือก 
			$meSql = "SELECT * FROM tb_product WHERE pid in ({$inputItems})";
			$meQuery = mysqli_query($conn,$meSql);
			$meCount = mysqli_num_rows($meQuery);
	} else {
			$meCount = 0;
	}
?>

<!DOCTYPE html>
<html lang="en">
<h<html lang="en" dir="ltr">

	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<title></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="java.js"></script>
		<link rel="stylesheet" href="BarMember.css">

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

			<h3>รายการสั่งซื้อ</h3>
			<!-- Main component for a primary marketing message or call to action -->
			<?php
      if ($action == 'removed'){
          echo "<div class=\"alert alert-warning\">ลบสินค้าเรียบร้อยแล้ว</div>";
        }

    	if ($meCount == 0)   {
                echo "<div class=\"alert alert-warning\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
        } else {
      ?>

			<form action="order_insert.php" method="post" name="formupdate" role="form" id="formupdate" onsubmit="JavaScript:return updateSubmit();">
				<div class="form-group">
					<label for="exampleInputEmail1">รหัสลูกค้า</label>
					<input type="text" class="form-control" id="mid" readonly="readonly" style="width: 300px;" value="<?php if(isset ($_SESSION['mid'])){ echo $_SESSION['mid']; } ?>" name="mid">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">ชื่อ-นามสกุล</label>
					<input type="text" class="form-control" id="order_fullname" placeholder="ใส่ชื่อนามสกุล" style="width: 300px;" value="<?= $_SESSION['mname'] ?>" name="order_fullname">
				</div>

				<div class="form-group">
					<label for="exampleInputAddress">ที่อยู่</label>
					<textarea class="form-control" rows="3" style="width: 500px;" name="order_address" id="order_address"> <?php (isset( $_SESSION['maddress'] ))?>
				</textarea>
				</div>

				<div class="form-group">
					<label for="exampleInputProvince">จังหวัด</label>
					<input type="text" class="form-control" id="order_province" placeholder="ใส่จังหวัด" style="width: 300px;" value="<?php if(isset($_SESSION['mprovince'])) ?>" name="order_province">
				</div>

				<div class="form-group">
					<label for="exampleInputPhone">เบอร์โทรศัพท์</label>
					<input type="text" class="form-control" id="order_phone" placeholder="ใส่เบอร์โทรศัพท์ที่สามารถติดต่อได้" style="width: 300px;" name="order_phone" value="<?php if(isset( $_SESSION['mphone'])) ?>">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail">อีเมลล์</label>
					<input type="email" class="form-control" id="order_email" placeholder="email" style="width: 300px;" name="order_email" value="<?= $_SESSION['memail'] ?>">
				</div>
				
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ลำดับ</th>
							<th>ชื่อสินค้า</th>
							<th>ภาพสินค้า</th>
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
							<img src="picture/<?= $meResult[6]; ?>" alt="" width="60px">
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
						</tr>
						<tr>
							<td colspan="8" style="text-align: right;">
								<input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>" />
								<a href="order_all.php" type="button" class="btn btn-danger btn-lg">ย้อนกลับ</a>
								<button type="submit" class="btn btn-primary btn-lg">บันทึกการสั่งซื้อสินค้า</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php
				}
            ?>

		</div> <!-- /container -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="bootstrap/js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>

</html>
<?php
//mysqli_close();
?>
