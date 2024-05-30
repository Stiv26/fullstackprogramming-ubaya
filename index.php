<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
if (isset($_SESSION['message'])) {
   echo "<script type='text/javascript'>alert('" . $_SESSION['message'] . "');</script>";
   unset($_SESSION['message']); 
}
require_once("class/cerita.php");
$cerita = new Cerita();
$idUser = $_SESSION['idusers'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
   <link rel="stylesheet" href="style/styles.css">
</head>

<body>
   <h1>CERBUNG</h1>
   <p class="subtitle">Cerita Bersambung</p><br><br>

   <div id='container'>

      <div class="kategori">
         <form>
            <p>Kategori :</p>
            <select id="myCombobox" name="myCombobox">
               <option value="kumpulan">Kumpulan Cerita</option>
               <option value="ceritaku">Ceritaku</option>
            </select>
         </form>
      </div>

      <div class='cerita-kumpulan'>
         <h3>KUMPULAN CERITA</h3>
         <div class="grid-kumpulan"></div>
         <br>
         <button class='button-kumpulan'>Lihat cerita selanjutanya</button>
      </div>

      <div class="line"></div>

      <div class='cerita-ceritaku'>
         <h3>CERITAKU</h3>
         <div class="grid-ceritaku"></div>
         <br><button class='button-ceritaku'>Lihat cerita selanjutanya</button>
      </div>
   </div>
   <h3 class="logout"><a href="logout.php">Keluar Akun</a></h3>
</body>
<script>
   $(document).ready(function() {
      var iduser = "<?php echo $idUser; ?>"
      var offset_kumpulan = 0
      var limit_kumpulan = 4
      var offset_ceritaku = 0
      var limit_ceritaku = 2

      if ($(".kategori").is(":hidden")) {
         limit_kumpulan = 8
      } else {
         limit_kumpulan = 4
      }

      // CHECK COMBOBOX
      $('#myCombobox').on('change', function() {
         var selectedValue = $(this).val();
         var screenWidth = $(window).width();

         if (screenWidth >= 576) {
            $('.cerita-kumpulan').show();
            $('.cerita-ceritaku').show();

            getKumpulanCerita();
         } else {
            if (selectedValue === 'kumpulan') {
               $('.cerita-kumpulan').show();
               $('.cerita-ceritaku').hide();
            } else if (selectedValue === 'ceritaku') {
               $('.cerita-ceritaku').show();
               $('.cerita-kumpulan').hide();
            }
         }
      });

      $(window).resize(function() {
         var screenWidth = $(window).width();

         if (screenWidth >= 576) {
            $('.cerita-kumpulan').show();
            $('.cerita-ceritaku').show();
         } else {
            // Trigger the change event to handle the selectedValue
            $('#myCombobox').trigger('change');
         }
      });

      // PANGGIL FUNCTION
      getKumpulanCerita()
      getCeritaku()

      // UNTUK MENGAMBIL KUMPULAN CERITA
      function getKumpulanCerita() {
         $.post("js/grid_kumpulan.php", {
            iduser: iduser,
            offset_kumpulan: offset_kumpulan,
            limit_kumpulan: limit_kumpulan
         }).done(function(result) {
            $('.grid-kumpulan').append(result);
            if (result == "") {
               alert('Seluruh Cerita telah ditampilkan')
            }
         })
      }

      // UNTUK MENGAMBIL CERITAKU 
      function getCeritaku() {
         $.post("js/grid_ceritaku.php", {
            iduser: iduser,
            offset_ceritaku: offset_ceritaku,
            limit_ceritaku: limit_ceritaku
         }).done(function(result) {
            $('.grid-ceritaku').append(result);
            if (result == "") {
               alert('Seluruh Cerita telah ditampilkan')
            }
         })
      }

      // UNTUK TAMBAH CERITA SELANJUTNYA
      $('.button-kumpulan').click(function() {
         if ($(".kategori").is(":hidden")) {
            offset_kumpulan += 8
         } else {
            offset_kumpulan += 4
         }
         getKumpulanCerita()
      })
      $('.button-ceritaku').click(function() {
         offset_ceritaku += 2
         getCeritaku()
      })
   });
</script>

</html>