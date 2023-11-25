<?php 

$title = "Produk";

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$products = getAllDataProducts();   // mengambil semua data produk
$categories  = getAllCategories();  // mengambil semua data category
$supplier = getAllDataSupplier();   // mengambil semua data supplier

?>

        <!-- start produk -->
        <div class="wadah">
            <div class="judul">
                <h2>Produk</h2>
            </div>
            <!-- start container-produk -->
            <div class="container-produk">
                <?php foreach ($products as $product):?>
                <!-- start card -->
                <div class="card">
                    <img
                        class="img-produk"
                        src="<?= BASEURL ;?>/assets/img/produk/<?= $product['gambar_produk'] ?>"
                        alt="gambar produk"
                    />
                    <div class="caption">
                        <h5><?= $product['nama_produk']?></h5>
                        <h5>Rp. <?= $product['harga_produk']?>,-</h5>
                        <small>Tersedia <?= $product['stok_produk']?></small>
                    </div>
                    <div class="button-container">
                        <a href="<?= BASEURL ?>/admin/produk/ubah.php?id=<?= $product['id_produk']; ?>">
                            <button class="ubah">Ubah</button>
                        </a> 
                        <a href="hapus.php?id=<?= $product['id_produk']; ?>">
                            <button class="hapus">Hapus</button>
                        </a>
                    </div>
                </div>
                <!-- end card -->
                <?php endforeach;?>
            </div>
            <!-- end container-produk -->
            <a href="<?= BASEURL ?>/admin/produk/tambah.php?cek=true">
                <button class="tambah">Tambahkan Produk Baru</button>
            </a>
        </div>
        <!-- end produk -->
    </div>
    <!-- end container-kanan -->

</body>
</html>