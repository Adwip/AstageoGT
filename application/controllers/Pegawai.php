<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public $waktu=null;
	function __construct(){
		parent::__construct();		
		$this->load->model('Pegawai_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->waktu = date('Y-m-d H:i:s');
		$this->Pegawai_model->set_akses($this->session->userdata('nia'));
		$this->load->library('Pemisah_angka');
		if($this->session->userdata('login') != "masuk"){
			redirect(base_url("Login"));
		}
	}	
	public function admin(){
		if($this->session->userdata('administrator') == "Ya"){
			$page=1;
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}
			$data['admin']=$this->Pegawai_model->admin($page);
			$this->load->view('Pegawai/Daftar_admin',$data);
		}else{
			$this->load->view('Umum');
		}
		
	}

	public function set_admin(){
		if($this->session->userdata('administrator') == "Ya"){
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = $_POST['username'];
			$nambar='no-img.png';
			$aks=array('berita','artikel','kepegawaian','prak_musim','cuaca','analis_iklim','inf_iklim','per_iklim','kual_udara','gempa','ttm_petir','umum','administrator');

			$type=array('image/jpg','image/JPG','image/png','image/PNG','image/jpeg');
			if (in_array($_FILES['foto']['type'],$type)) {
				$temp = explode(".", $_FILES['foto']['name']);
				$nambar = date('Hisdmy').'ADM.'.end($temp);
				move_uploaded_file($_FILES['foto']['tmp_name'],'../File_BMKG/Admin/'.$nambar);
			}
			$data=null;
			for ($i=0; $i < count($aks); $i++) { 
				# code...
				if (isset($_POST[$aks[$i]])) {
					# code...
					$data[$aks[$i]]=$_POST[$aks[$i]];
				}else{
					$data[$aks[$i]]=null;
				}
			}
			$nia=$this->Pegawai_model->set_admin($nama,$username,$password,$nambar,$this->session->userdata('nama'),$this->waktu);
			if ($nia!=null) {
				$this->Pegawai_model->set_akses_json($nia,$data['berita'],$data['artikel'],$data['kepegawaian'],$data['cuaca'],$data['prak_musim'],$data['analis_iklim'],$data['inf_iklim'],$data['per_iklim'],$data['kual_udara'],$data['gempa'],$data['ttm_petir'],$data['umum'],$data['administrator']);
				echo true;
			}
			
			
		}
	}

	public function edit_akses(){

		$nia = $_POST['id'];
		//$username = $_POST['username'];
		//$password = $_POST['username'];

		$aks=array('berita','artikel','kepegawaian','prak_musim','cuaca','analis_iklim','inf_iklim','per_iklim','kual_udara','gempa','ttm_petir','umum','administrator');

		for ($i=0; $i < count($aks); $i++) { 
			# code...
			if (isset($_POST[$aks[$i]])) {
				# code...
				$data[$aks[$i]]=$_POST[$aks[$i]];
			}else{
				$data[$aks[$i]]=null;
			}
		}

		//echo json_encode($data);
		echo $this->Pegawai_model->edit_akses($nia,$data['berita'],$data['artikel'],$data['kepegawaian'],$data['cuaca'],$data['prak_musim'],$data['analis_iklim'],$data['inf_iklim'],$data['per_iklim'],$data['kual_udara'],$data['gempa'],$data['ttm_petir'],$data['umum'],$data['administrator']);

	}

	public function get_akses_id(){
		$data=$this->Pegawai_model->get_akses_id($_GET['id']);
		echo json_encode($data);
	}

	public function edit_akses2(){
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = $_POST['username'];
			$foto=null;
			$aks=array('berita','artikel','kepegawaian','prak_musim','cuaca','analis_iklim','inf_iklim','per_iklim','kual_udara','gempa','ttm_petir','umum','administrator');
			$type=array('image/jpg','image/JPG','image/png','image/PNG');
			if (in_array($_FILES['foto']['type'],$type)) {
				if (!file_exists('../File_BMKG/Admin/'.$_FILES['foto']['name'])) {
					move_uploaded_file($_FILES['foto']['tmp_name'],'../File_BMKG/Admin/'.$_FILES['foto']['name'] );
					$foto=$_FILES['foto']['name'];
					# code...
				}
				# code...
			}
			$data=null;
			for ($i=0; $i < count($aks); $i++) { 
				# code...
				if (isset($_POST[$aks[$i]])) {
					# code...
					$data[$aks[$i]]=$_POST[$aks[$i]];
				}else{
					$data[$aks[$i]]=null;
				}
			}
			$nia=$this->Pegawai_model->set_admin($nama,$username,$password,$foto,$this->session->userdata('nama'),$this->waktu);

			$this->Pegawai_model->set_akses_json($nia,$data['berita'],$data['artikel'],$data['kepegawaian'],$data['cuaca'],$data['prak_musim'],$data['analis_iklim'],$data['inf_iklim'],$data['per_iklim'],$data['kual_udara'],$data['gempa'],$data['ttm_petir'],$data['umum'],$data['administrator']);

			redirect(site_url('Pegawai/admin'));
	}

	public function panel(){
		$this->load->view('Pegawai/panel');
	}

	public function gp_page(){
		$data=$this->Pegawai_model->get_panel($this->session->userdata('nia'));
		$this->load->view('Pegawai/gp_page',$data);
	}

	public function ch_pass(){
		$id=$this->session->userdata('nia');
		$pas=$_POST['pass'];
		$o_pass=$_POST['old_pass'];

		echo $this->Pegawai_model->ch_pass($id,$pas,$o_pass);
	}

	public function del_admin(){
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			# code...
			echo $this->Pegawai_model->del_admin($_POST['hapus'][$i]);
		}
	}

	public function edit_akun(){
		$type=array('image/jpg','image/JPG','image/png','image/PNG','image/jpeg');
		if ($_POST['nama']!='') {
			$isi['nama']=$_POST['nama'];
		}

		if ($_POST['username']!='') {
			$isi['usernam']=$_POST['username'];
		}

			if ($_FILES['foto']['name']!="") {
				if (in_array($_FILES['foto']['type'],$type)) {
					$temp = explode(".", $_FILES['foto']['name']);
					$isi['foto'] = date('Hisdmy').'ADM.'.end($temp);
					move_uploaded_file($_FILES['foto']['tmp_name'],'../File_BMKG/Admin/'.$isi['foto']);
				}
			}
		echo $this->Pegawai_model->edit_akun($this->session->userdata('nia'),$isi);
	}

}
