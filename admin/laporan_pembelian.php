<?php 

$data = array();
$tanggal_mulai = "-";
$tanggal_selesai = "-";

if (isset($_POST["kirim"])) {
   $tanggal_mulai = $_POST["tanggalpm"];
   $tanggal_selesai = $_POST["tanggalps"];
   $ambil = $conn-> query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'");

   while ($pecah = $ambil-> fetch_assoc()) {
       $data[] = $pecah;
   }
}
// echo "<pre>";
// echo print_r($data); 
// echo "</pre>";
?>

<h2>laporran Pembelian Dari <?= $tanggal_mulai; ?> Hingga <?= $tanggal_selesai; ?></h2>
<br>
<hr>
<form method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Tangal Mulai</label>
                <input type="date" class="form-control" name="tanggalpm" value="<?= $tanggal_mulai ?>">
            </div>
        </div>
        <div class="col-md-5">
        <div class="form-group">
                <label>Tangal Selesai</label>
                <input type="date" class="form-control" name="tanggalps" value="<?= $tanggal_selesai ?>">
            </div>
        </div>
        <div class="col-md-2">
        <label>&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim">Lihat Pembelian</button>
        </div>
    </div>
</form>

<table class="table table-striped">

    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Pembelian</th>
            <th>Satus Pembelian</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1;  ?>
    <?php $total = 0; ?>
    <?php foreach ($data as $pembelian => $value) : ?>
    <?php $total += $value["total_pembelian"]; ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $value["nama_pelanggan"]; ?></td>
            <td><?= $value["tanggal_pembelian"] ; ?></td>
            <td><?= $value["status_pembelian"] ; ?></td>
            <td>Rp. <?= number_format($value["total_pembelian"]) ; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">TOTAL BELANJA</th>
            <th>Rp. <?= number_format($total) ?> </th>
        </tr>
    </tfoot>
</table>