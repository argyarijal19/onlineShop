<?php 
session_start();
//hancurkan session 
session_destroy();
echo "<script>alert ('anda telah logout')</script>";
echo "<script>location= 'index.php'</script>";
?>