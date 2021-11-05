<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produk</title>
</head>
<h2>Data Produk</h2><br>
<body>
    <div class="pull-right">
        <a href="index.php?halaman=tambah_produk" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Produk</a>
        <br>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok Produk</th>
                <th>Harga Produk</th>
                <th>Berat Produk</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        <?php $ambil= $conn -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori=produk.id_kategori");?>
        <?php  while ($pecah = $ambil -> fetch_assoc()) { ?>
        <?php $number = $pecah["harga_produk"]; 
        $bil= number_format($number, 0); ?>
        
            <tr>
                <td><?= $i; ?></td>
                <td><?= $pecah ["nama_produk"]; ?></td>
                <td><?= $pecah ["nama_kategori"]; ?></td>
                <td><?= $pecah ["stok_produk"]?></td>
                <td>Rp. <?= $bil ?></td>
                <td><?= $pecah ["berat_produk"]." (gr)"?></td>
                <td>
                    <img src="../foto_produk/<?= $pecah["foto_produk"];?>" width="100px">
                </td>
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?= $pecah["id_produk"];?>" class="btn-danger btn" onclick="return confirm ('yakin ingin menghapus ?')"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a><br><br>
                    <a href="index.php?halaman=ubahproduk&id=<?= $pecah["id_produk"];?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>