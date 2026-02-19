<?php
class Etiket extends MX_controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('D_Etiket');
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('encryption');
  }
  function escape($text)
  {
    return str_replace(array(","), array(""), $text);
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////DAFTAR HARGA 31 - 01 -2025
function index()
{
  $this->load->view('v_etiket');
}

function getdatadaftarpasien(){
  $namasearch   = $this->input->post('nama_pasien_search');
  $bln          = $this->input->post('bln_search');
  $thn          = $this->input->post('thn_search');

  if($namasearch==null || $namasearch=="" ){
    $sql_search = "";
  }else{
    $sql_search = " AND (c.name LIKE '%$namasearch%' OR a.id_reg LIKE '%$namasearch%' OR b.id_pasien LIKE '%$namasearch%' OR a.id_eresep LIKE '%$namasearch%' )";
  }


  $dataset          = $this->D_Etiket->datasetlistpasien($sql_search,$bln,$thn);
  echo json_encode($dataset);
}


function getdatadetaileresep(){
  $id_eresep       = $this->input->post('id_eresep');
  $dataset         = $this->D_Etiket->datadetaileresep($id_eresep);
  echo json_encode($dataset);
}

function cetak_etiket($id_eresep_det){
  $data_etiket_detail     = $this->D_Etiket->get_data_etiket_detail($id_eresep_det);
  $getdatafrom_det        = $this->D_Etiket->get_data_from_id_eresepdet($id_eresep_det);
  $id_eresep              = $getdatafrom_det->id_eresep;
  $getdatafrom_eresep     = $this->D_Etiket->get_data_from_id_eresep($id_eresep);
  $eresep_date            = $getdatafrom_eresep->eresepdate;
  $id_reg                 = $getdatafrom_eresep->id_reg;
  $getdatafrom_trxreg     = $this->D_Etiket->get_data_from_trx_reg($id_reg);
  $id_pasien              = $getdatafrom_trxreg->id_pasien;
  $getdatafrom_mst_pasien = $this->D_Etiket->get_data_from_mst_pasien($id_pasien);
  $nama_pasien            = $getdatafrom_mst_pasien->name;
  $tgllahir               = $getdatafrom_mst_pasien->tgllahir;

  $tanggal_lahir = new DateTime($getdatafrom_mst_pasien->birthdate);
  $sekarang = new DateTime("today");
  if ($tanggal_lahir > $sekarang) { 
  $thn = "0";
  $bln = "0";
  $tgl = "0";
  }
  $thn = $sekarang->diff($tanggal_lahir)->y;
  $bln = $sekarang->diff($tanggal_lahir)->m;
  $tgl = $sekarang->diff($tanggal_lahir)->d;
  $umur = $thn." tahun ".$bln." bulan ";
  $data = array(
    'data_etiket_detail'		=> $data_etiket_detail,
    'id_pasien'             => $id_pasien,
    'nama_pasien'           => $nama_pasien,
    'eresep_date'           => $eresep_date,
    'tgllahir'              => $tgllahir,
    'umur'                  => $umur
  );
  $this->load->view('cetak_etiket', $data);
}

}
