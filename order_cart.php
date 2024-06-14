<?php 
include("conn.php"); 
?>
<?php session_start();
  include("chick_login.php"); ?>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else  echo "<div class=\'alert alert-warning\'>ลบสินค้า
แล้ว</div>";
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $sql = "SELECT * FROM tb_product WHERE pid in ({$inputItems})";
    //echo $sql;
    $query = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($query);
} else
{
    $count = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<h<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
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
<div class="card">
    <?php include("header_member.php"); ?>
  </div>
  
<div class="container">

  <!-- ==========Menu bar============== -->
  <div class="navbar navbar-light"  role="navigation">
    <?php include("menubar.html"); ?><hr>
  </div>
<hr><br>
      <!-- Main component for a primary marketing message or call to action -->

      <?php
            if ($action == 'removed')
            {
                echo "<div class=\'alert alert-warning\'>ลบสินค้าเรียบร้อยแล้ว</div>";
            }

            if ($count == 0)
            {
                echo "<div class=\'alert alert-warning\'>ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            {
                ?>
      <form action="order_cartupdate.php" method="post" name="fromupdate">


        <table class="table margin=30">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">&nbsp;</th>
              <th scope="col">รหัสสินค้า</th>
              <th scope="col">ชื่อสินค้า</th>
              <th scope="col">รายละเอียด</th>
              <th scope="col">จำนวน</th>
              <th scope="col">ราคาต่อหน่วย(บาท)</th>
              <th scope="col">จำนวนเงิน</th>
              <th scope="col">ดำเนินการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $total_price = 0;
                $num = 0;
                $runnum=1;
                while ($data = mysqli_fetch_array($query)) {
                        $key = array_search($data[0], $_SESSION['cart']);
                        $total_price = $total_price + ($data[5] * $_SESSION['qty'][$key]);
            ?>
            <tr scope="row">
              <td>
                <?php echo $runnum; ?>
              </td>
              <td><img src="picture/<?php echo $data[6];?>" alt="..." class="img-thumbnail" width="100px" height="100px"></td>
              <td><?php echo $data[0]; ?></td>
              <td>
                <?php echo $data[1]; ?>
              </td>
              <td>
                <?php echo $data[3]; ?>
              </td>
              <td>
                <input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
              </td>
              <td>
                <?php echo number_format($data[5],2); ?>
              </td>
              <td>
                <?php echo number_format(($data[5] * $_SESSION['qty'][$key]),2); ?>
              </td>
              <td>
                <a class="btn btn-danger btn-lg" href="order_cartremove.php?itemId=<?php echo $data[0]; ?>" role="button">
                  <span class="glyphicon glyphicon-trash"></span>
                  ลบทิ้ง
                </a>
              </td>
            </tr>
            <?php
                $num++;
                $runnum++;
              }
          ?>
            <tr>
              <td colspan="8" style="text-align: right;">
                <h4>จำนวนเงินรวมทั้งหมด
                  <?php echo number_format($total_price,2); ?> บาท</h4>
              </td>
            </tr>
            <tr>
              <td colspan="8" style="text-align: right;">
                <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                <a href="order.php" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
      <?php
          }
          ?>

    </div>
    <footer>
    <br> <div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
    </footer>
  </body>
</html>
