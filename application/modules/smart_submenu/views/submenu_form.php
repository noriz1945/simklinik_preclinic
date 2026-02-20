<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">
                <?= $button ?> Sub Menu
            </h4>
            <p class="text-muted mb-0">Konfigurasi endpoint URL dan hirarki sub navigasi.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= site_url('smart_submenu') ?>" class="btn btn-light d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="card-title fw-bold mb-0 text-dark">Formulir Konstruksi Submenu</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= $action ?>" method="post">
                        <input type="hidden" name="id_submenu" value="<?= $id_submenu ?>" />

                        <div class="row g-4">
                            <!-- Section: Kaitan Menu -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Pilih Menu Utama (Induk)</label>
                                <select name="id_menu" class="form-select bg-light border-0 shadow-none px-3" required>
                                    <option value="">-- Hubungkan ke Menu Utama --</option>
                                    <?php foreach ($menu_list as $m): ?>
                                        <option value="<?= $m->id_menu ?>" <?= ($id_menu == $m->id_menu ? 'selected' : '') ?>>
                                            <?= $m->menu ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Nama Submenu</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none px-3"
                                    name="submenu" placeholder="Cth: Laporan Harian" value="<?= $submenu ?>" required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted fs-13">Alamat URL (Route)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 fs-12">
                                        <?= base_url() ?>
                                    </span>
                                    <input type="text" class="form-control bg-light border-0 shadow-none px-3"
                                        name="url" placeholder="folder/nama_fungsi" value="<?= $url ?>" required />
                                </div>
                            </div>

                            <!-- Section: Hirarki -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted fs-13">Tipe Hirarki</label>
                                <select name="is_parent" id="is_parent"
                                    class="form-select bg-light border-0 shadow-none px-3">
                                    <option value="1" <?= ($is_parent == 1 ? 'selected' : '') ?>>Level 1 (Bisa punya anak)
                                    </option>
                                    <option value="0" <?= ($is_parent == 0 ? 'selected' : '') ?>>Level 2 (Punya induk
                                        submenu)</option>
                                </select>
                            </div>

                            <div class="col-md-5" id="parent_id_group"
                                style="<?= ($is_parent == 1 ? 'display:none' : '') ?>">
                                <label class="form-label fw-bold text-muted fs-13">Induk Submenu</label>
                                <select name="parent_id" class="form-select bg-light border-0 shadow-none px-3">
                                    <option value="">-- Pilih Induk Submenu --</option>
                                    <?php foreach ($parent_list as $p): ?>
                                        <option value="<?= $p->id_submenu ?>" <?= ($parent_id == $p->id_submenu ? 'selected' : '') ?>>
                                            <?= $p->submenu ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted fs-13">No. Urut</label>
                                <input type="number" class="form-control bg-light border-0 shadow-none px-3"
                                    name="no_urut" value="<?= $no_urut ?>" required />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Ikon (Opsional)</label>
                                <input type="text" class="form-control bg-light border-0 shadow-none px-3" name="icon"
                                    placeholder="ti ti-chevron-right" value="<?= $icon ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted fs-13">Status Tampil</label>
                                <div class="d-flex h-100 align-items-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="aktif" id="akt1" value="1"
                                            <?= ($aktif == 1 ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="akt1">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="aktif" id="akt0" value="0"
                                            <?= ($aktif == 0 ? 'checked' : '') ?>>
                                        <label class="form-check-label" for="akt0">Nonaktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top text-end">
                            <button type="submit"
                                class="btn btn-primary d-inline-flex align-items-center px-5 shadow-sm">
                                <i class="ti ti-device-floppy me-2 fs-18"></i>
                                <?= $button ?> Submenu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 text-center d-none d-xl-block">
            <div class="p-5">
                <i class="ti ti-hierarchy-2 text-primary opacity-25" style="font-size: 120px;"></i>
                <h5 class="fw-bold text-muted mt-3">Skema Hirarki</h5>
                <p class="text-muted fs-12 px-4">Pastikan URL yang dimasukkan sesuai dengan controller dan method yang
                    ada di backend agar tidak terjadi 404 Not Found.</p>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
    $(document).ready(function () {
        $('#is_parent').on('change', function () {
            if ($(this).val() == '0') {
                $('#parent_id_group').fadeIn();
            } else {
                $('#parent_id_group').fadeOut();
            }
        });
    });
</script>

<?php $this->theme->footer("theme_default"); ?>
