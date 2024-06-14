<?php
  session_start();
  include("aloginchk.php");
?>
<?php include("conn.php") ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="java.js"></script>
    <link rel="stylesheet" href="footer.css">
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


<?php
//ตรวจสอบว่ามีค่า Search หรือไม่
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    // ถ้ามีการค้นหา กำหนดเงื่อนไขในการค้นหาชื่อ
    $where = "WHERE pname LIKE '%$search%'";
} else {
    // ถ้าไม่มีการค้นหา ก็ไม่ใส่เงื่อนไขใดๆ
    $where = "";
    $search = "";
}

//กำหนดชื่อตาราง
$table = "tb_product";
//คำสั่ง select ข้อมูล
$sql_select = "SELECT * FROM $table $where ORDER BY pid DESC";
// คำสั่ง Select ข้อมูล
$result = mysqli_query($conn, $sql_select);
?>
<div class="card text-center">
    <div class="card-header">
        <div class="label">รายการสินค้า</div>
    </div>
    <!-- Content here -->
    <P>
    <div class="container">
        <!-- Search Form -->
        <form action="" class="form-inline justify-content-center" method="post">
            <label for=""> ค้นหาชื่อสินค้า</label>
            <div class="form-group mx-sm-3 mb-2">

                <input type="search" name="search" class="form-control" placeholder="กรอกชื่อสินค้า"
                       value="<?= $search ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
        </form>
        <div class="nav justify-content-end"><a href="product_fm.php">เพิ่มข้อมูลสินค้าใหม่</a></div>
        <!-- หัวตาราง --------------------->
        <table class="table margin=30">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสสินค้า</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">ประเภท</th>
                <th scope="col">ราคา(บาท)</th>
                <th scope="col">ภาพสินค้า</th>
                <th scope="col">ดำเนินการ</th>
            </tr>
            </thead>
            <?php
            //เมื่อได้ผลการquery จากตัวแปร $result
            //ถ้า record ที่ query ที่มีจำนวนมากกว่า 0
            if (mysqli_num_rows($result) > 0) {
        $num=1; 
      //ให้เก็บข้อมูลที่ได้ ไว้ในตัวแปรอาร์เรย์ $row  
      while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tbody>
                    <tr>
                        <th scope='row'><?= $num ?></th>
                        <td><?= $row[0]; ?></td>
                        <td><?= $row[1]; ?></td>
                        <td><?= $row[2]; ?></td>
                        <td><?= $row[5]; ?></td>
                        <td><img src="picture/<?= $row[6]; ?>" alt="" width="20%"></td>
                        
                        <td>
                            <a href='product_edit.php?pid=<?= $row[0]; ?>' class='btn btn-info'>แก้ไข</a>
                            <a href='product_list.php?pid=<?= $row[0]; ?>'
                               onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')" class='btn btn-danger')'>ลบ</a>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                    //ปิด loop while
                    $num++;
                }
            }
             //ส่วนของ-----delete------------
         //refresh after delete
      //ส่วนของ-----จบ delete------------
        if(isset($_GET['pid'])){
          $pid = $_GET['pid'];
          // คำสั่ง delete
          $sql_delete ="DELETE FROM $table where pid='$pid'";
          
          // sql to delete a record
          $sql = "DELETE FROM MyGuests WHERE id=3";

         //ถ้า query ทำงานสำเร็จ
         if (mysqli_query($conn, $sql_delete)) {
          echo "<script>alert('ลบข้อมูลสินค้ารหัส $pid สำเร็จ!')</script>!";
            //refresh after delete
          echo "<script>window.location='$_SERVER[PHP_SELF]'</script>";
        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        }
            ?>
        </table>
        <!-- จบตาราง -->
    </div>
    <br>
    <div class="footer">
        CopyRight id: 64040427148 @BCUDRU
    </div>
</body>
</html>
