<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'Đã được thêm vào danh sách yêu thích';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'Đã được thêm vào giỏ hàng';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'Sản phẩm được thêm vào danh sách yêu thích';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'Đã được thêm vào giỏ hàng';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'Sản phẩm được thêm vào giỏ hàng';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">

   <div class="swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
         <!-- Slides -->
         <div class="swiper-slide" style="background: url(../images/bg01.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="content">
               <h3><span>Hàng mới về</span></h3>
               <p>Hệ thống phân phối mỹ phẩm chính hãng uy tín và dịch vụ chăm sóc khách hàng tận tâm.</p>
               <a href="#products-section" class="btn">Xem thêm</a>
            </div>
         </div>
         <div class="swiper-slide" style="background: url(../images/bg02.avif); background-size: cover; background-position: top; background-repeat: no-repeat;">
            <div class="content">
               <h3><span>Giới thiệu</span></h3>
               <p>Đến với shop bạn có thể hoàn toàn yên tâm khi lựa chọn cho mình những bộ sản phẩm phù hợp và ưng ý từ các nhãn hàng nổi tiếng trên toàn thế giới.</p>
               <a href="#home-contact-section" class="btn">Liên hệ</a>
            </div>
         </div>
         <div class="swiper-slide" style="background: url(../images/bg03.avif); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="content">
               <h3><span>Mỹ phẩm</span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime reiciendis, modi placeat sit cumque molestiae.</p>
               <a href="shop.php" class="btn">Xem thêm</a>
            </div>
         </div>
      </div>
      <!-- If we need pagination -->
      <!-- <div class="swiper-pagination"></div> -->

      <!-- If we need navigation buttons -->
      <!-- <div class="swiper-button-prev"></div> -->
      <!-- <div class="swiper-button-next"></div> -->

      <!-- If we need scrollbar -->
      <div class="swiper-scrollbar"></div>
   </div>

</section>

<section class="products" id="products-section">

   <h1 class="title">Sản phẩm mới nhất</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="image">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         </div>
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price"><span>₫</span><?php echo $fetch_products['price']; ?>.000</div>
         <div class="purchase-box">
            <div class="purchase-box-top">
               <input type="number" name="product_quantity" value="1" min="0" class="qty">
               <input type="submit" value="Đặt mua" name="add_to_cart" class="btn btn-add">
            </div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="Yêu thích" name="add_to_wishlist" class="option-btn">
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">Chưa có sản phẩm nào!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">Xem thêm</a>
   </div>

</section>

<section class="home-contact" id="home-contact-section">

   <div class="content">
      <a href="contact.php" class="btn">Liên hệ</a>
      <!-- <h3>Liên hệ</h3> -->
      <p>Hãy liên hệ với chúng tôi bất cứ khi nào.</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.301678832324!2d105.78570991473057!3d20.98054088602454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acce762c2bb9%3A0xbb64e14683ccd786!2zSOG7jWMgVmnhu4duIENOIELGsHUgQ2jDrW5oIFZp4buFbiBUaMO0bmcgLSBIw6AgxJDDtG5n!5e0!3m2!1svi!2s!4v1650904949651!5m2!1svi!2s" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>

</section>




<?php @include 'footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>