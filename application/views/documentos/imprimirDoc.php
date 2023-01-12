<script>
	window.print();
</script>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<BR>
	<div id="kt_content_container" class="container-fluid">
		<?php
		//	echo $enc[0]["ConsecutivoOC"];
		?>
		<div class="d-flex flex-column flex-xl-row">
			<!--begin::Content-->
			<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
				<!--begin::Invoice 2 content-->
				<div class="mt-n1">
					<div class="d-flex flex-row">

						<div class="d-flex flex-column flex-row-fluid">
							<div class="d-flex flex-row flex-column-fluid">
								<div class="d-flex flex-row-auto w-200px flex-center">
									<img alt="Logo" src="<?php echo base_url()?>/assets/img/LOGO.png">
								</div>
								<div class="d-flex flex-row-fluid flex-center">
									<table style="text-align: center" class="table table-sm">
										<thead>
										<tr >
											<th>
												<span class="h1">INDUSTRIAS DELMOR, S.A.</span><br>
												Km. 7 Carretera Sur, Managua, Nicaragua, C.A. <br>
												Tel: 2265-1708 / 2265-1637
											</th>
										</tr>
									</table>
								</div>

								<div class="d-flex flex-row-auto w-200px flex-center">
									<img alt="Logo" src="<?php echo base_url()?>/assets/img/img.png">
								</div>
							</div>
						</div>
					</div>
					<!--begin::Wrapper-->
					<div class="m-0">

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
									<div class="d-flex flex-row-fluid flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead>
											<tr >
												<th>
													<?php
														if($this->uri->segment(3) == 1){
															echo '<span class="h4">ORDEN COMPRA Y/O SERVICIO</span>';
														}else{
															echo '<span class="h4">ORDEN DE PAGO</span>';
													}
													?>
												</th>
											</tr>
										</table>
									</div>

									<div class="d-flex flex-row-auto w-200px flex-center">
										<?php
										if($this->uri->segment(3) == 1){
											echo '<span class="h4">'.$enc[0]["ConsecutivoOC"].'</span>';
										}else{
											echo '<span class="h4">'.$enc[0]["ConsecutivoOP"].'</span>';
										}
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-200px flex-center">
										<?php
										echo '<span class="h4 text-danger">'.$enc[0]["Consecutivo"].'</span>';
										?>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-200px flex-center">
										<?php
										$tipo = "";
										if($this->uri->segment(3) == 1){
											$tipo = "oc";
										}else{
											$tipo = "op";
										}
										echo '<span class="h6">Fecha '." ".$tipo.": ".date_format(new DateTime($enc[0]["FechaCrea"]),"d/m/Y")
												.'</span>';
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">

									<div class="d-flex flex-row-fluid flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead>
											<tr>
													<?php
														if($this->uri->segment(3) == 1){
															echo '<th style="width: 117px; text-align: end;">
																		SR. (ES):
																  </th>	';
														}else{
															echo '<th style="width: 135px; text-align: end;">
																		Páguese a:
																  </th>	';
														}
													?>
												<th class="text-start">
													<div class="border-gray-300 border-bottom">
														<?php
														$paguese = "";
														if($this->uri->segment(3) != 1){
															if($enc[0]["NombreCheque"] == ""){
																$paguese = $enc[0]["Proveedor"];
															}else{
																$paguese = $enc[0]["NombreCheque"];
															}
														}else{
															$paguese = $enc[0]["Proveedor"];
														}
														   echo '<span class="bold">'.$paguese.'</span>';
														?>
													</div>
												</th>
											</tr>
										</table>
									</div>


									<div class="d-flex flex-row-auto w-200px flex-center" style="text-align: end !important;">
										<?php
										if($this->uri->segment(3) != 1) {
											$moneda="";
											if($det){
												foreach ($det as $key){
													if($key["Moneda"] == "C"){
														$moneda = "C$";
													}else{
														$moneda = '$';
													}
												}
											}
											echo '<span class="h6 align-right">
											'.$moneda.'		
											' .number_format($enc[0]["Cantidad"], 2)
													. '</span>';
										}
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-fluid flex-center">
										<table class="table table-sm">
											<thead>
											<?php
												if($this->uri->segment(3) == 1){
													echo '
													<tr>
														<th style="width: 128px; text-align: end;">Observaciones:</th>
															<th class="text-start">
																<div class="border-gray-300 border-bottom">
																	<span class="bold">'.$enc[0]["Direccion"].'</span>
																</div>
														</th>
													</tr>';
												}else{
													echo '
													<tr>
														<th style="width: 166px; text-align: end;">La cantidad de:</th>
															<th class="text-start">
																<div class="border-gray-300 border-bottom">
																	<span class="bold">'.$enc[0]["CantidadDesc"].'</span>
																</div>
														</th>
													</tr>';
												}
											?>

										</table>
									</div>

								</div>
							</div>
						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-fluid flex-center">
										<table class="table table-sm">
											<thead>
											<?php
											if($this->uri->segment(3) != 1){
												echo '
													
													<tr>
														<th style="width: 166px; text-align: end;">En concepto de:</th>
															<th class="text-start">
																<div class="border-gray-300 border-bottom">
																	<span class="bold">'.$enc[0]["Concepto"].'</span>
																</div>
														</th>
													</tr>';
											}
											?>

										</table>
									</div>

								</div>
							</div>
						</div>

						<div class="d-flex flex-row">
							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-fluid flex-center">
										<table class="table table-sm text-center border table-row-bordered table-row-gray-300 ">
											<?php
												if($this->uri->segment(3) == 1){
													echo '
														<thead class="h6">
															<tr>
																<th style="border: 1px solid #DAD3C3 !important;">CANTIDAD</th>
																<th style="border: 1px solid #DAD3C3 !important;">UNIDAD <br> MEDIDA</th>
																<th style="border: 1px solid #DAD3C3 !important;">DESCRIPCION</th>
																<th style="border: 1px solid #DAD3C3 !important;">PRECIO</th>
																<th style="border: 1px solid #DAD3C3 !important;">TOTAL</th>
															</tr>
														</thead>
													';
													if($det){
														$sumOC = 0;$descOC = 0;
														$IVAOC = 0; $totalOC = 0;
														$descuento = 0;
														$moneda = "";
														echo "<tbody>";
														foreach ($det as $key){
															if($key["Moneda"] == "C"){
																$moneda = "C$";
															}else{
																$moneda = '$';
															}

															$sumOC += $key["SubTotal"];
															$descOC += $key["MontoDesc"];
															$IVAOC += $key["IVA"];
															$totalOC += $key["Total"];
															echo "
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["Cantidad"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["UnidadMedida"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["ArticuloProveedor"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($key["PrecioAntDescuento"],2)."</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($key["SubTotal"],2)."</td>
																</tr>
															";
														}
														$descuento =	$sumOC - $descOC;
														echo "
																 <tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>Subtotal</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".
																     $moneda." ".number_format($sumOC,2)
																."</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold; border: 1px solid #DAD3C3 !important; text-align: end; padding: 5px'>
																		Descuento</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>
																	".$moneda." ".number_format($descOC,2)."
																	</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>IVA</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px''>".$moneda." ".number_format($IVAOC,2)."</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>Total</td>
																	<td 
																	  style='border: 1px solid #DAD3C3 !important; text-align: end; padding: 5px'>
																	   ".$moneda." ".number_format($totalOC,2)."
																	</td>
																</tr>
														</tbody>";
													}
												}else{
													echo '
														<thead class="h6">
															<tr>
																<!--<th style="border: 1px solid #DAD3C3 !important;">PROFORMA</th>-->
																<th style="border: 1px solid #DAD3C3 !important;">CANTIDAD</th>
																<th style="border: 1px solid #DAD3C3 !important;">UNIDAD <br> MEDIDA</th>
																<th style="border: 1px solid #DAD3C3 !important;">DESCRIPCION</th>
																<th style="border: 1px solid #DAD3C3 !important;">PRECIO</th>
																<th style="border: 1px solid #DAD3C3 !important;">TOTAL</th>
															</tr>
														</thead>
													';
													if($det){
														$sumOC = 0;$descOC = 0;
														$IVAOC = 0; $totalOC = 0;
														$descuento = 0;
														$moneda = "";
														echo "<tbody>";
														foreach ($det as $key){
															if($key["Moneda"] == "C"){
																$moneda = "C$";
															}else{
																$moneda = '$';
															}
															$sumOC += $key["SubTotal"];
															$descOC += $key["MontoDesc"];
															$IVAOC += $key["IVA"];
															$totalOC += $key["Total"];
															//<td style='border: 1px solid #DAD3C3 !important;'>".$key["NumProforma"]."</td>
															echo "
																<tr>
																	
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["Cantidad"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["UnidadMedida"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$key["ArticuloProveedor"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($key["PrecioAntDescuento"],2)."</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($key["SubTotal"],2)."</td>
																</tr>
															";
														}
														$descuento =	$sumOC - $descOC;
														echo "
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>Subtotal</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".
																$moneda." ".number_format($sumOC,2)
																."</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>Descuento</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." "."(".number_format($key["PorcentDescuento"],0) ."%) ".number_format($descOC,2)."</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>IVA</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($IVAOC,2)."</td>
																</tr>
																<tr>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='border: 1px solid #DAD3C3 !important;'></td>
																	<td style='font-weight: bold;text-align: end; padding: 5px'>Total</td>
																	<td style='border: 1px solid #DAD3C3 !important;text-align: end; padding: 5px'>".$moneda." ".number_format($totalOC,2)."</td>
																</tr>
														</tbody>";
													}
												}

											?>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-200px flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead style="font-weight: bold">
											<tr>
												<?php
												if($this->uri->segment(3) != 1){
													echo '<th style="width: 117px; text-align: end;">
																		Retener:
																  </th>	';
												}
												?>
												<th class="text-start">
													<div class="border-gray-300">
														<?php
														if($this->uri->segment(3) != 1){
															echo $enc[0]["Retiene"];;
														}
														?>
													</div>
												</th>
											</tr>
										</table>
									</div>
									<div class="d-flex flex-row-fluid flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead style="font-weight: bold">
											<tr>
												<?php
												if($this->uri->segment(3) != 1){
													echo '<th style="width: 135px; text-align: end;">
																		Comentario:
																  </th>	';
												}
												?>
												<th class="text-start">
													<div class="border-gray-300">
														<?php
														if($this->uri->segment(3) != 1){
															echo $enc[0]["ComentarioRetiene"];
														}
														?>
													</div>
												</th>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<br><br>
						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-300px flex-center border-bottom mb-9">
										<div class="">
											<?= $enc[0]["Nombre"]?>
										</div>
									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-300px flex-center border-bottom mb-9">
										<div class="">

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-row" style="margin-top: -20px;">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-300px flex-center">
										<div class="">
											PREPARADO POR:
										</div>
									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-300px flex-center">
										<div class="">
											AUTORIZADO POR:
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Invoice 2 content-->
			</div>
			<!--end::Content-->
		</div>
	</div>
	<!--end::Container-->
</div>
