<?php include 'dautrang.php';?>
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
    <form action="quanlynguoidung.php" method="post">
		<table id="tableQLND" align="center">
        <?php
        ob_start();
            //error_reporting(0);
            echo"<caption> THÔNG TIN NGƯỜI DÙNG </caption>";
            echo "<tr> <th> STT </th> <th> Tên đăng nhập </th> <th> Mật khẩu </th> <th>Họ tên người dùng </th> 
                       <th>Địa chỉ </th> <th>Số điện thoại </th> <th>Phân loại</th>
                       <th align='center'>Chọn xóa/sửa</th> </tr>";
            $truyvan="SELECT * FROM NGUOIDUNG";
            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
            $tongdong = mysqli_num_rows($ketqua);
            $ten=array();
            for($i=0;$i<$tongdong;$i++)
            {
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td align='center'>".($i+1)." </td> <td >".$dong['TENDANGNHAP']."</td> 
                      <td>".$dong['MATKHAU']."</td> <td>".$dong['HOTEN']."</td> <td>".$dong['DIACHI']."</td> 
                      <td>".$dong['SODT']."</td> <td>".$dong['PHANLOAI']."</td> 
                      <td > <input type= 'checkbox' name= 'chkChon[".$i."]'> </td> </tr>" ;
                if(isset($_POST['chkChon'][$i]))
                {
                    array_push($ten,$dong['TENDANGNHAP']);
                }
            }
                echo "<tr> <td colspan='3' id='buttonQLND'> <button class='themxoasua' name='btnThem'> Thêm người dùng </button> </td>
                        <td colspan='3' id='buttonQLND'> <button class='themxoasua' name='btnXoa'> Xóa người dùng</button> </td>
                        <td colspan='3' id='buttonQLND'> <button class='themxoasua' name='btnSua'> Sửa thông tin </button> </td>
                 </tr>";  
                 if(isset($_POST['btnThem']))
                 {
                 header('Location: themnguoidung.php');
                 }
             if(isset($_POST['btnXoa']))    
             {
                 $sodongxoa=sizeof($ten);
                 if($sodongxoa!=0)
                 {
                     for($i=0;$i<$sodongxoa;$i++)
                     {
                         $truyvanxoa="DELETE FROM NGUOIDUNG WHERE TENDANGNHAP='".$ten[$i]."' ";
                         $ketquaxoa = mysqli_query($conn,$truyvanxoa) or die (mysqli_error($conn));
                         header('Location: quanlynguoidung.php');
                     }
                 }
                 if(!isset($_POST['chkChon']))
                 {
                     echo "<p class='c6'>Bạn chưa chọn người dùng để xóa </p>";
                 }
             }
             if(isset($_POST['btnSua']))
             {
                 if(!isset($_POST['chkChon']))
                 {
                     echo "<p class='c6'>Bạn chưa chọn người dùng để sửa </p>";
                 }
                 else
                 {
                     $_SESSION['tensua']=array();
                     $_SESSION['tensua']=$ten;
                     header('Location: suanguoidung.php');
                 }
             }   
         ?>
		</table>
		</form> 
	</article>
    <?php include 'dangkythongbao.php' ?>
    <?php   include 'cuoitrang.php' ?>  
 </body>
</html>