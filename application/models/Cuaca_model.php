<?php
class Cuaca_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database('cuaca_iklim');
		$this->load->library('Pemisah_angka');
	}
//Cuaca harian

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

	public function tahun_eks($tabel,$kolom,$tahun){
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

	public function get_cuaca($tanggal){
		//$hari=array();
		$wilayah = array('Yogyakarta', 'Sleman','Bantul','Kulonprogo','Gunungkidul');
		$waktu = array('cuaca_harian_pagi','cuaca_harian_siang','cuaca_harian_malam','cuaca_harian_dinihari');
		$waktu2=array('Pagi','Siang','Malam','Dinihari');
		$data2=null;
		$data4 =null;
		$data3=null;
		$data4['tanggal']=$tanggal;
		$cuaca=array('Cerah'=>'cerah-am.png','Berawan'=>'berawan-am.png','Udara kabur'=>'berawan tebal-pm.png','Kabut'=>'kabut-am.png','Cerah berawan'=>'cerah berawan-am.png','Hujan ringan'=>'hujan ringan-am.png','Hujan lebat'=>'hujan lebat-am.png','Hujan petir'=>'hujan petir-am.png','Hujan lokal'=>'hujan lokal-am.png','Hujan sedang'=>'hujan sedang-am.png');
		for ($i=0; $i < 5; $i++) { 
			$data4[$wilayah[$i]]=null;
			for ($j=0; $j < 4; $j++) { 
				$data = $this->db->get_where($waktu[$j],array('Wilayah'=>$wilayah[$i],'Tanggal'=>$tanggal));
				if ($data->num_rows()>0) {
					$cuaca=$data->result()[0];

					$data2 [$waktu[$j]]= '<td class="pos-teks">
                              	<div class="weather-icon">
                                	<!--<canvas height="25" width="2S" class="'.$data3.'"></canvas>-->
                                	<h5>'.$cuaca->Jenis.'</h5>
                                	<h5> '.$cuaca->suhu_maks.' &#8451; || '.$cuaca->kelembapan_maks.'%</h5>
                              	</div>
                              	<button onClick=edit_cuaca("'.$cuaca->id_cuhar.'","'.site_url('Cuaca/get_cuaca_ID').'","'.$waktu2[$j].'") type="button" class="btn btn-round btn-info btn-xs" >Edit</button> 
                              	<button onClick=cek_cuaca("'.$cuaca->id_cuhar.'","'.site_url('Cuaca/get_view_cuaca').'","'.$waktu2[$j].'") type="button" class="btn btn-round btn-warning btn-xs" >Lihat</button> 
                              	<input type="checkbox" name="hapus[]" data-nama="hapus" value="'.$cuaca->id_cuhar.'"  />
                            	</td>';
					# code...
				}else{
					$data2 [$waktu[$j]]= '<td class="pos-teks" >Data masih Kosong <br>
						<button onClick= cuaca("'.$wilayah[$i].'","'.date('d-m-Y',strtotime($tanggal)).'","'.$waktu2[$j].'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button></td>';
				}
				# code...
			}
			# code...
			$data4[$wilayah[$i]] = $data2;
		}
		return $data4;
	}

	public function del_cuaca($id){
		$data=$this->pemisah_angka->Pisah($id);
		$tb=null;
		if ($data['huruf']=="CHP") {
			# code...
			$tb='cuaca_harian_pagi';
		}else if ($data['huruf']=="CHS") {
			$tb='cuaca_harian_siang';
			# code...
		}else if ($data['huruf']=="CHM") {
			$tb='cuaca_harian_malam';
			# code...
		}
		else if ($data['huruf']=="CHD") {
			$tb='cuaca_harian_dinihari';
			# code...
		}
		$this->db->delete($tb, array('id_cuhar'=>$id));
		if ($this->db->affected_rows()==1) {
			return 1;
		}
	}

	public function set_cuaca($wilayah, $tanggal, $tabel, $cuaca, $arah, $suhu_min, $suhu_maks, $kelembapan_maks, $kelembapan_min,$petugas,$tanggal_input,$ids){

		$waktu = array('Pagi'=>'cuaca_harian_pagi','Siang'=>'cuaca_harian_siang','Malam'=>'cuaca_harian_malam','Dinihari'=>'cuaca_harian_dinihari');

		$this->db->SELECT('id_cuhar');
		$this->db->FROM($waktu[$tabel]);
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_cuhar,7); 
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').$ids.$id;

		$isi=array(
			'id_cuhar'=>$id,
			'Tanggal'=>$tanggal,
			'Wilayah'=>$wilayah,
			'Jenis'=>$cuaca,
			'arah_angin'=>$arah,
			'suhu_min'=>$suhu_min,
			'suhu_maks'=>$suhu_maks,
			'kelembapan_min'=>$kelembapan_min,
			'kelembapan_maks'=>$kelembapan_maks,
			'nama'=>$petugas,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert($waktu[$tabel],$isi);

	}

	public function get_cuaca_ID($id){
		$data=$this->pemisah_angka->Pisah($id);
		$tb=null;
		if ($data['huruf']=="CHP") {
			# code...
			$tb='cuaca_harian_pagi';
		}else if ($data['huruf']=="CHS") {
			$tb='cuaca_harian_siang';
			# code...
		}else if ($data['huruf']=="CHM") {
			$tb='cuaca_harian_malam';
			# code...
		}
		else if ($data['huruf']=="CHD") {
			$tb='cuaca_harian_dinihari';
			# code...
		}
		$data=$this->db->get_where($tb,array('id_cuhar'=>$id));
		if ($data->num_rows()>0) {
			return $data->result()[0];
			# code...
		}else{
			return null;
		}
		# code...
	}

	public function get_view_cuaca($id){
		$data=$this->pemisah_angka->Pisah($id);
		$cuaca2=array('Cerah'=>'cerah-am.png','Berawan'=>'berawan-am.png','Udara kabur'=>'berawan tebal-pm.png','Kabut'=>'kabut-am.png','Cerah berawan'=>'cerah berawan-am.png','Hujan ringan'=>'hujan ringan-am.png','Hujan lebat'=>'hujan lebat-am.png','Hujan petir'=>'hujan petir-am.png','Hujan lokal'=>'hujan lokal-am.png','Hujan sedang'=>'hujan sedang-am.png','Panas'=>'cerah-am.png');
		
		$tabel=array('CHP'=>'cuaca_harian_pagi','CHS'=>'cuaca_harian_siang','CHM'=>'cuaca_harian_malam','CHD'=>'cuaca_harian_dinihari');

		$angin=array('North (Utara)'=>'wi-towards-n','NNE'=>'wi-towards-nne','NE (Timur Laut)'=>'wi-towards-ne','ENE'=>'wi-towards-ene','East (Timur)'=>'wi-towards-e','ESE'=>'wi-towards-ese','SE (Tenggara)'=>'wi-towards-se','SSE'=>'wi-towards-sse','South (Selatan)'=>'wi-towards-s','SSW'=>'wi-towards-ssw','SW (Baratdaya)'=>'wi-towards-sw','WSW'=>'wi-towards-ene','West (Barat)'=>'wi-towards-w','WNW'=>'wi-towards-wnw','NW (Baratlaut)'=>'wi-towards-nw','NNW'=>'wi-towards-nnw');
		$data2=null;
		$data=$this->db->get_where($tabel[$data['huruf']],array('id_cuhar'=>$id));

		if ($data->num_rows()!=0) {
			$data=$data->result()[0];
			$data2['cuaca']= ' <img width="75" height="75" src="'.base_url().'../File_BMKG/Cuaca/icon_cuaca/'.$cuaca2[$data->Jenis].'" style="margin:0px 0px 0px 50px;"><br><h3>'.$data->Jenis.'</h3>';

			/*'<h1><i class="wi '.$cuaca[$data->Jenis].'"></i></h1>
                            <h1>'.$data->Jenis.'</h1>';*/
            $data2['suhu']='<ul class="quick-list">
            					<li><label>Suhu </label></li>
                                <li class="fa fa-level-down"> Suhu minimal: '.$data->suhu_min.'&#8451;</li><br>
                                <li class="fa fa-level-up"> Suhu maksimal: '.$data->suhu_maks.' &#8451;</li>
                              </ul>';
            $data2['lembap']='<ul class="quick-list">
            					<li><label>Kelembapan</label></li>
                                <li class="fa fa-level-down"> Kelembapan minimal: '.$data->kelembapan_min.' %</li><br>
                                <li class="fa fa-level-up"> Kelembapan maksimal: '.$data->kelembapan_maks.' %</li>
                              </ul>';
            $data2['wilayah']='<label>Wilayah</label><br>
                      				  <h3>'.$data->Wilayah.'</h3>';
            $data2['tanggal']='<label>Tanggal</label><br>
                        		<h3>'.date('d-m-Y',strtotime($data->Tanggal)).'</h3>';
                    
            $data2['angin']='<label id="angin">Arah angin</label><br>
                          <h1> <li class="wi wi-wind '.$angin[$data->arah_angin].'"></li> '.$data->arah_angin.'</h1>';
            $data2['petugas']='<label>Petugas</label>
                          <h4>'.$data->nama.'</h4>';
            $data2['tanggal_input']='<label>Tanggal dibuat</label>
                          <h4>'.date('d-m-Y H:i:s',strtotime($data->tanggal_input)).'</h4>';
			# code...
		}
		return $data2;
	}

	public function edit_cuaca($id, $tabel, $cuaca, $arah, $suhu_min, $suhu_maks, $kelembapan_maks, $kelembapan_min){

		$isi=array(
			'Jenis'=>$cuaca,
			'arah_angin'=>$arah,
			'suhu_min'=>$suhu_min,
			'suhu_maks'=>$suhu_maks,
			'kelembapan_min'=>$kelembapan_min,
			'kelembapan_maks'=>$kelembapan_maks
		);

		$this->db->where('id_cuhar',$id);
		$this->db->update($tabel,$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

//cuaca mingguan & bulanan
	public function getCuming($tanggal){

		$this->db->LIKE('tanggal_awal',$tanggal);
		$this->db->ORDER_BY('tanggal_akhir','ASC');
		$data = $this->db->get('cuaca_mingguan');
		$i=null;
		$data2=null;
		if ($data->num_rows()>0) {
			$i=1;
			$data=$data->result();
			foreach ($data as $cuming) {
				$data2 .= '<tr class="even pointer">
                            <td class=" ">'.$i.'</td>
                            <td class=" ">'.date('d-m-Y',strtotime($cuming->tanggal_awal)).'</td>
                            <td class=" ">'.date('d-m-Y',strtotime($cuming->tanggal_akhir)).'</td>
                            <td class=" ">'.$cuming->nama.'</td>
                            <td class=" "><a data-ex="show" class="prevent" href="'.base_url().'../File_BMKG/Iklim/Cuaca_mingguan/'.$cuming->PDF.'">View</a></td>
                            <td class=" ">'.date('d-m-Y H:i:s',strtotime($cuming->tanggal_input)).'</td>
                            <td>
                            <button class="btn btn-round btn-xs btn-info edit-req-cuming" value="'.$cuming->id_cuming.'">Edit</button>
                            <br>
                              <input data-nama="hapus" value="'.$cuming->id_cuming.'" type="checkbox" name="hapus[]">
                            </td>
                          </tr>';
			# code...
            $i++;
			}
			$data=end($data);
			if (date('Y-m',strtotime($data->tanggal_akhir.'+1 days'))==$tanggal) {
				$data2.='<tr class="even pointer">
                            <td class=" ">'.$i.'</td>
                            <td class=" ">'.date('d-m-Y',strtotime($data->tanggal_akhir.'+1 days')).'</td>
                            <td class=" ">Data</td>
                            <td class=" ">Masih</td>
                            <td class=" ">Kosong</td>
                            <td class=" "></td>
                            <td class="last"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.date('d-m-Y',strtotime($data->tanggal_akhir.'+1 days')).'" >Tambah</button>
                            </td>
                          </tr>';
				# code...
			}

			return $data2;	
		}else{
			$data=$this->db->query('SELECT DATE_ADD(tanggal_akhir, INTERVAL 1 DAY) AS tanggal from cuaca_mingguan ORDER BY tanggal_akhir DESC LIMIT 1');
			//$tanggal_awal=date('d-m-Y',strtotime($tanggal));
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				if (date('Y-m',strtotime($data->tanggal))==$tanggal) {
					# code...
					$data=date('d-m-Y',strtotime($data->tanggal));
					$data2.='<tr class="even pointer">
                            <td class=" ">'.$i.'</td>
                            <td class=" ">'.$data.'</td>
                            <td class=" ">Data</td>
                            <td class=" ">Masih</td>
                            <td class=" ">Kosong</td>
                            <td class=" "></td>
                            <td class="last"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.$data.'" >Tambah</button>
                            </td>
                          </tr>';
				}
				
                return $data2;
			}else{
				return $data2='<tr class="even pointer">
		                            <td class=" ">'.$i.'</td>
		                            <td class=" ">'.date('d').date('-m-Y',strtotime($tanggal)).'</td>
		                            <td class=" ">Data</td>
		                            <td class=" ">Masih</td>
		                            <td class=" ">Kosong</td>
		                            <td class=" "></td>
		                            <td class="last"><button type="button" value="'.date('d').date('-m-Y',strtotime($tanggal)).'" class="btn btn-round btn-success btn-xs tambah" value="" >Tambah</button>
		                            </td>
		                        </tr>';
			}

			
		}		
	}

	public function set_cuming($tanggal_awal,$tanggal_akhir,$pdf,$petugas,$tanggal_input){
		$this->db->SELECT('id_cuming');
		$this->db->ORDER_BY('tanggal_akhir','DESC');
		$seq=$this->db->get('cuaca_mingguan');
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_cuming,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."CMG".$id;

		$isi=array(
			'id_cuming'=>$id,
			'PDF'=>$pdf,
			'tanggal_awal'=>date('Y-m-d',strtotime($tanggal_awal)),
			'tanggal_akhir'=>date('Y-m-d',strtotime($tanggal_akhir)),
			'nama'=>$petugas,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('cuaca_mingguan',$isi);
	}

	public function get_cuming_id($id){
		$data= $this->db->get_where('cuaca_mingguan',array('id_cuming'=>$id))->result()[0];
		$data2=null;
		if ($data!=null) {
			$data2['tanggal_mulai']=date('d-m-Y',strtotime($data->tanggal_awal));
			$data2['tanggal_akhir']=date('d-m-Y',strtotime($data->tanggal_akhir));
			$data2['id']=$data->id_cuming;
			# code...
		}
		return $data2;

	}

	public function del_cuming($id){
		$data=$this->db->get_where('cuaca_mingguan',array('id_cuming'=>$id))->result();
		$this->db->delete('cuaca_mingguan',array('id_cuming'=>$id));
		if ($this->db->affected_rows()==1&&isset($data[0])) {
			if (file_exists('../File_BMKG/Iklim/Cuaca_mingguan/'.$data[0]->PDF)) {
				# code...
				unlink('../File_BMKG/Iklim/Cuaca_mingguan/'.$data[0]->PDF);
			}
			return 1;
		}
		
		
	}

	public function edit_cuming($id,$tanggal_mulai, $tanggal_akhir, $pdf=null){
		$isi=array('tanggal_awal'=>$tanggal_mulai,'tanggal_akhir'=>$tanggal_akhir);
		if ($pdf!=null) {
			$data=$this->db->get_where('cuaca_mingguan',array('id_cuming'=>$id));
			foreach ($data->result() as $key) {
				if (file_exists('../File_BMKG/Iklim/Cuaca_mingguan/'.$key->PDF)) {
					unlink('../File_BMKG/Iklim/Cuaca_mingguan/'.$key->PDF);
					$isi=array('tanggal_awal'=>$tanggal_mulai,'tanggal_akhir'=>$tanggal_akhir,'PDF'=>$pdf);
				}
				# code...
			}
			# code...
		}
		$this->db->where('id_cuming',$id);
		$this->db->update('cuaca_mingguan',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}


	//||date('Y-m',strtotime($date.'+7 days'))==$tanggal

	public function get_hujan_bulanan($tahun){

		$bulan=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

		$data2=null;

		
		for ($i=0; $i < 12; $i++) {
			$data=$this->db->get_where('hujan_bulanan',array('bulan'=>$bulan[$i],'tahun'=>$tahun));
			if ($data->num_rows()>0) {
				# code...
				$data=$data->result()[0];
				$data2.='<tr>
                            <td class="pos-teks">'.$bulan[$i].'</td>
							<td class="pos-teks">
								<button class="btn btn-round btn-xs btn-info cek_hb" value="'.$data->curah_hujan.'">Gambar</button>
							</td>
							<td class="pos-teks">
								<button class="btn btn-round btn-xs btn-info cek_hb" value="'.$data->sifat_hujan.'">Gambar</button>
							</td>
							<td class="pos-teks">'.$data->nama.'</td>
                            <td class="pos-teks">'.date('d-m-Y H:i:s',strtotime($data->tanggal_input)).'</td>
							<td class="pos-teks">
								<button class="btn btn-round btn-xs btn-info get_hbl_id" value="'.$data->id_hujan.'">Edit</button>
                                <input data-nama="hapus" value="'.$data->id_hujan.'" type="checkbox" name="hapus[]">
                            </td>
                          </tr>';
			}else{
				$data2.='<tr>
                            <td  class="pos-teks">'.$bulan[$i].'</td>
                            <td class="pos-teks"><strong>Data</strong></td>
                            <td class="pos-teks"><strong>Hujan</strong></td>
                            <td class="pos-teks"><strong>Bulanan</strong></td>
                            <td class="pos-teks"><strong>Kosong</strong></td>
                            <td class="pos-teks">
                                <button onClick= tambahHB("'.$bulan[$i].'","'.$tahun.'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button>
                              
                            </td>
                          </tr>';
			}
		}
		return $data2;
	}

	public function set_hujan_bulanan($bulan,$tahun,$curah,$sifat,$petugas,$tanggal_input){

		$this->db->SELECT('id_hujan');
		$this->db->FROM('hujan_bulanan');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_hujan,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'HJB'.$id;

		$isi=array(
			'id_hujan'=>$id,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'curah_hujan'=>$curah,
			'sifat_hujan'=>$sifat,
			'nama'=>$petugas,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('hujan_bulanan',$isi);


	}

	public function get_hbl_id($id){
		$data2=null;
		$data=$this->db->get_where('hujan_bulanan',array('id_hujan'=>$id));
		foreach ($data->result() as $key) {
			$data2['id_hujan']=$key->id_hujan;
			$data2['bulan']=$key->bulan;
			$data2['tahun']=$key->tahun;
			$data2['curah']='<img src="'.base_url('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/').$key->curah_hujan.'" alt="Curah hujan" width="400" height="200">';
			$data2['sifat']='<img src="'.base_url('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/').$key->sifat_hujan.'" alt="Sifat hujan" width="400" height="200">';
		}
		return json_encode($data2);
	}

	public function edit_hbl($id,$isi){
		$data=$this->db->get_where('hujan_bulanan',array('id_hujan'=>$id))->result();
		if (isset($isi['curah_hujan'])&&isset($data[0])) {
			unlink('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$data[0]->curah_hujan);
		}
		if (isset($isi['sifat_hujan'])&&isset($data[0])) {
			unlink('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$data[0]->sifat_hujan);
		}
		$this->db->where('id_hujan',$id);
		$this->db->update('hujan_bulanan',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function del_hbl($id){
		$data=$this->db->get_where('hujan_bulanan',array('id_hujan'=>$id))->result();
		$this->db->delete('hujan_bulanan',array('id_hujan'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data as $dt) {
				if (file_exists('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$dt->curah_hujan)) {
					unlink('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$dt->curah_hujan);
					# code...
				}
				if (file_exists('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$dt->sifat_hujan)) {
					unlink('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/'.$dt->sifat_hujan);
					# code...
				}
				# code...
			}
			return 1;
		}
		
	}

	public function get_probabilitas($bul,$tahun){

		$intensity = array('< 50','< 100','< 150','> 50','> 100','> 150','> 100','> 150','> 200','> 300','> 400','> 500');
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$data2=null;
		for ($i=0; $i < 12; $i++) { 
			$data=$this->db->get_where('hujan_probabilistik',array('intensitas'=>$intensity[$i],'bulan'=>$bulan[$bul],'tahun'=>$tahun));
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				$data2.='<tr>
                            <td class="pos-teks">Peluang '.$intensity[$i].'</td>
                            <td class="pos-teks"><a class="cek_prob" href="'.base_url().'../File_BMKG/Iklim/Prakiraan_Musim/Hujan_probabilistik/'.$data->gambar/*id_hupr*/.'">Lihat data</a></td>
                            <td class="pos-teks">'.$data->nama.'</td>
                            <td class="pos-teks">'.date('d-m-Y H:i:s',strtotime($data->tanggal_input)).'</td>
                            <td class="pos-teks"><!--<button type="button" class="btn btn-round btn-info btn-xs aksi" >Edit</button>--> <input value="'.$data->gambar.'" type="checkbox" data-nama="hapus" name="hapus[]"></td>
                          </tr>';
				# code...
			}else{
				$data2 .= '<tr>
                            <td class="pos-teks">Peluang '.$intensity[$i].'</td>
                            <td class="pos-teks"><strong>Data</strong></td>
                            <td class="pos-teks"><strong>belum</strong></td>
                            <td class="pos-teks"><strong>ada</strong></td>
                            <td class="pos-teks"><button type="button" onClick=tambahProb("'.$i.'","'.$bulan[$bul].'","'.$tahun.'") type="button" class="btn btn-round btn-success btn-xs aksi" >Tambah</button></td>
                          </tr>';
			}
			# code...
		}
		return $data2;
	}

	public function set_probabilitas($bulan,$tahun,$intens,$file,$nama,$tanggal_input){
		$this->db->SELECT('id_hupr');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$seq=$this->db->get('hujan_probabilistik');
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_hupr,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."HPB".$id;


		$isi=array(
			'id_hupr'=>$id,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'intensitas'=>$intens,
			'gambar'=>$file,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		$this->db->insert('hujan_probabilistik',$isi);
	}

	public function get_prob_ID($id){
		$data=$this->db->get_where('hujan_probabilistik',array('id_hupr'=>$id));

		if ($data->num_rows()!=0) {
			return $data->result()[0];
			# code...
		}else{
			return null;
		}


	}

	public function del_hpb($id){
		$this->db->delete('hujan_probabilistik',array('gambar'=>$id));
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Hujan_probabilistik/';
		if (file_exists($path.$id)) {
			unlink($path.$id);
			# code...
		}
	}

	public function setPrak_musim($judul, $isi, $gambar, $pdf,$nama, $waktu){
		$this->db->SELECT('id_mus');
		$this->db->FROM('musim');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_mus,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."MSM".$id;
		$isi=array(
			'id_mus'=>$id,
			'tanggal'=>date('Y-m-d'),
			'judul'=>$judul,
			'teks'=>$isi,
			'gambar'=>$gambar,
			'pdf'=>$pdf,
			'nama'=>$nama,
			'tahun'=>date('Y'),
			'tanggal_input'=>$waktu
		);

		return $this->db->insert('musim',$isi);

	}

	public function set_pilih_musim($id){
		$this->db->where('Pilih','Ya');
		$this->db->update('musim',array('Pilih'=>null));

		$this->db->where('id_mus',$id);
		$this->db->update('musim',array('Pilih'=>'Ya'));
	}

	public function getPrak_musim($tahun,$order){
		$this->db->LIKE('tahun',$tahun);
		$this->db->order_by('tanggal_input','DESC');
		$data=$this->db->get('musim');
		$data2['prak_musim']=null;
		$data2['page']=null;
		$i=0;
		$chek=null;
		$list=$order;
		$musim=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($musim[$l]->pilih=='Ya') {
					$chek='checked';
				}
				$data2['prak_musim'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.$musim[$l]->judul.'</td>
								<td>'.$musim[$l]->tahun.'</td>
								<td><button class="cek_musim btn btn-xs btn-info" type="button" value="'.$musim[$l]->id_mus.'">Baca</button></td>
								<td><button class="cek_g_musim btn btn-xs btn-warning" type="button" value="'.$musim[$l]->gambar.'" >Cek gambar</button></td>
								<td>'.$musim[$l]->nama.'</td>
								<td><input onChange=set("'.$musim[$l]->id_mus.'","'.site_url('Cuaca/set_musim_r').'") type="radio" name="pilih" '.$chek.'></td>
								<td><button class="btn btn-round btn-xs btn-info edit-req-pmus" type="button" value="'.$musim[$l]->id_mus.'">Edit</button><input type="checkbox" value="'.$musim[$l]->id_mus.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				# code...
				$i++;
				$list++;
				$chek=null;
				if ($i==5) {
					break;
				}
			}
		}
		$data2['prak_musim'].='<tr class="even pointer">
									<td colspan="5" class="pos-teks"><strong> Tambah data prakiraan musim terbaru</strong></td>
									<td colspan="3" class="pos-teks" ><button type="button" class="btn btn-round btn-info btn-xs tambah-baru" >Tambah</button></td>
								</tr>';

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

	public function get_musim_r($id){
		$data2=null;
		$data=$this->db->get_where('musim',array('id_mus'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=$key->judul;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
			$data2['pdf']= base_url('../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/Dokumen/').$key->pdf;
		}
		return json_encode($data2);
	}

	public function del_prakmus($id){
		$data=$this->db->get_where('musim',array('id_mus'=>$id))->result();
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/';
		$this->db->delete('musim',array('id_mus'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data as $key) {
				if (file_exists($path.'Gambar/'.$key->gambar)) {
					unlink($path.'Gambar/'.$key->gambar);
				}
				if (file_exists($path.'Dokumen/'.$key->pdf)) {
					unlink($path.'Dokumen/'.$key->pdf);
				}
			}
			return 1;
		}
	}

	public function get_musim_id($id){
		return $this->db->get_where('musim',array('id_mus'=>$id))->result()[0];
	}

	public function edit_musim($id,$isi){
		$this->db->where('id_mus',$id);
		$this->db->update('musim',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}

	public function del_file_musim($id,$jenis){
		$data=$this->db->get_where('musim',array('id_mus'=>$id))->result();
		$path='../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/';
		foreach ($data as $key) {
			# code...
			if ($jenis=='Gambar') {
				# code...
				if (file_exists($path.$jenis.'/'.$key->gambar)) {
					unlink($path.$jenis.'/'.$key->gambar);
					return $path.$jenis.'/'.$key->gambar;
					# code...
				}
			}else{
				if (file_exists($path.$jenis.'/'.$key->pdf)) {
					unlink($path.$jenis.'/'.$key->pdf);
					# code...
					return $path.$jenis.'/'.$key->pdf;
				}
			}
		}

	}

	public function getDinat($tanggal){
		$this->db->LIKE('tanggal_mulai',$tanggal);
		$data = $this->db->get('dinamika_atmosfer');
		$data2=null;

		$i=null;
		if ($data->num_rows()>0) {
			$i=1;
			$data=$data->result();
			foreach ($data as $dinat) {
			$data2.='<tr class="even pointer">
                            <td>'.$i.'</td>
                            <td>'.$dinat->judul.'</td>
                            <td>'.date('d-m-Y',strtotime($dinat->tanggal_mulai)).'</td>
							<td>'.date('d-m-Y',strtotime($dinat->tanggal_akhir)).'</td>

							<td><button class="cek_dinat btn btn-xs btn-info" type="button" value="'.$dinat->id_dinat.'">Baca</button></td>
							<td><button class="cek_g_dinat btn btn-xs btn-warning" type="button" value="'.$dinat->gambar.'" >Cek gambar</button></td>
							<td>'.$dinat->nama.'</td>
							<td>'.date('d-m-Y H:i:s',strtotime($dinat->tanggal_input)).'</td>
                            <td><button class="btn btn-round btn-xs btn-info edit-req-dinat" type="button" value="'.$dinat->id_dinat.'">Edit</button><input type="checkbox" value="'.$dinat->id_dinat.'" name="hapus[]" data-nama="hapus"></td>
                          </tr>';
			# code...
            $i++;
			}
			$data=end($data);
			if (date('Y-m',strtotime($data->tanggal_akhir.'+1 days'))==$tanggal) {
				$data2.='<tr class="even pointer">
                            <td>'.$i.'</td>
                            <td>  </td>
                            <td>'.date('d-m-Y',strtotime($data->tanggal_akhir.'+1 days')).'</td>
                            <td><strong>Data</strong></td>
                            <td><strong>belum</strong></td>
                            <td><strong>dinamika</strong></td>
                            <td><strong>atmosfer</strong></td>
                            <td><strong>ada</strong></td>
                            <td><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.date('d-m-Y',strtotime($data->tanggal_akhir.'+1 days')).'" >Tambah</button></td>
                          </tr>';
				# code...
			}
				return $data2;
		}else{
			$data=$this->db->query('SELECT DATE_ADD(tanggal_akhir, INTERVAL 1 DAY) AS tanggal from dinamika_atmosfer ORDER BY tanggal_akhir DESC LIMIT 1');
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				if (date('Y-m',strtotime($data->tanggal))==$tanggal) {
					# code...
					$data=date('d-m-Y',strtotime($data->tanggal));
					$data2.='<tr class="even pointer">
                            <td class=" ">'.$i.'</td>
                            <td class=" "></td>
                            <td class=" ">'.$data.'</td>
                            <td class=" ">Data</td>
                            <td><strong>Dinamika</strong></td>
                            <td><strong>Atmosfer</strong></td>
                            <td class=" ">Masih</td>
                            <td class=" ">Kosong</td>
                            <td class="last"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.$data.'" >Tambah</button>
                            </td>
                          </tr>';
				}
                return $data2;
			}else{
				return $data2='<tr class="even pointer">
		                            <td class=" ">'.$i.'</td>
		                            <td class=" "></td>
		                            <td class=" ">'.date('d').date('-m-Y',strtotime($tanggal)).'</td>
		                            <td class=" ">Data</td>
		                            <td><strong>Dinamika</strong></td>
                            		<td><strong>Atmosfer</strong></td>
		                            <td class=" ">Masih</td>
		                            <td class=" ">Kosong</td>
		                            <td class="last"><button type="button" value="'.date('d').date('-m-Y',strtotime($tanggal)).'" class="btn btn-round btn-success btn-xs tambah" >Tambah</button>
		                            </td>
		                        </tr>';
			}
		}
	}
	public function get_dinat_r($id){
		$data2=null;
		$data=$this->db->get_where('dinamika_atmosfer',array('id_dinat'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=$key->judul;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
			$data2['pdf']= base_url('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Dokumen/').$key->pdf;
		}
		return json_encode($data2);
	}
	public function setDinat($judul, $isi, $gambar, $pdf, $nama, $tanggal_input, $tanggal_mulai, $tanggal_akhir){
		$this->db->SELECT('id_dinat');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get('dinamika_atmosfer');
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_dinat,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy')."DNT".$id;
		$isi=array(
			'id_dinat'=>$id,
			'judul'=>$judul,
			'teks'=>$isi,
			'pdf'=>$pdf,
			'gambar'=>$gambar,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input,
			'tanggal_mulai'=>date('Y-m-d',strtotime($tanggal_mulai)),
			'tanggal_akhir'=>date('Y-m-d',strtotime($tanggal_akhir))
		);

		return $this->db->insert('dinamika_atmosfer',$isi);
	}

	public function del_dinat($id){
		$data=$this->db->get_where('dinamika_atmosfer',array('id_dinat'=>$id));
		$this->db->delete('dinamika_atmosfer',array('id_dinat'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data->result() as $dinat) {
				if (file_exists('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Dokumen/'.$dinat->pdf)) {
					# code...
					unlink('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Dokumen/'.$dinat->pdf);
				}

				if (file_exists('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Gambar/'.$dinat->gambar)) {
					# code...
					unlink('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Gambar/'.$dinat->gambar);
				}
				# code...
			}
			return 1;
		}
		
		
	}

	public function get_dinat_id($id){
		$data=$this->db->get_where('dinamika_atmosfer',array('id_dinat'=>$id));
		$data2=null;
		foreach ($data->result() as $key ) {
			$data2['awal'] = date('d-m-Y',strtotime($key->tanggal_mulai));
			$data2['akhir'] = date('d-m-Y',strtotime($key->tanggal_akhir));
			# code...
			$data2['teks']=$key->teks;
			$data2['judul']=$key->judul;
			$data2['id']=$key->id_dinat;
		}
		return $data2;
	}

	public function del_file_dinat($id, $jenis){
		$data=$this->db->get_where('dinamika_atmosfer',array('id_dinat'=>$id))->result();
		$path='../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/';
		foreach ($data as $key) {
			# code...
			if ($jenis=='Gambar') {
				# code...
				if (file_exists($path.$jenis.'/'.$key->gambar)) {
					unlink($path.$jenis.'/'.$key->gambar);
					return $path.$jenis.'/'.$key->gambar;
					# code...
				}
			}else{
				if (file_exists($path.$jenis.'/'.$key->pdf)) {
					unlink($path.$jenis.'/'.$key->pdf);
					# code...
					return $path.$jenis.'/'.$key->pdf;
				}
			}
		}
	}

	public function edit_dinat($id,$isi){
		$this->db->where('id_dinat',$id);
		$this->db->update('dinamika_atmosfer',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}

	public function getIPT($tanggal){

		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');

		$this->db->LIKE('bulan_mulai',$tanggal);
		$this->db->ORDER_BY('bulan_akhir','ASC');
		$data=$this->db->get('ipt');
		$data2=null;
		$i=null;
		if ($data->num_rows()>0) {
			$i=1;
			$data=$data->result();
			foreach ($data as $ipt) {
				$data2.='<tr class="even pointer">
                            <td>'.$i.'</td>
                            <td>'.$bulan[date('m',strtotime($ipt->bulan_mulai))].'<br>'.
                            date('d-m-Y',strtotime($ipt->bulan_mulai))
                            .'</td>
                            <td>'.$bulan[date('m',strtotime($ipt->bulan_akhir))].'<br>'.
                            date('d-m-Y',strtotime($ipt->bulan_akhir)).
							'</td>
							<td>'.$ipt->judul.'</td>
							<td><button class="cek_ipt btn btn-xs btn-info" type="button" value="'.$ipt->id_ipt.'">Baca</button></td>
							<td><button class="cek_g_ipt btn btn-xs btn-warning" type="button" value="'.$ipt->gambar.'" >Cek gambar</button></td>
                            <td>'.$ipt->nama.'</td>
                            <td>'.date('d-m-Y H:i:s',strtotime($ipt->tanggal_input)).'</td>
                            <td><button class="btn btn-round btn-xs btn-info edit_req_ipt" type="button" value="'.$ipt->id_ipt.'">Edit</button><input type="checkbox" value="'.$ipt->id_ipt.'" name="hapus[]" data-nama="hapus"></td>
                          </tr>';
				# code...
            $i++;
			}
			$data=end($data);
			if (date('Y',strtotime($data->bulan_akhir.'+1 days'))==$tanggal) {
				$data2.='<tr class="even pointer">
                            <td>'.$i.'</td>
                            <td>'.$bulan[date('m',strtotime($data->bulan_akhir.'+1 days'))].'<br>'.date('d-m-Y',strtotime($data->bulan_akhir.'+1 days')).'</td>
                            <td></td>
                            <td><strong>Data</strong></td>
                            <td><strong>IPT</strong></td>
                            <td><strong>belum</strong></td>
                            <td><strong>ada</strong></td>
                            <td></td>
                            <td colspan="2"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.date('d-m-Y',strtotime($data->bulan_akhir.'+1 days')).'" >Tambah</button></td>
                          </tr>';

				# code...
			}
			return $data2;	
			# code...
		}else{
			$data=$this->db->query('SELECT DATE_ADD(bulan_akhir, INTERVAL 1 DAY) AS bulan from ipt ORDER BY bulan_akhir ASC LIMIT 1');
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				if (date('Y',strtotime($data->bulan))==$tanggal) {
					$i=date('d-m-Y',strtotime($data->bulan));
					$data2.='<tr class="even pointer">
                            <td></td>
                            <td>'.$bulan[date('m',strtotime($data->bulan))].'<br>'.date('d-m-Y',strtotime($data->bulan)).'</td>
                            <td><strong>Data</strong></td>
                            <td><strong>IPT</strong></td>
                            <td><strong>belum</strong></td>
                            <td><strong>ada</strong></td>
                            <td></td>
                            <td colspan="2"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.$i.'" >Tambah</button></td>
                          </tr>';
					# code...
				}
				return $data2;
				# code...
			}else{
				return '<tr class="even pointer">
                            <td></td>
                            <td>'.$bulan[date('m')].'</td>
                            <td></td>
                            <td><strong>Data</strong></td>
                            <td><strong>IPT</strong></td>
                            <td>belum</td>
                            <td><strong>ada</strong></td>
                            <td></td>
                            <td colspan="2"><button type="button" class="btn btn-round btn-success btn-xs tambah" value="'.date('d-m-').$tanggal.'" >Tambah</button></td>
                          </tr>';;
			}

		}
	}
	public function get_ipt_r($id){
		$data2=null;
		$data=$this->db->get_where('ipt',array('id_ipt'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=$key->judul;
			$data2['tambahan']='<h2><strong>Periode '.date('d-m-Y',strtotime($key->bulan_mulai)).' hingga '.date('d-m-Y',strtotime($key->bulan_akhir)).' </strong></h2>';
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
			$data2['pdf']= base_url('../File_BMKG/Iklim/Analisis_iklim/IPT/Dokumen/').$key->pdf;
		}
		return json_encode($data2);
	}
	public function set_ipt($tanggal_mulai,$tanggal_akhir,$judul, $pdf, $gambar,$petugas, $tanggal_input){
		$this->db->SELECT('id_ipt');
		$this->db->FROM('ipt');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_ipt,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'IPT'.$id;
		$isi=array(
			'id_ipt'=>$id,
			'bulan_mulai'=>$tanggal_mulai,
			'bulan_akhir'=>$tanggal_akhir,
			'judul'=>$judul,
			'pdf'=>$pdf,
			'gambar'=>$gambar,
			'nama'=>$petugas,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert('ipt',$isi);
	}

	public function get_ipt_id($id){
		$data=$this->db->get_where('ipt',array('id_ipt'=>$id))->result();
		$data2=null;
		foreach ($data as $key ) {
			$data2['mulai']=date('d-m-Y',strtotime($key->bulan_mulai));
			$data2['akhir']=date('d-m-Y',strtotime($key->bulan_akhir));
			$data2['judul']=$key->judul;
			$data2['id']=$key->id_ipt;
			# code...
		}

		return $data2;
	}

	public function del_ipt($id){
		$data=$this->db->get_where('ipt',array('id_ipt'=>$id));
		$this->db->delete('ipt',array('id_ipt'=>$id));
		if ($this->db->affected_rows()==1) {
			foreach ($data->result() as $key) {
				unlink('../File_BMKG/Iklim/Analisis_iklim/IPT/Dokumen/'.$key->pdf);
				unlink('../File_BMKG/Iklim/Analisis_iklim/IPT/Gambar/'.$key->gambar);
			}
			return 1;
		}
	}

	public function del_file_ipt($id, $jenis){
		$data=$this->db->get_where('ipt',array('id_ipt'=>$id))->result();
		$path='../File_BMKG/Iklim/Analisis_iklim/IPT/';
		foreach ($data as $key) {
			# code...
			if ($jenis=='Gambar') {
				# code...
				if (file_exists($path.$jenis.'/'.$key->gambar)) {
					unlink($path.$jenis.'/'.$key->gambar);
					return $path.$jenis.'/'.$key->gambar;
					# code...
				}
			}else{
				if (file_exists($path.$jenis.'/'.$key->pdf)) {
					unlink($path.$jenis.'/'.$key->pdf);
					# code...
					return $path.$jenis.'/'.$key->pdf;
				}
			}
		}
	}

	public function edit_ipt($id,$isi){
		$this->db->where('id_ipt',$id);
		$this->db->update('ipt',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}

	public function get_TCH($tahun,$order){
		$this->db->LIKE('tanggal_input',$tahun);
		$this->db->ORDER_BY('tanggal_input','DESC');
		$data=$this->db->get('tren_hujan');
		$data2['get_tch']=null;
		$data2['page']=null;
		$i=0;
		$sel=null;
		$list=$order;
		$tch=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($tch[$l]->tampil=='Ya') {
					$sel='checked';
				}
				$data2['get_tch'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.date('d-m-Y',strtotime($tch[$l]->tanggal_input)).'</td>
								<td><button class="cek_hth btn btn-xs btn-info" type="button" value="'.$tch[$l]->id_tch.'">Baca</button></td>
								<td><button class="show-gal btn btn-xs btn-warning" type="button" value="'.$tch[$l]->id_tch.'" >Cek gambar</button></td>
								<td>'.$tch[$l]->nama.'</td>
								<td><input type="radio" onChange=set("'.$tch[$l]->id_tch.'","'.site_url('Cuaca/set_tch_r').'") name="pilih" value="'.$tch[$l]->id_tch.'" '.$sel.' ></td>
								<td><button class="btn btn-round btn-xs btn-info edit_req_tch" type="button" value="'.$tch[$l]->id_tch.'">Edit</button><input type="checkbox" value="'.$tch[$l]->id_tch.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				$i++;
				$sel=null;
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
	public function get_tch_r($id){
		$data2=null;
		$data=$this->db->get_where('tren_hujan',array('id_tch'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=null;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
		}
		return json_encode($data2);
	}
	public function set_tch_r($id){
		$this->db->where('tampil','Ya');
		$this->db->update('tren_hujan',array('tampil'=>null));

		$this->db->where('id_tch',$id);
		$this->db->update('tren_hujan',array('tampil'=>'Ya'));
	}

	public function edit_tch($id, $isi){
		$this->db->where('id_tch',$id);
		$this->db->update('tren_hujan',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
			# code...
		}
	}

	public function set_TCH($teks, $nama, $tanggal_input){
		$this->db->SELECT('id_tch');
		$this->db->FROM('tren_hujan');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_tch,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'TCH'.$id;
		$isi=array(
			'id_tch'=>$id,
			'teks'=>$teks,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		$data=$this->db->insert('tren_hujan',$isi);
		if ($data) {
			# code...
			return $id;
		}else{
			return null;
		}
		
	}

	public function del_tch($id){
		$this->db->delete('tren_hujan',array('id_tch'=>$id));
		if ($this->db->affected_rows()==1) {
			$data=$this->db->get_where('foto',array('link'=>$id));
			foreach ($data->result() as $key) {
				# code...
				unlink('../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/'.$key->foto);
			}
			$this->db->delete('foto',array('link'=>$id));
			return 1;
		}
		
	}

	public function get_tch_id($id){
		$this->db->join('foto','foto.link=tren_hujan.id_tch','LEFT');
		$data=$this->db->get_where('tren_hujan',array('id_tch'=>$id));
		$data2=null;
		$data3=$data->result()[0];
		foreach ($data->result() as $ft) {
				# code...
					if ($ft->foto!=null) {
						# code...
						$data2 .='<div class="col-md-55">
	                        <div class="">
	                          <div class="image view view-first">
	                            <img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Perubahan_iklim/Tren_curah_hujan/'.$ft->foto.'" alt="image" />
	                            <div class="mask">
	                              <p>Centang untuk hapus</p>
	                              <div class="tools tools-bottom">
	                                <input value="'.$ft->foto.'" type="checkbox" name="hapus[]"></i>
	                              </div>
	                            </div>
	                          </div>
	                        </div>
	                      </div>';
					}
			}

			$data=null;
			$data['fotos']=$data2;
			$data['tch']=$data3;
		return $data;
	}
	public function get_tsh_r($id){
		$data2=null;
		$data=$this->db->get_where('tren_suhu',array('id_tsh'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=null;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
		}
		return json_encode($data2);
	}
	public function edit_tsh($id, $isi){
		$this->db->where('id_tsh',$id);
		$this->db->update('tren_suhu',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
			# code...
		}

	}

	public function get_Tsuhu($tahun,$order){
		$this->db->LIKE('tanggal_input',$tahun);
		$data=$this->db->get('tren_suhu');
		$data2['tren_suhu']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$chek=null;
		$tsh=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($tsh[$l]->tampil=='Ya') {
					$chek='checked';
				}
				$data2['tren_suhu'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.date('d-m-Y',strtotime($tsh[$l]->tanggal_input)).'</td>
								<td><button class="cek_hth btn btn-xs btn-info" type="button" value="'.$tsh[$l]->id_tsh.'">Baca</button></td>
								<td><button class="show-gal btn btn-xs btn-warning" type="button" value="'.$tsh[$l]->id_tsh.'" >Cek gambar</button></td>
								<td>'.$tsh[$l]->nama.'</td>
								<td><input type="radio" onChange=set("'.$tsh[$l]->id_tsh.'","'.site_url('Cuaca/set_tsh_r').'") name="pilih" value="'.$tsh[$l]->id_tsh.'" '.$chek.' ></td>
								<td><button class="btn btn-round btn-xs btn-info edit_req_tsh" type="button" value="'.$tsh[$l]->id_tsh.'">Edit</button><input type="checkbox" value="'.$tsh[$l]->id_tsh.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				$i++;
				$chek=null;
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

	public function set_tren_suhu($teks, $nama, $tanggal_input){
		$this->db->SELECT('id_tsh');
		$this->db->FROM('tren_suhu');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_tsh,7);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'TSH'.$id;
		$isi=array(
			'id_tsh'=>$id,
			'teks'=>$teks,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		$data=$this->db->insert('tren_suhu',$isi);
		if ($data) {
			return $id;
		}else{
			return null;
		}
	}

	public function set_tsh_r($id){
		$this->db->where('tampil','Ya');
		$this->db->update('tren_suhu',array('tampil'=>null));

		$this->db->where('id_tsh',$id);
		$this->db->update('tren_suhu',array('tampil'=>'Ya'));
	}

	public function del_tsh($id){
		$this->db->delete('tren_suhu',array('id_tsh'=>$id));
		if ($this->db->affected_rows()==1) {
			$data=$this->db->get_where('foto',array('link'=>$id));
			foreach ($data->result() as $key) {
				# code...
				unlink('../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/'.$key->foto);
			}
			$this->db->delete('foto',array('link'=>$id));
			return 1;
		}
	}

	public function get_tsh_id($id){
		$this->db->join('foto','foto.link=tren_suhu.id_tsh','LEFT');
		$data=$this->db->get_where('tren_suhu',array('id_tsh'=>$id));
		$data2=null;
		$data3=$data->result()[0];
		foreach ($data->result() as $ft) {
				# code...
					if ($ft->foto!=null) {
						# code...
						$data2 .='<div class="col-md-55">
	                        <div class="">
	                          <div class="image view view-first">
	                            <img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Perubahan_iklim/Tren_suhu/'.$ft->foto.'" alt="image" />
	                            <div class="mask">
	                              <p>Centang untuk hapus</p>
	                              <div class="tools tools-bottom">
	                                <input value="'.$ft->foto.'" type="checkbox" name="hapus[]"></i>
	                              </div>
	                            </div>
	                          </div>
	                        </div>
	                      </div>';
					}
			}

			$data=null;
			$data['fotos']=$data2;
			$data['tsh']=$data3;
		return $data;
	
	}

	public function get_pch($tahun,$order){
		$this->db->LIKE('tanggal_input',$tahun);
		$data=$this->db->get('perubahan_curah_hujan');
		$data2['get_pnh']=null;
		$data2['page']=null;
		$i=0;
		$chek=null;
		$pch=$data->result();
		$list=$order;
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($pch[$l]->tampil=='Ya') {
					$chek='checked';
				}
				$data2['get_pnh'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.date('d-m-Y',strtotime($pch[$l]->tanggal_input)).'</td>
								<td><button class="cek_hth btn btn-xs btn-info" type="button" value="'.$pch[$l]->id_pch.'">Baca</button></td>
								<td><button class="show-gal btn btn-xs btn-warning" type="button" value="'.$pch[$l]->id_pch.'" >Cek gambar</button></td>
								<td>'.$pch[$l]->nama.'</td>
								<td><input type="radio" onChange=set("'.$pch[$l]->id_pch.'","'.site_url('Cuaca/set_pnh_r').'") type="radio" name="pilih" '.$chek.' ></td>
								<td><button class="btn btn-round btn-xs btn-info edit_req_pnh" type="button" value="'.$pch[$l]->id_pch.'">Edit</button> <input type="checkbox" value="'.$pch[$l]->id_pch.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				$i++;
				$chek=null;
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

	public function get_pnh_r($id){
		$data2=null;
		$data=$this->db->get_where('perubahan_curah_hujan',array('id_pch'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=null;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
		}
		return json_encode($data2);
	}
	
	public function edit_pnh($id, $isi){
		$this->db->where('id_pch',$id);
		$this->db->update('perubahan_curah_hujan',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function del_pnh($id){
		$this->db->delete('perubahan_curah_hujan',array('id_pch'=>$id));
		$data=$this->db->get_where('foto',array('link'=>$id));
		foreach ($data->result() as $key) {
			# code...
			unlink('../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/'.$key->foto);
		}
		$this->db->delete('foto',array('link'=>$id));
	}

	public function get_pnh_id($id){
		$this->db->join('foto','foto.link=perubahan_curah_hujan.id_pch','LEFT');
		$data=$this->db->get_where('perubahan_curah_hujan',array('id_pch'=>$id));
		$data2=null;
		$data3=$data->result()[0];
		foreach ($data->result() as $ft) {
						# code...
							if ($ft->foto!=null) {
								# code...
								$data2 .='<div class="col-md-55">
											<div class="">
												<div class="image view view-first">
													<img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Perubahan_iklim/Perubahan_normal_hujan/'.$ft->foto.'" alt="image" />
													<div class="mask">
														<p>Centang untuk hapus</p>
														<div class="tools tools-bottom">
															<input value="'.$ft->foto.'" type="checkbox" name="hapus[]"></i>
														</div>
													</div>
												</div>
											</div>
										</div>';
							}
					}

		$data=null;
		$data['fotos']=$data2;
		$data['pch']=$data3;
		return $data;
	}

	public function set_pnh_r($id){
		$this->db->where('tampil','Ya');
		$this->db->update('perubahan_curah_hujan',array('tampil'=>null));

		$this->db->where('id_pch',$id);
		$this->db->update('perubahan_curah_hujan',array('tampil'=>'Ya'));
	}

	public function set_pnh($teks, $nama, $tanggal_input){
		$this->db->SELECT('id_pch');
		$this->db->FROM('perubahan_curah_hujan');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_pch,7);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'PCH'.$id;
		$isi=array(
			'id_pch'=>$id,
			'teks'=>$teks,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		$data=$this->db->insert('perubahan_curah_hujan',$isi);
		if ($data) {
			return $id;
		}else{
			return null;
		}
	}

	public function get_EPI($tahun,$order){
		$this->db->LIKE('tanggal_input',$tahun);
		$data=$this->db->get('epi');
		$data2['get_epi']=null;
		$data2['page']=null;
		$i=0;
		$list=$order;
		$chek=null;
		$epi=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				if ($epi[$l]->tampil=='Ya') {
					$chek='checked';
				}
				$data2['get_epi'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.date('d-m-Y H:i:s',strtotime($epi[$l]->tanggal_input)).'</td>
								<td><button class="cek_hth btn btn-xs btn-info" type="button" value="'.$epi[$l]->id_epi.'">Baca</button></td>
								<td><button class="show-gal btn btn-xs btn-warning" type="button" value="'.$epi[$l]->id_epi.'" >Cek gambar</button></td>
								<td>'.$epi[$l]->nama.'</td>
								<td><input onChange=set("'.$epi[$l]->id_epi.'","'.site_url('Cuaca/set_epi_r').'") type="radio" name="pilih" '.$chek.'></td>
								<td><button class="btn btn-round btn-xs btn-info edit_req_epi" type="button" value="'.$epi[$l]->id_epi.'">Edit</button><br><input type="checkbox" value="'.$epi[$l]->id_epi.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				$i++;
				$chek=null;
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
	public function get_epi_r($id){
		$data2=null;
		$data=$this->db->get_where('epi',array('id_epi'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=null;
			$data2['tambahan']=$key->teks;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
		}
		return json_encode($data2);
	}
	public function get_epi_id($id){
			$this->db->join('foto','foto.link=epi.id_epi','LEFT');
			$data=$this->db->get_where('epi',array('id_epi'=>$id));
			$data2=null;
			$data3=$data->result()[0];
			foreach ($data->result() as $ft) {
						# code...
							if ($ft->foto!=null) {
								# code...
								$data2 .='<div class="col-md-55">
											<div class="">
												<div class="image view view-first">
													<img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/'.$ft->foto.'" alt="image" />
													<div class="mask">
														<p>Centang untuk hapus</p>
														<div class="tools tools-bottom">
															<input value="'.$ft->foto.'" type="checkbox" name="hapus[]"></i>
														</div>
													</div>
												</div>
											</div>
										</div>';
							}
					}

					$data=null;
					$data['fotos']=$data2;
					$data['epi']=$data3;
				return $data;
	
	}

	public function set_epi_r($id){
		$this->db->where('tampil','Ya');
		$this->db->update('epi',array('tampil'=>null));

		$this->db->where('id_epi',$id);
		$this->db->update('epi',array('tampil'=>'Ya'));
	}

	public function edit_epi($id,$isi){
		$this->db->where('id_epi',$id);
		$this->db->update('epi',$isi);
		if ($this->db->affected_rows()>0) {
			return 2;
		}

	}

	public function set_epi($isi, $nama, $tanggal_input){
		$this->db->SELECT('id_epi');
		$this->db->FROM('epi');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_epi,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'EPI'.$id;
		$isi=array(
			'id_EPI'=>$id,
			'teks'=>$isi,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		$data=$this->db->insert('epi',$isi);
		if ($data) {
			return $id;
		}else{
			return null;
		}
		
	}

	public function del_epi($id){
		$this->db->delete('epi',array('id_epi'=>$id));
		$data=$this->db->get_where('foto',array('link'=>$id));
		foreach ($data->result() as $key) {
			# code...
			unlink('../File_BMKG/Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/'.$key->foto);
		}
		$this->db->delete('foto',array('link'=>$id));
	}

	public function del_indeks($tabel,$bln,$tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$this->db->delete($tabel,array('bulan'=>$bulan[$bln],'tahun'=>$tahun));

	}

	public function set_keterangan($tabel,$isi,$bulan,$tahun,$nama,$tanggal_input){
		$this->db->SELECT('id');
		$this->db->FROM($tabel);
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id=date('dmy').'KET'.$id;
		$isi=array(
			'id'=>$id,
			'isi'=>$isi,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);

		return $this->db->insert($tabel,$isi);
	}

	public function get_KAH($bln,$tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$data2['l_kah']=null;
		$data3['stat']=1;
			$this->db->ORDER_BY('minggu','ASC');
			$data=$this->db->get_where('kimia_air_hujan3',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
			if ($data->num_rows()==0) {
			$data3['stat']=0;
			# code...
			}
			$i=1;
				foreach ($data->result() as $spm) {
						$data2['l_kah'] .= '<tr class="">
		                            <td class=" ">'.$spm->minggu.'</td>
		                            <td class=" ">'.(float)$spm->nilai_ph.'</td>
		                            <td class=" ">'.$spm->nama.'</td>
		                            <td class=" ">'.date('d-m-Y H:i:s',strtotime($spm->tanggal_input)).'</td>
		                            <td class=" last">
		                                <button onClick= edit_("'.$bulan[$bln].'","'.$tahun.'","'.(float)$spm->nilai_ph.'","'.$i.'") type="button" class="btn btn-round btn-primary btn-xs" >Ubah</button>
		                            </td>
		                          </tr>';
					$i++;
				}
				if ($i!=5) {
					$data2['l_kah'] .='<tr class="">
                            <td class=" ">Data KAH</td>
                            <td class=" ">minggu ke '.$i.'</td>
                            <td class=" ">belum</td>
                            <td class=" ">ada</td>
                            <td class=" last">
                                <button onClick= set_("'.$bulan[$bln].'","'.$tahun.'","'.$i.'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button></td>
                          </tr>';
					# code...
				}
			$data=$this->db->get_where('keterangan_kah',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
			if ($data->num_rows()!=0) {
				# code...
				$data=$data->result()[0];
				$data2['l_kah'] .='<tr class="">
                            <td class=" ">Keterangan</td>
                            <td class=" ">Kimia</td>
                            <td class=" ">air</td>
                            <td class=" ">hujan</td>
                            <td class=" last">
                                <button data-id="'.$data->id.'" type="button" class="btn btn-round btn-info btn-xs edit_ket" >Ubah</button>
								<button data-id="'.$data->id.'" type="button" class="btn btn-round btn-danger btn-xs del-ext" >Hapus</button>
								<button data-id="'.$data->id.'" type="button" class="btn btn-round btn-warning btn-xs baca-ket" >Baca</button>
                            </td>
						  </tr>';
				$data2['k_kah']['isi'] = $data->isi;
				$data2['k_kah']['waktu'] = $data->bulan.' '.$data->tahun;
			}else{
				$data2['l_kah'] .='<tr class="">
                            <td class=" ">Keterangan</td>
                            <td class=" ">Kimia</td>
                            <td class=" ">air</td>
                            <td class=" ">hujan</td>
                            <td class=" last">
                                <button onClick= ket("'.$bulan[$bln].'","'.$tahun.'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button>
                            </td>
                          </tr>';
			}
			


			$data3['kah']=$data2;
			

			return $data3;
	}

	public function set_kah($minggu,$bulan,$tahun,$indeks,$nama,$tanggal_input){
		$this->db->SELECT('id_kah');
		$this->db->FROM('kimia_air_hujan3');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_kah,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$bulan1=array('Januari'=>'01','Februari'=>'02','Maret'=>'03','April'=>'04','Mei'=>'05','Juni'=>'06','Juli'=>'07','Agustus'=>'08','September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12');

		$id = date('dmy').'KAH'.$id;
		$isi=array(
			'id_kah'=>$id,
			'minggu'=>$minggu,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'nilai_ph'=>$indeks,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		return $this->db->insert('kimia_air_hujan3',$isi);
	}

	public function get_ket_id($id, $tbl){
		$data2=null;
		$data=$this->db->get_where($tbl,array('id'=>$id));
		if ($data->num_rows()>0) {
			# code...
			$data2=$data->result()[0];
		}
		return $data2;
	}

	public function edit_ket($bulan,$tahun,$isi,$tabel){
		$this->db->where('tahun',$tahun);
		$this->db->where('bulan',$bulan);
		$this->db->update($tabel,array('isi'=>$isi));
		if ($this->db->affected_rows()>0) {
			return 2;
		}

	}

	public function edit_ket_spm($bulan,$tahun,$isi){
		$this->db->where('tahun',$tahun);
		$this->db->where('bulan',$bulan);
		$this->db->update('ket_spm',array('isi'=>$isi));
		if ($this->db->affected_rows()>0) {
			return 2;
		}

	}

	public function edit_kah($tahun,$bulan,$minggu ,$indeks){
		$this->db->where('bulan',$bulan);
		$this->db->where('tahun',$tahun);
		$this->db->where('minggu',$minggu);
		$this->db->update('kimia_air_hujan3',array('nilai_ph'=>$indeks));
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function get_KAH_grafik($tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$l=0;
		foreach ($bulan as $key => $value) {
				$this->db->order_by('minggu','ASC');
				$data=$this->db->get_where('kimia_air_hujan3',array('bulan'=>$value,'tahun'=>$tahun))->result();
				$i=0;
				$data3=null;
				foreach ($data as $val) {
					$data3[$i]=(float)$val->nilai_ph;
					$i++;		
				}
				$grafik[$l]=array('name'=>$value,'data'=>$data3);
				$l++;
		}
		return	$grafik;
	}


	public function get_spm($bln,$tahun){

			$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$data2['l_spm']=null;
		$data3['stat']=1;
			$this->db->ORDER_BY('minggu','ASC');
			$data=$this->db->get_where('spm',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
			$i=1;
			if ($data->num_rows()==0) {
				# code...
				$data3['stat']=0;
			}
				foreach ($data->result() as $spm) {
						$data2['l_spm'] .= '<tr class="">
		                            <td class=" ">'.$spm->minggu.'</td>
		                            <td class=" ">'.$spm->konsentrasi.'</td>
		                            <td class=" ">'.$spm->nama.'</td>
		                            <td class=" ">'.date('d-m-Y H:i:s',strtotime($spm->tanggal_input)).'</td>
		                            <td class=" last">
		                                <button onClick= edit_("'.$bulan[$bln].'","'.$tahun.'","'.$spm->konsentrasi.'","'.$i.'") type="button" class="btn btn-round btn-primary btn-xs" >Ubah</button>
		                            </td>
		                          </tr>';
					$i++;
				}
				if ($i!=5) {
					$data2['l_spm'].='<tr class="">
                            <td class=" ">Data SPM</td>
                            <td class=" ">minggu ke '.$i.'</td>
                            <td class=" ">belum</td>
                            <td class=" ">ada</td>
                            <td class=" last">
                                <button onClick= set_("'.$bulan[$bln].'","'.$tahun.'","'.$i.'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button></td>
                          </tr>';
		}

		$data=$this->db->get_where('ket_spm',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
			if ($data->num_rows()!=0) {
				# code...
				$data=$data->result()[0];
				$data2['l_spm'].='<tr class="">
                            <td class=" ">Keterangan</td>
                            <td class=" ">Kimia</td>
                            <td class=" ">air</td>
                            <td class=" ">hujan</td>
                            <td class=" last">
                                <button data-id="'.$data->id.'" type="button" class="btn btn-round btn-info btn-xs edit_ket" >Ubah</button>
								<button data-id="'.$data->id.'" type="button" class="btn btn-round btn-danger btn-xs del-ext" >Hapus</button>
								<button data-id="'.$data->id.'" type="button" class="btn btn-round btn-warning btn-xs baca-ket" >Baca</button>
                            </td>
						  </tr>';
				$data2['k_spm']['isi'] = $data->isi;
				$data2['k_spm']['waktu'] = $data->bulan.' '.$data->tahun;
			}else{
				$data2['l_spm'].='<tr class="">
                            <td class=" ">Keterangan</td>
                            <td class=" ">SPM</td>
                            <td class=" ">air</td>
                            <td class=" ">hujan</td>
                            <td class=" last">
                                <button onClick= ket("'.$bulan[$bln].'","'.$tahun.'") type="button" class="btn btn-round btn-success btn-xs" >Tambah</button>
                            </td>
                          </tr>';
			}


			$data3['spm']=$data2;
			
		return $data3;
	}

	public function get_spm_grafik($tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$l=0;
		foreach ($bulan as $key => $value) {
				$this->db->order_by('minggu','ASC');
				$data=$this->db->get_where('spm',array('bulan'=>$value,'tahun'=>$tahun))->result();
				$i=0;
				$data3=null;
				foreach ($data as $val) {
					$data3[$i]=(float)$val->konsentrasi;
					$i++;		
				}
				$grafik[$l]=array('name'=>$value,'data'=>$data3);
				$l++;
		}
		return	json_encode($grafik);
	}

	public function set_spm($minggu,$bulan,$tahun,$indeks,$nama,$tanggal_input){
		$this->db->SELECT('id_spm');
		$this->db->FROM('spm');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_spm,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$bulan1=array('Januari'=>'01','Februari'=>'02','Maret'=>'03','April'=>'04','Mei'=>'05','Juni'=>'06','Juli'=>'07','Agustus'=>'08','September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12');
		$id = date('dmy').'SPM'.$id;
		$isi=array(
			'id_spm'=>$id,
			'minggu'=>$minggu,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'konsentrasi'=>$indeks,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input

		);

		return $this->db->insert('spm',$isi);
	}

	public function del_ket($id,$tbl){
		$tabel=array('kah'=>'keterangan_kah','spm'=>'ket_spm');

		$this->db->delete($tabel[$tbl],array('id'=>$id));
	}

	public function edit_spm($minggu,$bulan,$indeks){
		$this->db->where('bulan',$bulan);
		$this->db->where('minggu',$minggu);
		$this->db->update('spm',array('konsentrasi'=>$indeks));
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function del_spm($id){
		$this->db->delete('spm',array('id_spm'=>$id));
	}

	public function set_foto($foto,$id){
		$this->db->insert('foto',array('foto'=>$foto,'link'=>$id));
	}

	public function del_foto($id){
		$this->db->delete('foto',array('foto'=>$id));
	}

	public function get_radar($waktu){
		$this->db->LIKE('tanggal_input',$waktu);
		$data=$this->db->get('citra_radar');
		$data2=null;
		$i=1;
		foreach ($data->result() as $data) {
			$data2 .='<tr>
                        <td>'.$i.'</td>
                        <td>'.date('d-m-Y',strtotime($data->tanggal_input)).'</td>
                        <td>'.$data->nama.'</td>
                        <td><button value="'.$data->id_ctr.'" type="button"  class="btn btn-round btn-success btn-xs show-gal">Cek citra</button></td>
                        <td><button  type="button" onclick=edit_ctr("'.$data->id_ctr.'","'.site_url('Cuaca/get_ctr_id').'") class="btn btn-round btn-success btn-xs">Edit</button>
                             <input type="checkbox" data-nama="hapus" value="'.$data->id_ctr.' " name="hapus[]">
                        </td>
                      </tr>';
			# code...
			$i++;
		}
        return $data2;
	}

	public function get_ctr_id($id){
		$data=$this->db->get_where('foto',array('link'=>$id));
		$data2=null;
		foreach ($data->result() as $ft) {
				# code...
				$data2 .='<div class="col-md-55">
                        <div class="">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Citra_radar/'.$ft->foto.'" alt="image" />
                            <div class="mask">
                              <p>Centang untuk hapus</p>
                              <div class="tools tools-bottom">
                                <input value="'.$ft->foto.'" type="checkbox" name="hapus[]"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>';
			}
			return $data2;
	}

	public function display_citra($id){
		$data=$this->db->get_where('foto',array('link'=>$id));
		$data2=null;
		foreach ($data->result() as $ft) {
				# code...
				$data2 .='<div class="col-md-55">
                        <div class="">
						  <div class="image view view-first">
						  <a href="'.$id.'" class="" data-id="'.$ft->foto.'">
						  	<img style="width: 100%; display: block; height: 130px;" src="'.base_url().'../File_BMKG/Iklim/Citra_radar/'.$ft->foto.'" alt="citra-radar"/>
						  </a>
                          </div>
                        </div>
                      </div>';
			}
			return $data2;
	}

	public function baca_gambar($id,$tp){
		$path=array('tch'=>'Iklim/Perubahan_iklim/Tren_curah_hujan/','rdr'=>'Iklim/Citra_radar/','tsh'=>'Iklim/Perubahan_iklim/Tren_suhu/','pnh'=>'Iklim/Perubahan_iklim/Perubahan_normal_hujan/','epi'=>'Iklim/Perubahan_iklim/Ekstrem_perubahan_iklim/');
		$data2=null;
		$data=$this->db->get_where('foto',array('link'=>$id));
		$i=0;
		foreach ($data->result() as $key) {
			$data2[$i]='<img class="foto-size " src="'.base_url('../File_BMKG/'.$path[$tp].$key->foto).'" alt="Citra-radar">';
			$i++;
		}
		return json_encode($data2);
	}

	public function set_ctr($petugas,$tanggal_input){
		$this->db->SELECT('id_ctr');
		$this->db->FROM('citra_radar');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_ctr,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'CTR'.$id;

		$data=$this->db->insert('citra_radar',array('id_ctr'=>$id,'nama'=>$petugas,'tanggal_input'=>$tanggal_input));

		if ($data) {
			# code...
			return $id;
		}else{
			return null;
		}
	}

	public function del_radar($id){
		$this->db->delete('citra_radar',array('id_ctr'=>$id));
		if ($this->db->affected_rows()==1) {
			$data=$this->db->get_where('foto',array('link'=>$id))->result();
			foreach ($data as $radar) {
				if (file_exists('../File_BMKG/Iklim/Citra_radar/'.$radar->foto)) {
					unlink('../File_BMKG/Iklim/Citra_radar/'.$radar->foto);
				}
			}
			$this->db->delete('foto',array('link'=>$id));
			return 1;
		}
		
		
	}


	public function set_hth($judul,$ket, $gambar, $tanggal_mulai,$tanggal_akhir, $nama, $tanggal_input){
		$this->db->SELECT('id_hth');
		$this->db->FROM('informasi_hth');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_hth,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'HTH'.$id;
		$isi=array(
			'id_hth'=>$id,
			'judul'=>$judul,
			'ket'=>$ket,
			'tanggal'=>$tanggal_mulai,
			'tanggal_akhir'=>$tanggal_akhir,
			'gambar'=>$gambar,
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);
		return $this->db->insert('informasi_hth',$isi);
	}

	public function get_hth_r($id){
		$data2=null;
		$data=$this->db->get_where('informasi_hth',array('id_hth'=>$id));
		foreach ($data->result() as $key) {
			$data2['judul']=$key->judul;
			$data2['tambahan']=$key->ket;
			$data2['creator']=$key->nama.' '.date('d-m-Y H:i:s',strtotime($key->tanggal_input));
		}
		return json_encode($data2);
	}

	public function get_hth($bulan){
		$this->db->LIKE('tanggal',$bulan);
		$data2=null;
		$data=$this->db->get('informasi_hth');
		$i=1;
		if ($data->num_rows()>0) {
			# code...

			foreach ($data->result() as $key) {
				# code...
				$data2 .= '<tr>
							<td>'.$i.'</td>
							<td><a href="'.$key->id_hth.'">'.$key->judul.'</a></td>
							<td>'.date('d-m-Y',strtotime($key->tanggal)).'</td>
							<td>'.date('d-m-Y',strtotime($key->tanggal_akhir)).'</td>
							<td>'.$key->nama.'</td>
							<td><button class="cek_hth btn btn-xs btn-info" type="button" value="'.$key->id_hth.'">Baca</button></td>
							<td><button class="cek_g_hth btn btn-xs btn-warning" type="button" value="'.$key->gambar.'" >Cek gambar</button></td>
							<td>'.date('d-m-Y H:i:s',strtotime($key->tanggal_input)).'</td>
							<td>
								<button type="button" value="'.$key->id_hth.'" class="btn btn-round btn-xs btn-info ch-hth">Ubah</button>
								<input value="'.$key->id_hth.'" type="checkbox" data-nama="hapus" name="hapus[]">
							</td>
						</tr>';
				$i++;
			}
			if (date('Y-m',strtotime('+ 1 day'.$key->tanggal_akhir))==$bulan) {
				# code...
				$data2 .= '<tr><td colspan="9" align="center"><button type="button" class="btn btn-round btn-xs btn-success new_hth" value="'.date('d-m-Y',strtotime('+ 1 day'.$key->tanggal_akhir)).'">Tambah</button></td></tr>';
			}
		}else {
			# code...
			$this->db->ORDER_BY('tanggal_akhir','DESC');
			$data=$this->db->get('informasi_hth')->result();

			if (isset($data[0])) {
				# code...
				if (date('Y-m',strtotime($data[0]->tanggal_akhir))==$bulan) {
					# code...
					$data2 .= '<tr><td colspan="9" align="center"><button type="button" class="btn btn-round btn-xs btn-success new_hth" value="'.date('d-m-Y',strtotime('+1 days'.$data[0]->tanggal_akhir)).'">Tambah</button></td></tr>';
				}
			}else{
				$data2 .= '<tr><td colspan="9" align="center"><button type="button" class="btn btn-round btn-xs btn-success new_hth" value="'.date('d-m-Y',strtotime($bulan)).'" >Tambah</button></td></tr>';
			}
		}
		return $data2;
	}

	public function get_hth_id($id){
		$data2=null;
		$data=$this->db->get_where('informasi_hth',array('id_hth'=>$id));
		foreach ($data->result() as $key) {
			# code...
			$data2['id']=$key->id_hth;
			$data2['judul']=$key->judul;
			$data2['tm']=$key->tanggal;
			$data2['ta']=$key->tanggal_akhir;
			$data2['ket']=$key->ket;
			$data2['foto']=$key->gambar;
		}
		return json_encode($data2);
	}

	public function del_hth($id){
		# code...
		$data=$this->db->get_where('informasi_hth',array('id_hth'=>$id))->result();
		$this->db->delete('informasi_hth',array('id_hth'=>$id));
		if ($this->db->affected_rows()==1) {
			if (isset($data[0]->gambar)) {
				# code...
				unlink('../File_BMKG/Iklim/Informasi_iklim/Informasi_HTH/'.$data[0]->gambar);
			}
			return 1;
		}
	}

	public function edit_hth($id,$isi){
		if (isset($isi['gambar'])) {
			$data=$this->db->get_where('informasi_hth',array('id_hth'=>$id));
			# code...
			foreach ($data->result() as $key) {
				# code..
				unlink('../File_BMKG/Iklim/Informasi_iklim/Informasi_HTH/'.$key->gambar);
			}
		}
		$this->db->where('id_hth',$id);
		$this->db->update('informasi_hth',$isi);
		if ($this->db->affected_rows()>0) {
			# code...
			return 2;
		}
	}

	public function cuaca_dashboard($tanggal){
		$wilayah = array('Yogyakarta', 'Sleman','Bantul','Kulonprogo','Gunungkidul');
		$cuaca=array('Cerah'=>'cerah-am.png','Berawan'=>'berawan-am.png','Udara kabur'=>'berawan tebal-pm.png','Kabut'=>'kabut-am.png','Cerah berawan'=>'cerah berawan-am.png','Hujan ringan'=>'hujan ringan-am.png','Hujan lebat'=>'hujan lebat-am.png','Hujan petir'=>'hujan petir-am.png','Hujan lokal'=>'hujan lokal-am.png','Hujan sedang'=>'hujan sedang-am.png','Panas'=>'cerah-am.png');
		$jam = date('H:i');
		$data2['small']=null;
		if ($jam>='00:00'&&$jam<='05:59') {
			$tabel='cuaca_harian_dinihari';
		}else if ($jam>='06:00'&&$jam<='11:59') {
			$tabel='cuaca_harian_pagi';
		}else if ($jam>='12:00'&&$jam<='17:59') {
			$tabel='cuaca_harian_siang';
		}else{
			 $tabel='cuaca_harian_malam';
		}

		for ($i=1; $i < 5; $i++) { 
			$data=$this->db->get_where($tabel,array('Wilayah'=>$wilayah[$i],'Tanggal'=>$tanggal));
			if ($data->num_rows()>0) {
				$data=$data->result()[0];
				$data2['small'] .= '<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
										<div class="tile-stats" style="height: 130px;">
										<img style="margin:5px 0 0 10px;;" src="'.base_url('../File_BMKG/Cuaca/icon_cuaca/'.$cuaca[$data->Jenis]).'" width="50" height="50" alt="'.$data->Jenis.'">
										<span style="float:right;">
											<p style="z-index:0; margin: 9px 10px 0 0; font-size: 25px;"><strong>'.$wilayah[$i].'</strong></p>
											<p style="z-index:0; margin: 0 10px 0 0; font-size: 15px;">'.$data->arah_angin.'</p>
										</span>
										<p style="z-index:0; font-size: 15px;">'.$data->Jenis.'</p>
										<p style="z-index:0;">'.$data->suhu_min.' - '.$data->suhu_maks.' °C || '.$data->kelembapan_min.' - '.$data->kelembapan_maks.' %</p>
										</div>
									</div>';
			}else{
				$data2['small'] .= '<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
										<div class="tile-stats" style="height: 130px;">
										<span style="float:right;">
											<p style="z-index:0; margin: 12px 6px 0 0; font-size: 25px;"><strong>'.$wilayah[$i].'</strong></p>
										</span>
										<h2  style="margin:10px 0 0 5px;float:left;">Data belum ada</h2>
										</div>
									</div>';
			}
		}

		$data=$this->db->get_where($tabel,array('Wilayah'=>$wilayah[0],'Tanggal'=>$tanggal));
		if ($data->num_rows()>0) {
			$data=$data->result()[0];
			$data2['main'] = '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="border-right: 1px solid black;height: 100%;">
								<img style="margin:5px 0 0 20px;" src="'.base_url('../File_BMKG/Cuaca/icon_cuaca/'.$cuaca[$data->Jenis]).'" width="200" height="200" alt=""><br>
								<p style="z-index:0; margin:5px 0 0 20px; font-size:50px;">'.$wilayah[0].'</p>
								<p style="z-index:0; margin:5px 0 0 20px; font-size:30px;">'.$data->Jenis.'</p>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<h1>Suhu</h1>
								<h2>'.$data->suhu_min.' - '.$data->suhu_maks.' °C</h2><br>
								<h1>Kelembapan</h1>
								<h2>'.$data->kelembapan_min.' - '.$data->kelembapan_maks.' %</h2><br>
								<h1>Angin</h1>
								<h2>'.$data->arah_angin.'</h2>
							</div>';
		}else{
			$data2['main'] = '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="border-right: 1px solid black;height: 100%;">
								<p align="center" style="margin:80px 0 0 0; font-size:30px;">Data belum ada</p><br>
								<p style="margin:5px 0 0 20px; font-size:50px;">'.$wilayah[0].'</p>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<h1>Suhu</h1>
								<h2>-</h2><br>
								<h1>Kelembapan</h1>
								<h2>-</h2><br>
								<h1>Angin</h1>
								<h2>-</h2>
							</div>';
		}
		return $data2;
	}

	public function kah_dash($bln,$tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$this->db->order_by('minggu','ASC');
		$data=$this->db->get_where('kimia_air_hujan3',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
		$data2=null;
		foreach ($data->result() as $key) {
			$data2[]=(float)$key->nilai_ph;
		}
		$data3[]=array('name'=>$bulan[$bln],'data'=>$data2);
		return $data3;
	}

	public function spm_dash($bln,$tahun){
		$bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$this->db->order_by('minggu','ASC');
		$data=$this->db->get_where('spm',array('bulan'=>$bulan[$bln],'tahun'=>$tahun));
		$data2=null;
		foreach ($data->result() as $key) {
			$data2[]=(float)$key->konsentrasi;
		}
		$data3[]=array('name'=>$bulan[$bln],'data'=>$data2);
		return $data3;
	}

	public function peringatan($waktu,$order){
		$this->db->LIKE('tanggal_input',$waktu);
		$this->db->order_by('tanggal_input','DESC');
		$data=$this->db->get('peringatan');
		$data2['peringatan']=null;
		$data2['page']=null;
		$i=0;
		$chek=null;
		$list=$order;
		$musim=$data->result();
		if ($data->num_rows()>0) {
			for ($l=($order-1); $l<$data->num_rows(); $l++) {
				$data2['peringatan'].='<tr class="even pointer">
								<td>'.$list.'</td>
								<td>'.$musim[$l]->wilayah.'</td>
								<td>'.date('d-m-Y',strtotime($musim[$l]->tanggal)).'</td>
								<td><button class="cek_musim btn btn-xs btn-warning baca_warning" type="button" value="'.$musim[$l]->id_pnn.'">Baca</button></td>
								<td>'.$musim[$l]->nama.'</td>
								<td>'.date('d-m-Y H:i:s',strtotime($musim[$l]->tanggal_input)).'</td>
								<td>
									<button class="btn btn-xs btn-info edit_req_per" type="button" value="'.$musim[$l]->id_pnn.'">Edit</button>
									<input type="checkbox" value="'.$musim[$l]->id_pnn.'" name="hapus[]" data-nama="hapus"></td>
							</tr>';
				# code...
				$i++;
				$list++;
				$chek=null;
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
	public function set_peringatan($teks,$wilayah,$tanggal, $nama, $tanggal_input){
		$this->db->SELECT('id_pnn');
		$this->db->FROM('peringatan');
		$this->db->ORDER_BY('tanggal_input','DESC');
		$this->db->LIMIT(1);
		$seq=$this->db->get();
		$id=null;
		if ($seq->num_rows()==0) {
			$id='001';
			# code...
		}else{
			$id = $this->pemisah_angka->Pisah($seq->row()->id_pnn,7); //preg_split('#(?<=[a-z])(?=\d)#i',$seq->row()->id_gmp);
			$id= (int)$id['angka']+1;
			if (($id>=1)&&($id<=9)) {
				$id='00'.$id;
				# code...
			}else if (($id>=10)&&($id<=99)) {
				$id='0'.$id;
				# code...
			}
		}
		$id = date('dmy').'PNN'.$id;
		$isi=array(
			'id_pnn'=>$id,
			'isi'=>$teks,
			'wilayah'=>$wilayah,
			'tanggal'=>date('Y-m-d',strtotime($tanggal)),
			'nama'=>$nama,
			'tanggal_input'=>$tanggal_input
		);
		$this->db->insert('peringatan',$isi);
		return $this->db->affected_rows();

	}

	public function edit_peringatan($id,$teks,$wilayah,$tanggal){
		$this->db->where('id_pnn',$id);
		$this->db->update('peringatan',array('isi'=>$teks,'wilayah'=>$wilayah,'tanggal'=>date('Y-m-d',strtotime($tanggal))));
		if ($this->db->affected_rows()>0) {
			return 2;
		}
	}

	public function del_peringatan($id){
		$this->db->delete('peringatan',array('id_pnn'=>$id));
		if ($this->db->affected_rows()==1) {
			return 1;
		}
	}

	public function get_peringatan_id($id){
		$data2=null;
		$data=$this->db->get_where('peringatan',array('id_pnn'=>$id))->result();
		foreach ($data as $key) {
			$data2['id']=$key->id_pnn;
			$data2['wilayah']=$key->wilayah;
			$data2['tanggal']=date('d-m-Y',strtotime($key->tanggal));
			$data2['isi']=$key->isi;
		}
		return $data2;
	}
}





/*
date('Y',strtotime($dinat->tahun))

$data2 .= '<tr class="">
                            <td class=" ">1</td>
                            <td class=" ">'.$wilayah[$i]'</td>
                            <td class=" ">Belum Selesai</td>
                            <td class=" ">Margianto</td>
                            <td class=" last">
                                <button class="btn btn-round btn-success btn-xs" >Tambah</button>
                                <button data-id="'.$cuaca->id_cuhar.'" class="btn btn-round btn-info btn-xs" >Edit</button>
                                <input type="checkbox" name="hapus[]" data-nama="hapus">
                            </td>
                          </tr>';

*/