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
    <div class="chat-top-box">
        <a href="#"><i class="fa-solid fa-circle-chevron-up"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100007239466406" target="blank"><i class="fa-brands fa-facebook-messenger"></i></a>
    </div>
    <div class="flex">

        <a href="home.php" class="logo">
            <img src="images/logo.png" alt="">
        </a>

        <nav class="navbar">
            <ul>
                <li><a href="home.php">Trang chủ</a></li>
                <li><a href="shop.php">Sản phẩm</a></li>
                <li><a href="orders.php">Đơn hàng</a></li>
                <!-- <li><a href="#">WaDu +</a>
                    <ul> -->
                        <li><a href="about.php">Giới thiệu</a></li>
                        <li><a href="contact.php">Liên hệ</a></li>
                    <!-- </ul>
                </li> -->
                <!-- <li><a href="#">Tài khoản +</a>
                    <ul>
                        <li><a href="login.php">Đăng nhập</a></li>
                        <li><a href="register.php">Đăng kí</a></li>
                    </ul>
                </li> -->
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
         
         <div class="admin">
            <div class="image">
                  <img src="images/User_Avatar_2.png" alt="" />
            </div>
            <div class="name">
                  <h3><span><?php echo $_SESSION['user_name'] ?></span></h3>
                  <p><span><?php echo $_SESSION['user_email']; ?></p>
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