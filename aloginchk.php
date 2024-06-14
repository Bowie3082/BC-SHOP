<?php //session_start();
// เช็คการ login
if (empty($_SESSION['aname'])){
    echo "<script>window.location='login_admin.php'</script>";
}
?>