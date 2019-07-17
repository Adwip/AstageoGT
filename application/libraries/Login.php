<?php

/**
 * 
 */
class Login extends CI_Loader{
	function __construct(){
		parent:: __construct();
		$this->load->library('session');
	}

	public function set_akses($nama){
		$data=file_get_contents('asset\Admin\akses_admin.json');
		$data=json_decode($data,TRUE);
		foreach ($data as $key) {
			if (isset($key[$nama])) {
				$this->session->set_userdata(array(
				'berita'=>$key[$nama]['berita'],
				'artikel'=>$key[$nama]['artikel'],
				'kepegawaian'=>$key[$nama]['kepegawaian'],
				'cuaca'=>$key[$nama]['cuaca'],
				'prak_musim'=>$key[$nama]['prak_musim'],
				'analis_iklim'=>$key[$nama]['analis_iklim'],
				'inf_iklim'=>$key[$nama]['inf_iklim'],
				'per_iklim'=>$key[$nama]['per_iklim'],
				'kual_udara'=>$key[$nama]['kual_udara'],
				'gempa'=>$key[$nama]['gempa'],
				'ttm_petir'=>$key[$nama]['ttm_petir'],
				'umum'=>$key[$nama]['umum'],
				'administrator'=>$key[$nama]['administrator']
			));
			break;
			}
			
		}
	}
	
}