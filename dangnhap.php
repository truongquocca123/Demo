<html>
<?php include 'dautrang.php' ?>
<body>
<?php
        $dntendn = "";
        $dnmk = "";
        if(isset($_POST["btdangnhap"]))
        {
            include "ketnoi.php";
            $conn = MoKetNoi();
            if($conn->connect_error)
            {
                echo "Không kết nối được MySQL";
            }
            mysqli_select_db($conn, "HAT");
            $dntendn = $_POST['txtHoTen'];
            $dnmk = $_POST['txtMatkhau'];
            $kt = 1;
            if(empty($dntendn) || empty($dnmk))
            {
                echo "Bạn chưa nhập đủ thông tin đăng nhập";
                $kt = 0;
            }
            $query = mysqli_query($conn,"SELECT * FROM NGUOIDUNG WHERE TENDANGNHAP='$dntendn'" ) or die(mysqli_error($conn));
            if(mysqli_num_rows($query) == 0)
            {
                echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại hoặc đăng ký lại!!";
                $kt = 0;
            }
            else{
                $row = mysqli_fetch_array($query);
                if($dnmk != $row['MATKHAU'])
                {
                    echo '<script>alert("Sai mật khẩu, vui lòng thử lại!");</script>';
                    $kt = 0; 
                }
            }
            if($kt == 1)
            {
                $_SESSION['tendangnhap'] = $row['TENDANGNHAP'];
                $_SESSION['loainguoidung'] = $row['PHANLOAI'];
                $_SESSION['hoten'] = $row['HOTEN'];
                $_SESSION['makhachhang'] = $row['MAKH'];
                $_SESSION['DSMaMua'] = array();
                $_SESSION['DSSL'] = array();
                header('Location: trangchu.php');
                $_SESSION['isLogin'] = true;
            }
            // Bước 2: Khôi phục thông tin giỏ hàng khi đăng nhập
            if(isset($_SESSION['tendangnhap']) && isset($_SESSION['loainguoidung']) && $_SESSION['loainguoidung'] == 'user') {
                // Truy vấn cơ sở dữ liệu để lấy thông tin giỏ hàng
                $makh = $_SESSION['makhachhang'];
                $truyvan = "SELECT * FROM CHITIETDONHANG WHERE MAKH = '$makh'";
                $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));

                // Khôi phục thông tin giỏ hàng vào biến phiên (session)
                while ($dong = mysqli_fetch_array($ketqua)) {
                    array_push($_SESSION['DSMaMua'], $dong['MASP']);
                    array_push($_SESSION['DSSL'], $dong['SOLUONG']);
                    // Bạn cần thêm DSSize vào SESSION nếu bạn lưu thông tin về size
                    // array_push($_SESSION['DSSize'], $dong['SIZEGIAY']);
                }
            }
        }
    ?>
    <nav>
    <nav>
        <ul id="main-menu">
            <li><a href="trangchu.php">TRANG CHỦ</a></li>
            <?php include 'menuchinh.php'?>
        </ul>
    </nav>
    </nav>
    <article id="login">
    <form name="frmDangNhap" method="post" action= "dangnhap.php" >
   <table class="lg">
      <caption class="lg1">Đăng nhập</caption>
      <caption class="lg2"></caption>
      <tr><td class="lg3"><input type="text" name="txtHoTen"  value="<?php echo $dntendn ?>" placeholder="Email"></td></tr>
      <tr><td class="lg3"><input type="password" name="txtMatkhau" value="<?php echo $dnmk ?>" placeholder="Mật khẩu"></td></tr>
      <tr><td><p class="nonpass"><a href="#">Quên mật khẩu?</a></p><span class="nonpass_sub">hoặc</span></td></tr>
      <tr>
         <td>
            <p class="lg5"><a href="dangky.php">&emsp;Tạo tài khoản</a></p>
         </td>
      </tr>
      <tr>
         <td colspan="3" class="lg4"><input type="submit" name="btdangnhap" value="Đăng Nhập"></td>
      </tr>
   </table>
</form>

    </article> 
<?php include 'dangkythongbao.php' ?>
<?php include 'cuoitrang.php' ?>
</body>
</html>