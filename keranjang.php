<?php 
session_start();

include 'conn.php';
if (!isset($_SESSION["keranjang"]) OR (empty($_SESSION["keranjang"]))) {
    echo "<script> alert ('belanja dulu ya gan  ') </script>";
    echo "<script> location= 'index.php' </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <title>cart</title>
</head>
<body  style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
background-attachment: fixed;
  background-repeat: no-repeat;">
<nav class="navbar navbar-light" style="background-color:lightblue;">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><img style="width: 150px;height:auto;margin-top:10px;margin-left:-50px;" src="admin/img/Untitled-1.png" alt=""></li>
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
        <section class="konten">
            <div class="container">
                <h1>Keranjang Belanja</h1>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subharga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk=> $jumlah) : ?>
                    <?php 
                        $ambil= $conn-> query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $grosir = $ambil->fetch_assoc(); 
                        $subharga= $grosir["harga_produk"]*$jumlah; 
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $grosir["nama_produk"]; ?></td>
                            <td>Rp. <?= $grosir["harga_produk"]; ?></td>
                            <td><?= $jumlah; ?></td>
                            <td>Rp. <?= number_format($subharga); ?></td>
                            <td><a href="hapuskeranjang.php?id=<?= $id_produk ?>" class="btn btn-danger btn-xs">Hapus Belanjaan</a></td>
                            
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-primary">Lanjutkan belanja</a>
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        </section>
</body>
</html>