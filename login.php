<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_address'] = $row['address'];
         $_SESSION['admin_number'] = $row['number'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_address'] = $row['address'];
         $_SESSION['user_number'] = $row['number'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'Không tồn tại người dùng!';
      }

   }else{
      $message[] = 'Email hoặc mật khẩu không chính xác!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

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
      <h3>Đăng nhập</h3>
      <p>Tài khoản</p>
      <input type="email" name="email" class="box" placeholder="Nhập email" required>
      <p>Mật khẩu</p>
      <input type="password" name="pass" class="box" placeholder="Nhập mật khẩu" required>
      <input type="submit" class="btn" name="submit" value="Đăng nhập">
      <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
   </form>

</section>


<?php @include 'footer.php'; ?>
</body>
</html>