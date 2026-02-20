<?php
class Gdf_purchase_order_penerimaan extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_purchase_order_penerimaan');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_purchase_order_penerimaan');
    }

    public function mstpbf(){
		$term = $this->input->get('term',true);
		$sql = "SELECT a.id_sup AS id_supp ,a.name AS nama_pbf
						FROM mst_supplier a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_pbf'];
			$rs[$k]['id'] = $v['id_supp'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    function ppnmargin(){
        $parameter_ppn_margin   = $this->D_Gdf_purchase_order_penerimaan->ppn_set();
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

        $data                    = $this->D_Gdf_purchase_order_penerimaan->dlistrpo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $no_rpo     = $this->input->post('id_rpo');
        $datasett   = $this->D_Gdf_purchase_order_penerimaan->dlistrpo_edt($no_rpo);
        $row_1      = $datasett->from;
        $row_2      = $datasett->nama_gudang;
        $row_3      = $datasett->pabrik;
        $row_4      = $datasett->id_pabrik;
        $row_5      = $datasett->tanggal;
        $row_6      = $datasett->no_spb;
        $row_7      = $datasett->tgl_spb;
        $row_8      = $datasett->no_faktur;
        $row_9      = $datasett->tgl_faktur;
        $row_10     = $datasett->no_surat_jalan;
        $row_11     = $datasett->id_purchase_order;
        $row_12     = $datasett->pbfsearch;
        $row_13     = $datasett->id_supp;
        $data = array(
            'row_0'     => $no_rpo,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4,
            'row_5'     => $row_5,
            'row_6'     => $row_6,
            'row_7'     => $row_7,
            'row_8'     => $row_8,
            'row_9'     => $row_9,
            'row_10'    => $row_10,
            'row_11'    => $row_11,
            'row_12'    => $row_12,
            'row_13'    => $row_13
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab(){
        $nosto        = $this->input->post('no_rpo_p_set');
        $data         = $this->D_Gdf_purchase_order_penerimaan->list_obat_per_norpo_edt($nosto);
		$dataset      = json_encode($data);
		echo $dataset;
    }    

    function editthis_apv(){ //bikin fungsi edit sto //masih blm bener
        $username              = @$this->session->userdata['sp']->login_name;
        $nosto                 = $this->input->post('edt_no_rpo_p_set');
        $datetime              = date('Y-m-d H:i:s'); //ST011901
        $no_spb                = $this->input->post('no_spb');
        $tanggal_spb           = $this->input->post('tgl_spb');
        $tanggal_spb_set       = date_create($tanggal_spb);
        $tanggalspb_set        = date_format($tanggal_spb_set,"Y-m-d");
        $no_faktur             = $this->input->post('no_faktur');
        $tanggal_faktur        = $this->input->post('tgl_faktur');
        $tanggal_faktur_set    = date_create($tanggal_faktur);
        $tanggalfaktur_set     = date_format($tanggal_faktur_set,"Y-m-d");
        $no_surat_jalan        = $this->input->post('no_surat_jalan');

        $id_set                 = $this->input->post('id_set');
        $id_det_request         = $this->input->post('id_det_request');
        $id_obat                = $this->input->post('id_obat');
        $nama_obat              = $this->input->post('nama_obat');
        $qty_aprv               = $this->input->post('qty_aprv');
        $nama_kemasan           = $this->input->post('nama_kemasan');
        $jumlah_satuan          = $this->input->post('jumlah_satuan');
        $nama_satuan            = $this->input->post('nama_satuan');
        $jumlah_diterima        = $this->input->post('jumlah_diterima'); 
        $harga_satuan           = $this->input->post('harga_satuan');
        $total_harga            = $this->input->post('total_harga');
        $id_purchase_order      = $this->input->post('id_purchase_order');
        $id_request_order       = $this->input->post('id_request_order');
        $jumlah_sisa            = $this->input->post('jumlah_sisa');
        $jumlah_diinput         = $this->input->post('jumlah_diinput');
        $id_pbf                 = $this->input->post('id_supp');

        ///////////////////
        /*$sql = "UPDATE gdf_purchase_order SET status='1',no_spb='$no_spb',tgl_spb='$tanggalspb_set',no_faktur='$no_faktur',tgl_faktur='$tanggalfaktur_set',no_surat_jalan='$no_surat_jalan',updated='$datetime',updated_by='$username' WHERE id_request_order='$nosto'";
        $this->db->query($sql);*/
        ///////////////////

        //gen no sto
        $checkid                       = $this->D_Gdf_purchase_order_penerimaan->cdk_penerimaan();
        $setnoreg                      = $checkid->id_proses_penerimaan;
        $prefix       = "PNR-";
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


        foreach($id_set as $k => $v){
            $id_det_request_set      = $id_det_request[$k]; 
            $id_obat_set             = $id_obat[$k];
            $nama_obat_set           = $nama_obat[$k];
            $qty_aprv_set            = $qty_aprv[$k];
            $nama_kemasan_set        = $nama_kemasan[$k];
            $jumlah_satuan_set       = $jumlah_satuan[$k];
            $nama_satuan_set         = $nama_satuan[$k];
            $jumlah_diterima_set     = $jumlah_diterima[$k];
            $harga_satuan_set        = $harga_satuan[$k];
            $total_harga_set         = $total_harga[$k];
            $id_purchase_order_set   = $id_purchase_order[$k];
            $id_request_order_set    = $id_request_order[$k];
            $jumlah_sisa_set         = $jumlah_sisa[$k];
            $jumlah_diinput_set      = $jumlah_diinput[$k];
 
            if($jumlah_sisa_set==0){
                $penerimaanstatus   =  "0";
                $exe_query_lengkap  = "UPDATE gdf_rpo_det SET status='4',updated='$datetime',updated_by='$username' WHERE id='$id_det_request_set'";
                $this->db->query($exe_query_lengkap);
            }else{
                $penerimaanstatus   =  "1";
            }

            $datains = array(  
                'id_purchase_order'             =>   $id_purchase_order_set,
                'id_request_order'              =>   $id_request_order_set,
                'id_det_request'                =>   $id_det_request_set,
                'id_proses_penerimaan'          =>   $id_gdfset,
                'validasi_date'                 =>   DATE('Y-m-d'),
                'nama_obat'                     =>   $nama_obat_set,
                'id_obat'                       =>   $id_obat_set,
                'qty_aprv'                      =>   $qty_aprv_set,
                'nama_kemasan'                  =>   $nama_kemasan_set,
                'jumlah_satuan'                 =>   $jumlah_satuan_set,
                'nama_satuan'                   =>   $nama_satuan_set,
                'jumlah_diterima'               =>   $jumlah_diinput_set,
                'harga_satuan'                  =>   $harga_satuan_set,
                'total_harga'                   =>   $total_harga_set,
                'no_spb'                        =>   $no_spb,
                'tgl_spb'                       =>   $tanggalspb_set,
                'no_faktur'                     =>   $no_faktur,
                'tgl_faktur'                    =>   $tanggalfaktur_set,
                'id_pbf'                        =>   $id_pbf,
                'no_surat_jalan'                =>   $no_surat_jalan,
                'status'                        =>   1,
                'penerimaanstatus'              =>   $penerimaanstatus,
                'created'                       =>   $datetime,
                'created_by'                    =>   $username
            );
            $this->D_Gdf_purchase_order_penerimaan->ins1($datains,'gdf_purchase_order_det');

        }

        $exe_query = "UPDATE gdf_rpo_det SET status='1',updated='$datetime',updated_by='$username' WHERE id_rpo='$id_request_order_set' AND status='3'";
        $this->db->query($exe_query);



        
        /*$checkdata          = $this->D_Gdf_purchase_order_penerimaan->cdk_check_por($id);
        $fnddata            = $checkdata->fnddata;

        if($fnddata==0){
            $exe_query = "INSERT INTO `gdf_purchase_order_det` (``, ``, ``, ``, ``,``, ``, ``, ``, ``,``,``,``,``,``,``,``,``,``,``,``,``) VALUES('".$id_por."','".$id_rpo."','".$id."','".$datetime."','".$nama_obat."','".$id_obat."','".$qty_aprv."','".$nama_kemasan."','".$jumlah_satuan."','".$nama_satuan."','".$jumlah_diterima."','".$harga_satuan."','".$total_harga."','".$no_spb."','".$tgl_spb."','".$no_faktur."','".$tgl_faktur."','".$no_surat_jalan."','1','".$penerimaanstatus."','".$username."','".$datetime."')";
            $this->db->query($exe_query);
        }else{
            $exe_query = "UPDATE gdf_purchase_order_det SET status='1',penerimaanstatus='$penerimaanstatus',no_spb='$no_spb',tgl_spb='$tgl_spb',no_faktur='$no_faktur',tgl_faktur='$tgl_faktur',no_surat_jalan='$no_surat_jalan',jumlah_diterima='$jumlah_diterima',harga_satuan='$harga_satuan',total_harga='$total_harga',updated='$datetime',updated_by='$username' WHERE id='$id_por_detnyah'";
            $this->db->query($exe_query);
        }

        $exe_query = "UPDATE gdf_rpo_det SET qty_diterima='$jumlah_diterima',status='3',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($exe_query);*/

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

    function detailpenerimaanbarang(){
        $id_rpo    	    = $this->input->post('id_rpo');
        $id_por    	    = $this->input->post('id_por');
        $datasett   	= $this->D_Gdf_purchase_order_penerimaan->detail_penerimaan_barang($id_rpo, $id_por);
        $dataset 		= json_encode($datasett);
        echo $dataset;
    }

    function detailpenerimaanbarang_cancel(){
        $id_rpo    	    = $this->input->post('id_rpo');
        $id_por    	    = $this->input->post('id_por');
        $datasett   	= $this->D_Gdf_purchase_order_penerimaan->detail_penerimaan_barang_cancel($id_rpo, $id_por);
        $dataset 		= json_encode($datasett);
        echo $dataset;
    }

    function proses_validasi_penerimaan_obat(){
        $username           = @$this->session->userdata['sp']->login_name;
        $datetime           = DATE('Y-m-d H:i:s');
        $id_por    	        = $this->input->post('id_por');
        $id_rpo    	        = $this->input->post('id_rpo'); 
        $id    	            = $this->input->post('id');
        $jumlah_diterima    = $this->input->post('qty_edit_set');
        $nama_obat    	    = $this->input->post('nama_obat');
        $id_obat    	    = $this->input->post('id_obat');
        $qty_aprv    	    = $this->input->post('qty_aprv');
        $nama_kemasan       = $this->input->post('nama_kemasan');
        $jumlah_satuan      = $this->input->post('jumlah_satuan');
        $nama_satuan        = $this->input->post('nama_satuan');
        $harga_satuan       = $this->input->post('harga_satuan');
        $total_harga        = $this->input->post('total_harga');


        $exe_query = "UPDATE gdf_rpo_det SET qty_diterima = IF(qty_diterima IS NULL , $jumlah_diterima, qty_diterima+$jumlah_diterima),status='3',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($exe_query);
        
        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;

    }

    function proses_validasi_penerimaan_obat_cancel(){
        $username               = @$this->session->userdata['sp']->login_name;
        $id    	                = $this->input->post('id');
        $id_request             = $this->input->post('id_request');
        $jumlah_diterima_set    = $this->input->post('jumlah_diterima');
        $jumlah_set_set         = $this->input->post('jumlah_set');
        $total_diinput          = $this->input->post('total_diinput');
        $datetime               = DATE('Y-m-d H:i:s');

        if($jumlah_diterima_set==0 || $jumlah_diterima_set==null){ 
            $jumlah_diterima    = 0;
        }else{
            $jumlah_diterima     = $jumlah_diterima_set;
        }

        if($jumlah_set_set==0 || $jumlah_set_set==null){ 
            $jumlah_set    = 0;
        }else{
            $jumlah_set     = $jumlah_set_set;
        }

        $jumlah_diterima_canceled = ($jumlah_set - $jumlah_diterima);

        $jumlah_last_diterima   = $this->D_Gdf_purchase_order_penerimaan->last_jumlah_diterima($id);
        $jumlah_last_diterima   = $jumlah_last_diterima->qty_diterima;

        $update_qty_diterima    = ($jumlah_last_diterima - $jumlah_diterima_canceled);

        $exe_query_gdf_request_pembelian = "UPDATE gdf_rpo_det SET qty_diterima='$update_qty_diterima', status='1',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($exe_query_gdf_request_pembelian);

        $data           ="ok";
        $dataset        = json_encode($data);
		echo $dataset;

    }
    
}
?>