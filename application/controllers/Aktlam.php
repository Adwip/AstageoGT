<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktlam extends CI_Controller {

	public $waktu=null;
	function __construct(){
		parent::__construct();		
		$this->load->model('Gempa_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->waktu = date('Y-m-d H:i:s');
		$this->load->model('Pegawai_model');
		$this->Pegawai_model->set_akses($this->session->userdata('nia'));
		$this->load->library('Pemisah_angka');
		if($this->session->userdata('login') != "masuk"){
			redirect(base_url("Login"));
		}
	}


	public function gempa(){
		if ($this->session->userdata('gempa')!='Ya') {
			$this->load->view('Umum');
		}else{
			$status='*';
			$page=1;
			if (isset($_GET['status'])) {
				$status= $_GET['status'];
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			$data['gempa']=$this->Gempa_model->get_gempa($status,$page);
			$this->load->view('Aktlam/gempa',$data);
		}
		
	}

	public function set_gempa(){

		$tipe = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$wilayah =$_POST['wilayah'];
		$jarak =$_POST['jarak'];
		$mata_angin =$_POST['mata-angin'];
		$magnitudo =$_POST['magnitudo'];
		$status =$_POST['status'];
		$tanggal =$_POST['tanggal'];
		$waktu =$_POST['waktu'];
		$kedalaman =$_POST['kedalaman'];
		$lokasi =$_POST['lokasi'];
		$lintang =$_POST['lintang'];
		$bujur =$_POST['bujur'];
		$arah_lintang =$_POST['arah_lintang'];
		$arah_bujur =$_POST['arah_bujur'];
		$potensi =$_POST['potensi'];
		$ket =$_POST['keterangan'];
		$mmi =$_POST['mmi'];
		$nambar=null;

		if (in_array($_FILES['gambar']['type'], $tipe)) {
			$temp = explode(".", $_FILES['gambar']['name']);
			$nambar = date('Hisdmy')."GMP.".end($temp);
			move_uploaded_file($_FILES['gambar']['tmp_name'], '../File_BMKG/Gempa/'.$nambar);
				# code...
		}
			# code.


		echo $this->Gempa_model->set_gempa($wilayah, date('Y-m-d H:i:s',strtotime($tanggal.' '.$waktu)), $lintang, $bujur, $magnitudo, $kedalaman, $status, $lokasi, $jarak, $mata_angin,  $potensi, $nambar, $ket, $mmi, $arah_bujur, $arah_lintang, 'Margianto', $this->waktu);
	}

	public function del_gempa(){
		$hasil = null;
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Gempa_model->del_gempa($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function get_gempa_ID(){
		$data=$this->Gempa_model->get_gempa_ID($_GET['id']);

		echo json_encode($data);
	}

	public function get_gempa_v(){
		$data=$this->Gempa_model->get_gempa_v($_GET['id']);

		echo json_encode($data);
	}

	public function edit_gempa(){
		$tipe = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$id=$_POST['id'];
		$isi['wilayah']=$_POST['wilayah'];
		$isi['waktu_terjadi']= date('Y-m-d H:i:s',strtotime( $_POST['tanggal'].' '.$_POST['waktu']));
		$isi['status_rasa']=$_POST['status'];
		$isi['lokasi']=$_POST['lokasi'];
		$isi['jarak']=$_POST['jarak'];
		$isi['arah']=$_POST['mata-angin'];
		$isi['magnitudo']=$_POST['magnitudo'];
		$isi['kedalaman']=$_POST['kedalaman'];
		$isi['lintang']=$_POST['lintang'];
		$isi['bujur']=$_POST['bujur'];
		$isi['arah_lintang']=$_POST['arah_lintang'];
		$isi['arah_bujur']=$_POST['arah_bujur'];
		$isi['potensi']=$_POST['potensi'];
		$isi['keterangan']=$_POST['keterangan'];
		$isi['skala_mmi']=$_POST['mmi'];

		if ($_FILES['gambar']['name']!="") {
			if (in_array($_FILES['gambar']['type'],$tipe)) {
				$temp = explode(".", $_FILES['gambar']['name']);
				$isi['gambar'] = date('Hisdmy')."GMP.".end($temp);
				move_uploaded_file($_FILES['gambar']['tmp_name'], '../File_BMKG/Gempa/'.$isi['gambar']);
			}
		}
		//echo json_encode($_SERVER);
		echo $this->Gempa_model->edit_gempa($id,$isi);
	}
	/*
	public function tsunami(){
		$tahun = '*';
		if (isset($_GET['tahun'])) {
			$tahun=$_GET['tahun'];
			# code...
		}

		$data['tsunami']=$this->Gempa_model->get_tsunami($tahun);
		$this->load->view('Aktlam/tsunami',$data);
	}

	public function set_tsunami(){
		$tipe = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$wilayah =$_POST['wilayah'];
		$jarak =$_POST['jarak'];
		$mata_angin =$_POST['mata-angin'];
		$magnitudo =$_POST['magnitudo'];
		$tanggal =$_POST['tanggal'];
		$waktu =$_POST['waktu'];
		$kedalaman =$_POST['kedalaman'];
		$lintang =$_POST['lintang'];
		$bujur =$_POST['bujur'];
		$arah_lintang =$_POST['arah_lintang'];
		$arah_bujur =$_POST['arah_bujur'];
		$nambar=null;
		
		if (in_array($_FILES['gambar']['type'], $tipe)) {
			$temp = explode(".", $_FILES['gambar']['name']);
			$nambar = date('Hisdmy')."PJB.".end($temp);
			move_uploaded_file($_FILES['gambar']['tmp_name'], '../File_BMKG/Gempa/'.date('dmyHi').$nambar);
		}

		$cek =$this->Gempa_model->set_tsunami($wilayah, date('Y-m-d H:i:s',strtotime($tanggal.' '.$waktu)), $lintang, $bujur, $magnitudo, $kedalaman, $jarak, $mata_angin, $nambar, $arah_bujur, $arah_lintang, 'Margianto', $this->waktu);

		redirect(site_url('Aktlam/tsunami'));
	}

	public function del_tsunami(){
		$count=count($_POST['hapus']);
		for ($i=0; $i < $count; $i++) { 
			# code...
			$this->Gempa_model->del_tsunami($_POST['hapus'][$i]);
		}
		header('Location:'.site_url('Aktlam/tsunami'));
	}
	#non aktif
	public function terbit_terbenam_matahari2(){
		if ($this->session->userdata('ttm_petir')!='Ya') {
			$this->load->view('Umum');
		}else{
			$tanggal=date('Y-m-d');
			if (isset($_GET['waktu'])) {
				$tanggal = strtr($_GET['waktu'],'/','-');
				$tanggal=date('Y-m-d',strtotime($tanggal));
				# code...
			}
			//echo($tanggal);
			$data['tanggal']=date('d-m-Y',strtotime($tanggal));
			$data['ttm']=$this->Gempa_model->get_ttm($tanggal);
			$this->load->view('Aktlam/ttm2',$data);
		}
			
	}

	public function set_ttm2(){
		$wilayah = $_POST['wilayah'];
		$tanggal = strtr($_POST['tanggal'],'/','-');;
		$fajar = $_POST['waktu_fajar'];
		$terbit = $_POST['waktu_terbit'];
		$azter = $_POST['azimuth_terbit'];
		$transit = $_POST['waktu_transit'];
		$tingtran = $_POST['tinggi_transit'];
		$terbenam = $_POST['waktu_terbenam'];
		$azterb = $_POST['azimuth_terbenam'];
		$senja = $_POST['waktu_senja'];

		$this->Gempa_model->set_TerbitTM($wilayah,date('Y-m-d',strtotime($tanggal)),$fajar,$terbit,$azter,$transit,$tingtran,$terbenam,$azterb,$senja,'Margianto',$this->waktu);
	}
	*/
	public function terbit_terbenam_matahari(){
		if ($this->session->userdata('ttm_petir')!='Ya') {
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			$bulan=date('m');

			if (isset($_GET['tahun'])) {
				$tahun = $_GET['tahun'];
				$bulan=$_GET['bulan'];
				# code...
			}
			//echo($tanggal);
			$data['tahun']=$this->Gempa_model->tahun('ttm',$tahun,'tahun');
			$data['bulan']=$this->Gempa_model->bulan($bulan);
			$data['ttm']=$this->Gempa_model->get_ttm($bulan,$tahun);
			$this->load->view('Aktlam/ttm2',$data);
		}
			
	}
	
	public function set_ttm(){
		$kota=$_POST['wilayah'];
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$tipe=array('application/pdf','application/PDF');
		if (in_array($_FILES['pdf']['type'], $tipe)) {
			# code...
			$temp = explode(".", $_FILES['pdf']['name']);
			$nambar = date('Hisdmy')."TTM.".end($temp);
			move_uploaded_file($_FILES['pdf']['tmp_name'], '../File_BMKG/TTM/'.$nambar);
			echo $this->Gempa_model->set_ttm($kota,$nambar,$bulan,$tahun,$this->session->userdata('nama'),$this->waktu);
		}
	}

	public function del_ttm(){
		$hasil = null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Gempa_model->del_ttm($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function peta_sambaran_petir(){
		if ($this->session->userdata('ttm_petir')!='Ya') {
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			if (isset($_GET['tahun'])) {
				$tahun=$_GET['tahun'];
			}
			$data['sambaran']=$this->Gempa_model->get_petir($tahun);
			$data['tahun']=$this->Gempa_model->tahun('sambaran_petir',$tahun,'tahun');
			$this->load->view('Aktlam/sambaran_petir',$data);	
		}
		
	}

	public function set_petir(){

		$tipe = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');

		$judul = $_POST['judul'];
		$ket= $_POST['keterangan'];
		$bulan= $_POST['bulan'];
		$tahun= $_POST['tahun'];
		$nambar=null;
		$petir=array($_FILES['rapat'],$_FILES['sambar']);
		$tp=array('RPT','SBR');
		$cek=true;
		for ($i=0; $i < 2; $i++) { 
			if (!in_array($petir[$i]['type'],$tipe)) {
				$cek=false;
			}
		}
		if ($cek) {
			for ($i=0; $i < 2; $i++) {
				$temp = explode(".", $petir[$i]['name']);
				$nambar[$i] = date('Hisdmy').$i.$tp[$i].".".end($temp);
				move_uploaded_file($petir[$i]['tmp_name'],'../File_BMKG/Sam_petir/'.$nambar[$i]);
			}
			echo $this->Gempa_model->set_petir($judul, $ket, $bulan, $tahun, $nambar[0],$nambar[1],$this->session->userdata('nama'),$this->waktu);
		}
	}

	public function del_petir(){
		$hasil=null;
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Gempa_model->del_petir($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function get_ptr_edit(){
		$data = $this->Gempa_model->get_ptr_edit($_GET['id']);

		echo $data;
	}
//bongkar
	public function edit_petir(){
		$tipe = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$isi['judul']=$_POST['judul'];
		$tp=array('RPT','SBR');
		$tabel=array('kerapatan','sambaran');
		$isi['keterangan']=$_POST['keterangan'];
		$file = array($_FILES['rapat'],$_FILES['sambar'] );
		for ($i=0; $i < 2; $i++) { 
			if ($file[$i]['name']!=""&&in_array($file[$i]['type'],$tipe)) {
				$temp = explode(".", $file[$i]['name']);
				$isi[$tabel[$i]] = date('Hisdmy').$i.$tp[$i].".".end($temp);
				move_uploaded_file($file[$i]['tmp_name'],'../File_BMKG/Sam_petir/'.$isi[$tabel[$i]]);
			}
		}

		echo $this->Gempa_model->edit_petir($_POST['bulan'],$_POST['tahun'],$isi);
		
	}


}
