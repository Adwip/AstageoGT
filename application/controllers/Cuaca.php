<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuaca extends CI_Controller {

	public $v=null;
	
	public $waktu=null;
	function __construct(){
		parent::__construct();		
		$this->load->model('Cuaca_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->waktu = date('Y-m-d H:i:s');
		$this->load->model('Pegawai_model');
		$this->Pegawai_model->set_akses($this->session->userdata('nia'));
		$this->load->library('Pemisah_angka');
		if($this->session->userdata('login') != "masuk"){
			redirect(base_url("Login"));
		}
	}

	

	public function prakiraan(){
		if ($this->session->userdata('cuaca')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$waktu = date('Y-m-d');
			if (isset($_GET['waktu'])) {
				$waktu = strtr($_GET['waktu'],'/','-');
				$waktu=date('Y-m-d',strtotime($waktu));
				# code...
			}
			$data['cuaca']=$this->Cuaca_model->get_cuaca($waktu);
			$data['tanggal']= date('d-m-Y',strtotime($waktu));
			
			//echo json_encode($data1);
			$this->load->view('Cuaca/cuaca',$data);
		}	
	}

	public function get_cuaca_ID(){
		$id=$_GET['id'];
		$data=$this->Cuaca_model->get_cuaca_ID($id);

		echo json_encode($data);
		# code...
	}

	public function get_view_cuaca(){
		$id=$_GET['id'];
		$data=$this->Cuaca_model->get_view_cuaca($id);

		echo json_encode($data);
	}

	public function del_cuaca(){
		$hasil=null;
			# code...
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_cuaca($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function set_cuaca(){
		$wilayah = $_POST['wilayah'];
		$tanggal = strtr($_POST['tanggal'],'/','-');
		$tanggal= date('Y-m-d',strtotime($_POST['tanggal'])); //date('Y-m-d',strtotime($tanggal));
		$tabel = $_POST['waktu'];
		$cuaca = $_POST['cuaca'];
		$arah = $_POST['mata-angin'];
		$suhu_min = $_POST['suhu_minimal'];
		$suhu_maks = $_POST['suhu_maksimal'];
		$kelembapan_maks = $_POST['lembap_maks'];
		$kelembapan_min = $_POST['lembap_min'];
		$ids=array('Pagi'=>'CHP','Siang'=>'CHS','Malam'=>'CHM','Dinihari'=>'CHD');
		//echo $tanggal;
		echo $this->Cuaca_model->set_cuaca($wilayah, $tanggal, $tabel, $cuaca, $arah, $suhu_min, $suhu_maks, $kelembapan_maks, $kelembapan_min,$this->session->userdata('nama'),$this->waktu,$ids[$tabel]);
		
	}

	public function edit_cuaca(){
		$id=$_POST['id'];
		$cuaca = $_POST['cuaca'];
		$arah = $_POST['mata-angin'];
		$suhu_min = $_POST['suhu_minimal'];
		$suhu_maks = $_POST['suhu_maksimal'];
		$kelembapan_maks = $_POST['lembap_maks'];
		$kelembapan_min = $_POST['lembap_min'];
		$tabel=array('Pagi'=>'cuaca_harian_pagi','Siang'=>'cuaca_harian_siang','Malam'=>'cuaca_harian_malam','Dinihari'=>'cuaca_harian_dinihari');
		//echo $tanggal;
		echo $this->Cuaca_model->edit_cuaca($id,$tabel[$_POST['waktu']], $cuaca, $arah, $suhu_min, $suhu_maks, $kelembapan_maks, $kelembapan_min);
	}


	public function radar(){
		if ($this->session->userdata('cuaca')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$waktu = date('Y-m');
			if (isset($_GET['bulan'])) {
				$waktu=date('Y-m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
				# code...
			}
			
			$data['ctr']=$this->Cuaca_model->get_radar($waktu);
			$data['tahun']=$this->Cuaca_model->tahun('citra_radar',date('Y',strtotime($waktu)));
			$data['bulan']=$this->Cuaca_model->bulan(date('m',strtotime($waktu)));
			$this->load->view('Cuaca/citra_radar',$data);
		}
			
		
	}

	public function get_ctr_id(){
		$data=$this->Cuaca_model->get_ctr_id($_GET['id']);

		echo $data;

	}

	public function display_citra(){
		$data=$this->Cuaca_model->display_citra($_GET['id']);
		echo $data;
	}

	public function baca_gambar(){
		$data=$this->Cuaca_model->baca_gambar($_GET['id'],$_GET['tp']);
		echo $data;
	}

	public function edit_ctr(){
		$id=$_POST['id'];
		$cek=true;
		if ($_FILES['radar']['name']!="") {
			# code...
			for ($i=0; $i < count($_FILES['radar']['name']); $i++) {
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['radar']['name'][$i]);
			  	$nambar = date('Hisdmy')."CTR".$i.".".end($temp);
			  	$tmp_name = $_FILES['radar']['tmp_name'][$i];
			  	$type = pathinfo($nambar,PATHINFO_EXTENSION);
			  	if (in_array($type, $tipe)) {
			  		if (move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Citra_radar/'.$nambar)) {
			  			$this->Cuaca_model->set_foto($nambar,$id);
			  		}
			  	}
			}
		}	

		if (isset($_POST['hapus'])) {
			# code...
			for ($i=0; $i < count($_POST['hapus']); $i++) { 
				# code...
				$this->Cuaca_model->del_foto($_POST['hapus'][$i]);
				if (file_exists('../File_BMKG/Iklim/Citra_radar/'.$_POST['hapus'][$i])) {
					unlink('../File_BMKG/Iklim/Citra_radar/'.$_POST['hapus'][$i]);
					# code...
				}
			}
		}

		echo 2;

	}

	public function set_ctr(){
		$id = $this->Cuaca_model->set_ctr($this->session->userdata('nama'),$this->waktu);

		$count =count($_FILES['radar']['name']);
		if ($id!=null) {
			# code...
			for ($i=0; $i < $count; $i++) { 
				# code...
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['radar']['name'][$i]);
				$nambar = date('Hisdmy')."CTR".$i.".".end($temp);
				$tmp_name = $_FILES['radar']['tmp_name'][$i];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				$size=getimagesize($_FILES['radar']['tmp_name'][$i]);
				if (in_array($type, $tipe)&&$size[1]>=500) {
					if (move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Citra_radar/'.$nambar)) {
						$this->Cuaca_model->set_foto($nambar,$id);
							# code...
					}
				}
			}
			echo true;
		}
	}

	public function del_citra(){
		$hasil=null;
		for ($i=0; $i < count($_POST['hapus']); $i++) {
			$hasil+=$this->Cuaca_model->del_radar($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function cuaca_mingguan(){
		if ($this->session->userdata('cuaca')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tanggal = date('Y-m');
				if ((isset($_GET['bulan'])&&(isset($_GET['tahun'])))) {
					# code...
					$tanggal = date('Y-m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
				}

			$data['cuming']=$this->Cuaca_model->getCuming($tanggal);
			$data['tahun']=$this->Cuaca_model->tahun('cuaca_mingguan',date('Y',strtotime($tanggal)));
			$data['bulan']=$this->Cuaca_model->bulan(date('m',strtotime($tanggal)));
			$this->load->view('Cuaca/prospek_mingguan',$data);
		}
			

			//echo  date('d').date('-m-Y',strtotime('2019-04'));
	}

	public function del_cuming(){
		$hasil=null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_cuming($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function set_cuming(){

		$tanggal_mulai=strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= null;
		
		if ($_POST['tanggal_akhir']==''||$_POST['tanggal_akhir']==' ') {
			# code...
			$tanggal_akhir= date('d-m-Y',strtotime($tanggal_mulai.'+7 days'));	
		}else{
			$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');
		}

		$tipe = array('pdf','PDF');
		$temp = explode(".", $_FILES['pdf']['name']);
		$nambar = date('Hisdmy')."CMG.".end($temp);
		$tmp_name = $_FILES['pdf']['tmp_name'];
		$type = pathinfo($nambar,PATHINFO_EXTENSION);
		if (in_array($type, $tipe)) {
			move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Cuaca_mingguan/'.$nambar);
			echo $this->Cuaca_model->set_cuming(date('Y-m-d',strtotime($tanggal_mulai)),date('Y-m-d',strtotime($tanggal_akhir)),$nambar,$this->session->userdata('nama'),$this->waktu);
		}
	}

	public function edit_cuming(){
		$tipe = array('pdf','PDF');
		$id= $_POST['id'];
		$tanggal_mulai=strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');
		
		$temp = explode(".", $_FILES['pdf']['name']);
		$nambar = date('Hisdmy')."CMG.".end($temp);
		$tmp_name = $_FILES['pdf']['tmp_name'];
		$type = pathinfo($nambar,PATHINFO_EXTENSION);
		if (in_array($type, $tipe)) {
		# code...
			move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Cuaca_mingguan/'.$nambar);
			echo $this->Cuaca_model->edit_cuming($id,date('Y-m-d',strtotime($tanggal_mulai)), date('Y-m-d',strtotime($tanggal_akhir)), $nambar);
			
		}else{
			echo $this->Cuaca_model->edit_cuming($id,date('Y-m-d',strtotime($tanggal_mulai)), date('Y-m-d',strtotime($tanggal_akhir)));
		}
	}
	public function get_cuming_id(){
		$data=$this->Cuaca_model->get_cuming_id($_GET['id']);
		echo json_encode($data);
	}


	public function prakiraan_musim(){
		if ($this->session->userdata('prak_musim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			$page=1;
			if (isset($_GET['tahun'])) {
				# code...
				$tahun=$_GET['tahun'];
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			$data['musim'] = $this->Cuaca_model->getPrak_musim($tahun,$page);
			$data['tahun']=$this->Cuaca_model->tahun('musim',$tahun);
			$data['year']=$tahun;
			$this->load->view('Cuaca/prak_musim',$data);	
		}
	}

	public function setPrak_musim(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$tmp_gambar=null;
		$tmp_pdf=null;
		$gbr1=null;
		$pdf1=null;
		$cek=TRUE;
		$file=$_FILES['dok'];
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/';
		$ok=null;
		for ($i=0; $i < 2; $i++) { 
			if (in_array($file['type'][$i],$gbr)) {
				$tmp_gambar=$file['tmp_name'][$i];
				$temp = explode(".", $file['name'][$i]);
				$gbr1 = date('Hisdmy').'PSMG.'.end($temp);
				$ok.='G';
			}else if (in_array($file['type'][$i], $pdf)) {

				$tmp_pdf=$file['tmp_name'][$i];
				$temp = explode(".", $file['name'][$i]);
				$pdf1 = date('Hisdmy').'PSMD.'.end($temp);
				$ok.='D';
			}else{
				$cek=FALSE;
			}
		}

		if ($cek&&($ok=='GD'||$ok=='DG')) {
			move_uploaded_file($tmp_pdf, $path.'Dokumen/'.$pdf1)&&move_uploaded_file($tmp_gambar, $path.'Gambar/'.$gbr1);
			echo $this->Cuaca_model->setPrak_musim($_POST['judul'], $_POST['teks'], $gbr1, $pdf1,$this->session->userdata('nama'), $this->waktu);
		}

	}

	public function set_musim_r(){
		$id=$_POST['id'];

		$this->Cuaca_model->set_pilih_musim($id);
	}

	public function del_prakmus(){
		$hasil = null;
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			# code...
			$hasil+=$this->Cuaca_model->del_prakmus($_POST['hapus'][$i]);
		}
		echo $hasil;
	}
	public function edit_musim(){
		$id=$_POST['id'];
		$judul= $_POST['judul'];
		$teks = $_POST['teks'];
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/';
		$isi=array('judul'=>$judul,'teks'=>$teks);

			for ($i=0; $i < count($_FILES['dok']['name']); $i++) {
				if (in_array($_FILES['dok']['type'][$i], $gbr)) {
					$this->Cuaca_model->del_file_musim($id,'Gambar');
					$temp = explode(".", $_FILES['dok']['name'][$i]);
					$nambar = date('Hisdmy').'PSMG.'.end($temp);
					move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Gambar/'.$nambar);
				 	$isi['gambar']=$nambar;
				 }elseif (in_array($_FILES['dok']['type'][$i], $pdf)) {
				 	# code...
				 	$this->Cuaca_model->del_file_musim($id,'Dokumen');
					 $temp = explode(".", $_FILES['dok']['name'][$i]);
					 $nambar = date('Hisdmy').'PSMD.'.end($temp);
					 move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Dokumen/'.$nambar);
					$isi['pdf']=$nambar;
				 }
				# code...
			}

		echo $this->Cuaca_model->edit_musim($id,$isi);
	}

	public function get_musim_id(){
		$data = $this->Cuaca_model->get_musim_id($_GET['id']);

		echo json_encode($data);
	}

	public function get_musim_r(){
		$data=$this->Cuaca_model->get_musim_r($_GET['id']);
		echo $data;
	}

	public function prak_hujan_bulanan(){
		if ($this->session->userdata('prak_musim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			if (isset($_GET['tahun'])) {
				# code...
				$tahun=$_GET['tahun'];
			}
			$data['hujan']=$this->Cuaca_model->get_hujan_bulanan($tahun);
			$data['tahun']=$this->Cuaca_model->tahun('hujan_bulanan',$tahun);
			$this->load->view('Cuaca/hujan_bulanan',$data);
		}
	}

	public function set_hujan_bulanan(){
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];

		$curah=$_FILES['curah_hujan'];
		$sifat =$_FILES['sifat_hujan'];
		$path ='../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/';
		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');

		$type1 = pathinfo($curah['name'],PATHINFO_EXTENSION);
		$type2 = pathinfo($sifat['name'],PATHINFO_EXTENSION);

		if (in_array($type1, $tipe)&&in_array($type2, $tipe)&&$curah['name']!=$sifat['name']) {
				  # code...
			$temp = explode(".", $curah['name']);
			$nambar1 = date('Hisdmy').'CRH.'.end($temp);
			move_uploaded_file($curah['tmp_name'], $path.$nambar1);
			$temp = explode(".", $sifat['name']);
			$nambar2 = date('Hisdmy').'SFH.'.end($temp);
		  	move_uploaded_file($sifat['tmp_name'], $path.$nambar2);
		  echo	$this->Cuaca_model->set_hujan_bulanan($bulan,$tahun,$nambar1,$nambar2,$this->session->userdata('nama'),$this->waktu);
		}
	}

	public function edit_hbl(){
		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');

		if ($_FILES['sifat']['name']!="") {
			$type = pathinfo($_FILES['sifat']['name'],PATHINFO_EXTENSION);
			if (in_array($type,$tipe)) {
				$temp = explode(".", $_FILES['sifat']['name']);
				$isi['sifat_hujan'] = date('Hisdmy').'SFH.'.end($temp);
				move_uploaded_file($_FILES['sifat']['tmp_name'],'../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$isi['sifat_hujan']);
			}
		}
		if ($_FILES['curah']['name']!="") {
			$type = pathinfo($_FILES['curah']['name'],PATHINFO_EXTENSION);
			if (in_array($type,$tipe)) {
				$temp = explode(".", $_FILES['curah']['name']);
				$isi['curah_hujan'] = date('Hisdmy').'CRH.'.end($temp);
				move_uploaded_file($_FILES['curah']['tmp_name'],'../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$isi['curah_hujan']);
			}
		}
		echo $this->Cuaca_model->edit_hbl($_POST['id'],$isi);
	}

	public function get_hbl_id(){
		$data=$this->Cuaca_model->get_hbl_id($_GET['id']);
		echo $data;
	}

	public function del_hbl(){
		$hasil=null; 

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_hbl($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function dinamika_atmosfer(){
		if ($this->session->userdata('analis_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tanggal = date('Y-m');
			if (isset($_GET['bulan'])&&isset($_GET['tahun'])) {
				# code...
				$tanggal = date('Y-m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
			}

			$data['dinat'] = $this->Cuaca_model->getDinat($tanggal);
			$data['tahun']=$this->Cuaca_model->tahun('dinamika_atmosfer',date('Y',strtotime($tanggal)));
			$data['bulan']=$this->Cuaca_model->bulan(date('m',strtotime($tanggal)));
			//echo $tanggal;
			$this->load->view('Cuaca/dinat',$data);
		}
			
	}

	public function get_dinat_r(){
		$data=$this->Cuaca_model->get_dinat_r($_GET['id']);
		echo $data;
	}

	public function setDinat(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$tmp_gambar=null;
		$tmp_pdf=null;
		$gbr1=null;
		$pdf1=null;
		$cek=TRUE;
		$judul=$_POST['judul'];
		$isi=$_POST['teks'];
		$file=$_FILES['dok'];
		$path='../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/';
		$ok=null;
		$tanggal_mulai=strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');
		
		if ($_POST['tanggal_akhir']=='') {
			# code...
			$tanggal_akhir= date('d-m-Y',strtotime($tanggal_mulai.'+10 days'));	
			
		}
		for ($i=0; $i < 2; $i++) { 
			if (in_array($file['type'][$i],$gbr)) {
				$temp = explode(".", $file['name'][$i]);
				$gbr1 = date('Hisdmy').'DNTG.'.end($temp);
				$tmp_gambar=$file['tmp_name'][$i];
				$ok.='G';
			}else if (in_array($file['type'][$i], $pdf)) {
				$temp = explode(".", $file['name'][$i]);
				$pdf1 = date('Hisdmy').'DNTD.'.end($temp);
				$tmp_pdf=$file['tmp_name'][$i];
				$ok.='D';
			}else{
				$cek=FALSE;
			}
		}
		if ($cek&&($ok=='GD'||$ok=='DG')) {
			move_uploaded_file($tmp_pdf, $path.'Dokumen/'.$pdf1);
			move_uploaded_file($tmp_gambar, $path.'Gambar/'.$gbr1);
			echo $this->Cuaca_model->setDinat($judul, $isi, $gbr1, $pdf1, $this->session->userdata('nama'), $this->waktu,$tanggal_mulai, $tanggal_akhir);
		}
	}

	public function del_dinat(){
		$hasil = null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_dinat($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function get_dinat_id(){
		$data=$this->Cuaca_model->get_dinat_id($_GET['id']);
		echo json_encode($data);
	}

	public function editDinat(){
		$id=$_POST['id'];
		$judul= $_POST['judul'];
		$teks = $_POST['teks'];
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$path='../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/';
		$tanggal_mulai = strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');

		$tanggal_mulai=date('Y-m-d',strtotime($tanggal_mulai));
		$tanggal_akhir=date('Y-m-d',strtotime($tanggal_akhir));

		$isi=array('judul'=>$judul,'teks'=>$teks,'tanggal_mulai'=>$tanggal_mulai,'tanggal_akhir'=>$tanggal_akhir);
			for ($i=0; $i < count($_FILES['dok']['name']); $i++) {
				if (in_array($_FILES['dok']['type'][$i], $gbr)) {
					$this->Cuaca_model->del_file_dinat($id,'Gambar');
					$temp = explode(".", $_FILES['dok']['name'][$i]);
					$isi['gambar'] = date('Hisdmy').'DNTG.'.end($temp);
					move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Gambar/'.$isi['gambar']);

				 }elseif (in_array($_FILES['dok']['type'][$i], $pdf)) {
				 	# code...
					 $this->Cuaca_model->del_file_dinat($id,'Dokumen');
					$temp = explode(".", $_FILES['dok']['name'][$i]);
					$isi['pdf'] = date('Hisdmy').'DNTD.'.end($temp);
					move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Dokumen/'.$isi['pdf']);

				 }
				# code...
			}
		echo $this->Cuaca_model->edit_dinat($id,$isi);
	}

	public function IPT(){
		if ($this->session->userdata('analis_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tanggal = date('Y');
			if (isset($_GET['tahun'])) {
				$tanggal = $_GET['tahun'];
				# code...
			}
			$data['ipt'] = $this->Cuaca_model->getIPT($tanggal);
			$data['tahun']=$this->Cuaca_model->tahun('ipt',$tanggal);
			$this->load->view('Cuaca/IPT',$data);
		}
			
	}

	public function get_ipt_r(){
		$data=$this->Cuaca_model->get_ipt_r($_GET['id']);
		echo $data;
	}

	public function set_ipt(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$tmp_gambar=null;
		$tmp_pdf=null;
		$gbr1=null;
		$pdf1=null;
		$ok=null;
		$judul=$_POST['judul'];
		$tanggal_mulai = strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');
		
		if ($_POST['tanggal_akhir']=='') {
			# code...
			$tanggal_akhir= date('d-m-Y',strtotime($tanggal_mulai.'+3 months'));	
			
		}
		$file=$_FILES['dok'];
		$path='../File_BMKG/Iklim/Analisis_iklim/IPT/';

		for ($i=0; $i < 2; $i++) { 
			if (in_array($file['type'][$i],$gbr)) {
				$tmp_gambar=$file['tmp_name'][$i];
				$temp = explode(".", $file['name'][$i]);
				$gbr1 = date('Hisdmy').'IPTG.'.end($temp);
				$ok.='G';
			}else if (in_array($file['type'][$i], $pdf)) {
				$tmp_pdf=$file['tmp_name'][$i];
				$temp = explode(".", $file['name'][$i]);
				$pdf1 = date('Hisdmy').'IPTD.'.end($temp);
				$ok.="D";
			}
			# code...
		}
		if ($ok=="DG"||$ok=="GD") {
			move_uploaded_file($tmp_pdf, $path.'Dokumen/'.$pdf1);
			move_uploaded_file($tmp_gambar, $path.'Gambar/'.$gbr1);
			echo $this->Cuaca_model->set_ipt(date('Y-m-d',strtotime($tanggal_mulai)),date('Y-m-d',strtotime($tanggal_akhir)),$judul, $pdf1, $gbr1,$this->session->userdata('nama'), $this->waktu);
				# code...
		}
	}

	public function edit_ipt(){

		$id=$_POST['id'];
		$judul= $_POST['judul'];

		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$pdf=array('application/pdf','application/PDF');
		$path='../File_BMKG/Iklim/Analisis_iklim/IPT/';

		$tanggal_mulai = strtr($_POST['tanggal_mulai'],'/','-');
		$tanggal_akhir= strtr($_POST['tanggal_akhir'],'/','-');

		$tanggal_mulai=date('Y-m-d',strtotime($tanggal_mulai));
		$tanggal_akhir=date('Y-m-d',strtotime($tanggal_akhir));

		$isi=array('judul'=>$judul,'bulan_mulai'=>$tanggal_mulai,'bulan_akhir'=>$tanggal_akhir);
			for ($i=0; $i < count($_FILES['dok']['name']); $i++) {
				if (in_array($_FILES['dok']['type'][$i], $gbr)) {
					$this->Cuaca_model->del_file_ipt($id,'Gambar');
					$temp = explode(".", $_FILES['dok']['name'][$i]);
					$isi['gambar'] = date('Hisdmy').'IPTG.'.end($temp);
					move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Gambar/'.$isi['gambar']);
				 	
				 }elseif (in_array($_FILES['dok']['type'][$i], $pdf)) {
				 	# code...
					$this->Cuaca_model->del_file_ipt($id,'Dokumen');
					$temp = explode(".", $_FILES['dok']['name'][$i]);
					$isi['pdf'] = date('Hisdmy').'IPTG.'.end($temp);
					move_uploaded_file($_FILES['dok']['tmp_name'][$i], $path.'Dokumen/'.$isi['pdf']);
					
				 }
				# code...
			}

		echo $this->Cuaca_model->edit_ipt($id,$isi);
	}

	public function get_ipt_id(){
		$data=$this->Cuaca_model->get_ipt_id($_GET['id']);

		echo json_encode($data);
	}

	public function del_ipt(){
		$hasil = null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_ipt($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function info_HTH(){
		if ($this->session->userdata('inf_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			$bulan=date('m');
			if (isset($_GET['bulan'])) {
				$tahun=$_GET['tahun'];
				$bulan=$_GET['bulan'];
				# code...
			}
			$data['bulan']=$this->Cuaca_model->bulan($bulan);
			$data['tahun']=$this->Cuaca_model->tahun('informasi_hth',$tahun);
			$data['hth']=$this->Cuaca_model->get_hth($tahun.'-'.$bulan);
			$this->load->view('Cuaca/Info_HTH',$data);	
		}
	}

	public function get_hth_r(){
		$data=$this->Cuaca_model->get_hth_r($_GET['id']);
		echo $data;
	}
//$temp = explode(".", $_FILES['dok'][$i]);
//$nambar = date('Hisdmy').'PSMG.'.end($temp);
	public function set_hth(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$judul=$_POST['judul'];
		$isi=$_POST['teks'];
		$tm=date('Y-m-d',strtotime($_POST['tanggal_mulai']));
		$ta=date('Y-m-d',strtotime('+ 10 days'.$tm));
		if ($_POST['tanggal_akhir']!="") {
			$ta=date('Y-m-d',strtotime($_POST['tanggal_akhir']));
		}
		

		if (in_array($_FILES['foto']['type'],$gbr)) {
			# code...
			$temp = explode(".", $_FILES['foto']['name']);
			$nambar = date('Hisdmy').'HTH.'.end($temp);
			move_uploaded_file($_FILES['foto']['tmp_name'],'../File_BMKG/Iklim/Informasi_iklim/Informasi_HTH/'.$nambar);

			echo $this->Cuaca_model->set_hth($judul,$isi, $nambar,$tm,$ta, $this->session->userdata('nama'),$this->waktu);

		}
	}

	public function edit_req_hth(){
		$data=$this->Cuaca_model->get_hth_id($_GET['id']);
		echo $data;
	}

	public function edit_hth(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$id=$_POST['id'];
		$isi['judul']=$_POST['judul'];
		$isi['ket']=$_POST['teks'];
		$isi['tanggal']=date('Y-m-d',strtotime($_POST['tanggal_mulai']));
		$isi['tanggal_akhir']=date('Y-m-d',strtotime($_POST['tanggal_akhir']));
		

		if (in_array($_FILES['foto']['type'],$gbr)) {
			# code...
			//unlink('../File_BMKG/Informasi_iklim/Informasi_HTH/'.$_POST['gambar']);
			$temp = explode(".", $_FILES['foto']['name']);
			$nambar = date('Hisdmy').'HTH.'.end($temp);
			move_uploaded_file($_FILES['foto']['tmp_name'],'../File_BMKG/Iklim/Informasi_iklim/Informasi_HTH/'.$nambar);
			$isi['gambar']=$nambar;
		}
		echo $this->Cuaca_model->edit_hth($id,$isi);
	}

	public function del_hth(){
		$hasil=null;
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_hth($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function TCH(){
		if ($this->session->userdata('per_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun = date('Y');
			$page=1;
			if (isset($_GET['tahun'])) {
				# code...
				$tahun = $_GET['tahun'];
			}

			if (isset($_GET['page'])) {
				$page=$_GET['page'];
				$tahun=$_GET['tahun'];
			}

			$data['tch']=$this->Cuaca_model->get_TCH($tahun,$page);
			$data['tahun']=$this->Cuaca_model->tahun('tren_hujan',$tahun);
			$data['year']=$tahun;
			$this->load->view('Cuaca/TCH',$data);
		}
			
	}

	public function get_tch_r(){
		$data=$this->Cuaca_model->get_tch_r($_GET['id']);
		echo $data;
	}

	public function set_TCH(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$path='../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/';
		
		$isi=$_POST['teks'];
		
		$foto=$_FILES['foto'];
		

		
		$id=$this->Cuaca_model->set_TCH($isi,$this->session->userdata('nama'), $this->waktu);
		if ($id!=null&&$_FILES['foto']['name']!="") {
			# code...
			for ($i=0; $i < count($_FILES['foto']['name']); $i++) {
				$nambar = explode(".", $_FILES['foto']['name'][$i]);
				$nambar = date('Hisdmy').$i."TCH.".end($nambar);
				if (in_array($foto['type'][$i], $gbr)) {
					move_uploaded_file($foto['tmp_name'][$i], $path.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
					# code...
				}
				# code...
			}
		}
		if ($id!=null) {
			# code...
			echo true;
		}
	}

	public function del_tch(){
		$hasil = null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_tch($_POST['hapus'][$i]);
			# code...
		}
		echo $hasil;
	}

	public function get_tch_id(){
		$data=$this->Cuaca_model->get_tch_id($_GET['id']);

		echo json_encode($data);
	}

	public function edit_tch(){
		$id=$_POST['id'];
		$teks = $_POST['teks'];
		if ($_FILES['tch']['name']!="") {
			for ($i=0; $i < count($_FILES['tch']['name']); $i++) { 
				# code...
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['tch']['name'][$i]);
				$nambar = date('Hisdmy')."TCH".$i.".".end($temp);
				$tmp_name = $_FILES['tch']['tmp_name'][$i];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
					move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/'.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
				}
			}
		}
		
		if (isset($_POST['hapus'])) {
			for ($i=0; $i < count($_POST['hapus']); $i++) { 
				# code...
				$this->Cuaca_model->del_foto($_POST['hapus'][$i]);
				if (file_exists('../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/'.$_POST['hapus'][$i])) {
					unlink('../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/'.$_POST['hapus'][$i]);
					# code...
				}
			}
		}

		
		echo $this->Cuaca_model->edit_tch($id,array('teks'=>$teks));
	}

	public function set_tch_r(){
		$this->Cuaca_model->set_tch_r($_POST['id']);
	}

	public function Tren_suhu(){
		if ($this->session->userdata('per_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun = date('Y');
			$page=1;
			if (isset($_GET['tahun'])) {
				# code...
				$tahun = $_GET['tahun'];
			}
			if (isset($_GET['page'])) {
				# code...
				$page = $_GET['page'];
			}

			$data['tsh']=$this->Cuaca_model->get_Tsuhu($tahun,$page);
			$data['tahun']=$this->Cuaca_model->tahun('tren_suhu',$tahun);
			$data['year']=$tahun;
			$this->load->view('Cuaca/tren_suhu',$data);
		}
			
	}

	public function get_tsh_r(){
		$data=$this->Cuaca_model->get_tsh_r($_GET['id']);
		echo $data;
	}

	public function get_tsh_id(){
		$data=$this->Cuaca_model->get_tsh_id($_GET['id']);
		echo json_encode($data);
	}

	public function edit_tsh(){
		$id=$_POST['id'];
		$teks = $_POST['teks'];
		if (isset($_FILES)) {
			for ($i=0; $i < count($_FILES['tsh']['name']); $i++) {
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['tsh']['name'][$i]);
				$nambar = date('Hisdmy')."TSH".$i.".".end($temp);
				$tmp_name = $_FILES['tsh']['tmp_name'][$i];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
				move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/'.$nambar);
				$this->Cuaca_model->set_foto($nambar,$id);
				}
			}
		}
			
		$count=0;
		if (isset($_POST['hapus'])) {
			for ($i=0; $i < count($_POST['hapus']); $i++) {
				$this->Cuaca_model->del_foto($_POST['hapus'][$i]);
				if (file_exists('../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/'.$_POST['hapus'][$i])) {
					unlink('../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/'.$_POST['hapus'][$i]);
				}
			}
		}
		echo $this->Cuaca_model->edit_tsh($id,array('teks'=>$teks));
	}

	public function set_tsh_r(){
		$this->Cuaca_model->set_tsh_r($_POST['id']);
	}

	public function set_tren_suhu(){

		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$path='../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/';
		
		$isi=$_POST['teks'];
		
		$foto=$_FILES['foto'];

		$id=$this->Cuaca_model->set_tren_suhu($isi, $this->session->userdata('nama'), $this->waktu);

		if ($_FILES['foto']['name']!=""&&$id!=null) {
			for ($i=0; $i < count($_FILES['foto']['name']); $i++) {
				$nambar = explode(".", $_FILES['foto']['name'][$i]);
				$nambar = date('Hisdmy').$i."TSH.".end($nambar);
				if (in_array($foto['type'][$i], $gbr)) {
					move_uploaded_file($foto['tmp_name'][$i], $path.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
				}
			}
		}
		if ($id!=null) {
			echo true;
		}
	}

	public function del_tsh(){
		$hasil = null;

		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_tsh($_POST['hapus'][$i]);
			# code...
		}
		echo $hasil;
	}

	public function PNH(){
		if ($this->session->userdata('per_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun = date('Y');
			$page = 1;
			if (isset($_GET['tahun'])) {
				# code...
				$tahun = $_GET['tahun'];
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			$data['pnh']=$this->Cuaca_model->get_pch($tahun,$page);
			$data['tahun']=$this->Cuaca_model->tahun('perubahan_curah_hujan',$tahun);
			$data['year']=$tahun;
			$this->load->view('Cuaca/PNH',$data);
		}
			
	}

	public function get_pnh_r(){
		$data=$this->Cuaca_model->get_pnh_r($_GET['id']);
		echo $data;
	}

	public function edit_pnh(){

		$id=$_POST['id'];
		$teks = $_POST['teks'];
		if ($_FILES['pnh']['name']!="") {
			for ($i=0; $i < count($_FILES['pnh']['name']); $i++) { 
				# code...
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['pnh']['name'][$i]);
				$nambar = date('Hisdmy').$i."PNH.".end($temp);
				$tmp_name = $_FILES['pnh']['tmp_name'][$i];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
					move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/'.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
				}
			}
		}
			
		if (isset($_POST['hapus'])) {
			for ($i=0; $i < count($_POST['hapus']); $i++) {
				$this->Cuaca_model->del_foto($_POST['hapus'][$i]);
				if (file_exists('../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/'.$_POST['hapus'][$i])) {
					unlink('../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/'.$_POST['hapus'][$i]);
					# code...
				}
			}
		}
		echo $this->Cuaca_model->edit_pnh($id,array('teks'=>$teks));
	}

	public function set_pnh_r(){
		$this->Cuaca_model->set_pnh_r($_POST['id']);
	}

	public function get_pnh_id(){
		$data=$this->Cuaca_model->get_pnh_id($_GET['id']);
		echo json_encode($data);
	}

	public function del_pnh(){
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$this->Cuaca_model->del_pnh($_POST['hapus'][$i]);
		}
		
	}

	public function set_pnh(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$path='../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/';
		
		$isi=$_POST['teks'];

		$id=$this->Cuaca_model->set_pnh($isi, $this->session->userdata('nama'), $this->waktu);

		if ($_FILES['foto']['name']!=""&&$id!=null) {
			# code...
			for ($i=0; $i < count($_FILES['foto']['name']); $i++) {
				$nambar = explode(".", $_FILES['foto']['name'][$i]);
				$nambar = date('Hisdmy').$i."PNH.".end($nambar);
				if (in_array($_FILES['foto']['type'][$i], $gbr)) {
					move_uploaded_file($_FILES['foto']['tmp_name'][$i], $path.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
					# code...
				}
				# code...
			}
		}
		if ($id!=null) {
			echo true;
		}
	}

	public function EPI(){
		if ($this->session->userdata('per_iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun = date('Y');
			$page=1;
			if (isset($_GET['tahun'])) {
				# code...
				$tahun = $_GET['tahun'];
			}
			if (isset($_GET['page'])) {
				$page=$_GET['page'];
			}
			$data['epi']=$this->Cuaca_model->get_EPI($tahun,$page);
			$data['tahun']=$this->Cuaca_model->tahun('epi',$tahun);
			$data['year']=$tahun;
			$this->load->view('Cuaca/EPI',$data);
		}
			
	}
	public function get_epi_r(){
		$data=$this->Cuaca_model->get_epi_r($_GET['id']);
		echo $data;
	}
	public function edit_epi(){
		$id=$_POST['id'];
		$teks = $_POST['teks'];
		if ($_FILES['epi']['name']!="") {
			for ($i=0; $i < count($_FILES['epi']['name']); $i++) { 
				# code...
				$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
				$temp = explode(".", $_FILES['epi']['name'][$i]);
				$nambar = date('Hisdmy').$i."EPI.".end($temp);
				$tmp_name = $_FILES['epi']['tmp_name'][$i];
				$type = pathinfo($nambar,PATHINFO_EXTENSION);
				if (in_array($type, $tipe)) {
					move_uploaded_file($tmp_name, '../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/'.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
				}
			}
		}
			
		if (isset($_POST['hapus'])) {
			for ($i=0; $i < count($_POST['hapus']); $i++) {
				$this->Cuaca_model->del_foto($_POST['hapus'][$i]);
				if (file_exists('../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/'.$_POST['hapus'][$i])) {
					unlink('../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/'.$_POST['hapus'][$i]);
				}
			}
		}

		
		echo $this->Cuaca_model->edit_epi($id,array('teks'=>$teks));
	}

	public function get_epi_id(){
		$data=$this->Cuaca_model->get_epi_id($_GET['id']);
		echo json_encode($data);
	}

	public function set_epi(){
		$gbr = array('image/png','image/JPG','image/jpeg','image/GIF','image/jpg','image/PNG','image/gif');
		$path='../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/';
		
		$isi=$_POST['teks'];
		
		$id=$this->Cuaca_model->set_epi($isi, $this->session->userdata('nama'), $this->waktu);
		if ($_FILES['foto']['name']!=""&&$id!=null) {
			for ($i=0; $i < count($_FILES['foto']['name']); $i++) {
				$nambar = explode(".", $_FILES['foto']['name'][$i]);
				  $nambar = date('Hisdmy').$i."EPI.".end($nambar);
				if (in_array($_FILES['foto']['type'][$i], $gbr)) {
					move_uploaded_file($_FILES['foto']['tmp_name'][$i], $path.$nambar);
					$this->Cuaca_model->set_foto($nambar,$id);
					# code...
				}
				# code...
			}
		}
		if ($id!=null) {
			echo true;
		}
		
	}

	public function del_EPI(){
		$count = count($_POST['hapus']);

		for ($i=0; $i < $count; $i++) { 
			$this->Cuaca_model->del_epi($_POST['hapus'][$i]);
			# code...
		}
	}

	public function set_ket_ph(){
		echo $this->Cuaca_model->set_keterangan('keterangan_kah',$_POST['keterangan'],$_POST['bulan'],$_POST['tahun'],$this->session->userdata('nama'),$this->waktu);
	}

	public function del_ket_ph(){
		$this->Cuaca_model->del_ket($_POST['id'],'kah');
	}

	public function edit_ket_ph(){
		echo $this->Cuaca_model->edit_ket($_POST['bulan'],$_POST['tahun'],$_POST['keterangan'],'keterangan_kah');
	}

	public function get_kah_ket(){
		$data=$this->Cuaca_model->get_ket_id($_GET['id'],'keterangan_kah');
		echo json_encode($data);
	}

	public function set_epi_r(){
		$this->Cuaca_model->set_epi_r($_POST['id']);
	}

	public function edit_ph_kah(){
		echo $this->Cuaca_model->edit_kah($_POST['tahun'],$_POST['bulan'],$_POST['minggu'],$_POST['indeks']);
	}
	

	public function edit_ket_spm(){
		echo$this->Cuaca_model->edit_ket_spm($_POST['bulan'],$_POST['tahun'],$_POST['keterangan']);
	}

	public function del_ket_spm(){
		$this->Cuaca_model->del_ket($_POST['id'],'spm');
	}

	public function KAH(){
		if ($this->session->userdata('kual_udara')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			$bulan = date('m');
			if (isset($_GET['tahun'])) {
				$tahun = $_GET['tahun'];
				$bulan = date('m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
			}

			$data['kah']=$this->Cuaca_model->get_KAH($bulan,$tahun);
			$data['tahun']=$this->Cuaca_model->tahun_eks('kimia_air_hujan3','tahun',$tahun);
			$data['hapus']='<button onclick=del_in("'.$bulan.'","'.$tahun.'","'.site_url('Cuaca/del_kah').'","'.$data['kah']['stat'].'") type="button" class="btn btn-round btn-danger btn-xs hapus">Hapus seluruh data SPM bulan ini</button>';
			$data['grafik']=json_encode($this->Cuaca_model->get_KAH_grafik($tahun));
			$data['tahunG']=$tahun;
			$data['bulan']=$this->Cuaca_model->bulan($bulan);
			$this->load->view('Cuaca/KAH',$data);
		}
			
	}

	public function set_kah(){
		$minggu = $_POST['minggu'];
		$bulan = $_POST['bulan'];
		$tahun=$_POST['tahun'];
		$indeks = $_POST['indeks'];

		echo $this->Cuaca_model->set_kah($minggu,$bulan,$tahun,$indeks,$this->session->userdata('nama'),$this->waktu);
	}

	public function del_kah(){
		$this->Cuaca_model->del_indeks('kimia_air_hujan3',$_POST['bulan'], $_POST['tahun']);
	}

	public function edit_kah(){
		$minggu = $_POST['minggu'];
		$bulan = $_POST['bulan'];
		$indeks = $_POST['indeks'];

		echo $this->Cuaca_model->edit_kah($minggu,$bulan,$indeks);
	}

	public function set_ket_spm(){
		echo $this->Cuaca_model->set_keterangan('ket_spm',$_POST['keterangan'],$_POST['bulan'],$_POST['tahun'],$this->session->userdata('nama'),$this->waktu);
	}

	public function Informasi_partikular(){
		if ($this->session->userdata('kual_udara')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$tahun=date('Y');
			$bulan = date('m');
			if (isset($_GET['tahun'])) {
				# code...
				$tahun = $_GET['tahun'];
				$bulan = date('m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
			}

			$data['spm'] = $this->Cuaca_model->get_spm($bulan,$tahun);
			$data['tahun']=$this->Cuaca_model->tahun_eks('spm','tahun',$tahun);
			$data['bulan']=$this->Cuaca_model->bulan($bulan);
			$data['hapus']='<button onclick=del_in("'.$bulan.'","'.$tahun.'","'.site_url('Cuaca/del_spm').'","'.$data['spm']['stat'].'") type="button" class="btn btn-round btn-danger btn-xs hapus">Hapus seluruh data SPM bulan ini</button>';
			$data['grafik']=$this->Cuaca_model->get_spm_grafik($tahun);
			$this->load->view('Cuaca/Inf_pratikular',$data);
		}
			
	}

	public function get_spm_ket(){
		$data=$this->Cuaca_model->get_ket_id($_GET['id'],'ket_spm');
		echo json_encode($data);
	}

	public function set_spm(){
		$minggu = $_POST['minggu'];
		$bulan = $_POST['bulan'];
		$tahun=$_POST['tahun'];
		$indeks = $_POST['indeks'];

		echo $this->Cuaca_model->set_spm($minggu,$bulan,$tahun,$indeks,$this->session->userdata('nama'),$this->waktu);
	}
	
	public function del_spm(){
		$this->Cuaca_model->del_indeks('spm',$_POST['bulan'], $_POST['tahun']);
	}

	public function edit_spm(){
		$minggu = $_POST['minggu'];
		$bulan = $_POST['bulan'];
		$indeks = $_POST['indeks'];

		echo $this->Cuaca_model->edit_spm($minggu,$bulan,$indeks);
	}

	public function partikulat25(){
		$tanggal=date('Y-m-d');
		if (isset($_GET['tanggal'])) {
			$tanggal = strtr($_GET['tanggal'],'/','-');
			$tanggal=date('Y-m-d',strtotime($tanggal));
			# code...
		}
		$data['partikulat'] = $this->Cuaca_model->get_partikulat($tanggal,'partikulat25');
		$this->load->view('Cuaca/partikulat25',$data);
	}

	public function probabilistik(){
		if ($this->session->userdata('iklim')!='Ya') {
			# code...
			$this->load->view('Umum');
		}else{
			$bulan=date('m');
			$tahun=date('Y');
			if ((isset($_GET['bulan']))&&(isset($_GET['tahun']))) {
				$bulan=date('m',strtotime($_GET['tahun'].'-'.$_GET['bulan']));
				$tahun=$_GET['tahun'];
				# code...
			}
			$data['probabilistik']=$this->Cuaca_model->get_probabilitas($bulan,$tahun);
			$data['tahun']=$this->Cuaca_model->tahun('Hujan_probabilistik',$tahun);
			$data['bulan']=$this->Cuaca_model->bulan($bulan);
			$this->load->view('Cuaca/probabilistik',$data);
		}
			
	}

	public function get_prob_ID(){
		$id=$_GET['id'];

		$data=$this->Cuaca_model->get_prob_ID($id);

		echo json_encode($data);
	}

	public function set_probabilitas(){
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$int = $_POST['intens'];

		$tipe = array('png','JPG','jpeg','GIF','jpg','PNG','gif');
		$gambar = $_FILES['foto'];
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Hujan_probabilistik/';
		$tipe1=pathinfo($gambar['name'],PATHINFO_EXTENSION);

		if (in_array($tipe1, $tipe)) {
			$temp = explode(".", $gambar['name']);
			$nambar = date('Hisdmy').'PBS.'.end($temp);
				move_uploaded_file($gambar['tmp_name'], $path.$nambar);
				$this->Cuaca_model->set_probabilitas($bulan,$tahun,$int,$nambar,$this->session->userdata('nama'),$this->waktu);
				echo "Berhasil upload";
		}
	}

	public function del_huprob(){
		$count = count($_POST['hapus']);

		for ($i=0; $i < $count; $i++) { 
			$this->Cuaca_model->del_hpb($_POST['hapus'][$i]);
			# code...
		}
	}

	public function peringatan(){
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
			$data['peringatan']=$this->Cuaca_model->peringatan($waktu,$page);
			$data['tahun']=$this->Cuaca_model->tahun('peringatan',date('Y',strtotime($waktu)));
			$data['bulan']=$this->Cuaca_model->bulan(date('m',strtotime($waktu)));
			$data['year']=date('Y',strtotime($waktu));
			$data['month']=date('m',strtotime($waktu));
			$this->load->view('Cuaca/peringatan',$data);
		}
	}

	public function set_peringatan(){
		$teks = $_POST['teks'];
		$wilayah = $_POST['wilayah'];
		$tanggal = strtr($_POST['tanggal'],'/','-');
		echo $this->Cuaca_model->set_peringatan($teks,$wilayah,$tanggal, $this->session->userdata('nama'),$this->waktu);
	}

	public function del_peringatan(){
		$hasil=null;
		for ($i=0; $i < count($_POST['hapus']); $i++) { 
			$hasil+=$this->Cuaca_model->del_peringatan($_POST['hapus'][$i]);
		}
		echo $hasil;
	}

	public function edit_peringatan(){
		echo $this->Cuaca_model->edit_peringatan($_POST['id'],$_POST['teks'],$_POST['wilayah'],strtr($_POST['tanggal'],'/','-'));
	}

	public function get_peringatan_id(){
		echo json_encode($this->Cuaca_model->get_peringatan_id($_GET['id']));
	}



}
