<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
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
   <link rel="stylesheet" href="css/style.css">

   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Đơn hàng</h3>
    <p> <a href="home.php">Trang chủ</a> / Đơn hàng </p>
</section>

<section class="placed-orders">

    <!-- <h1 class="title">Đơn hàng</h1> -->

    <div class="box-container">

        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>
        <div class="box">
            <p> Thời gian đặt hàng : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
            <p> Tên người dùng : <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
            <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
            <p> Sản phẩm : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p> Tổng thanh toán : <span><span>₫</span><?php echo $fetch_orders['total_price']; ?>.000</span> </p>
            <p> Trạng thái : <span style="color:
                <?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>">
                <?php if($fetch_orders['payment_status'] == 'pending'){echo 'Chờ xử lý'; }else{echo 'Đã thanh toán';} ?>
            </span> </p>
        </div>
        <?php
            }
        }else{
            echo '<p class="empty">no orders placed yet!</p>';
        }
        ?>
    </div>
    
</section>







<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>