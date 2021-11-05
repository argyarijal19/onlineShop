<?php
include 'conn.php';
if (isset($_POST["verify"])) {
    $code = $_POST["code"];
    $ambil = $conn->query("SELECT * FROM pelanggan WHERE code_verify='$code'");
    $cek = $ambil->num_rows;
    if ($cek > 0) {
        $akun = $ambil->fetch_assoc();
        $id = $akun["id_pelanggan"];
        $update = $conn->query("UPDATE pelanggan SET status=1 WHERE id_pelanggan='$id'");
        echo "<script>alert('Selamat Anda Telah Menjadi pelanggan Cardiby.me Selamat Berbelanja')</script>";
        echo "<script>location= 'login.php'</script>";
    } else {
        echo "<script>alert('Code Aktifasi Tidak Sesuai')</script>";
        echo "<script>location= 'Aktifasi.php'</script>";
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="icon" href="profile_admin/icon/Aktifasi.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css.user/styles.css">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <form method="post">
        <div style="margin-top: 2%;" class="wrapper">
            <div class="title">
                Masukan Code
                <br><br>
                <div class="form">
                    <div class="input_field">
                        <input style="font-size: 20px;" type="text" name="code" placeholder="Code Verification" class="input" required autocomplete="off">
                        <i style="margin-top: 5px;" class="fas fa-info"></i>
                    </div>
                    <div class="btn">
                        <input style="font-size: 20px;" type="submit" name="verify" value="Verifikasi">
                    </div>
                </div>
                <br>
                <p style="font-style: italic; color:red; font-size:15px; text-align:left">Jika tidak menemukan email pada kotak masuk Silahkan cek spam</p>
    </form>
</body>

</html>