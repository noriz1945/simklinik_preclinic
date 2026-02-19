<?php
class Gdf_purchase_order extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_purchase_order');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_purchase_order');
    }

    function ppnmargin(){
        $parameter_ppn_margin   = $this->D_Gdf_purchase_order->ppn_set();
        $ppn_set                = $parameter_ppn_margin->ppn;
        $dataset                = json_encode($ppn_set);
		echo $dataset;
    }
    function listdatarpo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data                    = $this->D_Gdf_purchase_order->dlistrpo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    


    function listpernorpo(){
        $no_rpo_p       = $this->input->post('no_rpo_p_set');
        $id_wrh         = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_purchase_order->list_obat_per_norpo($no_rpo_p, $id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listpernorpo_depo(){
        $no_rpo_p       = $this->input->post('no_rpo_p_set'); 
        $id_wrh_set     = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_purchase_order->list_obat_per_norpo_depo($no_rpo_p, $id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    public function mstpabrik(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_pabrik ,a.name AS nama_pabrik
						FROM mst_pabrik a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_pabrik'];
			$rs[$k]['id'] = $v['id_pabrik'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    function edit(){
        $no_rpo     = $this->input->post('id');
        $datasett   = $this->D_Gdf_purchase_order->dlistrpo_edt($no_rpo);
        $row_1      = $datasett->from;
        $row_2      = $datasett->nama_gudang;
        $row_3      = $datasett->pabrik;
        $row_4      = $datasett->id_pabrik;
        $row_5      = $datasett->tanggal;
        $data = array(
            'row_0'     => $no_rpo,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4,
            'row_5'     => $row_5
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab(){
        $nosto        = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_purchase_order->list_obat_per_norpo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function editthis_apv(){ //bikin fungsi edit sto
        $username              = @$this->session->userdata['sp']->login_name;
        $nosto                 = $this->input->post('edt_no_rpo_p_set');
        $closedate             = date('Y-m-d');
        $id_pabrik             = $this->input->post('id_pabrik');
        $pabrik                = $this->input->post('pabriksearch');
        $tanggal_po            = $this->input->post('tanggal_po');
        $tanggal_po_set        = date_create($tanggal_po);
        $tanggalpo_set         = date_format($tanggal_po_set,"Y-m-d");
        $datetime              = date('Y-m-d H:i:s'); //ST011901

        /*$no_spb                = $this->input->post('no_spb');
        $tanggal_spb           = $this->input->post('tanggal_spb');
        $tanggal_spb_set       = date_create($tanggal_spb);
        $tanggalspb_set        = date_format($tanggal_spb_set,"Y-m-d");
        $no_faktur             = $this->input->post('no_faktur');
        $tanggal_faktur        = $this->input->post('tanggal_faktur');
        $tanggal_faktur_set    = date_create($tanggal_faktur);
        $tanggalfaktur_set     = date_format($tanggal_faktur_set,"Y-m-d");
        $no_surat_jalan        = $this->input->post('no_surat_jalan');*/

        ///////////////////
        $sql            = "UPDATE gdf_rpo_det SET status = '1',updated='$datetime',updated_by='$username' WHERE id_rpo='$nosto'";
        $set_det        = $this->db->query($sql);
        $sql_par        = "UPDATE gdf_rpo SET id_pabrik='$id_pabrik',pabrik='$pabrik',tanggal='$tanggalpo_set',closedate='$closedate',status = '3',updated='$datetime',updated_by='$username' WHERE id_rpo='$nosto'";
        $set_par        = $this->db->query($sql_par);
        ///////////////////

        ///set row po
        //gen no sto
        $checkid                       = $this->D_Gdf_purchase_order->cdk();
        $setnoreg                      = $checkid->id_purchase_order;
        $prefix       = "POR-";
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
            'id_purchase_order'     =>   $id_gdfset,
            'create_order_date'     =>   $datetime,
            'id_request_order'      =>   $nosto,
            'id_pabrik'             =>   $id_pabrik,
            'pabrik'                =>   $pabrik,
            'tanggal'               =>   $tanggalpo_set, 
            /*'no_spb'                =>   $no_spb, 
            'tgl_spb'               =>   $tanggalspb_set, 
            'no_faktur'             =>   $no_faktur, 
            'tgl_faktur'            =>   $tanggalfaktur_set, 
            'no_surat_jalan'        =>   $no_surat_jalan, */
            'status'                =>   0,
            'created'               =>   $datetime,
            'created_by'            =>   $username
        );
        $this->D_Gdf_purchase_order->ins1($datains,'gdf_purchase_order'); 
        ///end set row po
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }
    function deleteitemedit(){
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $id_set         = $this->input->post('id_obat');
        $sql            = "UPDATE gdf_rpo_det SET hapus = '1',updated='$datetime',updated_by='$username' WHERE id='$id_set'";
        $this->db->query($sql);
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;
    }



}
?>