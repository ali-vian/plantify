<?php 

session_start();

/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'admin' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../../base.php");     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH."/database.php");     // menghubungkan dengan file database.php untuk mendapatkan function SQL

updateStatusOrder($_GET['id']);     // update status order