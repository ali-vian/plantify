<?php
session_start();
/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'customer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL

// mengambil data order dengan id
$order = getOrderbyId($_SESSION['username'],$_GET['id']);

// megegecek status jika status 1 maka mengarah ke daftar transaksi
if($order['status'])
{
    header("Location: daftar_transaksi.php");
}else{  // jika tidak maka hapus transaksi
    deleteOrderbyId($_GET['id']);
}

