<?php 
class Controller_reportes_pdf extends CI_Controller
{
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Model_usuario');
	}
	public function listarUsuarioPdf(){
		ob_start();
		require_once APPPATH."/libraries/fpdf/fpdf.php";
		$pdf=new FPDF('P','mm','A4',true);
		$pdf->AddPage();

		$pdf->Image("assets/descarga.jpg",10,10,25,25,"jpg");

		$pdf->ln(12);
		$pdf->SetTextColor(22,50,126);
		$pdf->setFont('Times','B',24);
		$pdf->cell(198,7,'LISTAR USUARIOS',0,1,'C');

		$pdf->setFont('Times','B',10);
		$pdf->cell(198,1,'============================================================',0,1,'C');

		$pdf->SetFillColor(184,191,211);
		// $pdf->SetDrawColor(0,100,102);

		$pdf->ln(10);
		$pdf->cell(10,6,'#',1,0,'C',1);
		$pdf->cell(20,6,'CARNET',1,0,'C',1);
		$pdf->cell(40,6,'NOMBRE',1,0,'C',1);
		$pdf->cell(45,6,'APELLIDO',1,0,'C',1);
		$pdf->cell(20,6,'CELULAR',1,0,'C',1);
		$pdf->cell(20,6,'ESTADO',1,0,'C',1);
		$pdf->cell(35,6,'ROL',1,1,'C',1);
		
		$con=1; 
		foreach ($this->Model_usuario->listar_usuarios() as $objecto) {
			$pdf->setFont('Times','',8);
			$pdf->cell(10,6,$con++,1,0,'C');
			$pdf->cell(20,6,$objecto->ci,1,0,'C');
			$pdf->cell(40,6,$objecto->nombre,1,0,'C');
			$pdf->cell(45,6,$objecto->paterno.' '.$objecto->materno,1,0,'C');
			$pdf->cell(20,6,$objecto->celular,1,0,'C');
			$pdf->cell(20,6,$objecto->estado,1,0,'C');
			$pdf->cell(35,6,$objecto->roles,1,1,'C');
		}

		$pdf->output('imprimir_lista_usuario.pdf','I');
		ob_end_clean();
	}

}




 ?>