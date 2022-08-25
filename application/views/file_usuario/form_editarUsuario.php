<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">ADMINISTRACION <small>.</small></h1>
	</div>
</div>
<div class="container-fluid"> 
	<h3 align="center">FORMULARIO NUEVO USUARIO</h3>

	<form id="guardarNuevoUsuario" method="post">
		<div class="row">
			<div class="col-lg-3">
				<div class="from-group">
					<label>CANERT</label>
					<input type="text" name="ci" id="ci" onkeyup="validar_ci(this.value)" class="form-control" required placeholder="Ingresar carnet...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>EXPEDIDO</label>
					<select name="expedido" id="expedido" class="form-control" required>
						<option></option>
						<option value="LP">LP</option>
						<option value="CBB">CBB</option>
						<option value="TJ">TJ</option>
						<option value="PD">PD</option>
						<option value="BN">BN</option>
						<option value="STC">STC</option>
					</select>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>NOMBRE</label>
					<input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Ingresar nombre...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>AP. PATERNO</label>
					<input type="text" name="paterno" id="paterno" class="form-control" placeholder="Ingresar paterno...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>AP. MATERNO</label>
					<input type="text" name="materno" id="materno" class="form-control" placeholder="Ingresar materno...">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>CELULAR</label>
					<input type="text" name="celular" id="celular" class="form-control" placeholder="Ingresar celular..." maxlength="8">
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
						<?php foreach ($this->db->get('rol')->result() as $obj) { ?>
							<option value="<?php echo $obj->idrol ?>"><?php echo $obj->roles ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

		</div>
		<button type="submit" id="boton" class="btn btn-primary btn-raised">GUARDAR DATOS</button>
		<a href="adminUsuario" class="btn btn-danger btn-raised">SALIR</a>

	</form>

</div>
<script>

	
	$("#guardarNuevoUsuario").submit(function(event){
		event.preventDefault();
		var formData=new FormData($("#guardarNuevoUsuario")[0]);
		$.ajax({
			url:'guardarNuevoUsuario',
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