<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Manajemen Role & Hak Akses</h4>
            <p class="text-muted mb-0">Definisikan grup pengguna dan atur batasan akses menu mereka.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_rolemenu/create'); ?>"
                class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-plus me-1"></i> Tambah Role Baru
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
                                ID Role</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Role / Jabatan</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Status</th>
                            <th class="border-0 pe-4 py-3 text-center text-muted fs-12 text-uppercase fw-bold">
                                Konfigurasi & Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($role_data)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Belum ada role yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($role_data as $r): ?>
                            <tr>
                                <td class="ps-4 border-bottom border-light">
                                    <span class="fw-bold text-muted">#
                                        <?= $r->id_role ?>
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-soft-warning text-warning rounded me-3 fs-16">
                                            <i class="ti ti-user-shield"></i>
                                        </div>
                                        <h6 class="mb-0 fw-bold text-dark fs-14">
                                            <?= $r->nama ?>
                                        </h6>
                                    </div>
                                </td>
                                <td class="border-bottom border-light">
                                    <?= ($r->aktif == 1)
                                        ? '<span class="badge badge-soft-success rounded-pill px-3 py-2"><i class="ti ti-check me-1"></i>Aktif</span>'
                                        : '<span class="badge badge-soft-danger rounded-pill px-3 py-2"><i class="ti ti-x me-1"></i>Nonaktif</span>' ?>
                                </td>
                                <td class="pe-4 text-center border-bottom border-light">
                                    <a href="<?= site_url('smart_rolemenu/manage/' . $r->id_role); ?>"
                                        class="btn btn-primary btn-sm px-3 shadow-none me-1" title="Atur Menu">
                                        <i class="ti ti-settings-automation me-1"></i> Atur Menu
                                    </a>
                                    <a href="<?= site_url('smart_rolemenu/update/' . $r->id_role); ?>"
                                        class="btn btn-icon btn-sm btn-info text-white shadow-none me-1" title="Edit Role">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="hapusRole('<?= $r->id_role ?>')"
                                        class="btn btn-icon btn-sm btn-danger shadow-none" title="Hapus Role">
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-lock-access me-1 text-warning"></i> Gunakan tombol
                <strong>Atur Menu</strong> untuk menentukan submenu mana saja yang boleh diakses oleh role tersebut.</p>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
    function hapusRole(id) {
        Swal.fire({
            title: 'Hapus Role?',
            text: "Menghapus role akan mencabut semua akses pengguna yang memiliki role ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('smart_rolemenu/delete/') ?>" + id;
            }
        });
    }
</script>

<?php $this->theme->footer("theme_default"); ?>
