<?php include 'dautrang.php' ?>
    <nav>
        <ul id="main-menu">
            <li><a href="trangchu.php">TRANG CHỦ</a></li>
            <?php include 'menuchinh.php'?>
        </ul>
    </nav>
<article class="argh">
    <?php 
        include 'ketnoi.php';
        $conn = MoKetNoi();
        mysqli_select_db($conn, "HAT");
    ?>
    <form action="" method="post" class="form">
		<table class="shopping-products">
            <?php
                error_reporting(0);
                ob_start();
                $n=sizeof($_SESSION['DSMaMua']);
                if($n==0)
                {
                    echo "<caption class='cap' align='center'> BẠN CHƯA CHỌN GIÀY ĐỂ MUA </caption>";
                }
                else
                {
                    echo"<caption align='center'> THÔNG TIN GIỎ HÀNG </caption>";
                    echo"<caption align='center' class='cap1'> có ".$n." sản phẩm trong giỏ hàng </caption>";
                    echo "<tr> <th> STT </th> <th align='center'> Hình </th> <th> Tên sản phẩm </th> <th> Size giày </th> <th> Giá tiền </th> <th align='center'>Số lượng </th> <th>Thay đổi</th> <th>Thành tiền </th> </tr>";
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
                
                    echo "<tr> <td align='center'>".($i+1)." </td> <td> <img src='".$dong['HINH']."'></td> 
                      <td class='tsp'>".$dong['TENSP']."</td>
                      <td> ".$dong['SIZEGIAY']."  </td>
                      <td>".number_format($dong['GIA'])."₫ </td>    
                      <td class='plusandminus'>
                        <input type='button' value='-' onclick='decreaseQuantity()'>
                        <input type='text' name='txtSL[".$i."]' id='quantity' value=".$_SESSION['DSSL'][$i]." readonly>
                        <input type='button' value='+' onclick='increaseQuantity()'>
                      </td> 
                      <td> <button name='btnXoa[".$i."]'> Xóa Sản phẩm </button> </td>
                      <td> ".number_format($Tien)."₫</td>
                      </tr>";        
                      if(isset($_POST['btnXoa'][$i]))
                      {
                          // Kiểm tra xem mã đơn hàng đã tồn tại trong cơ sở dữ liệu hay không
                          $truyvan_kiemtra = "SELECT COUNT(*) AS count FROM DONHANG WHERE MADH = '" . $madh . "'";
                          $ketqua_kiemtra = mysqli_query($conn, $truyvan_kiemtra);
                          $dong_kiemtra = mysqli_fetch_array($ketqua_kiemtra);
                          $so_luong_donhang = $dong_kiemtra['count'];
                            for($j=$i;$j<$n-1;$j++)
                            {
                              $_SESSION['DSMaMua'][$j]=$_SESSION['DSMaMua'][$j+1];
                              $_SESSION['DSSL'][$j]=$_SESSION['DSSL'][$j+1];
                            }
                            array_pop($_SESSION['DSMaMua']);
                            array_pop($_SESSION['DSSL']);
                            $truyvan_xoa = "DELETE FROM CHITIETDONHANG WHERE MASP = '" . $dong['MASP'] . "'";
                            $ketqua_xoa = mysqli_query($conn, $truyvan_xoa);
                            
                              // Thêm dữ liệu mới vào bảng CHITIETDONHANG
                            header('Location: giohang.php');
                    }
                    }
                    echo "<tr> <td colspan='8' id='td0'><span class='td1'> Tổng tiền: </span><span class='td2'>".number_format($TongTien)."₫ </span></td> </tr>";   
                    echo "<tr > <td colspan='5' class='btn'> <button  name='btnThanhToanMuaNgay'> Thanh toán </button> </td>
                               <td colspan='4' class='btn' > <input type='submit' name='btnCapNhatMuaNgay' value='Cập nhật giỏ hàng'> </td> </tr>";
                               if (isset($_POST['btnThanhToanMuaNgay']))
                               {             
                                if(isset($_SESSION['tendangnhap']) && isset($_SESSION['loainguoidung']))
                                  {
                                    if($_SESSION['loainguoidung']=='user')
                                    {
                                      $truyvan1="SELECT * FROM DONHANG AS DH, CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE CTDH.MADH = DH.MADH AND ND.TENDANGNHAP = DH.TENDANGNHAP ";
                                      $ketqua1=mysqli_query($conn,$truyvan1) or die(mysqli_error($conn));
                                      $query = mysqli_query($conn,"SELECT * FROM NGUOIDUNG " ) or die(mysqli_error($conn));

                                        $row = mysqli_fetch_array($ketqua1);
                                        $rowlg = mysqli_fetch_array($query);
                                        $tendangnhap = $_SESSION['tendangnhap'];
                                        $diachi = $rowlg['DIACHI'];
                                        $sodt = $rowlg['SODT'];
                                        $hoten = $_SESSION['hoten'];
                                        $makh = $_SESSION['makhachhang'];
                                        $donhang = "INSERT INTO DONHANG (MAKH,TENDANGNHAP, MADH, DIACHI, SODT, HOTEN, TONGTIEN, THANHTOAN)
                                        VALUES ('$makh','$tendangnhap','$madh','$diachi','$sodt','$hoten','$TongTien','CASH')";
                                        $ketqua_insert = mysqli_query($conn, $donhang) or die(mysqli_error($conn));
                                    }
                                      header('Location:chitietgiohang.php');
                                  }
                                else{
                                  header('Location: chitietgiohang_notlg.php');
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