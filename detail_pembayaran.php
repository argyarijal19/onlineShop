<?php 
session_start();
include 'conn.php';
$id_pembelian = $_GET["id"];

$ambil = $conn-> query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$pembeli = $ambil->fetch_assoc();

//jika belum ada data embayaran
if (empty($pembeli)) {
    echo "<script>alert ('belum Ada Data pembayaran')</script>";
    echo "<script>location= 'riwayat.php'</script>";
    exit();
}
//jika pelangan yang beli tidak login
if ($_SESSION["pelanggan"]["id_pelanggan"] !== $pembeli["id_pelanggan"]) {
    echo "<script>alert ('Data pembayaran bukan milik anda')</script>";
    echo "<script>location= 'riwayat.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
background-attachment: fixed;
  background-repeat: no-repeat;">
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
        </div>
    </nav>
    <div class="container">
    <h2>Detail Pembayaran</h2>
    <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama Pembayar</th>
                        <td><?= $pembeli["nama"]; ?></td>
                    </tr>
                    <tr>
                        <th>Bank </th>
                        <td><?= $pembeli["bank"]; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pembayaran</th>
                        <td><?= $pembeli["tanggal"]; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Pembayaran</th>
                        <td>Rp. <?= number_format($pembeli["jumlah"]); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="bukti_pembayaran/<?= $pembeli["bukti"]; ?>" alt="">
            </div>
        </div>
    </div>
</body>
</html>