<?php
require_once("parent.php");
class Cerita extends Parentclass
{
   public function __construct()
   {
      parent::__construct();
   } 
   public function getCerita($idUser, $limit, $offset)
   {
      $sql = "SELECT * FROM cerita WHERE idusers_pembuat_awal LIKE ? ORDER BY idcerita DESC LIMIT ? OFFSET ?";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("sii", $idUser, $limit, $offset);
      $stmt->execute();
      return $stmt->get_result();
   }

   public function getAllCerita($idUser, $limit, $offset)
   {
      $sql = "SELECT * FROM cerita c inner join users u on c.idusers_pembuat_awal= u.idusers WHERE idusers_pembuat_awal NOT LIKE ? ORDER BY idcerita DESC LIMIT ? OFFSET ?";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("sii", $idUser, $limit, $offset);
      $stmt->execute();
      return $stmt->get_result();
   }

   public function insertCerita($judul, $idusers)
   {
      $sql = "INSERT INTO cerita (judul, idusers_pembuat_awal) VALUES (?, ?)";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("ss", $judul, $idusers);
      $stmt->execute();
      return $stmt->insert_id;
   }
}
