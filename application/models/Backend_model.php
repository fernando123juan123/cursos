<?php 
/**
 * 
 */
class Backend_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function listar_menus_privilegios(){
		$idrol=$this->session->userdata('idrol');

		/*echo $idrol;
		die();*/

		$obj=$this->db->query("SELECT * FROM privilegios
		INNER JOIN rol USING(idrol)
		INNER JOIN menus USING(idmenus)
		WHERE privilegios.p_estado='activo' AND privilegios.idrol='$idrol' ")->result();
		
		$a=array();
		foreach ($obj as  $value) {
			$a[$value->menus]=$value->menus;
		}
		return $a;
	}
}


 ?>