<?php 
require_once("../base.php");
require_once(BASEPATH . "/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | <?= $title ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/styles/style_manajer.css"/>
    <link rel="icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= BASEURL ;?>/assets/img/favicon.ico" type="image/x-icon">
</head>
<body>

    <div class="sidebar">
        <div class="profil">
            <img src="<?= BASEURL ?>/assets/img/icon-profile.png" alt="profil">
            <div class="manajer">
                <span>Manajer</span>
                <p><?= $_SESSION['username']; ?></p>
            </div>
        </div>
        <div class="menu-container">
            <div class="menu"> 
                <a href="<?= BASEURL ?>/manajer/index.php" class="<?= $title === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= BASEURL ?>/manajer/belum_bayar.php" class="<?= $title === 'Belum Bayar' ? 'active' : '' ?>">Belum Bayar</a>
                <a href="<?= BASEURL ?>/manajer/sudah_bayar.php" class="<?= $title === 'Sudah Bayar' ? 'active' : '' ?>">Sudah Bayar</a>
            </div> 
        </div>
        <a href="<?= BASEURL ?>/logout.php">Logout</a>
    </div>