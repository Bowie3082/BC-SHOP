<!-- 
  session_start();
  include("aloginchk.php");
?> -->
<?php include("conn.php") ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="fm.css">
  <link rel="stylesheet" href="footer.css">

</head>
<body>

  <div class="card text-center">
    <div class="head">
    <a href="index.php"><img src="Logo1.png" height="60px" alt=""></a>
      <!-- <a href="member_list.php">รายชื่อสมาชิก</a>  -->
      <div class="label">กรอกข้อมูลสมัครสมาชิก</div>
    </div>
  </div>
  <!-- Content here -->
  <div class="container">

    <form action="" method="post" enctype="multipart/form-data" class="col-6">

      <div class="form-group">
        <label>รหัสสมาชิก :</label>
        <input type="text" name="mid" class="form-control" id="text" readonly>
      </div>

      <div class="form-group">
        <label>ชื่อ-สกุล :</label>
        <input type="text" name="mname" class="form-control" id="text" placeholder="กรอกชื่อ-นามสกุล" required>
      </div>

      <div class="form-group">
        <label>เพศ :</label>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" value="M" id="customRadioInline1" name="mgender" class="custom-control-input">
          <label class="custom-control-label" for="customRadioInline1">ชาย</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" value="F" id="customRadioInline2" name="mgender" class="custom-control-input">
          <label class="custom-control-label" for="customRadioInline2">หญิง</label>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">ที่อยู่</label>
          <textarea class="form-control" name="maddress" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label>จังหวัด :</label>
          <select name="mprovince" class="form-control" id="select">
            <option value="" selected>--------- เลือกจังหวัด ---------</option>
            <option value="เลย">เลย </option>
            <option value="หนองคาย">หนองคาย </option>
            <option value="หนองบัวลำภู">หนองบัวลำภู </option>
            <option value="อุดรธานี">อุดรธานี</option>

          </select>
        </div>
      </div>

      <div class="form-group">
        <label>เบอร์โทรศัพท์ :</label>
        <input type="text" name="mphone" class="form-control" id="text" placeholder="กรอกเบอร์โทรศัพท์" required>


        <hr>
      </div>
      <div class="form-group">
        <label>Email Address :</label>
        <input type="email" name="memail" class="form-control" id="email" placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label>Password :</label>
        <input type="password" name="mpass" class="form-control" id="text" placeholder="password" required>
      </div>
      <div class="form-group">
        <label>รูปภาพ :</label>
        <input type="file" name="mpicture" class="form-control" id="text">
      </div>


      <div class="formgroup">
        <div class="col-8">
          <button type="submit" class="btn btn-primary">บันทึก</button>
          <button type="cancel" class="btn btn-secondary ">ยกเลิก</button>
        </div>
      </div>
    </form>
  </div>
  <br>

  <?php
  if (isset($_POST['mname'])) {
    //echo $_POST[name];
    //กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม-------
    foreach ($_POST as $formkey => $formval) {
      ${$formkey} = $formval;
    }
    echo "ชื่อสกุล : $mname<br>";
    echo "ที่อยู่ : $maddress<br>";
    echo "เบอร์โทรศัพท์ : $mphone<br>";

//อัพรูป
    if (move_uploaded_file( $_FILES['mpicture']['tmp_name'] ,
    ("picture/".$_FILES['mpicture']['name']))) {
    $mpicture = $_FILES['mpicture']['name'];
    }
    else {
    $mpicture = "";
    echo "ไม่มีไฟล์รูปภาพค่ะ";
    }
    
    //Insert Data
    $table = "tb_member";
    $sql = "INSERT INTO $table
                    values ('','$mname','$mgender','$maddress','$mprovince','$mphone','$memail','$mpass','$mpicture')";


    // คำสั่งให้ sql ทำงาน
    if (mysqli_query($conn, $sql)) {
      echo "เพิ่มข้อมูลสำเร็จ";
      echo "<script>window.location='member_login.php'</script>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn); //ปิดการเชื่อต่อ

  }
  ?>


  <div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
</body>

</html>