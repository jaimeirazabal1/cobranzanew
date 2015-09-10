<div class = "all" style="font-size:12px">
	<div class = "left">
		<fieldset style = "height: 100%;">
			<legend> Cartera Asignada </legend>
				<?php echo $this->element('Gestion/filtro_gestion')?>
				<div class = "clear"> </div>
			<div class = "table_info" id = "table_info_deudores" style = "max-height: 150px;">
				<div class = "inner_table">
					<table style="width:886px;" class="table_info_deudores">
						<tr>
							<th> Nombre	</th>
							<th> Cédula	</th>
							<th> Teléfono	</th>
							<th> FECHA_AS 	</th>
							<th> Fecha	</th>
							<th> Gestor	</th>
							<th> Saldo	</th>
						</tr>
						<?php $i = 0; 
						 foreach($deudores as $d){
							if ($i==0) {
								$class="seleccionado";
							} else {
								$class="";
							}
						?>
							<tr class = "tabla_deudores tr_deudores <?php echo $class ?>" name="<?php echo $d['Cobranza']['CEDULAORIF']?>">
								<td><?php echo $d['Cobranza']['NOMBRE']?></td>
								<td><?php echo $d['Cobranza']['CEDULAORIF']?></td>
								<td><?php echo $d['ClienGest']['telefono'] ?></td>
								<td><?php
								$fecha_asig = explode(' ',$d['Cobranza']['FECH_ASIG']);
								echo $fecha_asig[0]?>
								</td>
								<td><?php $fecha_p = explode(' ',$d['ClienGest']['proximag']);
								echo $fecha_p[0]
								?></td>
								<td name="<?php echo $d['Cobranza']['GESTOR'] ?>" class="gestor_seleccionado"><?php echo $d['Cobranza']['GESTOR'] ?></td>
								<td><?php echo 'Saldo'?></td>
							</tr>
						<?php 
						$i++;
						} ?>
					</table>
				</div>
			</div>
			<br>
			<div class = "datamol">
				<?php echo $this->element('Gestion/datamol')?>
			</div>
		</fieldset>
		<fieldset>
			<legend> Vistas </legend>
			<?php
			echo $this->Form->input('Gestión',array(
				'type' => 'button',
				'label' => false,
				'class' => 'accesos_directos click_gestion',
				'style' => 'margin-top: 9px;',
				'name' => 'agregar'
			));
			echo $this->Form->input('Pagos',array(
				'type' => 'button',
				'label' => false,
				'class' => 'accesos_directos boton_pagos'
			));
			echo $this->Form->input('Histórico',array(
				'type' => 'button',
				'label' => false,
				'class' => 'accesos_directos'
			));
			echo $this->Form->input('Rel. Pagos',array(
				'type' => 'button',
				'label' => false,
				'class' => 'accesos_directos'
			));
			echo $this->Form->input('Cerrar',array(
				'type' => 'button',
				'label' => false,
				'class' => 'accesos_directos'
			));
			?>
		</fieldset>
	</div>
	<?php
	echo '<div class = "pestanas_wrapper"><div id = "pestanas_empresas"><div class = "inner_pestanas">';
		foreach ($empresas as $e) { 
			echo '<div style= "cursor:pointer" name = "'.$e['Cliente']['rif'].'" class="nombre_empresa">'.$e['Cliente']['nombre'].'</div>';
		}
	echo '</div></div></div>';
	$c= 0;
	foreach ($empresas as $e) { //esto hace que todo se imprima tantas veces empresas hayan 
		if ($c == 0 ) {
			$display = 'block';
		} else {
			$display = 'none';
		}
	?>
		<script>
			prueba();
			function prueba(){
				$( ".nombre_empresa:first" ).addClass( "selected_pestana" );
				$( ".nombre_empresa" ).click(function(){
					$( ".nombre_empresa" ).removeClass("selected_pestana");
					$(this).addClass( "selected_pestana" );
				});
			}
			
		</script>
		<div class = "right_wrap" style="display:<?php echo $display?>" id = "<?php echo $e['Cliente']['rif'] ?>">
			<fieldset style = "height: 100%;">
				<legend> Detalle </legend>
				<div class = "edit_datos_deudor">
					<?php echo $this->Html->image('listEdit.png',array('style' => 'margin-bottom:13px','title' => 'Modficar Datos Deudor','class' => 'click_datos_deudor', 'name' => 'editar')); ?><br>
				</div>
				<div class = "deudor_datos">
					<fieldset>
						<legend> Datos del deudor </legend>
						<div class = "left">
							
							<b class = 'deudor_nombre'> <?php echo $deudores[0]['Cobranza']['NOMBRE']?> </b><br>
							<b class = 'deudor_cedula'> <?php echo $deudores[0]['Cobranza']['CEDULAORIF']?></b>
							<br>
							Status:<b class = 'deudor_cond_pago'> <?php echo $cond_pago['Statu']['condicion'] ?> </b> <br>
							Gestor: <b class = 'deudor_gestor'> <?php echo $deudores[0]['Gestor']['Nombre']?></b>
							<br>
							Supervisor: <b class = 'deudor_supervisor'> <?php echo $supervisor; ?> </b>
						</div>
						<div class = "left">
							
							Teléfonos / Dirección <div class = "click_telefonos_deudor">
								<?php echo $this->Html->image('listAddContacts.png',array('style' => 'margin-bottom:13px','title' => 'Agregar Teléfono Deudor','class' => 's', 'name' => 'editar')); ?>
							</div>
							<div class = "deudor_telefonos">
								 <b class = 'deudor_telefono'>									
								<?php
									foreach($telefonos as $t){
										echo $t['Telefono']['telefono'].' - '.$t['Telefono']['ubicacion'].' - '. $t['Telefono']['direccion'].'<br>';
									}
								?>
								</b> <br>
							</div>
							<!--Dirección: <b class = 'deudor_direccion'> <?php //echo $data_deudor['Data']['Direccion'] ?></b> -->
						</div>
						<div class = "right">
							<?php $fecha_asig = explode(' ',$deudores[0]['Cobranza']['FECH_ASIG']);?>
							Asignado: <b class = 'deudor_fecha_asig'> <?php echo $fecha_asig[0]?></b> <br>
							<?php $proxima_g = explode(' ',$deudores[0]['ClienGest']['proximag']); ?>
							Próxima Gestión: <b class = 'deudor_proxima_ges'> <?php echo $proxima_g[0]; ?> </b> <br>
							 Nombre del Banco: <b class = 'deudor_banco'><?php echo $cond_pago['Cliente']['nombre']; ?></b>
						</div>
					</fieldset>
				</div>
			</fieldset>
			<fieldset>
				<legend> Gestiones  </legend>
					<?php 
					if ($c==0) {
						$clase = 'tabla_gestiones_seleccionado';
					} else {
						$clase = '';
					}
					?>
					<div class = "tabla_gestiones <?php echo $clase ?>" id ="tabla_gestiones">
						<table style  = "width: 795px; float: left;">
							<tr class="encabezado">
								<th> Nro	</th>
								<th> Fecha </th>
								<th> Teléfono </th>
								<th> Producto </th>
								<th> cond_deud	</th>
								<th> proximag </th>
								<th> contacto </th>
								<th> Gestor </th>
								<th> Supervisor </th>
							</tr>
						<?php 
							$i = 0;
							foreach($gestiones[$e['Cliente']['rif']] as $g){
								if ($i==0 && $c==0) {
									$clase = 'seleccionado';
								} else {
									$clase = '';
								}
							?>
								<tr class = "inner_gestiones <?php echo $clase?>" name = "<?pHp echo $g['ClienGest']['id']?>">
									<td><?php echo $g['ClienGest']['numero']?></td>
									<?php $fecha = explode(' ',$g['ClienGest']['fecha_reg']); ?>
									<td class="gestion_fecha_reg" name="<?php echo $fecha[0] ?>"><?php echo $fecha[0] ?></td>
									<td class="gestion_telefono" name="<?php echo $g['ClienGest']['telefono']?>"><?php echo $g['ClienGest']['telefono']?></td>
									<td class="gestion_producto" name="<?php echo $g['ClienGest']['producto']?>"><?php echo $g['ClienGest']['producto']?></td>
									<td  class="gestion_cond_deud" name="<?php echo $g['ClienGest']['cond_deud']?>"><?php echo $g['ClienGest']['cond_deud']?></td>
									<td class="gestion_proximag" name="<?php echo $g['ClienGest']['proximag']?>"><?php echo $g['ClienGest']['proximag']?></td>
									<td class="gestion_contacto" name="<?php echo $g['ClienGest']['contacto']?>"><?php echo $g['ClienGest']['contacto']?></td>
									<td class="gestion_gestor" name="<?php echo $g['Cobranza']['GESTOR']?>"><?php echo $g['Cobranza']['GESTOR']?></td>
									<td class="gestion_supervisor" name="<?php echo $supervisor ?>"><?php echo $supervisor ?></td>
								</tr>
							<?php 
							$i++;
							} ?>
						</table>
					</div>
					<div class = "botones_gestiones" style = "float: left;margin-left: -20px;margin-right: 15px;">
						<?php echo $this->Html->image('listEdit.png',array('style' => 'margin-bottom:13px','title' => 'Modficar gestión','class' => 'click_gestion', 'name' => 'editar')); ?><br>
						<?php
                        if ($e['Cliente']['rif'] == 11) {
                            echo $this->Html->image('listDelete.gif',array('style' => 'margin-bottom:13px','title' => 'Eliminar gestión')).'<br>';
                        }
                        ?>
                      <?php echo $this->Html->image('msj.png',array('style' => 'width:16px;','title' => 'Enviar mensaje al gestor')); ?>
					</div>
					<?php 
					if ($c==0) {
						$clase = 'comentario_seleccionado';
					} else {
						$clase = "";
					}
					?>
					<div class = "comentario_gestiones <?php echo $clase?>" style = "float: left; width: 100px;">
						<?php
							echo $this->Form->input('Comentarios', array(
								'class' => 'large_input input_comentario',
								'type' => 'textarea',
								'value' => $gestiones[$e['Cliente']['rif']][0]['ClienGest']['observac'],
								'id' => 'input_comentario',
							));
						?>
						<?php
							echo $this->Form->input('Comentarios', array(
								'class' => 'large_input',
								'type' => 'textarea',
								'value' => $gestiones[$e['Cliente']['rif']][0]['ClienGest']['Observac1'],
								'id' => 'input_comentario2',
							));
						?>
					</div>
			</fieldset>
			<fieldset>
				<legend> Productos  </legend>
				<div class = "tabla_productos">
					<table class = "inner_tabla_productos"  style="width:795px;">
							<tr>
								<th> Producto 	</th>
								<th> Cuenta	</th>
								<th> Capital</th>
								<th> Intereses 	</th>
								<th> MtoTotal	</th>
								<th> DiasMora	</th>
								<th> Cuotas	</th>
								<th> MontoCuota	</th>
								<th> CapInicial	</th>
								<th> CuentaAsocPago	</th>
								<th> Rif_emp	</th>
								<th> Contrato	</th>
								<th> DescProd1	</th>
								<th> DescProd2	</th>
							</tr>
							<tr class = "inner_gestiones">
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
							</tr>
						</table>
					</div>
			</fieldset>
			<fieldset>
				<legend> Estado de Cuenta  </legend>
				<div class = "tabla_edo_cuenta">
					<table style = "float: left; width: 795px;" class = 'inner_tabla_edo_cuentas'>
						<tr class="encabezado">
							<th> Fech_Reg 	</th>
							<th> Fech_Pago 	</th>
							<th> Total_Pago	</th>
							<th> Producto 	</th>
							<th> Cuenta	</th>
							<th> Est_Pago	</th>
							<th> efectivo	</th>
							<th> mto_cheq1	</th>
							<th> mto_otros	</th>
							<th> nro_efect	</th>
							<th> nro_otro	</th>
							<th> cond_pago	</th>
							<th> login_reg	</th>
							
						</tr>
							<tr class = "inner_pagos">
								<td> - 	</td>
								<td> - 	</td>
								<td> -	</td>
								<td> - 	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
								<td> -	</td>
							</tr>
					</table>
				</div>
					<div class = "comentario_estado">
						<?php
							echo $this->Form->input('Saldo Inicial', array(
								'class' => 'estado_input'
							));
							echo $this->Form->input('Saldo Actual', array(
								'class' => 'estado_input'
							));
							echo $this->Form->input('Pagos', array(
								'class' => 'estado_input'
							));
						?>
					</div>
			</fieldset>
		</div>
	<?php 
		$c = $c+1;
	}
	?>
