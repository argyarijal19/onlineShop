<?php 

if (!isset($_SESSION["admin"])) {
    echo "<script>alert('Anda Harus Login !!')</script>";
    echo "<script>location= 'login.php'</script>";
    header("Location: login.php");
    exit();

}
?>
    <div class="jumbotron">
		<h2 align="center">CARDIBY.ME ONLINESOP </h2>
		<p align="center">Selamat Datang<strong> <?= $_SESSION["admin"]["nama_lengkap"] ?></strong></p>
		<p align="center"><strong></strong></p>
	</div>
