<?php

$title = "Daftar Pesanan";

require_once("../base.php");    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php");   // menghubungkan dengan file database.php untuk mendapatkan function SQL
require_once(BASEPATH."/customer/templates/header.php");

$pesanan =  getOrder($_SESSION['username']);
?>

<div class="produk">
    <div class="judul">
        <h2>Riwayat Transaksi</h2>
    </div>
    <div class="card kosong">
        <?php if(empty($pesanan)) : ?> <!-- jika keranjang kosong maka tampilkan berikut -->
            <div class="kosong">
                <h4>Keranjang belanja anda masih kosong</h4>
                <a class="btn-card" href="produk.php">Belanja Sekarang</a>
            </div>
        <?php else :?> 
        <table class="riwayat">
            <tr>
                <th class="riwayat">Tanggal Order</th>
                <th class="riwayat">Total Order</th>
                <th class="riwayat">No Rekening</th>
                <th class="riwayat">Nama Bank</th>
                <th class="riwayat">Status</th>
                <th class="riwayat">Action</th>
            </tr>
            <?php foreach($pesanan as $order): ?>
                <tr>
                    <td class="riwayat" ><?= $order['tanggal_order']?></td>
                    <td class="riwayat" ><?= $order['total_order']?></td>
                    <td class="riwayat" ><?= $order['no_rekening'] ?></td>
                    <td class="riwayat" ><?= $order['nama_bank']?></td>
                    <td class="riwayat" ><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                    <td class="riwayat" >
                        <div class="action">

                            <a class="btn-action" href="detail_transaksi.php?order=<?= $order['id_order']?>">Lihat Detail</a>
                            <?php if(!$order['status']):?>
                                <a class="btn-action" href="edit_pembayaran.php?id=<?= $order['id_order']?>">Ubah Pembayaran</a>
                                <a class="btn-action" href="hapus_transaksi.php?id=<?= $order['id_order']?>">Batalkan</a>
                                <?php endif?>
                            </div>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
        <?php endif?>
    </div>
</div>
<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>
