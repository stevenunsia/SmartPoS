<h3>Dashboard</h3>
<br/>

<?php
// Query untuk data hari ini
$sql = "SELECT DATE(tanggal_input) AS tanggal, 
               SUM(CAST(jumlah AS UNSIGNED)) AS total_jumlah, 
               SUM(CAST(total AS UNSIGNED)) AS total_penjualan 
        FROM nota 
        WHERE DATE(tanggal_input) = CURDATE() 
        GROUP BY DATE(tanggal_input) 
        ORDER BY tanggal ASC;";

// Eksekusi query
$stmt = $config->query($sql);
$salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$startDate = date('Y-m-d');
$endDate = date('Y-m-d');
$totalSalesToday = 0;
$data = [];
foreach ($salesData as $row) {
    $data[] = [
        'tanggal' => $row['tanggal'],
        'total_jumlah' => (int)$row['total_jumlah'],
        'total_penjualan' => (float)$row['total_penjualan']
    ];

    if ($row['tanggal'] == date('Y-m-d')) {
        $totalSalesToday = (float)$row['total_penjualan'];
    }
}

// Jika ada rentang tanggal yang dipilih
if (isset($_POST['filter'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    if (!empty($startDate) && !empty($endDate) && strtotime($startDate) <= strtotime($endDate)) {

        $sql = "SELECT 
                    DATE(tanggal_input) AS tanggal, 
                    SUM(CAST(jumlah AS UNSIGNED)) AS total_jumlah, 
                    SUM(CAST(total AS UNSIGNED)) AS total_penjualan 
                FROM nota 
                WHERE DATE(tanggal_input) BETWEEN :start_date AND :end_date 
                GROUP BY DATE(tanggal_input) 
                ORDER BY DATE(tanggal_input) ASC;
            ";

        $stmt = $config->prepare($sql);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $salesData = [];
        foreach ($data as $row) {
            $salesData[] = [
                'tanggal' => $row['tanggal'],
                'total_jumlah' => (int)$row['total_jumlah'],
                'total_penjualan' => (float)$row['total_penjualan']
            ];
        }
    } else {
        echo "<script>alert('Tanggal tidak valid');</script>";
    }
}
?>
    <!-- Form untuk filter tanggal -->
    <!-- Form untuk filter tanggal -->
<form method="POST" action="index.php" class="mb-4">
    <div class="form-row align-items-end">
        <div class="col align-items-end">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="<?=$startDate?>"required>
        </div>
        <div class="col align-items-end">
            <label for="end_date">Tanggal Akhir</label>
            <input type="date" name="end_date" id="end_date" value="<?=$endDate?>" class="form-control" required>
        </div>
        <div>
            <div class="col align-items-end">
                <button type="submit" id="jalanin" name="filter" class="btn btn-primary">Sortir</button>
                <a href="index.php" class="btn btn-danger">Reset</a>
            </div>
        </div>
    </div>

    <!-- Tombol sortir cepat dengan auto-submit -->

</form>

<div class="mb-4">
    <button type="button" class="btn btn-info" onclick="setDateRange('today'); return false;">Hari Ini</button>
    <button type="button" class="btn btn-info" onclick="setDateRange('yesterday'); return false;">Kemarin</button>
    <button type="button" class="btn btn-info" onclick="setDateRange('last_week'); return false;">1 Minggu Terakhir</button>
    <button type="button" class="btn btn-info" onclick="setDateRange('last_3_weeks'); return false;">3 Minggu Terakhir</button>
    <button type="button" class="btn btn-info" onclick="setDateRange('last_month'); return false;">1 Bulan Terakhir</button>
    <button type="button" class="btn btn-info" onclick="setDateRange('last_year'); return false;">1 Tahun Terakhir</button>
</div>

    

<div class="row">
    <!-- Grafik Penjualan Harian (Kiri) -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartPenjualan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Jumlah Barang (Kanan) -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Grafik Jumlah Barang</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartJumlah"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data untuk grafik penjualan
    var salesDataPenjualan = {
        labels: <?php echo json_encode(array_column($salesData, 'tanggal')); ?>,
        datasets: [{
            label: "Total Penjualan",
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(255, 255, 255, 0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(255, 255, 255, 1)",
            data: <?php echo json_encode(array_column($salesData, 'total_penjualan')); ?>
        }]
    };

    // Data untuk grafik jumlah barang
    var salesDataJumlah = {
        labels: <?php echo json_encode(array_column($salesData, 'tanggal')); ?>,
        datasets: [{
            label: "Total Jumlah Barang",
            backgroundColor: "rgba(28, 200, 138, 0.05)",
            borderColor: "rgba(28, 200, 138, 1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(28, 200, 138, 1)",
            pointBorderColor: "rgba(255, 255, 255, 0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
            pointHoverBorderColor: "rgba(255, 255, 255, 1)",
            data: <?php echo json_encode(array_column($salesData, 'total_jumlah')); ?>
        }]
    };

    // Konfigurasi Chart Penjualan
    var ctxPenjualan = document.getElementById("myAreaChartPenjualan");
    var myLineChartPenjualan = new Chart(ctxPenjualan, {
        type: 'line',
        data: salesDataPenjualan,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    time: { unit: 'day' },
                    gridLines: { display: false },
                    ticks: { maxTicksLimit: 6 }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.ceil(<?php echo !empty($salesData) ? max(array_column($salesData, 'total_penjualan')) : 0; ?> / 1000) * 1000,
                        maxTicksLimit: 5
                    },
                    gridLines: { color: "rgba(0, 0, 0, .125)" }
                }]
            },
            legend: { display: true },
            tooltips: { mode: 'index', intersect: false }
        }
    });

    // Konfigurasi Chart Jumlah Barang
    var ctxJumlah = document.getElementById("myAreaChartJumlah");
    var myLineChartJumlah = new Chart(ctxJumlah, {
        type: 'line',
        data: salesDataJumlah,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    time: { unit: 'day' },
                    gridLines: { display: false },
                    ticks: { maxTicksLimit: 6 }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.ceil(<?php echo !empty($salesData) ? max(array_column($salesData, 'total_jumlah')) : 0; ?> / 100) * 100,
                        maxTicksLimit: 5
                    },
                    gridLines: { color: "rgba(0, 0, 0, .125)" }
                }]
            },
            legend: { display: true },
            tooltips: { mode: 'index', intersect: false }
        }
    });


    // Fungsi untuk mengatur rentang tanggal
    function setDateRange(range) {
        const today = new Date();
        let startDate, endDate;

        switch (range) {
            case 'today':
                startDate = endDate = today;
                break;
            case 'yesterday':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 1);
                endDate = new Date(startDate);
                break;
            case 'last_week':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 7);
                endDate = new Date(today);
                break;
            case 'last_3_weeks':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 21);
                endDate = new Date(today);
                break;
            case 'last_month':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 1);
                startDate.setDate(1);
                endDate = new Date(today);
                break;
            case 'last_year':
                startDate = new Date(today.getFullYear() - 1, 0, 1);
                endDate = new Date(today.getFullYear() - 1, 11, 31);
                break;
            default:
                console.error("Invalid range provided");
                return;
        }

        // Set input values
        document.getElementById('start_date').value = startDate.toISOString().split('T')[0];
        document.getElementById('end_date').value = endDate.toISOString().split('T')[0];

        // Klik tombol "Sortir" setelah tanggal diatur
        document.getElementById('jalanin').click();
    }

</script>

<?php 
	$sql=" select * from barang where stok <= 3";
	$row = $config -> prepare($sql);
	$row -> execute();
	$r = $row -> rowCount();
	if($r > 0){
?>
<?php
		echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";	
	}
?>
<?php $hasil_barang = $lihat -> barang_row();?>
<?php $hasil_kategori = $lihat -> kategori_row();?>
<?php $stok = $lihat -> barang_stok_row();?>
<?php $jual = $lihat -> jual_row();?>
<?php $hasil_supplier = $lihat -> supplier_row();?>
<?php $hasil_pelanggan = $lihat -> pelanggan_row();?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Total Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href="index.php?page=barang&openModal=true">Tambah 
                    Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Total Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Data Master Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($jual['stok']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Data 
                    Laporan Penjualan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Kategori Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=kategori'>Data
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Data Supplier</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_supplier);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=supplier'>Data
                    Supplier <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->

    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-users"></i> Data Pelanggan</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_pelanggan);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=pelanggan'>Data
                    Pelanggan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>