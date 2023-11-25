<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Dashboard";
require_once('../base.php');
require_once(BASEPATH . "/manajer/templates/sidebar.php");
$kategoriStok = getAllCategoryStock();
?>

    <!-- start container-kanan -->
    <div class="container-kanan">
        <div class="wadah">
            <h2>Stok Produk</h2>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <!-- end container-kanan -->

</body>
<script src="<?= BASEURL ?>/manajer/node_modules/chart.js/dist/chart.umd.js"></script>
<script>
    let label = [];
    let datas = [];
    <?php foreach ($kategoriStok as $kat): ?>
        label.push("<?= $kat['nama_kategori'] ?>");
        datas.push(<?= $kat['stok'] ?>);
    <?php endforeach; ?>
    const backgroundColors = Array.from({ length: datas.length }, () => {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    });
    const chart = document.getElementById('myChart');
    const data = {
        labels : label,
        datasets: [{
            label: 'Stok Produk',
            data: datas,
            backgroundColor: backgroundColors,
            hoverOffset: 4
        }]
    };
    const config = {
        type: 'bar',
        data: data,
    };
    new Chart(chart, config);
</script>
</html>