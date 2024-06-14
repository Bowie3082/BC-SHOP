<?php include("conn.php");//นำเข้าไฟล์ ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta  charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php
        //เมื่อมีค่า pid ถูกส่งผ่าน url
        if(isset($_GET['mid'])){

            $mid = $_GET['mid'];   //สร้างตัวแปร mid เพื่อเก็บตัวแปร

            //สร้างตัวแปร table เก็บชื่อตาราง
          $table = "tb_member";

            //สร้างตัวแปร sql เก็บคำสั่ง sql
          $sql_select="SELECT * FROM $table WHERE mid='$mid'";
            //query ข้อมูลขึ้นมาแสดง
          $result = mysqli_query($conn, $sql_select);

            //เมื่อได้ผลการquery จากตัวแปร $result
            //ให้เก็บข้อมูลที่ได้ ไว้ในตัวแปรอาร์เรย์ $row  
          $row = mysqli_fetch_array($result);

         }
    ?>
      <div class="card text-center">
      <div class="card-header">
        <div class="label"><a href="member_list.php">รายชื่อสมาชิก</a> >>แก้ไขข้อมูลสมาชิก</div>
      </div>
    </div>
    <!-- Content here -->
    <P>

  <div class="container">
    <form action=""  method="post" enctype="multipart/form-data" class="col-6">

    <div class="form-group">
        <label>รหัสสมาชิก</label>
        <input type="text" name="mid" class="form-control" id="text" readonly value="<?=$row[0]?>">
     </div>
          
      <div class="form-group">
        <label>ชื่อ-สกุล</label>
        <input type="text" name="mname" class="form-control" id="text" placeholder="กรอกชื่อ-นามสกุล" value="<?=$row[1]; ?>" required>
      </div>

      <div class="form-group">
        <label for="">เพศ:</label>
        <div class="custom-control custom-radio custom-control-inline">

          <input type="radio" value="M" id="customRadioInline1" name="mgender" class="custom-control-input"  <?php 
        if ($row[2]=="M") {
          echo "checked";
        } 
        ?>>

          <label class="custom-control-label" for="customRadioInline1">ชาย</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" value="F" id="customRadioInline2" name="mgender" class="custom-control-input"  <?php 
        if ($row[2]=="F") {
          echo "checked";
        } 
        ?>>
          
          <label class="custom-control-label" for="customRadioInline2">หญิง</label>
        </div>
     
        <div class="form-group">
          <label for="exampleFormControlTextarea1">ที่อยู่</label>
          <textarea class="form-control" name="maddress" rows="3"><?=$row[3]?></textarea>
        </div>
        <div class="form-group">
          <label>จังหวัด</label>
          <select name="mprovince" class="form-control" id="select">
            <option value="">--------- เลือกจังหวัด ---------</option>
                <option value="เลย"
                <?php if($row[4]=="เลย"){echo "selected";}?>>เลย </option>
                 <option value="หนองคาย"
                 <?php if($row[4]=="หนองคาย"){echo "selected";}?>>หนองคาย </option>
                 <option value="หนองบัวลำภู"
                 <?php if($row[4]=="หนองบัวลำภุ"){echo "selected";}?>>หนองบัวลำภู </option>
                 <option value="อุดรธานี"
                 <?php if($row[4]=="อุดรธานี"){echo "selected";}?>>อุดรธานี</option> 
          </select>
        </div>
      </div>

      <div class="form-group">
        <label>เบอร์โทรศัพท์</label>
        <input type="text" name="mphone" class="form-control" id="text" placeholder="กรอกเบอร์โทรศัพท์" value="<?=$row[5]; ?>" required >


          <hr>
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input type="email" name="memail" class="form-control" id="email" placeholder="name@example.com" value="<?=$row[6]; ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="mpass" class="form-control" id="text" placeholder="password" value="<?=$row[7]; ?>" required>
          </div>
          <div class="form-group">
            <label>รูปภาพ</label>
            <input type="file" name="mpicture" class="form-control" id="text">
            <br>
          
          <img src="picture/<?=$row[8]?>" alt="" width="100px">
          </div>
         
          
          <div class="formgroup">
            <div class="col-8">
            <button type="submit" class="btn btn-primary">แก้ไข</button>
            <button type="cancel" class="btn btn-secondary ">ยกเลิก</button>
              </div>
          </div>
        </form>
        </div>
        <br>
    <?php
        //เมื่อคลิกปุ่มบันทึกและมีการส่งค่า mname มา
                if (isset($_POST['mname'])){

        //กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม
                foreach ($_POST  as  $formkey => $formval) {
                        ${$formkey} = $formval;
                    }
        //------------------------------------อัพโหลดรูป---------------------------------------------------------
                    if (move_uploaded_file( $_FILES['mpicture']['tmp_name']  , ("picture/".$_FILES['mpicture']['name']))) {
                      $mpicture1 = $_FILES['mpicture']['name'];
                      $mpicture =",mpicture= '$mpicture1'";
                    }
                    else {
                      //กำหนดให้ตัวแปร mpicture = $oldpicture (ชื่อไฟล์ภาพเดิม)
                      echo "ไม่มีไฟล์รูปภาพแก้ไขค่ะ";
                     $mpicture="";
                    }

        //---------------------------------------ดำเนินการ UPDATE-----------------------------------------------------------------
        $table ="tb_member";
        //สร้างตัวแปร $sql_update เพื่อเก็บคำสั่ง UPDATE
        $sql_update = "UPDATE $table SET
                mname = '$mname',
                mgender ='$mgender',
                maddress = '$maddress',
                mprovince = '$mprovince',
                mphone = '$mphone',
                memail ='$memail',
                mpass = '$mpass' $mpicture
                WHERE mid='$mid'";

        //สั่งให้ query ทำงานคำสั่งจากตัวแปร $sql_update
          if(mysqli_query($conn,$sql_update)){
          echo "<script>alert('แก้ไขข้อมูลสมาชิกรหัส $mid สำเร็จ!')</script>!";
          }       

        //Run ไปยังหน้ารายการทั้งหมด
       echo "<script>window.location = 'member_list.php'</script>";

        //---------------------------------------------END QUERY--------------------------------------------------------

}
 ?>


    <div class="card-footer text-muted">
      CopyRight id:64040427148 @BCUDRU
   </div>
  </body>

</html>