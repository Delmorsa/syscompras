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
									<table class="table table-sm table-sm text-center border table-row-bordered table-row-gray-300">
										<thead>
										<tr class="">
											<th style='border: 1px solid #DAD3C3 !important;'>Dia</th>
											<th style='border: 1px solid #DAD3C3;'>Mes</th>
											<th style='border: 1px solid #DAD3C3 !important;'>Año</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<?php
												echo "
												<td style='border: 1px solid #DAD3C3 !important;'>".date_format(new DateTime($enc[0]["FechaAutoriza"]), "d")."</td>
												<td style='border: 1px solid #DAD3C3 !important;'>".date_format(new DateTime($enc[0]["FechaAutoriza"]), "m")."</td>
												<td style='border: 1px solid #DAD3C3 !important;'>".date_format(new DateTime($enc[0]["FechaAutoriza"]), "Y")."</td>
												";
											?>

										</tr>
										</tbody>
									</table>
								</div>
								<div class="d-flex flex-row-fluid flex-center">
									<table style="text-align: center" class="table table-sm">
										<thead>
										<tr >
											<th>
												
												<span class="h1">INDUSTRIAS DELMOR, S.A.</span><br>
												<p class="h4">Solicitud de Compra y/o Servicio</p> <br>
											</th>
										</tr>
									</table>
								</div>

								<div class="d-flex flex-row-auto w-200px flex-center">
									<img alt="Logo" src="<?php echo base_url()?>/assets/img/LOGO.png">
								</div>
							</div>
						</div>

					</div>
					<div class="d-flex flex-row">

						<div class="d-flex flex-column flex-row-fluid">
							<div class="d-flex flex-row flex-column-fluid">
								<div class="d-flex flex-row-auto w-300px flex-center">
									<table class="table table-sm  table-sm text-center  table-row-gray-300">
										<thead>
											<tr>
												<?php
												  echo "
												       <th style='font-size: 12pt;font-weight: bold' class='text-danger text-start'>Solicitud N° ".$enc[0]["Consecutivo"]."</th>
											    	";
												?>
											</tr>
											<tr>
												<?php
												$estado = '';
												switch ($enc[0]["Estado"]) {
													case 'A':
														 //$estado = 'Abierta';	
													    break;
													case 'P':
														//$estado = 'En proceso';
													    break;
													case 'R':
														//$estado = 'Rechazada';
														break;
													case 'S':
														$estado = 'Solicitud Cerrada';
														break;
													case 'I':
															$estado = 'Solicitud Anulada';
														break;
													default:
														$estado = '';
														break;
												}
												  echo "
												       <th style='font-size: 10pt;font-weight: bold' class='text-start'>".$estado."</th>
											    	";
												?>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="d-flex flex-row-fluid flex-center">
								</div>

								<div class="d-flex flex-row-auto w-200px flex-center">

								</div>
							</div>
						</div>


					</div>
					<!--begin::Wrapper-->
					<div class="m-0">

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">

									<div class="d-flex flex-row-fluid flex-center">
										<table style="text-align: center" class="table table-sm">
											<thead>
											<tr>
												<th class="text-start" style="width: 540px;">
													Solicito tramitacion de las siguientes Compras y/o
													Servicios que serán usadas en:
												</th>
												<th class="text-start">

												</th>
											</tr>
										</table>
									</div>

									<div class="d-flex flex-row-auto w-200px flex-center">

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
											<tr>
												<th class="text-start">
													<div class="border-gray-300 border-bottom">
														<span class="bold">
															<?php
																echo $enc[0]["DescripcionSolicitud"];
															?>
														</span>
													</div>
												</th>
											</tr>

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
											<thead>
												<tr class="h4" style="font-weight: bold">
													<th style='border: 1px solid #DAD3C3 !important;'>REF.</th>
													<th style='border: 1px solid #DAD3C3 !important;'>Cantidad <br> Solicitada</th>
													<th style='border: 1px solid #DAD3C3 !important;'>Unidad <br> Medida</th>
													<th style='border: 1px solid #DAD3C3 !important;'>Cantidad <br> Autorizada</th>
													<th style='border: 1px solid #DAD3C3 !important;'>Descripcion</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$abc = array();
												$i = 0;
												for($x = 'A'; $x < 'ZZ'; $x++){
													$abc[] =  $x.'';
												}
												
													if($det){
														foreach ($det as $item) {
															echo "
																<tr style='font-size: 8pt'>
																	<td style='font-weight: bold;border: 1px solid #DAD3C3 !important;'>".$abc[$i]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$item["CantidadSolicitud"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$item["UnidadMedida"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$item["CantidadAut"]."</td>
																	<td style='border: 1px solid #DAD3C3 !important;'>".$item["DescripcionArticulo"]."</td>
																</tr>	
															";
															$i++;
														}
													}
												?>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>
						<br>
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
											<?php
												if($enc[0]["Autoriza"] != ""){
													echo $enc[0]["Autoriza"];
												}else{
													echo $enc[0]["Nombre"];
												}
											?>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-300px flex-center" style="margin-top: -20px;">
										<div class="">
											Solicitante
										</div>
									</div>
									<div class="d-flex flex-row-fluid flex-center">

									</div>

									<div class="d-flex flex-row-auto w-300px flex-center" style="margin-top: -20px;">
										Autorizado por:
									</div>
								</div>
							</div>

						</div>

						<!--<div class="d-flex flex-row">

							<div class="d-flex flex-column flex-row-fluid">
								<div class="d-flex flex-row flex-column-fluid">
									<div class="d-flex flex-row-auto w-400px flex-center" >
										<table>
											<tr>
												<th class="h6">NOTA IMPORTANTE:</th>
												<th>Compras locales deberán</th>
											</tr>
										</table>
									</div>
									<div class="d-flex flex-row-auto w-200px flex-center">

									</div>
								</div>
							</div>

						</div>-->

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
