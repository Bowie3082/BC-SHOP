<?php
session_start();
include("conn.php");
//ดักการ insert ซ้ำ โดยตรวจสอบค่า formid
$formid = isset($_SESSION['formid']) ? $_SESSION['formid'] : "";
if ($formid != $_POST['formid']) {
	echo "E00001!! SESSION ERROR RETRY AGAINT.";
} else {
	unset($_SESSION['formid']);
	if ($_POST) {

//กำหนดตัวแปร เพื่อเก็บค่า $_POST โดยวนลูปให้ครบทุกค่าจากฟอร์ม และตั้งชื่อตัวแปรตามชื่อในฟอร์ม
     foreach ($_POST  as  $formkey => $formval) {
           ${$formkey} = $formval;
         }
/*/=========================Send Email==================================
    $MailTo = $order_email;
    $MailFrom = 'sudarat.nh@gmail.com';
    $MailSubject = "Accept order from Suda_Shop";
    $MailMessage = "คุณได้สั่งซื้อสินค้าเรียบร้อยแล้ว <br> กรุณาชำระเงินและแจ้งชำระเงิน";

    $Headers = "MIME-Version: 1.0\r\n" ;
    $Headers .= "Content-type: text/html; charset=utf-8\r\n" ;
    // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
    $Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
    $Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
    $Headers .= "X-Priority: 3\r\n" ;
    $Headers .= "X-Mailer: PHP mailer\r\n" ;

    if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
    {
    echo "Send Mail True" ; //ส่งเรียบร้อย
    }else{
    echo "Send Mail False" ; //ไม่สามารถส่งเมล์ได้
    }

//=====================End send Email===============================*/


   //เพิ่มข้อมูลลงตาราง order
    $meSql = "INSERT INTO tb_order (mid,order_date,order_fullname,
	order_address,order_province,order_phone,order_email,order_status)
	VALUES ('{$mid}',NOW(),'{$order_fullname}','{$order_address}',
	'{$order_province}','{$order_phone}','{$order_email}','0') ";
	
		$meQeury = mysqli_query($conn,$meSql);
		//gen order_id รหัสสั่งซื้อในตาราง tb_order
		$order_id = mysqli_insert_id($conn);
		if ($meQeury) {
	
			for ($i = 0; $i < count($qty); $i++) {
				$detail_quantity =$qty[$i];
				$detail_price =$product_price[$i];
				$proid = $product_id[$i];
   
   //เพิ่มข้อมูลลงตาราง order detail
				$lineSql = "INSERT INTO tb_order_detail ";
				$lineSql .= "VALUES (";
       		    $lineSql .= "'',"; //ID Run Auto ใน DB
				$lineSql .= "'{$detail_quantity}',";
				$lineSql .= "'{$detail_price}',";
				$lineSql .= "'{$proid}',";
				$lineSql .= "'{$order_id}'";
				$lineSql .= ") ";
				mysqli_query($conn,$lineSql);
			}
			//mysqli_close();
			//ล้างตะกร้าสินค้า
			unset($_SESSION['cart']);
			unset($_SESSION['qty']);
		    header('location:index_member.php?a=order');
		
		}else{
			//mysqli_close();
			header('location:index_member.php?a=orderfail');
		}
	}
}
?>
