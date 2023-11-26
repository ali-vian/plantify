<?php 
session_start();
/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'customer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");// untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/database.php"); // menghubungkan dengan file database.php untuk mendapatkan function SQL
require_once(BASEPATH . "/validations.php");

$order = getOrderbyId($_SESSION['username'],$_GET['id']);   //medapatkan data order dari id 
$banks = getAllBank();  //mendapatkan data semua bank

if($order['status']){   //jika status sudah dibayar maka tidak boleh diedit arahkan kembali
    header("Location: daftar_transaksi.php");   
}

if(isset($_POST['edit'])){ //jika customer menekan edit maka melalukan validasi inputan

    $no_rekening = htmlspecialchars($_POST['rek']); //mengamankan dari script injection
    validateRekening($errors, $no_rekening); //validasi rekening
    
    $cek = "";  //pengecekan jika ada error
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {  //jika tidak ada maka update pembayaran
        updateOrder($_POST['bank'] , $_POST['rek'] ,$_GET['id']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style.css">
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>    
    <div class="form-container">
        <!-- form edit pembayaran-->
        <form action="edit_pembayaran.php?id=<?= $_GET['id']?>" method="post">
            <label for="bank">BANK</label>
            <select name="bank" id="bank">
                <?php foreach($banks as $bank ) : ?> <!-- perulangan untuk mendapatkan bank -->
                    <option value="<?= $bank['id_bank'] ?>" 
                    <?= (isset($_POST['bank']) && $_POST['bank'] == $bank['id_bank']) || $order['id_bank'] == $bank['id_bank'] ? 'selected' : ''  ?><?= $bank['nama_bank'] ?>
                    </option> <!-- jika ada post atau order yang sama dengan id bank  maka selected -->
                <?php endforeach ?>
            </select>
            <div class="input-container">
                <label for="rek">No Rekening</label>
                <span class="error" style="color:red;"><?= $errors["rek"] ?? '' ?></span>  
                <input type="text" id="rek" name="rek" value="<?= htmlspecialchars($_POST['rek'] ?? $order['no_rekening']) ?>">
            </div>
            <a href="daftar_transaksi.php" class="btn">Batal</a>
            <button type="submit" name="edit">Edit</button>
        </form>
    </div>
</body>
</html>