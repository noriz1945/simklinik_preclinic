<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Ringkasan Dashboard</h4>
            <p class="text-muted mb-0">Selamat datang kembali, <strong><?php echo @$this->session->userdata['sp']->name; ?></strong>.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-white border shadow-sm dropdown-toggle d-inline-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <i class="ti ti-calendar-event me-1"></i> <?php echo date('d M Y'); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                    <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                    <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                </ul>
            </div>
            <button class="btn btn-primary d-inline-flex align-items-center">
                <i class="ti ti-plus me-1"></i> Registrasi Baru
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <!-- New Patient -->
        <div class="col-xl-3 col-sm-6 d-flex">
            <div class="card shadow-sm border-0 border-start border-primary border-4 flex-fill mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fs-13 mb-1">Pasien Baru</p>
                            <h3 class="fw-bold mb-0"><?php echo number_format(rand(10, 50)); ?></h3>
                        </div>
                        <div class="avatar avatar-md bg-soft-primary text-primary rounded-circle shadow-sm">
                            <i class="ti ti-user-plus fs-20"></i>
                        </div>
                    </div>
                    <div class="mt-3 fs-12">
                        <span class="text-success"><i class="ti ti-trending-up"></i> 12%</span> <span class="text-muted">vs kemarin</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Arrivals -->
        <div class="col-xl-3 col-sm-6 d-flex">
            <div class="card shadow-sm border-0 border-start border-success border-4 flex-fill mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fs-13 mb-1">Total Kunjungan</p>
                            <h3 class="fw-bold mb-0"><?php echo number_format(rand(100, 200)); ?></h3>
                        </div>
                        <div class="avatar avatar-md bg-soft-success text-success rounded-circle shadow-sm">
                            <i class="ti ti-checkup-list fs-20"></i>
                        </div>
                    </div>
                    <div class="mt-3 fs-12">
                        <span class="text-success"><i class="ti ti-trending-up"></i> 5%</span> <span class="text-muted">vs kemarin</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending -->
        <div class="col-xl-3 col-sm-6 d-flex">
            <div class="card shadow-sm border-0 border-start border-warning border-4 flex-fill mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fs-13 mb-1">Antrian Poli</p>
                            <h3 class="fw-bold mb-0"><?php echo number_format(rand(5, 15)); ?></h3>
                        </div>
                        <div class="avatar avatar-md bg-soft-warning text-warning rounded-circle shadow-sm">
                            <i class="ti ti-clock fs-20"></i>
                        </div>
                    </div>
                    <div class="mt-3 fs-12 text-muted">
                        Pasien menunggu dilayani
                    </div>
                </div>
            </div>
        </div>
        <!-- Revenue -->
        <div class="col-xl-3 col-sm-6 d-flex">
            <div class="card shadow-sm border-0 border-start border-info border-4 flex-fill mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fs-13 mb-1">Estimasi Billing</p>
                            <h3 class="fw-bold mb-0">IDR <?php echo number_format(rand(2000, 5000)); ?>K</h3>
                        </div>
                        <div class="avatar avatar-md bg-soft-info text-info rounded-circle shadow-sm">
                            <i class="ti ti-cash fs-20"></i>
                        </div>
                    </div>
                    <div class="mt-3 fs-12 text-success fw-bold">
                        <i class="ti ti-circle-check"></i> Daily target hit!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Stats / Chart -->
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill shadow-sm border-0 mb-4">
                <div class="card-header border-0 bg-transparent py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title fw-bold mb-0 text-dark">Statistik Kunjungan Mingguan</h5>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="#"><i class="ti ti-download me-1"></i> Download Report</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ti ti-refresh me-1"></i> Refresh Data</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="visit-chart" style="min-height: 300px;">
                        <!-- ApexCharts will render here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Patients List -->
        <div class="col-xl-4 d-flex">
            <div class="card flex-fill shadow-sm border-0 mb-4">
                <div class="card-header border-0 bg-transparent py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title fw-bold mb-0 text-dark">Pasien Terakhir</h5>
                    <a href="#" class="text-primary fs-12 fw-bold">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-center align-middle mb-0">
                            <tbody>
                                <?php
                                $names = ['Budi Santoso', 'Siti Aminah', 'Andi Wijaya', 'Siska Putri', 'Rahmat Hidayat'];
                                $polis = ['Poli Umum', 'Poli Gigi', 'KIA', 'Farmasi', 'Laboratorium'];
                                $avatars = ['BS', 'SA', 'AW', 'SP', 'RH'];
                                for($i=0; $i<5; $i++):
                                ?>
                                <tr style="cursor: pointer;">
                                    <td class="border-0 ps-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-soft-primary text-primary rounded me-3 fs-12 fw-bold d-flex align-items-center justify-content-center">
                                                <?php echo $avatars[$i]; ?>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fs-14 fw-bold text-dark"><?php echo $names[$i]; ?></h6>
                                                <span class="text-muted fs-11">#REG-0<?php echo rand(100,999); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end border-0 pe-3">
                                        <span class="badge badge-soft-dark fs-10 mb-1 d-block w-fit ms-auto"><?php echo $polis[$i]; ?></span>
                                        <div class="text-muted fs-11"><i class="ti ti-clock-hour-4 me-1"></i>10:<?php echo rand(10,50); ?></div>
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center py-3">
                     <p class="text-muted fs-11 mb-0">Terakhir diperbarui: Just now</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-primary text-white overflow-hidden" style="background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%) !important;">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="fw-bold mb-2">Butuh bantuan menggunakan SimKlinik?</h4>
                            <p class="mb-0 opacity-75">Panduan pengguna kini tersedia dalam versi PDF dan Video Tutorial. Maksimalkan fitur klinik Anda sekarang!</p>
                            <div class="mt-3">
                                <a href="#" class="btn btn-warning btn-sm fw-bold shadow-sm p-2 px-3">Buka Panduan</a>
                            </div>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block opacity-25">
                            <i class="ti ti-help-circle" style="font-size: 80px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
$(document).ready(function() {
    if($('#visit-chart').length > 0) {
        var options = {
            series: [{
                name: 'Kunjungan',
                data: [45, 60, 48, 70, 65, 120, 110]
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            colors: ['#3b82f6'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 5,
            },
            xaxis: {
                categories: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    style: { colors: '#a1a1a1' }
                }
            },
            tooltip: { 
                theme: 'light',
                x: { show: true } 
            },
        };

        var chart = new ApexCharts(document.querySelector("#visit-chart"), options);
        chart.render();
    }
});
</script>

<?php $this->theme->footer("theme_default"); ?>
