<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	public $waktu=null;
	function __construct(){
		parent::__construct();		
		$this->load->model('informasi_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->waktu = date('Y-m-d H:i:s');
		$this->load->model('Pegawai_model');
		$this->Pegawai_model->set_akses($this->session->userdata('nia'));
		if($this->session->userdata('login') != "masuk"){
			redirect(base_url("Login"));
		}
		
	}

	public function pengumuman(){
		if ($this->session->userdata('umum')!='Ya') {
			$this->load->view('Umum');
			# code...
		}else{
			$waktu=date('Y-m');
			$page=1;
			if (isset($_GET['bulan'])) {
				# code...
				$waktu=$_GET['tahun'].'-'.$_GET['bulan'];
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			$data['pengumuman']=$this->informasi_model->pengumuman($waktu,$page);
			$data['tahun']=$this->informasi_model->tahun('pengumuman',date('Y',strtotime($waktu)));
			$data['bulan']=$this->informasi_model->bulan(date('m',strtotime($waktu)));
			$data['year']=date('Y',strtotime($waktu));
			$data['month']=date('m',strtotime($waktu));
			$this->load->view('Informasi/Pengumuman',$data);
		}
	}

	public function del_pengumuman(){
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			# code...
			$this->informasi_model->del_pengumuman($_POST['hapus'][$i]);
		}
	}

	public function edit_peng(){
			$tipe=array('application/pdf','application/PDF');
			$id=$_POST['id'];
			$isi['judul']=$_POST['judul'];
			$isi['isi'] = $_POST['teks'];
			if (in_array($_FILES['pdf']['type'], $tipe)) {
				$temp = explode(".", $_FILES['pdf']['name']);
				$isi['file'] = date('Hisdmy').'PGM.'.end($temp);
				move_uploaded_file($_FILES['pdf']['tmp_name'], '../File_BMKG/Pengumuman/'.$isi['file']);
			}
		echo $this->informasi_model->edit_pengumuman($id,$isi);
	}

	public function set_pengumuman(){
		$tipe=array('application/pdf','application/PDF');
		$judul=$_POST['judul'];
		$teks = $_POST['teks'];
		$nambar=null;
		if (in_array($_FILES['pdf']['type'], $tipe)) {
			$temp = explode(".", $_FILES['pdf']['name']);
			$nambar = date('Hisdmy').'PGM.'.end($temp);
			move_uploaded_file($_FILES['pdf']['tmp_name'], '../File_BMKG/Pengumuman/'.$nambar);
		}
		echo $this->informasi_model->set_pengumuman($judul,$teks,$nambar,$this->session->userdata('nama'),$this->waktu);
	}

	public function get_peng_id(){
		$data = $this->informasi_model->get_peng_id($_GET['id']);
		echo json_encode($data);
	}

	public function Berita(){
		if ($this->session->userdata('berita')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$this->load->view('Informasi/Berita');
		}
	}
//Berita
	public function setBerita(){
		$judul = $_POST['judul'];
		$isi = $_POST['berita'];
		$foto = count($_FILES['foto']['name']);

			# code...
			$id=$this->informasi_model->setBerita($judul,$isi,$this->session->userdata('nama'),$this->waktu);

			for ($i=0; $i < $foto; $i++) { 
				# code...
				//echo json_encode(getimagesize($_FILES['foto']['tmp_name'][$i]));
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['foto']['name'][$i]);
			  	$nambar = date('Hisdmy')."BRT".$i.".".end($temp);
			  	$tmp_name = $_FILES['foto']['tmp_name'][$i];
			  	$type = pathinfo($nambar,PATHINFO_EXTENSION);
			  	if (in_array($type, $tipe)) {
			  		# code...
			  		move_uploaded_file($tmp_name, '../File_BMKG/Berita/'.$nambar);
			  		$this->informasi_model->setFoto($nambar,$id);
			  	}
			  	
			}
		
		

			
		//echo json_encode($_FILES);
		redirect(site_url('Informasi/List_berita'));	
	}

	public function List_berita(){
		if ($this->session->userdata('berita')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$waktu = date('Y-m');
			$page=1;
			if (isset($_GET['bulan'])) {
				$waktu=$_GET['tahun'].'-'.$_GET['bulan'];
				# code...
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
				$waktu=$_GET['tahun'].'-'.$_GET['bulan'];
			}
			$data['berita'] = $this->informasi_model->getBerita($waktu,$page);
			$data['tahun']=$this->informasi_model->tahun('berita',date('Y',strtotime($waktu)));
			$data['bulan']=$this->informasi_model->bulan(date('m',strtotime($waktu)));
			$data['year']=date('Y',strtotime($waktu));
			$data['month']=date('m',strtotime($waktu));
			
			$this->load->view('Informasi/List_berita',$data);
		}
			
	}


	public function del_berita(){
		$count = count($_POST['hapus']);
		$s=null;
		for ($i=0; $i < $count; $i++) { 
			$this->informasi_model->del_berita($_POST['hapus'][$i]);
		}
		
	}

	public function get_beritaID(){
		$data = $this->informasi_model->getBeritaID($_GET['id']);

		echo json_encode($data);
	}

	public function baca_news(){
		$data=$this->informasi_model->baca_news($_GET['id']);
		echo	json_encode($data);
	}

	public function edit_berita(){
		$id=$_POST['id'];
		$judul=$_POST['judul'];
		$isi=$_POST['teks'];
		$foto = count($_FILES['foto']['name']);

		if (isset($_POST['hapus'])) {
			# code...
			for ($i=0; $i < count($_POST['hapus']); $i++) { 
				$this->informasi_model->del_foto($_POST['hapus'][$i]);
				# code...
			}
		}
		for ($i=0; $i < $foto; $i++) { 
			# code...
			$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
			$temp = explode(".", $_FILES['foto']['name'][$i]);
		  	$nambar = date('Hisdmy')."BRT".$i.".".end($temp);
		  	$tmp_name = $_FILES['foto']['tmp_name'][$i];
		  	$type = pathinfo($nambar,PATHINFO_EXTENSION);
		  	if (in_array($type, $tipe)) {
		  		# code...
		  		move_uploaded_file($tmp_name, '../File_BMKG/Berita/'.$nambar);
		  		$this->informasi_model->setFoto($nambar,$id);
		  	}
		}
		echo $this->informasi_model->edit_berita($id,$judul,$isi);
	}
