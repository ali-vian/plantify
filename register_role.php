<?php 

require 'validations.php';

session_start();

$kode_ref = array("admin" => "123", "manajer" => "321");
$errors = array();

if (isset($_POST['next'])) {

    // mengambil inputan user 
    $roles = $_POST['roles'];
    $ref = htmlspecialchars($_POST['ref']);

    $_SESSION['roles'] = $roles;
    
    validateRef($errors, $ref, $roles, $kode_ref);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        header("Location: register_id.php");
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
        <form action="register_role.php" method="post">

            <h2>Register Now</h2>

            <!-- inputan-start -->
            <div class="input-container">
                <label for="roles">Pilih Role</label>
                <select name="roles" id="roles">
                    <option value="admin">Admin</option>
                    <option value="manajer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "manajer") ? "selected" : ''?>>Manajer</option>
                    <option value="customer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "customer") ? "selected" : ''?>>Customer</option>
                </select>
            </div>
            <div class="input-container">
                <label for="ref">Kode Refferal</label>
                <input type="password" name="ref" id="ref" value="<?php echo $_POST["ref"] ?? '' ?>">
                <span class="error-msg"><?php echo $errors["ref"] ?? '' ?></span>
                <span class="roles-note">*isi jika memilih admin atau manajer</span>
            </div>
            <!-- inputan-end -->

            <button type="submit" name="next">Selanjutnya</button>
            <p class="link">sudah punya akun? <a href="index.php">login now</a></p>

        </form>
    </div>

</body>
</html>
