<!-- Start container-kanan -->
<div class="container-kanan">

    <!-- Start Header -->
    <header>
        <div class="dashboard">
            <span style="color:green; font-weight:bold;">Admin</span>
            <p>Dashboard</p>
        </div>
        <div class="profil">
            <p><?= $_SESSION['username']; ?></p>
            <img src="<?= BASEURL ;?>/assets/img/admin-icon.png" alt="icon-profil" class="icon-profil">
        </div>
    </header>
    <!-- End Header -->