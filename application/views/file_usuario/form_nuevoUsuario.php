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

			<div class="col-lg-3">
				<div class="from-group">
					<label>USUARIO</label>
					<input type="text" name="usuario" id="usuario" onkeyup="verificar_usuarios(this.value)" class="form-control" placeholder="Ingresar usuario...">
					<i id="error"></i>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="from-group">
					<label>CONTRASEÑA</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Ingresar password...">
				</div>
			</div>

			<div id="valores">
				<input type="hidden" name="idpersona" value="0" >
			</div>

		</div>
		<button type="submit" id="boton" class="btn btn-primary btn-raised">GUARDAR DATOS</button>
		<a href="adminUsuario" class="btn btn-danger btn-raised">SALIR</a>

	</form>

</div>
<script>
	function verificar_usuarios(user){
		$("#error").html('');

		$.post('verificar_usuarios', {user}, function(data) {
			var valores=eval(data)
			if(valores[0]===1){
				$("#error").html('<b style="color:#ff0000">Usuario ya existe</b>');
				document.getElementById('boton').disabled=true;
			}else{
				$("#error").html('<b style="color:#008000">Usuario no existe</b>');
				document.getElementById('boton').disabled=false;
			}
		});
	}
	function validar_ci(ci){

		$("#error").html('');

		$.post('validar_ci', {ci}, function(data) {
			var valores=eval(data)
			if(valores[0]===0){
				$('#expedido').removeAttr('disabled');
				$('#expedido > option');

				$("#nombre").removeAttr('disabled');
				$("#nombre").val('');

				$("#paterno").removeAttr('disabled');
				$("#paterno").val('');

				$("#materno").removeAttr('disabled');
				$("#materno").val('');

				$("#celular").removeAttr('disabled');
				$("#celular").val('');

				$("#imagen").removeAttr('disabled');
				$("#imagen").val('');

				$('#idrol').removeAttr('disabled');
				$('#idrol > option');

				$("#usuario").removeAttr('disabled');
				$("#usuario").val('');

				$("#password").removeAttr('disabled');
				$("#password").val('');

				$("#valores").html('<input type="hidden" name="idpersona" value="0" >');
				document.getElementById('boton').disabled=false;
			}else{
				if (valores[7]==='persona') { 

					$('#expedido').attr("disabled","disabled");
					$('#expedido > option[value='+valores[1]+']').attr("selected",true);

					$("#nombre").attr("disabled","disabled");
					$("#nombre").val(valores[2]);

					$("#paterno").attr("disabled","disabled");
					$("#paterno").val(valores[3]);

					$("#materno").attr("disabled","disabled");
					$("#materno").val(valores[4]);

					$("#celular").attr("disabled","disabled");
					$("#celular").val(valores[5]);

					$("#imagen").removeAttr('disabled');
					$("#imagen").val('');

					$('#idrol').removeAttr('disabled');
					$('#idrol > option');

					$("#usuario").removeAttr('disabled');
					$("#usuario").val('');

					$("#password").removeAttr('disabled');
					$("#password").val('');

					$("#valores").html('<input type="hidden" name="idpersona" value="'+valores[6]+'" >');
					document.getElementById('boton').disabled=false;
				}else{
					$('#expedido').attr("disabled","disabled");
					$('#expedido > option[value='+valores[1]+']').attr("selected",true);

					$("#nombre").attr("disabled","disabled");
					$("#nombre").val(valores[2]);

					$("#paterno").attr("disabled","disabled");
					$("#paterno").val(valores[3]);

					$("#materno").attr("disabled","disabled");
					$("#materno").val(valores[4]);

					$("#celular").attr("disabled","disabled");
					$("#celular").val(valores[5]);

					$("#imagen").attr("disabled","disabled");
					$("#imagen").val('');

					$('#idrol').attr("disabled","disabled");
					$('#idrol > option[value='+valores[8]+']').attr("selected",true);

					$("#usuario").attr("disabled","disabled");
					$("#usuario").val('');

					$("#password").attr("disabled","disabled");
					$("#password").val('');

					$("#valores").html('<input type="hidden" name="idpersona" value="'+valores[6]+'" >	<b style="color:#ff0000">USUARIO YA SE ENCUENTRA ACTIVO</b> ');

					document.getElementById('boton').disabled=true;
				}

			}
		});
	}
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