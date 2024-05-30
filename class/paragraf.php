<?php
require_once("parent.php");
class Paragraf extends Parentclass
{
   public function __construct()
   {
      parent::__construct();
   }

   public function getParagraf($idcerita)
   {
      $sql = "SELECT * FROM paragraf p INNER JOIN cerita c ON p.idcerita = c.idcerita
                INNER JOIN users u ON p.idusers = u.idusers WHERE p.idcerita = ? ORDER BY p.idparagraf";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("i", $idcerita);
      $stmt->execute();
      return $stmt->get_result();
   }

   public function addParagraf($idusers, $idcerita, $isiParagraf)
   {
      $sql = "INSERT INTO paragraf (`idusers`, `idcerita`, `isi_paragraf`) VALUES (?,?,?)";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("sis", $idusers, $idcerita, $isiParagraf);
      $stmt->execute();
      if ($stmt->error) {
         return "Error";
      } else {
         return "Inputan berhasil";
      }
   }

   public function getJumlahParagraf($idcerita)
   {
      $sql = "SELECT COUNT(isi_paragraf) as jumlah_paragraf FROM paragraf WHERE idcerita = ?";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param('i', $idcerita);
      $stmt->execute();
      return $stmt->get_result();
   }
}
