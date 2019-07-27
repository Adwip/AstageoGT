<?php

/**
 * 
 */
class Pegawai_model extends CI_Model{
	
	function __construct(){
		parent:: __construct();
		$this->load->database('pegawai');
		$this->load->library('Pemisah_angka');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function set_akses($nama){
		$data=file_get_contents('asset\Admin\akses_admin.json');
		$data=json_decode($data,TRUE);
		$key=null;
		for ($i=0; $i < count($data); $i++) { 
			if (isset($data[$i][$nama])) {
				$key=$data[$i][$nama];
				break;
			}
		}
		if ($key!=null) {
			$this->session->set_userdata(array(
				'berita'=>$key['berita'],
				'artikel'=>$key['artikel'],
				'kepegawaian'=>$key['kepegawaian'],
				'cuaca'=>$key['cuaca'],
				'prak_musim'=>$key['prak_musim'],
				'analis_iklim'=>$key['analis_iklim'],
				'inf_iklim'=>$key['inf_iklim'],
				'per_iklim'=>$key['per_iklim'],
				'kual_udara'=>$key['kual_udara'],
				'gempa'=>$key['gempa'],
				'ttm_petir'=>$key['ttm_petir'],
				'umum'=>$key['umum'],
				'administrator'=>$key['administrator']
			));
		}else{
			redirect(site_url('Login/keluar'));
		}
	}

	public function masuk($username, $password){

		$data=$this->db->get_where('admin',array('usernam'=>$username,'passwd'=>md5($password)));

		$admin=FALSE;

		if ($data->num_rows()==1) {
			
			foreach ($data->result() as $cek) {
				$admin['status']=TRUE;
				$admin['akses']=$data->result();
				# code...
			}
			
		}

		return $admin;

	}

	public function admin($order){
		$this->db->where('id_admin !=',$this->session->userdata('nia'));
		$this->db->where('id_admin !=','root');
		$data=$this->db->get('admin');
		$data2['admin']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$adm=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1);$l<$data->num_rows(); $l++) {
				# code...
				$ft='Foto belum ada';
				if ($adm[$l]->foto!='no-img.png') {
					# code...
					$ft='<img src="'. base_url().'../File_BMKG/Admin/'.$adm[$l]->foto.'" height="50" width="50">';
				}
				$data2['admin'].='<tr>
								<td class="pos-teks">'.$list.'</td>
								<td class="pos-teks">'.$adm[$l]->nama.'</td>
								<td class="pos-teks">'.$ft.'</td>
								<td class="pos-teks">'.date('d-m-Y H:i:s',strtotime($adm[$l]->tanggal_input)).'</td>
								<td class="pos-teks">'.$adm[$l]->petugas.'</td>
								<td class="pos-teks">
								<button value="'.$adm[$l]->id_admin.'" type="button" class="btn btn-round btn-xs btn-info	edit">Edit</button>
								<input	data-nama="hapus" type="checkbox" value="'.$adm[$l]->id_admin.'" name="hapus[]"></td>
							</tr>';
				$i++;
				$list++;
				if ($i==5) {
					break;
				}
			}
		}
		if ($data->num_rows()>5) {
			$order2 = ($order==1)? 'empty' : ($order-5);
			$data2['page'].='<li class="pag-tem"><button name="page" value="'.$order2.'" class="pag-lin fir-p">Sebelumnya</button></li>';
			for ($i=0; $i < $data->num_rows(); $i=$i+5) {
				$check = (($order-1)==$i) ? 'id="spage"' : null;
				$data2['page'].='<li class="pag-tem"><button '.$check.' name="page" value="'.($i+1).'" class="pag-lin poin-p">'.($i+1).'</button></li>';
			}
			$order = ($order+5>$data->num_rows()) ? 'empty' : $order+5;
			$data2['page'].='<li class="pag-tem"><button name="page" value="'.$order.'" class="pag-lin las-p">Selanjutnya</button></li>';
		}
		return $data2;

	}

	public function set_admin($nama,$username,$password,$foto,$petugas,$tanggal){

		$this->db->SELECT('id_admin');
		$this->db->FROM('admin');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_admin,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'ADM'.$id;

		$isi=array(
			'id_admin'=>$id,
			'nama'=>$nama,
			'usernam'=>$username,
			'passwd'=>md5($password),
			'foto'=>$foto,
			'petugas'=>$petugas,
			'tanggal_input'=>$tanggal
		);

		if ($this->db->insert('admin',$isi)) {
			return	$id;
			# code...
		}else{
			return	NULL;
		}

	}

	public function del_admin($id){
		$this->db->delete('admin',array('id_admin'=>$id));
		if ($this->db->affected_rows()==1) {
			$data=file_get_contents('asset/Admin/akses_admin.json');
			$data=json_decode($data,TRUE);
			$data2=null;
			foreach ($data as $key=>$val ) {
				if (!isset($data[$key][$id])) {
					$data2[$key]= $val;
				}
			}
			$data=json_encode($data2,JSON_PRETTY_PRINT);
			file_put_contents('asset/Admin/akses_admin.json',$data);
			return 1;
		}
	}

	public function set_akses_json($nia,$berita,$artikel,$kepegawaian,$cuaca,$prak_musim,$analis_iklim,$inf_iklim,$per_iklim,$kual_udara,$gempa,$ttm_petir,$umum,$administrator){
		$data=file_get_contents('asset/Admin/akses_admin.json');
		$data=json_decode($data,TRUE);
		$data[][$nia]=array('berita'=>$berita,'artikel'=>$artikel,'kepegawaian'=>$kepegawaian,'cuaca'=>$cuaca,'prak_musim'=>$prak_musim,'analis_iklim'=>$analis_iklim,'inf_iklim'=>$inf_iklim,'per_iklim'=>$per_iklim,'kual_udara'=>$kual_udara,'gempa'=>$gempa,'ttm_petir'=>$ttm_petir,'umum'=>$umum,'administrator'=>$administrator);

		$data=json_encode($data,JSON_PRETTY_PRINT);

		file_put_contents('asset/Admin/akses_admin.json',$data);
	}

	public function edit_akses($nia,$berita,$artikel,$kepegawaian,$cuaca,$prak_musim,$analis_iklim,$inf_iklim,$per_iklim,$kual_udara,$gempa,$ttm_petir,$umum,$administrator){
		$data=file_get_contents('asset/Admin/akses_admin.json');
		$data=json_decode($data,TRUE);
		
		foreach ($data as $key=>$val ) {
			if (isset($val[$nia])) {
				$data[$key][$nia]=array('berita'=>$berita,'artikel'=>$artikel,'kepegawaian'=>$kepegawaian,'cuaca'=>$cuaca,'prak_musim'=>$prak_musim,'analis_iklim'=>$analis_iklim,'inf_iklim'=>$inf_iklim,'per_iklim'=>$per_iklim,'kual_udara'=>$kual_udara,'gempa'=>$gempa,'ttm_petir'=>$ttm_petir,'umum'=>$umum,'administrator'=>$administrator);
				break;
			}
		}
		$data=json_encode($data,JSON_PRETTY_PRINT);
		$data=file_put_contents('asset/Admin/akses_admin.json',$data);
		if ($data) {
			return 2;
		}
	}

	public function	get_akses_id($id){
		$data=file_get_contents('asset/Admin/akses_admin.json');
		$data=json_decode($data,TRUE);
		$data2=null;
		foreach ($data as $key=>$val) {
			if(isset($val[$id])){
				$data2['akses']=$data[$key][$id];
				break;
			}
			# code...
		}
		$this->db->select('id_admin,nama,id_pegawai');
		$data2['db']=$this->db->get_where('admin',array('id_admin'=>$id))->result();
		return	$data2;
	}

	public function ch_pass($id, $pass, $old){
		
		$isi=array(
			'passwd'=>md5($pass)
			);
		$this->db->where('passwd',md5($old));
		$this->db->where('id_admin',$id);
		$this->db->where('id_admin !=','root');
		$this->db->update('admin',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function get_panel($id){
		$aks=array('berita'=>'Berita','artikel'=>'Artikel','kepegawaian'=>'Kepegawaian','cuaca'=>'Cuaca','prak_musim'=>'Prakiraan musim','analis_iklim'=>'Analisis iklim','inf_iklim'=>'Informasi iklim','per_iklim'=>'Perubahan iklim','kual_udara'=>'Kualitas udara','gempa'=>'Gempa & tsunami','ttm_petir'=>'Terbit terbenam matahari & data petir','umum'=>'Umum','administrator'=>'Administrator');

		$data=$this->db->get_where('admin',array('id_admin'=>$id))->result();
		$data2=null;
		if (isset($data[0])) {
			$data2['foto']=$data[0]->foto;
			$data2['nama']=$data[0]->nama;
			$data2['login']='Saat ini login pertama kali';
			if ($data[0]->last_login!='0000-00-00 00:00:00') {
				$data2['login']= date('d-m-Y H:i:s',strtotime($data[0]->last_login)).' WIB';
			}
		}
		$data2['form']=null;
		if ($id!='root') {
			$data2['form']= '<div class="form-group">
								<h3 class="wrn">Ganti nama</h3>
								<input type="text" autocomplete="off" class="form-control cekbut"  name="nama">
								<br>
								<h3 class="wrn">Ganti username</h3>
								<input type="text" autocomplete="off" class="form-control cekbut3"  name="username">
								<br>
								<h3 class="wrn">Ganti foto</h3>
								<input type="file" name="foto" class="cekbut2">
								<br>
								<button disabled type="submit" class="btn btn-md btn-success ganp">Ganti</button>
							</div>';
		}
		$data=file_get_contents('asset\Admin\akses_admin.json');
		$data=json_decode($data,true);
		for ($i=0; $i < count($data); $i++) { 
			if (isset($data[$i][$id])) {
				$data=$data[$i][$id];
				break;
			}
		}
		$i=0;
		foreach ($aks as $key =>$val) {
			if ($data[$key]!=null) {
				$data2['akses'][$i]='<li class="wrn clr">'.$val.'</li>';
				$i++;
			}
		}
		return $data2;
	}

	public function edit_akun($id,$isi){
		if (isset($isi['foto'])) {
			$data=$this->db->get_where('admin',array('id_admin'=>$id));
			foreach ($data->result() as $key) {
				if ($key->foto!='no-img.png') {
					unlink('../File_BMKG/Admin/'.$key->foto);
				}
			}
		}
		$this->db->where('id_admin',$id);
		$this->db->where('id_admin',$id);
		$this->db->update('admin',$isi);
		if ($this->db->affected_rows()>0) {
			if (isset($isi['nama'])) {
				$this->session->set_userdata(array('nama'=>$isi['nama']));
			}
			if (isset($isi['foto'])) {
				$this->session->set_userdata(array('foto'=>$isi['foto']));
			}
			return 2;
		}
	}

	public function set_waktu($id){
		$this->db->where('id_admin',$id);
		$this->db->update('admin',array('last_login'=>date('Y-m-d H:i:s')));
	}
}