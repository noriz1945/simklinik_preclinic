<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Tindakan & Layanan</h4>
            <p class="text-muted mb-0">Kelola daftar tindakan medis, jasa sarana, dan tarif layanan.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Tindakan
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label class="form-label fs-13 fw-bold text-muted">Cari Tindakan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="ti ti-search text-muted"></i></span>
                        <input type="text" id="custom-search" class="form-control bg-light border-0 shadow-none"
                            placeholder="Ketik nama tindakan, grup, atau kode...">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary w-100 shadow-none" id="btn-apply-search">
                        <i class="ti ti-filter me-1"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 datatable">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold">Detail Tindakan</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Grup / Subgrup</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Type</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Status</th>
                            <th class="border-0 pe-3 py-3 text-center text-muted fs-12 text-uppercase fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datalist as $dt): ?>
                            <tr>
                                <td class="ps-3 border-bottom border-light">
                                    <h6 class="mb-0 fs-14 fw-semibold text-dark">
                                        <?= $dt->name ?>
                                    </h6>
                                    <small class="text-muted fs-11">ID:
                                        <?= $dt->id_act ?>
                                    </small>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="fs-13 text-dark">
                                        <?= $dt->grup ?: '-' ?>
                                    </div>
                                    <small class="text-muted fs-11">
                                        <?= $dt->subgrup ?: '-' ?>
                                    </small>
                                </td>
                                <td class="border-bottom border-light">
                                    <span class="badge bg-soft-info text-info fs-11 rounded">
                                        <?= $dt->type ?: 'General' ?>
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <span
                                        class="badge badge-soft-<?= $dt->aktif == 1 ? 'success' : 'danger' ?> rounded-pill px-3 py-2">
                                        <i class="ti ti-<?= $dt->aktif == 1 ? 'check' : 'x' ?> me-1"></i>
                                        <?= $dt->aktif == 1 ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                </td>
                                <td class="pe-3 text-center border-bottom border-light">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-sm btn-light shadow-none" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                                            <li><a class="dropdown-item py-2 edit-btn" href="javascript:void(0)"
                                                    data-id="<?= $dt->id_act ?>">
                                                    <i class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item py-2 text-<?= $dt->aktif == 1 ? 'danger' : 'success' ?>"
                                                    href="javascript:void(0)"
                                                    onclick="toggleAktif('<?= $dt->id_act ?>', '<?= htmlspecialchars($dt->name) ?>', '<?= $dt->aktif == 1 ? 'nonaktif' : 'aktif' ?>')">
                                                    <i class="ti ti-power me-2 fs-16"></i>
                                                    <?= $dt->aktif == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
    $(document).ready(function () {
        var table = $('.datatable').DataTable({ dom: 'rtip' });
        $('#custom-search').keyup(function () { table.search($(this).val()).draw(); });
        $('#btn-apply-search').click(function () { table.search($('#custom-search').val()).draw(); });
    });

    function toggleAktif(id, name, action) {
        Swal.fire({
            title: action == 'nonaktif' ? 'Nonaktifkan?' : 'Aktifkan?',
            text: name + " akan diubah statusnya.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "<?= base_url('mst/') ?>" + (action == 'nonaktif' ? 'deleteitempo_tindakan' : 'aktifasiitempo_tindakan');
                $.post(url, { id: id }, function () { location.reload(); });
            }
        });
    }
</script>
<?php $this->theme->footer('theme_default'); ?>