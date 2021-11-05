<?php 
include 'conn.php';

$keyword = $_GET["keyword"];
$hasil = array();
$ambil = $conn-> query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");

while ($pecah = $ambil->fetch_assoc()) {
    $hasil[]=$pecah;
}
// echo "<pre>";
// echo print_r($hasil);
// echo "<pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="css.user/index.css">
    
</head>
<body>
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
                    <input type="text" class="form-control" name="keyword">
                    <button class="btn btn-primary">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <h3 style="font-size: 40px;">Hasil Pencarian : <strong> <?= $keyword; ?></strong> </h3>
        <?php if (empty($hasil)) :?>
            <div class="alert alert-danger">Produk <strong><?= $keyword; ?> </strong> Tidak Ditemukan</div>
        <?php endif ?>
        <br>
        <div class="row">

        <?php foreach ($hasil as $key => $value): ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img style="width: 200px; height:200px;" src="foto_produk/<?= $value["foto_produk"]; ?>" class="img-responsive">
                    <div class="caption">
                        <h3><?= $value["nama_produk"];  ?></h3>
                        <h5>Rp. <?= number_format($value["harga_produk"]) ?></h5>
                        <a href="beli.php?id=<?= $value["id_produk"]; ?>" class="btn btn-primary">Add to chart</a>
                        <a href="detail_produk.php?id=<?= $value["id_produk"]; ?>" class="btn btn-default">detailt</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>          
        </div>
    </div>
</body>
</html>