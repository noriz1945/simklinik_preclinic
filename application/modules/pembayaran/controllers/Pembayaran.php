<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pembayaran extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pembayaran_model');
		$this->load->library('FormGenerator');
		$this->load->library('SmartLib');
		$this->load->model('Closing_model');
	}

	public function index()
	{
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('start'));

		if ($q <> '') {

			$config['base_url'] = base_url() . 'pembayaran/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'pembayaran/?q=' . urlencode($q);

		} else {
			$config['base_url'] = base_url() . 'pembayaran/';
			$config['first_url'] = base_url() . 'pembayaran/';
		}

		$config['per_page'] = 100;
		$config['page_query_string'] = TRUE;
		#$config['total_rows'] = $this->Pembayaran_model->total_rows($q);
		$pembayaran = $this->Pembayaran_model->list_reg($config['per_page'], $start, $q);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		foreach ($pembayaran as $k => $v) {
			$data_inv = $this->Pembayaran_model->get_data_inv_by_id_reg($v->id_reg);
			$pembayaran[$k]->inv = $data_inv;

			$data_dp = $this->Pembayaran_model->get_data_dp_by_id_reg($v->id_reg);
			$pembayaran[$k]->id_trx_dp = $data_dp;

			$data_inv_refund = $this->Pembayaran_model->get_data_inv_refund_by_id_reg($v->id_reg);
			$pembayaran[$k]->inv_refund = $data_inv_refund;
		}
		#print_r($pembayaran);
		#print_r($pembayaran);
		$data = array(
			'id_inv' => $this->input->get('id_inv'),
			'id_ret_dp' => $this->input->get('id_ret_dp'),
			'id_refund' => $this->input->get('id_refund'),
			'id_trx1' => $this->input->get('id_trx1'),
			'id_trx2' => $this->input->get('id_trx2'),
			'data_reg' => $pembayaran,
			'q' => $q,
			'pagination' => $this->pagination->create_links(),
			#'total_rows' 	=> $config['total_rows'],
			'start' => $start,
		);
		$this->load->view('pembayaran_list', $data);
	}

	function trx_open($id_reg)
	{
		$this->smartlib->cek_opening_kasir();

		#$this->output->enable_profiler(true);
		$data_reg = $this->Pembayaran_model->get_data_reg($id_reg);

		$sql_id_bank = "	SELECT * FROM mst_bank WHERE is_aktif=1 ORDER BY nama_bank";
		$sql_id_dokter = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							WHERE	a.aktif=1
							ORDER BY a.name";

		$sql = "SELECT a.id_dokter_prt1 FROM trx_reg a WHERE a.id_reg='" . $id_reg . "'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$id_dokter_prt1 = $row['id_dokter_prt1'];

		$data = array(
			'id_reg' => $id_reg,
			'data_reg' => $data_reg,
			'dropdown_id_bank' => $this->formgenerator->get_dropdown('id_bank', $sql_id_bank),
			'dropdown_id_dokter' => $this->formgenerator->get_dropdown('id_dokter', $sql_id_dokter, $id_dokter_prt1),
		);
		$this->load->view('pembayaran_trx_open', $data);
	}

	function inner_load_pre_trx_open($id_reg)
	{
		#$this->output->enable_profiler(true);
		$data_trx_open = $this->Pembayaran_model->data_trx_open($id_reg);
		#$data_eresep_open = $this->Pembayaran_model->data_eresep_open($id_reg);
		foreach ($data_trx_open as $k => $v) {
			$v->id_act = (string) $v->id_act;
		}
		$data = array(
			'id_reg' => $id_reg,
			'data_trx_open' => $data_trx_open,
		);
		$this->load->view('inner_pre_trx_open', $data);
	}

	public function inner_get_data_autocomplete_tindakan($id_asuransi = "0001")
	{
		$term = $this->input->get('term', true);
		$sql = "SELECT 	a.id_act AS idx, a.`name` AS label
						,(CASE WHEN COALESCE(b.`price`,0)>0 THEN b.price
							ELSE COALESCE(c.`price`,0) END 
						) AS price
				FROM 	mst_tindakan a
						LEFT JOIN mst_tindakan_prc b ON (b.`id_act`=a.`id_act` AND b.`id_comp`='" . $id_asuransi . "' AND b.`id_kelas`=1 AND b.aktif=1)
						LEFT JOIN mst_tindakan_prc c ON (c.`id_act`=a.`id_act` AND c.`id_comp`='0001' AND c.`id_kelas`=1 AND c.aktif=1)
				WHERE	UPPER(a.`name`) LIKE '%" . strtoupper($term) . "%' AND a.aktif=1
		";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach ($rs as $k => $v) {
			$rs[$k]['price'] = $v['price'];
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}

	function add_tindakan_act($redir = "", $id_reg = "")
	{
		$id_act = $this->input->post('id_act');
		$txt_id_act = $this->input->post('txt_id_act');
		$price = $this->input->post('price');
		$qty = $this->input->post('qty');
		$id_dokter = $this->input->post('id_dokter');

		$data_tindakan = array();
		$data_tindakan['id_reg'] = $id_reg;
		$data_tindakan['trxdate'] = date('Y-m-d H:i:s');
		$data_tindakan['id_reg_act'] = $id_act;
		$data_tindakan['id_type'] = 1;		### tipe reg: 1=rwj,2=rwi,3=ugd
		$data_tindakan['id_kelas'] = 1;
		$data_tindakan['id_dokter'] = $id_dokter;
		$data_tindakan['name'] = $txt_id_act;
		$data_tindakan['qty'] = $qty;
		$data_tindakan['price'] = $price;
		$data_tindakan['total'] = $price * $qty;
		$data_tindakan['is_outpaket'] = 1;
		$data_tindakan['creator'] = $this->session->userdata['sp']->username;
		$data_tindakan['created'] =  date('Y-m-d H:i:s');

		$this->db->insert('trx_reg_act', $data_tindakan);

		redirect('pembayaran/', $redir . "/" . $id_reg);
	}

	function delete_trx_reg_act($id_reg, $id_trx)
	{
		$this->db->where('id_trx', $id_trx);
		$this->db->delete('trx_reg_act');

		echo 'Hapus Sukese';
	}

	public function inner_get_data_autocomplete_bank()
	{
		$term = $this->input->get('term', true);
		$sql = "SELECT 	a.id_bank AS idx, a.`nama_bank` AS label
				FROM 	mst_bank a
				WHERE	UPPER(a.`nama_bank`) LIKE '%" . strtoupper($term) . "%'
								AND a.is_aktif=1
		";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach ($rs as $k => $v) {
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}

	public function buat_invoice()
	{
		$debug = false;
		if ($debug)
			$this->output->enable_profiler(true);

		$id_reg = $this->input->post('id_reg');
		$id_trx = $this->input->post('id_trx');
		$id_group = $this->input->post('id_group');
		$is_paket = $this->input->post('is_paket');
		$ada_paket = false;
		$is_farmasi = $this->input->post('is_farmasi');
		$val_id_act = $this->input->post('val_id_act');
		$dt_price_ori = $this->input->post('dt_price_ori');
		$dt_disc_p = $this->input->post('dt_disc_p');
		$dt_disc_m = $this->input->post('dt_disc_m');
		$dt_price = $this->input->post('dt_price');
		$dt_qty = $this->input->post('dt_qty');
		$dt_tuslah = $this->input->post('dt_tuslah');
		$dt_total = $this->input->post('dt_total');

		$new_id_inv = $this->Pembayaran_model->get_new_id_inv();
		$id_opening = $this->smartlib->get_id_opening_kasir();

		$this->db->trans_begin();

		### --- Vouvher Diskon
		$kode_vcr = $this->input->post('kode_vcr');
		if ($kode_vcr != '') {
			$data_trx_reg_inv['id_vcd'] = $kode_vcr;

			$dt_trx_vcr_disc = $this->Pembayaran_model->get_data_trx_vcr_disc($kode_vcr);
			$id_vcr = $dt_trx_vcr_disc->id_vcr;
			$id_tvd = $dt_trx_vcr_disc->id_tvd;

			$data_trx_vcr_disc['is_used'] = 1;
			$data_trx_vcr_disc['used_by_id_inv'] = $new_id_inv;
			$this->Pembayaran_model->update('trx_vcr_disc', 'kode_vcr', $kode_vcr, $data_trx_vcr_disc);

			$data_trx_vcr_disc_det['is_used'] = 1;
			$data_trx_vcr_disc_det['used_by_id_inv'] = $new_id_inv;
			$data_trx_vcr_disc_det['id_opening'] = $id_opening;
			$this->Pembayaran_model->update('trx_vcr_disc_det', 'id_tvd', $id_tvd, $data_trx_vcr_disc_det);
		}

		foreach ($id_trx as $k => $v) {
			#echo $v . ' >> ' .$id_group[$k]. "<br>";			
			if ($id_group[$k] == 99) {
				$data_soap_eresep_det['id_inv'] = $new_id_inv;
				$data_soap_eresep_det['disc_p'] = $dt_disc_p[$k];
				$data_soap_eresep_det['disc_m'] = $dt_disc_m[$k];
				#$data_soap_eresep_det['subtotal'] = $dt_total[$k] + $dt_tuslah[$k];
				$data_soap_eresep_det['subtotal'] = $dt_total[$k];
				$data_soap_eresep_det['id_opening'] = $id_opening;
				$this->Pembayaran_model->update('soap_eresep_det', 'id_eresep_det', $v, $data_soap_eresep_det);
			} else {
				$data_trx_reg_act['id_inv'] = $new_id_inv;
				$data_trx_reg_act['disc_p'] = $dt_disc_p[$k];
				$data_trx_reg_act['disc_m'] = $dt_disc_m[$k];
				$data_trx_reg_act['total'] = $dt_total[$k];
				$data_trx_reg_act['id_opening'] = $id_opening;
				$this->Pembayaran_model->update('trx_reg_act', 'id_trx', $v, $data_trx_reg_act);
			}

			if ($is_paket[$k] == 1) {
				$data_trx_reg_paket_det['id_inv'] = $new_id_inv;
				#$data_trx_reg_paket_det['id_opening'] = $id_opening;
				$this->Pembayaran_model->update('trx_reg_paket_det', 'id_reg', $id_reg, $data_trx_reg_paket_det);
				$ada_paket = true;
			}
		}

		$data_trx_reg_inv['id_inv'] = $new_id_inv;
		$data_trx_reg_inv['invdate'] = date('Y-m-d H:i:s');
		$data_trx_reg_inv['id_reg'] = $id_reg;

		### --- TOTAL
		$subtotal = $this->input->post('subtotal');
		$data_trx_reg_inv['subtotal'] = $subtotal;

		$vcdisc_m = $this->input->post('vcdisc_m');
		$data_trx_reg_inv['vcdisc_m'] = $vcdisc_m;

		$ppn = $this->input->post('ppn');
		$data_trx_reg_inv['ppn'] = $ppn;

		$total_dp = $this->input->post('total_dp');
		$dp_use = $this->input->post('dp_use');
		$dp_ret = $this->input->post('dp_ret');
		$data_trx_reg_inv['total_dp'] = $dp_use;
		if ($dp_use > 0) {
			$data_trx_reg_dp = array();
			$data_trx_reg_dp['id_reg'] = $id_reg;
			$data_trx_reg_dp['id_inv'] = $new_id_inv;
			$data_trx_reg_dp['total_cash'] = ($dp_use * -1);
			$data_trx_reg_dp['total'] = ($dp_use * -1);
			$data_trx_reg_dp['creator'] = $this->session->userdata['sp']->name;
			$data_trx_reg_dp['created'] = date('Y-m-d H:i:s');
			$data_trx_reg_dp['id_opening'] = $id_opening;
			$this->Pembayaran_model->insert('trx_reg_dp', $data_trx_reg_dp);

			$data_trx_reg['total_dp'] = 0;
			$this->Pembayaran_model->update('trx_reg', 'id_reg', $id_reg, $data_trx_reg);
		}
		$new_id_ret_dp = "";
		if ($dp_ret > 0) {
			$data_trx_reg_dp = array();
			$data_trx_reg_dp['id_reg'] = $id_reg;
			$data_trx_reg_dp['id_inv'] = $new_id_inv;
			$data_trx_reg_dp['total_cash'] = ($dp_ret * -1);
			$data_trx_reg_dp['total'] = ($dp_ret * -1);
			$data_trx_reg_dp['ret'] = 1;
			$data_trx_reg_dp['creator'] = $this->session->userdata['sp']->name;
			$data_trx_reg_dp['created'] = date('Y-m-d H:i:s');
			$data_trx_reg_dp['id_opening'] = $id_opening;
			$new_id_ret_dp = $this->Pembayaran_model->insert('trx_reg_dp', $data_trx_reg_dp);
		}

		### --- Total
		$total = $subtotal - $vcdisc_m - $dp_use + $ppn;
		$data_trx_reg_inv['total'] = $total;
		$data_trx_reg_inv['total_inv'] = $total;

		### --- Penjamin
		$total_noncash = intval($this->input->post('total_noncash'));
		$data_trx_reg_inv['total_noncash'] = $total_noncash;
		$data_trx_reg_inv['id_company'] = $this->input->post('id_asuransi');

		### --- Kartu Kredit / Debit
		$id_bank1 = $this->input->post('id_bank');
		$id_bank1 = ($id_bank1 != '') ? $id_bank1 : 0;
		$data_trx_reg_inv['id_bank1'] = $id_bank1;
		$data_trx_reg_inv['nocc1'] = $this->input->post('nocc1');
		$data_trx_reg_inv['total_cc1'] = intval($this->input->post('total_cc1'));

		### --- Cash
		$total_cash = ($this->input->post('total_cash')) - intval($this->input->post('kembalian'));
		$data_trx_reg_inv['total_cash'] = $total_cash;

		### --- Kembalian
		$kembalian = $this->input->post('kembalian');
		$data_trx_reg_inv['kembalian'] = $kembalian;

		### --- Creator
		$data_trx_reg_inv['creator'] = $this->session->userdata['sp']->name;
		$data_trx_reg_inv['created'] = date('Y-m-d H:i:s');
		$data_trx_reg_inv['id_opening'] = $id_opening;

		if ($total_cash > 0 && $total_noncash <= 0)
			$type = 0;
		elseif ($total_cash <= 0 && $total_noncash > 0)
			$type = 1;
		else // kombinasi
			$type = 2;

		$data_trx_reg_inv['type'] = $type;

		$this->Pembayaran_model->insert('trx_reg_inv', $data_trx_reg_inv);

		if ($ada_paket == true) {
			$data_trx_reg_paket['id_inv'] = $new_id_inv;
			$this->Pembayaran_model->update('trx_reg_paket', 'id_reg', $id_reg, $data_trx_reg_paket);
		}


		### ----------- //KARTU STOK ----------------------------------------------
		$datetime = date('Y-m-d H:i:s');
		//gen no sto
		$checkid = $this->Pembayaran_model->cdk_kartu_stok();
		$setnoreg = $checkid->id_kode;
		$prefix = "RSP-";
		$datereal_tgl = date('d');
		$datereal_bln = date('m');
		$datereal_thn = date('y');
		$setidregfnc = $setnoreg;
		$setnoreg_bln = substr($setidregfnc, 6, 2);
		$setnoreg_thn = substr($setidregfnc, 8, 2);
		$urutan_reg = (int) substr($setidregfnc, 10, 16);
		//echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";
		if (($datereal_bln == $setnoreg_bln) && ($datereal_thn == $setnoreg_thn)) {
			$setincrement_reg = $urutan_reg + 1;
			$id_stoset = $prefix . $datereal_tgl . $datereal_bln . $datereal_thn . sprintf("%06s", $setincrement_reg);
		} elseif (($datereal_bln != $setnoreg_bln) && ($datereal_thn == $setnoreg_thn)) { //tahun berjalan 
			$setincrement_reg = "000001";
			$id_stoset = $prefix . $datereal_tgl . $datereal_bln . $datereal_thn . $setincrement_reg;
		} elseif (($datereal_bln != $setnoreg_bln && $datereal_thn != $setnoreg_thn)) { //tahun selanjutnya (awal tahun)
			$setincrement_reg = "000001";
			$id_stoset = $prefix . $datereal_tgl . $datereal_bln . $datereal_thn . $setincrement_reg;
		} else {
			$setincrement_reg = "000001";
			$id_stoset = $prefix . $datereal_tgl . $datereal_bln . $datereal_thn . $setincrement_reg;
		}
		//end gen no sto
		//STO
		//efek ke gudang utama
		$gdu_kartu_stok_sto = $this->Pembayaran_model->get_data_obat_per_inv($new_id_inv);
		//end efek ke gudang utama


		///////////////////////////////////////////////////////////////////////kartu stok STO

		foreach ($gdu_kartu_stok_sto as $dataset) {

			$id_obat = $dataset->id_obat;
			$nama_obat = $dataset->nama_obat;
			$qty = $dataset->qty;
			$harga = $dataset->harga;
			$subtotal = $dataset->jumlah;
			$tipe = $dataset->tipe;
			$created = $dataset->created;
			$created_by = $dataset->created_by;
			$set_depo = $dataset->set_depo;

			$depot_check = $this->Pembayaran_model->get_data_obat_per_depot($id_obat, $set_depo);
			#print_r($depot_check);
			$qty_depot = ($depot_check->qty - $qty);


			$gdu_datains2 = array(
				'id_wrh' => $set_depo,
				'id_fa' => $id_obat,
				'datetime' => $datetime,
				'id_kode' => $id_stoset,
				'kode' => 'RSP',
				'nama_transaksi' => $id_stoset . '/ ' . $nama_obat . ' / ' . $harga . ' / ' . $subtotal . ' / ' . $tipe . ' / ' . $created . ' / ' . $created_by,
				'out' => $qty,
				'saldo' => $qty_depot,
				'created' => $datetime,
                'created_by'     =>   $this->session->userdata['sp']->username
			);
			$this->Pembayaran_model->ins1($gdu_datains2, 'gdf_kartu_stok');

			$dataupd = array(
				'qty' => $qty_depot,
			);
			$dataupd_where = array(
				'id_wrh' => $set_depo,
				'id_soh' => $id_obat,
			);
			$this->Pembayaran_model->update_data($dataupd_where, $dataupd, 'mst_soh');
		}

		///////////////////LOG SYSTEM
		$infoset = "PEMBAYARAN " . $this->session->userdata['sp']->username . ' -> ' . date('Y-m-d H:i:s');
		$data_log = array(
			'type' => "9",
			'attempt_1' => base_url(),
			'attempt_2' => "Pembayaran / " . $new_id_inv,
			'info' => $infoset,
			'created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata['sp']->username
		);
		$this->Pembayaran_model->add_to_log($data_log);
		///////////////////LOG SYSTEM

		////////////////////////////////////////////////////////////////////////End kartu stok

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			if ($debug)
				$this->db->trans_rollback();
			else
				$this->db->trans_commit();
		}

		if (!$debug)
			redirect('pembayaran?id_inv=' . $new_id_inv . '&id_ret_dp=' . $new_id_ret_dp);
	}

	function test_insert_tindakan($id_reg, $id_act)
	{
		$sql = "SELECT a.* FROM mst_tindakan a WHERE a.id_act='" . $id_act . "'";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		$sql = "SELECT a.* FROM mst_tindakan_prc a WHERE a.id_act='" . $id_act . "' AND a.id_comp='0001'";
		$query = $this->db->query($sql);
		$row_prc = $query->row_array();

		### --- Tagihan Auto Tagih ---
		$auto_tindakan = array();
		$auto_tindakan['id_reg'] = $id_reg;
		$auto_tindakan['trxdate'] = date('Y-m-d H:i:s');
		$auto_tindakan['id_reg_act'] = $row['id_act'];
		$auto_tindakan['id_type'] = 1;		### tipe reg: 1=rwj,2=rwi,3=ugd
		$auto_tindakan['id_kelas'] = 1;
		$auto_tindakan['id_dokter'] = '001';
		$auto_tindakan['name'] = $row['name'];
		$auto_tindakan['qty'] = 1;
		$auto_tindakan['price'] = intval($row_prc['price']);
		$auto_tindakan['total'] = intval($row_prc['price']) * 1;
		$auto_tindakan['is_outpaket'] = 1;
		$auto_tindakan['creator'] = $this->session->userdata['sp']->username;
		$auto_tindakan['created'] = date('Y-m-d H:i:s');

		$this->db->insert('trx_reg_act', $auto_tindakan);
	}

	function cetak_invoice($id_inv)
	{
		############# GO TO POS INVOICE ################
		#return $this->cetak_invoice_pos($id_inv);
		################################################

		$this->load->library('Terbilang');
		$data_inv_header = $this->Pembayaran_model->get_data_inv_header($id_inv);
		$data_inv_detail = $this->Pembayaran_model->get_data_inv_detail($id_inv);

		$sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
		$data = array(
			'data_inv_header' => $data_inv_header,
			'data_inv_detail' => $data_inv_detail,
		);
		$this->load->view('cetak_invoice', $data);
	}

	function cetak_invoice_pos($id_inv)
	{
		$this->load->library('Terbilang');
		$data_inv_header = $this->Pembayaran_model->get_data_inv_header($id_inv);
		$data_inv_detail = $this->Pembayaran_model->get_data_inv_detail($id_inv);
		#print_r($data_inv_header);
		$sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
		$data = array(
			'data_inv_header' => $data_inv_header,
			'data_inv_detail' => $data_inv_detail,
		);
		$this->load->view('cetak_invoice_pos', $data);
	}
	/////////////////////////////////////////////////////////////////28112023
	function refundproses()
	{
		$id_inv = $this->input->post('id_inv');
		$getdata_total_inv = $this->Pembayaran_model->get_data_total_inv($id_inv);
		$total_tagihan = $getdata_total_inv->total;
		echo json_encode($total_tagihan);
	}

	function cekpassword()
	{
		$user_set = $this->session->userdata['sp']->username;
		$pass_set = md5($this->input->post('pass_set'));
		$userdata = $this->Pembayaran_model->get_data_userdata($user_set, $pass_set);
		$dataget = json_encode($userdata);
		echo $dataget;
	}

	function refundprosesupdate()
	{
		$id_inv = $this->input->post('id_inv');
		$reg = $this->input->post('reg');
		$getdata_total_inv = $this->Pembayaran_model->get_data_total_inv($id_inv);
		$total_tagihan = $getdata_total_inv->total;
		$refund_aktif = 1;
		$refund_created = date('Y-m-d H:i:s');
		$refund_created_by = $this->session->userdata['sp']->username;
		$getdata_total_inv = $this->Pembayaran_model->update_data_refund($reg, $id_inv, $total_tagihan, $refund_aktif, $refund_created, $refund_created_by);
		$fdbck = "ok";
		$datajson = json_encode($fdbck);
		echo $datajson;
	}

	function cetak_invoice_refund($id_inv)
	{
		$this->load->library('Terbilang');
		$data_inv_header = $this->Pembayaran_model->get_data_inv_header($id_inv);
		$data_inv_detail = $this->Pembayaran_model->get_data_inv_detail($id_inv);

		$sql_id_bank = "SELECT * FROM mst_bank ORDER BY nama_bank";
		$data = array(
			'data_inv_header' => $data_inv_header,
			'data_inv_detail' => $data_inv_detail,
		);
		$this->load->view('cetak_invoice_refund', $data);
	}

	/////////////////////////////////////////////////////////////////END 28112023

	function opening_kasir()
	{
		$row = $this->smartlib->get_data_opening_kasir();
		#return $this->load->view('opening_is_open');
		if (!empty($row)) {
			return $this->load->view('opening_is_open');
		}

		$data = array(
			'' => '',
		);
		$this->load->view('opening_kasir', $data);
	}

	function opening_kasir_act()
	{
		$debug = false;
		if ($debug)
			$this->output->enable_profiler(true);

		$this->db->trans_begin();
		$data_opening['username']   = $this->session->userdata['sp']->username;
		$data_opening['name']   	  = $this->session->userdata['sp']->name;
		$data_opening['opening_time'] = date('Y-m-d H:i:s');
		$data_opening['saldo_awal'] = $this->input->post('saldo_awal');
		$data_opening['note_opening'] = $this->input->post('note_opening');

		$this->db->insert('trx_opening_kasir', $data_opening);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			if ($debug)
				$this->db->trans_rollback();
			else {
				$this->db->trans_commit();
				redirect('pembayaran');
			}
		}

	}

	function closing_kasir()
	{
		#$this->output->enable_profiler(true);
		$data_opening = $this->smartlib->get_data_opening_kasir();

		if (empty($data_opening)) {
			return $this->load->view('opening_is_closed');
		}

		### ------ START CLOSING ------ ###
		$data_inv = $this->Closing_model->get_data_inv($data_opening['id_opening']);
		$data_inv_refund = $this->Closing_model->get_data_inv_refund($data_opening['id_opening']);
		$data_dp = $this->Closing_model->get_data_dp($data_opening['id_opening']);
		$data_dp_refund = $this->Closing_model->get_data_dp_refund($data_opening['id_opening']);
		$data_bank = $this->Closing_model->get_list_bank_aktif();

		$jml_data_inv = count($data_inv);
		$jml_data_inv_refund = count($data_inv_refund);
		$jml_data_dp = count($data_dp);
		$jml_data_dp_refund = count($data_dp_refund);

		$data_header = array();
		$data_header['jml_data_inv'] = $jml_data_inv;
		$data_header['jml_data_inv_refund'] = $jml_data_inv_refund;
		$data_header['jml_data_dp'] = $jml_data_dp;
		$data_header['jml_data_dp_refund'] = $jml_data_dp_refund;
		$data_header['jml_data_inv_all'] = $jml_data_inv + $jml_data_inv_refund + $jml_data_dp + $jml_data_dp_refund;

		$data = array(
			'data_header' => $data_header,
			'data_opening' => $data_opening,
			'data_inv' => $data_inv,
			'data_inv_refund' => $data_inv_refund,
			'data_dp' => $data_dp,
			'data_dp_refund' => $data_dp_refund,
			'data_bank' => $data_bank,
		);
		$this->load->view('closing_kasir', $data);
	}

	function closing_kasir_act()
	{
		$debug = false;
		$this->output->enable_profiler($debug);

		$data_opening = $this->smartlib->get_data_opening_kasir();
		$id_opening = $data_opening['id_opening'];

		$data_inv = $this->Closing_model->get_data_inv($data_opening['id_opening']);
		$data_inv_refund = $this->Closing_model->get_data_inv_refund($data_opening['id_opening']);
		$data_dp = $this->Closing_model->get_data_dp($data_opening['id_opening']);
		$data_dp_refund = $this->Closing_model->get_data_dp_refund($data_opening['id_opening']);

		$total_total_asuransi = 0;
		$total_total_cc1 = 0;
		$total_total_cash = 0;
		foreach ($data_inv as $k => $v) {
			$total_total_asuransi += $v->total_noncash;
			$total_total_cc1 += $v->total_cc1;
			$total_total_cash += $v->total_cash;
		}

		$total_ref_asuransi = 0;
		$total_ref_total_cash = 0;
		foreach ($data_inv_refund as $k => $v) {
			$total_ref_asuransi += $v->refund_asuransi;
			$total_ref_total_cash += $v->tunai;
		}

		$total_dp_cc1 = 0;
		$total_dp_cash = 0;
		foreach ($data_dp as $k => $v) {
			$total_dp_cc1 += $v->total_cc1;
			$total_dp_cash += $v->total_cash;
		}

		$total_dp_ref_cash = 0;
		foreach ($data_dp_refund as $k => $v) {
			$total_dp_ref_cash += ($v->total_cash * -1);
		}

		$grand_total_tunai = $total_total_cash - $total_ref_total_cash + $total_dp_cash - $total_dp_ref_cash;
		$grand_total_cc1 = $total_total_cc1 + $total_dp_cc1;
		$grand_total_asuransi = $total_total_asuransi - $total_ref_asuransi;
		#$total_setoran_tunai	= $grand_total_tunai + $data_opening['saldo_awal'];

		$this->db->trans_begin();
		//--- UPDATE OPENING & CLOSING ----
		$data_closing = array();
		$data_closing['closing_time'] = date('Y-m-d H:i:s');
		$data_closing['total_cash'] = $grand_total_tunai;
		$data_closing['total_non_cash'] = $grand_total_cc1;
		$data_closing['total_asuransi'] = $grand_total_asuransi;
		$data_closing['note_closing'] = $this->input->post('note_closing');
		$this->Closing_model->update('trx_opening_kasir', 'id_opening', $id_opening, $data_closing);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			if ($debug)
				$this->db->trans_rollback();
			else {
				$this->db->trans_commit();
				redirect('pembayaran/list_closing_kasir');
			}
		}
	}

	public function list_closing_kasir($auto_print_id_opening = "")
	{
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start == '') ? date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))) : $periode_start;
		$periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end == '') ? date('Y-m-d') : $periode_end;
		#$id_nakes 		= $this->input->post('id_nakes');

		$data_closing = $this->Closing_model->data_list_closing_kasir($periode_start, $periode_end);

		/*
		$sql_id_nakes = "	SELECT 	a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
							FROM 	mst_dokter a
									LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
							ORDER BY a.name";
		$sql_id_jenis_nakes = "SELECT a.id_jenis,a.name FROM mst_dokter_type a ORDER BY a.id_jenis";
		*/
		$num_rows = 0;
		$data = array(
			'data_closing' => $data_closing,
			'periode_start' => $periode_start,
			'periode_end' => $periode_end,
			'num_rows' => $num_rows,
			#'dropdown_id_jenis_nakes' 	=> $this->formgenerator->get_dropdown('id_jenis',$sql_id_jenis_nakes,$id_jenis),
			#'dropdown_id_nakes' 		=> $this->formgenerator->get_dropdown('id_nakes',$sql_id_nakes,$id_nakes),
			'auto_print_id_opening' => $auto_print_id_opening,
		);
		$this->load->view('closing_kasir_list', $data);
	}


	function print_closing_kasir($id_opening)
	{
		#$this->output->enable_profiler(true);
		$data_opening = $this->Closing_model->data_closing_kasir($id_opening);

		$data_inv = $this->Closing_model->get_data_inv($data_opening['id_opening']);
		$data_inv_refund = $this->Closing_model->get_data_inv_refund($data_opening['id_opening']);
		$data_dp = $this->Closing_model->get_data_dp($data_opening['id_opening']);
		$data_dp_refund = $this->Closing_model->get_data_dp_refund($data_opening['id_opening']);
		$data_bank = $this->Closing_model->get_list_bank_aktif();

		$jml_data_inv = count($data_inv);
		$jml_data_inv_refund = count($data_inv_refund);
		$jml_data_dp = count($data_dp);
		$jml_data_dp_refund = count($data_dp_refund);

		$data_header = array();
		$data_header['jml_data_inv'] = $jml_data_inv;
		$data_header['jml_data_inv_refund'] = $jml_data_inv_refund;
		$data_header['jml_data_dp'] = $jml_data_dp;
		$data_header['jml_data_dp_refund'] = $jml_data_dp_refund;
		$data_header['jml_data_inv_all'] = $jml_data_inv + $jml_data_inv_refund + $jml_data_dp + $jml_data_dp_refund;

		$data = array(
			'data_header' => $data_header,
			'data_opening' => $data_opening,
			'data_inv' => $data_inv,
			'data_inv_refund' => $data_inv_refund,
			'data_dp' => $data_dp,
			'data_dp_refund' => $data_dp_refund,
			'data_bank' => $data_bank,
		);
		$this->load->view('print_closing_kasir', $data);
	}

	public function closing_export_xlsx($id_jasmed)
	{
		$share_nakes_header = $this->V_jasmed_model->share_nakes_header($id_jasmed);
		$title = array(
			'Dokumen' => 'SHARE NAKES',
			'Id. Nakes' => $share_nakes_header->id_nakes,
			'Nama' => $share_nakes_header->nakes,
			'Tgl DIbuat' => $share_nakes_header->waktu_jasmed,
			'Periode Tindakan (dari)' => date('Y-m-d', strtotime($share_nakes_header->periode_start)),
			'Periode Tindakan (sampai)' => date('Y-m-d', strtotime($share_nakes_header->periode_end)),
			'Total' => $share_nakes_header->total,
		);

		$rs = $this->V_jasmed_model->share_nakes_detail($id_jasmed);
		foreach ($rs as $k => $v) {
			$data[] = array(
				'TGL WAKTU' => $v->trxdate,
				'NAMA PASIEN/NO.RM/NO.REG' => $v->pasien . ' / ' . $v->id_pasien . ' / ' . $v->id_reg,
				'TINDAKAN' => $v->tindakan,
				'TARIF (Rp)' => $v->tarif,
				'SHARE NAKES (%)' => $v->persen_nakes,
				'SHARE NAKES (Rp)' => $v->share_nakes,
			);
		}

		$this->load->library('Exportir');
		$this->exportir->export_to_spreadsheet($title, $data);
	}

}

