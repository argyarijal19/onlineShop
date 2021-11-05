<?php 
session_start();
unset ($_SESSION["admin"]);
session_destroy();
echo "<script>alert ('Anda Telah Keluar')</script>";
echo "<script>location= 'login.php'</script>";
?>