//Artikel
	public function artikel(){
		if ($this->session->userdata('artikel')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$waktu=date('Y-m');
			if (isset($_GET['bulan'])) {
				$waktu=$_GET['tahun'].'-'.$_GET['bulan'];
				# code...
			}
			$data['artikel']=$this->informasi_model->get_artikel($waktu);
			$data['tahun']=$this->informasi_model->tahun('artikel',date('Y',strtotime($waktu)));
			$data['bulan']=$this->informasi_model->bulan(date('m',strtotime($waktu)));
			$this->load->view('Informasi/Artikel',$data);
		}
	}

	public function set_artikel(){
		$judul=$_POST['judul'];
		$teks=$_POST['berita'];
		$type=array('application/pdf','application/PDF');

		if (in_array($_FILES['pdf']['type'],$type)) {
				# code...
			$temp = explode(".", $_FILES['pdf']['name']);
			$nambar = date('Hisdmy')."ARK.".end($temp);
			move_uploaded_file($_FILES['pdf']['tmp_name'], '../File_BMKG/Artikel/'.$nambar);
			echo $this->informasi_model->set_artikel($judul, $teks, $nambar, $this->session->userdata('nama'), $this->waktu);
			# code...
		}
	}

	public function baca_artikel(){
		$data=$this->informasi_model->baca_artikel($_GET['id']);
		echo $data;
	}
	public function get_art(){
		$data = $this->informasi_model->get_art($_GET['id']);
		echo json_encode($data);
	}
	public function del_artikel(){
		for ($i=0; $i < count($_POST['hapus']); $i++) {
			$this->informasi_model->del_artikel($_POST['hapus'][$i]); 
			# code...
		}
	}

	public function edit_artikel(){
		$id=$_POST['id'];
		$judul=$_POST['judul'];
		$teks=$_POST['berita'];
		$isi=array('judul'=>$judul,'isi'=>$teks);
		$type=array('application/pdf','application/PDF');

		if (isset($_FILES['pdf']['name'])) {
			# code...
			if (in_array($_FILES['pdf']['type'], $type)) {
				$temp = explode(".", $_FILES['pdf']['name']);
				$nambar = date('Hisdmy')."ARK.".end($temp);
				move_uploaded_file($_FILES['pdf']['tmp_name'], '../File_BMKG/Artikel/'.$nambar);	
				# code...
				$isi['pdf']=$nambar;
			}
		}
		
		echo $this->informasi_model->edit_artikel($id,$isi);
	}
	
