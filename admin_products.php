<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['add_product'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/' . $image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'Tên sản phẩm đã tồn tại!';
   } else {
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('query failed');

      if ($insert_product) {
         if ($image_size > 2000000) {
            $message[] = 'Kích thước hình ảnh quá lớn!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'Thêm sản phẩm thành công!';
         }
      }
   }
}

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sản phẩm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="add-products">

      <div class="products-modal" style="z-index: 99;"> 
         <form action="" method="POST" enctype="multipart/form-data">
            <h3>Thêm sản phẩm mới</h3>
            <input type="text" class="box" required placeholder="Tên sản phẩm" name="name">
            <input type="number" min="0" class="box" required placeholder="Giá" name="price">
            <textarea name="details" class="box" required placeholder="Chi tiết sản phẩm" cols="30" rows="10"></textarea>
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
            <div class="products-modal-btn">
               <input type="submit" value="Thêm mới" name="add_product" class="btn">
               <button type="button" class="btn close">Đóng</button>
            </div>
         </form>
      </div>

   </section>

   <section class="show-products">

      <!-- <div class="box-container">

      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
         while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
      <div class="box">
         <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Bạn muốn xóa sản phẩm này?');">Xóa</a>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
      }
      ?>
   </div> -->

      <!-- <h1 class="title float-left">Sản phẩm</h1> -->
      <h1 class="title">
         <p>Sản phẩm</p>
         <button class="btn add-product">Thêm sản phẩm</button>
      </h1>

      <div class="table-products">
         <table class="products-table">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Chi tiết</th>
                  <th>Hành động</th>
                  <!-- <th>Xóa</th> -->
               </tr>
            </thead>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
               $i = 1;
               while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><img src="uploaded_img/<?php echo $fetch_products['image']; ?>" height="100" alt=""></td>
                     <td><?php echo $fetch_products['name']; ?></td>
                     <td><span>₫</span><?php echo $fetch_products['price']; ?>.000</td>
                     <td><?php echo $fetch_products['details']; ?></td>
                     <td>
                        <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Cập nhật</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Bạn muốn xóa sản phẩm này?');"> <i class="fas fa-trash"></i> Xóa</a>
                     </td>
                  </tr>
            <?php
                  $i++;
               }
            } else {
               echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
            }
            ?>
         </table>
      </div>

      <!-- <div class="products-modal add-products">
      <div class="modal-content">
         <span class="close">&times;</span>
         <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
               <h3>Thêm sản phẩm mới</h3>
               <input type="text" class="box" required placeholder="Tên sản phẩm" name="name">
               <input type="number" min="0" class="box" required placeholder="Giá" name="price">
               <textarea name="details" class="box" required placeholder="Chi tiết sản phẩm" cols="30" rows="10"></textarea>
               <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
               <input type="submit" value="Thêm mới" name="add_product" class="btn">
            </form>
         </div>
      </div>
   </div> -->

   </section>










   <!-- jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script>
      $(document).ready(function() {
         $('.add-product').click(function() {
            $('.products-modal').show();
         });
         $('.close').click(function() {
            $('.products-modal').fadeOut(300);
         });

         $('.products-modal').click(function(e) {
            if (e.target.className == 'products-modal') {
               $('.products-modal').fadeOut(300);
            }
         });
      });
   </script>
   <script src="js/admin_script.js"></script>

</body>

</html>