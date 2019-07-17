<?php
/**
 * 
 */
class Informasi_model extends CI_Model
{
	
	function __construct(){
		parent::__construct();
		$this->load->database('informasi');
		$this->load->library('Pemisah_angka');
	}
	public function tahun($tabel,$tahun){
		$this->db->SELECT('year(tanggal_input) AS tahun');
		$this->db->FROM($tabel);
		$this->db->GROUP_BY('tahun');
		$data=$this->db->get();
		$data2=null;
		$sel=null;
		if ($data->num_rows()!=0) {
			foreach ($data->result() as $data) {
			# code...
				if ($data->tahun==$tahun) {
					# code...
					$sel='selected';
				}
				$data2.='<option '.$sel.' value="'.$data->tahun.'">'.$data->tahun.'</option>';
				$sel=null;
			}	
			
			if (($data->tahun+1)==$tahun) {
				# code...
				$sel='selected';
			}
			$data2 .= '<option '.$sel.' value="'.($data->tahun+1).'">'.($data->tahun+1).'</option>';
			# code...
		}else{
			$data2 .= '<option  value="'.$tahun.'">'.$tahun.'</option>';
		}

		return $data2;
	}

	public function bulan($bulan){
		$bulan1=array('01'=>'Januari',
					  '02'=>'Februari',
					  '03'=>'Maret',
					  '04'=>'April',
					  '05'=>'Mei',
					  '06'=>'Juni',
					  '07'=>'Juli',
					  '08'=>'Agustus',
					  '09'=>'September',
					  '10'=>'Oktober',
					  '11'=>'November',
					  '12'=>'Desember');
		$data2=null;
		$i=0;
			foreach ($bulan1 as $key => $val) {
				$sel=null;

				if ($val==$bulan1[$bulan]) {
					# code...
					$sel='selected';
				}
				$data2.='<option '.$sel.' value="'.$key.'" >'.$val.'</option>';
				# code...
			}


		return $data2;
	}
//Unit pelayanan teknis
	public function get_UPT(){
		$data=  $this->db->get('upt');
		$data2=null;
		if ($data->num_rows()>0) {
			$i=1;
			foreach ($data->result() as $upt) {
				$data2.='<tr>	
						<td>'.$i.'</td>
						<td><a class="baca-upt" href="'.$upt->id_upt.'">'.$upt->kantor.'</a></td>
						<td>'.$upt->Alamat.'</td>
						<td>'.$upt->kepala.'</td>
						<td><button type="button" onClick=editUPT("'.$upt->id_upt.'","'.site_url('Informasi/get_uptID').'") class="btn btn-round btn-info btn-xs" >Edit</button><br><input type="checkbox" name="hapus[]" data-nama="hapus" value="'.$upt->id_upt.'"  /></td> 
					 </tr>';
				$i++;
			}
			
		}
		return $data2;

	}