//Unit Pelayanan Teknis
	public function upt(){
		if ($this->session->userdata('kepegawaian')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['upt']=$this->informasi_model->get_UPT();
			$this->load->view('Informasi/UPT',$data);
		}
	}

	public function set_upt(){

		
			# code...
			$stasiun = $_POST['stasiun'];
			$alamat = $_POST['alamat'];
			$surel = $_POST['surel'];
			$telepon = $_POST['telepon'];
			$faksimili = $_POST['faksimili'];
			$kepala = $_POST['kepala'];
			$struktur=null;
			/*
			$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
			$type = pathinfo($_FILES['struktur']['name'],PATHINFO_EXTENSION);
			if (in_array($type,$tipe)) {
				$temp = explode(".", $_FILES['struktur']['name']);
				$struktur = date('Hisdmy')."UPT.".end($temp);
					move_uploaded_file($_FILES['struktur']['tmp_name'], '../File_BMKG/Profil/'.$struktur);
			}*/

			echo $this->informasi_model->set_UPT($stasiun,$alamat,$surel,$telepon,$faksimili,$this->session->userdata('nama'),$struktur,$kepala,$this->waktu);
		
}

	public function edit_upt(){
			$id=$_POST['id'];
			# code...
			$stasiun = $_POST['stasiun'];
			$alamat = $_POST['alamat'];
			$surel = $_POST['surel'];
			$telepon = $_POST['telepon'];
			$faksimili = $_POST['faksimili'];
			$kepala = $_POST['kepala'];
			$isi=array('kantor'=>$stasiun,'Alamat'=>$alamat,'email'=>$surel,'telepon'=>$telepon,'faksimili'=>$faksimili,'kepala'=>$kepala);

			$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
			$type = pathinfo($_FILES['struktur']['name'],PATHINFO_EXTENSION);
			if (in_array($type,$tipe)) {
				$temp = explode(".", $_FILES['struktur']['name']);
				$nambar = date('Hisdmy')."UPT.".end($temp);
				move_uploaded_file($_FILES['struktur']['tmp_name'], '../File_BMKG/Profil/'.$nambar);
				$isi['struktur']=$nambar;
			}

		echo $this->informasi_model->edit_UPT($id,$isi);
	}
		
	public function get_uptID(){
		$id=$_GET['id'];

		$data=$this->informasi_model->get_uptID($id);

		echo json_encode($data);
	}

	public function hapus_upt(){
		$length = count($_POST['hapus']);
			# code...
		for ($i=0; $i < $length; $i++) { 
			$data=$_POST['hapus'][$i];
			$this->informasi_model->del_upt($data);
		}
	}

	public function sdm(){
		if ($this->session->userdata('kepegawaian')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['sdm']=$this->informasi_model->get_SDM();
			$this->load->view('Informasi/SDM',$data);
		}
			
	}

	public function set_SDM(){

		echo $this->informasi_model->set_SDM($_POST['L_val'],$_POST['P_val'],$this->session->userdata('nama'),$this->waktu);
	}



