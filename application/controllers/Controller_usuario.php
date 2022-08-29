<?php 
/**
 * 
 */
class Controller_usuario extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Model_usuario');
	}

	
	public function index(){
		if ($this->session->userdata('session')) {
			redirect(base_url().'adminInicio');
		}else{
			$this->load->view('login');
		}
	}

	public function login(){
		$user=$this->input->post('user');
		$pass=sha1($this->input->post('pass'));
		$obj=$this->Model_usuario->login($user,$pass);
		// print_r($obj);
		// die;
		if ($obj) {
			$datos=array(
				'session'	=>	true,
				'id'  		=>	$obj->idusuario,
				'nombres'	=>	$obj->nombre.' '.$obj->paterno.' '.$obj->materno,
				'roles'		=>	$obj->roles
			);
			$this->session->set_userdata($datos);
			echo json_encode(array(0=>1));
		}else{
			echo json_encode(array(0=>0));
		}
	}
	public function salir(){
		$this->session->sess_destroy();
		$this->index();
	}




	public function adminInicio(){
		/*echo " holaaaa... <br>";
		echo $this->session->userdata('nombres')." <br>";
		echo $this->session->userdata('roles');*/
		$datos['contenido']="inicio/contenido_index";
		$this->load->view('plantilla',$datos);
	}






	/// modulo adminUsuario
		public function adminUsuario(){
			$datos['contenido']="file_usuario/adminUsuario_index";
			$this->load->view('plantilla',$datos);
		}
		public function nuevoUsuario(){
			$datos['contenido']="file_usuario/form_nuevoUsuario";
			$this->load->view('plantilla',$datos);
		}
		public function verificar_usuarios(){
			$user=$this->input->post('user');
			$obj=$this->Model_usuario->verificar_usuarios($user);
			if ($obj) {
				echo json_encode(array(0=>1));
			}else{
				echo json_encode(array(0=>0));
			}
		}
		public function validar_ci(){
			$ci=$this->input->post('ci');
			$obj=$this->Model_usuario->validar_ci($ci);
			if($obj){
				$obj1=$this->Model_usuario->verificar_usuarios_activos($obj->idpersona);
				if($obj1){
					$data=array(
						0=>$obj1->ci,
						1=>$obj1->expedido,
						2=>$obj1->nombre,
						3=>$obj1->paterno,
						4=>$obj1->materno,
						5=>$obj1->celular,
						6=>$obj1->idpersona,
						7=>'usuario',
						8=>$obj1->idrol
					);
				}else{
					$data=array(
						0=>$obj->ci,
						1=>$obj->expedido,
						2=>$obj->nombre,
						3=>$obj->paterno,
						4=>$obj->materno,
						5=>$obj->celular,
						6=>$obj->idpersona,
						7=>'persona'
					);
				}
				echo json_encode($data);
			}else{
				echo json_encode(array(0=>0));
			}
		}
		public function guardarNuevoUsuario(){
			$ci=$this->input->post('ci');
			$expedido=$this->input->post('expedido');
			$nombre=mb_strtoupper($this->input->post('nombre'),'utf-8');
			$paterno=mb_strtoupper($this->input->post('paterno'),'utf-8');
			$materno=mb_strtoupper($this->input->post('materno'),'utf-8');
			$celular=$this->input->post('celular');

			$idpersona=$this->input->post('idpersona');

			$idrol=$this->input->post('idrol');
			$usuario=$this->input->post('usuario');
			$password=sha1($this->input->post('password'));

			// $password = crypt($this->input->post('password'),'$6$rounds=5000$usesomesillystringforsalt$');

			$imagen=$_FILES['imagen']['tmp_name'];
			if ($imagen) {

				$ext=explode('.', $_FILES['imagen']['name']);

				$img=round(microtime(true)).'.'.end($ext);

				move_uploaded_file($_FILES['imagen']['tmp_name'],"assets/imagenes/user_".$img);

				$imagen="user_".$img;

			}else{
				$imagen='';
			}

			if ($idpersona==0) {
				$objeto=array(
					'ci'=>$ci,
					'expedido'=>$expedido,
					'nombre'=>$nombre,
					'paterno'=>$paterno,
					'materno'=>$materno,
					'celular'=>$celular
				);
				$idpersona=$this->Model_usuario->insertar_tabla_sys('persona',$objeto);
			}

			$objeto1=array(
				'imagen'=>$imagen,
				'name'=>$usuario,
				'pass'=>$password,
				'estado'=>'activo',
				'fecha_reg'=>date('Y-m-d'),
				'idpersona'=>$idpersona,
				'idrol'=>$idrol
			);
			$this->Model_usuario->insertar_tabla_sys('usuario',$objeto1);
		}
		public  function cambiar_estado_usuario(){
			$idusuario=$this->input->post('idusuario');
			$estado=$this->input->post('estado');
			if ($estado=='1') {
				$valor_estado='inactivo';
			}else{
				$valor_estado='activo';
			}
			$obj=array('estado'=>$valor_estado);
			$this->Model_usuario->editar_tabla_sys('usuario',$obj,'idusuario',$idusuario);
		}
		public  function eliminar_usuario(){
			$idusuario=$this->input->post('idusuario');
			$obj=array('estado'=>'eliminar');
			$this->Model_usuario->editar_tabla_sys('usuario',$obj,'idusuario',$idusuario);
		}
		public function editarUsuario($idusuario){
			// echo $idusuario;
			$datos['obj']=$this->Model_usuario->editarUsuario($idusuario);
			$datos['contenido']='file_usuario/form_editarUsuario';
			$this->load->view('plantilla',$datos);
		}
		public function guardarEditarUsuario(){
			$idpersona=$this->input->post('idpersona');
			$idusuario=$this->input->post('idusuario');
			$imagen_a=$this->input->post('imagen_a');

			$expedido=$this->input->post('expedido');
			$nombre=mb_strtoupper($this->input->post('nombre'),'utf-8');
			$paterno=mb_strtoupper($this->input->post('paterno'),'utf-8');
			$materno=mb_strtoupper($this->input->post('materno'),'utf-8');
			$celular=$this->input->post('celular');

			$idrol=$this->input->post('idrol');

			$imagen=$_FILES['imagen']['tmp_name'];
			if ($imagen) {

				if ($imagen_a) {
					unlink("./assets/imagenes/".$imagen_a);
				}

				$ext=explode('.', $_FILES['imagen']['name']);
				$img=round(microtime(true)).'.'.end($ext);
				move_uploaded_file($_FILES['imagen']['tmp_name'],"assets/imagenes/user_".$img);
				$imagen="user_".$img;

			}else{
				$imagen=$imagen_a;
			}

			$objeto=array(
				'expedido'=>$expedido,
				'nombre'=>$nombre,
				'paterno'=>$paterno,
				'materno'=>$materno,
				'celular'=>$celular
			);
			$this->Model_usuario->editar_tabla_sys('persona',$objeto,'idpersona',$idpersona);

			$objeto1=array(
				'imagen'=>$imagen,
				'idrol'=>$idrol
			);
			$this->Model_usuario->editar_tabla_sys('usuario',$objeto1,'idusuario',$idusuario);
		}


	/// modulo adminUsuario



	/// modulo graficos
		public function graficos(){
			$datos['contenido']="graficos/graficos_index";
			$this->load->view('plantilla',$datos);
		}
		public function reporteGrafico(){
			$obj1=$this->Model_usuario->reporteGrafico('activo');
			$obj2=$this->Model_usuario->reporteGrafico('inactivo');
			$obj3=$this->Model_usuario->reporteGrafico('eliminar');
			
			$datos=array(
				0=>$obj1->total,
				1=>$obj2->total,
				2=>$obj3->total
			);
			echo json_encode($datos);
		}
	/// modulo graficos

}
 ?>