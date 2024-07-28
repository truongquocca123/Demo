<?php include 'dautrang.php' ?>
    <nav>
        <ul id="main-menu">
            <li><a href="trangchu.php">TRANG CHỦ</a></li>
            <?php include 'menuchinh.php'?>
        </ul>
    </nav>
<article>
    <?php 
        include 'ketnoi.php';
        $conn = MoKetNoi();
        mysqli_select_db($conn, "HAT");
    ?>
    <form action="chitietgiohang.php" method="post">
		<table class="sub-shopping-products">
            <?php
                $n=sizeof($_SESSION['DSMaMua']);
                    echo"<caption></caption>";
                    echo"<caption></caption>";
                    echo"<caption align='center'>CẢM ƠN BẠN ĐÃ MUA HÀNG CỬA HÀNG CHÚNG TÔI</caption>";
                    echo"<caption><span></span></caption>";
                    echo"<caption align='center'> THÔNG TIN GIỎ HÀNG </caption>";
                    echo"<caption align='center' class='cap1'> có ".$n." sản phẩm trong giỏ hàng </caption>";
                    echo "<tr> <th> STT </th> <th align='center'> Hình </th> <th> Tên sản phẩm </th> <th> Size giày </th> <th> Giá tiền </th> <th align='center'>Số lượng </th><th>Thành tiền </th> </tr>";
                    $TongTien=0;
                    for($i=0;$i<$n;$i++)
                    {
                    $truyvan="SELECT * FROM SANPHAM AS S, CHITIETDONHANG AS CTDH WHERE S.MASP = CTDH.MASP AND S.MASP='".$_SESSION['DSMaMua'][$i]."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    if(isset($_POST['txtSL'][$i]))
                    {
                        $_SESSION['DSSL'][$i]=$_POST['txtSL'][$i];
                    }    
                    $Tien=$_SESSION['DSSL'][$i] * $dong['GIA'];
                    $TongTien+=$Tien;                             
                
                    echo "<tr> <td align='center'>".($i+1)." </td> <td> <img src='".$dong['HINH']."'></td> 
                      <td class='tsp'>".$dong['TENSP']."</td>
                      <td class='tsp'>".$dong['SIZEGIAY']."</td>    
                      <td>".number_format($dong['GIA'])." đồng </td>    
                      <td class='plusandminus'>
                        ".$_SESSION['DSSL'][$i]."
                      </td> 
                      <td> ".number_format($Tien)." đồng </td>
                      </tr>";        
                    if(isset($_POST['btnXoa'][$i]))
                    {
                          for($j=$i;$j<$n-1;$j++)
                          {
                            $_SESSION['DSMaMua'][$j]=$_SESSION['DSMaMua'][$j+1];
                            $_SESSION['DSSL'][$j]=$_SESSION['DSSL'][$j+1];
                          }
                          array_pop($_SESSION['DSMaMua']);
                          array_pop($_SESSION['DSSL']);
                          header('Location: giohang.php');
                    }
                    }
                    echo "<tr> <td colspan='6'> Tổng tiền </td> <td>".number_format($TongTien)." đồng </td> </tr>";  
                ?>
		</table>
		</form> 
</article>
<?php include 'dangkythongbao.php' ?>
    <?php include 'cuoitrang.php' ?>
</body>
</html>