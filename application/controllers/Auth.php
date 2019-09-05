<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		$this->load->model('LoginMod');
	}
	public function index()
	{
		$this->load->view('index');
	}
	function Log_Pro()
	{
		$data = array('success' => false ,'message'=>array());
        $usr = $this->input->post('username');
		$pwd =$this->input->post('password');
		// var_dump($usr);
		$Validate_username = $this->LoginMod->Validate_username($usr);
		if($Validate_username->num_rows()>0){
			$userid = $Validate_username->row()->id;
			$pwd_decript =$Validate_username->row()->password;
			// var_dump($this->encryption->decrypt($pwd_decript));
			$pass_valid = $this->encryption->decrypt($Validate_username->row()->password);
			// var_dump($this->encryption->decrypt($Validate_username->row()->password));
			// $get_Validation = $this->LoginMod->Validate_Login($userid,$this->encryption->encrypt($pwd));
			if($pass_valid == $pwd){
				$sess_data['userid']=$userid;
				$this->session->set_userdata($sess_data);
				$data['success'] = true;
			}
			else{
				$data['success'] = false;
				$data['message'] = 'L-01'; // User password doesn't match
			}
		}
		else{
			$data['message'] = 'L-02'; // Username not found
		}
		echo json_encode($data);
	}
	function logout()
	{
		delete_cookie('ci_session');
        $this->session->sess_destroy();
        redirect('Welcome');
	}
}
