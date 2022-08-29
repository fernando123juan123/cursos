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
	public function listarUsuarioExcel(){
		require_once APPPATH."/libraries/PHPExcel/Classes/PHPExcel.php";
		$excel=new PHPExcel();

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$excel->getActiveSheet()->setCellValue('A1','LISTAR USUARIOS');


		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$excel->getActiveSheet()->setCellValue('A2','#');

		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('B2','CARNET');

		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('C2','NOMBRE');

		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('D2','APELLIDOS');

		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('E2','CELULAR');

		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('F2','ESTADO');

		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$excel->getActiveSheet()->setCellValue('G2','ROL');

		$con=1; 
		$c=3; 
		foreach ($this->Model_usuario->listar_usuarios() as $objecto) {
			$excel->getActiveSheet()->setCellValue('A'.$c,$con++);
			$excel->getActiveSheet()->setCellValue('B'.$c,$objecto->ci);
			$excel->getActiveSheet()->setCellValue('C'.$c,$objecto->nombre);
			$excel->getActiveSheet()->setCellValue('D'.$c,$objecto->paterno.' '.$objecto->materno);
			$excel->getActiveSheet()->setCellValue('E'.$c,$objecto->celular);
			$excel->getActiveSheet()->setCellValue('F'.$c,$objecto->estado);
			$excel->getActiveSheet()->setCellValue('G'.$c,$objecto->roles);
			$c=$c+1;
		}


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=listarUsuarioExcel.xls');
		header('Cache-Control: max-age=0');

		$objExcel=PHPExcel_IOFactory::createWriter($excel,'Excel5');
		$objExcel->save('php://output');
	}

}




 ?>