<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login User</title>
</head>

<body>
   <h1>Login User</h1>
   <form method="POST" action="login.php">
      Username: <input type="text" name="user"><br>
      Password: <input type="password" name="pass"><br>
      <input type="submit" name="submit" value="Login">
   </form>
   <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
   <br>
   <h3>Kelompok Project:</h3> 
   <ol>
      <li>Christopher Suryandi - 160721001</li>
      <ul>
         <li>username: christo</li>
         <li>password: christo</li>
      </ul>
      <li>Kevin felicius - 160721018</li>
      <ul>
         <li>username: kevin</li>
         <li>password: kevin</li>
      </ul>
      <li>Stiven Suhendra - 160721047</li>
      <ul>
         <li>username: stiven</li>
         <li>password: stiven</li>
      </ul>
   </ol>
   <?php
   if (isset($_POST['submit'])) {
      require_once('class/users.php');
      $userLogin = new Users();
      $user = $_POST['user'];
      $password = $_POST['pass'];

      $result = $userLogin->login($user, $password);
      if ($result == "User Berhasil Login.") {
         if (isset($_POST['redirect']))
            header("Location: " . $_POST['redirect']);
         else
            header("Location: index.php");
      } else {
         echo "UserID atau Password Salah";
      }
   }
   ?>
</body>

</html>