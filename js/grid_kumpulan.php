<?php
require_once('../class/cerita.php');
require_once('../class/paragraf.php');
$cerita = new Cerita();
$paragraf = new Paragraf();

$userLogin = $_POST['iduser'];
$limit = $_POST['limit_kumpulan'];
$offset = $_POST['offset_kumpulan'];

$result = "";

$res = $cerita->getAllCerita($userLogin, $limit, $offset);
while ($row = $res->fetch_assoc()) {
   $result .= "<div class='content-kumpulan'>";
   $result .= "<h4>" . $row['judul'] . "</h4>";
   $result .= "<p>Pemilik Cerita : " . $row['nama'] . "</p>";
   $idcerita = $row['idcerita'];
   $getJumlah = $paragraf->getJumlahParagraf($idcerita);
   $jumlahParagraf = $getJumlah->fetch_assoc();
   $result .= "<p>Jumlah Paragraf : " . $jumlahParagraf['jumlah_paragraf'] . "</p>";
   $result .= "<p><a href='read.php?id=$idcerita'>Baca Lebih lanjut</a></p>";
   $result .= "</div>";
}

echo $result;
