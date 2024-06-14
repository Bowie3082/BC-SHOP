<?php
//ตรวจสอบการกระทำ และนับจำนวนสินค้าที่ถูกกดเลือก
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    if(isset($_SESSION['qty'])){
        $meQty = 0;
        foreach($_SESSION['qty'] as $meItem){
            $meQty = $meQty + $meItem;
        }
    }else{
        $meQty=0;
    }
?>

<!-- ตรวจสอบการกระทำ และแสดงผล-->
<?php
  if($action == 'exist'){
      echo "<div class=\'alert alert-warning\'>เพิ่มจำนวนสินค้า
แล้ว</div>";
    }
  if($action == 'add'){
    
  echo "<div class=\'alert alert-success\'>เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว</div>";
    }
  if($action == 'order'){
  	echo "<div class=\'alert alert-success\'>สั่งซื้อสินค้าเรียบร้อยแล้ว</div>";
    }
  if($action == 'orderfail'){
  	echo "<div class=\'alert alert-warning\'>สั่งซื้อสินค้าไม่สำเร็จ มีข้อผิดพลาดเกิดขึ้นกรุณาลองใหม่อีกครั้ง</div>";
    }
?>
