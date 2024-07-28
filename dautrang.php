<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#HAT - Cung cấp các sản phẩm chính hãng với dịch vụ uy tín tại VN</title>
    <link rel="stylesheet" type="text/css" href="decor.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <header class="first"><span>TẠO TÀI KHOẢN, DÙNG CODE 'HELLO' GIẢM 5% CHO ĐƠN HÀNG ĐƠN TIÊN, GIẢM TỐI ĐA 100.000Đ (KHÔNG ÁP DÙNG VỚI CÁC CHƯƠNG TRÌNH/MÃ KHUYẾN MÃI KHÁC)</span></header>
    <?php 
    ?>
    <header>
    <form action="timkiemgiay.php" method="post">
        <div class="search-container">
            <p class="searching"><i class="fa-solid fa-magnifying-glass"></i></p>
            <input type="text" class="search-input" name="txtTuKhoa" placeholder="Tìm kiếm..." required>
            <button type="submit" class="search-submit" name="btnTimKiem">Tìm kiếm</button> 
        </div>
    </form>
        <span class="slogan1">Online Sneaker Store</span>
        <span class="slogan2"><br><br><br>Hàng chính hãng giá cao #HAT</span>
        <?php
            session_start();
            if(isset($_SESSION['tendangnhap']) && isset($_SESSION['loainguoidung']))
            {
                if($_SESSION['loainguoidung']=='user')
                {
                    $n = sizeof($_SESSION['DSMaMua']);
                    if($n == 0 )
                    echo "<span class='shopping'><a href='giohang.php'><i class='fa-solid fa-cart-shopping'></i><span class='shopping-span'>".$n."</span></a></span>";
                    else
                    echo "<span class='shopping'><a href='giohang.php'><i class='fa-solid fa-cart-shopping'></i><span class='shopping-span'>".$n."</span></a></span>";
                }
            }
            else{
                if (!isset($_SESSION['DSMaMua'])) {
                    $_SESSION['DSMaMua'] = array();
                }
                if (!isset($_SESSION['DSSL'])) {
                    $_SESSION['DSSL'] = array();
                }
                $n = sizeof($_SESSION['DSMaMua']);
                echo "<span class='shopping'><a href='dangnhap.php'><i class='fa-solid fa-user'></i></a></span>";
                echo "<span class='shopping'><a href='giohang.php'><i class='fa-solid fa-cart-shopping'></i><span class='shopping-span'>".$n."</span></a></span>";
            }
        ?>
    </header>
</head>
<body>
<script type="text/javascript" src="plusandminus.js"></script>
