<?php 

require 'validations.php';

session_start();

if (!isset($_SESSION['roles'])) {
    header('Location: register_role.php');
    exit();
}

$roles = $_SESSION['roles'];

$errors = array();
$success = false;

if (isset($_POST['register'])) {
    // mengambil inputan user
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if ($roles === "admin" || $roles === "manajer") {
        // validasi inputan
        validateUsername($errors, $username);
        validatePassword($errors, $password);
        validateConfirmPassword($errors, $password, $password2);
    } else {    
        // mengambil inputan customer
        $nama = htmlspecialchars($_POST['nama']);
        $tel = htmlspecialchars($_POST['tel']);
        $add = htmlspecialchars($_POST['address']);

        // validasi inputan
        validateUsername($errors, $username);
        validatePassword($errors, $password);
        validateConfirmPassword($errors, $password, $password2);
        validateNama($errors, $nama);
        validateTel($errors, $tel);
        validateAlamat($errors, $add);
    }

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        $success = true;
    }

    if ($success) {
        // menambahkan data ke tabel sesuai role
        if ($roles === "admin" || $roles === "manajer") {
            $statement = DB->prepare("INSERT INTO $roles VALUES (:username, SHA2(:password, 0))");
            $statement->execute(array(":username" => $username, ":password" => $password));
        } else {
            $statement = DB->prepare("INSERT INTO $roles VALUES (:username, SHA2(:password, 0), :nama, :no_telepon, :alamat)");
            $statement->execute(array(":username" => $username, ":password" => $password, ":nama" => $nama, ":no_telepon" => $tel, ":alamat" => $add));
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style.css">
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <div class="form-container">

        <!-- jika sukses tampilkan terima kasih dan button login ke halaman login -->
        <?php if ($success) { ?>

            <div class="thx">
                <h2>Registrasi Berhasil!</h2>
                <a href="index.php" class="btn">Login</a>
            </div>

        <!-- jika tidak sukses tetap di bagian registrasi -->
        <?php } else { ?>
            <form action="register_id.php" method="post">

                <h2>Register Now</h2>

                <!-- form register admin atau manajer -->
                <?php if ($roles === "admin" || $roles === "manajer") { ?>

                    <!-- inputan-start -->
                    <div class="input-container">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $_POST["username"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["username"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo $_POST["password"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["password"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="password2">Konfirmasi Password</label>
                        <input type="password" id="password2" name="password2" value="<?php echo $_POST["password2"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["password2"] ?? '' ?></span>
                    </div>
                    <!-- inputan-end -->

                <!-- form register customer -->
                <?php } else { ?>

                    <!-- inputan-start -->
                    <div class="input-container">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="="<?php echo $_POST["password2"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["username"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo $_POST["password"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["password"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="password2">Konfirmasi Password</label>
                        <input type="password" id="password2" name="password2" value="<?php echo $_POST["password2"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["password2"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $_POST["nama"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["nama"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="tel">Nomor Telepon</label>
                        <input type="text" id="tel" name="tel" value="<?php echo $_POST["tel"] ?? '' ?>">
                        <span class="error-msg"><?php echo $errors["tel"] ?? '' ?></span>
                    </div>
                    <div class="input-container">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" rows="1"><?php echo $_POST["address"] ?? '' ?></textarea>
                        <span class="error-msg"><?php echo $errors["address"] ?? '' ?></span>
                    </div>
                    <!-- inputan-end -->

                <?php } ?>

                <a href="register_role.php" class="btn">Kembali</a>
                <button type="submit" name="register">Register</button>

            </form>
        <?php } ?>
    </div>

</body>
</html>
