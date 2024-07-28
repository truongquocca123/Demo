<?php
    include 'ketnoi.php' ;
    $conn=MoKetNoi();
    if($conn->connect_error)
    {
        echo "không kết nối được MySQL";
    }
   
    $sql="CREATE DATABASE IF NOT EXISTS  HAT";
    if(!mysqli_query($conn,$sql))
    {
            echo "không tạo được database ".mysqli_error($conn);
    }
    mysqli_select_db($conn,"HAT");

    $LOAI = "CREATE TABLE IF NOT EXISTS LOAI (
        MATL varchar(20) not null primary key,
        TENTL nvarchar(200) not null)";
    $results = mysqli_query($conn,$LOAI)or die (mysqli_error($conn));

    $NHOMSP = "CREATE TABLE IF NOT EXISTS NHOMSP(
        MANHOM varchar(20) not null primary key,
        TENNHOM nvarchar(200) not null,
        MOTA nvarchar(2000))";
    $results = mysqli_query($conn,$NHOMSP) or die(mysqli_error($conn));

    $SANPHAM = "CREATE TABLE IF NOT EXISTS SANPHAM (
        MASP varchar(20) primary key,
        TENSP nvarchar(200) not null,
        THUONGHIEU nvarchar(200) not null,
        MANHOM varchar(20) not null,
        HINH longblob,
        MATL varchar(20) not null,
        SIZEGIAY int,
        CHITIETSIZEGIAY NVARCHAR (200) NOT NULL,
        SOLUONG int default 12,
        GIA int,
        FOREIGN KEY (MATL) REFERENCES LOAI(MATL))";
    $results = mysqli_query($conn,$SANPHAM)or die (mysqli_error($conn));

    $SIZEGIAY = "CREATE TABLE IF NOT EXISTS SIZEGIAY (
        SIZEGIAY INT NOT NULL,
        MASP VARCHAR(20) NOT NULL,
        PRIMARY KEY (SIZEGIAY, MASP),
        FOREIGN KEY (MASP) REFERENCES SANPHAM(MASP))";
    $results = mysqli_query($conn, $SIZEGIAY) or die(mysqli_error($conn));

    $CHITIETDONHANG="CREATE TABLE IF NOT EXISTS CHITIETDONHANG(
            MADH int(10) NOT NULL,
            MAKH int(10) NOT NULL,
            MASP varchar(20) NOT NULL,
            DONGIA int,
            SOLUONG int,
            GIAMGIA float,
            SIZEGIAY int,
            PRIMARY KEY (MADH,MASP))";
    $results = mysqli_query($conn,$CHITIETDONHANG)or die (mysqli_error($conn));
    
    $NGUOIDUNG = "CREATE TABLE IF NOT EXISTS NGUOIDUNG (
        MAKH INT AUTO_INCREMENT PRIMARY KEY,
        TENDANGNHAP nvarchar(200) NOT NULL,
        MATKHAU varchar(200) NOT NULL,
        SODT int default 0,
        HOTEN nvarchar(200) NOT NULL,
        NGAYSINH nvarchar (200),
        DIACHI nvarchar(200) not null,
        PHANLOAI varchar(10) default 'user')";
    $results = mysqli_query($conn,$NGUOIDUNG)or die (mysqli_error($conn));
    
    $DONHANG = "CREATE TABLE IF NOT EXISTS DONHANG(
        MAKH int,
        TENDANGNHAP nvarchar(200) not null,
        MADH int(10) not null,
        DIACHI nvarchar(200),
        SODT int,
        HOTEN nvarchar(200),
        NGAYDAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        TONGTIEN int,
        THANHTOAN nvarchar(200),
        MADHDD int auto_increment primary key)";
    $results = mysqli_query($conn, $DONHANG) or die(mysqli_error($conn));

    $DataLOAI="INSERT INTO LOAI (MATL,TENTL)". 
            "VALUES ('NK','NIKE'),
            ('NKAF1','NIKE AIR FORCE 1'),
            ('NKAJ','AIR JORDAN')";
    $results = mysqli_query($conn,$DataLOAI) or die (mysqli_error($conn));
    
    $DataNGUOIDUNG="INSERT INTO NGUOIDUNG (MAKH,TENDANGNHAP,MATKHAU,SODT,HOTEN,NGAYSINH,DIACHI,PHANLOAI)". 
                "VALUES ('0','truongquoc220@gmail.com','123','0902475432','Trang Quốc Trường','19-11-2004','21 Tự lặp','admin'),
                        ('2','truongquoc221@gmail.com','123','0902475422','Trang Quốc Trường','19-11-2004','21 Tự lặp','user')";
    $results = mysqli_query($conn,$DataNGUOIDUNG) or die (mysqli_error($conn));

    $DataSANPHAM = "INSERT INTO SANPHAM (MASP, TENSP, THUONGHIEU, HINH, CHITIETSIZEGIAY, SOLUONG, GIA, MATL)"." VALUES 
    ('NK01', 'Nike P-6000 - Pure Platinum', 'NIKE', 'picture/1.webp', 'Từ size 36 tới 43', 12, 2050000,'NK'),
    ('NK02', 'Nike Vomero 5 - Mystic Navy / Worn Blue', 'NIKE', 'picture/2.webp', 'Từ size 36 tới 43', 10, 3290000,'NK'),
    ('NK03', 'Air Jordan 4 Craft - Oliver', 'NIKE', 'picture/3.webp', 'Từ size 36 tới 43', 20, 6180000,'NK'),
    ('NK04', 'Nike Air Max 1 - Pale Ivory', 'NIKE', 'picture/4.webp', 'Từ size 36 tới 43', 15, 3288000,'NK'),
    ('NK05', 'Nike Air Max 1 Premium - Corduroy Baltic Blue', 'NIKE', 'picture/5.webp', 'Từ size 36 tới 43', 21, 2282000,'NK'),
    ('NK06', 'Nike P-6000 - Pure Platinum', 'NIKE', 'picture/1.webp', 'Từ size 36 tới 43', 12, 2050000,'NK'),
    ('NK07', 'Nike Vomero 5 - Mystic Navy / Worn Blue', 'NIKE', 'picture/2.webp', 'Từ size 36 tới 43', 10, 3290000,'NK'),
    ('NK08', 'Air Jordan 4 Craft - Oliver', 'NIKE', 'picture/3.webp', 'Từ size 36 tới 43', 20, 6180000,'NK'),
    ('NK09', 'Nike Air Max 1 - Pale Ivory', 'NIKE', 'picture/4.webp', 'Từ size 36 tới 43', 15, 3288000,'NK'),
    ('NK10', 'Nike Air Max 1 Premium - Corduroy Baltic Blue', 'NIKE', 'picture/5.webp', 'Từ size 36 tới 43', 21, 2282000,'NK'),
    ('NK11', 'Air Jordan 4 Craft - Oliver', 'NIKE', 'picture/3.webp', 'Từ size 36 tới 43', 20, 6180000,'NK'),
    ('NK12', 'Nike Air Max 1 - Pale Ivory', 'NIKE', 'picture/4.webp', 'Từ size 36 tới 43', 15, 3288000,'NK'),
    ('NK13', 'Nike Air Max 1 Premium - Corduroy Baltic Blue', 'NIKE', 'picture/5.webp', 'Từ size 36 tới 43', 21, 2282000,'NK'),
    ('NK14', 'Nike Air Max 1 Premium - Corduroy Baltic Blue', 'NIKE', 'picture/5.webp', 'Từ size 36 tới 43', 21, 2282000,'NK'),
    ('NK15', 'Nike Air Max 1 Premium - Corduroy Baltic Blue', 'NIKE', 'picture/5.webp', 'Từ size 36 tới 43', 21, 2282000,'NK'),

    ('NKAF01', 'Nike Air Force 1 07 - White / White', 'NIKE', 'picture/6.webp', 'Từ size 36 tới 43', 18, 2500000,'NKAF1'),
    ('NKAF02', 'Nike Air Force 1 07 GS - White/White', 'NIKE', 'picture/7.webp', 'Từ size 36 tới 43', 14, 2500000,'NKAF1'),
    ('NKAF03', 'Nike Air Force 1 07 WMNS - White', 'NIKE', 'picture/8.webp', 'Từ size 36 tới 43', 20, 2500000,'NKAF1'),
    ('NKAF04', 'Nike Air Force 1 Low 07 SE - Flower', 'NIKE', 'picture/9.webp', 'Từ size 36 tới 43', 16, 2585000,'NKAF1'),
    ('NKAF05', 'Nike Air Force 1 07 Premium - White', 'NIKE', 'picture/10.webp', 'Từ size 36 tới 43', 22, 3230000,'NKAF1'),

    ('NKAJ11', 'Air Jordan 1 Elevate Low WMNS - Dark', 'NIKE AIR JORDAN', 'picture/11.webp', 'Từ size 36 tới 43', 15, 2298000,'NKAJ'),
    ('NKAJ12', 'Air Jordan 1 High 85 - College Navy', 'NIKE AIR JORDAN', 'picture/12.webp', 'Từ size 36 tới 43', 8, 7500000,'NKAJ'),
    ('NKAJ13', 'Air Jordan 1 High - Volt/University', 'NIKE AIR JORDAN', 'picture/13.webp', 'Từ size 36 tới 43', 12, 4000000,'NKAJ'),
    ('NKAJ14', 'Air Jordan 1 High G - Black', 'NIKE AIR JORDAN', 'picture/14.webp', 'Từ size 36 tới 43', 10, 5800000,'NKAJ'),
    ('NKAJ15', 'Air Jordan 1 High Retro OG - Dark', 'NIKE AIR JORDAN', 'picture/15.webp', 'Từ size 36 tới 43', 14, 4000000,'NKAJ')";

