<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <?= $button ?> Menu Utama
            </h4>
            <p class="text-muted mb-0">Atur nama, ikon, dan urutan tampilan menu utama.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_menu') ?>" class="btn btn-light d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">Detail Entri Menu</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= $action ?>" method="post">
                        <input type="hidden" name="id_menu" value="<?= $id_menu ?>" />

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted fs-13">Nama Menu</label>
                            <input type="text" class="form-control bg-light border-0 shadow-none px-3" name="menu"
                                placeholder="Contoh: Pendaftaran" value="<?= $menu ?>" required />
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-muted fs-13">Ikon (Tabler Icons)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i
                                            class="<?= $icon ?: 'ti ti-tag' ?>"></i></span>
                                    <input type="text" class="form-control bg-light border-0 shadow-none px-3"
                                        name="icon" placeholder="ti ti-heart" value="<?= $icon ?>" />
                                </div>
                                <small class="text-muted mt-1 d-block italic">Gunakan prefix 'ti ti-...'</small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-muted fs-13">Urutan Tampil</label>
                                <input type="number" class="form-control bg-light border-0 shadow-none px-3"
                                    name="urutan" placeholder="1, 2, 3..." value="<?= $urutan ?>" required />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted fs-13">Status Aktif</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktif" id="aktif1" value="1"
                                        <?= ($aktif == 1 ? 'checked' : '') ?>>
                                    <label class="form-check-label" for="aktif1">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="aktif" id="aktif0" value="0"
                                        <?= ($aktif == 0 ? 'checked' : '') ?>>
                                    <label class="form-check-label" for="aktif0">Nonaktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top">
                            <button type="submit"
                                class="btn btn-primary d-inline-flex align-items-center px-4 shadow-sm w-100 justify-content-center">
                                <i class="ti ti-device-floppy me-2 fs-18"></i>
                                <?= $button ?> Data Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow-sm border-0 bg-soft-info p-3">
                <div class="card-body">
                    <h5 class="fw-bold text-info mb-3"><i class="ti ti-info-circle me-1"></i> Tip Penggunaan</h5>
                    <p class="text-info opacity-85 mb-0 fs-14">
                        Aplikasi ini menggunakan <strong>Tabler Icons</strong> untuk visualisasi sidebar. Anda bisa
                        mencari daftar ikon lengkap di situs resmi Tabler Icons dan cukup salin kodenya seperti
                        <code>ti ti-stethoscope</code>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>
<?php $this->theme->footer("theme_default"); ?>
