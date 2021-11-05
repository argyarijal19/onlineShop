<?php
include 'conn.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/POP3.php';
require 'PHPMailer/src/SMTP.php';

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function registrasi($data)
{
  global $conn;
  $email = $data["email"];
  $telepon = $data["telephone"];
  $user = strtolower(stripslashes($data["nama"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
  //membuat code verification
  $date = date("dH");
  $tlp = $telepon;
  $random_l = 4;
  $cd = (uniqid(rand($date, $tlp), 1));
  $code = substr($cd, 0, $random_l);

  //cek kesamaan email
  $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
  $cek = $ambil->num_rows;

  if ($cek == 0) {
    //cek input password 
    if ($password != $konfirmasi_password) {
      echo "<script>alert('password tidak sesuai')</script>";
      return false;
    } else {
      //enkripsi atau mengacak password
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      //Create a new PHPMailer instance
      $mail = new PHPMailer();

      //Tell PHPMailer to use SMTP
      $mail->isSMTP();

      //Enable SMTP debugging
      //SMTP::DEBUG_OFF = off (for production use)
      //SMTP::DEBUG_CLIENT = client messages
      //SMTP::DEBUG_SERVER = client and server messages
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;

      //Set the hostname of the mail server
      $mail->Host = 'smtp.gmail.com';
      //Use `$mail->Host = gethostbyname('smtp.gmail.com');
      $mail->Port = 465;

      //Set the encryption mechanism to use:
      // - SMTPS (implicit TLS on port 465) or
      // - STARTTLS (explicit TLS on port 587)
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

      //Whether to use SMTP authentication
      $mail->SMTPAuth = true;

      //Username to use for SMTP authentication - use full email address for gmail
      $mail->Username = 'cardibyme123@gmail.com';

      //Password to use for SMTP authentication
      $mail->Password = 'hoyacans';

      //Set who the message is to be sent from
      $mail->setFrom('no-reply@cardibyme.epizy', 'Cardiby.Me');

      //Set an alternative reply-to address
      $mail->addReplyTo($email, 'Hallo ' . $user . ' silahkan aktifasi akun ');

      //Set who the message is to be sent to
      $mail->addAddress($email, $user);

      //Set the subject line
      $mail->Subject = 'Verification Account';

      //Read an HTML message body from an external file, convert referenced images to embedded,
      //convert HTML into a basic plain-text alternative body
      $body = "Hi, " . $user . "<br>Code Verification Anda Adalah : " . $code . "<br> SILAHKAN MELAKUKAN AKTIFASI ACCOUNT";

      $mail->Body = $body;

      //Replace the plain text body with one created manually
      $mail->AltBody = 'This is a plain-text message body';

      if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'SUKSES DIKIRIM!!! ';
      }
      //menambahkan data ke database 
      mysqli_query($conn, "INSERT INTO pelanggan  (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, code_verify) 
    VALUES('$email','$password_hash','$user','$telepon','$code')");

      return mysqli_affected_rows($conn);
    }
  } else {
    echo "<script>alert('Email Sudah Terdaftar')</script>";
    return false;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="css.user/styles.css">
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
  <nav class="navbar navbar-light" style="background-color:lightblue;">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a class="navbar-brand" href="index.php">
            <img src="admin/img/Untitled-1.png" width="150" height="aouto" alt="">
          </a>
        </li>
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
  <form method="post">
    <div style="margin-top: 2%;" class="wrapper">
      <div class="title">
        Register Here
        <br><br>
        <div class="form">
          <div class="input_field">
            <input style="font-size: 20px;" type="text" name="nama" placeholder="Name" class="input" required autocomplete="off">
            <i style="margin-top: 5px;" class="fas fa-user"></i>
          </div>
          <div class="input_field">
            <input style="font-size: 20px;" type="text" name="email" placeholder="Email" class="input" required autocomplete="off">
            <i style="margin-top: 5px;" class="far fa-envelope"></i>
          </div>
          <div class="input_field">
            <input style="font-size: 20px;" type="number" name="telephone" placeholder="No Telepon" class="input" required>
            <i style="margin-top: 5px;" class="fas fa-phone"></i>
          </div>
          <div class="input_field">
            <input style="font-size: 20px;" type="password" name="password" placeholder="Password" class="input" required>
            <i style="margin-top: 5px;" class="fas fa-key"></i>
          </div>
          <div class="input_field">
            <input style="font-size: 20px;" type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" class="input" required>
            <i style="margin-top: 5px;" class="fas fa-lock"></i>
          </div>
          <div class="btn">
            <input style="font-size: 20px;" type="submit" name="daftar" value="Register">
          </div>
        </div>
        <?php
        if (isset($_POST["daftar"])) {
          if (registrasi($_POST) > 0) {
            echo "<script>alert('Code Verifikasi Telah Dikirim Melalui Gmail Silahkan Cek Email Anda Dan Lakukan Aktifasi Akun')</script>";
            echo "<script>location= 'Aktifasi.php'</script>";
          } else {
            echo mysqli_error($conn);
          }
        }
        ?>
  </form>
</body>

</html>