</div>
<div id = "editar_datos_deudor" style = "display:none;" title = "Modificando datos deudor">
	<?php echo $this->element('Gestion/editar_deudor'); ?>
</div>
<div id="editar_gestion" style="display:none" title="Modificando gestión">
	<?php echo $this->element('Gestion/editar_gestion'); ?>
</div>
<div id="agregar_telefono_deudor" style="display:none" title="Agregando Teléfono">
	<?php echo $this->element('Gestion/agregar_telefono'); ?>
<div id="vista_pagos" style="display:none" title="Recepción de Pagos">
	<?php echo $this->element('Gestion/pagos'); ?>
</div>
<script>
//Modificar datos de deudor
// mostrar_datos_modal();

	function mostrar_deudor_modal(){
		$('#editar_datos_deudor').dialog();
		deudor_nombre = $('.deudor_nombre:first').text();
		deudor_cedula = $('.deudor_cedula:first').text();
		deudor_cond_pago = $('.deudor_cond_pago:first').text();
		deudor_gestor = $('.deudor_gestor:first').text();
		deudor_supervisor = $('.deudor_supervisor:first').text();
		deudor_telefono = $('.deudor_telefono:first').text();
		deudor_direccion = $('.deudor_direccion:first').text();
		deudor_fecha_asig = $('.deudor_fecha_asig:first').text();
		deudor_proxima_ges = $('.deudor_proxima_ges:first').text();
		deudor_banco = $('.deudor_banco:first').text();
		
		$('#CobranzaNombre').val($.trim(deudor_nombre));
		$('#CobranzaCedulaorif').val($.trim(deudor_cedula));
		$('#DeudorClienGestTelefono').val($.trim(deudor_telefono));
		$('#StatuCondicion').val($.trim(deudor_cond_pago));
		$('#GestorNombre').val($.trim(deudor_gestor));
		$('#UserSupervisor').val($.trim(deudor_supervisor));
		$('#DataDireccion').val($.trim(deudor_direccion));
		$('#CobranzaFechAsig').val($.trim(deudor_fecha_asig));
		$('#ClienGestProximaG').val($.trim(deudor_proxima_ges));
		$('#CobranzaNombre').val($.trim(deudor_nombre));
	}

	$('.click_datos_deudor').click(function(){
		mostrar_deudor_modal();
	});

	$('.click_telefonos_deudor').click(function(){ // al hacer click en agregar, 
												   //muestra la modal para agregar nuevo telefono
		$('#agregar_telefono_deudor').dialog();
		
		deudor_cedula = $('.deudor_cedula:first').text();
		$('#cedulaDeudor').val($.trim(deudor_cedula));
	});
	
