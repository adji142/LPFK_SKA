<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

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
	public function index()
	{
		$this->load->view('Dashboard');
	}
	public function mesinlist()
	{
		$this->load->view('Daftarmesin');
	}
	public function fasyankes()
	{
		$this->load->view('Fasyankes');
	}
	public function lab()
	{
		$this->load->view('Labolatorium');
	}
	public function pinjam()
	{
		$this->load->view('Peminjaman');
	}
	public function kembali()
	{
		$this->load->view('Pengembalian');
	}
	public function pelihara()
	{
		$this->load->view('pemeliharaan');
	}
	public function pegawai()
	{
		$this->load->view('Pegawai');
	}
	public function vendor()
	{
		$this->load->view('Vendor');
	}
	public function user()
	{
		$this->load->view('users');
	}
	public function change()
	{
		$this->load->view('changepass');
	}
	public function lappengeluaran()
	{
		$this->load->view('lappengeluaran');
	}
	public function lappengembalian()
	{
		$this->load->view('lappengembalian');
	}
}
