
<div class="card-header" align="left">
  <?php if(isset($_SESSION['mname'])) { ?>

  <h6 align="right">คุณ <?php echo $_SESSION['mname']; ?>
</a></h6>
      <h6 align="right"><a href="member_index.php">จัดการข้อมูลของฉัน</a> | <a href="logout.php">ออกจากระบบ</a></h6>
<?php  }else {?>

  <h6 align="right"><a href="member_login.php">ลงชื่อเข้าสู่ระบบ</a></h6>
<?php }  ?>
</div>