// Fin Modificar datos de deudor

//Hacer click en una empresa
$("#pestanas_empresas").delegate('.nombre_empresa','click', function(){
	$('.right_wrap').hide();
	id = $(this).attr('name');
	//seleccion la tabla gestiones
	$('.tabla_gestiones').removeClass('tabla_gestiones_seleccionado');
	$('#'+id+' .tabla_gestiones').addClass('tabla_gestiones_seleccionado');
	//Selecciono el comentario para poderlo editar 
	$('.comentario_gestiones').removeClass('comentario_seleccionado');
	$('#'+id+' .comentario_gestiones').addClass('comentario_seleccionado');
	//Selecciono la primera gestion
	$('.inner_gestiones').removeClass('seleccionado');
	$('#'+id+' .tabla_gestiones tr.inner_gestiones').first().addClass('seleccionado');
	$('#'+id).show();
	
});

//Hacer click en una fila de la tabla deudores
$(".table_info").delegate('.tabla_deudores','click', function(){
	$(".tabla_deudores").removeClass('seleccionado'); 
	$(this).addClass('seleccionado');
	
	//Se carga la info de la parte derecha
	cedula = $(this).attr('name'); //Uso el name para saber a que deudor se le dio click
	cargar_datamol(cedula);
	cargar_pestanas(cedula);
	cargar_info(cedula);
	cargar_producto(cedula);
	cargar_pagos(cedula);
	
});

