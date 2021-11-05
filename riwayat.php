<?php 
session_start();
//koneksi database
include 'conn.php';
//jika ga ada yang login jangan kasih masuk
if (!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"])) {
    echo "<script>alert ('anda harus login')</script>";
    echo "<script>location= 'login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Belanja</title>
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
    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <?= $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Rincian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Status</th>
                        <th>Total Belanja</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <?php 
                $i=1;
                //mendapatkan id pelanggan dari session
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $ambil = $conn-> query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
                while ($pecah = $ambil-> fetch_assoc()){
                ?>
                <tbody>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $pecah["tanggal_pembelian"]; ?></td>
                        <td><?= $pecah["tanggal_pembelian"]; ?></td>
                        <td>
                            <?= $pecah["status_pembelian"]; ?>
                            <br>
                            <?php if (!empty($pecah["resi_pengiriman"])): ?>
                                Resi Pengiriman : <?= $pecah["resi_pengiriman"]; ?>
                            <?php endif ?>
                        </td>
                        <td>Rp. <?= number_format($pecah["total_pembelian"]); ?></td>
                        <td>
                            <a class="btn btn-primary" href="nota.php?id=<?= $pecah["id_pelanggan"]; ?>">Nota</a>
                            <?php if ($pecah["status_pembelian"] == 'pending'): ?>
                                <a class="btn btn-danger" href="pembayaran.php?id=<?= $pecah["id_pembelian"]; ?>">Pembayaran
                                </a>
                            <?php else: ?>
                                <a class="btn btn-success" href="detail_pembayaran.php?id=<?= $pecah["id_pembelian"]; ?>">Detail Pembayaran
                                </a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php $i++; ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>