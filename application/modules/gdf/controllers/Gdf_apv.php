<?php
class Gdf_apv extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Gdf_Apv');
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
        $this->load->view('list_Apv');
    }
    function listdatatfo(){
        $tglmulai_set_get        = $this->input->post('tglmulai');
        $tglakhir_set_get        = $this->input->post('tglakhir');

        $tglmulai_set_get_crt    = date_create($tglmulai_set_get);
        $tglmulai_set            = date_format($tglmulai_set_get_crt,"Y-m-d"); 

        $tglakhir_set_get_crt    = date_create($tglakhir_set_get);
        $tglakhir_set            = date_format($tglakhir_set_get_crt,"Y-m-d"); 

        $data                    = $this->D_Gdf_Apv->dlisttfo($tglmulai_set,$tglakhir_set);
		$dataset                 = json_encode($data);
		echo $dataset;
    }    


    function listpernotfo(){
        $no_tfo_p       = $this->input->post('no_tfo_p_set');
        $id_wrh         = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_Apv->list_obat_per_notfo($no_tfo_p, $id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listpernotfo_depo(){
        $no_tfo_p       = $this->input->post('no_tfo_p_set'); 
        $id_wrh_set     = $this->input->post('id_wrh_set');
        $data           = $this->D_Gdf_Apv->list_obat_per_notfo_depo($no_tfo_p, $id_wrh_set);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $no_tfo     = $this->input->post('id');
        $datasett   = $this->D_Gdf_Apv->dlisttfo_edt($no_tfo);
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
        $data           = $this->D_Gdf_Apv->list_obat_per_notfo_edt($nosto);
		$dataset = json_encode($data);
		echo $dataset;
    }    


    function editthis(){ //bikin fungsi edit sto
        $username       = @$this->session->userdata['sp']->login_name;
        $datetime       = date('Y-m-d H:i:s');
        $closedate      = date('Y-m-d');
        $nosto          = $this->input->post('edt_no_tfo_p_set');

        //gen no sto
        $checkid                       = $this->D_Gdf_Apv->cdk_kartu_stok();
        $setnoreg                      = $checkid->id_kode;
        $prefix       = "TRO-";
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

        $proses_soh_data = $this->D_Gdf_Apv->proses_soh($nosto);
        foreach($proses_soh_data as $dataset){
            $id_obat             = $dataset->id_obat;
            $id_wrh              = $dataset->ke_gudang;
            $qty                 = $dataset->qty_aprv;
            $nama_obat           = $dataset->nama_obat;
            $nama_gudang         = $dataset->nama_gudang;
            $nama_gudangutama    = $dataset->nama_gudangutama;

            //KARTU STOK 
            //STO
            //efek ke gudang yang di transfer
            $kartu_stok_sto = $this->D_Gdf_Apv->get_data_obat($id_obat, $id_wrh);
            $qty_kartu_stok = $kartu_stok_sto->qty;
            $qty_set_up     = ($qty_kartu_stok + $qty);
            //end efek ke gudang yang di transfer

            //efek ke gudang utama
            $gdu_kartu_stok_sto = $this->D_Gdf_Apv->get_data_obat_gudang_utama($id_obat);
            $gdu_qty_kartu_stok = $gdu_kartu_stok_sto->qty;
            $gdu_qty_set_up     = ($gdu_qty_kartu_stok - $qty);
            //end efek ke gudang utama


            ///////////////////////////////////////////////////////////////////////kartu stok STO
            

            $datains2 = array(  
                'id_wrh'         =>   $id_wrh,
                'id_fa'          =>   $id_obat,
                'datetime'       =>   $datetime,
                'id_kode'        =>   $id_stoset,
                'kode'           =>   'TRO',
                'nama_transaksi' =>   $id_stoset.'/ '.$nama_obat.' / '.$nama_gudang,
                'in'             =>   $qty,
                'saldo'          =>   $qty_set_up,
                'created'        =>   $datetime,
                'created_by'     =>   $username
            );
            $this->D_Gdf_Apv->ins2($datains2,'gdf_kartu_stok');

            $gdu_datains2 = array(  
                'id_wrh'         =>   '001',
                'id_fa'          =>   $id_obat,
                'datetime'       =>   $datetime,
                'id_kode'        =>   $id_stoset,
                'kode'           =>   'TRO',
                'nama_transaksi' =>   $id_stoset.'/ '.$nama_obat.' / '.$nama_gudangutama,
                'out'            =>   $qty,
                'saldo'          =>   $gdu_qty_set_up,
                'created'        =>   $datetime,
                'created_by'     =>   $username
            );
            $this->D_Gdf_Apv->ins3($gdu_datains2,'gdf_kartu_stok');

            ////////////////////////////////////////////////////////////////////////End kartu stok

            $kartu_sto_up = "UPDATE mst_soh SET qty='$qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'";
            $this->db->query($kartu_sto_up);

            $kartu_sto_up_gdu = "UPDATE mst_soh SET qty='$gdu_qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='001'";
            $this->db->query($kartu_sto_up_gdu);
            //END STO
            
        }

        ///////////////////
        $sql            = "UPDATE gdf_tfo_det SET status = '1',updated='$datetime',updated_by='$username' WHERE id_tfo='$nosto'";
        $set_det        = $this->db->query($sql);
        $sql_par        = "UPDATE gdf_tfo SET closedate='$closedate',status = '2',updated='$datetime',updated_by='$username' WHERE id_tfo='$nosto'";
        $set_par        = $this->db->query($sql_par);
        ///////////////////
        $data           ="ok";
        $dataset        = json_encode($data);
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


    
    function set_qty_on_tfo(){
        $username   = @$this->session->userdata['sp']->login_name;
        $datetime   = date('Y-m-d H:i:s');
        $id         = $this->input->post('id'); 
        $qty        = $this->input->post('qty_apv_nyah');
        $qty_depo   = $this->input->post('qtydepo');
        $qtysetup   = $this->escape($qty);

        $qty_soh_depo = ($qty_depo+$qtysetup);

        $sql = "UPDATE gdf_tfo_det SET qty_aprv='$qtysetup',qty_soh_depo='$qty_soh_depo',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }

    function btf_set_up(){
        $username           = @$this->session->userdata['sp']->login_name;
        $datetime           = date('Y-m-d H:i:s');
        $id                 = $this->input->post('id'); 
        $qty                = $this->input->post('jumlah_batal');
        $qty_depo           = $this->input->post('qty_depo');
        $id_wrh             = $this->input->post('id_wrh_set');
        $id_obat            = $this->input->post('id_obat');
        $nama_gudang        = $this->input->post('gudang');
        $nama_obat          = $this->input->post('obat'); 
        $jumlah_qty_limit   = $this->input->post('jumlah_qty_limit');
        $qtysetup           = $this->escape($qty);
        $qty_soh_depo       = ($qty_depo-$qtysetup);
        $fnd_gudang_utama   = $this->D_Gdf_Apv->fnd_gudang_utama();
        $nama_gudangutama   = $fnd_gudang_utama->nama_gudangutama;

        $sql = "UPDATE gdf_tfo_det SET qty_btf='$qtysetup',qty_soh_depo='$qty_soh_depo',updated='$datetime',updated_by='$username' WHERE id='$id'";
        $this->db->query($sql);


                //gen no sto
                $checkid                       = $this->D_Gdf_Apv->cdk_kartu_stok_btf();
                $setnoreg                      = $checkid->id_kode;
                $prefix       = "BTF-";
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

                $kartu_stok_sto = $this->D_Gdf_Apv->get_data_obat($id_obat, $id_wrh);
                $qty_kartu_stok = $kartu_stok_sto->qty;
                $qty_set_up     = ($qty_kartu_stok - $qty);

                //efek ke gudang utama
                $gdu_kartu_stok_sto = $this->D_Gdf_Apv->get_data_obat_gudang_utama($id_obat);
                $gdu_qty_kartu_stok = $gdu_kartu_stok_sto->qty;
                $gdu_qty_set_up     = ($gdu_qty_kartu_stok + $qty);
                //end efek ke gudang utama

    
                ///////////////////////////////////////////////////////////////////////kartu stok STO
                
    
                $datains2 = array(  
                    'id_wrh'         =>   $id_wrh,
                    'id_fa'          =>   $id_obat,
                    'datetime'       =>   $datetime,
                    'id_kode'        =>   $id_stoset,
                    'kode'           =>   'BTF',
                    'nama_transaksi' =>   $id_stoset.'/ '.$nama_obat. ' Jumlah : '.$qty.' / Dari '.$nama_gudang,
                    'out'            =>   $qty,
                    'saldo'          =>   $qty_set_up,
                    'created'        =>   $datetime,
                    'created_by'     =>   $username
                );
                $this->D_Gdf_Apv->ins2($datains2,'gdf_kartu_stok');

                $gdu_datains2 = array(  
                    'id_wrh'         =>   '001',
                    'id_fa'          =>   $id_obat,
                    'datetime'       =>   $datetime,
                    'id_kode'        =>   $id_stoset,
                    'kode'           =>   'BTF',
                    'nama_transaksi' =>   $id_stoset.'/ '.$nama_obat.' / '.$nama_gudangutama,
                    'in'             =>   $qty,
                    'saldo'          =>   $gdu_qty_set_up,
                    'created'        =>   $datetime,
                    'created_by'     =>   $username
                );
                $this->D_Gdf_Apv->ins3($gdu_datains2,'gdf_kartu_stok');
    
                ////////////////////////////////////////////////////////////////////////End kartu stok
    
                $kartu_sto_up = "UPDATE mst_soh SET qty='$qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'";
                $this->db->query($kartu_sto_up);

                $kartu_sto_up_gdu = "UPDATE mst_soh SET qty='$gdu_qty_set_up',updated='$datetime',updater='$username' WHERE id_soh='$id_obat' AND id_wrh='001'";
                $this->db->query($kartu_sto_up_gdu);

                $update_tfo = "UPDATE gdf_tfo_det SET qty_limit_btf='$jumlah_qty_limit',updated='$datetime',updated_by='$username' WHERE id='$id'";
                $this->db->query($update_tfo);
                
                $data="ok";
                $dataset = json_encode($data);
		        echo $dataset;
    }

}
?>