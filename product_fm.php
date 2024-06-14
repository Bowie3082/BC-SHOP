<?php
  session_start();
  include("aloginchk.php");
?>
<?php include("conn.php"); ?>
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
    <link rel="stylesheet" href="fm.css">
    <link rel="stylesheet" href="footer.css">

  </head>
  <body>

  </div>
      <div class="card text-center">
      <div class="card-header">
        <div class="label"><a href="product_list.php">รายการสินค้า</a> >>เพิ่มข้อมูลสินค้า
        </div>

      </div>
    </div>
    <!-- Content here --------------------->
    <P>

  <div class="container">
    <form action=""  method="post" enctype="multipart/form-data" class="col-6">
      <input type="hidden" name="pid">
      <div class="form-group">
        <label>ชื่อสินค้า</label>
        <input type="text" name="pname" class="form-control" id="text" placeholder="กรอกชื่อสินค้า" required>
      </div>

        <div class="form-group">
          <label>ประเภทสินค้า</label>
          <select name="ptype" class="form-control" id="select" required>
            <option value="" selected>--------- เลือกประเภทสินค้า---------</option>
                 <option value="1">เสื้อ</option>
                 <option value="2">ชุดเดรส</option>
                 <option value="3">กางเกง</option>
          </select>
        </div>

        
      <div class="form-group">
        <label>รายละเอียดสินค้า</label>
        <textarea name="pdetail" class="form-control" id="Textarea1" rows="3" required></textarea>
      </div>

        <div class="form-group">
          <label>จำนวน</label>
          <input type="number" name="pqty" class="form-control" id="text" placeholder="กรอกจำนวนสินค้า" required>
        </div>

        <div class="form-group row">
          <label class="col-sm-12 col-form-label">ราคา</label>
            <div class="col-sm-6">
              <input type="text" name="pprice" class="form-control" placeholder="กรอกราคาสินค้า" required>
            </div>
          <label class="col-sm-2 col-form-label">บาท</label>
        </div>

          <div class="form-group">
            <label>ภาพสินค้า</label><br>
                <input type="file" name="ppicture" class="form-control-file" id="exampleFormControlFile1">
          </div>


          <div class="formgroup">
            <div class="col-8">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="reset" class="btn btn-secondary">ยกเลิก</button>
              </div>
          </div>
        </form>
        </div>
        <br>

        <?php

           if (isset($_POST['pname'])){
          //echo $_POST[name];
          //กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม-------
          foreach ($_POST as $formkey => $formval) {
            ${$formkey} = $formval;
          }
          echo "ชื่อสินค้า : $pname<br>";
          echo "ราคาสินค้า : $pprice<br>";
          echo "จำนวนสินค้า: $pqty<br>";

      //อัพรูป
          if (move_uploaded_file( $_FILES['ppicture']['tmp_name'] ,
          ("picture/".$_FILES['ppicture']['name']))) {
          $ppicture = $_FILES['ppicture']['name'];
          }
          else {
          $ppicture = "";
          echo "ไม่มีไฟล์รูปภาพค่ะ";
          }
      
          // //กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม
          //  foreach ($_POST  as  $formkey => $formval) {
          //        ${$formkey} = $formval;
          //      }


        //Insert Data
          $table = "tb_product";
          $sql = "INSERT INTO $table
                    values ('','$pname','$ptype','$pdetail','$pqty','$pprice','$ppicture')";
            // คำสั่งให้ sql ทำงาน
            if (mysqli_query($conn, $sql)) {
              echo "เพิ่มข้อมูลสำเร็จ";
              echo "<script>window.location='product_list.php'</script>";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn); //ปิดการเชื่อต่อ

          } 
//------------------------------
?>

<div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
</body>

</html>
