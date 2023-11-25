<?php
$title = 'Beranda';  // memberikan judul pada header
require_once('../base.php'); // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/customer/templates/header.php");  // mengabungkan dengan halaman header

// mendapatkan nilai id_kategori,nama_kategori,gambar_produk dari kategori join produk
$categories  = getAllCategories();
// mendapatkan nilai semua column dari 4 produk terbaru  
$news = getNewProducts();
// mendapatkan nilai 4 produk paling banyak di order  
$populars = getPopularProducts();
?>
<!------------------------------ START MAIN  --------------------------------->
<main>
    <div class="main-kiri">
        <h1>Tanamkan Keindahan di Setiap Sudut Rumah Anda!</h1>
        <p>
          Kecantikan alam, dalam genggaman Anda. Bonsai eksklusif untuk
          keindahan yang abadi. Temukan keharmonisan alam di sini
        </p>
        <a href="<?= BASEURL. '/customer/produk.php'?>">  <!-- mengarah ke halaman produk -->
            <div class="btn">Temukan Sekarang</div>
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
                    alt="popular"
                />
            </div>
        </div>
        <div>
            <div>
                <div class="btn-1">unggulan</div>            <!-- mendapatkan gambar produk populer index ke 0 -->
                <img class="img-unggulan" src="<?= BASEURL ;?>/assets/img/produk/<?= $populars[0]['gambar_produk']?>"
                    alt="unggulan"
                />
            </div>
            <img class="img-abs" src="<?= BASEURL ;?>/assets/img/Vector.png" alt="img-abs" />
        </div>
    </div>
</main>
    <!------------------------------------ END MAIN ----------------------------------------------->
    <!------------------------------------ START PRODUK NEW ------------------------------------------->
<div class="produk">
    <div class="judul">
        <h2>Baru</h2>                               <!-- mengarah ke halaman produk -->
        <h4 ><a class="green"  href="<?= BASEURL. '/customer/produk.php'?>">Lihat semua</a></h4>
        <h4 ><a class="green"  href="<?= BASEURL. '/customer/produk.php'?>">Lihat semua</a></h4>
    </div>
    <div class="container">
    <?php foreach($news as $new):?> <!-- perulangan untuk mengeluarkan nilai $news -->
       
        <div class="card">              <!-- menampialkan gambar produk dari variable $new -->
            <img src="<?= BASEURL ;?>/assets/img/produk/<?= $new['gambar_produk'] ?>"
            <img src="<?= BASEURL ;?>/assets/img/produk/<?= $new['gambar_produk'] ?>"
              alt="gambar produk" class="img-produk"
            />
            <div class="caption">
                <h5><?= $new['nama_produk']?></h5>  <!-- menampialkan nama produk dari variable $new -->
                <h5>Rp. <?= number_format($new["harga_produk"], 0, ',', '.')?>,-</h5>   <!-- menampialkan harga produk dari variable $new -->
                <small>Tersedia <?= $new['stok_produk']?>
                    <a class="jumlah-btn" href="<?= BASEURL?>/customer/produk.php?cate=<?= $new['id_kategori']?>"><?= $new['nama_kategori']?></a>
                </small>   <!-- menampialkan stok produk dari variable $new -->
                <?php 
                    $cek = false;
                    foreach($keranjang as $cart ){
                        if($new['id_produk'] == $cart['id_produk'] && $new['stok_produk'] <= $cart['jml']){
                            $cek = true;
                        }
                    }
                ?>
                <?php if ($new['stok_produk'] == 0 ):?>
                    <div class="btn-card habis">Stok Habis</div>  <!-- kondisi jika stok produk 0 maka tidak bisa dibeli dan menampilkan stok habis -->
                <?php elseif($cek): ?>
                    <div class="btn-card habis">Stok Tidak Mencukupi</div>  
                <?php else:?>
                    <a href="tambah_keranjang.php?produk=<?= $new["id_produk"] ?>">
                        <div class="btn-card">Masukkan Keranjang</div> <!-- menuju ke keranjang.php dengan get berisi id produk -->
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>
    <!------------------------------------ END PRODUK NEW----------------------------------------------->
    <!------------------------------------ START PRODUK UNGGULAN------------------------------------------->
