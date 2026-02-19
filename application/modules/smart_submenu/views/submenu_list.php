<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Manajemen Sub Menu</h4>
            <p class="text-muted mb-0">Atur navigasi tingkat dua dan tiga untuk setiap modul.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_submenu/create'); ?>"
                class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-plus me-1"></i> Tambah Submenu
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
                                Urut</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Submenu & Tautan (URL)
                            </th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Menu Induk</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Status</th>
                            <th class="border-0 pe-4 py-3 text-center text-muted fs-12 text-uppercase fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($submenu_data)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada data submenu.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($submenu_data as $s): ?>
                            <tr>
                                <td class="ps-4 border-bottom border-light text-center">
                                    <span class="fw-bold text-muted">
                                        <?= $s->no_urut ?>
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-soft-info text-info rounded me-3 fs-16">
                                            <i class="ti ti-link"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark fs-14">
                                                <?= ($s->is_child == 1 ? '<span class="text-muted me-1">???</span>' : '') ?>
                                                <?= $s->submenu ?>
                                            </h6>
                                            <code class="fs-11 text-primary"><?= $s->url ?></code>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <span class="badge badge-soft-dark px-2 py-1 fs-12">
                                        <i class="ti ti-layout-sidebar me-1"></i>
                                        <?= $this->SubmenuModel->get_menu_name($s->id_menu) ?>
                                    </span>
                                    <?php if ($s->is_child == 1): ?>
                                        <div class="fs-11 text-muted mt-1 ms-1">Parent:
                                            <?= $this->SubmenuModel->get_submenu_name($s->parent_id) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="border-bottom border-light">
                                    <?= ($s->aktif == 1)
                                        ? '<span class="badge badge-soft-success rounded-pill px-3 py-2"><i class="ti ti-check me-1"></i>Aktif</span>'
                                        : '<span class="badge badge-soft-danger rounded-pill px-3 py-2"><i class="ti ti-x me-1"></i>Nonaktif</span>' ?>
                                </td>
                                <td class="pe-4 text-center border-bottom border-light">
                                    <a href="<?= site_url('smart_submenu/update/' . $s->id_submenu); ?>"
                                        class="btn btn-icon btn-sm btn-info text-white shadow-none me-1" title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="hapusSub('<?= $s->id_submenu ?>')"
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-hierarchy me-1"></i> Submenu level 1 tampil langsung di
                bawah Menu Utama, level 2 akan tampil sebagai anak dari Submenu level 1.</p>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
    function hapusSub(id) {
        Swal.fire({
            title: 'Hapus Submenu?',
            text: "Pastikan submenu ini tidak lagi aktif digunakan oleh menu role!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('smart_submenu/delete/') ?>" + id;
            }
        });
    }
</script>

<?php $this->theme->footer("theme_default"); ?>
