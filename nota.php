<?php 
include 'conn.php';
session_start();
$ambil = $conn-> query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pelanggan='$_GET[id]'");
$detail = $ambil-> fetch_assoc();


// dilarang melihat nota orang lai 
// pelangan yang melihat nota hanya pelanggan yang login 

//dapatkan id pelanggan yang beli 
$pelangganyangbeli = $detail["id_pelanggan"];
//dapatkan id pelanggan yang login
$pelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
if ($pelangganyangbeli !== $pelangganyanglogin) {
   echo "<script>alert ('anda tidak berhak melihat nota orang lain')</script>";
   echo "<script>location= 'riwayat.php'</script>";
   exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
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
                <?php endif; ?>
               
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </nav>
    <section class="konten">
         <div class="container">
            <table class="table table-bordered">
                <h2>Detail Pembelian</h2>
                <p>
                Tanggal : <?= $detail["tanggal_pembelian"]; ?>
                Total : Rp. <?= number_format($detail["total_pembelian"]); ?>
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <strong>No. Pembelian: <?= $detail["id_pembelian"];?></strong>
                    </div>
                    <div class="col-md-4">
                        <h3>Pelanggan</h3>
                        <strong><?= $detail["nama_pelanggan"]; ?></strong> <br>
                        <p>
                            <?= $detail["telepon_pelanggan"]; ?>
                            <?= $detail["email_pelanggan"]; ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <strong><?= $detail["nama_kota"]; ?></strong> <br>
                        Ongkos Kirim : Rp. <?= number_format($detail["tarif"]); ?><br>
                        <?= $detail["alamat_rumah"]; ?> <br><br>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Sub Berat</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    <?php $ambil= $conn->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");?>
                    <?php while($pecah = $ambil->fetch_assoc()){?>
                    <?php
                    $harga = $pecah["harga"];
                    $rupiah = number_format($harga,0);
                    ?>
                        <tr>
                            <td><?= $i;?></td>
                            <td><?= $pecah["nama"];?></td>
                            <td>Rp. <?= $rupiah?></td>
                            <td><?= $pecah["berat"];?> (gr)</td>
                            <td><?= $pecah["jumlah"];?></td>
                            <td><?= $pecah["sub_berat"];?> (gr)</td>
                            <td>Rp. <?= number_format($pecah["sub_harga"]);?></td>
                        </tr>
                        <?php $i++ ?>
                    <?php } ?>
                    </tbody>
                </table>
            </table>
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-danger">
                        Silahkan melalukan pembayaran senilai Rp. <?= number_format($detail["total_pembelian"]); ?> Ke <br>
                        <strong>BANK MANDIRI 115-332-43-2 AN. Jhan Dian Perdana</strong> 
                    </div>
                </div>
            </div>
            <a href="riwayat.php" class="btn btn-success">Riwayat Pembelian</a>
         </div>
    </section>
</body>
</html>