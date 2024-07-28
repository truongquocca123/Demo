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
    <form action="themsanpham.php" method="post">
		<table id="tableQLND" align="center">
        <?php
            ob_start();
            error_reporting();
            if($_SESSION['kt']!=0)
            {
                echo "<p class='tableQLND'> Đã thêm thành công sản phẩm! </p>";
            }
            $_SESSION['kt']=0;
            echo"<caption> THÊM SẢN PHẨM </caption>";
            echo "<tr> <th> Mã SP </th> <th> TÊN SẢN PHẨM </th> <th>THƯƠNG HIỆU </th> 
                       <th>HÌNH </th> <th>MÃ TL </th> <th>SỐ LƯỢNG</th> <th>GIÁ</th> </tr>";
            for($i=0;$i<1;$i++)
            {
                $truyvan="SELECT * FROM SANPHAM";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td><input type='text' name= 'txtMASP[".$i."]' ></td>
                      <td> <input type='text' name= 'txtTENSP[".$i."]'  > </td> 
                      <td> <select name='cboTHUONGHIEU[".$i."]'> <option value='NIKE'> NIKE </option>
                                                    <option value='NIKE AIR FORCE 1'> NIKE AIR FORCE 1 </option>
                                                    <option value='AIR JORDAN'> AIR JORDAN </option>
                           </select> </td>
                      <td> <input type='text' name= 'txtHINH[".$i."]'  > </td> 
                      <td> <input type='text' name= 'txtMATL[".$i."]'  > </td>
                      <td> <input type='text' name= 'txtSOLUONG[".$i."]'  > </td>
                      <td> <input type='text' name= 'txtGIA[".$i."]'  > </td>
                      </tr>" ;
            }
            echo "<tr > <td colspan='4' id='buttonSND'> <input class='classbuttonSND' type= 'submit' name= 'sbtThem' value= 'Thêm' >  </td>
            <td colspan='3' id='buttonSND'> <button class='classbuttonSND' name='btnThoat'> Quay lại Quản lý người dùng </button> </td> </tr>";
            
            if(isset($_POST['sbtThem']))
            {
                for($i=0;$i < $dong;$i++)
                {
                    $truyvan="INSERT INTO SANPHAM (MASP, TENSP, THUONGHIEU, HINH, MATL, CHITIETSIZEGIAY, SOLUONG, GIA)
                    VALUES ('".$_POST['txtMASP'][$i]."', '".$_POST['txtTENSP'][$i]."', '".$_POST['cboTHUONGHIEU'][$i]."', 
                            '".$_POST['txtHINH'][$i]."', '".$_POST['txtMATL'][$i]."', 'Từ size 36 tới 43', '".$_POST['txtSOLUONG'][$i]."',
                            '".$_POST['txtGIA'][$i]."')";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                }
                $kq= mysqli_affected_rows($conn);
                if($kq!=0)
                {
                    $_SESSION['kt']=1;
                }
                header('Location: themsanpham.php');
            }
            if(isset($_POST['btnThoat']))
            {
                header('Location: quanlysanpham.php');
            }
        ?>
		</table>
		</form> 
        <?php include 'dangkythongbao.php' ?>
    <?php   include 'cuoitrang.php' ?>  
	</article>
