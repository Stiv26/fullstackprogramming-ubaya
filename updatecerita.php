<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
require_once('class/paragraf.php');
$paragraf = new Paragraf();
if (isset($_POST['submit'])) {
   $idusers = $_SESSION['idusers'];
   $idcerita = $_POST['idcerita'];
   $isiParagraf = $_POST['paragraf'];

   $result = $paragraf->addParagraf($idusers, $idcerita, $isiParagraf);

   if ($result == "Error") {
      echo "Error";
   } else {
      $_SESSION['message'] = "Inputan berhasil";
      header("Location: index.php");
   }
} else {
   header("Location: index.php");
}
