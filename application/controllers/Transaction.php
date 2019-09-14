<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaction extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('Apps_mod');
	}

	// ==================================================== GlobalVar ====================================================

	public function getDummy()
	{
		$data = array('success' => true ,'message'=>array(),'data' =>array());

		$call = $this->db->query("select '' Prefix,'' namamsn,0 onhand,0 Jumlah");

		$data['data'] = array();
		echo json_encode($data);
	}

	public function getDataMesin()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array(),'onhand'=>0);

		$kode = $this->input->post('kode');

		$call = $this->ModelsExecuteMaster->FindData(array('kode_alat' => $kode),'masteralat');
		
		if ($call->num_rows() > 0) {
			$data['success'] = true;
			$data['data'] = $call->result();
			$stock = $this->Apps_mod->cekStock($kode)->row();
			$data['onhand'] = $stock->Stock;
		}
		else{
			$data['message'] = 'Failed Retrive data From Database';
		}

		echo json_encode($data);
	}

	public function GetNumeric()
	{
		$data = array('success' => false ,'message'=>array(),'prefix'=>'');

		$table = $this->input->post('table');
		$field = $this->input->post('field');
		$prefix = 0;

		$call = $this->ModelsExecuteMaster->GetMax($table,$field);
		// var_dump($call->result());
		if ($call->row()->$field != NULL) {
			$prefix = substr($call->row()->notransaksi, -4)+1;
		}
		else{
			$prefix = 1;
		}
		// echo "string".$prefix;
		$data['success'] = true;
		$data['prefix'] = $prefix;

		echo json_encode($data);
	}

	// ==================================================== GlobalVar ====================================================

	// ================================================ Peminjaman ================================================

	public function InsertPeminjamanHeaderData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter

		$notrans = $this->input->post('notrans');
		$tgltrans = $this->input->post('tgltrans');
		$fasyankes = $this->input->post('fasyankes');
		$nama = $this->input->post('nama');
		$petugas = $this->input->post('petugas');
		$tujuan = $this->input->post('tujuan');
		$row = $this->input->post('row');
		$user_id = $this->session->userdata('userid');

		// 
		// $this->db->trans_begin();
		if ($row == 'header') {
			$insert = array(
				'notransaksi'	 	=> $notrans,
				'tgltransaksi'		=> $tgltrans,
				'kodefasyankes'		=> $fasyankes,
				'namapeminjam'		=> $nama,
				'namapetugas'		=> $petugas,
				'tujuanpinjam'		=> $tujuan,
				'createdby'			=> $user_id,
				'createdon' 		=> date("Y-m-d H:i:s"),
				'statustransaksi'	=> 0
			);

			$call = $this->ModelsExecuteMaster->ExecInsert($insert,'peminjaman');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data header Gagal di input';
			}
		}
		else{
			$kodemesn = $this->input->post('kodemesn');
			$Jumlah = $this->input->post('Jumlah');
			$onhand = $this->Apps_mod->cekStock($kodemesn)->row();

			if ($Jumlah <= $onhand && $Jumlah != 0) {

				$insert = array(
					'headerid'	 	=> $notrans,
					'kodemesin'		=> $kodemesn,
					'jumlah'		=> $Jumlah,
					'createdby'		=> $user_id,
					'createdon' 	=> date("Y-m-d H:i:s")
				);

				$call = $this->ModelsExecuteMaster->ExecInsert($insert,'peminjamandetail');

				if ($call) {
					$data['success'] = true;
				}
				else{
					$data['message'] = 'Data Detail Gagal di input';
				}
			}
			else{
				$data['message'] = 'Jumlah Alat '. $kodemesn. ' Tidak Mencukupi jika di pinjam sejumlah '.$Jumlah.'. Total Tersedia : '.$onhand.' Unit';
			}
		}
		// if ($errorheader AND $errordetail) {
		// 	$this->db->trans_rollback();
		// }
		// else{
		// 	$this->db->trans_commit();
		// }
		echo json_encode($data);
	}

	function FindPeminjamanDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$headerid = $this->input->post('id');

		$exec = $this->Apps_mod->GetPeminjamanDetailList($headerid);
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Failed Retrive Data From Database';
		}
		echo json_encode($data);
	}
	function FindPeminjamanHeader()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$headerid = $this->input->post('notransaksi');

		$exec = $this->ModelsExecuteMaster->FindData(array('notransaksi'=>$headerid),'peminjaman');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Failed Retrive Data From Database';
		}
		echo json_encode($data);
	}
	// ================================================ Peminjaman ================================================

	// =============================================== Pengembalian================================================
	public function clearline()
	{
		$data = array('success' => true ,'message'=>array(),'id' =>'');
		$notranskembali = $this->input->post('notransaksi');
		$this->db->delete('pengembaliandetail',array('headerid'=>$notranskembali));
		echo json_encode($data);
	}
	public function InsertPengembalianHeaderData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		$row = $this->input->post('row');
		$notrans = $this->input->post('notrans');
		$notranskembali = $this->input->post('notranskembali');
		$tgltranskmbali = $this->input->post('tgltranskmbali');
		$namapenerima = $this->input->post('namapenerima');
		$user_id = $this->session->userdata('userid');

		$total = 0;
		// Begin Transaction
		// $this->db->trans_begin();

		if ($row == 'header') {
			$insert = array(
				'notransaksi'	 	=> $notranskembali,
				'tgltransaksi'		=> $tgltranskmbali,
				'nopinjam'			=> $notrans,
				'penerimabarang'	=> $namapenerima,
				'createdby'			=> $user_id,
				'createdon' 		=> date("Y-m-d H:i:s")
			);

			$call = $this->ModelsExecuteMaster->ExecInsert($insert,'pengembalian');

			if ($call) {
				$data['success'] = true;
				$total = $total+1;
			}
			else{
				$data['message'] = 'Data header Gagal di input';
			}
		}
		else{

			$kodemesn = $this->input->post('kodemesn');
			$Jumlahpinjam = $this->input->post('Jumlahpinjam');
			$Jumlahkembali = $this->input->post('Jumlahkembali');

			$mesincount = $this->ModelsExecuteMaster->FindData(array('kode_alat'=>$kodemesn),'masteralat');
			// var_dump($kodemesn);
			if ($mesincount->num_rows() > 0) {
				if ($Jumlahkembali > $Jumlahpinjam) {
					$data['message'] = 'Jumlah Kembali Tidak Boleh lebih dari jumlah Peminjaman';
				}
				else{

					$insert = array(
						'headerid'	 	=> $notranskembali,
						'kodealat'		=> $kodemesn,
						'jumlahkembali'		=> $Jumlahkembali,
						'createdby'		=> $user_id,
						'createdon' 	=> date("Y-m-d H:i:s")
					);

					$call = $this->ModelsExecuteMaster->ExecInsert($insert,'pengembaliandetail');

					if ($call) {
						$data['success'] = true;
						$total =$total + 1;
					}
					else{
						$data['message'] = 'Data Detail Gagal di input';
					}

				}
			}
			else{
				$data['message'] = 'Data Alat Tidak Valid';
			}
		}
		// var_dump($total);
		// if ($total >= 2) {
		// 	$this->db->trans_commit();
		// }
		// else{
		// 	$this->db->trans_rollback();
		// }
		echo json_encode($data);
	}
	public function ValidateTransaction()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');
		$notr = $this->input->post('notransaksi');
		$list = $this->Apps_mod->GetPeminjamanDetailList_forvalidation($notr)->result();

		$status = 0;
		foreach ($list as $key) {
			if ($key->jumlah == 0) {
				$status = 1;
			}
			else{
				$status = 0;
			}
		}
		if ($status == 1) {
			$data_update = array('statustransaksi' => 1);
			$update = $this->ModelsExecuteMaster->ExecUpdate($data_update,array('notransaksi'=>$notr),'peminjaman');

			if ($update) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Gagal Melakukan Updadte, Hubungi Administrator';
			}
		}
		else{
			$data['success'] = true;
			// $data['message'] = 'TRANSAKSI BERASIL, Sistem Mendeteksi ada alat yang belum di kembalikan';
		}
		echo json_encode($data);
	}
	public function FIndPengembalianDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$headerid = $this->input->post('id');
		
		$exec = $this->Apps_mod->GetPeminjamanDetailList_fordetail($headerid);
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Failed Retrive Data From Database';
		}
		echo json_encode($data);

	}
}
