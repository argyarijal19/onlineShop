<?php 
session_start();
$conn = mysqli_connect("localhost","root","","onlineshop");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="box">
            <div class="form">
                <img style="width: 200px;height:auto" src="img/Untitled-1.png" alt="">
                <h2>LOGIN SEBAGAI PEMILIK TOKO</h2>
                <form action="login.php" method="post">
                    <div class="inputBx">
                        <input type="text" name="user" placeholder="username">
                        <img src="img/user.png">
                    </div>
                    <div class="inputBx">
                        <input type="password" name="password" placeholder="password">
                        <img src="img/lock.png" alt="">
                    </div>
                    <label class="remember"><input type="checkbox">rember me</label>
                    <div class="inputBx">
                        <input type="submit" name="login" value="Login">
                    </div>
                </form>
                <?php 
                if (isset($_POST["login"])) {
                    $password= $_POST["password"];
                    //cek kesamaan username
                    $ambil= $conn->query("SELECT * FROM admin WHERE username='$_POST[user]'");
                    $benar = $ambil-> num_rows;
                    if ($benar==1) {
                        //cek password
                        $pass = $ambil->fetch_assoc();
                        if (password_verify($password,$pass["password"])) {
                            $_SESSION["admin"]= $pass;
                            header("location: index.php");
                        }else {
                            echo "<script>alert ('username / password yang anda masukan salah!')</script>";
                            echo "<script>location= 'login.php'</script>";
                        }
                    }
                }
                ?>
                <p>Forget <a href="#">Password</a></p>
                <p>Creat <a href="register.php">Account</a></p>
                <h6 style="font-family:Satisfy , cursive;
                        color: rgb(63, 70, 71); font-size:25px; text-align:center;">
                    semua masalah adalah jalan pendewasaan
                </h6>
            </div>            
        </div>
    </section>
</body>
</html>