<html>
<?php include 'dautrang.php'?>
    <body>
    <?php
            $tendn="";
            $mk="";
            $ten="";
            $dc="";
            $sdt="";
            include "ketnoi.php";
            $conn=MoKetNoi();
            if($conn->connect_error) 
            {
                echo"<p>Không kết nối được MySQL</p>";
            }
            mysqli_select_db($conn,"HAT");
            if(isset($_POST["btnDKy"]))
            {
                $ten=$_POST["txthoten"];
                $dc=$_POST["txtdiachi"];
                $tendn=$_POST["txttendangnhap"];
                $mk=$_POST["txtmk"];
                $sdt=$_POST["txtdienthoai"];
                $kt=1;
                
                if(empty($tendn)||empty($mk)||empty($sdt)||empty($ten)||empty($dc))
                {
                    echo "<p>Bạn chưa nhập như thông tin bắt buộc (*) chưa đầy đủ</p>";
                    $kt=0;
                }
                if(mysqli_num_rows(mysqli_query($conn,"SELECT TENDANGNHAP FROM NGUOIDUNG WHERE TENDANGNHAP ='$tendn'"))>0)
                {
                    echo"<p> Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. </p>";
                    $kt=0;
                }
                if(mysqli_num_rows(mysqli_query($conn,"SELECT SODT FROM NGUOIDUNG WHERE SODT ='$sdt'"))>0)
                {
                    echo"<p>Số điện thoại này đã có người dùng. Vui lòng chọn số điện thoại khác.</p>";
                    $kt=0;
                }
                if($kt==1)
                {
                    $nguoidung="INSERT INTO NGUOIDUNG(TENDANGNHAP,MATKHAU,DIACHI,HOTEN,SODT)
                    VALUES ('{$tendn}',{$mk},'{$dc}','{$ten}','{$sdt}')";
                    $results= mysqli_query($conn,$nguoidung) or die(mysqli_error($conn));
                    echo '<script>alert("Bạn đã đăng ký thành công!");</script>';
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
        <form name="frmDangKy" method="post" action="DangKy.php">
            <table>
                <table class="lg">
                <caption class="lg1">Đăng Ký</caption>
                <caption class="lg2"></caption>
                <tr>
                    <td class="lg3"><input type="text" name="txthoten" placeholder="Họ tên" require="true" size="20" value="<?php echo $ten ?>" id="dk4"></td>
                </tr>
                <tr>
                    <td class="lg3"><input type="text" name="txtdiachi" placeholder="Địa chỉ" require="true" size="20" value="<?php echo $dc ?>" id="dk4"></td>
                </tr>
                <tr>
                    <td class="lgradio"><input type="radio" name="Name" ><span>Nữ</span><input type="radio" name="Name"><span>Nam</span></td>
                </tr>
                <tr>
                    <td class="lg3"><input type="text" name="txtdienthoai" placeholder="Số Điện thoại"></td>
                </tr>
                <tr>
                    <td class="lg3"><input type="text" name="txttendangnhap" placeholder="Email" size="20" value="<?php echo $tendn ?>" id="dk4"></td>
                </tr>
                <tr>
                    <td class="lg3"><input type="password" name="txtmk" placeholder="Mật khẩu" require="true" size="20" value="<?php echo $mk ?>" id="dk4"></td>
                </tr>
                <tr>
                     <td colspan="3" class="lg4" align="center"><input type="submit" name="btnDKy" value="Đồng ý"></td>
                </tr>
                <tr>
                    <td>
                        <p class="cbhomepage"><a href="trangchu.php"><i class="fa-solid fa-arrow-left"></i>&ensp;Quay lại trang chủ</a></p>
                    </td>
                </tr>
        </table>
        </form>
        <?php include 'dangkythongbao.php' ?>
        <?php include 'cuoitrang.php' ?>
    </body>
</html>