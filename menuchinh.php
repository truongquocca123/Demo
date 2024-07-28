<?php
    if (isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'])
    {
        echo " <li> <a href ='dangxuat.php'>ĐĂNG XUẤT</a> </li>";
        if (isset ($_SESSION ['loainguoidung']) && $_SESSION['loainguoidung']=='admin')
        {
            echo " <li> <a href='#'>DANH MỤC HÀNG HÓA </a> <li>
            <li><a href='#'>DANH MỤC QUẢN LÝ</a>
                <ul class='manager'>
                    <li> <a href='#'>QUẢN LÝ WEBSITE</a> </li>
                    <li> <a href='quanlynguoidung.php'>QUẢN LÝ NGƯỜI DÙNG</a> </li>
                    <li> <a href='themsanpham.php'>QUẢN LÝ SẢN PHẨM</a> </li>
                    <li> <a href='#'>QUẢN LÝ ĐƠN HÀNG</a> </li>
                </ul>
            </li>
            <li><a href='#'>CÁC SẢN PHẨM KHÁC</a>
                <ul class='sub-menu'>
                    <li><a href='#'>Adidas Stan Smith</a></li>
                    <li><a href='#'>Adidas UltraBOOST</a></li>
                    <li><a href='#'>Adidas NMD</a></li>
                    <li><a href='#'>New Balance 530</a></li>
                    <li><a href='#'>New Balance 550</a></li>
                    <li><a href='#'>Reebok Club C</a></li>
                    <li><a href='#'>Reebok Court Advance</a></li>
                    <li><a href='#'>YEEZY</a></li>
                </ul>
            </li>
            <li><a href='#'>TIN TỨC</a></li>
            <li><a href='#'>TUYỂN DỤNG</a></li>";
        }
        if (isset ($_SESSION ['loainguoidung']) && $_SESSION['loainguoidung']=='user')
        {
            echo"
            <li><a href='danhmuc.php?loai=NK'>NIKE</a></li>
            <li><a href='#'>NEW BALANCE</a></li>
            <li><a href='danhmuc.php?loai=NKAJ'>AIR JORDAN</a></li>
            <li><a href='danhmuc.php?loai=NK'>ADIDAS</a></li>
            <li><a href='#'>REEBOK</a></li>
            <li><a href='#'>CÁC SẢN PHẨM KHÁC</a>
                <ul class='sub-menu'>
                    <li><a href='#'>Adidas Stan Smith</a></li>
                    <li><a href='#'>Adidas UltraBOOST</a></li>
                    <li><a href='#'>Adidas NMD</a></li>
                    <li><a href='#'>New Balance 530</a></li>
                    <li><a href='#'>New Balance 550</a></li>
                    <li><a href='#'>Reebok Club C</a></li>
                    <li><a href='#'>Reebok Court Advance</a></li>
                    <li><a href='#'>YEEZY</a></li>
                </ul>
            </li>
            <li><a href='#'>TIN TỨC</a></li>
            <li><a href='#'>TUYỂN DỤNG</a></li>  
            <li> <a> XEM GIỎ HÀNG </a></li>";
        }
        echo "<li id='islogin'> Xin chào bạn ".$_SESSION['hoten']."</li>";
    }
    else{
            echo"
            <li><a href='danhmuc.php?loai=NK'>NIKE</a></li>
            <li><a href='#'>NEW BALANCE</a></li>
            <li><a href='danhmuc.php?loai=NKAJ'>AIR JORDAN</a></li>
            <li><a href='danhmuc.php?loai=NK'>ADIDAS</a></li>
            <li><a href='#'>REEBOK</a></li>
            <li><a href='#'>CÁC SẢN PHẨM KHÁC</a>
                <ul class='sub-menu'>
                    <li><a href='#'>Adidas Stan Smith</a></li>
                    <li><a href='#'>Adidas UltraBOOST</a></li>
                    <li><a href='#'>Adidas NMD</a></li>
                    <li><a href='#'>New Balance 530</a></li>
                    <li><a href='#'>New Balance 550</a></li>
                    <li><a href='#'>Reebok Club C</a></li>
                    <li><a href='#'>Reebok Court Advance</a></li>
                    <li><a href='#'>YEEZY</a></li>
                </ul>
            </li>
            <li><a href='#'>TIN TỨC</a></li>
            <li><a href='#'>TUYỂN DỤNG</a></li>";
    }
    ?>