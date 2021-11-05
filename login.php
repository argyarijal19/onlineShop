<?php
session_start();
include 'conn.php';
if (isset($_POST["login"])) {
    $password = $_POST["password"];
    $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$_POST[email]'");
    $cek = $ambil->num_rows;
    if ($cek == 1) {
        $akun = $ambil->fetch_assoc();
        if ($akun["status"] == 0) {
            echo "<script>alert ('Akun Anda Belum Aktif Silahkan Lakukan Aktifasi Terlebih Dahulu ')</script>";
            echo "<script>location= 'Aktifasi.php'</script>";
        } else {
            if (password_verify($password, $akun["password_pelanggan"])) {
                $_SESSION["pelanggan"] = $akun;
                echo "<script>alert ('anda berhasil login')</script>";
                if (isset($_SESSION["keranjang"]) || !empty($_SESSION["keranjang"])) {
                    echo "<script>location= 'checkout.php'</script>";
                } else {
                    echo "<script>location= 'riwayat.php'</script>";
                }
            } else {
                echo "<script>alert ('Email Atau Password Salah')</script>";
                echo "<script>location= 'login.php'</script>";
            }
        }
    } else {
        echo "<script>alert ('email atau password anda salah')</script>";
        echo "<script>location= 'login.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="css.user/login.css">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/css/font-awesome.css">
</head>

<body>
    <nav class="navbar navbar-light" style="background-color:lightblue;">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><img style="width: 150px;height:auto;margin-top:10px;margin-left:-50px;" src="admin/img/Untitled-1.png" alt=""></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li><a href="logout.php">logout</a></li>
                    <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register_pelanggan.php">Register</a></li>
                <?php endif; ?>

                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </nav>
    <div class="overlay">
        <!-- LOGN IN FORM by Omar Dsoky -->
        <form action="login.php" method="POST">
            <!--   con = Container  for items in the form-->
            <div class="con">
                <!--     Start  header Content  -->
                <header class="head-form">
                    <h2 style="color: darkgreen;">Log In</h2>
                    <!--     A welcome message or an explanation of the login form -->
                    <p>login here using your email and password</p>
                </header>
                <!--     End  header Content  -->
                <br>
                <div class="field-set">
                    <!--   user name -->
                    <span class="input-item">
                        <i class="fa fa-user"></i>
                    </span>
                    <!--   user name Input-->
                    <input class="form-input" id="txt-input" type="text" name="email" placeholder="@gmail.com">
                    <br>
                    <!--   Password -->
                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" type="password" name="password" placeholder="Password" id="pwd">
                    <!-- Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                    </span>
                    <br>
                    <!--        buttons -->
                    <!--      button LogIn -->
                    <button name="login" style="margin-top: 10px;" class="log-in"> Log In </button>
                </div>

                <!--   other buttons -->
                <div class="other">
                    <!--      Forgot Password button-->
                    <button class="btn submits frgt-pass">Forgot Password</button>
                    <br>
                    <!--     Sign Up button -->
                    <label> belum punya akun ? </label>

                    <a class="btn submits sign-up" href="register_pelanggan.php">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
    <script src="css.user/login.js"></script>
</body>

</html>