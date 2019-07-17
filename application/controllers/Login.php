<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	function __construct(){
		parent:: __construct();

		$this->load->model('Pegawai_model');
		
	}
	public function masuk(){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = $this->Pegawai_model->masuk($username, $password);

		if ($data['status']) {
			$data=$data['akses'][0];
			$this->session->set_userdata(array('login'=>'masuk',
				'foto'=>$data->foto,
				'nama'=>$data->nama,
				'nia'=>$data->id_admin
			));
			redirect(site_url("Login"));
		}else{
			redirect(site_url("Login/login"));
		}
		
	}

	public function sukses(){
		if($this->session->userdata('login') != "masuk"){
			redirect(base_url("Login"));
		}else {
			$this->load->view('Login/Dashboard');	
		}
	}


	public function keluar(){
		$this->Pegawai_model->set_waktu($this->session->userdata('nia'));
		$this->session->sess_destroy();
		$this->load->view('Login/Login');
	}

	public function login(){
		$this->load->view('Login/Login');
	}

	public function pnf(){
		$this->load->view('page_not_found');
	}

	public function index(){
		if($this->session->userdata('login') == "masuk"){
			$this->load->view('Login/Dashboard');
		}else{
			redirect('Login/login');
		}
	}
}
