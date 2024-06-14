<?php
session_start();
include("aloginchk.php")
?>
<?php include("conn.php") ?>

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

  </head>
  <body>
    <?php
//เมื่อมีค่า pid ถูกส่งผ่าน url
        if(isset($_GET['pid'])){

        $pid = $_GET['pid'];   //สร้างตัวแปร pid เพื่อเก็บตัวแปร

      //สร้างตัวแปร table เก็บชื่อตาราง
      $table = "tb_product";


      //สร้างตัวแปร sql เก็บคำสั่ง sql
        $sql_select=" SELECT * FROM $table WHERE pid = '$pid'";

      //query ข้อมูลขึ้นมาแสดง

      $result = mysqli_query($conn, $sql_select);

      //เมื่อได้ผลการquery จากตัวแปร $result
      //ให้เก็บข้อมูลที่ได้ ไว้ในตัวแปรอาร์เรย์ $row  
      $row = mysqli_fetch_array($result);

    }
 ?>
      <div class="card text-center">
      <div class="card-header">
        <div class="label"><a href="product_list.php">รายการสินค้า</a> >>แก้ไขข้อมูลสินค้า
        </div>
      </div>
    </div>
    <!-- Content here --------------------->
    <P>

  <div class="container">
    <form action=""  method="post" enctype="multipart/form-data" class="col-6">
        <div class="form-group">
        <label>ชื่อสินค้า</label>
        <input type="text" name="pname" class="form-control" id="text" placeholder="กรอกชื่อสินค้า" value="<?=$row[1];?>" required>
      </div>

      <div class="form-group">
        <label>รายละเอียดสินค้า</label>
        <textarea name="pdetail" class="form-control" id="Textarea1" rows="3"><?=$row[3];?></textarea>
      </div>

        <div class="form-group">
          <label>ประเภทสินค้า</label>
          <select name="ptype" class="form-control" id="select">
            <option value="" selected>--------- เลือกประเภทสินค้า---------</option>
                 <option value="1">เสื้อ</option>
                  <?php if($row[2]=="เสื้อ") {echo "selected" ; } ?>
                 <option value="2">ชุดเดรส</option>
                  <?php if($row[2]=="ชุดเดรส") {echo "selected" ; } ?>
                 <option value="3">กางเกง</option>
                  <?php if($row[2]=="กางเกง") {echo "selected" ; } ?>
          </select>
        </div>

        <div class="form-group">
          <label>จำนวน</label>
          <input type="number" name="pqty" class="form-control" id="text" placeholder="กรอกจำนวนสินค้า" value="<?=$row[4]; ?>">
        </div>

        <div class="form-group row">
          <label class="col-sm-12 col-form-label">ราคา</label>
            <div class="col-sm-6">
              <input type="text" name="pprice" class="form-control" placeholder="กรอกราคาสินค้า" value="<?=$row[5]; ?>">
            </div>
          <label class="col-sm-2 col-form-label">บาท</label>
        </div>

          <div class="form-group">
            <label>ภาพสินค้า</label><br>
            <img src="picture/<?=$row[6]?>" alt="" width="100px"?>
            <input type="file" name="ppicture" class="form-control-file" id="exampleFormControlFile1">
            <input type="hidden" name="oldpicture">
          </div>


          <div class="formgroup">
            <div class="col-8">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="cancel" class="btn btn-secondary">ยกเลิก</button>
              </div>
          </div>
        </form>
        <br>
        <hr>

        <?php
//เมื่อคลิกปุ่มบันทักและมีการส่งค่า pname มา
        if (isset($_POST['pname'])){

//กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม
           foreach ($_POST  as  $formkey => $formval) {
                 ${$formkey} = $formval;
               }
//------------------------------------อัพโหลดรูป---------------------------------------------------------
              if (move_uploaded_file( $_FILES['ppicture']['tmp_name']  , ("picture/".$_FILES['ppicture']['name']))) {
              $ppicture1 = $_FILES['ppicture']['name'];
              $ppicture = ", ppicture='$ppicture1'";
              }
              else {
              //กำหนดให้ตัวแปร ppicture = $oldpicture (ชื่อไฟล์ภาพเดิม)
              echo "ไม่มีไฟล์รูปภาพค่ะ";
              $ppicture ="";
              }

//--------------------------------------ดำเนินการ UPDATE-----------------------------------------------------------------
$table = "tb_product";
//สร้างตัวแปร $sql_update เพื่อเก็บคำสั่ง UPDATE
      $sql_update= " UPDATE $table SET 
          pname = '$pname',
          ptype = '$ptype',
          pdetail = '$pdetail',
          pqty = '$pqty',
          pprice = '$pprice' $ppicture
          WHERE pid = '$pid'" ;

          echo $sql_update;

//สั่งให้ query ทำงานคำสั่งจาตัวแปร $sql_update
        if(mysqli_query($conn,$sql_update)) {
          echo "<script>alert('แก้ไขข้อมูลสมาชิกชื่อ $pname สำเร็จ!')</script>!";   
        }else {
        echo "Error deleting record: " . mysqli_error($conn);
        }



//Run ไปยังหน้ารายการทั้งหมด
          echo "<script>window.location = 'product_list.php'</script>";

//---------------------------------------------END QUERY--------------------------------------------------------
}
 ?>

    </div>

    <br>
    <div class="card-footer text-muted">
      CopyRight id:64040427148 @BCUDRU
   </div>

  </body>
</html>
stackpath.bootstrapcdn.com