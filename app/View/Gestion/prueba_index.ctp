<pre>
	<?php var_dump($data) ?>
</pre>
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
						 foreach($data as $d){
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