function cargar_pestanas(cedula){ // carga toda la tabla de productos asociada a un deudor
	$.ajax({
			type:'POST',
			dataType:'JSON',
			data:{cedula:cedula},
			url:"<?php echo Router::url(array('action'=>'cargar_empresas')); ?>",
			success:function(data){
				//Cargo las pestanas de las empresas
				i = 0;
				empresas = '';
				$.each(data,function(i,v){
					if (i == 0) {
						$('.right_wrap').hide();
						$('#'+v.Cliente.rif).show(); //Esto es para que se este mostrando siempre la primera pestaña
					}
					empresas+= '<div class = "inner_pestanas"><div style="cursor:pointer" name ="'+v.Cliente.rif+'" class="nombre_empresa">'+v.Cliente.nombre+'</div></div>';
					i++;
				});
				$('#pestanas_empresas').html(empresas);
				prueba(); // llama a la función para cambiar el estilo de las pestañas seleccionadas
			},error: function() {
				alert("error_empresa");
			}
	});
}

function cargar_producto(cedula){ // carga toda la tabla de productos asociada a un deudor
	$.ajax({
			type:'POST',
			dataType:'JSON',
			data:{cedula:cedula},
			url:"<?php echo Router::url(array('action'=>'cargar_info_producto')); ?>",
			success:function(data){
				//Cargo producto del deudor
				// producto_datos = data.productos[0].Producto.CUENTA
				// console.debug(total = data);
				$.each(data.empresas,function(a,b){
					i = 0;
					info_producto = '';
					info_producto += '<tr><th> Producto 	</th>';
					info_producto += '<th> Cuenta </th>';
					info_producto += '<th> Capital</th>';
					info_producto += '<th> Intereses 	</th>';
					info_producto += '<th> MtoTotal	</th>';
					info_producto += '<th> DiasMora	</th>';
					info_producto += '<th> Cuotas	</th>';
					info_producto += '<th> MontoCuota	</th>';
					info_producto += '<th> CapInicial	</th>';
					info_producto += '<th> CuentaAsocPago	</th>';
					info_producto += '<th> Rif_emp	</th>';
					info_producto += '<th> Contrato	</th>';
					info_producto += '<th> DescProd1	</th>';
					info_producto += '<th> DescProd2	</th></tr>';
					$.each(data.productos[b.Cliente.rif],function(i,v){
						// console.debug(v.ClienProd.Contrato);
						if (i==0) {
							clase = 'seleccionado';
						} else {
							clase = '';
						}
						info_producto += '<tr class = " inner_gestiones ' + clase +'"><td>'+v.Producto.producto+'</td>';
						info_producto += '<td>'+v.ClienProd.CUENTA+'</td>';
						info_producto += '<td>'+v.ClienProd.SaldoInicial+'</td>';
						info_producto += '<td>'+v.ClienProd.Interes+'</td>';
						info_producto += '<td>'+v.ClienProd.MtoTotal+'</td>';
						info_producto += '<td>'+v.ClienProd.DIASMORA+'</td>';
						info_producto += '<td>'+v.ClienProd.NroCuotas+'</td>';
						info_producto += '<td>'+v.ClienProd.NroCuotas+'</td>';
						info_producto += '<td>'+v.ClienProd.NroCuotas+'</td>';
						info_producto += '<td>'+v.ClienProd.CtaAsocPago+'</td>';
						info_producto += '<td>'+v.ClienProd.RIF_EMP+'</td>';
						info_producto += '<td>'+v.ClienProd.Contrato+'</td>';
						info_producto += '<td>'+v.ClienProd.DescProd1+'</td>';
						info_producto += '<td>'+v.ClienProd.DescProd2+'</td>';
						info_producto += '</tr>';
						
						i++;
					});
					$('#'+b.Cliente.rif+' .tabla_productos .inner_tabla_productos').html(info_producto);
				});
			},error: function() {
				alert("error_producto");
			}
	});
}

