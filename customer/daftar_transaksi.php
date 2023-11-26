<?php
$title = "Daftar Pesanan";

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH."/customer/templates/header.php");    // mengabungkan dengan halaman header

$pesanan =  getOrder($_SESSION['username']);    //untuk mendapatkan data pesanan customer
?>

<div class="produk">
    <div class="judul">
        <h2>Riwayat Transaksi</h2>
    </div>
    <div class="card">
        <table class="riwayat">
            <tr>
                <th class="riwayat">Tanggal Order</th>
                <th class="riwayat">Total Order</th>
                <th class="riwayat">No Rekening</th>
                <th class="riwayat">Nama Bank</th>
                <th class="riwayat">Status</th>
                <th class="riwayat">Action</th>
            </tr>
            <?php foreach($pesanan as $order): ?>    <!-- perulangan untuk mengeluarkan nilai $pesanan -->
                <tr>
                    <td class="riwayat" ><?= $order['tanggal_order']?></td>
                    <td class="riwayat" ><?= $order['total_order']?></td>
                    <td class="riwayat" ><?= $order['no_rekening'] ?></td>
                    <td class="riwayat" ><?= $order['nama_bank']?></td>
                    <td class="riwayat" ><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td> <!-- jika status 0 maka belum dibayar dan jika 1 maka sudah dibayar-->
                    <td class="riwayat" >
                        <div class="action">
                            <a class="btn-action" href="detail_transaksi.php?order=<?= $order['id_order']?>">Lihat Detail</a>
                            <?php if(!$order['status']):?>  <!-- jika status sudah dibayar maka tidak bisa di edit atau dibatalkan-->
                                <a class="btn-action" href="edit_pembayaran.php?id=<?= $order['id_order']?>">Ubah Pembayaran</a>
                                <a class="btn-action" href="hapus_transaksi.php?id=<?= $order['id_order']?>">Batalkan</a>
                                <?php endif?>
                            </div>
                    </td>
                </tr>
            <?php endforeach?>
        </table>
    </div>
</div>

<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>
