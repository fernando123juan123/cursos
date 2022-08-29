<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">ADMINISTRACION <small>.</small></h1>
	</div>
</div>
<div class="container-fluid">
	<h3 align="center">ADMINISTRACION DE USUARIOS</h3>

	<a href="<?php echo base_url(); ?>nuevoUsuario" class="btn btn-success btn-raised"> NUEVO USUARIO</a>
	
	<a href="<?php echo base_url(); ?>listarUsuarioPdf" target="_blank" class="btn btn-warning btn-raised"> REPORTE PDF</a>
	<a href="<?php echo base_url(); ?>listarUsuarioExcel" target="_blank" class="btn btn-primary btn-raised"> REPORTE EXCEL</a>

	<div class="table-responsive">
		<table class="table table-hover" id="table_id">
			<thead>
				<tr>
					<td>#</td>
					<td>IMAGEN</td>
					<td>CARNET</td>
					<td>NOMBRE Y AP.</td>
					<td>ROL</td>
					<td>ESTADO</td>
					<td>FECHA</td>
					<td>ACCION</td>
				</tr>
			</thead>
			<tbody>
				<?php $con=1; foreach ($this->Model_usuario->listar_usuarios() as $objecto) {  ?>
				<tr>
					<td><?php echo $con++; ?></td>
					<td><img width="40" src="<?php echo base_url() ?>assets/imagenes/<?php echo $objecto->imagen; ?>" alt=""></td>
					<td><?php echo $objecto->ci.' '.$objecto->expedido; ?></td>
					<td><?php echo $objecto->nombre.' '.$objecto->paterno.' '.$objecto->materno ?></td>
					<td><?php echo $objecto->roles; ?></td>
					<td>
						<?php if($objecto->estado=='activo'){ ?>
							<button type="buton" class="btn btn-success btn-raised" onclick="cambiar_estado_usuario('<?php echo $objecto->idusuario; ?>','1')">ACTIVO</button>
						<?php }else{ ?>
							<button type="buton" class="btn btn-danger btn-raised" onclick="cambiar_estado_usuario('<?php echo $objecto->idusuario; ?>','0')">INACTIVO</button>
						<?php } ?>
					</td>
					<td><?php echo $objecto->fecha_reg; ?></td>
					<td>
						<a href="<?php echo base_url() ?>editarUsuario/<?php echo $objecto->idusuario; ?>" class="btn btn-info btn-raised"> Editar</a>
						<a href="javascript:;" class="btn btn-danger btn-raised"  onclick="eliminar_usuario('<?php echo $objecto->idusuario; ?>')"> Eliminar</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
function cambiar_estado_usuario(idusuario,estado){
	$.post('cambiar_estado_usuario', {idusuario,estado}, function() {
		window.location='';
	});
}
function eliminar_usuario(idusuario){
	swal({
	  	title: 'ESTA SEGURO QUE DESE ELIMINAR ?',
	  	text: "----------------------------------------",
	  	type: 'warning',
	  	showCancelButton: true,
	  	confirmButtonColor: '#03A9F4',
	  	cancelButtonColor: '#F44336',
	  	confirmButtonText: '<i class="zmdi zmdi-run"></i> ACEPTAR',
	  	cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> CANCELAR'
	}).then(function () {
		$.post('eliminar_usuario', {idusuario}, function() {
			window.location='';
		});
	});
}
</script>