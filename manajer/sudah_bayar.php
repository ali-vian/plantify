<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}
require_once('../base.php');

$title = "Sudah Bayar";
require_once('../base.php');
require_once(BASEPATH . "/manajer/templates/sidebar.php");

$errors = array();

if(isset($_POST['filter'])){
    $time1 = $_POST['time1'];
    $time2 = $_POST['time2'];

    if (empty($time1) || empty($time2)) {
        $errors['error'] = "waktu tidak boleh ada yang kosong";
    } else if ($time2 < $time1) {
        $errors['error'] = "waktu sampai tidak boleh kurang dari waktu mulai";
    } else {
        $errors['error'] = "";
    }

    if ($errors['error'] === "") {
        $orders = getAllOrderByStatusAndTime($_POST['time1'],$_POST['time2'],0);
    } else {
        $orders = getAllOrders(0);
    }
    
} else{
    $orders = getAllOrders(0);
}
?>

    <!-- start container-kanan -->
    <div class="container-kanan">        
        <div class="form-container">
            <p class="error"><?= $errors['error'] ?? "" ?></p>
            <form action="sudah_bayar.php" method="post">
                <label>Mulai dari : </label>
                <input type="datetime-local" name="time1" value="<?= isset($_POST['time1']) ? $_POST['time1'] :"" ?>">
                <label>Sampai : </label>
                <input type="datetime-local" name="time2" value="<?= isset($_POST['time2']) ? $_POST['time2'] :"" ?>">
                <input type="submit" name="filter" value="Filter">
            </form>
        </div>
        <div class="wadah">
            <h2>Grafik</h2>
            <div>
                <canvas id="myChart"></canvas>
            </div>
            
        </div>
        <div class="wadah">
            <h2>Rekap</h2>
            <table class="rekap">
                <tr>
                    <th>Tanggal Order</th>
                    <th>Username</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Status</th>
                </tr>
                <?php 
                $total = 0;
                $count = 0;
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['username']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                        <?php $total+= $order['total_order'];$count+=1; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <h2>Jumlah</h2>
            <table class="jumlah">
                <tr>
                    <th>Total Pelanggan</th>
                    <th>Jumlah pendapatan</th>
                </tr>
                <tr>
                    <td ><?= $count ?></td>
                    <td ><?= $total ?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- end container-kanan -->
</body>
<script src="<?= BASEURL ?>/manajer/node_modules/chart.js/dist/chart.umd.js"></script>      
<script>
    let lable = [];
    let datas= [];
    <?php foreach($orders as $order):?>
        lable.push("<?= $order['tanggal_order'] ?>");
        datas.push(<?= $order['total_order'] ?>);
    <?php endforeach?>
    const chart = document.getElementById('myChart');
    const data = {
        labels: lable,
        datasets: [{
            label: 'Sudah Bayar',
            data: datas,
            backgroundColor: [
            'rgba(0, 79, 68, 0.2)',
            ],
            borderColor: [
            'rgb(0, 79, 68)',
            ],
            borderWidth: 1,
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