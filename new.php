<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Cerita</title>
</head>
<body>
    <h1>BUAT CERITA</h1>
    <form method="POST" action="new_proses.php">
        Judul <input type="text" name="judul"><br>
        <p>Paragraf</p><textarea name="paragraf" rows="10" cols="30"></textarea><br><br><br>
        <a href="index.php"><button id="back">Back</button></a>
        <input type="submit" name="submit" value="Buat Cerita">
    </form>
</html>