//pejabat
	public function pejabat(){
		if ($this->session->userdata('kepegawaian')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['pejabat'] = $this->informasi_model->get_pejabat();
			$this->load->view('Informasi/Pejabat',$data);
		}
			
	}


	public function del_pejabat(){
		$length = count($_POST['nip']);
			# code...
		for ($i=0; $i < $length; $i++) { 
			$data=$_POST['nip'][$i];
			$this->informasi_model->del_pjb($data);
		}
	}

	public function get_pejabatID(){
		$id=$_GET['id'];
		$data=$this->informasi_model->get_pejabatID($id);

		echo json_encode($data);
	}

	public function set_pejabat(){
		$nama=$_POST['nama'];
		$jabatan=$_POST['jabatan'];
		$kategori=$_POST['kategori'];

		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');

		$temp = explode(".", $_FILES['foto']['name']);
		$nambar = date('Hisdmy')."PJB.".end($temp);

		$tmp_name = $_FILES['foto']['tmp_name'];
		$type = pathinfo($nambar,PATHINFO_EXTENSION);

		if (in_array($type, $tipe)) {
			move_uploaded_file($tmp_name, '../File_BMKG/Profil/Pegawai/'.$nambar);
			echo $this->informasi_model->set_pejabat($nama,$jabatan,$kategori,$nambar, $this->waktu);
			}
			
		//header('Location:'.site_url('Informasi/pejabat'));
	}

	public  function edit_pejabat(){
		$nama=$_POST['nama'];
		$jabatan=$_POST['jabatan'];
		$kategori=$_POST['kategori'];
		$id=$_POST['id'];
		$ft=$_POST['foto_form'];
		$isi=array('nama'=>$nama,'jabatan'=>$jabatan, 'kategori'=>$kategori);

		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
		$nambar = $_FILES['foto']['name'];
		$tmp_name = $_FILES['foto']['tmp_name'];
		$type = pathinfo($nambar,PATHINFO_EXTENSION);
		if (in_array($type, $tipe)) {
			$temp = explode(".", $nambar);
			$nambar = date('Hisdmy')."PJB.".end($temp);
			unlink('../File_BMKG/Profil/Pegawai/'.$ft);
			move_uploaded_file($tmp_name, '../File_BMKG/Profil/Pegawai/'.$nambar);
			$isi['gambar']=$nambar;
					
		}
		echo $this->informasi_model->edit_pejabat($id,$isi);

	}

	public function sejarah(){
		if ($this->session->userdata('profil')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['isi']=$this->informasi_model->profil('Sejarah');
			$this->load->view('Informasi/Sejarah',$data);
		}
			
	}

	public function visi_misi(){
		if ($this->session->userdata('profil')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['isi']=$this->informasi_model->profil('Visi');
			$this->load->view('Informasi/visi_misi',$data);
		}
			
	}

	public function tugas_fungsi(){
		if ($this->session->userdata('profil')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$data['isi']=$this->informasi_model->profil('Tugas');
			$this->load->view('Informasi/tugas_fungsi',$data);
		}
			
	}

	public function struktur(){
		if ($this->session->userdata('profil')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$this->load->view('Informasi/struktur');
		}
		
	}

	public function set_profil(){
		$tipe = array('pdf','PDF');
		$jenis=null;
		$nambar=null;
		$tmp_name=null;
		$url=null;

		if (isset($_FILES['sejarah']['name'])) {
			$jenis='Sejarah';
			$url='sejarah';
			$nambar = $_FILES['sejarah']['name'];
			$tmp_name = $_FILES['sejarah']['tmp_name'];
			# code...
		}elseif (isset($_FILES['tugas_fungsi']['name'])) {
			$jenis='Tugas';
			$url='tugas_fungsi';
			$nambar = $_FILES['tugas_fungsi']['name'];
			$tmp_name = $_FILES['tugas_fungsi']['tmp_name'];
			# code...
		}elseif (isset($_FILES['visi_misi']['name'])) {
			$jenis='Visi';
			$url='visi_misi';
			$nambar = $_FILES['visi_misi']['name'];
			$tmp_name = $_FILES['visi_misi']['tmp_name'];
			# code...
		}
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
				  	if (move_uploaded_file($tmp_name, '../File_BMKG/Profil/'.$nambar)) {
				  		$this->informasi_model->set_profil($nambar,$jenis,$this->session->userdata('nama'),$this->waktu);
					}
				}
				
				redirect(site_url('Informasi/'.$url));
				
	}

	public function set_struktur(){
		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');	
		$nambar = $_FILES['foto']['name'];
				$tmp_name = $_FILES['foto']['tmp_name'];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
						  # code...
						$temp = explode(".", $_FILES['foto']['name']);
						$nambar = date('Hisdmy')."ARK.".end($temp);
				  	if (move_uploaded_file($tmp_name, '../File_BMKG/Profil/Pegawai/'.$nambar)) {
				  		unlink('../File_BMKG/Profil/Pegawai/'.$ft);
				  		$isi=array('nama'=>$nama,'jabatan'=>$jabatan,'gambar'=>$nambar);
					}
				}

	}

	public function del_struktur(){

	}

	public function baca_gambar(){
		$data=$this->informasi_model->baca_gambar($_GET['id'],$_GET['tp']);
		echo $data;
	}
}
