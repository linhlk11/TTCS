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

<header class="header">

   <div class="flex">
         <a href="admin_page.php" class="logo">
            <img src="images/logo.png" alt="">
            <span> Admin</span>
        </a>

      <nav class="navbar">
         <a href="admin_page.php">Trang chủ</a>
         <a href="admin_products.php">Sản phẩm</a>
         <a href="admin_orders.php">Đơn hàng</a>
         <a href="admin_users.php">Tài khoản</a>
         <a href="admin_contacts.php">Thông báo</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         
         <div class="admin">
            <div class="image">
                  <img src="images/User_Avatar_2.png" alt="" />
            </div>
            <div class="name">
                  <h3><span><?php echo $_SESSION['admin_name'] ?></span></h3>
                  <p><span><?php echo $_SESSION['admin_email']; ?></p>
            </div>
         </div>
         <div class="control">
            <div class="control-item">
                  <a href="#">
                     <div class="control-item-icon">
                        <i class="fas fa-cog"></i>
                        <p>Cài đặt</p>
                     </div>
                  </a>
            </div>

            <div class="control-item">
                  <a href="logout.php">
                     <div class="control-item-icon">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Đăng xuất</p>
                     </div>
                  </a>
            </div>
         </div>
         <div class="other-account">Tài khoản khác <a href="login.php">Đăng nhập</a> | <a href="register.php">Đăng ký</a> </div>
      </div>

   </div>

</header>