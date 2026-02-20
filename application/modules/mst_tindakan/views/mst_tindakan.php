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
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('mst_tindakan/create'), 'Tambah Data', 'class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"'); ?>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <!-- Flash message area if needed -->
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <form action="" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo isset($q) ? $q : ''; ?>">
                                    <span class="input-group-btn">
                                        <?php if (isset($q) && $q != ''): ?>
                                            <a href="<?php echo site_url('mst_tindakan'); ?>" class="btn btn-default">Reset</a>
                                        <?php endif; ?>
                                        <button class="btn btn-primary" type="button" id="btn-apply-search">Cari</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Detail Tindakan</th>
                                    <th>Grup / Subgrup</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $start = 0;
                                if(isset($datalist) && is_array($datalist)) {
                                    foreach ($datalist as $dt): 
                                ?>
                                <tr>
                                    <td width="80px"><?php echo ++$start ?></td>
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
                                        <span class="badge badge-<?= $dt->aktif==1?'success':'danger' ?>">
                                            <?= $dt->aktif==1?'Aktif':'Nonaktif' ?>
                                        </span>
                                    </td>
                                    <td nowrap>
                                        <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $dt->id_act ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-<?= $dt->aktif==1?'danger':'success' ?>" 
                                            onclick="toggleAktif('<?= $dt->id_act ?>', '<?= htmlspecialchars($dt->name) ?>', '<?= $dt->aktif==1?'nonaktif':'aktif' ?>')">
                                            <i class="fa fa-power-off"></i> <?= $dt->aktif==1?'Nonaktifkan':'Aktifkan' ?>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; 
                                } else { ?>
                                    <tr><td colspan="6" class="text-center">Data kosong</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Data : <?php echo isset($datalist) ? count($datalist) : 0; ?></a>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Pagination would go here -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
$(document).ready(function() {
    $('#btn-apply-search').click(function() {
       $(this).closest('form').submit();
    });
});

function toggleAktif(id, name, action) {
    if(confirm('Apakah Anda yakin ingin mengubah status ' + name + '?')) {
        // Fix path controller deleteitempo
        var url = "<?= base_url('mst_tindakan/') ?>" + (action == 'nonaktif' ? 'deleteitempo_tindakan' : 'aktifasiitempo_tindakan');
        $.post(url, { id: id }, function() { location.reload(); });
    }
}
</script>
<?php $this->theme->footer('theme_default'); ?>