function cargar_pagos(cedula){ // carga toda la tabla de productos asociada a un deudor
	$.ajax({
			type:'POST',
			dataType:'JSON',
			data:{cedula:cedula},
			url:"<?php echo Router::url(array('action'=>'cargar_info_pagos')); ?>",
			success:function(data){
				//Cargo producto del deudor
				// producto_datos = data.productos[0].Producto.CUENTA
				// console.debug(total = data);
				$.each(data.empresas,function(a,b){
					i = 0;
					info_pago = '';
					info_pago += '<tr class="encabezado"><th> Fech_Reg 	</th>';
					info_pago += '<th> Fech_Pago 	</th>';
					info_pago += '<th> Total_Pago	</th>';
					info_pago += '<th> Producto 	</th>';
					info_pago += '<th> Cuenta	</th>';
					info_pago += '<th> Est_Pago	</th>';
					info_pago += '<th> efectivo	</th>';
					info_pago += '<th> mto_cheq1	</th>';
					info_pago += '<th> mto_otros	</th>';
					info_pago += '<th> nro_efect	</th>';
					info_pago += '<th> nro_otro	</th>';
					info_pago += '<th> cond_pago	</th>';
					info_pago += '<th> login_reg	</th>';
					info_pago += '</tr>';
					$.each(data.pagos[b.Cliente.rif],function(i,v){
						// console.debug(v.ClienProd.Contrato);
						if (i==0) {
							clase = 'seleccionado';
						} else {
							clase = '';
						}
						info_pago += '<tr class =" inner_pagos ' + clase +'"><td>'+v.ClienPago.FECH_REG+'</td>';
						info_pago += '<td>'+v.ClienPago.FECH_PAGO+'</td>';
						info_pago += '<td>'+v.ClienPago.TOTAL_PAGO+'</td>';
						info_pago += '<td>'+v.ClienPago.PRODUCTO+'</td>';
						info_pago += '<td>'+v.ClienPago.CUENTA+'</td>';
						info_pago += '<td>'+v.ClienPago.EST_PAGO+'</td>';
						info_pago += '<td>'+v.ClienPago.EFECTIVO+'</td>';
						info_pago += '<td>'+v.ClienPago.MTO_CHEQ1+'</td>';
						info_pago += '<td>'+v.ClienPago.MTO_OTROS+'</td>';
						info_pago += '<td>'+v.ClienPago.Nro_Efect+'</td>';
						info_pago += '<td>'+v.ClienPago.NRO_OTRO+'</td>';
						info_pago += '<td>'+v.ClienPago.COND_PAGO+'</td>';
						info_pago += '<td>'+v.ClienPago.LOGIN_REG+'</td>';
						info_pago += '</tr>';
						
						i++;
					});
					$('#'+b.Cliente.rif+' .tabla_edo_cuenta .inner_tabla_edo_cuentas').html(info_pago);
					
					$('#'+b.Cliente.rif+' .estado_input').val(Math.random()*100);
				});
			},error: function() {
				alert("error_pagos");
			}
	});
}

