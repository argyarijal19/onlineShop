<?php session_start(); ?>
<?php 
include 'conn.php';
//dapatkan id 
$id_produk = $_GET["id"];
$ambil= $conn ->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();
// echo print_r($detail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
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
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?= $detail["foto_produk"] ?>" alt="cardigan all gender" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?= $detail["nama_produk"]; ?></h2>
                    <h4>Rp. <?= number_format($detail["harga_produk"]); ?></h4>
                    <h5>Stok Produk : <?= $detail["stok_produk"]; ?></h5>
                    <br>
                        <form method="post">
                            <div class="form-grup">
                                <div class="input-group">
                                <input class="form-control" type="number" name="jumlah" min="1" max="<?= $detail["stok_produk"]; ?>" placeholder="minimal 1" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">Beli</button>
                                </div>
                                </div>
                            </div>
                        </form>
                        <?php 
                        //beli di tekan 
                        if (isset($_POST["beli"])) {
                            $jumlah = $_POST["jumlah"];
                            $_SESSION["keranjang"][$id_produk] = $jumlah;
                            echo "<script>alert('produk di tambahkanke kerajang belanja')</script>";
                            echo "<script>location= 'keranjang.php'</script>";
                        }
                        ?>
                        <br>
                        <p style="font-size: 20px;"><?= $detail["deskripsi_produk"]; ?></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>