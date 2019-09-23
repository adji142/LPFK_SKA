<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

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
	// ==================================================== Mesin ====================================================
	public function InsertMesinData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter

		$kdalat = $this->input->post('kdalat');
		$nmalat = $this->input->post('nmalat');
		$merk = $this->input->post('merk');
		$model = $this->input->post('model');
		$sn = $this->input->post('sn');
		$tgl = $this->input->post('tgl');
		$ket = $this->input->post('ket');
		$jml = $this->input->post('jml');

		// 
		$insert = array(
			'kode_alat' => $kdalat,
			'nama_alat'	=> $nmalat,
			'merk'		=> $merk,
			'model'		=> $model,
			'no_seri'	=> $sn,
			'tgl_masuk'	=> $tgl,
			'comment'	=> $ket,
			'jumlah'	=> $jml
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'masteralat');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function EditMesinData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		if ($this->input->post('id') != NULL) {
			$id = $this->input->post('id');

			$Update = array(
				'tglpasif'	=> date("Y-m-d H:i:s")
			);

			$where = array(
				'id'	=> $id
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masteralat');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		else{
			$kdalat = $this->input->post('kdalat');
			$nmalat = $this->input->post('nmalat');
			$merk = $this->input->post('merk');
			$model = $this->input->post('model');
			$sn = $this->input->post('sn');
			$tgl = $this->input->post('tgl');
			$ket = $this->input->post('ket');
			$jml = $this->input->post('jml');

			// 
			$Update = array(
				'nama_alat'	=> $nmalat,
				'merk'		=> $merk,
				'model'		=> $model,
				'no_seri'	=> $sn,
				'tgl_masuk'	=> $tgl,
				'comment'	=> $ket,
				'jumlah'	=> $jml
			);

			$where = array(
				'kode_alat'	=> $kdalat
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masteralat');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		echo json_encode($data);
	}
	public function GetMesinData()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masteralat');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Data Not Found';
		}
		echo json_encode($data);
	}
	public function InserPemeliharaan()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter

		$notrans = $this->input->post('notrans');
		$tgltrans = $this->input->post('tgltrans');
		$vendor = $this->input->post('vendor');
		$pic = $this->input->post('pic');
		$ket = $this->input->post('ket');
		$stockid = $this->input->post('stockid');
		$user_id = $this->session->userdata('userid');

		// 
		$insert = array(
			'notransaksi' 		=> $notrans,
			'tglpemeliharaan'	=> $tgltrans,
			'namavendor'		=> $vendor,
			'penanggungjawab'	=> $pic,
			'penanggungjawab'	=> $ket,
			'alatid'			=> $stockid,
			'comment1'			=> $ket,
			'createdby'			=> $user_id,
			'createdon'			=> date("Y-m-d H:i:s")
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'pemeliharaan');

		if ($call) {
			$query = $this->ModelsExecuteMaster->ExecUpdate(array('maintain'=>1),array('id'=>$stockid),'masteralat');
			if ($query) {
				$data['success'] = true;
			}
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function pemeliharaanDone()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');
		$tgltrans = $this->input->post('tgltrans');
		$notrx = $this->input->post('notrx');
		$ket = $this->input->post('ket');

		$get = $this->ModelsExecuteMaster->FindData(array('notransaksi'=>$notrx),'pemeliharaan');
		if ($get->num_rows() > 0) {
			$Update = array(
				'tglselesai'	=> $tgltrans,
				'comment2'		=> $ket
			);
			$exec = $this->ModelsExecuteMaster->ExecUpdate($Update,array('notransaksi'=>$notrx),'pemeliharaan');
			if ($exec) {
				$query = $this->ModelsExecuteMaster->ExecUpdate(array('maintain'=>0),array('id'=>$get->row()->alatid),'masteralat');
				if ($query) {
					$data['success'] = true;
				}
				else{
					$data['message'] = 'Gagal Update Alat';
				}
			}
			else{
				$data['message'] = 'Gagal Update Transaksi';
			}
		}
		else{
			$data['message'] = 'Nomer Transaksi Tidak Valid';
		}
		echo json_encode($data);
	}

	// ==================================================== Mesin ====================================================

	// ==================================================== FASYANKES ================================================

	public function InsertfasyankesData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter kode:kode,nama:nama,alamat:alamat,tlp:tlp,mail:mail,pj:pj,tgl:tgl,ket:ket}

		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$mail = $this->input->post('mail');
		$pj = $this->input->post('pj');
		$tgl = $this->input->post('tgl');
		$ket = $this->input->post('ket');

		// 
		$insert = array(
			'kodefasyankes' 	=> $kode,
			'namafasyankes'		=> $nama,
			'alamat'			=> $alamat,
			'nomertlf'			=> $tlp,
			'email'				=> $mail,
			'penanggungjawab'	=> $pj,
			'tglbergabung'		=> $tgl,
			'keterangan'		=> $ket,
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'masterfasyankes');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function EditfasyankesData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		if ($this->input->post('id') != NULL) {
			$id = $this->input->post('id');

			$Update = array(
				'tglpasif'	=> date("Y-m-d H:i:s")
			);

			$where = array(
				'id'	=> $id
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masterfasyankes');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		else{
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$tlp = $this->input->post('tlp');
			$mail = $this->input->post('mail');
			$pj = $this->input->post('pj');
			$tgl = $this->input->post('tgl');
			$ket = $this->input->post('ket');

			// 
			$Update = array(
				'kodefasyankes' 		=> $kode,
				'namafasyankes'		=> $nama,
				'alamat'			=> $alamat,
				'nomertlf'			=> $tlp,
				'email'				=> $mail,
				'penanggungjawab'	=> $pj,
				'tglbergabung'		=> $tgl,
				'keterangan'		=> $ket,
			);

			$where = array(
				'kodefasyankes'	=> $kode
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masterfasyankes');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		echo json_encode($data);
	}
	public function GetfasyankesData()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masterfasyankes');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Data Not Found';
		}
		echo json_encode($data);
	}

	// ==================================================== FASYANKES ================================================

	// ==================================================== LABOLATORIUM =============================================

	public function InsertlabolatoriumData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter kode:kode,nama:nama,alamat:alamat,tlp:tlp,mail:mail,pj:pj,tgl:tgl,ket:ket}

		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$tgl = $this->input->post('tgl');
		$ket = $this->input->post('ket');

		// 
		$insert = array(
			'kodelab' 	=> $kode,
			'namalab'		=> $nama,
			'tglmasuk'		=> $tgl,
			'comment'		=> $ket,
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'masterlabolatorium');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function EditlabolatoriumData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		if ($this->input->post('id') != NULL) {
			$id = $this->input->post('id');

			$Update = array(
				'tglpasif'	=> date("Y-m-d H:i:s")
			);

			$where = array(
				'id'	=> $id
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masterlabolatorium');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		else{
			$kode = $this->input->post('kode');
			$nama = $this->input->post('nama');
			$tgl = $this->input->post('tgl');
			$ket = $this->input->post('ket');

			// 
			$Update = array(
				'namalab'		=> $nama,
				'penanggungjawab'	=> $pj,
				'tglmasuk'		=> $tgl,
				'comment'		=> $ket,
			);

			$where = array(
				'kodefasyankes'	=> $kode
			);
			$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'masterlabolatorium');

			if ($call) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Data Gagal di Update';
			}
		}
		echo json_encode($data);
	}
	public function GetlabolatoriumData()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masterlabolatorium');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Data Not Found';
		}
		echo json_encode($data);
	}
	// ==================================================== Pegawai =============================================

	public function InsertPegawaiData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter kode:kode,nama:nama,alamat:alamat,tlp:tlp,mail:mail,pj:pj,tgl:tgl,ket:ket}

		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$divisi = $this->input->post('divisi');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$joindate = $this->input->post('joindate');
		$resigndate = $this->input->post('resigndate');
		$jk = $this->input->post('jk');
		$jabatan = $this->input->post('jabatan');
		$user_id = $this->session->userdata('userid');

		// 
		$insert = array(
			'nik' 		=> $nik,
			'nama'		=> $nama,
			'alamat'	=> $alamat,
			'notlp'		=> $tlp,
			'divisi'	=> $divisi,
			'tgljoin'	=> $joindate,
			'tglresign'	=> $resigndate,
			'createdon'	=> date("Y-m-d H:i:s"),
			'createdby'	=> $user_id,
			'jeniskelamin' => $jk,
			'jabatan' => $jabatan,
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'pegawai');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function GetPegawaiData()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'pegawai');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Data Not Found';
		}
		echo json_encode($data);
	}
	public function EditPegawaiData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$divisi = $this->input->post('divisi');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$joindate = $this->input->post('joindate');
		$resigndate = $this->input->post('resigndate');
		$jk = $this->input->post('jk');
		$jabatan = $this->input->post('jabatan');
		// 
		$Update = array(
			'nama'		=> $nama,
			'alamat'	=> $alamat,
			'notlp'		=> $tlp,
			'divisi'	=> $divisi,
			'tgljoin'	=> $joindate,
			'tglresign'	=> $resigndate,
			'jeniskelamin' => $jk,
			'jabatan' => $jabatan,
		);

		$where = array(
			'nik'	=> $nik
		);
		$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'pegawai');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di Update';
		}
		echo json_encode($data);
	}

	// ==================================================== Pegawai =============================================
	// ==================================================== Vendor =============================================

	public function InsertVendorData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter kode:kode,nama:nama,alamat:alamat,tlp:tlp,mail:mail,pj:pj,tgl:tgl,ket:ket}

		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$joindate = $this->input->post('joindate');
		$user_id = $this->session->userdata('userid');

		// 
		$insert = array(
			'kodevendor'=> $kode,
			'namavendor'=> $nama,
			'alamat'	=> $alamat,
			'tlp'		=> $tlp,
			'tglmasuk'	=> $joindate,
		);

		$call = $this->ModelsExecuteMaster->ExecInsert($insert,'mastervendor');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di input';
		}
		echo json_encode($data);
	}
	public function GetVendorData()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'mastervendor');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$data['message'] = 'Data Not Found';
		}
		echo json_encode($data);
	}
	public function EditVendorData()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		// parameter
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$joindate = $this->input->post('joindate');
		$user_id = $this->session->userdata('userid');
		// 
		$Update = array(
			'namavendor'=> $nama,
			'alamat'	=> $alamat,
			'tlp'		=> $tlp,
			'tglmasuk'	=> $joindate,
		);

		$where = array(
			'kodevendor'	=> $kode
		);
		$call = $this->ModelsExecuteMaster->ExecUpdate($Update,$where,'mastervendor');

		if ($call) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'Data Gagal di Update';
		}
		echo json_encode($data);
	}
}
