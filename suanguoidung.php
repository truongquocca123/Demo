<?php include 'dautrang.php'; ?>
<nav>
    <ul id="main-menu">
        <li><a href="trangchu.php">TRANG CHỦ</a></li>
        <?php include 'menuchinh.php'; ?>
    </ul>
</nav>
<header class="second"><span><a href="trangchu.php">&emsp;Trang Chủ</a>&ensp;/&ensp;<a href="danhmuc.php">Danh mục quản lý&ensp;/</a>&ensp;Quản lý thông tin người dùng</span></header>
<article id="QLND">
    <?php 
        include 'ketnoi.php';
        $conn = MoKetNoi();
        mysqli_select_db($conn, "HAT");
    ?>
    <form action="suanguoidung.php" method="post">
		<table id="tableQLND" align="center">
        <?php
        ob_start();
            error_reporting(0);
            if($_SESSION['kt']!=0)
            {
                echo "<p class='tableQLND'> Đã sửa thành công thông tin người dùng </p>";
            }
            $_SESSION['kt']=0;
            echo"<caption> SỬA THÔNG TIN </caption>";
            echo "<tr> <th> STT </th> <th> Tên đăng nhập </th> <th> Mật khẩu </th> <th>Họ tên người dùng </th> 
                       <th>Địa chỉ </th> <th>Số điện thoại </th> <th>Phân loại</th> </tr>";
            $n=sizeof($_SESSION['tensua']);
            for($i=0;$i<$n;$i++)
            {
                $truyvan="SELECT * FROM NGUOIDUNG WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td align='center'>".($i+1)." </td> <td > ".$dong['TENDANGNHAP']."  </td> 
                      <td> <input type='text' name= 'txtMK[".$i."]' value=".$dong['MATKHAU']." > </td> 
                      <td> <input type='text' name= 'txtHT[".$i."]' value=".$dong['HOTEN']." > </td> 
                      <td> <input type='text' name= 'txtDC[".$i."]' value=".$dong['DIACHI']." > </td> 
                      <td> ".$dong['SODT']." </td>
                      <td> <select name='cboLoai[".$i."]'> <option value='user'> user </option>
                                                    <option value='admin'> admin </option>
                           </select> </td>
                      </tr>" ;
            }
            echo "<tr > <td colspan='4' id='buttonSND'> <input class='classbuttonSND' type= 'submit' name= 'sbtDongY' value= 'Đồng ý' >  </td>
            <td colspan='3' id='buttonSND'> <button class='classbuttonSND' name='btnThoat'> Quay lại Quản lý người dùng </button> </td> </tr>";
            
            if(isset($_POST['sbtDongY']))
            {
                for($i=0;$i<$n;$i++)
                {
                    $truyvan="UPDATE NGUOIDUNG 
                              SET MATKHAU='".$_POST['txtMK'][$i]."', HOTEN='".$_POST['txtHT'][$i]."', 
                                  DIACHI='".$_POST['txtDC'][$i]."', PHANLOAI ='".$_POST['cboLoai'][$i]."'
                              WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                }
                $kq= mysqli_affected_rows($conn);
                if($kq!=0)
                {
                    $_SESSION['kt']=1;
                }
                header('Location: suanguoidung.php');
            }
            if(isset($_POST['btnThoat']))
            {
                header('Location: quanlynguoidung.php');
            }
        ?>
		</table>
		</form> 
        <?php include 'dangkythongbao.php' ?>
    <?php   include 'cuoitrang.php' ?>  
	</article>