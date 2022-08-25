<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">ADMINISTRACION <small>.</small></h1>
	</div>
</div>
<div class="container-fluid"> 
	<h3 align="center">FORMULARIO NUEVO USUARIO</h3>

	<form id="guardarEditarUsuario" method="post">
		<div class="row">
			<div class="col-lg-3">
				<div class="from-group">
					<label>CANERT</label>
					<input type="text" value="<?php echo $obj->ci; ?>" class="form-control" disabled placeholder="Ingresar carnet...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>EXPEDIDO</label>
					<select name="expedido" id="expedido" class="form-control" required>
						<option></option>
						<option value="LP" <?php if($obj->expedido=='LP') echo "selected"; ?> >LP</option>
						<option value="CBB" <?php if($obj->expedido=='CBB') echo "selected"; ?> >CBB</option>
						<option value="TJ" <?php if($obj->expedido=='TJ') echo "selected"; ?> >TJ</option>
						<option value="PD" <?php if($obj->expedido=='PD') echo "selected"; ?> >PD</option>
						<option value="BN" <?php if($obj->expedido=='BN') echo "selected"; ?> >BN</option>
						<option value="STC" <?php if($obj->expedido=='STC') echo "selected"; ?> >STC</option>
					</select>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>NOMBRE</label>
					<input type="text" value="<?php echo $obj->nombre; ?>" name="nombre" id="nombre" class="form-control" required placeholder="Ingresar nombre...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>AP. PATERNO</label>
					<input type="text" value="<?php echo $obj->paterno; ?>" name="paterno" id="paterno" class="form-control" placeholder="Ingresar paterno...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>AP. MATERNO</label>
					<input type="text" value="<?php echo $obj->materno; ?>" name="materno" id="materno" class="form-control" placeholder="Ingresar materno...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>CELULAR</label>
					<input type="text" value="<?php echo $obj->celular; ?>" name="celular" id="celular" class="form-control" placeholder="Ingresar celular..." maxlength="8">
				</div>
			</div>

			<div class="col-lg-3">
				<div class="from-group">
					<label>IMAGEN</label>
					<input type="file" name="imagen" id="imagen" accept="image/*">

				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>SELECCIONE ROL</label>
					<select name="idrol" id="idrol" class="form-control" required>
						<option></option>
						<?php foreach ($this->db->get('rol')->result() as $obj1) { ?>
							<option value="<?php echo $obj1->idrol ?>" <?php if($obj1->idrol==$obj->idrol) echo "selected"; ?>><?php echo $obj1->roles ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<input type="hidden" name="idpersona" value="<?php echo $obj->idpersona ?>">
			<input type="hidden" name="idusuario" value="<?php echo $obj->idusuario ?>">
			<input type="hidden" name="imagen_a" value="<?php echo $obj->imagen ?>">

		</div>
		<button type="submit" id="boton" class="btn btn-primary btn-raised">GUARDAR DATOS</button>
		<a href="<?php echo base_url(); ?>adminUsuario" class="btn btn-danger btn-raised">SALIR</a>

	</form>

</div>
<script>

	
	$("#guardarEditarUsuario").submit(function(event){
		event.preventDefault();
		var formData=new FormData($("#guardarEditarUsuario")[0]);
		$.ajax({
			url:'<?php echo base_url(); ?>guardarEditarUsuario',
			type:'post',
			data:formData,
			cache:false,
			processData:false,
			contentType:false,
			success:function(){
				alert('DATOS REGISTRADO EXITOSAMENTE')
				window.location='<?php echo base_url(); ?>adminUsuario';
			}
		});
	});
</script>