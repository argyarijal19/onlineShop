<h2>Kategori Produk</h2>
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
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Asli</th> 
        </tr>
    </thead>
    <tbody>
    <?php foreach ($all as $key => $value): ?>
    
        <tr>
            <td><?= $key+1 ?></td>
            <td><?= $value["nama_kategori"];?></td>
            <td>
                <a href="" class="btn btn-warning btn-sm">Ubah Kategori</a>
                <a href="" class="btn btn-danger btn-sm">Hapus Kategori</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>