<?php

$title = 'Produk';  // memberikan judul pada header
require_once('../base.php');    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/customer/templates/header.php");   // mengabungkan dengan halaman header

// mengecek apakah ada get jika tidak menampilkan semua
if(!isset($_GET['cate'])){
    $products = getAllDataProductsWithCategory();
    $judul = 'Semua Produk';
}else{
    // jika ada tampilkan sesuai kategori get
    $products = getAllDataProductsWithDetailsByCategory($_GET['cate']);
    $judul = 'Kategori : '. $products[0]['nama_kategori'];
}
?>

<div class="produk">
    <div class="judul">
        <h2><?= $judul ?></h2> <!-- menampilkan judul -->
    </div>
    <div class="container prod">
        <?php foreach($products as $product ):?>    <!-- perulangan untuk mengeluarkan nilai $products -->
            <div class="card">              <!-- menampialkan gambar produk dari variable $product -->
                <img class="img-produk" src="<?= BASEURL ;?>/assets/img/produk/<?= $product['gambar_produk'] ?>" alt="gambar produk"/>
                <div class="caption">
                    <h5><?= $product['nama_produk']?></h5>  <!-- menampialkan nama produk dari variable $product -->
                    <h5>Rp. <?= number_format($product["harga_produk"], 0, ',', '.')?>,-</h5>   <!-- menampialkan harga produk dari variable $product -->
                    <small>Tersedia <?= $product['stok_produk']?>
                        <a class="jumlah-btn" href="<?= BASEURL?>/customer/produk.php?cate=<?= $product['id_kategori']?>"><?= $product['nama_kategori']?></a>
                    </small>     <!-- menampialkan stok produk dari variable $product -->
                    <?php 
                    $cek = false;
                    foreach($keranjang as $cart ){
                        if($product['id_produk'] == $cart['id_produk'] && $product['stok_produk'] <= $cart['jml']){
                            $cek = true;
                        }
                    }
                    ?>
                    <?php if ($product['stok_produk'] == 0 ):?>
                        <div class="btn-card habis">Stok Habis</div>  <!-- kondisi jika stok produk 0 maka tidak bisa dibeli dan menampilkan stok habis -->
                    <?php elseif($cek): ?>
                        <div class="btn-card habis">Stok Tidak Mencukupi</div>  
                    <?php else:?>
                        <a href="tambah_keranjang.php?produk=<?= $product["id_produk"] ?>">
                            <div class="btn-card">Masukkan Keranjang</div> <!-- menuju ke keranjang.php dengan get berisi id produk -->
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>