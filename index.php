<?php 
session_start();

// cek apakah user sudah pernah login atau belum, jika sudah diarahkan ke page sesuai role
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
    header("Location: {$_SESSION['role']}/index.php");    
    exit();
}

require 'validations.php';

$errors = array();
$success = false;

if (isset($_POST['login'])) {
    // mengambil inputan user
    $username = $_POST['username'];
    $password = $_POST['password'];

    $role = validateLogin($errors, $username, $password);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    // cek apakah role tidak false
    if ($role) {

        $_SESSION["role"] = $role;
        $_SESSION['username'] = $username;
        $_SESSION["login"] = true;

        // arahkan ke halaman sesuai role
        header("Location: $role/index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style.css">
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <div class="form-container">
        <form action="index.php" method="post">

            <h2>Login Now</h2>

            <!-- inputan-start -->
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST["username"] ?? '') ?>">
                <span class="error-msg"><?php echo $errors["username"] ?? '' ?></span>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($_POST["password"] ?? '') ?>">
                <span class="error-msg"><?php echo $errors["password"] ?? '' ?></span>
            </div>
            <!-- inputan-end -->

            <button type="submit" name="login">Login</button>
            <p class="link">belum punya akun? <a href="register_role.php">register now</a></p>

        </form>
    </div>

</body>
</html>
