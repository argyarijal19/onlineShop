<?php
session_start();

$beli = $_GET["id"];
    
    if (isset($_SESSION["keranjang"][$beli])) {
        $_SESSION["keranjang"][$beli]+=1;
    }else {
        $_SESSION["keranjang"][$beli]=1;
    }

echo "<script>alert('produk telah di simpan ke dalam keranjang belanja !!')</script>";
echo "<script>location= 'keranjang.php'</script>";