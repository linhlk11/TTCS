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
   <title>Giới thiệu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Thông tin về WaDu</h3>
    <p> <a href="home.php">Trang chủ</a> / Giới thiệu </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/Delivery Service Illustration.jpg" alt="">
        </div>

        <div class="content">
            <h3>Giao hàng nhanh chóng!</h3>
            <p>Miễn phí vận chuyển từ đơn hàng 1000k.</p>
            <a href="shop.php" class="btn">Mua ngay</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Mua hàng mọi lúc mọi nơi!</h3>
            <p>Thỏa sức mua sắm tại nhà hay bất cứ đâu.</p>
            <a href="shop.php" class="btn">Đặt hàng</a>
        </div>

        <div class="image">
            <img src="images/Online-Order-Illustration.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/Feedback-Vector-Illustration.jpg" alt="">
        </div>

        <div class="content">
            <h3>Nhận xét về chúng tôi</h3>
            <p>Cùng xem những đánh giá từ những khách hàng đã mua sản phẩm từ WaDu.</p>
            <a href="#reviews" class="btn">Đánh giá khách hàng</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Đánh giá khách hàng</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Giao hàng nhanh, sản phẩm chất lượng.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dũng</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>