<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจ่ายเงิน</title>
    <link rel="stylesheet" href="pay.css">
</head>
<body>
    <div class="payment-form">
        <h1>การจ่ายเงิน</h1>
        <div class="account-details">
            <p>คิวอารโค้ด: <br> <span id="qrCode">บริษัท บีซีสไตล์เฮเว่น แคปปิตอล จำกัด</span></p>
            <img width="200px"  height="200px" src="picture/websiteQRCode_noFrame.png" alt=""><br><br> 

           <p>เลขที่บัญชี: <span id="accountNumber">123-456-789</span></p>
        </div>

        <p>เพิ่มหลักฐานการชำระเงิน</p>
        <input type="file" id="proofOfPayment" accept="">
        <br>
        <br>
        <a href="order_cart.php" type="button" class="btn btn-danger">ย้อนกลับ</a>
        <a href="sent_all.php" onclick="confirmPayment()" class="btn btn-success">ยืนยันการชำระเงิน</a>
    </div>
    </div>
    <script src="pay.js"></script>
</body>
</html>
