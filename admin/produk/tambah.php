<?php 

require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/validations.php");    // untuk menggunakan fungsi validasi

$errors = array();
$success = false;

// ketika submit ditekan
if (isset($_POST['submit'])) {

    $gambar = uploadGambar($errors);        // berisi nama gambar jika tidak ada error
    validasiTambahProduk($errors, $_POST);

    $stat = DB->prepare("SELECT nama_produk FROM produk WHERE nama_produk = :nama_produk");
    $stat->execute(array(":nama_produk" => htmlspecialchars($_POST['nama_produk'])));

    if ($stat->rowCount() > 0) {
        $errors['error'] = "Nama produk sudah ada";
    }

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        $success = true;
    }
    // cek apakah success dan gambar tidak false
    if ($success && $gambar) {
        try{
            $stat = DB->prepare("INSERT INTO produk (id_supplier,nama_produk,harga_produk,stok_produk,gambar_produk,id_kategori) VALUES (:id_supplier,:nama_produk,:harga_produk,:stok_produk,:gambar_produk,:id_kategori)");
            $stat->execute(array(
                ":id_supplier" => $_POST['supplier'],
                ":nama_produk" => $_POST['nama_produk'],
                ":harga_produk" => $_POST['harga'],
                ":stok_produk" => $_POST['stok'],
                ":gambar_produk" => $gambar,
                ":id_kategori" => $_POST['kategori']));
            move_uploaded_file($_FILES["gambar"]["tmp_name"], BASEPATH . "/assets/img/produk/" . $gambar);
        } catch (PDOException $err) {
            echo $err->getMessage(); 
        }
    }
}

$title = "Produk";

require_once(BASEPATH . "/admin/templates/sidebar.php");
require_once(BASEPATH . "/admin/templates/header.php");

$products = getAllDataProducts();   // mengambil semua data produk
$categories  = getAllCategories();  // mengambil semua data kategori
$supplier = getAllDataSupplier();   // mengambil semua data supplier

?>

        <!-- start tambah produk -->
        <div class="wadah">
            <a href="<?= BASEURL ?>/admin/produk/" class="kembali">
                Kembali
            </a>
            <div class="judul">
                <h2>Tambah Produk</h2>
            </div>
            <p class="error"><?= $errors['error'] ?? ''; ?></p>
            <?php if ($success): ?>
                <div>Produk sukses ditambahkan!</div>
            <?php else: ?>
                <!-- start form -->
                <form action="tambah.php" method="post" enctype="multipart/form-data">
                    <!-- inputan nama produk -->
                    <div class="input-container">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="<?php echo htmlspecialchars($_POST["nama_produk"] ?? '') ?>">
                    </div>
                    <!-- inputan harga produk -->
                    <div class="input-container">
                        <label for="harga">Harga Produk</label>
                        <input type="text" name="harga" id="harga" value="<?php echo htmlspecialchars($_POST["harga"] ?? '') ?>">
                    </div>
                    <!-- inputan stok produk -->
                    <div class="input-container">
                        <label for="stok">Stok Produk</label>
                        <input type="text" name="stok" id="stok" value="<?php echo htmlspecialchars($_POST["stok"] ?? '') ?>">
                    </div>
                    <!-- inputan kategori -->
                    <div class="input-container">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori">
                            <?php for($i = -1; $i < count($categories); $i++): ?>
                                <option value="<?= $i == -1 ? '0' : $categories[$i]['id_kategori']; ?>" <?= ($i != -1 && isset($_POST["kategori"]) && $_POST["kategori"] == $categories[$i]['id_kategori']) ? 'selected' : ''; ?>>
                                    <?= $i == -1 ? '--pilih kategori--' : $categories[$i]['nama_kategori']; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <!-- inputan supplier -->
                    <div class="input-container">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier">
                            <?php for($i = -1; $i < count($supplier); $i++): ?>
                                <option value="<?= $i == -1 ? '0' : $supplier[$i]['id_supplier']; ?>" <?= ($i != -1 && isset($_POST ["supplier"]) && $_POST["supplier"] == $supplier[$i]['id_supplier']) ? 'selected' : ''; ?>>
                                    <?= $i == -1 ? '--pilih supplier--' : $supplier[$i]['nama_supplier']; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <!-- inputan gambar -->
                    <div class="input-container">
                        <label for="gambar">Gambar : </label>
                        <input type="file" name="gambar" id="gambar">
                    </div>
                    <!-- submit -->
                    <button type="submit" name="submit" class="submit">Tambahkan</button>
                </form>
                <!-- end form -->
            <?php endif; ?>
        </div>
        <!-- end tambah produk -->
    </div>
    <!-- end container-kanan -->

</body>
</html>