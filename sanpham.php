    <?php include 'dautrang.php' ?>
        <nav>
            <ul id="main-menu">
                <li><a href="trangchu.php">TRANG CHỦ</a></li>
                <?php include 'menuchinh.php'?>
            </ul>
        </nav>
        <header class="second"><span><a href="trangchu.php">&emsp;Trang Chủ</a>&ensp;/&ensp;<a href="danhmuc.php">Danh Mục</a>&ensp;/&ensp;
        <?php 
            include 'ketnoi.php';
            $conn=MoKetNoi();
            mysqli_select_db($conn,"HAT");	   
            if(isset($_GET['Masanpham']))
            {
                $sanpham = $_GET['Masanpham'];
                $truyvan="SELECT * FROM SANPHAM WHERE MASP = '".$sanpham."'";
                $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                $dong = mysqli_fetch_array($ketqua);
                echo '<span>'.$dong['TENSP'].'</span>';
            }
        ?>
        </span></header>
        <article class = "article-products"> 
            <table class="products">
                <?php	
                error_reporting(0);
                if(isset($_GET['Masanpham']))
                {
                    $sanpham = $_GET['Masanpham'];
                    $truyvan="SELECT * FROM SANPHAM WHERE MASP = '".$sanpham."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    echo "
                        <tr> <td rowspan='5'> <img class='o' src='".$dong['HINH']."'></td> </tr>
                        <tr><td>
                        <span class='sp1'>". $dong['TENSP'] ." <br></span>
                        <span class='sp2'>".number_format($dong['GIA'])." đồng<br> </span>
                        <span class='sp3'>Thương hiệu :".$dong['THUONGHIEU']."<br></span>  
                        <span class='sp4'> Size giày :".$dong['CHITIETSIZEGIAY']."<br> </span> 
                        </td> </tr><br> <br>";
                }
            ?>    
            </table>
            <form action="" method="post">
            <table class="size_shoes"> 
            <?php 
                //error_reporting(0);
                if(isset($_GET['Masanpham']))
                {
                    
                    $sanpham = $_GET['Masanpham'];
                    $makh = $_SESSION['makhachhang'];  
                    if (!isset($_SESSION['makhachhang'])) {
                        $_SESSION['makhachhang'] = uniqid();
                    } 
                    $truyvan="SELECT * FROM SANPHAM AS S,SIZEGIAY AS SZ  WHERE S.MASP = SZ.MASP AND SZ.MASP = '".$sanpham."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    $size = mysqli_num_rows($ketqua);
                    $mahd = $makh . uniqid(); 
                    $so_dong = ceil($size/5);
                    $sosize = $dong['SIZEGIAY'];
                    for($i = 1; $i <= $so_dong; $i++){
                        echo"<tr>";
                        for($j = 1; $j <= 4; $j++){
                            echo"
                            <td><input type='radio' value=".$sosize." name='size'>
                            <label for='size'>".$sosize."</label>
                            ";
                            $sosize++;
                        }
                        echo'</tr>';    
                    }
                
                if(isset($_SESSION['tendangnhap']) && isset($_SESSION['loainguoidung']))
                {
                    if($_SESSION['loainguoidung']=='user')
                    {
                        echo "<button class='sp5' name='btnThemGioHang'> Thêm vào giỏ hàng </button>";
                        $n=sizeof($_SESSION['DSMaMua']);
                        if(isset($_POST['btnThemGioHang']))
                        {   
                            if($n==0)
                            {
                                if(isset($_POST['size']))
                                {
                                $selectedSize = $_POST['size'];
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua giày <3');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG, SIZEGIAY)
                                                VALUES ('" . ($mahd) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "',  '" . $selectedSize . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                                }
                                else{
                                    echo "<span class='sp6'>Vui lòng chọn size giày!</span>";
                                }
                            }
                            else
                            {
                                $kt=0;
                                $i=0;
                                while($kt==0 && $i<$n)
                                {
                                    if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASP'])==0)
                                    {    
                                        $kt=1; 
                                    }
                                    else
                                        $i++;
                                }
                                if($kt==0)
                                {
                                    if(isset($_POST['size']))
                                    {
                                        $selectedSize = $_POST['size'];
                                    array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                    array_push($_SESSION['DSSL'],1);
                                    echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua giày <3');</script>";
                                    echo "<script>window.location = window.location;</script>";
                                    $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                    for ($i = 0; $i < $n+1; $i++) {
                                        $dong1 = mysqli_fetch_array($ketqua);
                                        $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG, SIZEGIAY)
                                                    VALUES ('" . ($mahd) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "',  '" . $selectedSize . "')";
                                        $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                    }
                                    }
                                    else{
                                        echo "<span class='sp6'>Vui lòng chọn size giày!</span>";
                                    }
                                }
                            }
                        }
                    }
                }
                else
                {
                echo "<button class='sp5' name='btnThemGioHang'> Thêm vào giỏ hàng </button>";
                    $n=sizeof($_SESSION['DSMaMua']);
                        if(isset($_POST['btnThemGioHang']))
                        {
                            if($n==0)
                            {
                                if(isset($_POST['size']))
                                {
                                $selectedSize = $_POST['size'];
                                $madh = $makh . uniqid() + 1;
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua giày <3');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MASP, DONGIA, SOLUONG, SIZEGIAY)
                                                VALUES ('" . ($madh) . "', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "',  '" . $selectedSize . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                                }
                                else{
                                    echo "<span class='sp6'>Vui lòng chọn size giày!</span>";
                                }
                            }
                            else
                            {
                                $kt=0;
                                $i=0;
                                while($kt==0 && $i<$n)
                                {
                                    if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASP'])==0)
                                        $kt=1; 
                                    else
                                        $i++;
                                }
                                if($kt==0)
                                {
                                    if(isset($_POST['size']))
                                {
                                $selectedSize = $_POST['size'];
                                $madh = $makh . uniqid() + 1;
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua giày <3');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG, SIZEGIAY)
                                                VALUES ('" . ($madh) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "',  '" . $selectedSize . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                                }
                                else{
                                    echo "<span class='sp6'>Vui lòng chọn size giày!</span>";
                                }
                                }
                            }
                        }
                }
            }
            ?>
            </table>
        </form>
        </article>
        <?php include 'dangkythongbao.php' ?>
    <?php include 'cuoitrang.php' ?>
    </body>
    </html>