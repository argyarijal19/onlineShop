<h2>Detail Pembayaran</h2>
<?php 
//dapatkan id pembayaran dari url 

$id_pembelian = $_GET["id"];

//ambil detail pembayaran berdasarkan id pembelian
$ambil = $conn-> query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil-> fetch_assoc();
?>
<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $detail["nama"]; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $detail["bank"]; ?></td>
            </tr>
            <tr>
                <th>Jumlah Pembayaran</th>
                <td><?= $detail["jumlah"]; ?></td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td><?= $detail["tanggal"]; ?></td>
            </tr>
        </table>
    </div>
        <div class="col-md-6">
            <img src="../bukti_pembayaran/<?= $detail["bukti"];?>" class="img-responsive" >
        </div>
</div>
<form method="post">
    <div class="form-group">
        <label>No. Resi Pengiriman</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">Pilih status</option>
            <option value="Lunas">Lunas</option>
            <option value="Barang Dikirim">Barang Dikirim</option>
            <option value="Batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>
<?php 
if (isset($_POST["proses"])) {
    $resi = $_POST["resi"];
    $status = $_POST["status"];
    $conn-> query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");
    echo "<script>alert ('Data Pembelian Sukses Di update')</script>";
    echo "<script>location= 'index.php?halaman=pembelian'</script>";
}
?>