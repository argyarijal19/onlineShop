<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
</head>
<h2>Data Pembelian</h2><br>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pembelian</th>
                <th>TOTAL</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        <?php $ambil = $conn -> query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan") ;?>
        <?php while ($pecah = $ambil->fetch_assoc()){ ?>
        <?php $number =  $pecah["total_pembelian"];
        $bil = number_format($number,0);?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $pecah ["nama_pelanggan"]; ?></td>
                <td><?= $pecah ["tanggal_pembelian"] ?></td>
                <td>Rp. <?= $bil ?></td>
                <td><?= $pecah ["status_pembelian"] ?></td>
                <td>
                    <a href="index.php?halaman=detail&id=<?= $pecah ["id_pembelian"];?>" class="btn btn-info">detail Pembelian</a>
                    <?php if ($pecah["status_pembelian"] !== "pending"):?>
                        <a href="index.php?halaman=pembayaran&id=<?= $pecah ["id_pembelian"];?>" class="btn btn-success">detail Pembayaran</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>