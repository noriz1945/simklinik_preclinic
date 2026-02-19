<?php $this->theme->head('theme_default'); ?>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-locked">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title fw-bold mb-0">Master Tindakan & Layanan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-group d-flex">
                            <input type="text" id="custom-search" class="form-control me-2"
                                placeholder="Cari Tindakan...">
                            <button type="button" class="btn btn-primary" id="btn-apply-search"><i
                                    class="fa fa-search"></i> Cari</button>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Detail Tindakan</th>
                                    <th>Grup / Subgrup</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datalist as $dt): ?>
                                    <tr>
                                        <td>
                                            <strong><?= $dt->name ?></strong><br>
                                            <small class="text-muted">ID: <?= $dt->id_act ?></small>
                                        </td>
                                        <td>
                                            <?= $dt->grup ?: '-' ?><br>
                                            <small><?= $dt->subgrup ?: '-' ?></small>
                                        </td>
                                        <td><span class="badge badge-info"><?= $dt->type ?: 'General' ?></span></td>
                                        <td>
                                            <span class="badge badge-<?= $dt->aktif == 1 ? 'success' : 'danger' ?>">
                                                <?= $dt->aktif == 1 ? 'Aktif' : 'Nonaktif' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $dt->id_act ?>"><i
                                                    class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-<?= $dt->aktif == 1 ? 'danger' : 'success' ?>"
                                                onclick="toggleAktif('<?= $dt->id_act ?>', '<?= htmlspecialchars($dt->name) ?>', '<?= $dt->aktif == 1 ? 'nonaktif' : 'aktif' ?>')">
                                                <i class="fa fa-power-off"></i>
                                                <?= $dt->aktif == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
                                            </button>
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
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
    $(document).ready(function () {
        var table = $('.datatable').DataTable({
            "dom": "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "processing": true,
            "language": {
                "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            }
        });

        $('#custom-search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });

    function toggleAktif(id, name, action) {
        if (confirm('Apakah Anda yakin ingin mengubah status ' + name + '?')) {
            var url = "<?= base_url('mst_tindakan/') ?>" + (action == 'nonaktif' ? 'deleteitempo_tindakan' : 'aktifasiitempo_tindakan');
            $.post(url, { id: id }, function () { location.reload(); });
        }
    }
</script>
<?php $this->theme->footer('theme_default'); ?>