
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">ADMINISTRACION <small>.</small></h1>
	</div>
</div>
<div class="container-fluid">
	<h3 align="center">REPORTE GRAFICO</h3>
	<div class="row">
		<div class="col-lg-12">
			<div id="graph"></div>
		</div>
	</div>

</div>
<script>
	$(document).ready(function(){
		var c=0;
		$.post('<?php echo base_url() ?>reporteGrafico', {c}, function(datos) {
			var valores=eval(datos);
			Morris.Donut({
			  element: 'graph',
			  data: [
			    {value: valores[0], label: 'ACTIVO' },
			    {value: valores[1], label: 'INACTIVO'  },
			    {value: valores[2], label: 'ELIMINADOS' }
			  ],
			  formatter: function (x) { return "Total:" + x; }
			});			
		});

	});
</script>