$results = mysqli_query($conn, $DataSANPHAM) or die(mysqli_error($conn));

$DataSIZEGIAY = "INSERT INTO SIZEGIAY (SIZEGIAY, MASP)"." VALUES 
    (36, 'NK01'), (37, 'NK01'), (38, 'NK01'), (39, 'NK01'), (40, 'NK01'), (41, 'NK01'), (42, 'NK01'), (43, 'NK01'), (44, 'NK01'),
    (36, 'NK02'), (37, 'NK02'), (38, 'NK02'), (39, 'NK02'), (40, 'NK02'), (41, 'NK02'), (42, 'NK02'), (43, 'NK02'), (44, 'NK02'),
    (36, 'NK03'), (37, 'NK03'), (38, 'NK03'), (39, 'NK03'), (40, 'NK03'), (41, 'NK03'), (42, 'NK03'), (43, 'NK03'), (44, 'NK03'),
    (36, 'NK04'), (37, 'NK04'), (38, 'NK04'), (39, 'NK04'), (40, 'NK04'), (41, 'NK04'), (42, 'NK04'), (43, 'NK04'), (44, 'NK04'),
    (36, 'NK05'), (37, 'NK05'), (38, 'NK05'), (39, 'NK05'), (40, 'NK05'), (41, 'NK05'), (42, 'NK05'), (43, 'NK05'), (44, 'NK05'),
    (36, 'NKAF01'), (37, 'NKAF01'), (38, 'NKAF01'), (39, 'NKAF01'), (40, 'NKAF01'), (41, 'NKAF01'), (42, 'NKAF01'), (43, 'NKAF01'), (44, 'NKAF01'),
    (36, 'NKAF02'), (37, 'NKAF02'), (38, 'NKAF02'), (39, 'NKAF02'), (40, 'NKAF02'), (41, 'NKAF02'), (42, 'NKAF02'), (43, 'NKAF02'), (44, 'NKAF02'),
    (36, 'NKAF03'), (37, 'NKAF03'), (38, 'NKAF03'), (39, 'NKAF03'), (40, 'NKAF03'), (41, 'NKAF03'), (42, 'NKAF03'), (43, 'NKAF03'), (44, 'NKAF03'),
    (36, 'NKAF04'), (37, 'NKAF04'), (38, 'NKAF04'), (39, 'NKAF04'), (40, 'NKAF04'), (41, 'NKAF04'), (42, 'NKAF04'), (43, 'NKAF04'), (44, 'NKAF04'),
    (36, 'NKAF05'), (37, 'NKAF05'), (38, 'NKAF05'), (39, 'NKAF05'), (40, 'NKAF05'), (41, 'NKAF05'), (42, 'NKAF05'), (43, 'NKAF05'), (44, 'NKAF05'),
    (36, 'NKAJ11'), (37, 'NKAJ11'), (38, 'NKAJ11'), (39, 'NKAJ11'), (40, 'NKAJ11'), (41, 'NKAJ11'), (42, 'NKAJ11'), (43, 'NKAJ11'), (44, 'NKAJ11'),
    (36, 'NKAJ12'), (37, 'NKAJ12'), (38, 'NKAJ12'), (39, 'NKAJ12'), (40, 'NKAJ12'), (41, 'NKAJ12'), (42, 'NKAJ12'), (43, 'NKAJ12'), (44, 'NKAJ12'),
    (36, 'NKAJ13'), (37, 'NKAJ13'), (38, 'NKAJ13'), (39, 'NKAJ13'), (40, 'NKAJ13'), (41, 'NKAJ13'), (42, 'NKAJ13'), (43, 'NKAJ13'), (44, 'NKAJ13'),
    (36, 'NKAJ14'), (37, 'NKAJ14'), (38, 'NKAJ14'), (39, 'NKAJ14'), (40, 'NKAJ14'), (41, 'NKAJ14'), (42, 'NKAJ14'), (43, 'NKAJ14'), (44, 'NKAJ14'),
    (36, 'NKAJ15'), (37, 'NKAJ15'), (38, 'NKAJ15'), (39, 'NKAJ15'), (40, 'NKAJ15'), (41, 'NKAJ15'), (42, 'NKAJ15'), (43, 'NKAJ15'), (44, 'NKAJ15')";

$results = mysqli_query($conn, $DataSIZEGIAY) or die(mysqli_error($conn));




    DongKetNoi($conn);
?>