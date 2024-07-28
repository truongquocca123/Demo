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
    <form action="themnguoidung.php" method="post">
		<table id="tableQLND" align="center">
        <?php
            ob_start();
            error_reporting(0);
            if($_SESSION['kt']!=0)
            {
                echo "<p class='tableQLND'> Đã thêm thành công thông tin người dùng </p>";
            }
            $_SESSION['kt']=0;
            echo"<caption> THÊM NGƯỜI DÙNG </caption>";
            echo "<tr> <th> Tên đăng nhập </th> <th> Mật khẩu </th> <th>Họ tên người dùng </th> 
                       <th>Địa chỉ </th> <th>Số điện thoại </th> <th>Phân loại</th> </tr>";
            for($i=0;$i<1;$i++)
            {
                $truyvan="SELECT * FROM NGUOIDUNG";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td><input type='text' name= 'txtTDN[".$i."]' ></td>
                      <td> <input type='text' name= 'txtMK[".$i."]'  > </td> 
                      <td> <input type='text' name= 'txtHT[".$i."]'  > </td> 
                      <td> <input type='text' name= 'txtDC[".$i."]'  > </td> 
                      <td> <input type='text' name= 'txtSDT[".$i."]'  > </td>
                      <td> <select name='cboLoai[".$i."]'> <option value='user'> user </option>
                                                    <option value='admin'> admin </option>
                           </select> </td>
                      </tr>" ;
            }
            echo "<tr > <td colspan='4' id='buttonSND'> <input class='classbuttonSND' type= 'submit' name= 'sbtThem' value= 'Thêm' >  </td>
            <td colspan='3' id='buttonSND'> <button class='classbuttonSND' name='btnThoat'> Quay lại Quản lý người dùng </button> </td> </tr>";
            
            if(isset($_POST['sbtThem']))
            {
                for($i=0;$i< mysqli_fetch_array($ketqua);$i++)
                {
                    $truyvan="INSERT INTO NGUOIDUNG (TENDANGNHAP, MATKHAU, HOTEN, DIACHI, SODT, PHANLOAI)
                    VALUES ('".$_POST['txtTDN'][$i]."', '".$_POST['txtMK'][$i]."', '".$_POST['txtHT'][$i]."', 
                            '".$_POST['txtDC'][$i]."', '".$_POST['txtSDT'][$i]."', '".$_POST['cboLoai'][$i]."')";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                }
                $kq= mysqli_affected_rows($conn);
                if($kq!=0)
                {
                    $_SESSION['kt']=1;
                }
                header('Location: themnguoidung.php');
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
