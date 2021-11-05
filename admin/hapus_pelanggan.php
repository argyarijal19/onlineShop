<?php 
$conn = mysqli_connect("localhost","root","","onlineshop"); 
$ambil = $conn-> query("SELECT * FROM pelanggan WHERE id_pelanggan ='$_GET[id]'");
$pecah = $ambil-> fetch_assoc();
$conn->query("DELETE  FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
echo "<script>alert('pelanggan telah di hapus')</script>";
echo "<script>location= 'index.php?halaman=pelanggan'</script>";
?>