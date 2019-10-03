<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller {

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
		$this->load->model('LoginMod');
	}
	public function peminjaman()
	{
		$data = array('success' => true ,'message'=>array(),'data' =>array(),'onhand'=>0);
		$startdate = $this->input->post('tglawal');
		$enddate = $this->input->post('tglakhir');

		$query = "
			SELECT 
				a.notransaksi,a.tgltransaksi,d.kodefasyankes,d.namafasyankes,a.namapetugas,a.namapeminjam,c.kode_alat,c.nama_alat,c.no_seri,b.jumlah
			FROM peminjaman a
			LEFT JOIN peminjamandetail b on a.notransaksi = b.headerid
			LEFT JOIN masteralat c on b.kodemesin = c.id
			LEFT JOIN masterfasyankes d on a.kodefasyankes = d.id
			WHERE a.tgltransaksi BETWEEN '$startdate' AND '$enddate'
		";
		$data['data'] = $this->db->query($query)->result();
		echo json_encode($data);
	}
	public function pengembalian()
	{
		$data = array('success' => true ,'message'=>array(),'data' =>array(),'onhand'=>0);
		$startdate = $this->input->post('tglawal');
		$enddate = $this->input->post('tglakhir');

		$query = "
			SELECT 
				a.notransaksi,a.tgltransaksi,a.nopinjam,a.penerimabarang,
				c.kode_alat,c.no_seri,c.nama_alat,b.jumlahkembali
			FROM pengembalian a
			LEFT JOIN pengembaliandetail b on a.notransaksi = b.headerid
			LEFT JOIN masteralat c on b.kodealat = c.id
			where a.tgltransaksi BETWEEN '$startdate' AND '$enddate'
		";
		$data['data'] = $this->db->query($query)->result();
		echo json_encode($data);
	}
}
