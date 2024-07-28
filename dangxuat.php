<?php
    session_start();
    if(isset ($_SESSION['tendangnhap']))
    {
        unset($_SESSION['tendangnhap']);
        unset($_SESSION['taikhoan']);
        unset($_SESSION['loainguoidung']);
        unset($_SESSION['slmua']);
    }
    header('Location: trangchu.php');?>