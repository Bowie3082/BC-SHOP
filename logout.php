<?php  session_start();
//ยกเลิกการลงทะเบียนตัวแปร session เพื่ออกจากระบบ
session_destroy();
echo "<script>window.location='login_admin.php'</script>";
?>