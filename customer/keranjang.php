<?php

$title = "Keranjang";   // memberikan judul pada header
require_once("../base.php");        // untuk mengunakan variable constant BASEURL/BASEPATH     
require_once(BASEPATH."/customer/templates/header.php");     // mengabungkan dengan halaman header
$dataKeranjang = getKeranjang($_SESSION['username']);   // mendapatkan semua produk di keranjang customer tersebut

?>

<div class="produk">
    <div class="judul">
        <h2>Keranjang Belanja</h2>
    </div>
        <div class="card">
        <?php if(empty($dataKeranjang)) : ?> <!-- jika keranjang kosong maka tampilkan berikut -->
            <div class="kosong">
                <h4>Keranjang belanja anda masih kosong</h4>
                <a class="btn-card" href="produk.php">Belanja Sekarang</a>
            </div>
        <?php else :?>      <!-- jika tidak kosong maka tampilkan berikut -->
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
                <?php foreach ($dataKeranjang as $data ):?>     <!-- perulangan untuk mengeluarkan nilai $dataKeranjang -->
                <tr>
                    <td>
                        <div class="produk-keranjang">
                            <div class="produk-keranjang">      <!-- menampialkan gambar produk dari variable $data -->
                                <img src="<?= BASEURL ;?>/assets/img/produk/<?= $data['gambar_produk'] ?>"
                                alt="gambar produk"  class="img-keranjang"/>                     <!-- tombol untuk menghilangkan produk dari keranjang -->
                                <a href="hapus_produk_keranjang.php?pro=<?= $data['id_produk']?>&krjng=<?= $data['id_keranjang']?>" class="btn-x">&#10006;</a>
                            </div>
                            <div class="caption">
                                <h5><?= $data['nama_produk']?></h5>     <!-- menampialkan nama produk dari variable $data -->
                                <small>Tersedia <?= $data['stok_produk']?></small>      <!-- menampialkan stok produk dari variable $data -->
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5>Rp. <?= number_format($data["harga_produk"], 0, ',', '.')?>,-</h5>  <!-- menampialkan harga produk dari variable $data dengan format number-->
                    </td>
                    <td>
                        <div class="con-jml">    <!-- tombol untuk tambah satu produk dari keranjang -->
                                <a class="jumlah-btn" href="kurang_jumlah_produk_keranjang.php?pro=<?=$data["id_produk"]?>&krjng=<?= $data['id_keranjang']?>">&minus;</a> 
                                <h5 class="jml"><?=$data['jml']?> </h5>     <!-- tombol untuk kurang satu produk dari keranjang -->
                                <?php if($data['jml'] < $data['stok_produk']): ?>
                                    <a class="jumlah-btn" href="tambah_jumlah_produk_keranjang.php?pro=<?=$data["id_produk"]?>&krjng=<?= $data['id_keranjang']?>">&plus;</a>
                                <?php else:?>
                                    <a class="jumlah-btn">&plus;</a>
                                <?php endif;?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>  
            </table>
            <div class="total">
                <?php
                    $total = 0;     //perulangan untuk mendapatkan total dari keranjang
                    foreach ($dataKeranjang as $data) {
                        $total += $data["harga_produk"] * $data["jml"];
                    }                            
                    ?>
                <h4>Total Pembayaran</h4>
                <h4>Rp. <?= number_format($total, 0, ',', '.')?>,-</h4> <!-- menampialkan total dari harga produk dengan format number-->
            </div>
            <?php endif ; ?>
        </div>
        <?php if(!empty($dataKeranjang)) : ?>   <!-- jika keranjang tidak kosong maka tampilkan -->
        <a class="btn-card checkout-btn" href="konfirmasi_pembayaran.php">Chekout</a>   <!-- tombol chekout mengarah ke konfirmasi_pembayaran.php-->
        <?php endif;?>
</div>
<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>