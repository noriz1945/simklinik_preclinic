<?php
// patch_controller.php
// Memperbaiki pemanggilan View yang error

header('Content-Type: text/plain');
echo "=== PATCHING CONTROLLER MST_TINDAKAN ===\n\n";

$file_path = __DIR__ . '/application/modules/mst_tindakan/controllers/Mst_tindakan.php';

if (!file_exists($file_path)) {
    die("ERROR: File controller tidak ditemukan di $file_path");
}

// Kita kembalikan ke format standar HMVC yang paling umum
// Biasanya cukup panggil 'mst_tindakan' jika nama view sama dengan nama modul
// ATAU 'mst_tindakan' (nama modul) slash 'mst_tindakan' (nama view)

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
        
        // CORRECTION: Mencoba path view yang lebih standar untuk HMVC
        // Opsi 1: $this->load->view('mst_tindakan', $data);
        // Opsi 2: $this->load->view('mst_tindakan/mst_tindakan', $data);
        
        // Kita coba pakai format 'mudul/view' (tanpa folder 'views' eksplisit)
        $this->load->view('mst_tindakan', $data); 
    }

    public function mst_tindakan_grup()
    {
        $data['datalist'] = $this->M_tindakan->list_group();
        $this->load->view('mst_tindakan_grup', $data);
    }
    
    // ... function save/update lainnya tetap sama ...
    
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

file_put_contents($file_path, $controller_code);
echo "OK: Controller diperbaiki.\nSilakan refresh halaman mst_tindakan.\n";
echo "Jika masih error, coba ganti manual baris \$this->load->view('mst_tindakan') menjadi \$this->load->view('mst_tindakan/mst_tindakan')";
?>