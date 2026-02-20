<?php
class Gdf extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_Gdf');
    }
    function listdatatfo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data                    = $this->D_Gdf->dlisttfo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    
    public function mstgudang(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_wrh ,a.name AS nama_gudang
						FROM mst_warehouse a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_gudang'];
			$rs[$k]['id'] = $v['id_wrh'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }
    public function mstobat(){
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_fa AS id_obat,a.name AS nama_obat,qty AS qty_last
                FROM    mst_farmalkes a 
                LEFT JOIN mst_soh b ON a.id_fa = b.id_soh
                WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%' AND b.id_wrh='001'
                ";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_obat'];
			$rs[$k]['id'] = $v['id_obat'];
            $rs[$k]['qty_last'] = $v['qty_last'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    function check_data_mst_obat(){
        $id_obat_set          = $this->input->post('id_obat');
        $id_wrh_set           = $this->input->post('id_wrh');
        $data                 = $this->D_Gdf->data_check_mst_obat($id_obat_set,$id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }


    function checksohitemini(){
        $id_obat_set          = $this->input->post('id_obat');
        $data                 = $this->D_Gdf->data_soh_obat($id_obat_set);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function save(){
        $username              = @$this->session->userdata['sp']->login_name;
        $no_tfo_set            = $this->input->post('no_tfo_p_set');
        $id_wrh_set            = $this->input->post('id_wrh');
        $id_obat_set           = $this->input->post('id_obat');
        $qty_last_set          = $this->input->post('qty_last');
        $qty_depo_set          = $this->input->post('qty_depo');
        $qty                   = $this->input->post('qty');

        $datetime              = date('Y-m-d H:i:s'); 
        $datetime_req          = date('Y-m-d'); 
        if(empty($no_tfo_set)){
        //gen no sto
        $checkid                       = $this->D_Gdf->cdk();
        $setnoreg                      = $checkid->id_tfo;
        $prefix       = "TFO-";
        $datereal_tgl = date('d');
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 6, 2);
        $setnoreg_thn = substr($setidregfnc, 8, 2);
        $urutan_reg = (int) substr($setidregfnc, 10, 16);
        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";
        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.sprintf("%06s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }else{
            $setincrement_reg = "000001";
            $id_gdfset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }
        //end gen no sto
        $datains = array(  
            'id_tfo'            =>   $id_gdfset,
            'request_date'      =>   $datetime_req,
            'from'              =>   '001',
            'to'                =>   $id_wrh_set,
            'status'            =>   0,
            'created'           =>   $datetime,
            'created_by'        =>   $username
        );
        $this->D_Gdf->ins1($datains,'gdf_tfo'); 

        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty_set            = $qty[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
 
            $datains = array(  
                'id_tfo'          =>   $id_gdfset,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty_set,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf->ins1($datains,'gdf_tfo_det');

        }



        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_gdfset'     => $id_gdfset
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }else{
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty_set            = $qty[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
 
            $datains = array(  
                'id_tfo'          =>   $no_tfo_set,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty_set,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf->ins1($datains,'gdf_tfo_det');

        }


        $senddata = array(
            'id_wrh_set'     => $id_wrh_set,
            'id_gdfset'      => $no_tfo_set
        );
        $dataset = json_encode($senddata);
		echo $dataset;
    }
    }
    function listpernotfo(){
        $no_tfo_p       = $this->input->post('no_tfo_p_set');
        $data           = $this->D_Gdf->list_obat_per_notfo($no_tfo_p);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $no_tfo     = $this->input->post('id');
        $datasett   = $this->D_Gdf->dlisttfo_edt($no_tfo);
        $row_1      = $datasett->to;
        $row_2      = $datasett->nama_gudang;
        $data = array(
            'row_0'     => $no_tfo,
            'row_1'     => $row_1,
            'row_2'     => $row_2
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab(){
        $nosto        = $this->input->post('no_tfo_p_set');
        $data           = $this->D_Gdf->list_obat_per_notfo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit_tab_ststo(){
        $nosto          = $this->input->post('no_tfo_p_set');
        $data           = $this->D_Gdf->list_obat_per_notfo_edt_ststo($nosto); 
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab_endsto(){
        $nosto          = $this->input->post('no_tfo_p_set');
        $data           = $this->D_Gdf->list_obat_per_notfo_edt_ststo_finish($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }
    function listobatpernosto_edt(){
        $nosto        = $this->input->post('no_tfo_set');
        $data           = $this->D_Gdf->list_obat_per_notfo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    
    function editthis(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $no_tfo_set            = $this->input->post('edt_no_tfo_p_set');
        $id_wrh_set            = $this->input->post('edt_id_wrh');
        $id_obat_set           = $this->input->post('edt_id_obat');
        $qty_last_set          = $this->input->post('edt_qty_last');
        $qty_depo_set          = $this->input->post('edt_qty_depo');
        $qty                   = $this->input->post('edt_qty');
        $datetime              = date('Y-m-d H:i:s'); //ST011901
        foreach($id_obat_set as $k => $v){
            $id_obat            = $id_obat_set[$k]; 
            $qty                = $qty[$k];
            $qty_last           = $qty_last_set[$k];
            $qty_depo           = $qty_depo_set[$k];
 
            $datains = array(  
                'id_tfo'          =>   $no_tfo_set,
                'id_obat'         =>   $id_obat,
                'qty'             =>   $qty,
                'qty_last'        =>   $qty_last,
                'qty_depo'        =>   $qty_depo,
                'created'         =>   $datetime,
                'created_by'      =>   $username
            );
            $this->D_Gdf->ins1($datains,'gdf_tfo_det');

        }
        $senddata = array(
            'id_wrh_set'    => $id_wrh_set,
            'id_gdfset'     => $no_tfo_set
        );

        $dataset = json_encode($senddata);
		echo $dataset;
    }
    function deleteitemedit(){
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $id_set         = $this->input->post('id_obat');
        $sql            = "UPDATE gdf_tfo_det SET hapus = '1',updated='$datetime',updated_by='$username' WHERE id='$id_set'";
        $this->db->query($sql);
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }

    function cancelstokopname_set_up(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id_tfo     = $this->input->post('id_tfo'); 
        $sql = "UPDATE gdf_tfo SET status = '1',updated='$datetime',updated_by='$username' WHERE id_tfo='$id_tfo'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

}
?>