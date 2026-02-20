<?php
class Spb extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_spb');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('Pdf');
        $this->load->helper('pdf_helper');
    }

    function index(){
        $datalistspb       = $this->D_spb->listspb();

        $data = array(
            'datalistspb'   => $datalistspb
        );

        $this->load->view('list_spb',$data);
    }    

    function dataresspb(){
        $data       = $this->D_spb->mspb();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function dataresspb_pkt(){
        //$data       = $this->D_spb->mspb_pkt();
        //$datasend = json_encode($data);
        //echo $datasend;

        $id_reg         = "01230100003";
        $sql_2="SELECT (CASE WHEN b.id_paket IS NULL THEN '1_tind' ELSE '2_paket' END) AS type_header, (CASE WHEN b.id_paket IS NULL THEN 'TINDAKAN LUAR PAKET' ELSE 'PAKET' END) AS name_group
        FROM trx_reg_act a LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='P210203') LEFT JOIN mst_paket c ON b.id_paket=c.id_paket WHERE a.id_reg='01230100003'
        GROUP BY type_header ORDER BY type_header DESC
        ";
        //echo "<pre>".$sql_2;
		$query_2 = $this->db->query($sql_2);
        $rs_2 = $query_2->result_array();

        foreach($rs_2 as $k => $v_2){

        $type_header   = $v_2['type_header'];
            
        if($type_header=="2_paket"){
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            -- LEFT JOIN mst_tindakan_grup b ON (a.id_reg_act=b.id_trx_det )
            -- LEFT JOIN mst_tindakan c ON a.id_reg_act=c.id_act
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='P210203')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='01230100003' AND c.id_paket='P210203'
            GROUP BY c.id_paket
            -- AND (CASE WHEN $type_header='' IS NULL THEN a.id_reg_act='$id_reg_act' ELSE c.id_paket='P210203' END)
         
            -- AND a.id_reg_act='$id_reg_act' AND c.id_paket IS NULL 
            ";
        }else{
            $sql_3 = "SELECT
            (CASE WHEN b.id_paket IS NULL THEN a.name ELSE c.name END) AS name_tind ,
            c.id_paket,
            (CASE WHEN b.id_paket IS NULL THEN a.qty ELSE b.qty END) AS qtynya,
            (CASE WHEN b.id_paket IS NULL THEN a.price ELSE c.price END) AS pricenya
            FROM trx_reg_act a 
            -- LEFT JOIN mst_tindakan_grup b ON (a.id_reg_act=b.id_trx_det )
            -- LEFT JOIN mst_tindakan c ON a.id_reg_act=c.id_act
            LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='P210203')
            LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
            WHERE a.id_reg='01230100003' AND c.id_paket IS NULL";
        }

        //echo "<pre>".$sql_3;
        $query_3 	= $this->db->query($sql_3);
        $rs3 	= $query_3->result_array();
        $rs_2[$k]['rs_3'] = $rs3;
        //print_r($rs_2);

        }
        $data = array(
            'rs_2'          => $rs_2,
            'id_reg_set'    => $id_reg_set
        );

        $this->load->view('rincian', $data);

    }

    function datasendspb(){
        $send        = $this->input->post('optgroup');
        $tgl1_set    = date_create($this->input->post('tgl1'));
        $tgl2_set    = date_create($this->input->post('tgl2'));
        $tgl3_set    = date_create($this->input->post('tgl3'));
        $tgl1=date_format($tgl1_set,"Y/m/d");
        $tgl2=date_format($tgl2_set,"Y/m/d");
        $tgl3=date_format($tgl3_set,"Y/m/d");

        //set increment nya
            $datanu       = $this->D_spb->dnu();
            $setnourut=$datanu->nourut;
            $urutan = (int) substr($setnourut, 3, 4);
            $setincrement = $urutan+1;
            $increset="S".date('y').sprintf("%04s", $setincrement);
        //end set increment nya
        foreach($send as $k => $v){
            $datasend_set = explode(";",$v);
            $idspb    = $datasend_set[1];
            $idvocher = $datasend_set[2];
            $stat     = "1";//flagging set sudah di proses
            $datetime = date('Y-m-d H:i:s');

            $insert="INSERT INTO z_set_spb (nosp,idspb,idvocher,stat,datetime,tgltf,tgljtm,tgltkt) VALUES ('$increset','$idspb','$idvocher','$stat','$datetime','$tgl1','$tgl2','$tgl3');";
            $this->db2->query($insert);
        }
        
        redirect('spb');
    }

    function datetest(){
        $datanu       = $this->D_spb->dnu();
        $setnourut=$datanu->nourut;
        $urutan = (int) substr($setnourut, 3, 4)."<br>";
        $setincrement = $urutan+1;
        $increset="S".date('y').sprintf("%04s", $setincrement);
    }

    function detaildatasendspb(){
        $nosp       = $this->input->post('nosp');
        $data       = $this->D_spb->detailspb($nosp);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function printsp($nosp){
        $dataset        = $this->D_spb->detailprintspb($nosp);
        $total          = $dataset->total;
	    $setterbilang=$this->terbilang($total);

        $datasetsplr    = $this->D_spb->countspplrdetailprintspb($nosp);
        $setttlsplr     = $datasetsplr; 
        $setterttlsplr  = $this->terbilang($setttlsplr);

        $datenows=$this->tanggal_indo(DATE('Y-m-d'));
        $tgltf=$this->tanggal_indo($dataset->tgltf, TRUE);
        $tgljtm=$this->tanggal_indo($dataset->tgljtm);
        $tgltkt=$this->tanggal_indo($dataset->tgltkt);


        $data = array(
            'nosp'              => $nosp,
            'total'             => $total,
            'setterbilang'      => $setterbilang,
            'setttlsplr'        => $setttlsplr,
            'setterttlsplr'     => $setterttlsplr,
            'datenows'          => $datenows,
            'tgltf'             => $tgltf,
            'tgljtm'            => $tgljtm,
            'tgltkt'            => $tgltkt
        );
        $this->load->view('print_sp', $data);
    }

    function printrinciansp($nosp){
        $dataset        = $this->D_spb->detailprintspb($nosp);
        $total          = $dataset->total;
	    $setterbilang=$this->terbilang($total);

        $datasetsplr    = $this->D_spb->countspplrdetailprintspb($nosp);
        $setttlsplr     = $datasetsplr; 
        $setterttlsplr  = $this->terbilang($setttlsplr);

        $datenows=$this->tanggal_indo(DATE('Y-m-d'));
        $tgltf=$this->tanggal_indo($dataset->tgltf);
        $tgljtm=$this->tanggal_indo($dataset->tgljtm);
        $tgltkt=$this->tanggal_indo($dataset->tgltkt);

        $detaillistsp       = $this->D_spb->detailrincianspb($nosp);

        $data = array(
            'nosp'              => $nosp,
            'total'             => $total,
            'setterbilang'      => $setterbilang,
            'setttlsplr'        => $setttlsplr,
            'setterttlsplr'     => $setterttlsplr,
            'datenows'          => $datenows,
            'tgltf'             => $tgltf,
            'tgljtm'            => $tgljtm,
            'tgltkt'            => $tgltkt,
            'detaillistsp'      => $detaillistsp
        );
        $this->load->view('print_rincian', $data);
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


     
}


?>