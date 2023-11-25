<?php

$title = "Keranjang";       // memberikan judul pada header
require_once("../base.php");    // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH."/customer/templates/header.php");     // mengabungkan dengan halaman header
require_once(BASEPATH.'/validations.php');      //digunakan untuk menggunakan fungsi validasi

$dataKeranjang = getKeranjang($_SESSION['username']);   // mendapatkan semua produk di keranjang customer tersebut
$dataDiri = getDataDiri($_SESSION['username']);     // mendapatkan data diri customer tersebut
$bank = getAllBank();       // mendapatkan semua data pada tabel bank
if(empty($dataKeranjang)){
    header("Location: keranjang.php"); // jika keranjang kosong maka arahkan ke keranjanng.php
}

$total = 0;
foreach ($dataKeranjang as $data) {
    $total += $data["harga_produk"] * $data["jml"];
}                            

if(isset($_POST['submit'])){       // cek apakah ada submit
    if(!isset($_POST['bank'])){          //cek apakah sudah memilih bank jika belum isi errors 
        $errors['bank'] = "Harap pilih pembayaran";
    }

    $no_rekening = htmlspecialchars($_POST['no_rekening']);     // untuk menghidari script injection
    validateRekening($errors, $no_rekening);     //validasi no rekening jika ada error maka variabel errors terisi
    $cek = "";
    foreach ($errors as $error) {       //masukkan error ke string cek 
        $cek .= $error;
    }
    
    if (strlen($cek) == 0) { //jika panjangnya 0 maka lakukan berikut 

        $id_keranjang = $dataKeranjang[0]['id_keranjang'];  //mendapatkan keranjang id
        $a = insertOrder($_SESSION['username'],$total,$_POST['no_rekening'],$_POST['bank'],$id_keranjang); //menambahkan dari keranjang ke order serta menghapus keeranjag
        foreach($dataKeranjang as $data)
        {                     //perulangan untuk menambahkan produk ke order_detail
            insertOrderDetail($a,$data['id_produk'],$data['jml'],$data['jml']*$data['harga_produk']);   
        }
        
        header("Location: ".BASEURL."/customer/daftar_transaksi.php?id=".$a); //diarahkan ke daftar transaksi
    }
}

?>
<div class="produk">
    <div class="judul">
        <h2>konfirmasi Pembayaran</h2>
    </div>
    <div class="card">
        <div class="produk">
            <h4>Alamat Pengiriman</h4>
            <div><b><?= $dataDiri['nama']?>  (<?= $dataDiri['no_telepon']?>)</b> <?= $dataDiri['alamat']?> <a href="edit_profile.php"><small class="jumlah-btn" >ubah</small></a></div>
        </div>
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
        <form action="konfirmasi_pembayaran.php" method="post" >
            <div class="form-konfirmasi bayar">
                <h4>Tipe Pembayaran</h4>
                <div class="tipe-pembayaran">
                <?php foreach($bank as $b) :  ?> 
                    <span>
                        <input name="bank" id="<?= $b['id_bank']?>" type="radio" value="<?= $b['id_bank'] ?>" <?= isset($_POST['bank'])&&$_POST["bank"]==$b['id_bank'] ? 'checked' : '' ?> >
                        <label for="<?= $b['id_bank'] ?>">Bank <?= $b['nama_bank'] ?></lable>
                    </span>
                <?php endforeach ?>
                </div>
                <small class="error"><?= $errors["bank"] ?? '' ?></small>
                <h4>No Rekening</h4>
                <input type="text" name="no_rekening" value="<?= $_POST['no_rekening'] ?? '' ?>">
                <small class="error"><?= $errors["rek"] ?? '' ?></small>
                <button class="btn-card" type="submit" name="submit">Pesan</button>
                <a href="keranjang.php">
                    <button class="kembali" type="button">Batalkan</button>
                </a>
            </div>
        </form>
    </div>
</div>

<?php
require_once('templates/footer.php'); // mengabungkan dengan halaman header
?>