<?php 
session_start();
//koneksi database
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cardiby.me</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="css.user/index.css">
</head>
<body style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
background-attachment: fixed;
  background-repeat: no-repeat;">
    <!--navbar-->
    <nav class="navbar navbar-light" style="background-color:lightblue;">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="index.php">
                    <img src="admin/img/Untitled-1.png" width="150" height="aouto" alt="">
                    </a>
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <?php if (isset($_SESSION["pelanggan"])):?>
                    <li><a href="logout.php">logout</a></li>
                    <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register_pelanggan.php">Register</a></li>
                <?php endif; ?>
               
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
            <form action="pencarian.php" method="get" class="navbar-form navbar-right">
                    <input type="text" class="form-control" name="keyword" placeholder="Search produk">
                    <button class="btn btn-primary">Search</button>
            </form>
        </div>
    </nav>
    <!--slider-->
    <div id="slider">
        <figure>
            <div class="gambar1">
                <img src="css.user/img/1.png" alt>
            </div>
            <div class="gambar2">
                <img src="css.user/img/4.png" alt>
            </div>
            <div class="gambar3">
                <img src="css.user/img/5.png" alt>
            </div>
            
        </figure>
    </div>
    <!--konten atau isi-->
    <section style="border: 2px darkcyan;" class="konten">
        <div class="container">
                <h1>New Produk</h1>
            <div class="row">
            <?php $ambil = $conn-> query("SELECT * FROM produk"); ?>
            <?php while($grosir= $ambil->fetch_assoc()){ ?>
                <div class="col-md-3">
                    <div style="box-shadow:2px 2px 12px darkcyan" class="thumbnail">
                        <img style="width: 200px; height:200px;" src="foto_produk/<?= $grosir["foto_produk"]; ?>" alt="">
                    </div>
                    <?php if($grosir["stok_produk"]<=0){
                        $grosir["stok_produk"] = 'stok Habis';
                    } ?>
                    <div class="caption">
                        <h3 style="font-size: 20px;" ><?= $grosir["nama_produk"]; ?></h3>
                        <h5 style="font-size: 15px;" >Rp. <?= number_format($grosir["harga_produk"]); ?></h5>
                        <h6 style="font-size: 15px;" >Tersedia : <?= $grosir["stok_produk"]; ?></h6>
                        <a href="beli.php?id=<?= $grosir['id_produk'];?>" class="btn btn-primary"><i class="fa fa-cart" aria-hidden="true"></i>add to cart</a>
                        <a href="detail_produk.php?id=<?= $grosir["id_produk"]; ?>" class="btn btn-default">Detail</a>
                    </div>
                    <br>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>