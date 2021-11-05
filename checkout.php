<?php
session_start();
include 'conn.php';
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('silah kan login dulu gan !')</script>";
    echo "<script>location= 'login.php'</script>";
}
if (!isset($_SESSION["keranjang"])) {
    echo "<script>alert('belum ada belanjaanya gan !')</script>";
    echo "<script>location= 'index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout barang</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-light" style="background-color:lightblue;">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><img style="width: 150px;height:auto;margin-top:10px;margin-left:-50px;" src="admin/img/Untitled-1.png" alt=""></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li><a href="logout.php">logout</a></li>
                    <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <?php else : ?>
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
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                        <?php
                        $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $grosir = $ambil->fetch_assoc();
                        $subharga = $grosir["harga_produk"] * $jumlah;
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $grosir["nama_produk"]; ?></td>
                            <td>Rp. <?= $grosir["harga_produk"]; ?></td>
                            <td><?= $jumlah; ?></td>
                            <td>Rp. <?= number_format($subharga); ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php $totalbelanja += $subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">TOTAL BELANJA</th>
                        <th>Rp. <?= number_format($totalbelanja); ?> </th>
                    </tr>
                </tfoot>
            </table>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?= $_SESSION["pelanggan"]["nama_pelanggan"]; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?= $_SESSION["pelanggan"]["telepon_pelanggan"]; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">Pilih ongkos Kirim</option>
                            <?php
                            $ambil = $conn->query("SELECT * FROM ongkir");
                            while ($ongkir = $ambil->fetch_assoc()) {
                            ?>
                                <option value="<?= $ongkir["id_ongkir"] ?>">
                                    <?= $ongkir["nama_kota"] ?> -
                                    Rp. <?= number_format($ongkir["tarif"]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_lengkap" placeholder="Masukan Alamat lengkap Pengiriman ( Termasuk Kode Pos )" required></textarea>
                </div>
                <button class="btn btn-primary" name="checkout">checkout</button>
            </form>
            <?php
            if (isset($_POST["checkout"])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir = $_POST["id_ongkir"];
                $alamat_pengiriman = $_POST["alamat_lengkap"];
                $tanggal_pembelian = date("Y-m-d");

                $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir = $ambil->fetch_assoc();
                $nama_kota = $arrayongkir["nama_kota"];
                $tarif = $arrayongkir["tarif"];

                $total_pembelian = $totalbelanja + $tarif;
                //simpan data pembelian 
                $conn->query("INSERT INTO pembelian (id_pelanggan, tanggal_pembelian, total_pembelian,id_ongkir, nama_kota, tarif, alamat_rumah) VALUES
                    ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$id_ongkir','$nama_kota','$tarif','$alamat_pengiriman')");
                //mendapatkan id_pembelian terbaru
                $id_pembelian_terbaru = $conn->insert_id;

                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                    $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $eceran = $ambil->fetch_assoc();
                    $nama = $eceran["nama_produk"];
                    $harga = $eceran["harga_produk"];
                    $berat = $eceran["berat_produk"];
                    $subberat = $eceran["berat_produk"] * $jumlah;
                    $subharga = $eceran["harga_produk"] * $jumlah;


                    $conn->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, sub_berat, sub_harga, jumlah) VALUES ('$id_pembelian_terbaru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                    //update stok
                    $conn->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
                }
                //kosongkan keranjang belanja 
                unset($_SESSION["keranjang"]);

                //tampilan di alihkan ke nota 
                echo "<script>alert('pembelian sukses')</script>";
                echo "<script>location= 'nota.php?id=$id_pembelian_terbaru';</script>";
            }
            ?>
        </div>
    </section>
</body>

</html>