<div class="produk">
    <div class="judul">
        <h2>Popular</h2>                    <!-- mengarah ke halaman produk -->
        <h4><a class="green"  href="<?= BASEURL. '/customer/produk.php'?>">Lihat semua</a></h4>
        <h4><a class="green"  href="<?= BASEURL. '/customer/produk.php'?>">Lihat semua</a></h4>
    </div>
    <div class="container">
    <?php foreach($populars as $popular):?> <!-- perulangan untuk mengeluarkan nilai $populars -->
        <div class="card">        <!-- menampialkan gambar produk dari variable $popular -->
            <img src="<?= BASEURL ;?>/assets/img/produk/<?= $popular['gambar_produk'] ?>" 
                alt="gambar produk"  class="img-produk" 
            />
            <div class="caption">
                <h5><?= $popular['nama_produk']?></h5>  <!-- menampialkan nama produk dari variable $popular -->
                <h5>Rp. <?= number_format($popular["harga_produk"], 0, ',', '.')?>,-</h5>  <!-- menampialkan harga produk dari variable $popular -->
                <small>Tersedia <?= $popular['stok_produk']?>
                    <a class="jumlah-btn" href="<?= BASEURL?>/customer/produk.php?cate=<?= $popular['id_kategori']?>"><?= $popular['nama_kategori']?></a>
                </small>   <!-- menampialkan stok produk dari variable $popular -->
                <?php 
                    $cek = false;
                    foreach($keranjang as $cart ){
                        if($popular['id_produk'] == $cart['id_produk'] && $popular['stok_produk'] <= $cart['jml']){
                            $cek = true;
                        }
                    }
                ?>
                <?php if ($popular['stok_produk'] == 0 ):?>
                    <div class="btn-card habis">Stok Habis</div>  <!-- kondisi jika stok produk 0 maka tidak bisa dibeli dan menampilkan stok habis -->
                <?php elseif($cek): ?>
                    <div class="btn-card habis">Stok Tidak Mencukupi</div>  
                <?php else:?>
                    <a href="tambah_keranjang.php?produk=<?= $popular["id_produk"] ?>">
                        <div class="btn-card">Masukkan Keranjang</div> <!-- menuju ke keranjang.php dengan get berisi id produk -->
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>
    <!------------------------------------ END PRODUK UNGGULAN ----------------------------------------------->
    <!------------------------------------ START KATEGORI ------------------------------------------->
<div class="kategori">
    <div class="judul">
        <h2>Kategori</h2>
    </div>
    <div class="container">
        <?php foreach($categories as $category):?>      <!-- perulangan untuk mengeluarkan nilai $categories -->
            <a href="<?= BASEURL?>/customer/produk.php?cate=<?= $category['id_kategori']?>" > <!-- mengarahkan ke produk dengan kategori yang diklik -->
                <div class="card-kategori">                 <!-- menampialkan gambar produk dari variable $category -->
                    <img class="img-kategori" src="<?= BASEURL ;?>/assets/img/produk/<?= $category['gambar_produk']?>" alt="img kategori" />
                    <h4 class="title2"><?= $category['nama_kategori'] ?></h4>
                </div>
            </a>
        <?php endforeach ;?>
    </div>
</div>
    <!------------------------------------ END KATEGORI ----------------------------------------------->
    <!------------------------------------ START LOKASI ------------------------------------------->
<div class="lokasi">
    <div class="judul">
        <h2>Lokasi Kami</h2>
    </div>
    <div class="container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.9644736773307!2d112.72410727433831!3d-7.130106192873798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd803dcd1e1bd7f%3A0x5261304f608c91db!2sLey%20Denara!5e0!3m2!1sid!2sid!4v1699597392448!5m2!1sid!2sid"
          width="1159"
          height="287"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>
    <!------------------------------------ END LOKASI ----------------------------------------------->
<?php
require_once(BASEPATH . "/customer/templates/footer.php"); // mengabungkan dengan halaman footer
?>