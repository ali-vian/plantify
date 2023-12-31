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

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL
$keranjang = getKeranjang($_SESSION['username']);
$product = getDataProductById($_GET['pro']);
$cek = false;
foreach($keranjang as $cart ){//perulangan untuk mencari produk dan dengan produk yang di keranjang apa ada yang sama
    //jika ada yang sama dan stok produk apakah lebih kecil dari jumlah produk yang dikeranjang 
    if($_GET['pro'] == $cart['id_produk'] && $product['stok_produk'] > $cart['jml']){
        $cek = true;    //jika benar maka termasuk melebihi stok
    }
}
if($cek){
    // function menambahkan tambah jumlah produk
    increaseProductInCart($_GET['pro'],$_GET['krjng']);
}else{ 
    //jika melebihi maka kembalikan
	header("Location: keranjang.php");
}
