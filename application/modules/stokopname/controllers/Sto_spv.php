<?php
class Sto_spv extends MX_controller
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
        $this->load->view('list_sto_spv');
    }
    function listdatasto(){
        $data           = $this->D_Sto->dliststo_spv();
		$dataset = json_encode($data);
		echo $dataset;
    }

    function edit_end_sto(){
        $no_sto             = $this->input->post('id');
        $datasett           = $this->D_Sto->dliststo_edt_endsto($no_sto);
        $row_1              = $datasett->id_wrh;
        $row_2              = $datasett->nama_gudang;
        $datestart_sto_set  = date_create($datasett->sto_startdate);
        $row_3              = date_format($datestart_sto_set,"d-m-Y H:i:s");
        $dateend_sto_set    = date_create($datasett->sto_enddate);
        $row_4              = date_format($dateend_sto_set,"d-m-Y H:i:s");
        $row_5              = $datasett->catatan;
        $data = array(
            'row_0'     => $no_sto,
            'row_1'     => $row_1,
            'row_2'     => $row_2,
            'row_3'     => $row_3,
            'row_4'     => $row_4,
            'row_5'     => $row_5
        );
		$dataset = json_encode($data);
		echo $dataset;
    }

    function edit_tab_endsto(){
        $nosto          = $this->input->post('no_sto_p_set');
        $start_set          = $this->input->post('startdate');
        $finish_set         = $this->input->post('finishdate');
        $datestart_sto_set  = date_create($start_set);
        $start              = date_format($datestart_sto_set,"Y-m-d H:i:s");
        $datefinish_sto_set  = date_create($finish_set);
        $finish              = date_format($datefinish_sto_set,"Y-m-d H:i:s");

        $starttime              = date_format($datestart_sto_set,"Y-m-d H:i:s");
        $finishtime             = date_format($datefinish_sto_set,"Y-m-d H:i:s");
        $data           = $this->D_Sto->list_obat_per_nosto_edt_endsto($nosto, $starttime, $finishtime);
		$dataset = json_encode($data);
		echo $dataset;
    }

    function set_qty_on_startstokopname(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id         = $this->input->post('id'); 
        $qty        = $this->input->post('qty_nyah');
        $qtysetup   = $this->escape($qty);
        $sql = "UPDATE trx_lgs_sto_det SET qty='$qtysetup',updated='$datetime',updater='$username' WHERE id_trx='$id'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function update_soh_final(){
        $username           = @$this->session->userdata['sp']->login_name;
        $datetime           = date('Y-m-d H:i:s');
        $nosto              = $this->input->post('no_sto_p_set');
        $start_set          = $this->input->post('startdate');
        $finish_set         = $this->input->post('finishdate');
        $datestart_sto_set  = date_create($start_set);
        $start              = date_format($datestart_sto_set,"Y-m-d");
        $datefinish_sto_set = date_create($finish_set);
        $finish             = date_format($datefinish_sto_set,"Y-m-d");

        $starttime              = date_format($datestart_sto_set,"Y-m-d H:i:s");
        $finishtime             = date_format($datefinish_sto_set,"Y-m-d H:i:s");
        //gen no sto
        $checkid                       = $this->D_Sto->cdk_kartu_stok();
        $setnoreg                      = $checkid->id_kode;
        $prefix       = "STO-";
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
        //end gen no sto

        $proses_soh_data = $this->D_Sto->proses_soh($nosto, $starttime, $finishtime);
        foreach($proses_soh_data as $dataset){
            $id_obat = $dataset->id_trx_det;
            $id_wrh  = $dataset->id_wrh;
            $qty     = $dataset->total_fix;

            $fndddata = $this->D_Sto->check_data_mst_soh($id_obat, $id_wrh);
            $jksdhada = $fndddata->datafnd;

            if($jksdhada < 1){
                $datains = array(  
                    'id_soh'            =>   $id_obat,
                    'id_wrh'            =>   $id_wrh,
                    'qty'               =>   $qty,
                    'created'           =>   $datetime,
                    'creator'           =>   $username
                );
                $this->D_Sto->ins1($datains,'mst_soh'); 
            }else{
                $sql = "UPDATE mst_soh SET qty='$qty',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'";
                $this->db->query($sql);
                $sql_stodet = "UPDATE trx_lgs_sto_det SET qty_soh='$qty',updated='$datetime',updater='$username' WHERE id_sto='$nosto' AND id_trx_det='$id_obat'";
                $this->db->query($sql_stodet);
            }

            //KARTU STOK 
            //STO
            $kartu_stok_sto = $this->D_Sto->get_data_obat($id_obat, $id_wrh);
            $qty_kartu_stok = $kartu_stok_sto->qty;
            $qty_set_up     = $qty_kartu_stok;

            ///////////////////////////////////////////////////////////////////////kartu stok STO
            

            $datains2 = array(  
                'id_wrh'         =>   $id_wrh,
                'id_fa'          =>   $id_obat,
                'datetime'       =>   $datetime,
                'id_kode'        =>   $id_stoset,
                'kode'           =>   'STO',
                'nama_transaksi' =>   $id_stoset.'/ Start '.$start.' / End '.$finish.' / Qty '.$qty_set_up,
                'in'             =>   $qty,
                'saldo'          =>   $qty_set_up,
                'created'        =>   $datetime,
                'created_by'     =>   $username
            );
            $this->D_Sto->ins2($datains2,'gdf_kartu_stok');

            ////////////////////////////////////////////////////////////////////////End kartu stok

            $kartu_sto_up = "UPDATE mst_soh SET qty='$qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'";
            $this->db->query($kartu_sto_up);
            //END STO
            
        }
        $sql_sto = "UPDATE trx_lgs_sto SET updc='1',updated='$datetime',updater='$username' WHERE id_sto='$nosto'";
        $this->db->query($sql_sto);
        $data="ok";
        $dataset = json_encode($data);
        echo $dataset;
    }

}
?>