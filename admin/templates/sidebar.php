<?php 

session_start();

/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'admin' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT']."/TA-tes/base.php"); // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASEURL ;?>/assets/styles/style_admin.css" />
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <!-- Start Sidebar -->
    <div class="sidebar">
        <img class="logo" src="<?= BASEURL ;?>/assets/img/logo.png" alt="logo" />
        <div class="menu-container">
            <menu>
                <a href="<?= BASEURL ?>/admin/" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= BASEURL ?>/admin/produk/" class="<?= $title === 'Produk' ? 'active' : '' ?>">Produk</a>
                <a href="<?= BASEURL ?>/admin/supplier/" class="<?= $title === 'Supplier' ? 'active' : '' ?>">Supplier</a>
                <a href="<?= BASEURL ?>/admin/customer/" class="<?= $title === 'Customer' ? 'active' : '' ?>">Customer</a>
                <a href="<?= BASEURL ?>/admin/transaksi/" class="<?= $title === 'Konfirmasi Bayar' ? 'active' : '' ?>">Konfirmasi Bayar</a>
            </menu>
            <a href="<?= BASEURL ;?>/logout.php" class="logout"><div>Logout</div></a>
        </div>
    </div>
    <!-- End Sidebar -->

    