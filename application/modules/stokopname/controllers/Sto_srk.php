<?php
class Sto_srk extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Sto');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }

    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_sto_srk');
    }
    function listdatasto_gudang(){
        $data           = $this->D_Sto->dliststo_gudang();
		$dataset = json_encode($data);
		echo $dataset;
    }

    function edit_end_sto(){
        $datasett           = $this->D_Sto->dliststo_edt_endsto($id);
        $row_0              = $datasett->name;
        $data = array(
            'row_0'     => $row_0,
        );
		$dataset = json_encode($data);
		echo $dataset;
    }

    function list_obat_per_gudang(){
        $id          = $this->input->post('id');
        $data           = $this->D_Sto->list_obat_per_gudang($id);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function set_qty_on_startstokopname(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_obat    = $this->input->post('id_obat'); 
        $id_wrh     = $this->input->post('wrh'); 
        $no_rak     = $this->input->post('norak_nyah');
        $noraksetup = $this->escape($no_rak);

        $checkid                       = $this->D_Sto->cdk_gudang($id_obat, $id_wrh);
        $findrak                       = $checkid->countget;

        if($findrak > 0){
            $sql = "UPDATE mst_wrh_mm SET no_rak='$noraksetup',updated='$datetime',updater='$username' WHERE id_fa='$id_obat' AND id_wrh='$id_wrh'";
            $this->db->query($sql);
        }else{
            $sql = "INSERT INTO mst_wrh_mm (id_fa, id_wrh, no_rak, created, creator) VALUES ('$id_obat', '$id_wrh', '$noraksetup', '$username', '$datetime'); ";
            $this->db->query($sql);
        }

        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function set_qty_on_startstokopname_min(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_obat    = $this->input->post('id_obat'); 
        $id_wrh     = $this->input->post('wrh'); 
        $no_min     = $this->input->post('min_nyah');
        $noraksetup = $this->escape($no_min);


        $sql = "UPDATE mst_wrh_mm SET min='$no_min',updated='$datetime',updater='$username' WHERE id_fa='$id_obat' AND id_wrh='$id_wrh'";
        $this->db->query($sql);

        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

}
?>