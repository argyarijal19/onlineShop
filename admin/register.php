<?php 
$conn = mysqli_connect("localhost","root","","onlineshop");
function registrasi($data){
    global $conn;

    $foto = $_FILES["foto"]["name"];
    $lokasi = $_FILES["foto"]["tmp_name"];
    move_uploaded_file($lokasi,"../profile_admin/".$foto);
    $nama = $data["nama_lengkap"];
    $user = strtolower(stripslashes($data["user"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
    if ($password != $konfirmasi_password) {
        echo "<script>alert('password tidak sesuai')</script>";
        return false;
    }

    //cek kesamaan username
    $cek = mysqli_query($conn,"SELECT username FROM admin WHERE username = '$user'");

    if ( mysqli_fetch_assoc($cek) ) {
        echo "<script>alert ('username sudah tersedia!')</script>";
        return false;
    }
    //enkripsi atau mengacak password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //menambahkan data ke database 
    mysqli_query($conn,"INSERT INTO admin VALUES('','$user','$password','$nama','$foto')" );

    return mysqli_affected_rows($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section>
        <div class="box">
            <div class="form">
                <h2>REGISTRASI ACOUNT ADMIN</h2>
                <form action="register.php" method="post" enctype="multipart/form-data">
                    <div class="inputBx">
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap">
                        <img src="img/user.png">
                    </div>
                    <div class="inputBx">
                        <input type="text" name="user" placeholder="username">
                        <img src="img/user.png">
                    </div>
                    <div class="inputBx">
                        <input type="password" name="password" placeholder="password">
                        <img src="img/lock.png" alt="">
                    </div>
                    <div class="inputBx">
                        <input type="password" name="konfirmasi_password" placeholder="konfirmasi password">
                        <img src="img/lock.png" alt="">
                    </div>
                    <div class="inputBx">
                        <h5 style="font-size: 20px;color:white">Foto Profile</h5>
                        <input type="file" name="foto">
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="register" value="register">
                    </div>
                    <p>Do You Have <a href="login.php">Account</a></p>
                </form>
                <?php 
                if (isset($_POST["register"])) {
                    if (registrasi($_POST) > 0) {
                        echo "<script>alert('Selamat Anda Terdaftar Sebagai Admin')</script>";
                        echo "<script>location= 'login.php'</script>";
                    }else {
                        echo mysqli_error($conn);
                    }
                }
                ?>
            </div>            
        </div>

    </section>
</body>
</html>