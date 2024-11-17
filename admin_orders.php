<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['update_order'])) {
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đơn hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="placed-orders show-products">

      <h1 class="title">Đơn hàng</h1>

      <!-- <div class="box-container">

      <?php

      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if (mysqli_num_rows($select_orders) > 0) {
         while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
      ?>
      <div class="box">
         <p> ID người dùng: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Thời gian đặt hàng : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Tên người dùng : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Tổng số sản phẩm : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Tổng thanh toán : <span><span>₫</span><?php echo $fetch_orders['total_price']; ?>.000</span> </p>
         <p> Phương thức thanh toán : 
            <span>
               <?php echo $fetch_orders['method']; ?>
            </span> 
         </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option disabled selected>
                  <?php
                  if ($fetch_orders['payment_status'] == 'pending') {
                     echo 'Chưa thanh toán';
                  } elseif ($fetch_orders['payment_status'] == 'completed') {
                     echo 'Đã thanh toán';
                  }
                  // echo $fetch_orders['payment_status']; 
                  ?>
               </option>
               <option value="pending">Chưa thanh toán</option>
               <option value="completed">Đã thanh toán</option>
            </select>
            <input type="submit" name="update_order" value="Cập nhật" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc xóa đơn hàng này?');">Xóa</a>
         </form>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">Chưa có đơn hàng nào!</p>';
      }
      ?>
   </div> -->
      <div class="table-products">
         <table class="placed-orders-table products-table">
            <tr>
               <th>STT</th>
               <th>Thời gian</th>
               <th>Người dùng</th>
               <th>Số điện thoại</th>
               <!-- <th>Email</th> -->
               <th>Địa chỉ</th>
               <th>Sản phẩm</th>
               <th>Tổng</th>
               <th>Phương thức thanh toán</th>
               <th>Trạng thái</th>
               <!-- <th>Hành động</th> -->
            </tr>
            <?php

            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
               $i = 1;
               while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $fetch_orders['placed_on']; ?></td>
                     <td><?php echo $fetch_orders['name']; ?></td>
                     <td><?php echo $fetch_orders['number']; ?></td>
                     <!-- <td><?php echo $fetch_orders['email']; ?></td> -->
                     <td><?php echo $fetch_orders['address']; ?></td>
                     <td><?php echo $fetch_orders['total_products']; ?></td>
                     <td><?php echo $fetch_orders['total_price']; ?></td>
                     <td>
                        <span>
                           <?php echo $fetch_orders['method']; ?>
                        </span>
                     </td>
                     <td>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                           <select name="update_payment">
                              <option disabled selected>
                                 <?php
                                 if ($fetch_orders['payment_status'] == 'pending') {
                                    echo 'Chưa thanh toán';
                                 } elseif ($fetch_orders['payment_status'] == 'completed') {
                                    echo 'Đã thanh toán';
                                 }
                                 // echo $fetch_orders['payment_status']; 
                                 ?>
                              </option>
                              <option value="pending">Chưa thanh toán</option>
                              <option value="completed">Đã thanh toán</option>
                           </select>
                           <input type="submit" name="update_order" value="Cập nhật" class="option-btn">
                           <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc xóa đơn hàng này?');">Xóa</a>
                        </form>
                     </td>
                     <!-- <td>
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc xóa đơn hàng này?');">Xóa</a>
         </td> -->
                  </tr>
            <?php
                  $i++;
               }
            } else {
               echo '<p class="empty">Chưa có đơn hàng nào!</p>';
            }
            ?>

            <!-- <?php
                  // $sql = "SELECT * FROM orders";
                  // $result = mysqli_query($conn, $sql);
                  // $i = 1;
                  // while($row = mysqli_fetch_assoc($result)){
                  //    $id = $row['id'];
                  //    $time = $row['time'];
                  //    $name = $row['name'];
                  //    $phone = $row['phone'];
                  //    $address = $row['address'];
                  //    $total_products = $row['total_products'];
                  //    $total_price = $row['total_price'];
                  //    $payment_method = $row['payment_method'];
                  //    $payment_status = $row['payment_status'];
                  //    $payment_status_text = "";
                  //    if($payment_status == 0){
                  //       $payment_status_text = "Chưa thanh toán";
                  //    }else if($payment_status == 1){
                  //       $payment_status_text = "Đã thanh toán";
                  //    }else if($payment_status == 2){
                  //       $payment_status_text = "Đã hủy";
                  //    }
                  //    echo '
                  //       <tr>
                  //          <td>'.$i.'</td>
                  //          <td>'.$time.'</td>
                  //          <td>'.$name.'</td>
                  //          <td>'.$phone.'</td>
                  //          <td>'.$address.'</td>
                  //          <td>'.$total_products.'</td>
                  //          <td>'.$total_price.'</td>
                  //          <td>'.$payment_method.'</td>
                  //          <td>'.$payment_status_text.'</td>
                  //          <!-- <td><a href="admin_orders.php?id='.$id.'">Xem chi tiết</a></td> -->
                  //       </tr>
                  //    ';
                  //    $i++;
                  // }
                  ?> -->


         </table>
      </div>
   </section>













   <script src="js/admin_script.js"></script>

</body>

</html>