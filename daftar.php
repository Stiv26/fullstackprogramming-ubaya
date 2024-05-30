<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Daftar User</title>
</head>

<body>
   <h1>Daftar User</h1>
   <form method="POST" action="daftar.php">
      ID User: <input type="text" name="iduser"><br>
      Username: <input type="text" name="user"><br>
      Password: <input type="password" name="pass"><br>
      Konfirmasi: <input type="password" name="konfpass"><br>
      <input type="submit" name="submit" value="Daftar">
   </form>
   <?php
   if (isset($_POST['submit'])) {
      require_once('class/users.php');
      $userClass = new Users();
      $iduser = $_POST['iduser'];
      $user = $_POST['user'];
      $password = $_POST['pass'];
      $konfpassword = $_POST['konfpass'];

      if ($password === $konfpassword) {
         $result = $userClass->daftar($iduser, $user, $password);
         echo $result;
      } else {
         echo "Password dan Konfirmasi Password Tidak Sama";
      }
   }
   ?>
   <br>
   <a href="login.php">Back</a>
</body>

</html>