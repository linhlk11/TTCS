<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tài khoản</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="users show-products">

   <h1 class="title">Bảng tài khoản</h1>
   <table class="users-table products-table">
      <tr>
         <th>STT</th>
         <th>ID</th>
         <th>Tên người dùng</th>
         <th>Email</th>
         <th>Loại tài khoản</th>
         <th>Địa chỉ</th>
         <th>Số điện thoại</th>
      </tr>
      <?php
      
      $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
      if(mysqli_num_rows($select_users) > 0){
         $i = 1;
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $fetch_users['id']; ?></td>
         <td><?php echo $fetch_users['name']; ?></td>
         <td><?php echo $fetch_users['email']; ?></td>
         <td><span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></td>
         <td><?php echo $fetch_users['address']; ?></td>
         <td><?php echo $fetch_users['number']; ?></td>
         <!-- <td>
            <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" class="delete-btn"> <i class="fas fa-trash"></i> Xóa</a>
         </td> -->
      </tr>
      <?php
         $i++;
         }
      }
      ?>
   </table>
   <!-- <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p>user id : <span><?php echo $fetch_users['id']; ?></span></p>
         <p>username : <span><?php echo $fetch_users['name']; ?></span></p>
         <p>email : <span><?php echo $fetch_users['email']; ?></span></p>
         <p>user type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
         }
      }
      ?>
   </div> -->

</section>













<script src="js/admin_script.js"></script>

</body>
</html>