$(".inner_tabla_productos").delegate('.inner_gestiones','click', function(){
	$(".inner_tabla_productos .inner_gestiones").removeClass('seleccionado');
	$(this).addClass('seleccionado');
});

$(".tabla_edo_cuenta").delegate('.inner_gestiones','click', function(){
	$(".tabla_edo_cuenta .inner_gestiones").removeClass('seleccionado');
	$(this).addClass('seleccionado');
});

$(".tabla_gestiones").delegate('.inner_gestiones','click', function(){
	$(".tabla_gestiones .inner_gestiones").removeClass('seleccionado');
	$(this).addClass('seleccionado');
	
	//Cargar la info del comentario
	gestion_id = $(this).attr('name');
	cargar_info_comentario(gestion_id)
});

function cargar_info_comentario(gestion_id) {
	$.ajax({
		type:'POST',
		dataType:'JSON',
		data:{gestion_id:gestion_id},
		url:"<?php echo Router::url(array('action'=>'cargar_info_comentario')); ?>",
		success:function(data){
			$('.input_comentario').val(data.observacion);
		},error: function() {
			alert("error_comentario");
		}
	});
}

function cargar_info(cedula){
	$.ajax({
			type:'POST',
			dataType:'JSON',
			data:{cedula:cedula},
			url:"<?php echo Router::url(array('action'=>'cargar_info_deudor')); ?>",
			success:function(data){
				$.each(data.empresas,function(a,b){
					//Cargo la info del deudor
					deudor_datos = '<fieldset><legend> Datos del deudor </legend><div class = "left">';
					deudor_datos += 
					'<b class = "deudor_nombre">'+ data.gestiones[data.empresas[0].Cliente.rif][0].Cobranza.NOMBRE+'</b><br><b class = "deudor_cedula">'+data.gestiones[data.empresas[0].Cliente.rif][0].Cobranza.CEDULAORIF+
					'</b><br> Status: <b class = "deudor_cond_pago">'+ data.cond_pago+'</b><br> Gestor: <b class = "deudor_gestor">' +data.gestiones[data.empresas[0].Cliente.rif][0].Gestor.Nombre+
					'</b><br>Supervisor: <b class = "deudor_supervisor">'+data.supervisor+'</b>';
					deudor_datos +=
					'</div><div class = "left">Teléfonos: <div class = "deudor_telefonos"><b class = "deudor_telefono">';
					
					$.each(data.telefonos,function(i,v){
						// console.debug(v.Telefono.telefono);
						deudor_datos += v.Telefono.telefono + ' - ' + v.Telefono.ubicacion + ' - ' + v.Telefono.direccion + '<br>'; 
					});					
					
					deudor_datos += '</b> <br></div>';
					console.debug(data.data_deudor);
					deudor_datos += 'Dirección: <b class = "deudor_direccion">'+ data.data_deudor.Data.Direccion+ '</b></div><div class = "right">';
					// console.debug(data.gestiones[data.empresas[0].Cliente.rif][0].ClienGest.cond_deud);
					fecha_asig = data.gestiones[data.empresas[0].Cliente.rif][0].Cobranza.FECH_ASIG.split(" ");
					deudor_datos += 'Asignado: <b class = "deudor_fecha_asig">'+fecha_asig+'</b><br>';
					proxima_g = data.gestiones[data.empresas[0].Cliente.rif][0].ClienGest.proximag.split(" ");
					deudor_datos += 'Próxima Gestión: <b class = "deudor_proxima_ges">'+proxima_g+
					'</b><br> Nombre del Banco: '+ data.empresas[0].Cliente.nombre +'</b></div></fieldset>';
					$('.deudor_datos').html(deudor_datos);
					//Cargo la tabla gestiones
					info_gestiones = '<table style  = "width:795px; float: left;"><tr><th> Nro	</th><th> Fecha </th><th> Teléfono </th><th> Producto	</th><th> cond_deud	</th><th> proximag </th><th> contacto </th><th> Gestor </th><th> Supervisor </th></tr>';
					i = 0;
					$.each(data.gestiones[b.Cliente.rif],function(i,v){
						if (i==0) {
							clase = 'seleccionado';
						} else {
							clase = '';
						}
						info_gestiones += '<tr class = "inner_gestiones '+clase+'" name="'+v.ClienGest.id+'">';
						info_gestiones += '<td>'+v.ClienGest.numero+'</td>';
						var fecha = v.ClienGest.fecha.split(" ");
						info_gestiones += '<td class="gestion_fecha_reg" name = "'+fecha[0]+'">'+fecha[0]+'</td>';
						info_gestiones += '<td class="gestion_telefono" name = "'+v.ClienGest.telefono+'">'+v.ClienGest.telefono+'</td>';
						info_gestiones += '<td class="gestion_producto" name = "'+v.ClienGest.producto+'">'+v.ClienGest.producto+'</td>';
						info_gestiones += '<td class="gestion_cond_deud" name = "'+v.ClienGest.cond_deud+'">'+v.ClienGest.cond_deud+'</td>';
						info_gestiones += '<td class="gestion_proximag" name = "'+v.ClienGest.proximag+'">'+v.ClienGest.proximag+'</td>';
						info_gestiones += '<td class="gestion_contacto" name = "'+v.ClienGest.contacto+'">'+v.ClienGest.contacto+'</td>';
						info_gestiones += '<td class="gestion_gestor" name = "'+v.Cobranza.GESTOR+'">'+v.Cobranza.GESTOR+'</td>';
						info_gestiones += '<td class=""gestion_supervisor" name "'+data.supervisor+'">'+data.supervisor+'</td>';
						info_gestiones += '</tr>';
						i++;
					});
					info_gestiones += '</table>';
					$('#'+b.Cliente.rif+' #tabla_gestiones').html(info_gestiones);
					
					//Llenando comentarios (observacion)
					$('#'+b.Cliente.rif+' #input_comentario').val(data.gestiones[b.Cliente.rif][0].ClienGest.observac);
				});
			},error: function() {
				alert("error gestion");
			}
	});
}

//  calendario jquery

$('#pickDate').datepicker({
    dateFormat: "dd-mm-yy",
});

</script>