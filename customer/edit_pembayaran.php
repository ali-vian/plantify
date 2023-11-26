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

$order = getOrderbyId($_SESSION['username'],$_GET['id']);
$banks = getAllBank();

if($order['status']){
    header("Location: daftar_transaksi.php");
}

if(isset($_POST['edit'])){

    $no_rekening = htmlspecialchars($_POST['rek']);
    validateRekening($errors, $no_rekening);
    
    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {  
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
</head>
<body>    
    <div class="form-container">
        <form action="edit_pembayaran.php?id=<?= $_GET['id']?>" method="post">
            <label for="bank">BANK</label>
            <select name="bank" id="bank">
                <?php foreach($banks as $bank ) : ?>
                    <option value="<?= $bank['id_bank'] ?>" <?= (isset($_POST['bank']) && $_POST['bank'] == $bank['id_bank']) 
                    || $order['id_bank'] == $bank['id_bank'] ? 'selected' : ''  ?> ><?= $bank['nama_bank'] ?></option>
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