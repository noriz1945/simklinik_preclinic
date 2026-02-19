<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <?= $title ?> Pengguna
            </h4>
            <p class="text-muted mb-0">Lengkapi detail akun untuk memberikan hak akses sistem.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= base_url('smart_login') ?>" class="btn btn-light d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke List
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">
                        <i class="ti ti-id-badge me-2 text-primary fs-20"></i> Identitas & Kredensial
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('smart_login/save') ?>" method="POST">
                        <input type="hidden" name="mode" value="<?= ($row ? 'edit' : 'add') ?>">

                        <div class="row g-4">
                            <!-- Section: Kredensial -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Username Login</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="ti ti-user"></i></span>
                                    <input type="text" name="username"
                                        class="form-control bg-light border-0 shadow-none px-3"
                                        placeholder="Cth: admin.klinik" value="<?= @$row->username ?>"
                                        <?= ($row ? 'readonly' : 'required') ?>>
                                </div>
                                <small class="text-muted mt-1 d-block italic">*) Username tidak dapat diubah setelah
                                    disimpan.</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">
                                    <?= ($row ? 'Ganti Password (isi jika perlu)' : 'Password Awal') ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="ti ti-key"></i></span>
                                    <input type="password" name="password"
                                        class="form-control bg-light border-0 shadow-none px-3"
                                        placeholder="<?= ($row ? 'Biarkan kosong untuk tetap' : 'Input password minimal 6 digit') ?>"
                                        <?= ($row ? '' : 'required') ?>>
                                </div>
                            </div>

                            <!-- Section: Profil -->
                            <div class="col-md-12">
                                <hr class="my-2 border-light">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control bg-light border-0 shadow-none px-3"
                                    placeholder="Cth: Dr. Ahmad Subarjo" value="<?= @$row->name ?>" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted fs-13">Hak Akses (Role)</label>
                                <select name="id_role" class="form-select bg-light border-0 shadow-none px-3" required>
                                    <option value="">-- Pilih Role --</option>
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r->id_role ?>" <?= (@$row->id_role == $r->id_role ? 'selected' : '') ?>>
                                            <?= $r->nama ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted fs-13">Status Akun</label>
                                <select name="aktif" class="form-select bg-light border-0 shadow-none px-3">
                                    <option value="1" <?= (@$row->aktif == 1 ? 'selected' : '') ?>>Aktif & Izinkan</option>
                                    <option value="0" <?= (@$row->aktif == 0 ? 'selected' : '') ?>>Nonaktifkan</option>
                                </select>
                            </div>

                            <!-- Section: Metadata Medis -->
                            <div class="col-md-12 mt-4 mb-2">
                                <h6 class="fw-bold text-dark border-start border-primary border-4 ps-2">Informasi
                                    Kepangkatan/Medis (Opsional)</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Relasi Dokter</label>
                                <select name="id_dokter" class="form-select bg-light border-0 shadow-none px-3">
                                    <option value="">-- Tidak Ada --</option>
                                    <?php foreach ($sup as $d): ?>
                                        <option value="<?= $d->id_dokter ?>" <?= (@$row->id_dokter == $d->id_dokter ? 'selected' : '') ?>>
                                            <?= $d->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted fs-13">NIB / STR</label>
                                <input type="text" name="nib" class="form-control bg-light border-0 shadow-none px-3"
                                    value="<?= @$row->nib ?>">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted fs-13">NIK KTP</label>
                                <input type="text" name="nik" class="form-control bg-light border-0 shadow-none px-3"
                                    value="<?= @$row->nik ?>">
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top text-end">
                            <button type="reset" class="btn btn-light px-4 me-2">Bersihkan</button>
                            <button type="submit"
                                class="btn btn-primary d-inline-flex align-items-center px-4 shadow-sm">
                                <i class="ti ti-device-floppy me-2 fs-18"></i> Simpan Perubahan
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
