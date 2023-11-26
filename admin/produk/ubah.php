<?php 


require_once('../../base.php');     // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/validations.php");    // untuk menggunakan fungsi validasi

$id = isset($_POST['id_produk']) ? $_POST['id_produk'] : $_GET['id'];

$errors = array();
$success = false;

// ketika submit ditekan
if (isset($_POST['submit'])) {

    validasiTambahProduk($errors, $_POST);
    $gambarlama = $_POST['gambar_lama'];
    
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = uploadGambar($errors);
        unlink(BASEPATH."/assets/img/produk/".$gambarlama);
    }

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        $success = true;
    }

    if ($success && $gambar) {
        try{
            $stat = DB->prepare("UPDATE produk SET id_supplier = :id_supplier, nama_produk = :nama_produk, harga_produk = :harga_produk, stok_produk = :stok_produk, gambar_produk = :gambar_produk, id_kategori = :id_kategori WHERE id_produk = :id_produk");
            $stat->execute(array(
                ":id_produk" => $_POST['id_produk'],
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

$product = getProductById($id);     // mengambil data produk berdasarkan id
$categories  = getAllCategories();      // mengambil data kategori
$supplier = getAllDataSupplier();       // mengambil semua data supplier

?>

        <!-- start ubah produk -->
        <div class="wadah">
            <a href="<?= BASEURL ?>/admin/produk/">
                <button class="kembali">Kembali</button>
            </a>
            <div class="judul">
                <h2>Ubah Produk</h2>
            </div>
            <p class="error"><?= $errors['error'] ?? ''; ?></p>
            <?php if ($success): ?>
                <div>Produk berhasil diubah!</div>
            <?php else: ?>
                <!-- start form -->
                <form action="ubah.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $product['id_produk'] ?>" name="id_produk">
                    <input type="hidden" value="<?= $product['gambar_produk']; ?>" name="gambar_lama">
                    <!-- inputan nama produk -->
                    <div class="input-container">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="<?= htmlspecialchars($_POST['nama_produk'] ?? $product['nama_produk']) ?>">
                    </div>
                    <!-- inputan harga produk -->
                    <div class="input-container">
                        <label for="harga">Harga Produk</label>
                        <input type="text" name="harga" id="harga" value="<?= htmlspecialchars($_POST['harga'] ?? $product['harga_produk']) ?>">
                    </div>
                    <!-- inputan stok produk -->
                    <div class="input-container">
                        <label for="stok">Stok Produk</label>
                        <input type="text" name="stok" id="stok" value="<?= htmlspecialchars($_POST['stok'] ?? $product['stok_produk']) ?>">
                    </div>
                    <!-- inputan kategori -->
                    <div class="input-container">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id_kategori']; ?>" 
                                <?= isset($_POST['kategori']) && $_POST['kategori'] == $category['id_kategori'] || $product['id_kategori'] === $category['id_kategori'] ? 'selected' : '' ?>
                                ><?= $category['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- inputan supplier -->
                    <div class="input-container">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier">
                            <?php foreach ($supplier as $supp): ?>
                                <option value="<?= $supp['id_supplier']; ?>"
                                <?= isset($_POST['supplier']) && $_POST['supplier'] == $supp['id_supplier'] || $product['id_supplier'] === $supp['id_supplier'] ? 'selected' : '' ?>
                                ><?= $supp['nama_supplier']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- inputan gambar -->
                    <div class="input-container">
                        <label for="gambar">Gambar : </label>
                        <img src="<?= BASEURL ?>\assets\img\produk\<?= $product['gambar_produk']; ?>" alt="gambar_produk" style="width:200px;">
                        <input type="file" name="gambar" id="gambar">
                    </div>
                    <!-- submit -->
                    <button type="submit" name="submit" class="submit">Ubah</button>
                </form>
                <!-- end form -->
            <?php endif; ?>
        </div>
        <!-- end ubah produk -->
    </div>
    <!-- end container-kanan -->

</body>
</html>