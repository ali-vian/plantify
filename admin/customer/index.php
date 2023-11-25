<?php 

$title = "Customer";

require_once('../../base.php');    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$customers = getAllDataCustomer();  // mengambil semua data customer

?>

        <!-- start customer -->
        <div class="wadah"> 
            <div class="judul">
                <h2>Customer</h2>
            </div>
            <!-- start table -->
            <table>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['username']; ?></td>
                        <td><?= $customer['nama']; ?></td>
                        <td><?= $customer['no_telepon']; ?></td>
                        <td><?= $customer['alamat']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end table -->
        </div>
        <!-- end customer -->
    </div>
    <!-- end container-kanan -->

</body>
</html>