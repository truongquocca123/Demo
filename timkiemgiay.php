<?php include 'dautrang.php'; ?>
<nav>
    <ul id="main-menu">
        <li><a href="trangchu.php">TRANG CHỦ</a></li>
        <?php include 'menuchinh.php'; ?>
    </ul>
</nav>
<header class="second"><span><a href="trangchu.php">&emsp;Trang Chủ</a>&ensp;/&ensp;<a href="danhmuc.php">Tìm kiếm</a>&ensp;/&ensp;</span></header>
<article>
    <?php 
        include 'ketnoi.php';
        $conn = MoKetNoi();
        mysqli_select_db($conn, "HAT");
        
        if(isset($_POST['btnTimKiem'])) {
            $tukhoa = $_POST['txtTuKhoa'];
            // Lấy danh sách giày dựa trên từ khóa tìm kiếm
            $truyvan = "SELECT * FROM SANPHAM WHERE TENSP LIKE '%$tukhoa%'";
            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
            
            // Hiển thị kết quả tìm kiếm bằng table
            echo "<table id='ket-qua-tim-kiem'>";
            echo "<caption>Kết quả tìm kiếm cho từ khóa: $tukhoa</caption>";
            
            $soCot = 4;
            $soDong = ceil(mysqli_num_rows($ketqua) / $soCot);
            
            for ($i = 0; $i < $soDong; $i++) {
                echo "<tr>";
                
                for ($j = 0; $j < $soCot; $j++) {
                    if ($row = mysqli_fetch_array($ketqua)) {
                        $tensp = $row['TENSP'];
                        $tensp_ngan = substr($tensp, 0, 24);
                        if (strlen($tensp) > 24) {
                            $tensp_ngan .= "...";
                        }
                        echo "
                        <td>
                        <a href='sanpham.php?Masanpham=".$row['MASP']."'><img src='" . $row['HINH'] . "' alt='Ảnh giày'>
                            <span class='s1'>Tên giày: " . $tensp_ngan . "</span>
                            <span class='s2'>Giá bán: " . number_format($row['GIA']) . " đồng</span>
                        </a></td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
    ?>
    <br>
    </article>

<?php include 'dangkythongbao.php'; ?>
<?php include 'cuoitrang.php'; ?>
</body>
</html>
