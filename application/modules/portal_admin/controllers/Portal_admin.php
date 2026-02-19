<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Portal_admin_model');
        $this->load->library(['session','form_validation']);
        $this->load->helper(['url','form','security']);
    }

    public function index()
    {
        $search = $this->input->get('q', TRUE);
        $data['search'] = $search;
        $data['rows']   = $this->Portal_admin_model->get_patients($search, 100);
        $this->load->view('vPortal_admin_list', $data);
    }

    // TERIMA id_pasien apa adanya (mis. "00011098"), JANGAN dinormalisasi
    public function get_detail_ajax($id_pasien)
    {
        $row = $this->Portal_admin_model->get_patient_by_id($id_pasien);
        if (!$row) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['status'=>false,'message'=>'Data tidak ditemukan']));
        }
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['status'=>true,'data'=>$row]));
    }

    public function save_contact_pin_ajax()
    {
        $id_pasien = $this->input->post('id_pasien', TRUE); // sudah berleading zero
        $hp        = $this->input->post('hp', TRUE);
        $pin       = $this->input->post('pin', TRUE);

        if (!$id_pasien) return $this->_json(false, 'ID pasien wajib.');
        if (!preg_match('/^[0-9]{6}$/', $pin)) return $this->_json(false, 'PIN harus 6 digit.');
        if (!preg_match('/^[0-9]+$/', $hp)) return $this->_json(false, 'HP/WA hanya angka.');

        $ok = $this->Portal_admin_model->update_contact_pin($id_pasien, $hp, $pin);
        return $this->_json($ok, $ok ? 'Tersimpan.' : 'Gagal simpan.');
    }

    public function generate_pin_ajax()
    {
        $pin = str_pad((string)mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        return $this->_json(true, 'ok', ['pin'=>$pin]);
    }

    private function _json($status, $message, $extra = [])
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array_merge(['status'=>$status,'message'=>$message], $extra)));
    }
}
?>
