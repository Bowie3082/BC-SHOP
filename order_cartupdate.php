<?php
session_start();
include("conn.php");
//ถ้า มี $_GET['itemId'] ให้ $itemId = $_GET['itemId']
$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";

//1. กรณี แก้ไขจำนวนสินค้า จากหน้าสั่งซื้อ
if ($_POST)
{
    for ($i = 0; $i < count($_POST['qty']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['qty'][$key] = $_POST['qty'][$i];
        header('location:order_cart.php');
    }
} else
{   //ถ้า ไม่มี $_SESSION['cart']
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['qty'][] = array();

        //$food = array("ส้มตำ","ไก่ย่าง");
    }
    //กรณีกด หยิบใส่ตะกร้า ในสินค้ารหัสเดิม
    if (in_array($itemId, $_SESSION['cart']))
    {    //กำหนดให้ตัวแปร $key = รหัสสินค้าใน$_SESSION['cart']
        //ที่ตรงกับ itemID
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['qty'][$key] = $_SESSION['qty'][$key] + 1;
        header('location:product.php?action=exist');
                                        
    } else
    {    //กรณีกด หยิบใส่ตะกร้า ในสินค้ารหัสใหม่
        // เพิ่มค่า itemID เข้าไปในตัวแปร $_SESSION['cart']
        array_push($_SESSION['cart'], $itemId);
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['qty'][$key] = 1;
        header('location:product.php?action=add');
    }
}
?>
