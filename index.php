<?php 
session_start();

// cek apakah user sudah pernah login atau belum, jika sudah diarahkan ke page sesuai role
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
    header("Location: {$_SESSION['role']}/index.php");    
    exit();
}

require_once("base.php"); // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL

$news = getNewProducts();
// mendapatkan nilai 4 produk paling banyak di order  
$populars = getPopularProducts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantify | Home</title> <!--menampilakan title sesuai dengan halaman -->
    <link rel="stylesheet" href="<?= BASEURL ;?>/assets/styles/style_customer.css" />
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

<!------------------------------ START MAIN  --------------------------------->
<main class="home">
    <div class="main-kiri">
        <h1>Tanamkan Keindahan di Setiap Sudut Rumah Anda!</h1>
        <p>
            Kecantikan alam, dalam genggaman Anda. Bonsai eksklusif untuk
            keindahan yang abadi. Temukan keharmonisan alam di sini
        </p>
        <a href="login.php">  <!-- mengarah ke halaman produk -->
            <div class="btn">Login Now</div>
        </a>
    </div>
    <div class="main-kanan">
        <div>
            <div>
                <div class="btn-1">Baru</div>                 <!-- mendapatkan gambar produk  terbaru index ke 0 -->
                <img class="img-baru" src="<?= BASEURL ;?>/assets/img/produk/<?= $news[0]['gambar_produk']?>" alt="terbaru" />
            </div>
            <div>
                <div class="btn-1">Baru</div>                 <!-- mendapatkan gambar produk terbaru index ke 1 -->
                <img class="img-popular" src="<?= BASEURL ;?>/assets/img/produk/<?= $news[1]['gambar_produk']?>"
                alt="popular"/>
            </div>
        </div>
        <div>
            <div>
                <div class="btn-1">unggulan</div>            <!-- mendapatkan gambar produk populer index ke 0 -->
                <img class="img-unggulan" src="<?= BASEURL ;?>/assets/img/produk/<?= $populars[0]['gambar_produk']?>"
                alt="unggulan"/>
            </div>
            <img class="img-abs" src="<?= BASEURL ;?>/assets/img/Vector.png" alt="img-abs" />
        </div>
    </div>
</main>
<!------------------------------------ END MAIN ----------------------------------------------->