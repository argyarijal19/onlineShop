<?php 
session_start();
//dapatkan id
$id_produk= $_GET["id"];
unset ($_SESSION["keranjang"]["$id_produk"]);

echo "<script>alert('produk telah di hapus')</script>";
echo "<script>location= 'keranjang.php'</script>";


?>