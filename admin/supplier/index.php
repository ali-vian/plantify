<?php 

$title = "Supplier";

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$supplier = getAllDataSupplier();   // mengambil semua data supplier

?>
    
        <!-- start supplier -->
        <div class="wadah">
            <div class="judul">
                <h2>Supplier</h2>
            </div>
            <!-- start table -->
            <table>
                <tr>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($supplier as $sup): ?>
                    <tr>
                        <td><?= $sup['nama_supplier']; ?></td>
                        <td><?= $sup['no_telepon']; ?></td>
                        <td><?= $sup['alamat']; ?></td>
                        <td>
                            <div class="button-container">
                                <a href="<?= BASEURL ?>/admin/supplier/ubah.php?id=<?= $sup['id_supplier']; ?>">
                                    <button class="ubah">Ubah</button>
                                </a>
                                <a href="hapus.php?id=<?= $sup['id_supplier']; ?>">
                                    <button class="hapus">Hapus</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end table -->
            <a href="<?= BASEURL ?>/admin/supplier/tambah.php">
                <button class="tambah">Tambahkan Supplier Baru</button>
            </a>
        </div>
        <!-- end supplier -->
    </div>
    <!-- end container-kanan -->

</body>
</html>