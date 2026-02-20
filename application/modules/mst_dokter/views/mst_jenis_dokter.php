<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Jenis Tenaga Kesehatan</h4>
            <p class="text-muted mb-0">Kelola kategori tenaga kesehatan seperti Dokter Umum, Perawat, atau Bidan.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Jenis
            </button>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fs-13 fw-bold text-muted">Cari Data</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="ti ti-search text-muted"></i></span>
                        <input type="text" id="custom-search" class="form-control bg-light border-0 shadow-none"
                            placeholder="Ketik nama jenis nakes...">
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
                <i class="ti ti-category text-primary me-2 fs-20"></i> Daftar Jenis Nakes
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 datatable">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold" width="50">#</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Jenis Nakes</th>
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
                                <td class="border-bottom border-light fw-semibold text-dark">
                                    <?= $dt->name ?>
                                </td>
                                <td class="border-bottom border-light">
                                    <?php if ($dt->status == 0): ?>
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
                                            <li><a class="dropdown-item py-2 edit-btn" href="javascript:void(0)"
                                                    data-id="<?= $dt->id_jenis ?>"
                                                    data-name="<?= htmlspecialchars($dt->name) ?>">
                                                    <i class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <?php if ($dt->status == 0): ?>
                                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"
                                                        onclick="toggleStatus('<?= $dt->id_jenis ?>', '<?= htmlspecialchars($dt->name) ?>', 'nonaktif')">
                                                        <i class="ti ti-power me-2 fs-16"></i> Nonaktifkan</a>
                                                </li>
                                            <?php else: ?>
                                                <li><a class="dropdown-item py-2 text-success" href="javascript:void(0)"
                                                        onclick="toggleStatus('<?= $dt->id_jenis ?>', '<?= htmlspecialchars($dt->name) ?>', 'aktif')">
                                                        <i class="ti ti-circle-check me-2 fs-16"></i> Aktifkan</a>
                                                </li>
                                            <?php endif; ?>
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-info-circle me-1 text-primary"></i> Pengaturan jenis nakes
                akan mempengaruhi kategori pada pendaftaran dokter.</p>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-plus me-2"></i> Tambah Jenis Nakes
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_dokter/save_jenis_dokter/') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Nama Jenis Nakes</label>
                        <input type="text" class="form-control bg-light border-0 shadow-none" name="nama_jenis_dokter"
                            placeholder="Cth: Dokter Umum, Perawat, dll" required>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
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
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-edit me-2"></i> Edit Jenis Nakes</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_dokter/editthis_jenis_dokter/') ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edt_id">
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-13">Nama Jenis Nakes</label>
                        <input type="text" class="form-control bg-light border-0 shadow-none"
                            name="edt_nama_jenis_dokter" id="edt_name" required>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info px-4 text-white">Simpan Perubahan</button>
                </div>
            </form>
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

        $(document).on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#edt_id').val(id);
            $('#edt_name').val(name);
            $('#modalEdit').modal('show');
        });
    });

    function toggleStatus(id, name, action) {
        var title = action == 'nonaktif' ? 'Nonaktifkan Jenis Nakes?' : 'Aktifkan Jenis Nakes?';
        var text = "Apakah Anda yakin ingin mengubah status '" + name + "'?";
        var btnColor = action == 'nonaktif' ? '#ef4444' : '#10b981';

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: btnColor,
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = action == 'nonaktif' ? "<?= base_url('mst_dokter/deleteitempo_jenis_dokter/') ?>" : "<?= base_url('mst_dokter/aktifasiitempo_jenis_dokter/') ?>";
                $.post(url, { id: id }, function (res) {
                    Swal.fire('Berhasil!', 'Status telah diubah.', 'success').then(() => {
                        location.reload();
                    });
                });
            }
        });
    }
</script>

<?php $this->theme->footer('theme_default'); ?>