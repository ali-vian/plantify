<?php

$title = "Detail Transaksi";
require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH."/customer/templates/header.php");

$detail_order = getDetailOrder($_GET['order']);     //untuk mendapatkan data detail pesanan customer

$total = 0;  //perulangan untuk mendapatkan total dari detail pesanan
foreach ($detail_order as $data) {
    $total += $data["harga_produk"] * $data["jumlah_produk"];   
}    
?>

<div class="produk">
    <div class="judul">
        <h2>Detail Transaksi</h2>
    </div>
    <div class="card">
        <table>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            <?php foreach($detail_order as $order): ?>   <!-- perulangan untuk mengeluarkan nilai $detail_order -->
                <tr>
                    <td>
                        <div class="produk-keranjang">
                            <img
                            class="img-keranjang"
                            src="<?= BASEURL ;?>/assets/img/produk/<?= $order['gambar_produk'] ?>"
                            alt="gambar produk"
                            />
                            <div class="caption">
                                <h5><?= $order['nama_produk']?></h5>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5>Rp. <?= number_format($order["harga_produk"], 0, ',', '.')?>,-</h5>
                    </td>
                    <td>
                        <h5 class="jml"><?=$order['jumlah_produk']?> </h5>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <div class="total">
            <h4>Total Pembelian</h4>
            <h4>Rp. <?= number_format($total, 0, ',', '.')?>,-</h4>
        </div>
        <a class="kembali back-btn" href="daftar_transaksi.php">Kembali</a>
    </div>
</div>
<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>
