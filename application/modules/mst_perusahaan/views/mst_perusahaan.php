<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Data Perusahaan</h4>
            <p class="text-muted mb-0">Kelola daftar perusahaan, asuransi, dan rekanan klinik.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Perusahaan
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fs-13 fw-bold text-muted">Cari Perusahaan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="ti ti-search text-muted"></i></span>
                        <input type="text" id="custom-search" class="form-control bg-light border-0 shadow-none"
                            placeholder="Ketik nama, id, atau nomor telepon perusahaan...">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary w-100 shadow-none" id="btn-apply-search">
                        <i class="ti ti-filter me-1"></i> Terapkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0 d-flex align-items-center">
                <i class="ti ti-building text-primary me-2 fs-20"></i> Daftar Perusahaan & Asuransi
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 datatable" id="table-perusahaan">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold" width="50">#</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Perusahaan</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Kontak & Alamat</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Jenis / NPWP</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold" width="120">Status</th>
                            <th class="border-0 pe-3 py-3 text-center text-muted fs-12 text-uppercase fw-bold"
                                width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($datalist as $dt): ?>
                            <tr>
                                <td class="ps-3 border-bottom border-light text-muted">
                                    <?= $no++ ?>
                                </td>
                                <td class="border-bottom border-light">
                                    <h6 class="mb-0 fs-14 fw-semibold text-dark">
                                        <?= $dt->name ?>
                                    </h6>
                                    <small class="text-muted fs-11">ID:
                                        <?= $dt->id_company ?>
                                    </small>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="fs-13 text-dark"><i class="ti ti-phone me-1 text-info"></i>
                                        <?= $dt->telp ?: '-' ?>
                                    </div>
                                    <div class="fs-11 text-muted"><i class="ti ti-map-pin me-1"></i>
                                        <?= $dt->address ?: '-' ?>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="mb-1"><span class="badge badge-soft-info text-info rounded-pill px-2">Tipe
                                            <?= $dt->id_type ?>
                                        </span></div>
                                    <div class="fs-11 text-muted">NPWP:
                                        <?= $dt->npwp ?: '-' ?>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <?php if ($dt->aktif == 1): ?>
                                        <span class="badge badge-soft-success rounded-pill px-3 py-2"><i
                                                class="ti ti-check me-1"></i>Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger rounded-pill px-3 py-2"><i
                                                class="ti ti-x me-1"></i>Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-3 text-center border-bottom border-light">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-sm btn-light shadow-none" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                                            <li><a class="dropdown-item py-2" href="javascript:void(0)"><i
                                                        class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit
                                                    Data</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"><i
                                                        class="ti ti-trash me-2 fs-16"></i> Hapus</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 py-3">
            <p class="text-muted fs-11 mb-0"><i class="ti ti-info-circle me-1 text-primary"></i> Data perusahaan ini
                akan digunakan dalam modul pendaftaran dan penagihan asuransi.</p>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
    $(document).ready(function () {
        if ($('.datatable').length > 0) {
            var table = $('.datatable').DataTable({
                destroy: true,
                dom: 'rtip',
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "next": '<i class="ti ti-chevron-right"></i>',
                        "previous": '<i class="ti ti-chevron-left"></i>'
                    }
                }
            });

            $('#custom-search').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('#btn-apply-search').on('click', function () {
                table.search($('#custom-search').val()).draw();
            });
        }
    });
</script>

<?php $this->theme->footer('theme_default'); ?>