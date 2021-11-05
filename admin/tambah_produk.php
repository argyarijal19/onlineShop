<?php 
$all = array();
$ambil =$conn -> query("SELECT * FROM kategori ");
while ($kategori = $ambil->fetch_assoc()) {
    $all[] = $kategori;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
    <h2>TAMBAH PRODUK</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-produk">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <br>
        <div class="form-produk">
            <label>Kategori Produk</label>
            <select name="kategori" class="form-control">
                <option value="">Pilih Kategori</option>
            <?php foreach ($all as $key => $value) : ?>
                <option value="<?= $value["id_kategori"]; ?>"><?= $value["nama_kategori"] ?></option>
            <?php endforeach ?>
            </select>
        </div>
        <br>
        <div class="form-grup">
            <label>Harga (Rp)</label>
            <input type="number" class="form-kontrol" name="harga">
        </div>
        <br>
        <div class="form-grup">
            <label>Berat (gr) </label>
            <input type="number" class="form-control" name="stok">
        </div>
        <br>
        <div class="form-grup">
            <label>Berat (gr) </label>
            <input type="number" class="form-control" name="berat">
        </div>
        <br>
        <div class="form-grup">
            <label >Deskripsi produk</label>
            <textarea class="form-control" name="deskripsi" cols="30" rows="10"></textarea>
        </div>
        <br>
        <div class="form-grup">
            <label>Foto Produk</label>
            <input type="file" class="form-control" name="photo">
        </div>
        <br><br>
        <button class="btn btn-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
    </form>
</body>
</html>
<?php 
if (isset ($_POST["save"])) {
    $nama = $_FILES["photo"]["name"];
    $lokasi = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($lokasi,"../foto_produk/".$nama);
    $conn ->query("INSERT INTO produk 
    (id_kategori,nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk,stok_produk) VALUES 
    ('$value[id_kategori]','$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]')");
    
    echo "<script>alert ('Data Berhasil Ditambahkan')</script>";
    echo "<script>location= 'index.php?halaman=produk'</script>";
}
?>
