<?php 

// untuk masuk ke halaman ini harus lewat tombol, jika lewat link url maka akan dilempar ke halaman index
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/validations.php");    // untuk menggunakan fungsi validasi

$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];

$errors = array();
$success = false;

// ketika submit ditekan
if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    validateTambahSupplier($errors, $_POST);

    if ($errors['error'] == "") {
        $success = true;
    }

    if ($success) {
        try{
            $stat = DB->prepare("UPDATE supplier SET nama_supplier = :nama_supplier, alamat = :alamat, no_telepon = :telepon WHERE id_supplier = :id_supplier");
            $stat = $stat->execute(array(
                ":id_supplier" => $id,
                ":nama_supplier" => $_POST['nama_supplier'],
                ":alamat" => $_POST['alamat'],
                ":telepon" => $_POST['tel']));
        } catch (PDOException $err) {
            echo $err->getMessage(); 
        }
    }
}

$title = "Supplier";

require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$supplier = getSupplierById($id);   // mengambil data supplier berdasarkan id

?>

        <!-- start ubah supplier -->
        <div class="wadah">
            <a href="<?= BASEURL ?>/admin/supplier/">
                <button class="kembali">Kembali</button>
            </a>
            <div class="judul">
                <h2>Ubah Supplier</h2>
            </div>
            <p class="error"><?= $errors['error'] ?? ''; ?></p>
            <?php if ($success): ?>
                <div>Supplier sukses diubah!</div>
            <?php else: ?>
                <!-- start form -->
                <form action="ubah.php" method="post">
                    <input type="hidden" value="<?= $supplier['id_supplier']; ?>" name="id">
                    <!-- inputan nama supplier -->
                    <div class="input-container">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" value="<?= $supplier['nama_supplier'] ?>">
                    </div>
                    <!-- inputan telepon supplier -->
                    <div class="input-container">
                        <label for="tel">Telepon Supplier</label>
                        <input type="text" name="tel" id="tel" value="<?= $supplier['no_telepon'] ?>">
                    </div>
                    <!-- inputan alamat supplier -->
                    <div class="input-container">
                        <label for="alamat">Alamat Supplier</label>
                        <input type="text" name="alamat" id="alamat" value="<?= $supplier['alamat'] ?>">
                    </div>
                    <!-- submit -->
                    <button type="submit" name="submit" class="submit">Ubah</button>
                </form>
                <!-- end form -->
            <?php endif; ?>
        </div>
        <!-- end ubah supplier -->
    </div>
    <!-- end container-kanan -->

</body>
</html>