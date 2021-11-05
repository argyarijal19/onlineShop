<?php 
session_start();
//koneksi ke data base
$conn = mysqli_connect("localhost","root","","onlineshop");
if (!isset($_SESSION["admin"])) {
    echo "<script>alert('Anda Harus Login !!')</script>";
    echo "<script>location= 'login.php'</script>";
    exit();

}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> admin cardiby.me </title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Pengelola Toko</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <?= date("l, "); date_default_timezone_set ("asia/jakarta");
    echo  ( date("H:i:s")); ?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img style="border-radius: 50%;height:150px;width:150px" src="../profile_admin/<?= $_SESSION["admin"]["foto_profil"]; ?>" class="user-image img-responsive"/>
                    <p style="font-family:cursive; color:white; padding:0;">
                        <?= $_SESSION["admin"]["nama_lengkap"]; ?>
                    </p>
				</li>
                <li><a href="index.php"><i class="fa fa-home fa-2x"></i> Home</a></li>
                <li><a href="index.php?halaman=kategori"><i class="fa fa-sitemap fa-2x"></i> Kategori</a></li>
                <li><a href="index.php?halaman=produk"><i class="fa fa-suitcase fa-2x"></i> Produk</a></li>
                <li><a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart fa-2x"></i> Pembelian</a></li>
                <li><a href="index.php?halaman=laporan"><i class="fa fa-file fa-2x"></i> Laporan</a></li>
                <li><a href="index.php?halaman=pelanggan"><i class="fa fa-users fa-2x"></i> Pelanggan</a></li>
                <li><a href="index.php?halaman=profil"><i class="fa fa-sign-user fa-2x"></i>Prfofil</a></li>
                <li><a href="index.php?halaman=logout"><i class="fa fa-sign-out fa-2x"></i> Logout</a></li>

            </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php 
                if (isset ($_GET["halaman"])) {
                    if ($_GET["halaman"]=="produk") {
                        include "produk.php";
                    }elseif ($_GET["halaman"]=="pembelian"){
                        include "pembelian.php";
                    }elseif ($_GET["halaman"]=="pelanggan") {
                        include "pelanggan.php";
                    }elseif ($_GET["halaman"]=="detail") {
                        include "detail.php";
                    }elseif ($_GET["halaman"]== "tambah_produk") {
                        include "tambah_produk.php";
                    }elseif ($_GET["halaman"]== "hapusproduk") {
                        include "hapusproduk.php";
                    }elseif ($_GET["halaman"]== "ubahproduk") {
                        include "ubahproduk.php";
                    }elseif ($_GET["halaman"]=="logout") {
                        include "logout.php";
                    }elseif ($_GET["halaman"]== "pembayaran") {
                        include "pembayaran.php";
                    }elseif ($_GET["halaman"]== "laporan") {
                        include "laporan_pembelian.php";
                    }elseif ($_GET["halaman"]== "kategori") {
                        include "kategori.php";
                    }elseif ($_GET["halaman"]== "profil") {
                        include "profil.php";
                    }
                }else {
                    include "home.php";
                }
                ?>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/js/sweetalert2.all.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
