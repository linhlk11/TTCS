<?php

// Thông tin kết nối
$conn = mysqli_connect('localhost', 'root', 'root', 'shop_db');

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
} else {
    echo "Kết nối đến cơ sở dữ liệu thành công!";
}

// Đóng kết nối
mysqli_close($conn);

?>
