<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Matriks Hak Akses</h4>
            <p class="text-muted mb-0">Atur kewenangan akses menu untuk Role: <strong class="text-primary"><?= $role->nama ?></strong></p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <button type="button" class="btn btn-soft-primary d-inline-flex align-items-center shadow-none" onclick="checkAll(true)">
                <i class="ti ti-check me-1"></i> Pilih Semua
            </button>
            <button type="button" class="btn btn-soft-danger d-inline-flex align-items-center shadow-none" onclick="checkAll(false)">
                <i class="ti ti-x me-1"></i> Lepas Semua
            </button>
            <a href="<?= site_url('smart_rolemenu') ?>" class="btn btn-light d-inline-flex align-items-center shadow-sm">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- ALERT MSG -->
    <?= $this->session->flashdata("msg") ?>

    <?php if(empty($menu_all)): ?>
        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center">
            <i class="ti ti-alert-triangle me-2 fs-20"></i> Data menu belum tersedia di sistem.
        </div>
    <?php else: ?>

    <form action="<?= site_url('smart_rolemenu/save_manage') ?>" method="post" id="formRoleAccess">
        <input type="hidden" name="id_role" value="<?= $id_role ?>">

        <div class="row">
            <?php foreach ($menu_all as $m): $menuId = $m->id_menu; ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 border-top border-primary border-3">
                        <div class="card-header bg-transparent border-bottom py-3 d-flex align-items-center justify-content-between">
                            <h6 class="fw-bold mb-0 text-dark">
                                <i class="<?= $m->icon ?: 'ti ti-category' ?> me-1 opacity-50"></i> <?= $m->menu ?>
                            </h6>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" id="menu_<?= $menuId ?>" onclick="toggleMenu(<?= $menuId ?>)">
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="menu-structure">
                                <?php foreach ($m->children as $p): $pid = $p->id_submenu; ?>
                                    <!-- Parent Submenu -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input in-menu-<?= $menuId ?>" type="checkbox" name="access[]" 
                                               id="sub_<?= $pid ?>" value="<?= $pid ?>" 
                                               onclick="toggleParent(<?= $pid ?>, <?= $menuId ?>)"
                                               <?= in_array($pid, $selected) ? 'checked' : '' ?>>
                                        <label class="form-check-label fw-bold text-dark fs-13" for="sub_<?= $pid ?>">
                                            <?= $p->submenu ?>
                                        </label>
                                    </div>

                                    <?php if(!empty($p->children)): ?>
                                        <div class="ps-4 border-start ms-2 mb-3 border-light">
                                            <?php foreach ($p->children as $c): $cid = $c->id_submenu; ?>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input in-menu-<?= $menuId ?> in-parent-<?= $pid ?>" type="checkbox" 
                                                           name="access[]" id="sub_<?= $cid ?>" value="<?= $cid ?>"
                                                           onclick="updateParentFromChild(<?= $pid ?>, <?= $menuId ?>)"
                                                           <?= in_array($cid, $selected) ? 'checked' : '' ?>>
                                                    <label class="form-check-label fs-12 text-muted" for="sub_<?= $cid ?>">
                                                       <?= $c->submenu ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="sticky-bottom bg-white border-top p-4 text-center mt-4 shadow-lg rounded-top-4" style="z-index: 1000; margin-left: -1.5rem; margin-right: -1.5rem;">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm d-inline-flex align-items-center">
                <i class="ti ti-device-floppy me-2 fs-20"></i> Simpan Konfigurasi Akses Role
            </button>
        </div>
    </form>

    <?php endif; ?>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>

<script>
// Toggle all checkboxes in a specific menu group
function toggleMenu(menuId) {
    let menuBtn = document.getElementById("menu_" + menuId);
    let items = document.getElementsByClassName("in-menu-" + menuId);
    for (let i = 0; i < items.length; i++) {
        items[i].checked = menuBtn.checked;
    }
}

// When parent submenu is toggled, toggle its children
function toggleParent(pid, menuId) {
    let parentBtn = document.getElementById("sub_" + pid);
    let children = document.getElementsByClassName("in-parent-" + pid);
    for (let i = 0; i < children.length; i++) {
        children[i].checked = parentBtn.checked;
    }
}

// When a child is checked, ensure parent is also checked
function updateParentFromChild(pid, menuId) {
    let parentBtn = document.getElementById("sub_" + pid);
    let children = document.getElementsByClassName("in-parent-" + pid);
    let anyChecked = false;
    for (let i = 0; i < children.length; i++) {
        if (children[i].checked) {
            anyChecked = true;
            break;
        }
    }
    if (anyChecked) parentBtn.checked = true;
}

// Global Check/Uncheck All
function checkAll(status) {
    let checkboxes = document.querySelectorAll('#formRoleAccess input[type="checkbox"]');
    checkboxes.forEach(chk => chk.checked = status);
}
</script>

<style>
.sticky-bottom {
    position: sticky;
    bottom: 0;
}
.rounded-top-4 {
    border-top-left-radius: 1.5rem !important;
    border-top-right-radius: 1.5rem !important;
}
</style>

<?php $this->theme->footer("theme_default"); ?>

