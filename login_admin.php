<?php session_start();
include "conn.php";
?>
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
    <link rel="stylesheet" href="login.css">
  
  </head>
  <body>
    <!-- <div class="card text-center"> -->
    <div class="head"><br>
    <img src="Logo1.png" height="40px" alt="">
      <h2 class="label">สำหรับผู้ดูแลระบบ</h2>
  </div>
        <!-- Content here --------------------->
  <div class="container">
  <form action="" method="post">
    <input type="hidden" name="logtype" value="admin">

    <div class="form-group row">Username
      <div class="">
      <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
      </div>
    </div>

    <div class="form-group row">Password
      <div class="">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
    </div>

    <div class="col-sm-6" align="center">
      <button type="submit" class="btn btn-primary">ลงชื่อเข้าใช้งานระบบ</button>
    </div>
  </form>
  </div>
  
<?php
//ส่วนของการตรวจสอบ username และ password
  if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

 //คำสั่ง forech
  //คำสั่ง SQL
  $sql = "SELECT * FROM tb_admin 
          WHERE aemail='$email' 
          AND apassword = '$password'";
          echo $sql;
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_array($result);
    //ลงทะเบียนตัวแปร SESSION
    $_SESSION['aid'] = $row[0];
    $_SESSION['aname'] = $row[1];
    $_SESSION['aemail'] = $row[2];
    $_SESSION['apassword'] = $row[3];
    $_SESSION["logtype"]="admin";

    echo "<script>alert('ยินดีต้อนรับ คุณ ".$row[1]."')</script>";
    echo "<script>window.location='index_admin.php'</script>";
  }else{
    echo "Login ไม่สำเร็จ";
  }
    }
 ?>
  </body>
</html>