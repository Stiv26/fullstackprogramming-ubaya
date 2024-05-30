<?php
session_start();
ob_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
require_once('class/cerita.php');
require_once('class/paragraf.php');
$paragraf = new Paragraf();
$cerita = new Cerita();

if (isset($_POST['submit'])) {
   $judul = $_POST['judul'];
   $inputParagraf = $_POST['paragraf'];

   if (isset($_SESSION['user'])) {
      $idusers = $_SESSION['idusers'];

      $idcerita = $cerita->insertCerita($judul, $idusers);
      $result = $paragraf->addParagraf($idusers, $idcerita, $inputParagraf);

      if ($result == "Error") {
         echo "Insert Error";
      } else {
         echo "Insert Success";
      }
   } else {
      header("Location: login.php");
   }
} else {
   header("Location: index.php");
}
echo '<br><a href="index.php">Back</a>';
