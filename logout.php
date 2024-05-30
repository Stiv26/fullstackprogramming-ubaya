<?php
session_start(); // Mulai sesi

// Hapus variabel sesi yang relevan
session_unset();

// Hentikan sesi
session_destroy();

// Redirect pengguna ke halaman login
header("Location: login.php");
exit;
