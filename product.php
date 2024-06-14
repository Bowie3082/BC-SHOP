<?php 
session_start();
include("conn.php"); 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta  charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="java.js"></script>
  <link rel="stylesheet" href="BarMember.css">
  <link rel="stylesheet" href="footer.css">

  </head>

<body>
<?php include("order_chk.php"); ?>
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

<!-- ===============Search Form===================== -->
<form action="" class="form-inline justify-content-center" method="post">
             <label for="">  ค้นหารายการสินค้า</label>
            <div class="form-group mx-sm-3 mb-2">

            <input type="search" name="search" class="form-control"  placeholder="ชื่อสินค้า">
          </div>
          <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
        </form> <br>
  <div align="center">
        <div class="row">
      <?php
      //Query รายการสินค้ามาแสดง
      $table = "tb_product";
  //ตรวจสอบว่ามีค่า Search หรือไม่
      if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM $table WHERE pname LIKE '%$search%' 
                ORDER BY pid DESC"; 
      }else{ 
        $sql = "SELECT * FROM $table ORDER BY pid DESC"; 
        }
     //คำสั่งให้ Sql Query ทำงาน 
        $result = mysqli_query($conn, $sql);
        //นับจำนวนแถวที่ query ได้    
        if (mysqli_num_rows($result) > 0) {
     // นำข้อมูลที่ query เก็บในรูปแบบอาร์เรย์
            //$num = 0;
            while($row = mysqli_fetch_array($result)) {      

         ?>
         <div class='col-sm-4'>
            <div class='card'>
              <div class='card-body'>
                <a href="picture/<?= $row[6]; ?>"><img class="card-img-top" src="picture/<?= $row[6]; ?>" width="200px" height="300px"></a>
                  <h5 class="card-title"><?= $row[1]; ?></h5>
                  <div class="card-text"><?= $row[3]; ?></div>
                  <div class="card-text"><?= $row[5]."บาท"; ?></div>
                <a href="order_cartupdate.php?itemId=<?= $row[0];?>"class="btn btn-primary">หยิบใส่ตะกร้า</a>
            </div>
           </div>
          </div>
            <?php 
            } //ปิดเงื่อนไขการนับแถว
           } //ปิด ลูป While
         ?>  
 </div>
  </div>
  </div>
  <br> <div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
</body>
</html>
