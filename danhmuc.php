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
        $conn = MoKetNoi();
        mysqli_select_db($conn,"HAT");
        if (isset($_GET['loai'])) {
            $loaichon = $_GET['loai'];
            $truyvan1 = "SELECT * FROM loai WHERE MATL = '" . $loaichon . "' ";
            $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
            for ($i = 1; $i <= mysqli_num_rows($ketqua1); $i++) {
            $dong1 = mysqli_fetch_array($ketqua1);

            // Lấy danh sách sách thuộc loại sp hiện tại
            $truyvan = "SELECT * FROM SANPHAM AS S, loai AS L WHERE S.MATL = L.MATL AND TENTL = '" . $dong1['TENTL'] . "'";
            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
            $dong = mysqli_fetch_array($ketqua);
            echo '<span>'.$dong['THUONGHIEU'].'</span>';
        }
        }
    ?>
    </span></header>
    <?php include "Menutrai.php"; ?>
    <aside class="cate-products">
        <span>&emsp;<?php 
        if(isset($_GET['loai'])){
            $loaichon = $_GET['loai'];
            $truyvan1 = "SELECT * FROM loai WHERE MATL = '" . $loaichon . "'";
            $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
            $dong1 = mysqli_fetch_array($ketqua1);
            echo"<span>GIÀY ".$dong1['TENTL']." </span>";
        }
        ?></span>    
        <table class ="new-products">
                <?php
                $pic = 1;
                // Lấy danh sách loại sp
                if (isset($_GET['loai'])) {
                    $loaichon = $_GET['loai'];
                    $truyvan1 = "SELECT * FROM loai WHERE MATL = '" . $loaichon . "'";
                    $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                    // Lặp qua danh sách loại sp
                    for ($i = 1; $i <= mysqli_num_rows($ketqua1); $i++) {
                    $dong1 = mysqli_fetch_array($ketqua1);
                    // Lấy danh sách sách thuộc loại sp hiện tại
                    $truyvan = "SELECT * FROM SANPHAM AS S, loai AS L WHERE S.MATL = L.MATL AND TENTL = '" . $dong1['TENTL'] . "'";
                    $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                    $so_san_pham = mysqli_num_rows($ketqua); // Lấy tổng số sản phẩm
                    $so_dong = ceil($so_san_pham / 5); // Tính số dòng cần hiển thị
                    for($i =1; $i <= $so_dong; $i++){
                    echo '<tr>';
                    // Lặp qua danh sách sp
                    for ($j = 1; $j <= 4; $j++) {
                        if ($j * $i > $so_san_pham) { // Kiểm tra nếu vượt quá số sản phẩm
                            break; // Dừng lặp cột nếu hết sản phẩm
                          }
                    $dong = mysqli_fetch_array($ketqua);
                    $tensp = $dong['TENSP'];
                    $tensp_ngan = substr($tensp, 0, 35);
                    if (strlen($tensp) > 35) {
                        $tensp_ngan .= "...";
                    }
                    if($j >= 1 && $j <= 4){
                    echo '<td><a href="sanpham.php?Masanpham='.$dong['MASP'].'"><img onmouseover="this.src=\'picture/'. $pic.'.1.webp\'" onmouseout="this.src=\'picture/'.$pic.'.webp\'" src="' . $dong['HINH'] . '">
                        <br> <br><span class="s1">&ensp; '.$tensp_ngan.' </span>
                        <br>     <span class="s2">&ensp;'.number_format($dong['GIA']).' đồng</span><br>
                        </a></td>';
                        $pic++;
                    }
                    // Hiển thị thông tin sp
                    }
                    echo '</tr>';
                }
                if ($so_san_pham % 4 != 0) {
                    echo "<tr>";
                  
                    // Lặp lại các sản phẩm còn d
                    for ($k = 1; $k <= $so_san_pham%4; $k++) {
                      $dong = mysqli_fetch_array($ketqua); // Lấy thông tin sản phẩm cuối cùng
                      // Hiển thị thông tin sản phẩm
                      echo '<td><a href="sanpham.php?Masanpham='.$dong['MASP'].'"><img onmouseover="this.src=\'picture/'. $pic.'.1.webp\'" onmouseout="this.src=\'picture/'. $pic.'.webp\'" src="' . $dong['HINH'] . '">
                      <br> <br><span class="s1">&ensp; '.$tensp_ngan.' </span>
                      <br>     <span class="s2">&ensp;'.number_format($dong['GIA']).' đồng</span><br>
                      </a></td>';
                      $pic++;
                    }
                  
                    echo "</tr>";
                  }
                }
                }
                ?>
            </table>
    </aside>
    <?php include 'dangkythongbao.php' ?>
    <?php include 'cuoitrang.php' ?>
</body>
</html>