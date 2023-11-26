<?php

$title = 'Produk';  // memberikan judul pada header
require_once('../base.php');    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/customer/templates/header.php");   // mengabungkan dengan halaman header



if(isset($_GET['cate'])){   //pengecekan apakah ada $_GET['cate'] jika ada maka ambil data sesuai dengan kategori
    $products = getAllDataProductsWithDetailsByCategory($_GET['cate']);
    $judul = 'Kategori : '. $products[0]['nama_kategori'];
    
}elseif(isset($_GET['keyword'])){   //pengecekan apakah ada $_GET['keyword'] jika ada maka ambil data sesuai dengan keyword
    $keyword = htmlspecialchars($_GET['keyword']);
    $judul = 'Hasil Pencarian dari : ' .$keyword;
    $products = getAllDataProductsBySearch($keyword);
}else{  //selain itu maka tampilkan semua
    $products = getAllDataProductsWithCategory();
    $judul = 'Semua Produk';
}
?>

<div class="produk">
    <div class="judul">
        <h2><?= $judul ?></h2> <!-- menampilkan judul -->
    </div>
    <?php if(empty($products)) : ?> <!-- jika keranjang kosong maka tampilkan berikut -->
            <div class="kosong">
                <h4>Tidak Ditemukan</h4>
            </div>
    <?php else :?> 
    <div class="container prod">
        <?php foreach($products as $product ):?>    <!-- perulangan untuk mengeluarkan nilai $products -->
            <div class="card">              <!-- menampialkan gambar produk dari variable $product -->
                <img class="img-produk" src="<?= BASEURL ;?>/assets/img/produk/<?= $product['gambar_produk'] ?>" alt="gambar produk"/>
                <div class="caption">
                    <h5><?= $product['nama_produk']?></h5>  <!-- menampialkan nama produk dari variable $product -->
                    <h5>Rp. <?= number_format($product["harga_produk"], 0, ',', '.')?>,-</h5>   <!-- menampialkan harga produk dari variable $product -->
                    <small>Tersedia <?= $product['stok_produk']?>   <!-- menampialkan stok produk dari variable $product -->
                        <a class="jumlah-btn" href="<?= BASEURL?>/customer/produk.php?cate=<?= $product['id_kategori']?>"><?= $product['nama_kategori']?></a>
                    </small>     
                    <?php 
                    // pengecekan agar produk tidak bisa dimasukkan keranjang melebihi stok
                    $cek = false;
                    foreach($keranjang as $cart ){  //perulangan untuk mencari produk dan dengan produk yang di keranjang apa ada yang sama
                        //jika ada yang sama dan stok produk apakah lebih kecil dari jumlah produk yang dikeranjang 
                        if($product['id_produk'] == $cart['id_produk'] && $product['stok_produk'] <= $cart['jml']){
                            $cek = true;  //jika benar maka termasuk melebihi stok
                        }
                    }
                    ?>
                    <?php if ($product['stok_produk'] <= 0 ):?>
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
    <?php endif;?>
</div>

<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>