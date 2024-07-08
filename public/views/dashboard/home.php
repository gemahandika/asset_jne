<?php
include '../../header.php';
$date = date("Y-m-d");
$time = date("H:i");
?>

<div class="container">
    <div class="page-inner">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <form action="index" method="get">
                        <div class="card-head-row">
                            <div class="form-group">
                                <div class="input-icon ">
                                    <input type="date" class="form-control" name="dari" value="<?= $date ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-icon ">
                                    <input type="date" class="form-control" name="ke" value="<?= $date ?>" />
                                </div>
                            </div>
                            <button class="btn btn-secondary">
                                <span class="btn-label">
                                    <i class="fa fa-search"></i>
                                </span>
                                Search
                            </button>
                            <div class="card-tools">
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
                                    <h4 class="card-title">1,294</h4>
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
                                    <h4 class="card-title">1303</h4>
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
                                    <h4 class="card-title">1,345</h4>
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
        </div>
    </div>
</div>

<?php
include '../../footer.php'
?>