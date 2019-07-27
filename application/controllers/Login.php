<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	function __construct(){
		parent:: __construct();
		//$this->load->model('Pegawai_model');
		date_default_timezone_set('Asia/Jakarta');
		//$this->load->model('Gempa_model');
		//$this->load->model('informasi_model');
		
	}
	public function masuk(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$this->load->model('Pegawai_model');
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
			$this->load->model('Cuaca_model');
			$tanggal = date('Y-m-d');
			$data['cuaca'] = $this->Cuaca_model->cuaca_dashboard($tanggal);
			$this->load->view('Login/Dashboard',$data);	
		}
	}


	public function keluar(){
		$this->load->model('Pegawai_model');
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
			$tanggal = date('Y-m-d');
			$this->load->model('Cuaca_model');
			$data['cuaca'] = $this->Cuaca_model->cuaca_dashboard($tanggal);
			$data['kah']= $this->Cuaca_model->kah_dash(date('m'),date('Y'));
			$data['spm']= $this->Cuaca_model->spm_dash(date('m'),date('Y'));
			$this->load->model('Informasi_model');
			$data['informasi']= $this->Informasi_model->artikel_dashboard(date('Y-m'));
			$this->load->view('Login/Dashboard',$data);
		}else{
			redirect('Login/login');
		}
	}
}
