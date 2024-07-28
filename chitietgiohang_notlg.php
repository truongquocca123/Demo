<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#HAT - Cung cấp các sản phẩm chính hãng với dịch vụ uy tín tại VN</title>
    <link rel="stylesheet" type="text/css" href="decor.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <?php
            session_start();
            if (!isset($_SESSION['DSMaMua'])) {
                $_SESSION['DSMaMua'] = array();
            }
            if (!isset($_SESSION['DSSL'])) {
                $_SESSION['DSSL'] = array();
            }
            $n = sizeof($_SESSION['DSMaMua']);
        ?>
</head>
<body>
<script type="text/javascript" src="plusandminus.js"></script>
    <?php
            $tendn="";
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
            ob_start();
            $n=sizeof($_SESSION['DSMaMua']);
            $TongTien=0;
            for($i=0;$i<$n;$i++)
            {
            $truyvan="SELECT * FROM SANPHAM AS S, CHITIETDONHANG AS CTDH WHERE CTDH.MASP = S.MASP AND S.MASP='".$_SESSION['DSMaMua'][$i]."'";
            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
            $dong=mysqli_fetch_array($ketqua);
            $madh = $dong['MADH'];
            if(isset($_POST['txtSL'][$i]))
            {
                $_SESSION['DSSL'][$i]=$_POST['txtSL'][$i];
            }    
            $Tien=$_SESSION['DSSL'][$i] * $dong['GIA'];
            $TongTien+=$Tien;                
            if(isset($_POST["btnThanhToan"]))
            {
                $ten=$_POST["txthoten"];
                $dc=$_POST["txtdiachi"];
                $tendn=$_POST["txttendangnhap"];
                $sdt=$_POST["txtdienthoai"];
                $kt=1;
                
                if(empty($tendn)||empty($sdt)||empty($ten)||empty($dc))
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
                    $truyvan1="SELECT * FROM CHITIETDONHANG";
                    $ketqua1=mysqli_query($conn,$truyvan1) or die(mysqli_error($conn));
                    $row = mysqli_fetch_array($ketqua1);                       
                    $madh = $row['MADH'];    
                    $donhang="INSERT INTO DONHANG (TENDANGNHAP, MADH, DIACHI, SODT, HOTEN, TONGTIEN, THANHTOAN)
                    VALUES ('$tendn','$madh','$dc','$sdt','$ten','$TongTien','CASH')";
                    $results= mysqli_query($conn,$donhang) or die(mysqli_error($conn));
                    header('Location:chitietgiohang.php');
                }
            }
        ?>
<article>
    <span class="ars1"></span>
    <table class="dtt-products">
    <?php
                echo "
                    <tr> 
                        <td> <img src='".$dong['HINH']."'></td> 
                        <td class='tsp_dtt'>".$dong['TENSP']."</td>
                        <td>Size: ".$dong['SIZEGIAY']." &emsp; </td>
                        <td id='dtt_gia'>".number_format($dong['GIA'])." ₫</td>
                    </tr>
                    <tr>
                        <td colspan='4'><span class='tsp_span'></span></td>
                    </tr>
                    ";        
                }
                echo "<tr> <td colspan='3'> Tạm tính: </td> <td>".number_format($TongTien)." ₫ </td> </tr>
                      <tr> <td colspan='3'> Phí vận chuyển (Cước phí tạm tính):</td> <td>Miễn phí</td></tr>
                ";    
                echo "<tr>
                        <td colspan='4'><span class='tsp_span'></span></td>
                    </tr>";
                echo "<tr> <td colspan='3' class='tt'> Tổng tiền: </td><td class='tt_1'><span>VND&ensp;</span>".number_format($TongTien)."₫ </td> </tr>";        
    ?>
    </table>
</article>
<article>
        <span class="ars"></span>
        <form name="frmDienTT" method="post" action="chitietgiohang_notlg.php">
            <table class="dtt">
                <caption class="dtt1">S & O Sneaker Online</caption>
                <span class="dtt2"><a href="giohang.php">&emsp;Giỏ hàng</a>&ensp;>&ensp;Thông tin giao hàng&ensp;>&ensp;Phương thức thanh toán</span>
                <span class="dtt2_1">Thông tin giao hàng</span>
                <span class="dtt2_2">Bạn đã có tài khoản <a href="dangnhap.php">Đăng nhập</a></span>
                <tr>
                    <td class="dtt3" colspan="2"><input type="text" name="txthoten" placeholder="Họ và tên" require="true" size="20" value="<?php echo $ten ?>" id="dk4"></td>
                </tr>
                <tr>
                    <td class="dtt3_1"><input type="text" name="txttendangnhap" placeholder="Email" size="20" value="<?php echo $tendn ?>" id="dk4"></td>
                    <td class="dtt3_2"><input type="text" name="txtdienthoai" placeholder="Số điện thoại"></td>
                </tr>
                <label class="ipdtt">
                    <span class="ipdtt1">Giao tận nơi (Cước phí tạm tính)</span>
                    <span class="ipdtt2"></span>
                    <tr>
                        <td class="dtt3_3" colspan="2"><input type="text" name="txtdiachi" placeholder="Địa chỉ" require="true" size="20" value="<?php echo $dc ?>" id="dk4"></td>
                    </tr>
                </label>
                <tr>
                     <td colspan="3" class="dtt4" align="center"><input type="submit" name="btnThanhToan" value="Thanh toán"></td>
                </tr>
                <tr>
                    <td>
                        <p class="cbhomepagedtt"><a href="giohang.php">Giỏ hàng</a></p>
                    </td>
                </tr>
            </table>
        </form>
</article>
    </body>
</html>