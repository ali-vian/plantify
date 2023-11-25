<?php

$title = "Keranjang";       // memberikan judul pada header

require_once("../base.php");        //  mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH.'/validations.php');          // menggunakan fungsi validasi
require_once(BASEPATH."/customer/templates/header.php");     

$dataKeranjang = getKeranjang($_SESSION['username']);       // mendapatkan semua produk di keranjang customer tersebut
$dataDiri = getDataDiri($_SESSION['username']);     // mendapatkan data diri customer tersebut
$bank = getAllBank();       // mendapatkan semua data pada tabel bank

if(empty($dataKeranjang)){
    header("Location: keranjang.php");      // jika keranjang kosong maka arahkan ke keranjanng.php
}

$total = 0;
foreach ($dataKeranjang as $data) {
    $total += $data["harga_produk"] * $data["jml"];
}                            

// jika submit ditekan
if(isset($_POST['submit'])){       

    $no_rekening = htmlspecialchars($_POST['no_rekening']);     // untuk menghidari script injection
    validateTel($errors, $no_rekening);     //validasi no rekening jika ada error maka variabel errors terisi
    $cek = "";
    foreach ($errors as $error) {       //masukkan error ke string cek 
        $cek .= $error;
    }
    
    if (strlen($cek) == 0) {        //jika panjangnya 0 maka lakukan berikut 

        $id_keranjang = $dataKeranjang[0]['id_keranjang'];      //mendapatkan keranjang id
        $a = insertOrder($_SESSION['username'],$total,$_POST['no_rekening'],$_POST['bank'],$id_keranjang);      //menambahkan dari keranjang ke order serta menghapus keranjang

        foreach($dataKeranjang as $data)
        {                     //perulangan untuk menambahkan produk ke order_detail
            insertOrderDetail($a,$data['id_produk'],$data['jml'],$data['jml']*$data['harga_produk']);   
        }
        
        header("Location: ".BASEURL."/customer/daftar_transaksi.php?id=".$a);       //diarahkan ke daftar transaksi
    }
}

?>

<!-- start konfirmasi pembayaran -->
<div class="produk">
    <div class="judul">
        <h2>konfirmasi Pembayaran</h2>
    </div>
    <div class="container a">
        <div class="card kosong">
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
                <?php foreach ($dataKeranjang as $data ):?>
                    <tr>
                        <td>
                            <div class="produk-keranjang">
                                <img
                                class="img-keranjang"
                                src="<?= BASEURL ;?>/assets/img/produk/<?= $data['gambar_produk'] ?>"
                                alt="gambar produk"
                                />
                                <div class="caption">
                                    <h5><?= $data['nama_produk']?></h5>
                                    <small>Tersedia <?= $data['stok_produk']?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Rp. <?= number_format($data["harga_produk"], 0, ',', '.')?>,-</h5>
                        </td>
                        <td>
                            <h5 class="jml"><?=$data['jml']?> </h5>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            </table>
            <div class="total">
                <h4>Total Pembayaran</h4>
                <h4>Rp. <?= number_format($total, 0, ',', '.')?>,-</h4>
            </div>
        </div>
    </div>
    <!-- start form -->
    <form action="konfirmasi_pembayaran.php" method="post">
        <div class="card bayar">
            <div class="alamat">
                <div class="pengiriman"><h3>Alamat Pengiriman</h3></div>
                <div class="data-diri">
                    <div style="font-weight: bold;"><?= $dataDiri['nama']?> | <?= $dataDiri['no_telepon']?></div> 
                    <div><?= $dataDiri['alamat']?></div>
                    <a href="edit_profile.php">ubah</a>
                </div>
            </div>
            <div class="alamat">
                <div class="pengiriman"><h3>Metode Pembayaran</h3></div>
                <select name="bank" id="bank">
                    <?php foreach($bank as $b) :  ?> 
                        <option value="<?= $b['id_bank']; ?>" 
                        <?= isset($_POST['bank'])&&$_POST["bank"]==$b['id_bank'] ? 'selected' : '' ?>>
                        <?= $b['nama_bank'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="alamat">
                <div class="pengiriman"><h3>Nomor Rekening</h3></div>
                <span style="color: red;"><?= $errors["tel"] ?? '' ?></span>
                <input type="text" name="no_rekening" value="<?= $_POST['no_rekening'] ?? '' ?>">
            </div>
            <a href="keranjang.php" class="btn-card">
                Batalkan
            </a>
            <button class="btn-card" type="submit" name="submit">Pesan</button>
        </div>
    </form>
    <!-- end form -->
</div>
<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>