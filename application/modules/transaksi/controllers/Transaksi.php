<?php
class Transaksi extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Transaksi');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }

    function index(){
        $this->load->view('transaksi');
    }


    function proses(){
        $id_reg         = $this->input->post('idregset');
        $send           = $this->input->post('id_set');
        $qty            = $this->input->post('qty_set');
        $name           = $this->input->post('name_set');
        $price          = $this->input->post('price_set');
        $id_grup        = $this->input->post('idgrup_set');
        $datetime       = date('Y-m-d H:i:s');
        
        $fndiddokter    = $this->D_Transaksi->fnddatadokter($id_reg);
        $id_dokter      = $fndiddokter->id_dokter_prt1;
        
        foreach($send as $k => $v){
            $qtyset    = $qty[$k];
            $nameset   = $name[$k];
            $priceset  = $price[$k];
            $totalset  = ($priceset * $qtyset);
            $idgrupset = $id_grup[$k];

            $data_trx_reg_act = array(  
                'id_reg'             =>   $id_reg,
                'id_dokter'          =>   $id_dokter,
                'id_reg_act'         =>   $v,
                'qty'                =>   $qtyset,
                'name'               =>   $nameset,
                'price'              =>   $priceset,
                'id_group_act'       =>   $idgrupset,
                'total'              =>   $totalset,
                'created'            =>   $datetime,
                'creator'            =>   "Admin"
            );
            $this->D_Transaksi->createregact($data_trx_reg_act,'trx_reg_act'); 

            #$delete="DELETE FROM temp_item_tindakan WHERE id_reg_set='$id_reg'";
		    #$qd = $this->db->query($delete);
           
        } //exit;
        redirect('transaksi');
    }

    function mstpasien(){
        $nama_pasien    = $this->input->post('valselnamapasien');
        $id_pasien      = $this->input->post('valselidpasien');
        $tgl_lahir      = $this->input->post('valseltgllahir');
        $id_reg         = $this->input->post('valselidreg');
        $data           = $this->D_Transaksi->mpasien($nama_pasien, $id_pasien, $tgl_lahir, $id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function trxregread(){
        $id_reg         = $this->input->post('id_reg_set');
        $data           = $this->D_Transaksi->trxregr($id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function trxdraft(){
        $id_reg         = $this->input->post('id_reg_set');
        $data           = $this->D_Transaksi->trxregrdraft($id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }

    

    function trxregdelete(){
        $id_trx         = $this->input->post('id_trx_set');
        $delete="DELETE FROM trx_reg_act WHERE id_trx='$id_trx'";
		$qd = $this->db->query($delete);
        $datasend = json_encode($id_trx);
        echo $datasend;
    }

    function trxregdelete_temp(){
        $id_trx         = $this->input->post('id_trx_set');
        $delete="DELETE FROM  temp_item_tindakan WHERE id_trx='$id_trx'";
		$qd = $this->db->query($delete);
        $datasend = json_encode($qd);
        echo $datasend;
    }



    function setinstindakan(){
        $datetime         = date('Y-m-d H:i:s');
        $id_reg_set       = $this->input->post('id_reg_set');
        $id_rm_set        = $this->input->post('id_rm_set');
        $idset            = $this->input->post('idset');
        $nameset          = $this->input->post('nameset');
        $priceset         = $this->input->post('priceset');
        $nama_grupset     = $this->input->post('nama_grupset');
        $namagrupset      = $this->input->post('namagrupset');
        $idgrup_set       = $this->input->post('idgrup_set');

        $data_trx_reg_act = array(  
            'id_reg_set'        => $id_reg_set,
            'id_rm_set'         => $id_rm_set,
            'idset'             => $idset,
            'nameset'           => $nameset,
            'priceset'          => $priceset,
            'nama_grupset'      => $nama_grupset,
            'namagrupset'       => $namagrupset,
            'idgrup_set'        => $idgrup_set,
            'frommenu'          => '3',
            'created'           => $datetime,
            'creator'           => "Admin"
        );
        $this->D_Transaksi->createregact($data_trx_reg_act,'temp_item_tindakan'); 

        $datasend = json_encode($id_reg);
        echo $datasend;
    }



    //////////////
    public function msttindakan(){
		$term = $this->input->get('term',true);
		
		$sql = "SELECT a.id_act,a.name,a.price AS harga,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
        FROM mst_tindakan a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
        LEFT JOIN mst_tindakan_subgrup c ON a.id_group=c.id_subgroup 
        WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label']         = $v['name'];
			$rs[$k]['id']            = $v['id_act'];
            $rs[$k]['price']         = $v['harga'];
            $rs[$k]['id_group']      = $v['id_group'];
            $rs[$k]['group']         = $v['namegrup'];
            $rs[$k]['subgroup']      = $v['namesubgrup'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
      }

}
?>