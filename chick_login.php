<?php //session_start();
// เช็คการ login
if (empty($_SESSION['mname'])){
    echo "<script>window.location='member_login.php'</script>";
}
?>