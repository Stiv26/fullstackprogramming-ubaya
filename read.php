<?php
session_start();
ob_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
$idcerita = $_GET['id'];
require_once('class/paragraf.php');
$paragraf = new Paragraf();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lihat Cerita</title>
</head>

<body>
   <?php
   $result = $paragraf->getParagraf($idcerita);
   
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo "<h1>" . $row['judul'] . "</h1>";

      echo '<form method="POST" action="updatecerita.php">';
      echo '<input type="hidden" name="idcerita" value="' . $row['idcerita'] . '">';

      echo "<div class='isi'>" . "<div id='tanggal'>" . $row['tanggal_buat'] . " oleh <i>" . $row['nama'] . "</i> (creator) </div>" . $row['isi_paragraf'] . "</div>";
      while ($row = $result->fetch_assoc()) {
         echo "<div class='isi'>" . "<div id='tanggal'>" . $row['tanggal_buat'] . " oleh <i>" . $row['nama'] . "</i></div>" . $row['isi_paragraf'] . "</div>";
      }

      echo '<br><br>';
      echo 'Tambah Paragraf<br>';
      echo '<textarea name="paragraf" rows="10" cols="40" id="txtArea"></textarea><br>';
      echo '<a href="index.php"><button id="back">Back</button></a>';
      echo '<input id="lanjut" type="submit" name="submit" value="Lanjutkan Cerita">';
      echo '</form>';
   } else {
      $_SESSION['message'] = "Paragraf Belum Ada";
      header("location: index.php");
   }
   ?>
</body>

</html>