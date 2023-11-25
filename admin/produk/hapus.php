<?php 

// untuk masuk ke halaman ini harus lewat tombol, jika lewat link url maka akan dilempar ke halaman index
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

session_start();

/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'admin' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../../base.php");     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH."/database.php");     // menghubungkan dengan file database.php untuk mendapatkan function SQL

$product = getProductById($_GET['id']);     // mengambil data produk berdasarkan id

unlink(BASEPATH."/assets/img/produk/".$product['gambar_produk']);   // menghapus gambar di direktori
deleteProduct($_GET['id']);     // menghapus gambar di database

$previousPage = $_SERVER['HTTP_REFERER'];   // halaman sebelumnya
header("Location: $previousPage");      // mengarahkan ke halaman sebelumnya