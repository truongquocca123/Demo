<?php include 'dautrang.php' ?>
    <nav>
        <ul id="main-menu">
            <li><a href="trangchu.php">TRANG CHỦ</a></li>
            <?php include 'menuchinh.php'?>
        </ul>
    </nav>
    <aside class="img">
    </aside>
    <aside class="img1">
        <table class="news">
            <tr>
                <td><a href="#"><img src="picture/block_home_category1.png"></a></td>
                <td><a href="#"><img src="picture/block_home_category2.png"></a></td>
                <td><a href="#"><img src="picture/block_home_category3.jpg"></a></td>
            </tr>
        </table>
    </aside>
    <aside class="mid-products">
        <span>SẢN PHẨM MỚI MỖI NGÀY</span>
    </aside>
    <article>
    <table class ="new-products">
                    <?php
                    include 'ketnoi.php';  
                    $conn = MoKetNoi();
                    $pic = 1;
                    mysqli_select_db($conn,"HAT");
                    // Lấy danh sách loại sách
                    $truyvan1 = "SELECT * FROM loai WHERE MATL = 'NK'";
                    $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                    // Lặp qua danh sách loại sp
                    for ($i = 1; $i <= mysqli_num_rows($ketqua1); $i++) {
                        $dong1 = mysqli_fetch_array($ketqua1);

                        // Lấy danh sách sách thuộc loại sp hiện tại
                        $truyvan = "SELECT * FROM SANPHAM AS S, loai AS L WHERE S.MATL = L.MATL AND TENTL = '" . $dong1['TENTL'] . "'";
                        $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                        echo "<tr>";
                        // Lặp qua danh sách sp
                        for ($j = 1; $j <= 5; $j++) {
                        $dong = mysqli_fetch_array($ketqua);
                        $tensp = $dong['TENSP'];
                        $tensp_ngan = substr($tensp, 0, 30);
                        if (strlen($tensp) > 30) {
                            $tensp_ngan .= "...";
                        }
                        // Hiển thị thông tin sp
                        echo '<td><a href="sanpham.php?Masanpham='.$dong['MASP'].'"><img onmouseover="this.src=\'picture/'. $pic.'.1.webp\'" onmouseout="this.src=\'picture/'.$pic.'.webp\'" src="' . $dong['HINH'] . '">
                        <br> <br><span class="s1">&ensp; '.$tensp_ngan.' </span>
                        <br>     <span class="s2">&ensp;'.number_format($dong['GIA']).' đồng</span>
                        </a></td>
                        ';
                        $pic++;
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
    </article>
    <span class="all-products"><a href="#">TẤT CẢ SẢN PHẨM MỚI</a></span>
    <aside class="mid-products">
        <span>NIKE AIR FORCE 1</span>
    </aside>
    <article>
        <table class ="new-products">
                    <?php
                    $pic = 6;
                    mysqli_select_db($conn,"HAT");
                    // Lấy danh sách loại sp
                    $truyvan1 = "SELECT * FROM loai WHERE MATL = 'NKAF1'";
                    $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                    // Lặp qua danh sách loại sp
                    for ($i = 1; $i <= mysqli_num_rows($ketqua1); $i++) {
                        $dong1 = mysqli_fetch_array($ketqua1);

                        // Lấy danh sách sách thuộc loại sp hiện tại
                        $truyvan = "SELECT * FROM SANPHAM AS S, loai AS L WHERE S.MATL = L.MATL AND TENTL = '" . $dong1['TENTL'] . "'";
                        $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                        echo "<tr>";
                        // Lặp qua danh sách sp
                        for ($j = 1; $j <= 5; $j++) {
                        $dong = mysqli_fetch_array($ketqua);
                        $tensp = $dong['TENSP'];
                        $tensp_ngan = substr($tensp, 0, 30);
                        if (strlen($tensp) > 30) {
                            $tensp_ngan .= "...";
                        }
                        // Hiển thị thông tin sp
                        echo '<td><a href="sanpham.php?Masanpham='.$dong['MASP'].'"><img onmouseover="this.src=\'picture/'. $pic.'.1.webp\'" onmouseout="this.src=\'picture/'.$pic.'.webp\'" src="' . $dong['HINH'] . '">
                        <br> <br><span class="s1">&ensp; '.$tensp_ngan.' </span>
                        <br>     <span class="s2">&ensp;'.number_format($dong['GIA']).' đồng</span>
                        </a></td>';
                        $pic++;
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
    </article>
    <aside class="mid-products">
        <span>AIR JORDAN</span>
    </aside>
    <article>
    <table class ="new-products">
                    <?php
                    $pic = 11;
                    mysqli_select_db($conn,"HAT");
                    // Lấy danh sách loại sp
                    $truyvan1 = "SELECT * FROM loai WHERE MATL = 'NKAJ'";
                    $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                    // Lặp qua danh sách loại sp
                    for ($i = 1; $i <= mysqli_num_rows($ketqua1); $i++) {
                        $dong1 = mysqli_fetch_array($ketqua1);

                        // Lấy danh sách sách thuộc loại sp hiện tại
                        $truyvan = "SELECT * FROM SANPHAM AS S, loai AS L WHERE S.MATL = L.MATL AND TENTL = '" . $dong1['TENTL'] . "'";
                        $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                        echo "<tr>";
                        // Lặp qua danh sách sp
                        for ($j = 1; $j <= 5; $j++) {
                        $dong = mysqli_fetch_array($ketqua);
                        $tensp = $dong['TENSP'];
                        $tensp_ngan = substr($tensp, 0, 30);
                        if (strlen($tensp) > 30) {
                            $tensp_ngan .= "...";
                        }
                        // Hiển thị thông tin sp
                        echo '<td><a href="sanpham.php?Masanpham='.$dong['MASP'].'"><img onmouseover="this.src=\'picture/'. $pic.'.1.webp\'" onmouseout="this.src=\'picture/'.$pic.'.webp\'" src="' . $dong['HINH'] . '">
                        <br> <br><span class="s1">&ensp; '.$tensp_ngan.' </span>
                        <br>     <span class="s2">&ensp;'.number_format($dong['GIA']).' đồng</span>
                        </a></td>';
                        $pic++;
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
    </article>
<?php include 'dangkythongbao.php' ?>
    <?php include 'cuoitrang.php' ?>
</body>
</html>