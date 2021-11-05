<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
</head>
<body>
    <h2>DATA PELANGGAN</h2>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    <?php $ambil= $conn-> query("SELECT * FROM pelanggan");?>
    <?php while( $pecah = $ambil-> fetch_assoc() ) {?>
        <tr>
            <td><?= $i ;?></td>
            <td><?= $pecah ["nama_pelanggan"] ;?></td>
            <td><?= $pecah ["email_pelanggan"] ;?></td>
            <td><?= $pecah ["telepon_pelanggan"] ;?></td>
            <td>
                <a href="hapus_pelanggan.php?id=<?= $pecah["id_pelanggan"]; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
    <?php } ?>
    </tbody>
    </table>
</body>
</html>