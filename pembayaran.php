<?php 
session_start();
//koneksi database
include 'conn.php';
//jika ga ada yang login jangan kasih masuk
if (!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"])) {
    echo "<script>alert ('anda harus login')</script>";
    echo "<script>location= 'login.php'</script>";
}

//dapatkan id pelanggan yang beli dari url
$idpem = $_GET["id"];
$ambil = $conn-> query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$datapem = $ambil->fetch_assoc();
//dapatkan id pelanggan yang yang beli
$id_pelanggan_beli = $datapem["id_pelanggan"];
//dapatkan id pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_beli !== $id_pelanggan_login) {
    echo "<script>alert ('ini bukan data pembayaran anda')</script>";
    echo "<script>location= 'riwayat.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
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
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim Bukti Pembayaran Di Bawah Ini</p>
        <div class="alert alert-info">
            Total Tagihan Anda <strong>Rp. <?= number_format($datapem["total_pembelian"])  ?></strong>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama pembayar</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" name="bank" class="form-control">
            </div>
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <input type="number" min="1" name="jumlah" class="form-control">
            </div>
            <div class="form-group">
                <label>Bukti Pembayaran</label>
                <input type="file" name="bukti" class="form-control">
                <p class="text-danger">Foto Bukti Pembayaran Harus JPG maksimal 2MB </p>
            </div>
            <button class="btn btn-primary" name="kirim" >Kirim</button>
        </form>
    </div>
    <?php 
    //masukan data ke datebase
    if (isset($_POST["kirim"])) {
        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");
        $bukti = $_FILES["bukti"]["name"];
        $lokasi = $_FILES["bukti"]["tmp_name"];
        $namafix = date("YmdHis").$bukti;
        move_uploaded_file($lokasi, "bukti_pembayaran/$namafix");

        $conn->query("INSERT INTO pembayaran (id_pembelian, nama, bank, jumlah, tanggal, bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafix')");

        //upadte status pembayaran
        $conn-> query("UPDATE pembelian SET status_pembelian='sudah bayar' WHERE id_pembelian='$idpem'");
        

        echo "<script>alert ('pembayaran terkonfirmasi terimakasih')</script>";
        echo "<script>location= 'riwayat.php'</script>";
    }
    
    ?>
</body>
</html>