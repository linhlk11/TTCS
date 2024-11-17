<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'Ở. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'Giỏ hàng đang trống!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'Đơn hàng đã được đặt!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'Đặt hàng thành công!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Thanh toán đơn hàng</h3>
    <p> <a href="home.php">Trang chủ</a> / Thanh toán </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo '₫'.$fetch_cart['price'].'.000'.' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">Giỏ hàng đang trống!</p>';
        }
    ?>
    <div class="grand-total">Tổng : <span><span>₫</span><?php echo $grand_total; ?>.000</span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Đặt hàng</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Tên :</span>
                <input type="text" name="name" placeholder="Nhập tên">
            </div>
            <div class="inputBox">
                <span>Số điện thoại :</span>
                <input type="number" name="number" min="0" placeholder="Nhập số điện thoại">
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" placeholder="Nhập email">
            </div>
            <div class="inputBox">
                <span>Phương thức thanh toán :</span>
                <select name="method">
                    <option value="cash on delivery">Thanh toán khi nhận hàng</option>
                    <option value="credit card">Thẻ tín dụng</option>
                    <option value="paypal">paypal</option>
                    <option value="paytm">paytm</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Địa chỉ 01 :</span>
                <input type="text" name="flat" placeholder="e.g. Số nhà.">
            </div>
            <div class="inputBox">
                <span>Địa chỉ 02 :</span>
                <input type="text" name="street" placeholder="e.g. Đường.">
            </div>
            <div class="inputBox">
                <span>Thành phố :</span>
                <input type="text" name="city" placeholder="e.g. Hà Nội">
            </div>
            <div class="inputBox">
                <span>Quận / Huyện :</span>
                <input type="text" name="state" placeholder="e.g. Hà Đông">
            </div>
            <div class="inputBox">
                <span>Quốc gia :</span>
                <input type="text" name="country" placeholder="e.g Việt Nam">
            </div>
            <div class="inputBox">
                <span>Mã bưu điện :</span>
                <input type="number" min="0" name="pin_code" placeholder="e.g. 123456">
            </div>
        </div>

        <input type="submit" name="order" value="Thanh toán" class="btn">

    </form>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>