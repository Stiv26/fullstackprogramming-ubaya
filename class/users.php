<?php
require_once("parent.php");
class Users extends Parentclass
{
   public function __construct()
   {
      parent::__construct();
   }

   public function login($user, $password)
   {
      $sql = "SELECT * FROM users WHERE nama=?";
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
         $salt = $row['salt'];

         $md5pass = md5($password);
         $combinepass = $md5pass . $salt;
         $finalpass = md5($combinepass);

         if ($row['password'] === $finalpass) {
            //session_set_cookie_params(30 * 24 * 60 * 60);

            $_SESSION['idusers'] = $row['idusers'];
            $_SESSION['user'] = $row['nama'];
            return "User Berhasil Login.";
         } else
            return "Password Tidak Sesuai.";
      }
   }

   public function daftar($iduser, $user, $password)
   {
      $salt = str_shuffle("Project UTS Full Stack");
      $check_query = "SELECT * FROM users WHERE idusers = ?";
      $check_stmt = $this->mysqli->prepare($check_query);
      $check_stmt->bind_param("s", $iduser);
      $check_stmt->execute();
      $result = $check_stmt->get_result();
      if ($result->num_rows > 0) {
         return "ID User sudah digunakan.";
      } else {
         $md5pass = md5($password);
         $combinepass = $md5pass . $salt;
         $finalpass = md5($combinepass);
         $sql = "INSERT INTO users VALUES(?,?,?,?)";
         $stmt = $this->mysqli->prepare($sql);
         $stmt->bind_param("ssss", $iduser, $user, $finalpass, $salt);
         if ($stmt->execute()) {
            return "Sukses";
         } else {
            return "Gagal";
         }
      }
   }
}
