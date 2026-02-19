<?php $this->theme->head("theme_default"); ?>
<?php $this->theme->wrapper_open("theme_default"); ?>

<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
            <div class="my-auto mb-2">
                <h3 class="page-title mb-1">Master Data Kelas</h3>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="ti ti-home"></i></a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item">Umum</li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas Pelayanan</li>
                    </ol>
                </nav>
            </div>
            <div class="mb-2">
                <a href="javascript:void(0);" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalAdd">
                    <i class="ti ti-square-rounded-plus me-2"></i>Tambah Kelas
                </a>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table w-100 class="table w-100 table-hover align-middle mb-0 datatable w-100 w-100">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3 border-bottom-0" width="50">#</th>
                                <th class="border-bottom-0">Nama Kelas Pelayanan</th>
                                <th class="border-bottom-0">Level / Urutan</th>
                                <th class="border-bottom-0" width="120">Status</th>
                                <th class="text-center border-bottom-0" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($datalist as $dt): ?>
                                <tr>
                                    <td class="ps-3 text-muted">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xs bg-soft-info text-info rounded me-2">
                                                <i class="ti ti-building-hospital fs-14"></i>
                                            </div>
                                            <h6 class="mb-0 fs-14 text-dark">
                                                <?= $dt->name ?>
                                            </h6>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border fs-11">Lv.
                                            <?= $dt->level ?: '0' ?>
                                        </span></td>
                                    <td>
                                        <?php if ($dt->aktif == 1): ?>
                                            <span class="badge badge-soft-success rounded-pill px-3 py-2"><i
                                                    class="ti ti-check me-1"></i>Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-soft-danger rounded-pill px-3 py-2"><i
                                                    class="ti ti-x me-1"></i>Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-3">
                                        <div class="dropdown">
                                            <button class="btn btn-icon btn-sm btn-light shadow-none" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                                                <li><a class="dropdown-item py-2" href="javascript:void(0)"><i
                                                            class="ti ti-edit-circle me-2 text-info fs-16"></i> Edit
                                                        Data</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)"><i
                                                            class="ti ti-trash me-2 fs-16"></i> Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close("theme_default"); ?>
<?php $this->theme->script("theme_default"); ?>
<script>
    $(document).ready(function () {
        if ($('.datatable').length > 0) {
            $('.datatable').DataTable({
                destroy: true,
                "language": { "search": "Cari:", "lengthMenu": "_MENU_", "info": "Data _START_ - _END_ dari _TOTAL_" }
            });
        }
    });
</script>
<?php $this->theme->footer("theme_default"); ?>
