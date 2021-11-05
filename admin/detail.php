<?php 
$ambil = $conn-> query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil-> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
<h2>DETAIL PEMBELIAN</h2><br><br>
    <div class="row">
        <div class="col-md-4">
            <h3>Pembelian</h3>
            <p>
                <?= $detail["tanggal_pembelian"]; ?><br>
                Total : Rp. <?= number_format($detail["total_pembelian"]); ?><br>
                Status : <?= $detail["status_pembelian"]; ?>
            </p>
        </div>
        <div class="col-md-4">
            <h3>Pelanggan</h3>
            <strong><?= $detail["nama_pelanggan"]; ?></strong>
            <p>
            <?= $detail["telepon_pelanggan"]; ?><br>
            <?= $detail["email_pelanggan"]; ?>
            </p>
        </div>
        <div class="col-md-4">
            <h3>Pengiriman</h3>
            <strong><?= $detail["nama_kota"]; ?></strong><br>
            <p>
            Tarif Ongkir: Rp. <?= number_format($detail["tarif"]); ?><br>
            Alamat : <?= $detail["alamat_rumah"]; ?>
            </p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        <?php $ambil= $conn->query("SELECT * FROM pembelian_produk JOIN produk ON
        pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <?php $total= $pecah["harga_produk"] * $pecah["jumlah"];
        $harga = $pecah["harga_produk"];
        $rupiah = number_format($harga,0);
        $bil = number_format($total,0); ?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $pecah["nama_produk"];?></td>
                <td>Rp. <?= $rupiah?></td>
                <td><?= $pecah["jumlah"];?></td>
                <td>Rp. <?= $bil?></td>
            </tr>
             <?php $i++ ?>
        <?php } ?>
        </tbody>
    </table>
</html>