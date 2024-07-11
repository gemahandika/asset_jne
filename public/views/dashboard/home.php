<?php
include '../../header.php';
include '../../../app/models/Dashboard_models.php';
$date = date("Y-m-d");
$time = date("H:i");

?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fromDateInput = document.querySelector('input[name="dari"]');
        const thruDateInput = document.querySelector('input[name="ke"]');

        fromDateInput.addEventListener('change', () => {
            if (fromDateInput.value) {
                thruDateInput.min = fromDateInput.value;
            } else {
                thruDateInput.removeAttribute('min');
            }
        });

        thruDateInput.addEventListener('change', () => {
            if (thruDateInput.value < fromDateInput.value) {
                alert("Tidak Bisa Memilih Tanggal Sebelum Tanggal From");
                thruDateInput.value = '';
            }
        });
    });
</script>
<?php
// Mengambil parameter dari form (jika ada)
$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$ke = isset($_GET['ke']) ? $_GET['ke'] : '';
?>
<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="row card-head-row">
                            <div class="form-group col-md-3">
                                <div class="input-icon">
                                    <label for="">Date From :</label>
                                    <input type="date" class="form-control" name="dari" value="<?= htmlspecialchars($dari) ?>" />
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-icon">
                                    <label for="">Date Thru :</label>
                                    <input type="date" class="form-control" name="ke" value="<?= htmlspecialchars($ke) ?>" />
                                </div>
                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button class="btn btn-secondary">
                                    <span class="btn-label">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    Search
                                </button>
                                <a href="home.php" class="btn btn-label-warning btn-round">
                                    <span class="btn-label">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    Refresh
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Data Asset GA & IT</p>
                                    <a href="../asset/index.php">
                                        <h4 class="card-title"><?= $asset; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Maintenance GA</p>
                                    <a href="../maintenance/index.php">
                                        <h4 class="card-title"><?= $maintenance_ga; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-laptop"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Maintenance IT</p>
                                    <a href="../maintenance/index.php">
                                        <h4 class="card-title"><?= $maintenance_it; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-trash"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Asset Destroy</p>
                                    <h4 class="card-title">576</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Data Asset</div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Data Asset</div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Echo data JSON ke dalam JavaScript
echo "<script>
        const dataAsset = $json_data_asset;
    </script>";
?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const ctx = document.getElementById('myChart').getContext('2d');

        // Data JSON dari PHP
        const dataAsset = <?php echo $json_data_asset; ?>;

        // Extract labels and data from JSON
        const labels = dataAsset.map(item => item.bulan);
        const data = dataAsset.map(item => item.jumlah_asset);

        // Generate random colors for each bar
        const backgroundColors = data.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`);
        const borderColors = data.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '# Data Assets',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const ctx = document.getElementById('myPieChart').getContext('2d');

        // Data JSON dari PHP
        const dataAsset = <?php echo $json_data; ?>;

        // Extract labels, data, background colors, and border colors from JSON
        const labels = dataAsset.map(item => item.label);
        const data = dataAsset.map(item => item.value);
        const backgroundColors = dataAsset.map(item => item.color);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: '# of Assets',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>


<?php
include '../../footer.php'
?>