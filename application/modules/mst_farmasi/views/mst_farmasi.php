<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Obat & Alat Kesehatan</h4>
            <p class="text-muted mb-0">Kelola inventaris perbekalan farmasi, obat-obatan, dan alkes.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center shadow-sm"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="ti ti-plus me-1"></i> Tambah Obat/Alkes
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
                            placeholder="Ketik nama obat, kategori, atau id...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fs-13 fw-bold text-muted">Filter Group</label>
                    <select class="form-select bg-light border-0 shadow-none" id="filter_group">
                        <option value="">Semua Group</option>
                        <?php foreach ($datalistgroup as $g): ?>
                            <option value="<?= $g->id_group ?>">
                                <?= $g->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
                <i class="ti ti-pill text-primary me-2 fs-20"></i> Daftar Inventaris Farmasi
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 datatable" id="table-farmasi">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold" width="50">#</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Obat / Alkes</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Kategori & Type</th>
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
                                    <div class="d-flex gap-2 mt-1">
                                        <?php if (@$dt->is_formularium == 1): ?>
                                            <span class="badge bg-soft-info text-info fs-10 rounded-pill">Formularium</span>
                                        <?php endif; ?>
                                        <?php if (@$dt->is_generik == 1): ?>
                                            <span class="badge bg-soft-warning text-warning fs-10 rounded-pill">Generik</span>
                                        <?php endif; ?>
                                    </div>
                                    <small class="text-muted fs-11 mt-1 d-block">ID:
                                        <?= $dt->id_fa ?>
                                    </small>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="fs-13 text-dark">
                                        <?= $dt->kategori ?: 'Tanpa Kategori' ?>
                                    </div>
                                    <small class="text-muted fs-11">
                                        <?= $dt->subkategori ?: '-' ?>
                                    </small>
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
                                                    data-id="<?= $dt->id_fa ?>">
                                                    <i class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <?php if ($dt->aktif == 1): ?>
                                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"
                                                        onclick="toggleAktif('<?= $dt->id_fa ?>', '<?= htmlspecialchars($dt->name) ?>', 'nonaktif')">
                                                        <i class="ti ti-power me-2 fs-16"></i> Nonaktifkan</a>
                                                </li>
                                            <?php else: ?>
                                                <li><a class="dropdown-item py-2 text-success" href="javascript:void(0)"
                                                        onclick="toggleAktif('<?= $dt->id_fa ?>', '<?= htmlspecialchars($dt->name) ?>', 'aktif')">
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-info-circle me-1 text-primary"></i> Data stok akan sinkron
                dengan kartu stok gudang farmasi.</p>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-square-rounded-plus me-2"></i> Tambah
                    Obat / Alkes</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_farmasi/save_farmasi') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-13">Nama Deskripsi Obat</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none" name="deskripsi_set"
                                placeholder="Cth: Paracetamol 500mg" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold fs-13">Group Obat</label>
                            <select class="form-select bg-light border-0 shadow-none" name="grup_set">
                                <option value="">Pilih Group</option>
                                <?php foreach ($datalistgroup as $g)
                                    echo "<option value='{$g->id_group}'>{$g->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold fs-13">Tipe</label>
                            <select class="form-select bg-light border-0 shadow-none" name="tipe_obat">
                                <option value="0">Habis Pakai</option>
                                <option value="1">Multidosis</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Golongan</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_1">
                                <option value="">Pilih</option>
                                <?php foreach ($datalistgol as $gl)
                                    echo "<option value='{$gl->id_gol}'>{$gl->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Kategori</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_2">
                                <option value="">Pilih</option>
                                <?php foreach ($datalistkat as $kt)
                                    echo "<option value='{$kt->id_cat}'>{$kt->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Sub Kategori</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_3">
                                <option value="">Pilih</option>
                                <?php foreach ($datalistsubkat as $sk)
                                    echo "<option value='{$sk->id_subcat}'>{$sk->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Jenis</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_4">
                                <option value="">Pilih</option>
                                <?php foreach ($datalisttype as $tp)
                                    echo "<option value='{$tp->id_type}'>{$tp->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Kemasan</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_5">
                                <option value="">Pilih</option>
                                <?php foreach ($datalistkemasan as $km)
                                    echo "<option value='{$km->id_satuan}'>{$km->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold fs-13">Satuan</label>
                            <select class="form-select bg-light border-0 shadow-none" name="sel_6">
                                <option value="">Pilih</option>
                                <?php foreach ($datalistkemasan as $km)
                                    echo "<option value='{$km->id_satuan}'>{$km->name}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="field1_set" value="1"
                                        id="add_f1">
                                    <label class="form-check-label fs-13" for="add_f1">Formularium</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="field2_set" value="1"
                                        id="add_f2">
                                    <label class="form-check-label fs-13" for="add_f2">Generik</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Obat</button>
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
                <h5 class="modal-title d-flex align-items-center"><i class="ti ti-edit-circle me-2"></i> Edit Data Obat
                    / Alkes</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('mst_farmasi/editthis_farmasi') ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="id_fa" id="edt_id">
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

            $('#filter_group').on('change', function () {
                table.search($(this).val()).draw();
            });
        }

        $(document).on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            $('#edt_id').val(id);
            $('#modalEdit').modal('show');
            $('#edit-content-loader').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted fs-13">Memuat data...</p></div>');

            $.ajax({
                url: "<?= base_url('mst_farmasi/edit_farmasi') ?>",
                type: "POST",
                data: { id_fa: id },
                dataType: "JSON",
                success: function (res) {
                    if (res && res.status === 'success') {
                        var d = res.data;
                        var html = `
                            <div class="col-md-6">
                                <label class="form-label fw-bold fs-13">Nama Deskripsi Obat</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none" name="edt_deskripsi" value="${d.name}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold fs-13">Group Obat</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_grup" id="edt_sel_group">
                                    <option value="">Pilih Group</option>
                                    <?php foreach ($datalistgroup as $g)
                                        echo "<option value='{$g->id_group}'>{$g->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold fs-13">Tipe</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_tipe" id="edt_sel_tipe">
                                    <option value="0">Habis Pakai</option>
                                    <option value="1">Multidosis</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Golongan</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_gol" id="edt_sel_gol">
                                    <option value="">Pilih</option>
                                    <?php foreach ($datalistgol as $gl)
                                        echo "<option value='{$gl->id_gol}'>{$gl->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Kategori</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_cat" id="edt_sel_cat">
                                    <option value="">Pilih</option>
                                    <?php foreach ($datalistkat as $kt)
                                        echo "<option value='{$kt->id_cat}'>{$kt->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Sub Kategori</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_subcat" id="edt_sel_subcat">
                                    <option value="">Pilih</option>
                                    <?php foreach ($datalistsubkat as $sk)
                                        echo "<option value='{$sk->id_subcat}'>{$sk->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Jenis</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_type" id="edt_sel_type">
                                    <option value="">Pilih</option>
                                    <?php foreach ($datalisttype as $tp)
                                        echo "<option value='{$tp->id_type}'>{$tp->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Kemasan</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_kemasan" id="edt_sel_kemasan">
                                    <?php foreach ($datalistkemasan as $km)
                                        echo "<option value='{$km->id_satuan}'>{$km->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold fs-13">Satuan</label>
                                <select class="form-select bg-light border-0 shadow-none" name="edt_satuan" id="edt_sel_satuan">
                                    <?php foreach ($datalistkemasan as $km)
                                        echo "<option value='{$km->id_satuan}'>{$km->name}</option>"; ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="edt_f1" value="1" id="edt_f1" ${d.is_formularium == 1 ? 'checked' : ''}>
                                        <label class="form-check-label fs-13" for="edt_f1">Formularium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="edt_f2" value="1" id="edt_f2" ${d.is_generik == 1 ? 'checked' : ''}>
                                        <label class="form-check-label fs-13" for="edt_f2">Generik</label>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#edit-content-loader').html(html);
                        $('#edt_sel_group').val(d.id_group);
                        $('#edt_sel_tipe').val(d.type_obat);
                        $('#edt_sel_gol').val(d.id_gol);
                        $('#edt_sel_cat').val(d.id_cat);
                        $('#edt_sel_subcat').val(d.id_subcat);
                        $('#edt_sel_type').val(d.id_type);
                        $('#edt_sel_kemasan').val(d.id_kemasan);
                        $('#edt_sel_satuan').val(d.id_satuan);
                    } else {
                        $('#edit-content-loader').html('<div class="alert alert-danger">Gagal memuat data.</div>');
                    }
                }
            });
        });
    });

    function toggleAktif(id, name, action) {
        var title = action == 'nonaktif' ? 'Nonaktifkan Obat?' : 'Aktifkan Obat?';
        var btnColor = action == 'nonaktif' ? '#ef4444' : '#10b981';

        Swal.fire({
            title: title,
            text: "Apakah Anda yakin ingin mengubah status " + name + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: btnColor,
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = action == 'nonaktif' ? "<?= base_url('mst_farmasi/nonaktif_farmasi/') ?>" : "<?= base_url('mst_farmasi/aktifkan_farmasi/') ?>";
                $.post(url, { id_fa: id }, function (res) {
                    Swal.fire('Berhasil!', 'Status telah diubah.', 'success').then(() => {
                        location.reload();
                    });
                });
            }
        });
    }
</script>

<?php $this->theme->footer('theme_default'); ?>