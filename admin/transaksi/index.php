<?php 

$title = "Konfirmasi Bayar";

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$pesanan =  getAllOrder();      // mengambil data semua pesanan

?>
    
        <!-- start konfirmasi -->
        <div class="wadah">
            <div class="judul">
                <h2>Konfirmasi Pembayaran</h2>
            </div>
            <!-- start table -->
            <table>
                <tr>
                    <th>Tanggal Order</th>
                    <th>Username</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Nama Bank</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($pesanan as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['username']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['nama_bank']?></td>
                        <td><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                        <td>
                            <?php if(!$order['status']==0) : ?>
                                <a class="hapus">Telah dikonfirmasi</a>
                            <?php else: ?>
                                <a href="<?= BASEURL ?>/admin/transaksi/ubah_status_bayar.php?id=<?= $order['id_order']; ?>" class="ubah">
                                    Konfirmasi
                                </a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end table -->
        </div>
        <!-- end konfirmasi -->
    </div>
    <!-- end container-kanan -->

</body>
</html>