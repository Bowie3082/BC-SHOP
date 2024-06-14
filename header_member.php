<div class="card-header" align="left">
  <?php if(isset($_SESSION['mname'])) { ?>
    <h6 align="right">
      คุณ <?php echo $_SESSION['mname']; ?>
    </h6>
  <?php } else { ?>
    <h6 align="right"><a href="member_login.php">ลงชื่อเข้าสู่ระบบ</a></h6>
  <?php } ?>
  <!-- ใส่ logoHeader -->
  <a href="index_member.php"><img src="Logo1.png" height="50px"  alt="Logo"></a>

  <?php if(isset($_SESSION['mname'])) { ?>
    <h6 align="right">
      <a href="#">จัดการข้อมูลของฉัน</a> | 
      <a href="member_login.php">ออกจากระบบ</a>
    </h6>
  <?php } ?>
</div>
