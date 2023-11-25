<?php 

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/validations.php");    // untuk menggunakan fungsi validasi

$errors = array();
$success = false;

// ketika submit ditekan
if (isset($_POST['submit'])) {

    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $tel = htmlspecialchars($_POST['tel']);
    $alamat = htmlspecialchars($_POST['alamat']);

    if (checkRequired($nama_supplier) || checkRequired($tel) || checkRequired($alamat)) {
        $errors['error'] = "data supplier tidak boleh ada yang kosong";
    } else {
        if (!checkAlphabet($nama_supplier)) {
            $errors['error'] = "nama supplier harus berupa alfabet";
        } else if (!checkNumeric($tel)) {
            $errors['error'] = "telepon supplier harus berupa numerik";
        } else if (strlen($tel) < 12) {
            $errors['error'] = "telepon tidak boleh  kurang dari 12 digit";
        } else {
            $errors['error'] = "";
        }
    }

    if ($errors['error'] == "") {
        $success = true;
    }

    if ($success) {
        try{
            $stat = DB->prepare("INSERT INTO supplier VALUES ('', :nama, :alamat, :telepon)");
            $stat = $stat->execute(array(
                ":nama" => $nama_supplier,
                ":alamat" => $alamat,
                ":telepon" => $tel));
        } catch (PDOException $err) {
            echo $err->getMessage(); 
        }
    }
}

$title = "Supplier";

require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

?>

        <!-- start tambah supplier -->
        <div class="wadah">
            <a href="<?= BASEURL ?>/admin/supplier/">
                <button class="kembali">Kembali</button>
            </a>
            <div class="judul">
                <h2>Tambah Supplier</h2>
            </div>
            <p class="error"><?= $errors['error'] ?? ''; ?></p>
            <?php if ($success): ?>
                <div>Supplier sukses ditambahkan!</div>
            <?php else: ?>
                <!-- start form -->
                <form action="tambah.php" method="post">
                    <!-- inputan nama supplier -->
                    <div class="input-container">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" value="<?php echo $_POST["nama_supplier"] ?? '' ?>">
                    </div>
                    <!-- inputan telepon supplier-->
                    <div class="input-container">
                        <label for="tel">Telepon Supplier</label>
                        <input type="text" name="tel" id="tel" value="<?php echo $_POST["tel"] ?? '' ?>">
                    </div>
                    <!-- inputan alamat supplier -->
                    <div class="input-container">
                        <label for="alamat">Alamat Supplier</label>
                        <input type="text" name="alamat" id="alamat" value="<?php echo $_POST["alamat"] ?? '' ?>">
                    </div>
                    <!-- submit -->
                    <button type="submit" name="submit" class="submit">Tambahkan</button>
                </form>
                <!-- end form -->
            <?php endif; ?>
        </div>
        <!-- end tambah supplier -->
    </div>
    <!-- end container-kanan -->

</body>
</html>