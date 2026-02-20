<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <?= ($button == "Simpan") ? "Tambah" : "Edit"; ?> Role Pengguna
            </h4>
            <p class="text-muted mb-0">Mendefinisikan nama grup atau jabatan untuk pengaturan kewenangan.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_rolemenu') ?>"
                class="btn btn-light d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3 text-center">
                    <h5 class="card-title fw-bold mb-0 text-dark">Lengkapi Informasi Role</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= $action ?>" method="post">
                        <input type="hidden" name="id_role" value="<?= $id_role ?>">

                        <div class="mb-4 text-center">
                            <div
                                class="avatar avatar-xl bg-soft-primary text-primary rounded-circle shadow-none mx-auto mb-3">
                                <i class="ti ti-shield-half fs-40"></i>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted fs-13">Nama Jabatan / Role</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none px-3" name="nama"
                                placeholder="Cth: Kepala Gudang, Perawat, dll" value="<?= $nama ?>" required />
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted fs-13">Status Penggunaan</label>
                            <select name="aktif" class="form-select bg-light border-0 shadow-none px-3" required>
                                <option value="1" <?= ($aktif == 1 ? 'selected' : ''); ?>>Role Aktif</option>
                                <option value="0" <?= ($aktif == 0 ? 'selected' : ''); ?>>Role Nonaktif (Blokir Akses)</option>
                            </select>
                        </div>

                        <div class="mt-5 pt-3 border-top">
                            <button type="submit"
                                class="btn btn-primary d-inline-flex align-items-center px-4 shadow-sm w-100 justify-content-center py-2">
                                <i class="ti ti-device-floppy me-2 fs-18"></i>
                                <?= ($button == "Simpan") ? "Simpan Role Baru" : "Update Data Role"; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>
<?php $this->theme->footer("theme_default"); ?>
