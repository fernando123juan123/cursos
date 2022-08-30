<?php 

class backend_lib{
	private $CI;
	public function __construct() {
		$this->CI= & get_instance();
	}
	public function listar_menus_sys(){
		return $this->CI->Backend_model->listar_menus_privilegios();
	}
}
 ?>