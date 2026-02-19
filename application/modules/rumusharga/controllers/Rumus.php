<?php
class Rumus extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Rumus');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
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
        $this->load->view('list_rumus');
    }

    function listdataharga(){
        $data           = $this->D_Rumus->dlistrumus();
		$dataset = json_encode($data);
		echo $dataset;
    }    

    public function mstperusahaan(){
		$term = $this->input->get('term',true);
		
		$sql = "SELECT a.id_company AS id_perusahaan,a.name AS nama_perusahaan
						FROM mst_company a 
						WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_perusahaan'];
			$rs[$k]['id'] = $v['id_perusahaan'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    public function mstbahan(){
		$term = $this->input->get('term',true);
		
		$sql = "SELECT 	a.id_fa AS id_obat,a.name AS nama_obat
						FROM 		mst_farmalkes a 
						WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['nama_obat'];
			$rs[$k]['id'] = $v['id_obat'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
    }

    function save(){
        $username              = @$this->session->userdata['sp']->username;
        $no_rumus_set          = $this->input->post('no_rumus_set');
        $id_perusahaan_set     = $this->input->post('id_perusahaan');
        $id_obat_set           = $this->input->post('id_obat');
        $rumus_set             = $this->input->post('rumus');
        $harga_set             = $this->input->post('harga');
        $hasil_set             = $this->input->post('hasil');

        $datetime                      = date('Y-m-d H:i:s');

        if(empty($no_rumus_set)){
        //gen no rumus
        $checkid                       = $this->D_Rumus->cdk();
        $setnoreg                      = $checkid->no_rumus;
        $prefix       = "FR-";
        $datereal_tgl = date('d');
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 5, 2);
        $setnoreg_thn = substr($setidregfnc, 7, 2);
        $urutan_reg = (int) substr($setidregfnc, 12, 17);

        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";

        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_rumusset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."MS".sprintf("%06s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "000001";
            $id_rumusset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."MS".$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "000001";
            $id_rumusset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."MS".$setincrement_reg;
        }else{
            $setincrement_reg = "000001";
            $id_rumusset = $prefix.$datereal_tgl.$datereal_bln.$datereal_thn."MS".$setincrement_reg;
        }
        //end gen no rumus

        $datains = array(  
            'no_rumus'          =>   $id_rumusset,
            'id_comp'           =>   $id_perusahaan_set,
            'created'           =>   $datetime,
            'created_by'        =>   $username
    
    
        );
        $this->D_Rumus->ins1($datains,'ish_mstrumus'); 



        foreach($id_obat_set as $k => $v){

            $id_obat        = $id_obat_set[$k];
            $rumus          = $rumus_set[$k];
            $harga          = $harga_set[$k];
            $hasil          = $hasil_set[$k];

            $datains = array(  
                'no_rumus'          =>   $id_rumusset,
                'id_comp'           =>   $id_perusahaan_set,
                'id_obat'           =>   $id_obat,
                'rumus'             =>   $rumus,
                'harga_dasar'       =>   $harga,
                'harga_margin'      =>   $hasil,
                'created'           =>   $datetime,
                'created_by'        =>   $username
            );
            $this->D_Rumus->ins1($datains,'ish_mstrumus_det'); 
        }

        $dataset = json_encode($id_rumusset);
		echo $dataset;
    }else{
        foreach($id_obat_set as $k => $v){

            $id_obat        = $id_obat_set[$k];
            $rumus          = $rumus_set[$k];
            $harga          = $harga_set[$k];
            $hasil          = $hasil_set[$k];

            $datains = array(  
                'no_rumus'          =>   $no_rumus_set,
                'id_comp'           =>   $id_perusahaan_set,
                'id_obat'           =>   $id_obat,
                'rumus'             =>   $rumus,
                'harga_dasar'       =>   $harga,
                'harga_margin'      =>   $hasil,
                'created'           =>   $datetime,
                'created_by'        =>   $username
            );
            $this->D_Rumus->ins1($datains,'ish_mstrumus_det'); 
        }

        $dataset = json_encode($no_rumus_set);
		echo $dataset;
    }


    
    }

    function prosesdetailobat(){
        $id_obat    = $this->input->post('id_obat');
        $datasett   = $this->D_Rumus->detail_obatnya($id_obat);
        $row_1      = $datasett->sale_price;

        $data = array(
            'row_1'     => $row_1
        );

		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listobatpernorumus(){
        $no_rumus          = $this->input->post('no_rumus_set');
        $data           = $this->D_Rumus->list_obat_per_norumus($no_rumus);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function edit(){
        $norumus    = $this->input->post('norumus');
        $datasett   = $this->D_Rumus->dlistrumus_edt($norumus);
        $row_1      = $datasett->id_comp;
        $row_2      = $datasett->nama_perusahaan;

        $data = array(
            'row_0'     => $norumus,
            'row_1'     => $row_1,
            'row_2'     => $row_2
        );

		$dataset = json_encode($data);
		echo $dataset;
    }

    function edit_tab(){
        $norumus        = $this->input->post('no_rumus_set');
        $data           = $this->D_Rumus->list_obat_per_norumus_edt($norumus);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function listobatpernorumus_edt(){
        $norumus        = $this->input->post('no_rumus_set');
        $data           = $this->D_Rumus->list_obat_per_norumus_edt($norumus);
		$dataset = json_encode($data);
		echo $dataset;
    }    

    function editthis(){
        $username              = @$this->session->userdata['sp']->username;
        $no_rumus_set          = $this->input->post('edt_no_rumus_set');
        $id_perusahaan_set     = $this->input->post('edt_id_perusahaan');
        $id_obat_set           = $this->input->post('id_obat');
        $rumus_set             = $this->input->post('rumus');
        $harga_set             = $this->input->post('harga');
        $hasil_set             = $this->input->post('hasil');

        $datetime                      = date('Y-m-d H:i:s');

        foreach($id_obat_set as $k => $v){

            $id_obat        = $id_obat_set[$k];
            $rumus          = $rumus_set[$k];
            $harga          = $harga_set[$k];
            $hasil          = $hasil_set[$k];

            $datains = array(  
                'no_rumus'          =>   $no_rumus_set,
                'id_comp'           =>   $id_perusahaan_set,
                'id_obat'           =>   $id_obat,
                'rumus'             =>   $rumus,
                'harga_dasar'       =>   $harga,
                'harga_margin'      =>   $hasil,
                'created'           =>   $datetime,
                'created_by'        =>   $username
            );
            $this->D_Rumus->ins1($datains,'ish_mstrumus_det'); 
        }

        $dataset = json_encode($no_rumus_set);
		echo $dataset;
    
    
    }

    function deleteitemedit(){
        $username              = @$this->session->userdata['sp']->username;
        $datetime                      = date('Y-m-d H:i:s');
        $id_set = $this->input->post('id_item');
        $sql = "UPDATE ish_mstrumus_det SET status = '1',updated='$datetime',updated_by='$username' WHERE id='$id_set'";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }
    
    ///////////////////////////////////////////////////////////////////////////////


















    function deleteitempo(){
        $username   = @$this->session->userdata['sp']->username;
        $datetime   = date('Y-m-d H:i:s');
        $no_po      = $this->input->post('iD_Rumus');
        $sql        = "UPDATE ish_wioutpo SET status = '1',updated='$datetime',updated_by='$username' WHERE no_po='$no_po'; ";
        $this->db->query($sql);
        $data="ok";
        $dataset = json_encode($data);
		echo $dataset;
    }
    
    function cetakpo($no_po){
        
        $datalist               = $this->D_Rumus->dlistpo_set($no_po);
        $datanya                = $this->D_Rumus->dlistpo_nya($no_po);
        $datanya_pembayaran     = $this->D_Rumus->dlistpo_pembayaran($no_po);
        
        $row_1_a            =   $datanya->nama_perusahaan;
        $row_1_b            =   $datanya->alamat;
        $row_1_c            =   $datanya->keterangan;
        $row_3              =   $datanya->no_po;
        $row_4              =   $datanya->nama_pengirim;
        $id_customer        =   $datanya->id_perusahaan;
        $tgl_pj             =   $this->tanggal_indo($datanya->tgl_po); 
        $tgl_do             =   $this->tanggal_indo($datanya->tgl_do);
        $tgl_jatuh_tempo    =   $this->tanggal_indo($datanya->tgl_jth_tempo); 
        $no_do              =   $datanya->no_po;
        $id_pengirim        =   $datanya->id_pengirim;
        $syarat_pembayaran  =   $datanya->syarat_pembayaran; 
        $no_po_cust         =   $datanya->no_po_cust;
        $driver             =   $datanya->driver;  
        $mengetahui_atasan  =   $datanya->mengetahui_atasan;
        $alamat_pengiriman  =   $datanya->alamat_pengiriman;
        $keterangan         =   $datanya->keterangan;
        $created_by         =   $datanya->created_by;

        $data = array(
            'datalist'              => $datalist,
            'datanya_pembayaran'    => $datanya_pembayaran,
            'row_1_a'               => $row_1_a,
            'row_1_b'               => $row_1_b,
            'row_1_c'               => $row_1_c,
            'row_3'                 => $row_3,
            'row_4'                 => $row_4,
            'id_customer'           => $id_customer,
            'tgl_pj'                => $tgl_pj,
            'tgl_do'                => $tgl_do,
            'tgl_jatuh_tempo'       => $tgl_jatuh_tempo,
            'no_do'                 => $no_do,
            'id_pengirim'           => $id_pengirim,
            'syarat_pembayaran'     => $syarat_pembayaran,
            'no_pj'                 => $no_po,
            'no_po_cust'            => $no_po_cust,
            'driver'                => $driver,
            'mengetahui_atasan'     => $mengetahui_atasan,
            'alamat_pengiriman'     => $alamat_pengiriman,
            'keterangan'            => $keterangan,
            'created_by'            => $created_by
        );

        $this->load->view('cetakpo', $data);
    }

}
?>