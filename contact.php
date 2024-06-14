<?php 
session_start();
include("conn.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="java.js"></script>
    <link rel="stylesheet" href="BarMember.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="footer.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // เลือกปุ่ม Send Message
            var sendMessageButton = document.querySelector('button[type="submit"]');

            // เพิ่ม event listener เมื่อคลิกปุ่ม
            sendMessageButton.addEventListener('click', function () {
            // แสดงป็อปอัพขอบคุณ
            alert('ขอบคุณสำหรับการส่งข้อความ!');

            // แสดงปุ่มตกลง
            var confirmButton = confirm('คลิก "ตกลง" เพื่อกลับไปหน้าหลัก');
            
            // ถ้าคลิก "ตกลง" ให้นำไปยังหน้าหลัก (index_member.php)
            if (confirmButton) {
                window.location.href = 'index_member.php';
            }
            });
        });
        </script>
<body>
   <!-- ==========Header============== -->
  <?php include("order_chk.php"); ?>
  <div class="card">
    <?php include("header_member.php"); ?>
  </div>
 
<div class="container">
  <!-- ==========Menu bar============== -->
  <div class="navbar navbar-light"  role="navigation">
    <?php include("menubar.html"); 
    if(isset($_SESSION["logtype"])){
      if($_SESSION["logtype"]=="admin"){
        include("menubar_admin.html"); 
      }
    }
    ?>
  </div>
  </div>
<hr>
    <main>
    <h2>Contact Us</h2>
        <section class="contact-form">
            <form action="submit_contact.php" method="post">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>
    <h2>My Google Map</h2>
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15229.19962233728!2d102.7942974!3d17.3973893!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31239d18b722e9cd%3A0xb3c485a7d2422655!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lij4Liy4LiK4Lig4Lix4LiP4Lit4Li44LiU4Lij4LiY4Liy4LiZ4Li1!5e0!3m2!1sth!2sth!4v1709662811834!5m2!1sth!2sth"></iframe>

<!-- footer -->
<br><div class="footer">
    CopyRight id:64040427148 @BCUDRU
  </div>
</body>
</html>
