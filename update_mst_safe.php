<?php
// update_mst_safe.php
// Menghapus isi file lama dan menimpanya dengan versi terbaru
// untuk memperbaiki error database 'mst_action' dan style tabel

header('Content-Type: text/plain');
echo "=== UPDATE MST TINDAKAN DIMULAI ===\n\n";

$base_path = __DIR__ . '/application/modules/mst_tindakan';

// ------------------------------------------------------------------
// 1. MODEL: Fix Error Database (Ganti mst_action -> mst_tindakan)
// ------------------------------------------------------------------
$model_code = <<<'EOD'
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tindakan extends CI_Model
{
    public function list_tindakan()
    {
        // FIX: Menggunakan tabel mst_tindakan (bukan mst_action)
        return $this->db->select('a.*, b.name as grup, c.name as subgrup')
            ->from('mst_tindakan a')
            ->join('mst_tindakan_grup b', 'a.id_group = b.id_group', 'left')
            ->join('mst_tindakan_subgrup c', 'a.id_subgroup = c.id_subgroup', 'left')
            ->order_by('a.name', 'ASC')
            ->get()->result();
    }

    public function get_tindakan($id)
    {
        return $this->db->where('id_act', $id)->get('mst_tindakan')->row();
    }

    public function list_group()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_tindakan_grup')->result();
    }

    public function list_subgroup()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_tindakan_subgrup')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('mst_tindakan', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_act', $id)->update('mst_tindakan', $data);
    }

    // Group Methods
    public function get_group($id)
    {
        return $this->db->where('id_group', $id)->get('mst_tindakan_grup')->row();
    }

    public function insert_group($data)
    {
        return $this->db->insert('mst_tindakan_grup', $data);
    }

    public function update_group($id, $data)
    {
        return $this->db->where('id_group', $id)->update('mst_tindakan_grup', $data);
    }
}
EOD;

file_put_contents($base_path . '/models/M_tindakan.php', $model_code);
echo "OK: Model M_tindakan.php telah diperbarui (Database Error FIXED).\n";


// ------------------------------------------------------------------
// 2. CONTROLLER: Fix Path View yang salah
// ------------------------------------------------------------------
$controller_code = <<<'EOD'
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mst_tindakan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tindakan');
        if (!isset($this->session->userdata['sp']->username)) {
            redirect('auth');
        }
    }

    public function index()
    {
        $this->mst_tindakan();
    }

    public function mst_tindakan()
    {
        $data['datalist'] = $this->M_tindakan->list_tindakan();
        $data['datalistgroup'] = $this->M_tindakan->list_group();
        // FIX: Path view mengarah ke mst_tindakan/views/
        $this->load->view('mst_tindakan/views/mst_tindakan', $data);
    }

    public function mst_tindakan_grup()
    {
        $data['datalist'] = $this->M_tindakan->list_group();
        $this->load->view('mst_tindakan/views/mst_tindakan_grup', $data);
    }

    public function save_tindakan_grup()
    {
        $data = [
            'name' => $this->input->post('nama_grup'),
            'description' => $this->input->post('deskripsi'),
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->M_tindakan->insert_group($data);
        redirect('mst_tindakan/mst_tindakan_grup');
    }

    public function update_tindakan_grup()
    {
        $id = $this->input->post('id_group');
        $data = [
            'name' => $this->input->post('nama_grup'),
            'description' => $this->input->post('deskripsi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->M_tindakan->update_group($id, $data);
        redirect('mst_tindakan/mst_tindakan_grup');
    }

    public function deleteitempo_tindakan_grup()
    {
        $id = $this->input->post('id');
        $this->M_tindakan->update_group($id, ['active' => 0]);
    }

    public function aktifasiitempo_tindakan_grup()
    {
        $id = $this->input->post('id');
        $this->M_tindakan->update_group($id, ['active' => 1]);
    }
}
EOD;

file_put_contents($base_path . '/controllers/Mst_tindakan.php', $controller_code);
echo "OK: Controller Mst_tindakan.php telah diperbarui.\n";


// ------------------------------------------------------------------
// 3. VIEW: Update Style agar mirip Smart Login
// ------------------------------------------------------------------
$view_code = <<<'EOD'
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
EOD;

file_put_contents($base_path . '/views/mst_tindakan.php', $view_code);
echo "OK: View mst_tindakan.php diperbarui (Style Mirip Smart Login).\n";

echo "\n===== SEMUA SELESAI =====\n";
echo "Silakan refresh halaman 'Master Tindakan' Anda sekarang.";
?>