<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Layanan Pengguna</h4>
            <p class="text-muted mb-0">Kelola riwayat akses dan akun pengguna sistem.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= base_url('smart_login/create'); ?>"
                class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-plus me-1"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="<?= base_url('smart_login') ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fs-13 fw-bold text-muted">Cari Pengguna</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i
                                    class="ti ti-search text-muted"></i></span>
                            <input type="text" name="q" class="form-control bg-light border-0 shadow-none"
                                placeholder="Username atau Nama..." value="<?= @$q ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fs-13 fw-bold text-muted">Filter Role</label>
                        <select name="role" class="form-select bg-light border-0 shadow-none">
                            <option value="">Semua Role</option>
                            <?php foreach ($roles as $r): ?>
                                <option value="<?= $r->id_role ?>" <?= ($role == $r->id_role) ? 'selected' : '' ?>>
                                    <?= $r->nama ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info text-white shadow-none">
                            <i class="ti ti-filter me-1"></i> Terapkan
                        </button>
                        <?php if ($q || $role): ?>
                            <a href="<?= base_url('smart_login') ?>" class="btn btn-light shadow-none ms-1">Reset</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ALERT MSG -->
    <?= $this->session->flashdata("msg") ?>

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-center align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 ps-3 py-3 text-muted fs-12 text-uppercase fw-bold">Username</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Nama Lengkap</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Akses Role</th>
                            <th class="border-0 py-3 text-muted fs-12 text-uppercase fw-bold">Status</th>
                            <th class="border-0 pe-3 py-3 text-center text-muted fs-12 text-uppercase fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($list)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($list as $row): ?>
                            <tr>
                                <td class="ps-3 border-bottom border-light">
                                    <div class="fw-bold text-dark fs-14">
                                        <?= $row->username ?>
                                    </div>
                                    <span class="fs-11 text-muted">Pass:
                                        <?= substr($row->password, 0, 8) ?>...
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <div class="text-dark fs-14">
                                        <?= $row->name ?>
                                    </div>
                                    <span class="fs-11 badge bg-soft-info text-info rounded-pill">ID Dokter:
                                        <?= $row->id_dokter ?: '-' ?>
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <span class="text-dark fs-13">
                                        <?= $this->M_smart_login->get_role_name($row->id_role) ?>
                                    </span>
                                </td>
                                <td class="border-bottom border-light">
                                    <?= ($row->aktif == 1)
                                        ? '<span class="badge badge-soft-success rounded-pill px-3 py-2"><i class="ti ti-check me-1"></i>Aktif</span>'
                                        : '<span class="badge badge-soft-danger rounded-pill px-3 py-2"><i class="ti ti-x me-1"></i>Nonaktif</span>' ?>
                                </td>
                                <td class="pe-3 text-center border-bottom border-light">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-sm btn-light shadow-none" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                                            <li><a class="dropdown-item py-2"
                                                    href="<?= base_url('smart_login/edit/' . $row->username); ?>"><i
                                                        class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit Data</a>
                                            </li>
                                            <li><a class="dropdown-item py-2" href="javascript:void(0)"
                                                    onclick="resetPass('<?= $row->username ?>')"><i
                                                        class="ti ti-refresh me-2 text-warning fs-16"></i> Reset
                                                    Password</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"
                                                    onclick="hapusUser('<?= $row->username ?>')"><i
                                                        class="ti ti-trash me-2 fs-16"></i> Hapus Akun</a></li>
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
            <p class="text-muted fs-11 mb-0"><i class="ti ti-info-circle me-1"></i> Klik pada titik tiga untuk aksi
                lainnya.</p>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
    function hapusUser(username) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Akun " + username + " akan dihapus permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('smart_login/delete/') ?>" + username;
            }
        });
    }

    function resetPass(username) {
        Swal.fire({
            title: 'Reset Password?',
            text: 'Password akan dikembalikan ke settingan default (123).',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                window.location.href = "<?= base_url('smart_login/reset_password/') ?>" + username;
            }
        });
    }
</script>

<?php $this->theme->footer("theme_default"); ?>
