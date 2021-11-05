<h2>Ubah Produk</h2>
<?php 
$ambil = $conn-> query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
$pecah = $ambil-> fetch_assoc();
// echo "<pre>";
// echo print_r($pecah);
// echo "</pre>";
?>
<?php 
$all = array();
$ambil = $conn-> query("SELECT * FROM kategori");
while ($kategori = $ambil->fetch_assoc()) {
    $all[]=$kategori;
}
// echo "<pre>";
// echo print_r($all);
// echo "</pre>";
?>
<br>
<form method="post" enctype="multipart/form-data">
    <div class="form-produk">
            <label>Kategori Produk</label>
            <select name="kategori" class="form-control">
                <option value="">Pilih Kategori</option>
            <?php foreach ($all as $key => $value) : ?>
                <option value="<?= $value["id_kategori"]; ?>" <?php if($pecah["id_kategori"]==$value["id_kategori"]){ echo "selected"; } ?> > 
                <?= $value["nama_kategori"];?>
                </option>
            <?php endforeach ?>
            </select>
    </div>
    <div class="form-group">
        <label>Nama Produk :</label>
        <input type="text" name="nama" class="form-control" value="<?= $pecah['nama_produk'];?>">
    </div>
    <div class="form-group">
        <label>Harga Produk :</label>
        <input type="text" name="harga" class="form-control" value="<?= $pecah['harga_produk'];?>">
    </div>
    <div class="form-group">
        <label>Berat Produk :</label>
        <input type="text" name="berat" class="form-control" value="<?= $pecah['berat_produk'];?>">
    </div>
    <div class="form-group">
        <label>stokProduk :</label>
        <input type="text" name="stok" class="form-control" value="<?= $pecah['stok_produk'];?>">
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?= $pecah["foto_produk"]?>" width="200px">
    </div>
    <div class="form-group">
        <label>Ubah Foto :</label>
        <input type="file" name="foto" class="form-control" value="<?= $pecah['foto_produk'];?>">
    </div>
    <div class="form-group">
        <label>Deskripsi :</label>
       <textarea name="deskripsi" class="form-control" rows="10"><?= $pecah["deskripsi_produk"] ?>
       </textarea>
    </div>
    <button class="btn btn-primary" name="ubah">ubah Produk</button>
</form>
<?php 

if (isset($_POST["ubah"])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    //jika fotonya di ganti maka 
    if (!empty($lokasi)) {
        move_uploaded_file($lokasi,"../foto_produk/$namafoto");
        $conn-> query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk= '$_POST[harga]',
        berat_produk='$_POST[berat]',deskripsi_produk= '$_POST[deskripsi]',stok_produk='$_POST[stok]',id_kategori='$_POST[kategori]', foto_produk= '$namafoto',
        WHERE id_produk='$_GET[id]'");
    }else {
        $conn-> query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk= '$_POST[harga]',
        berat_produk='$_POST[berat]',deskripsi_produk= '$_POST[deskripsi]',stok_produk='$_POST[stok]',id_kategori='$_POST[kategori]' WHERE id_produk='$_GET[id]' ");
    }
    echo "<script>alert('Data Berhasil Di Ubah')</script>";
    echo "<script>location= 'index.php?halaman=produk';</script>"; 
}
?>