	public function pengumuman($waktu,$order){
		$this->db->LIKE('tanggal_input',$waktu);
		$data=$this->db->get('pengumuman');
		$data2['peng']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$key=$data->result();
		if ($data->num_rows()>0) {
			for($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($key[$l]->file!=null) {
					$pdf='<a class="pdf" href="../File_BMKG/Pengumuman/'.$key[$l]->file.'">PDF</a>';
				}else{
					$pdf='Tidak ada dokumen pdf';
				}
				$data2['peng'].='<tr>
							<td>'.$list.'</td>
							<td><a class="baca" href="'.$key[$l]->id_peng.'">'.$key[$l]->judul.'</a></td>
							<td>'.$pdf.'</td>
							<td>'.$key[$l]->penyusun.'</td>
							<td>'.date('d-m-Y H:i:s',strtotime($key[$l]->tanggal_input)).'</td>
							<td>
								<button type="button" value="'.$key[$l]->id_peng.'" class="btn btn-xs btn-round btn-info edit-req-peng">Edit</button>
								<input value="'.$key[$l]->id_peng.'" type="checkbox" name="hapus[]" data-nama="hapus">
							</td>
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

	public function del_pengumuman($id){
		$data=$this->db->get_where('pengumuman',array('id_peng'=>$id))->result();
		foreach ($data as $key) {
			# code...
			if (file_exists('../File_BMKG/Pengumuman/'.$key->file)) {
				unlink('../File_BMKG/Pengumuman/'.$key->file);
			}
		}
		$this->db->delete('pengumuman',array('id_peng'=>$id));
	}

	public function set_pengumuman($judul,$teks,$file,$nama,$tanggal_input){
		$this->db->SELECT('id_peng');
		$this->db->FROM('pengumuman');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_peng,7);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."PGN".$id;
		$isi=array(
			'id_peng'=>$id,
			'judul'=>$judul,
			'isi'=>$teks,
			'file'=>$file,
			'penyusun'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('pengumuman',$isi);
	}

	public function get_peng_id($id){
		return $this->db->get_where('pengumuman',array('id_peng'=>$id))->result();
	}

	public function edit_pengumuman($id,$isi){
		if (isset($isi['file'])) {
			$data=$this->db->get_where('pengumuman',array('id_peng'=>$id))->result();
			if (isset($data[0]->file)) {
				unlink('../File_BMKG/Pengumuman/'.$data[0]->file);
			}
		}
		$this->db->where('id_peng',$id);
		$this->db->update('pengumuman',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function set_UPT($stasiun,$alamat,$surel,$telepon,$faksimili,$nama,		$struktur,$kepala,$waktu){
		$this->db->SELECT('id_upt');
		$this->db->FROM('upt');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_upt,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."UPT".$id;
		$isi = array(
					'id_upt'=>$id,
					'kantor'=>$stasiun,
					'Alamat'=>$alamat,
					'kepala'=>$kepala,
					'telepon'=>$telepon,
					'faksimili'=>$faksimili,
					'email'=>$surel,
					'nama'=>$nama,
					'struktur'=>$struktur,
					'tanggal_input'=>$waktu
				);

		return $this->db->insert('upt',$isi);
	}

	public function del_upt($id){
		$data=$this->db->get_where('upt',array('id_upt'=>$id));
		foreach ($data->result() as $key) {
			if (file_exists('../File_BMKG/Profil/Struktur/'.$key->struktur)) {
				# code...
				unlink('../File_BMKG/Profil/Struktur/'.$key->struktur);
			}
			# code...
		}
		$this->db->delete('upt',array('id_upt'=>$id));
	}

	public function get_uptID($id){
		$data = $this->db->get_where('upt',array('id_upt'=>$id));
		$data1=null;
		if ($data->num_rows()>0) {
			$data1['data']=$data->row_array();
			$data1['foto']='<img src="'.base_url().'../File_BMKG/Profil/Struktur/'.$data->result()[0]->struktur.'" style="width: 1000px;">';
			# code...
		}
		return $data1;
	}

	public function edit_UPT($id,$isi){
		if (isset($isi['struktur'])) {
			$data=$this->db->get_where('upt',array('id_upt'=>$id))->result();
			foreach ($data as $key) {
				unlink('../File_BMKG/Profil/Struktur/'.$key->struktur);
			}
		}
		
		$this->db->where('id_upt',$id);
		$this->db->update('upt',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}

	}


//Pejabat

	public function get_pejabat(){
		/*$this->db2->select('*');
		$this->db2->from('gempa');
    	$this->db2->order_by('tanggal_terjadi', 'DESC');
		$this->db2->limit(1);
		return $query=$this->db2->get(); */
		$this->db->order_by('id_kat','ASC');
		$data=$this->db->get('pegawai');
		$data2=null;
		if ($data->num_rows()>0) {
			$i=1;
			foreach ($data->result() as $pjb) {
				$data2 .='<tr>
                              <td>'.$i.'</td>
                              <td>'.$pjb->nama.'</td>
                              <td>'.$pjb->jabatan.'</td>
                              <td>'.$pjb->kategori.'</td>
                              <td><img style="width:40px; height:45px;" src="'.base_url().'../File_BMKG/Profil/Pegawai/'.$pjb->gambar.'"></td>
                              <td><button type="button" onClick=editPJB("'.$pjb->nip.'","'.site_url('Informasi/get_pejabatID').'") class="btn btn-round btn-info btn-xs" >Edit</button><br>
                                  <input type="checkbox" name="nip[]" data-nama="hapus" value="'.$pjb->nip.'" > 
                              </td>
                              </tr>';
				# code...
				$i++;
			}
			# code...
		}
		return $data2;
	}

	public function del_pjb($nip){
		$data=$this->db->get_where('pegawai',array('nip'=>$nip));
		foreach ($data->result() as $key) {
			unlink('../File_BMKG/Profil/Pegawai/'.$key->gambar);
			# code...
		}
		$this->db->delete('pegawai',array('nip'=>$nip));
	}

	public function set_pejabat($nama,$jabatan,$kategori,$foto, $tanggal_input){
		$this->db->SELECT('nip');
		$this->db->FROM('pegawai');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->nip,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."PJB".$id;

		$isi=array(
				'nip'=>$id,
				'nama'=>$nama,
				'jabatan'=>$jabatan,
				'kategori'=>$kategori,
				'gambar'=>$foto,
				'tanggal_input'=>$tanggal_input
			);
		return $this->db->insert('pegawai',$isi);
	}

	public function get_pejabatID($id){
		$data2=null;
		$data=$this->db->get_where('pegawai',array('nip'=>$id));
		foreach ($data->result() as $pjb) {
			# code...
			$data2['nomor'] = $id;
			$data2['img']= $pjb->gambar;
			$data2['name']= $pjb->nama;
			$data2['posisi']=$pjb->jabatan;
			$data2['foto']='<img src="'.base_url().'../File_BMKG/Profil/Pegawai/'.$pjb->gambar.'" style="width: 140px; height: 150px;">';
		}
		return $data2;

	}

	public function edit_pejabat($id,$isi){
		
		$this->db->where('nip',$id);
		$this->db->update('pegawai',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}
//profil sejarah,visi & misi, tugas & fungsi, struktur organisasi
	public function profil($jenis){
		$data=$this->db->get_where('umum',array('jenis'=>$jenis));
		$data2=null;
		if ($data->num_rows()>0) {
			$data=$data->result()[0];
			$data2='<tr>
                              <td class="pos-teks "><a class="baca-pdf" href="'.base_url().'../FIle_BMKG/Profil/'.$data->isi.'">Baca file</a></td>
                              <td class="pos-teks">'.$data->nama.'</td>
                              <td class="pos-teks">'.date('d-m-Y H:i:s',strtotime($data->tanggal)).'</td>
                            </tr>
                            <tr>';
			# code...
		}
		return $data2;
	}


	//Berita & Artikel
	public function setBerita($judul,$isi,$penyusun,$tanggal_input){
		$this->db->SELECT('id_berita');
		$this->db->FROM('berita');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();

		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_berita,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."BRT".$id;
		$isi=array(
			'id_berita'=>$id,
			'judul'=>$judul,
			'isi'=>$isi,
			'penyusun'=>$penyusun,
			'tanggal_input'=>$tanggal_input,
			'bulan'=>date('M'),
			'tahun'=>date('Y')			
		);
		
		$this->db->insert('berita',$isi);

		return $id;
	}

	public function getBeritaID($id){
		$data = $this->db->get_where('berita',array('id_berita'=>$id));
		$data2=null;
		if ($data->num_rows()>0) {
			$data=$data->result()[0];
			$data2['judul']=$data->judul;
			$data2['teks']=$data->isi;
			$data=$this->db->get_where('foto',array('tautan'=>$id));
			$data3=null;
			foreach ($data->result() as $ft) {
				# code...
				$data3 .='<div class="col-md-55">
                        <div class="">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Berita/'.$ft->foto.'" alt="image" />
													</div>
													<div class="tools tools-bottom">
                                <input value="'.$ft->foto.'" type="checkbox" name="hapus[]">
                              </div>
                        </div>
                      </div>';
			}
			$data2['foto']=$data3;

		}
		return $data2;
	}

	public function getBerita($waktu,$order){
		//$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIKE('tanggal_input',date('Y-m',strtotime($waktu)));
		$data = $this->db->get('berita');
		$data2['berita']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$news=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1);$l<$data->num_rows();$l++) {
				$data2['berita'] .= '<tr class="even pointer">
								<td class=" ">'.$list.'</td>
								<td class=" ">'.$news[$l]->tanggal_input.'</td>
								<td class=" "><a class="lihat" data-id="'.$news[$l]->id_berita.'" href="'.site_url('Informasi/baca_news').'">'.$news[$l]->judul.'</a></td>
								<td class=" ">'.$news[$l]->penyusun.'.</td>
								<td class=" ">
									<button type="button" onClick=editBRT("'.$news[$l]->id_berita.'","'.site_url('Informasi/get_beritaID').'") class="btn btn-round btn-info btn-xs" >Edit</button><br>
									<input type="checkbox" data-nama="hapus" name="hapus[]" value="'.$news[$l]->id_berita.'">
								</td>
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

	public function del_berita($id){
		$this->db->delete('berita',array('id_berita'=>$id));
		$data = $this->db->get_where('foto',array('tautan'=>$id));
		foreach ($data->result() as $ft) {
			if (file_exists('../File_BMKG/Berita/'.$ft->foto)) {
				unlink('../File_BMKG/Berita/'.$ft->foto);
				# code...
			}
			# code...
		}
		$this->db->delete('foto',array('tautan'=>$id));
	}

	public function edit_berita($id,$judul,$isi){

		$isi=array(
			'judul'=>$judul,
			'isi'=>$isi
		);

		$this->db->where('id_berita',$id);
		$this->db->update('berita',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}

	}

	public function baca_news($id){
		$data2=null;
		$data=$this->db->get_where('berita',array('id_berita'=>$id));
		if ($data->num_rows()>0) {
			$data3=null;
			$data2['berita']=$data->result()[0];
			$data=$this->db->get_where('foto',array('tautan'=>$id));
			foreach ($data->result() as $ft) {
				# code...
				$data3.=	'<div class="col-lg-3 col-md-4 col-xs-6 ">
											<img	class="thumbnail" src="'.base_url('../File_BMKG/Berita/'.$ft->foto).'">
									</div>';
			}
			$data2['foto']=$data3;
			# code...
		}
		return	$data2;
	}

	public function set_artikel($judul, $teks, $pdf, $nama, $tanggal_input){
		$this->db->SELECT('id_art');
		$this->db->FROM('artikel');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();

		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_art,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."ARK".$id;
		$isi=array(
			'id_art'=>$id,
			'judul'=>$judul,
			'isi'=>$teks,
			'pdf'=>$pdf,
			'penyusun'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('artikel',$isi);
	}

	public function get_artikel($waktu){
		$this->db->LIKE('tanggal_input',$waktu);
		$data=$this->db->get('artikel');
		$data2=null;
		$i=1;
		foreach ($data->result() as $key) {
			$data2.='<tr>
						<td>'.$i.'</td>
						<td><a class="baca-artikel" href="'.$key->id_art.'">'.$key->judul.'</a></td>
						<td><a href="'.base_url('../File_BMKG/Artikel/'.$key->pdf).'" class="btn btn-default" download><span class="glyphicon glyphicon-cloud-download"></span></a></td>
						<td>'.$key->penyusun.'</td>
						<td>'.date('d-m-Y',strtotime($key->tanggal_input)).'</td>
						<td>
							<button type="button" value="'.$key->id_art.'" class="btn btn-xs btn-round btn-info get-art">Edit</button>
							<input value="'.$key->id_art.'" type="checkbox" name="hapus[]" data-nama="hapus">
						</td>
					</tr>';
			# code...
			$i++;
		}
		return $data2;
	}

	public function baca_artikel($id){
		$data2=null;
		$data=$this->db->get_where('artikel',array('id_art'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=$key->judul;
			$data2['tambahan']=$key->isi;
			$data2['creator']=$key->penyusun.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
			$data2['pdf']= base_url('../File_BMKG/Artikel/').$key->pdf;
		}
		return json_encode($data2);
	}
	public function get_art($id){
		$data2=null;
		$data = $this->db->get_where('artikel',array('id_art'=>$id));
		foreach ($data->result() as $key) {
			# code...
			$data2['id']=$key->id_art;
			$data2['judul']=$key->judul;
			$data2['ket']=$key->isi;
		}
		return $data2;
	}

	public function edit_artikel($id,$isi){
		$this->db->where('id_art',$id);
		$this->db->update('artikel',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}

	public function del_artikel($id){
		$data=$this->db->get_where('artikel',array('id_art'=>$id));
		foreach ($data->result() as $key) {
			unlink('../File_BMKG/Artikel/'.$key->pdf);
			# code...
		}
		$this->db->delete('artikel',array('id_art'=>$id));
	}

	// Foto
	public function setFoto($foto,$tautan){

		$isi = array(
			'foto'=>$foto,
			'tautan'=>$tautan
		);

		$this->db->insert('foto',$isi);
	}

	public function del_foto($id){
		$this->db->delete('foto',array('foto'=>$id));
		if (file_exists('../File_BMKG/Berita/'.$id)) {
				unlink('../File_BMKG/Berita/'.$id);
				# code...
			}
	}

	public function set_SDM($L,$P,$nama,$tanggal_input){
		$count=count($L);
		$isiL=null;
		$isiP=null;
		$tb=null;
		if ($count==8) {
			$isiL=array('umur_1'=>$L[0],'umur_2'=>$L[1],'umur_3'=>$L[2],'umur_4'=>$L[3],'umur_5'=>$L[4],'umur_6'=>$L[5],'umur_7'=>$L[6],'umur_8'=>$L[7],'nama'=>$nama,'tanggal_input'=>$tanggal_input);
			$isiP=array('umur_1'=>$P[0],'umur_2'=>$P[1],'umur_3'=>$P[2],'umur_4'=>$P[3],'umur_5'=>$P[4],'umur_6'=>$P[5],'umur_7'=>$P[6],'umur_8'=>$P[7],'nama'=>$nama,'tanggal_input'=>$tanggal_input);
			$tb='grafik_umur';
			# code...
		}else if ($count==4) {
			$isiL=array('golongan_1'=>$L[0],'golongan_2'=>$L[1],'golongan_3'=>$L[2],'golongan_4'=>$L[3],'nama'=>$nama,'tanggal_input'=>$tanggal_input);
			$isiP=array('golongan_1'=>$P[0],'golongan_2'=>$P[1],'golongan_3'=>$P[2],'golongan_4'=>$P[3],'nama'=>$nama,'tanggal_input'=>$tanggal_input);
			$tb='grafik_golongan';
			# code...
		}else{
			$isiL=array('sma'=>$L[0],'d1'=>$L[1],'d2'=>$L[2],'d3'=>$L[3],'d4'=>$L[4],'s1'=>$L[5],'s2'=>$L[6],'s3'=>$L[7],'nama'=>$nama,'tanggal_input'=>$tanggal_input);
			$isiP=array('sma'=>$P[0],'d1'=>$P[1],'d2'=>$P[2],'d3'=>$P[3],'d4'=>$P[4],'s1'=>$P[5],'s2'=>$P[6],'s3'=>$P[7],'nama'=>$nama,'tanggal_input'=>$tanggal_input);

			$tb='grafik_pendidikan';

		}


		$this->db->where('jenis_kelamin','L');
		$this->db->update($tb,$isiL);
		$cek=$this->db->affected_rows();
		$this->db->where('jenis_kelamin','P');
		$this->db->update($tb,$isiP);
		$cek2=$this->db->affected_rows()>0;
		if ($cek>0&&$cek2>0) {
			# code...
			return 2;
		}
	}

	public function get_SDM(){
		$bulan=array('01'=>'Januari','02'=>'Februari','o3'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$jk=array('L'=>'Pria','P'=>'Wanita');
		$data3=null;
		$data2=null;
		$data=$this->db->get('grafik_umur')->result();
		foreach ($data as $data) {
			$data3 .='<tr>
					  <td>'.$jk[$data->jenis_kelamin].'</td>
					  <td>'.$data->umur_1.'</td>
                      <td>'.$data->umur_2.'</td>
                      <td>'.$data->umur_3.'</td>
                      <td>'.$data->umur_4.'</td>
                      <td>'.$data->umur_5.'</td>
                      <td>'.$data->umur_6.'</td>
                      <td>'.$data->umur_7.'</td>
                      <td>'.$data->umur_8.'</td>
                      </tr>';
            $data2[$data->jenis_kelamin.'-umur']=$data->umur_1.','.$data->umur_2.','.$data->umur_3.','.$data->umur_4.','.$data->umur_5.','.$data->umur_6.','.$data->umur_7.','.$data->umur_8;
			# code...
		}
		$data2['umur']=$data3;
		$data2['bulan_umur']=$bulan[date('m',strtotime($data->tanggal_input))].' '.date('Y',strtotime($data->tanggal_input));
		$data2['tgl_umur']=$data->tanggal_input;
		$data2['petugas_umur']=$data->nama;

		$data3=null;
		$data=$this->db->get('grafik_golongan')->result();
		foreach ($data as $data) {
			$data3 .='<tr>
					  <td>'.$jk[$data->jenis_kelamin].'</td>
					  <td>'.$data->golongan_1.'</td>
                      <td>'.$data->golongan_2.'</td>
                      <td>'.$data->golongan_3.'</td>
                      <td>'.$data->golongan_4.'</td>
                      </tr>';
            $data2[$data->jenis_kelamin.'-golongan']=$data->golongan_1.','.$data->golongan_2.','.$data->golongan_3.','.$data->golongan_4;
			# code...
		}
		$data2['golongan']=$data3;
		$data2['bulan_golongan']=$bulan[date('m',strtotime($data->tanggal_input))].' '.date('Y',strtotime($data->tanggal_input));
		$data2['tgl_golongan']=$data->tanggal_input;
		$data2['petugas_golongan']=$data->nama;
		$data3=null;
		$data=$this->db->get('grafik_pendidikan')->result();
		foreach ($data as $data) {
			$data3 .='<tr>
					  <td>'.$jk[$data->jenis_kelamin].'</td>
					  <td>'.$data->sma.'</td>
                      <td>'.$data->d1.'</td>
                      <td>'.$data->d2.'</td>
                      <td>'.$data->d3.'</td>
                      <td>'.$data->d4.'</td>
                      <td>'.$data->s1.'</td>
                      <td>'.$data->s2.'</td>
                      <td>'.$data->s3.'</td>
                      </tr>';
            $data2[$data->jenis_kelamin.'-akademik']=$data->sma.','.$data->d1.','.$data->d2.','.$data->d3.','.$data->d4.','.$data->s1.','.$data->s2.','.$data->s3;
			# code...
		}
		$data2['akademik']=$data3;
		$data2['bulan_akademik']=$bulan[date('m',strtotime($data->tanggal_input))].' '.date('Y',strtotime($data->tanggal_input));
		$data2['tgl_akademik']=$data->tanggal_input;
		$data2['petugas_akademik']=$data->nama;
		# code...

		return $data2;
	}

	public function set_profil($isi,$type,$nama,$tanggal_input){
		$data=$this->db->get_where('umum',array('jenis'=>$type))->result();
		if (file_exists('../File_BMKG/Profil/'.$data[0]->isi)) {
			# code...
			unlink('../File_BMKG/Profil/'.$data[0]->isi);
		}
		$this->db->where('jenis',$type);
		$this->db->update('umum',array('isi'=>$isi,'nama'=>$nama,'tanggal'=>$tanggal_input));

	}

}