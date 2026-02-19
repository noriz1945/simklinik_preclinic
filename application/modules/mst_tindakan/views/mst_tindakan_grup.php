<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Grup Tindakan</h4>
            <p class="text-muted mb-0">Kelola daftar grup tindakan untuk klasifikasi yang lebih baik.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Grup
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label class="form-label fs-13 fw-bold text-muted">Cari Grup</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="ti ti-search text-muted"></i></span>
                        <input type="text" id="custom-search" class="form-control bg-light border-0 shadow-none"
                            placeholder="Ketik nama grup atau ID...">
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
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold" width="60">ID</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Grup</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Deskripsi</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold text-center">Status</th>
                            <th class="border-0 pe-3 py-3 text-center text-muted fs-12 text-uppercase fw-bold"
                                width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datalist as $dt): ?>
                            <tr>
                                <td class="ps-3 border-bottom border-light text-muted fw-bold">
                                    <?= $dt->id_group ?>
                                </td>
                                <td class="border-bottom border-light">
                                    <h6 class="mb-0 fs-14 fw-semibold text-dark">
                                        <?= $dt->name ?>
                                    </h6>
                                </td>
                                <td class="border-bottom border-light text-muted fs-13">
                                    <?= $dt->description ?: '-' ?>
                                </td>
                                <td class="border-bottom border-light text-center">
                                    <span
                                        class="badge badge-soft-<?= $dt->active == 1 ? 'success' : 'danger' ?> rounded-pill px-3 py-2">
                                        <i class="ti ti-<?= $dt->active == 1 ? 'check' : 'x' ?> me-1"></i>
                                        <?= $dt->active == 1 ? 'Aktif' : 'Nonaktif' ?>
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
                                                    data-id="<?= $dt->id_group ?>"
                                                    data-name="<?= htmlspecialchars($dt->name) ?>"
                                                    data-desc="<?= htmlspecialchars($dt->description) ?>">
                                                    <i class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item py-2 text-<?= $dt->active == 1 ? 'danger' : 'success' ?>"
                                                    href="javascript:void(0)"
                                                    onclick="toggleAktif('<?= $dt->id_group ?>', '<?= htmlspecialchars($dt->name) ?>', '<?= $dt->active == 1 ? 'nonaktif' : 'aktif' ?>')">
                                                    <i class="ti ti-power me-2 fs-16"></i>
                                                    <?= $dt->active == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
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

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-square-rounded-plus me-2"></i> Tambah
                    Grup</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst/save_tindakan_grup') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Nama Grup</label>
                        <input type="text" class="form-control bg-light border-0 shadow-none" name="nama_grup" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Deskripsi</label>
                        <textarea class="form-control bg-light border-0 shadow-none" name="deskripsi"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-edit-circle me-2"></i> Edit Grup</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst/update_tindakan_grup') ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="id_group" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Nama Grup</label>
                        <input type="text" class="form-control bg-light border-0 shadow-none" name="nama_grup"
                            id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Deskripsi</label>
                        <textarea class="form-control bg-light border-0 shadow-none" name="deskripsi" id="edit_desc"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white px-4">Update</button>
                </div>
            </form>
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

        $('.edit-btn').click(function () {
            $('#edit_id').val($(this).data('id'));
            $('#edit_name').val($(this).data('name'));
            $('#edit_desc').val($(this).data('desc'));
            $('#modalEdit').modal('show');
        });
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
                var url = "<?= base_url('mst/') ?>" + (action == 'nonaktif' ? 'deleteitempo_tindakan_grup' : 'aktifasiitempo_tindakan_grup');
                $.post(url, { id: id }, function () { location.reload(); });
            }
        });
    }
</script>
<?php $this->theme->footer('theme_default'); ?>