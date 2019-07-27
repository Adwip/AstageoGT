<?php

/**
 * 
 */
class Gempa_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database('aktifitas_alam');
		$this->load->library('Pemisah_angka');
	}
	//year(tanggal_input)
	public function tahun($tabel,$tahun, $kolom){
		$this->db->SELECT($kolom.' AS tahun');
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

	public function get_gempa($status,$order){
		$data=null;
		if ($status=='*') {
			# code...
			$this->db->ORDER_BY('tanggal_input','DESC');
			$data=$this->db->get('gempa');
		}else if ($status!='*') {
			$this->db->LIKE('status_rasa',$status);
			$this->db->ORDER_BY('tanggal_input','DESC');
			$data=$this->db->get('gempa');
			# code...
		}
		$data2['get_gempa']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$gempa=$data->result();
		for($l=($order-1); $l<$data->num_rows();$l++) {
			$data2['get_gempa'].= '<tr>
                            <td>'.$list.'</td>
                            <td>'.date('d-m-Y H:i:s',strtotime($gempa[$l]->waktu_terjadi)).' WIB</td>
                            <td>'.$gempa[$l]->lintang.' '.$gempa[$l]->arah_lintang.'</td>
                            <td>'.$gempa[$l]->bujur.' '.$gempa[$l]->arah_bujur.'</td>
                            <td>'.$gempa[$l]->magnitudo.'</td>
                            <td>'.$gempa[$l]->kedalaman.' Km</td>
                            <td>'.$gempa[$l]->jarak.' Km '.$gempa[$l]->arah.' '.$gempa[$l]->wilayah.'</td>
                            <td>'.$gempa[$l]->status_rasa.'</td>
                            <td>'.$gempa[$l]->potensi.'</td>
                            <td>
								<button onClick=edit_gempa("'.$gempa[$l]->id_gmp.'","'.site_url('Aktlam/get_gempa_ID').'") type="button" class="btn btn-round btn-xs btn-info" >Edit</button>
								<button type="button" class="btn btn-round btn-xs btn-success v-gempa" data-id="'.$gempa[$l]->id_gmp.'" >Baca</button>
								<br>
								<input value="'.$gempa[$l]->id_gmp.'" type="checkbox" name="hapus[]" data-nama="hapus" ></td>
                          </tr>';
			# code...
			$i++;
			$list++;
			if ($i==5) {
				break;
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

	public function get_gempa_v($id){
		$data2=null;
		$data = $this->db->get_where('gempa',array('id_gmp'=>$id));
		foreach ($data->result() as $gempa) {
			$data2['wilayah'] = $gempa->jarak.' Km '.$gempa->arah.' '.$gempa->wilayah;
			$data2['waktu'] = date('d-m-Y H:i:s',strtotime($gempa->waktu_terjadi));
			$data2['mag']=$gempa->magnitudo;
			$data2['koor']=$gempa->lintang.' '.$gempa->arah_lintang.' || '.$gempa->bujur.' '.$gempa->arah_bujur;
			$data2['rasa'] = $gempa->status_rasa;
			$data2['dalam']=$gempa->kedalaman;
			$data2['lok']=$gempa->lokasi;
			$data2['tsun']=$gempa->potensi;
			$data2['mmi']=$gempa->skala_mmi;
			$data2['ket']=$gempa->keterangan;
			$data2['mmi']=$gempa->skala_mmi;
			$data2['tambahan']=$gempa->nama.' || '.$gempa->tanggal_input;
			$data2['gambar']=null;
			if ($gempa->gambar!=null) {
				$data2['gambar']='<img width="300" height="300"  src="'.base_url('../File_BMKG/Gempa/'.$gempa->gambar).'" alt="gempa bumi">';
			}
			
			# code...
		}
		return $data2;
	}

	public function get_gempa_ID($id){
		$data=$this->db->get_where('gempa',array('id_gmp'=>$id));

		if ($data->num_rows()>0) {
			$tanggal=date('d-m-Y',strtotime($data->result()[0]->waktu_terjadi));
			$waktu=date('H:i:s',strtotime($data->result()[0]->waktu_terjadi));

			$data2['gempa']=$data->result()[0];
			$data2['tanggal']=$tanggal;
			$data2['waktu']=$waktu;

			return $data2;
			# code...
		}else{
			return	null;
		}

		

		
	}

	public function set_gempa($wilayah, $waktu_terjadi, $lintang, $bujur, $magnitudo, $kedalaman, $status_rasa, $lokasi, $jarak, $arah,  $potensi, $gambar,$ket, $mmi, $arah_bujur, $arah_lintang, $nama, $tanggal_input){

		$this->db->SELECT('id_gmp');
		$this->db->FROM('gempa');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_gmp,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'GMP'.$id;
		$isi=array(
			'id_gmp'=>$id,
			'wilayah'=>$wilayah,
			'waktu_terjadi'=>$waktu_terjadi,
			'lintang'=>$lintang,
			'bujur'=>$bujur,
			'arah_lintang'=>$arah_lintang,
			'arah_bujur'=>$arah_bujur,
			'magnitudo'=>$magnitudo,
			'kedalaman'=>$kedalaman,
			'status_rasa'=>$status_rasa,
			'lokasi'=>$lokasi,
			'jarak'=>$jarak,
			'arah'=>$arah,
			'potensi'=>$potensi,
			'gambar'=>$gambar,
			'keterangan'=>$ket,
			'skala_mmi'=>$mmi,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return	$this->db->insert('gempa',$isi);

	}

	public function del_gempa($id){
		$data=$this->db->get_where('gempa',array('id_gmp'=>$id));
		$this->db->delete('gempa',array('id_gmp'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data->result() as $key) {
				if (file_exists('../File_BMKG/Gempa/'.$key->gambar)) {
					unlink('../File_BMKG/Gempa/'.$key->gambar);
				}
			}
			return 1;
		}
	}

	public function edit_gempa($id,$isi){
		if (isset($isi['gambar'])) {
			$data=$this->db->get_where('gempa',array('id_gmp'=>$id));
			foreach ($data->result() as $key) {
				unlink('../File_BMKG/Gempa/'.$key->gambar);
			}
		}
		$this->db->where('id_gmp',$id);
		$this->db->update('gempa',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}
/*
	public function get_tsunami($tahun){
		$data=null;
		if ($tahun=='*') {
			$data = $this->db->get('tsunami');
			# code...
		}else{
			$this->db->LIKE('waktu_terjadi',$tahun);
			$data=$this->db->get('tsunami');
		}
		$data2=null;
		$i=1;
		foreach ($data->result() as $key => $tsu) {
			$data2.='<tr>
                            <td>'.$i.'</td>
                            <td>'.date('d-m-Y H:i:s',strtotime($tsu->waktu_terjadi)).' WIB</td>
                            <td>'.$tsu->magnitudo.'</td>
                            <td>'.$tsu->kedalaman.'</td>
                            <td>'.$tsu->jarak.' Km '.$tsu->mata_angin.' '.$tsu->wilayah.'</td>
                            <td><a href="'.$tsu->id_tsu.'">Edit</a><br><input value="'.$tsu->id_tsu.'" type="checkbox" name="hapus[]" data-nama="hapus" ></td>
                          </tr>';
			# code...
			$i++;
		}
		return $data2;
	}

	public function set_tsunami($wilayah, $waktu_terjadi, $lintang, $bujur, $magnitudo, $kedalaman, $jarak, $mata_angin, $gambar, $arah_bujur, $arah_lintang, $nama, $tanggal_input){

		$this->db->SELECT('id_tsu');
		$this->db->FROM('tsunami');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_tsu,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'TSU'.$id;
		$isi=array(
			'id_tsu'=>$id,
			'wilayah'=>$wilayah,
			'waktu_terjadi'=>$waktu_terjadi,
			'lintang'=>$lintang,
			'bujur'=>$bujur,
			'arah_lintang'=>$arah_lintang,
			'arah_bujur'=>$arah_bujur,
			'magnitudo'=>$magnitudo,
			'kedalaman'=>$kedalaman,
			'jarak'=>$jarak,
			'mata_angin'=>$mata_angin,
			'gambar'=>$gambar,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return	$this->db->insert('tsunami',$isi);

	}

	public function del_tsunami($id){
		$this->db->delete('tsunami',array('id_tsu'=>$id));
	}
	#non aktif
	public function get_ttm2($tanggal){
		$wilayah = array('Yogyakarta', 'Sleman','Bantul','Kulonprogo','Gunungkidul');
		$data2=null;
		for ($i=0; $i < 5; $i++) { 
			$data=$this->db->get_where('terbit_terb_mat',array('tanggal_ttm'=>$tanggal,'kota'=>$wilayah[$i]));
			if ($data->num_rows()>0) {
				# code...
				$data=$data->result()[0];
				$data2.='<tr class="">
                            <td><strong>'.$wilayah[$i].'</strong></td>
                            <td class="pos-teks">'.$data->waktu_fajar.'</td>
                            <td class="pos-teks">'.$data->waktu_terbit.'</td>
                            <td class="pos-teks">'.$data->azimuth_terbit.'</td>
                            <td class="pos-teks">'.$data->waktu_transit.'</td>
                            <td class="pos-teks">'.$data->tinggi_transit.' '.$data->arah_trans.'</td>
                            <td class="pos-teks">'.$data->waktu_terbenam.'</td>
                            <td class="pos-teks">'.$data->azimuth_terbenam.'</td>
                            <td class="pos-teks">'.$data->waktu_senja.'</td>
                            <td class="pos-teks">
                                  <button onClick=edit_ttm("'.$data->id_Ttm.'") type="button" data-id="'.$data->id_Ttm.'" class="btn btn-round btn-info btn-xs" >Edit</button><br>
                                  <input value="'.$data->id_Ttm.'" type="checkbox" name="hapus[]" data-nama="hapus">
                            </td>
                          </tr>';
			}else{
				$data2.='<tr class="">
                            <td><strong>'.$wilayah[$i].'</strong></td>
                            <td class="pos-teks"></td>
                            <td class="pos-teks"><strong>Data</strong></td>
                            <td class="pos-teks"></td>
                            <td class="pos-teks"><strong>Masih</strong></td>
                            <td class="pos-teks"></td>
                            <td class="pos-teks"><strong>Kosong</strong></td>
                            <td class="pos-teks"></td>
                            <td class="pos-teks"></td>
                            <td class="pos-teks">
                            	<button type="button" class="btn btn-round btn-success btn-xs" onClick=tambah_ttm("'.$wilayah[$i].'","'.$tanggal.'")>Tambah</button>
                            </td>
                          </tr>';
			}

			# code...
		}
		return $data2;
	}
*/
	public function set_TerbitTM($wilayah,$tanggal,$waktu_fajar,$waktu_terbit,$azimut_terbit,$waktu_transit,$tinggi_transit,$waktu_terbenam,$azimuth_terbenam,$waktu_senja,$nama,$tanggal_input){

		$this->db->SELECT('id_Ttm');
		$this->db->FROM('terbit_terb_mat');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_Ttm,11); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}

		$isi=array(
			'id_Ttm'=>date('dmy').'TTM'.$id,
			'tanggal_ttm'=>$tanggal,
			'kota'=>$wilayah,
			'waktu_fajar'=>$waktu_fajar,
			'waktu_terbit'=>$waktu_terbit,
			'azimuth_terbit'=>$azimut_terbit,
			'waktu_transit'=>$waktu_transit,
			'tinggi_transit'=>$tinggi_transit,
			'waktu_terbenam'=>$waktu_terbenam,
			'azimuth_terbenam'=>$azimuth_terbenam,
			'waktu_senja'=>$waktu_senja,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return	$this->db->insert('terbit_terb_mat',$isi);
	}

	public function set_ttm($wilayah,$file,$bulan,$tahun,$nama,$tanggal_input){
		$this->db->SELECT('id_ttm');
		$this->db->FROM('ttm');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_ttm,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'TTM'.$id;
		$isi=array(
			'id_ttm'=>$id,
			'wilayah'=>$wilayah,
			'pdf'=>$file,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('ttm',$isi);
	}

	public function get_ttm($bulan, $tahun){
		$bln=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$kota= array('Yogyakarta','Sleman','Bantul','Kulonprogo','Gunungkidul');
		$data2=null;
		foreach ($kota as $kt) {
			$data=$this->db->get_where('ttm',array('bulan'=>$bln[$bulan],'tahun'=>$tahun,'wilayah'=>$kt));
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				$data2.='<tr>
                            <td class="pos-teks">'.$kt.'</td>
                            <td class="pos-teks"><button type="button" class="btn btn-xs btn-warning baca-ttm" value="'.base_url('../File_BMKG/TTM/').$data->pdf.'">Baca</button></button></td>
                            <td class="pos-teks">'.$data->nama.'</td>
                            <td class="pos-teks">'.date('d-m-Y H:i:s',strtotime($data->tanggal_input)).'</td>
                            <td class="pos-teks"><input type="checkbox" name="hapus[]" value="'.$data->id_ttm.'" data-nama="hapus" >
                            </td>
                          </tr>';
				# code...
			}else{
				$data2.='<tr>
                            <td class="pos-teks">'.$kt.'</td>
                            <td class="pos-teks">Dokumen belum ada</td>
                            <td class="pos-teks">-</td>
                            <td class="pos-teks">-</td>
                            <td class="pos-teks"><button type="button" onclick=set_ttm("'.$bln[$bulan].'","'.$tahun.'","'.$kt.'") class="btn btn-xs btn-round btn-info">Tambah</button>
                            </td>
                          </tr>';
			}
			# code...
		}
		return $data2;
	}

	public function del_ttm($id){
		$data=$this->db->get_where('ttm',array('id_ttm'=>$id));
		$this->db->delete('ttm',array('id_ttm'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data->result() as $key) {
				unlink('../File_BMKG/TTM/'.$key->pdf);
			}
			return 1;
		}
	}

	public function get_petir($tahun){
		$bulan=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$data2=null;
			foreach ($bulan as $bln) {
				$data=$this->db->get_where('sambaran_petir',array('bulan'=>$bln,'tahun'=>$tahun));
				if ($data->num_rows()==0) {
					$data2.='<tr>
	                          <td>'.$bln.'</td>
	                          <td>Sambaran</td>
	                          <td>petir</td>
	                          <td>belum</td>
	                          <td>ada</td>
	                          <td></td>
	                          <td>
	                          	<button onclick=set_ptr("'.$bln.'","'.$tahun.'") class="btn btn-round btn-xs btn-primary req_ptr_id">Tambah</button>
	                          </td>
	                        </tr>';
					# code...
				}else{
					$data=$data->result()[0];
					$petir['sbr']='Data belum ada';
					$petir['rpt']='Data belum ada';
					if ($data->sambaran!=null) {
						# code...
						//$petir['sbr']='<a target="_blank" href="'.base_url('../File_BMKG/Sam_petir/').$data->sambaran.'">Lihat sambaran  petir</a>';
						$petir['sbr']='<button type="button" value="'.$data->sambaran.'" class="btn btn-xs btn-warning cek_g_ptr">Gambar</button>';
					}
					if ($data->kerapatan!=null) {
						# code...
						//$petir['rpt']='<a target="_blank" href="'.base_url('../File_BMKG/Sam_petir/').$data->kerapatan.'">Lihat kerapatan petir</a>';
						$petir['rpt']='<button type="button" value="'.$data->kerapatan.'" class="btn btn-xs btn-warning cek_g_ptr">Gambar</button>';
					}
					$data2 .='<tr>
	                          <td>'.$bln.'</td>
	                          <td>'.$data->judul.'</td>
	                          <td>'.$petir['rpt'].'</td>
	                          <td>'.$petir['sbr'].'</td>
	                          <td>'.$data->nama.'</td>
	                          <td>'.date('d-m-Y',strtotime($data->tanggal_input)).'</td>
	                          <td><button data-link="'.base_url('../File_BMKG/Sam_petir/').'" value="'.$data->id_spt.'" class="btn btn-round btn-xs btn-info req_ptr_id">Edit</button>
							      <input value="'.$data->id_spt.'" type="checkbox" name="hapus[]" data-nama="hapus">
							  </td>
	                        </tr>';
				}
			}
			return $data2;
	}

	public function set_petir($judul, $ket, $bulan, $tahun, $rapat, $sambar, $nama, $tanggal){
		$this->db->SELECT('id_spt');
		$this->db->FROM('sambaran_petir');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_spt,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'SPT'.$id;
		$isi=array(
			'id_spt'=>$id,
			'judul'=>$judul,
			'keterangan'=>$ket,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'sambaran'=>$sambar,
			'kerapatan'=>$rapat,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal
		);

		return $this->db->insert('sambaran_petir',$isi);

	}

	public function del_petir($id){
		$data=$this->db->get_where('sambaran_petir',array('id_spt'=>$id));
		$this->db->delete('sambaran_petir',array('id_spt'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data->result() as $key) {
				unlink('../File_BMKG/Sam_petir/'.$key->sambaran);
				unlink('../File_BMKG/Sam_petir/'.$key->kerapatan);
			}
			return 1;
		}
		
	}

	public function get_ptr_edit($id){
		$data2=null;
		$data=$this->db->get_where('sambaran_petir',array('id_spt'=>$id));
		foreach ($data->result() as $key) {
			# code...
			$data2['bulan']=$key->bulan;
			$data2['tahun']=$key->tahun;
			$data2['judul']=$key->judul;
			$data2['ket']=$key->keterangan;
			$data2['kerapatan']=$key->kerapatan;
			$data2['sambaran']=$key->sambaran;
		}
		return json_encode($data2);
	}


	public function set_foto($jenis,$foto,$link){

	}

	public function edit_petir($bulan,$tahun,$isi){
		$tabel=array('kerapatan','sambaran');
		$data=$this->db->get_where('sambaran_petir',array('bulan'=>$bulan,'tahun'=>$tahun))->result_array();
		for ($i=0; $i < 2; $i++) { 
			if (isset($isi[$tabel[$i]])) {
				unlink('../File_BMKG/Sam_petir/'.$data[0][$tabel[$i]]);
			}
		}
		$this->db->where('bulan',$bulan);
		$this->db->where('tahun',$tahun);
		$this->db->update('sambaran_petir',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

}