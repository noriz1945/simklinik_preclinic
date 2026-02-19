<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Tenaga Kesehatan / Dokter</h4>
            <p class="text-muted mb-0">Kelola data nakes, dokter, dan paramedis yang bertugas di klinik.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Nakes
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
                            placeholder="Ketik nama, id, atau sip dokter...">
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
                <i class="ti ti-users text-primary me-2 fs-20"></i> Daftar Nakes & Dokter
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 datatable" id="table-dokter">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold" width="50">#</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Nakes / Dokter</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Kontak & SIP</th>
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
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-soft-primary text-primary rounded-circle me-3">
                                            <?= strtoupper(substr($dt->name, 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fs-14 fw-semibold text-dark">
                                                <?= $dt->name ?>
                                            </h6>
                                            <small class="text-muted fs-11">ID:
                                                <?= $dt->id_dokter ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="fs-13 text-dark"><i class="ti ti-phone me-1 text-info"></i>
                                        <?= $dt->hp ?: '-' ?>
                                    </div>
                                    <div class="fs-11 text-muted"><i class="ti ti-id me-1"></i> SIP:
                                        <?= $dt->nosip ?: '-' ?>
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
                                            <li><a class="dropdown-item py-2 edit-btn" href="javascript:void(0)"
                                                    data-idx="<?= $dt->id_dokter ?>">
                                                    <i class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <?php if ($dt->aktif == 1): ?>
                                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"
                                                        onclick="toggleAktif('<?= $dt->id_dokter ?>', '<?= htmlspecialchars($dt->name) ?>', 'nonaktif')">
                                                        <i class="ti ti-power me-2 fs-16"></i> Nonaktifkan</a>
                                                </li>
                                            <?php else: ?>
                                                <li><a class="dropdown-item py-2 text-success" href="javascript:void(0)"
                                                        onclick="toggleAktif('<?= $dt->id_dokter ?>', '<?= htmlspecialchars($dt->name) ?>', 'aktif')">
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-info-circle me-1 text-primary"></i> Gunakan kotak pencarian
                di atas untuk memfilter data secara cepat.</p>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-square-rounded-plus me-2"></i> Tambah
                    Tenaga Kesehatan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_dokter/save_dokter') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold fs-13">Nama Lengkap Dokter / Nakes</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none" name="nama_dokter"
                                placeholder="Cth: dr. John Doe, Sp.A" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-13">Nomor SIP</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none" name="nosip"
                                placeholder="Cth: 445/123/SIP/2023">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-13">Nomor HP</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none" name="no_hp"
                                placeholder="Cth: 08123456789">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Jenis Nakes</label>
                            <select class="form-select bg-light border-0 shadow-none" name="id_jenis_dokter">
                                <option value="">Pilih Jenis</option>
                                <?php foreach ($datalistjenis as $j)
                                    echo "<option value='{$j->id_jenis}'>{$j->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Spesialisasi</label>
                            <select class="form-select bg-light border-0 shadow-none" name="id_spesialis_dokter">
                                <option value="">Pilih Spesialis</option>
                                <?php foreach ($datalistspesialis as $s)
                                    echo "<option value='{$s->id_spes}'>{$s->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Sub-Spesialisasi</label>
                            <select class="form-select bg-light border-0 shadow-none" name="id_subspesialis_dokter">
                                <option value="">Pilih Sub-Spesialis</option>
                                <?php foreach ($datalistsubspesialis as $sb)
                                    echo "<option value='{$sb->id_subsp}'>{$sb->name}</option>"; ?>
                            </select>
                        </div>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-edit-circle me-2"></i> Edit Data
                    Tenaga Kesehatan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_dokter/editthis_dokter') ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edt_id">
                    <div class="row g-3" id="edit-content-loader">
                        <!-- Loading via AJAX -->
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
                dom: 'rtip', // Hide default search box
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

            // Bind custom search
            $('#custom-search').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('#btn-apply-search').on('click', function () {
                table.search($('#custom-search').val()).draw();
            });
        }

        $(document).on('click', '.edit-btn', function () {
            var id = $(this).attr('data-idx');
            $('#edt_id').val(id);
            $('#modalEdit').modal('show');
            $('#edit-content-loader').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted fs-13">Memuat data...</p></div>');

            $.ajax({
                url: "<?= base_url('mst_dokter/edit_dokter') ?>",
                type: "POST",
                data: { id: id },
                dataType: "JSON",
                success: function (res) {
                    if (res && res.status === 'success') {
                        var html = `
                            <div class="col-md-12">
                                <label class="form-label fw-bold fs-13 text-muted">Nama Lengkap Dokter / Nakes</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none" name="edt_nama_dokter" value="${res.row_1}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold fs-13 text-muted">Nomor SIP</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none" name="edt_nosip" value="${res.row_6}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold fs-13 text-muted">Nomor HP</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none" name="edt_no_hp" value="${res.row_5}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13 text-muted">Jenis Nakes</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_id_jenis_dokter" id="sel_jenis">
                                    <option value="">Pilih Jenis</option>
                                    <?php foreach ($datalistjenis as $j)
                                        echo "<option value='{$j->id_jenis}'>{$j->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13 text-muted">Spesialisasi</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_id_spesialis_dokter" id="sel_spes">
                                    <option value="">Pilih Spesialis</option>
                                    <?php foreach ($datalistspesialis as $s)
                                        echo "<option value='{$s->id_spes}'>{$s->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13 text-muted">Sub-Spesialisasi</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_id_subspesialis_dokter" id="sel_subspes">
                                    <option value="">Pilih Sub-Spesialis</option>
                                    <?php foreach ($datalistsubspesialis as $sb)
                                        echo "<option value='{$sb->id_subsp}'>{$sb->name}</option>"; ?>
                                </select>
                            </div>
                        `;
                        $('#edit-content-loader').html(html);
                        $('#sel_jenis').val(res.row_2);
                        $('#sel_spes').val(res.row_3);
                        $('#sel_subspes').val(res.row_4);
                    } else {
                        var msg = (res && res.message) ? res.message : 'Data tidak ditemukan';
                        $('#edit-content-loader').html('<div class="alert alert-soft-danger border-0"><i class="ti ti-exclamation-circle me-2"></i>' + msg + '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    $('#edit-content-loader').html('<div class="alert alert-soft-danger border-0"><i class="ti ti-bug me-2"></i>Gagal memuat data. Status: ' + status + ' Error: ' + error + '</div>');
                    console.error('AJAX Error:', status, error, xhr.responseText);
                }
            });
        });
    });

    function toggleAktif(id, name, action) {
        var title = action == 'nonaktif' ? 'Nonaktifkan Nakes?' : 'Aktifkan Nakes?';
        var text = action == 'nonaktif' ? name + " tidak akan dapat dipilih dalam transaksi baru." : name + " akan kembali tersedia untuk pelayanan.";
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
                var url = action == 'nonaktif' ? "<?= base_url('mst_dokter/deleteitempo_dokter') ?>" : "<?= base_url('mst_dokter/aktifasiitempo_dokter') ?>";
                $.post(url, { id: id }, function (res) {
                    Swal.fire('Berhasil!', 'Status ' + name + ' telah diubah.', 'success').then(() => {
                        location.reload();
                    });
                });
            }
        });
    }
</script>

<?php $this->theme->footer('theme_default'); ?>