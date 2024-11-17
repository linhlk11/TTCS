<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $address = mysqli_real_escape_string($conn, $filter_address);
   $filter_number = filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $number = mysqli_real_escape_string($conn, $filter_number);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Người dùng đã tồn tại!';
   }else{
      if($pass != $cpass){
         $message[] = 'Nhập lại mật khẩu không đúng!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, address, number) VALUES('$name', '$email', '$pass', '$address', '$number')") or die('query failed');
         $message[] = 'Đăng ký thành công!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<?php @include 'header.php'; ?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>Đăng ký</h3>
      <p>Tài khoản</p>
      <input type="text" name="name" class="box" placeholder="Nhập tên tài khoản" required>
      <p>Email</p>
      <input type="email" name="email" class="box" placeholder="Nhập email" required>
      <p>Mật khẩu</p>
      <input type="password" name="pass" class="box" placeholder="Nhập mật khẩu" required>
      <input type="password" name="cpass" class="box" placeholder="Nhập lại mật khẩu" required>
      <p>Địa chỉ</p>
      <input type="text" name="address" class="box" placeholder="Nhập địa chỉ" required>
      <p>Số điện thoại</p>
      <input type="text" name="number" class="box" placeholder="Nhập số điện thoại" required>
      <input type="submit" class="btn" name="submit" value="Đăng ký">
      <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
   </form>

</section>

<?php @include 'footer.php'; ?>

</body>
</html>