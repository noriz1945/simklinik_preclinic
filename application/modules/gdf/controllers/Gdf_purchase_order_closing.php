<?php
class Gdf_purchase_order_closing extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_purchase_order_closing');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function escape($text){
        return str_replace(array(","), array(""), $text);
     }
    function index(){
        $this->load->view('list_purchase_order_closing');
    }

    function ppnmargin(){
        $parameter_ppn_margin   = $this->D_Gdf_purchase_order_closing->ppn_set();
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

        $data                    = $this->D_Gdf_purchase_order_closing->dlistrpo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $no_rpo     = $this->input->post('id_rpo');
        $datasett   = $this->D_Gdf_purchase_order_closing->dlistrpo_edt($no_rpo);
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
        );
		$dataset = json_encode($data);
		echo $dataset;
    }
    function edit_tab(){
        $nosto        = $this->input->post('no_rpo_p_set');
        $data           = $this->D_Gdf_purchase_order_closing->list_obat_per_norpo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function editthis_apv(){
        $username              = @$this->session->userdata['sp']->login_name;
        $nosto                 = $this->input->post('id_por');
        $id_proses_penerimaan  = $this->input->post('id_proses_penerimaan');
        $datetime              = date('Y-m-d H:i:s');
        $tgl_closing           = date('Y-m-d');

        ///kartu stok
        //gen no sto
        $checkid                       = $this->D_Gdf_purchase_order_closing->cdk_kartu_stok();
        $setnoreg                      = $checkid->id_kode;
        $prefix       = "SPB-";
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
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.sprintf("%06s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }else{
            $setincrement_reg = "000001";
            $id_stoset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn.$setincrement_reg;
        }
        $proses_soh_data = $this->D_Gdf_purchase_order_closing->proses_soh($id_proses_penerimaan);
        foreach($proses_soh_data as $dataset){
            $id_obat        = $dataset->id_obat;
            $id_wrh         = '001';
            $qty            = $dataset->jumlah_diterima;
            $nama_obat      = $dataset->nama_obat;
            $nama_supplier  = $dataset->nama_supplier;

            //KARTU STOK 
            //STO
            $kartu_stok_sto = $this->D_Gdf_purchase_order_closing->get_data_obat($id_obat, $id_wrh);
            $qty_kartu_stok = $kartu_stok_sto->qty;
            $qty_set_up     = ($qty_kartu_stok + $qty);

            ///////////////////////////////////////////////////////////////////////kartu stok STO
            

            $datains2 = array(  
                'id_wrh'         =>   $id_wrh,
                'id_fa'          =>   $id_obat,
                'datetime'       =>   $datetime,
                'id_kode'        =>   $id_stoset,
                'kode'           =>   'SPB',
                'nama_transaksi' =>   $id_stoset.'/ '.$nama_obat.' / '.$nama_supplier,
                'in'             =>   $qty,
                'saldo'          =>   $qty_set_up,
                'created'        =>   $datetime,
                'created_by'     =>   $username
            );
            $this->D_Gdf_purchase_order_closing->ins2($datains2,'gdf_kartu_stok');

            ////////////////////////////////////////////////////////////////////////End kartu stok

            $kartu_sto_up = "UPDATE mst_soh SET qty='$qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'";
            $this->db->query($kartu_sto_up);
            //END STO
            
        }
        //end gen no sto

        ///////////////////
        /* nanti pisah fungsi aja button close semua
        $total_id_penerimaan        = $this->D_Gdf_purchase_order_closing->get_data_count($nosto);
        $fnndata_total_penerimaan   = $total_id_penerimaan->fnddata;

        if($fnndata_total_penerimaan==1){
            $sql_0 = "UPDATE gdf_purchase_order SET status='2',tanggal_closing='$tgl_closing',updated='$datetime',updated_by='$username' WHERE id_purchase_order='$nosto'";
            $this->db->query($sql_0);

            $sql = "UPDATE gdf_purchase_order_det SET status='3',tgl_closing='$tgl_closing',updated='$datetime',updated_by='$username' WHERE id_proses_penerimaan='$id_proses_penerimaan'";
            $this->db->query($sql);
        }else{
            $sql = "UPDATE gdf_purchase_order_det SET status='3',tgl_closing='$tgl_closing',updated='$datetime',updated_by='$username' WHERE id_proses_penerimaan='$id_proses_penerimaan'";
            $this->db->query($sql);
        }*/
        $sql = "UPDATE gdf_purchase_order_det SET status='3',tgl_closing='$tgl_closing',updated='$datetime',updated_by='$username' WHERE id_proses_penerimaan='$id_proses_penerimaan'";
        $this->db->query($sql);
        ///////////////////
        //end kartu stok
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


    function detailpenerimaanbarang_closing(){
        $id        	    = $this->input->post('id');
        $datasett   	= $this->D_Gdf_purchase_order_closing->detail_closing($id);
        $dataset 		= json_encode($datasett);
        echo $dataset;
    }

    function listdetailpenerimaanbarang_closing(){
        $id_por    	    = $this->input->post('id_por');
        $datasett   	= $this->D_Gdf_purchase_order_closing->list_detail_closing($id_por);
        $dataset 		= json_encode($datasett);
        echo $dataset;
    }

    
}
?>