<h3>Dashboard</h3>
<br/>

<?php
// Ambil data penjualan harian
$salesData = $lihat -> getSalesData();
$totalSalesToday = 0; // Variabel untuk total penjualan hari ini
foreach ($data as $row) {
    $salesData[] = [
        'tanggal' => $row['tanggal'],
        'total_jumlah' => (int)$row['total_jumlah'],
        'total_penjualan' => (float)$row['total_penjualan']
    ];
    
    // Hitung total penjualan hari ini
    if ($row['tanggal'] == date('Y-m-d')) {
        $totalSalesToday = (float)$row['total_penjualan'];
    }
}

// Jika ada rentang tanggal yang dipilih
if (isset($_POST['filter'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $sql = "SELECT DATE(tanggal_input) as tanggal, SUM(jumlah) as total_jumlah, SUM(total) as total_penjualan 
            FROM nota 
            WHERE DATE(tanggal_input) BETWEEN :start_date AND :end_date
            GROUP BY DATE(tanggal_input) 
            ORDER BY DATE(tanggal_input) ASC";

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
}
?>
    <!-- Form untuk filter tanggal -->
    <form method="POST" class="mb-4">
        <div class="form-row align-items-end">
            <div class="col align-items-end">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col align-items-end">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div>
                <div class="col align-items-end">
                    <button type="submit" name="filter" class="btn btn-primary">Sortir</button>
                    <a href="index.php" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </div>
    </form>

    <!-- Tombol sortir cepat -->
    <div class="mb-4">
        <button class="btn btn-info" onclick="setDateRange('today')">Hari Ini</button>
        <button class="btn btn-info" onclick="setDateRange('yesterday')">Kemarin</button>
        <button class="btn btn-info" onclick="setDateRange('last_week')">1 Minggu Terakhir</button>
        <button class="btn btn-info" onclick="setDateRange('last_3_weeks')">3 Minggu Terakhir</button>
        <button class="btn btn-info" onclick="setDateRange('last_month')">1 Bulan Terakhir</button>
    </div>

    <!-- Grafik Penjualan Harian -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan</h6>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data untuk grafik
    var salesData = {
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

    // Konfigurasi Chart
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: salesData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    time: {
                        unit: 'day'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: Math.ceil(<?php echo !empty($salesData) ? max(array_column($salesData, 'total_penjualan')) : 0; ?> / 1000) * 1000,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                        zeroLineColor: "rgba(0, 0, 0, .125)",
                        drawBorder: false
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
        }
    });

    // Fungsi untuk mengatur rentang tanggal
    function setDateRange(range) {
        const today = new Date();
        let startDate, endDate;

        switch (range) {
            case 'today':
                startDate = endDate = today.toISOString().split('T')[0];
                break;
            case 'yesterday':
                today.setDate(today.getDate() - 1);
                startDate = endDate = today.toISOString().split('T')[0];
                break;
            case 'last_week':
                startDate = new Date();
                startDate.setDate(today.getDate() - 7);
                endDate = today;
                break;
            case 'last_3_weeks':
                startDate = new Date();
                startDate.setDate(today.getDate() - 21);
                endDate = today;
                break;
            case 'last_month':
                startDate = new Date();
                startDate.setMonth(today.getMonth() - 1);
                endDate = today;
                break;
        }

        document.getElementById('start_date').value = startDate.toISOString().split('T')[0];
        document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
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
</div>