<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Master Menu Utama</h4>
            <p class="text-muted mb-0">Kelola struktur menu level tertinggi pada aplikasi.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_menu/menu/create'); ?>"
                class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-plus me-1"></i> Tambah Menu
            </a>
        </div>
    </div>

    <!-- ALERT MSG -->
    <?= $this->session->flashdata("msg") ?>

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-center align-middle mb-0 text-nowrap">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-4 py-3 text-muted fs-12 text-uppercase fw-bold" style="width: 80px;">
                                No. Urut</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Menu & Ikon</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Status</th>
                            <th class="border-0 pe-4 py-3 text-center text-muted fs-12 text-uppercase fw-bold"
                                style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($menu_data)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Belum ada data menu.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($menu_data as $m): ?>
                            <tr>
                                <td class="ps-4 border-bottom border-light">
                                    <div class="avatar avatar-md bg-light text-dark fw-bold rounded border shadow-none">
                                        <?= $m->urutan ?>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-soft-primary text-primary rounded me-3 fs-18">
                                            <?php if (!empty($m->icon)): ?>
                                                <i class="<?= $m->icon ?>"></i>
                                            <?php else: ?>
                                                <i class="ti ti-tag"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark fs-14">
                                                <?= $m->menu ?>
                                            </h6>
                                            <span class="fs-11 text-muted">Icon:
                                                <?= $m->icon ?: 'default' ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <?= ($m->aktif == 1)
                                        ? '<span class="badge badge-soft-success rounded-pill px-3 py-2"><i class="ti ti-check me-1"></i>Aktif</span>'
                                        : '<span class="badge badge-soft-danger rounded-pill px-3 py-2"><i class="ti ti-x me-1"></i>Nonaktif</span>' ?>
                                </td>
                                <td class="pe-4 text-center border-bottom border-light">
                                    <a href="<?= site_url('smart_menu/menu/update/' . $m->id_menu); ?>"
                                        class="btn btn-icon btn-sm btn-info text-white shadow-none me-1" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="hapusMenu('<?= $m->id_menu ?>')"
                                        class="btn btn-icon btn-sm btn-danger shadow-none" title="Hapus">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 py-3">
            <p class="text-muted fs-11 mb-0"><i class="ti ti-bulb me-1"></i> Menu di sini akan tampil sebagai kategori
                utama di sidebar kiri.</p>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
    function hapusMenu(id) {
        Swal.fire({
            title: 'Hapus Menu Utama?',
            text: "Mengahapus menu utama akan menyembunyikan semua sub-menu terkait!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('smart_menu/menu/delete/') ?>" + id;
            }
        });
    }
</script>

<?php $this->theme->footer("theme_default"); ?>
