<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-fluid">
		<!--begin::Card-->
		<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%;
		background-image: url('<?= base_url()?>/assets/media/illustrations/sketchy-1/4.png')">
			<!--begin::Card header-->
			<div class="card-header pt-10">
				<div class="d-flex align-items-center">
					<!--begin::Icon-->
					<div class="symbol symbol-circle me-5">
						<div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
							<!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
							<span class="svg-icon svg-icon-2x svg-icon-primary">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black"/>
														<path opacity="0.3" d="M10.3 15.3L11 14.6L8.70002 12.3C8.30002 11.9 7.7 11.9 7.3 12.3C6.9 12.7 6.9 13.3 7.3 13.7L10.3 16.7C9.9 16.3 9.9 15.7 10.3 15.3Z" fill="black"/>
														<path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM11.7 16.7L16.7 11.7C17.1 11.3 17.1 10.7 16.7 10.3C16.3 9.89999 15.7 9.89999 15.3 10.3L11 14.6L8.70001 12.3C8.30001 11.9 7.69999 11.9 7.29999 12.3C6.89999 12.7 6.89999 13.3 7.29999 13.7L10.3 16.7C10.5 16.9 10.8 17 11 17C11.2 17 11.5 16.9 11.7 16.7Z" fill="black"/>
													</svg>
												</span>
							<!--end::Svg Icon-->
						</div>
					</div>
					<!--end::Icon-->
					<!--begin::Title-->
					<div class="d-flex flex-column">
						<h2 class="mb-1">Administrador de documentos</h2>
						<!--<div class="text-muted fw-bolder">
							<a href="#">Keenthemes</a>
							<span class="mx-3">|</span>
							<a href="#">File Manager</a>
							<span class="mx-3">|</span>2.6 GB
							<span class="mx-3">|</span>758 items</div>-->
					</div>
					<!--end::Title-->
				</div>
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pb-0">
				<!--begin::Navs-->

				<!--begin::Navs-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		<!--begin::Card-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header pt-8">
				<div class="card-title">
					<!--begin::Search-->

					<!--end::Search-->
				</div>
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
						<button type="button" class="btn btn-primary" id="updateTabla">
							<!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
							<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black" />
													<path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="black" />
													<path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="black" />
												</svg>
											</span>
							<!--end::Svg Icon-->Actualizar tabla</button>

						
						<!--end::Add customer-->
					</div>
					<!--end::Toolbar-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-filemanager-table-toolbar="selected">
						<div class="fw-bolder me-5">
							<span class="me-2" data-kt-filemanager-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-filemanager-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body">
				<div class="">
					<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
						<li class="nav-item">
							<a onclick="cargarSolicOP()" class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Ordenes de Pago</a>
						</li>
						<li class="nav-item">
							<a onclick="cargarSolicOC()" class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Ordenes de Compra</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade active show" id="kt_tab_pane_4" role="tabpanel">
							<!--begin::Table-->
							<table id="file_manager_list" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
								<!--begin::Table head-->
								<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bolder fs-7  gs-0">
									<th class="">Solicitud</th>
									<th class="">Orden Pago</th>
									<th>Agente <br> Compra</th>
									<th class="">Proveedor</th>
									<th class="">Cheque</th>
									<th class="">Cantidad</th>
									<th class="">Cantidad <br> Desc.</th>
									<th class="">Concepto</th>
									<th class="">Retiene</th>
									<th class="">Coment. <br> Retiene</th>
									<th class="">Fecha Crea</th>
									<th>Opciones</th>
								</tr>
								<!--end::Table row-->
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody class="text-start fw-bolder fs-8 gs-0">

								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
							<table id="file_manager_listOC" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
								<!--begin::Table head-->
								<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bolder fs-7  gs-0">
									<th>Consecutivo</th>
									<th>ConsecutivoOC</th>
									<th>Agente <br> Compra</th>
									<th>Proveedor</th>
									<th>Direccion</th>
									<th>TiempoEntrega</th>
									<th>FechaCrea</th>
									<th>Opciones</th>
								</tr>
								<!--end::Table row-->
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody class="text-start fw-bolder fs-8 gs-0">

								</tbody>
								<!--end::Table body-->
							</table>
					   </div>
					</div>
				</div>
				<!--begin::Table header-->
				<!--<div class="d-flex flex-stack">

					<div class="badge badge-lg badge-primary">
						<span id="kt_file_manager_items_counter">66 items</span>
					</div>
				</div>-->
				<!--end::Table header-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
		<!--begin::Upload template-->
		<table class="d-none">
			<tr id="kt_file_manager_new_folder_row" data-kt-filemanager-template="upload">
				<td></td>
				<td id="kt_file_manager_add_folder_form" class="fv-row">
					<div class="d-flex align-items-center">
						<!--begin::Folder icon-->
						<!--begin::Svg Icon | path: icons/duotune/files/fil012.svg-->
						<span class="svg-icon svg-icon-2x svg-icon-primary me-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black" />
													<path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="black" />
												</svg>
											</span>
						<!--end::Svg Icon-->
						<!--end::Folder icon-->
						<!--begin:Input-->
						<input type="text" name="new_folder_name" placeholder="Enter the folder name" class="form-control mw-250px me-3" />
						<!--end:Input-->
						<!--begin:Submit button-->
						<button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_add_folder">
												<span class="indicator-label">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr085.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
							<span class="indicator-progress">
													<span class="spinner-border spinner-border-sm align-middle"></span>
												</span>
						</button>
						<!--end:Submit button-->
						<!--begin:Cancel button-->
						<button class="btn btn-icon btn-light-danger" id="kt_file_manager_cancel_folder">
												<span class="indicator-label">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="black" />
															<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
							<span class="indicator-progress">
													<span class="spinner-border spinner-border-sm align-middle"></span>
												</span>
						</button>
						<!--end:Cancel button-->
					</div>
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>



		<div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<form class="form" method="post" id="uploadFile">
						<!--begin::Modal header-->
						<div class="modal-header justify-content-end border-0 pb-0">
							<!--begin::Close-->
							<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
								<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Close-->
						</div>
						<!--end::Modal header-->
						<!--begin::Modal body-->
						<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="mb-3">Adjuntar documentos</h1>
								<!--<div class="text-muted fw-bold fs-5">If you need more info, please check
									<a href="#" class="link-primary fw-bolder">Pricing Guidelines</a>.</div>-->
							</div>
							<!--end::Heading-->
							<!--begin::Plans-->
							<div class="d-flex flex-column">

								<div class="row mt-10">
									<!--begin::Col-->
									<div class="col-lg-6 mb-10 mb-lg-0">
										<!--begin::Tabs-->
										<div class="nav flex-column">
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" >
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" name="plan" value="1" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cuadro Comparativo</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" >
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" name="plan" value="2" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cotizaciones</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" >
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" name="plan" value="3" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cedulas</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" >
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" name="plan" value="4" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Constancias</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" >
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" name="plan" value="5" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">N° Cuentas</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
										</div>
										<!--end::Tabs-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-lg-6">
										<!--begin::Tab content-->
										<div class="tab-content rounded h-100 bg-light p-10">
											<!--begin::Tab Pane-->
											<div class="tab-pane fade show active" id="kt_cuadro">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark" id="encModal"></h2>

												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="form-group">
														<div class="row g-9 mb-8 text-center">
															<div class="symbol symbol-125px mb-7 me-7">
																<img id="image" src="" alt="<?= basename(FCPATH)?>">
															</div>
															<p><span id="sizeFile"></span></p>
														</div>
														<div class="row g-9 mb-8">
															<input type="hidden" name="parametro" id="parametro">
															<input type="hidden" name="idorden" id="idorden">
															<input type="hidden" name="idsolicitud" id="idsolicitud">
															<!--<input type='hidden' name='old_image' value='<?php //echo $documento[0]["documento"]?>'>-->
															<input class="btn btn-active-light-primary" type="file" id="new_image" name="new_image" lang="en"
																   onchange="loadFile(event)">
														</div>
														<div class="row col-12">
															<div class="d-flex w-100 ">
																<!--begin::Progress-->
																<div class="progress h-6px w-100 me-2 bg-light-success">
																	<div class="progress-bar bg-success" role="progressbar" style="width: 0%"
																		 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<!--end::Progress-->
																<!--begin::Value-->
																<span class="text-gray-400 fw-bold" id="progressText">0%</span>
																<!--end::Value-->
															</div>
														</div>
													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Tab Pane-->
										</div>
										<!--end::Tab content-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Plans-->
							<!--begin::Actions-->
							<div class="d-flex flex-center flex-row-fluid pt-12">
								<button data-bs-dismiss="modal" type="button"
										class="btn btn-danger me-3">Cancelar</button>
								<input type="submit" value="Guardar" class="btn btn-primary">
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Modal body-->
					</form>
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>

		<div class="modal fade" id="kt_modal_details" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-xl">
				<!--begin::Modal content-->
				<div class="modal-content rounded">
					<form class="form" method="post" id="uploadFile">
						<!--begin::Modal header-->
						<div class="modal-header justify-content-end border-0 pb-0">
							<!--begin::Close-->
							<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
								<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Close-->
						</div>
						<!--end::Modal header-->
						<!--begin::Modal body-->
						<div class="modal-body pt-0 pb-15 px-5 px-xl-20">
							<!--begin::Heading-->
							<div class="mb-13 text-center">
								<h1 class="mb-3" id="detEnc"></h1>
								<input type="hidden" name="" id="detIdOrden">
								<!--<div class="text-muted fw-bold fs-5">If you need more info, please check
									<a href="#" class="link-primary fw-bolder">Pricing Guidelines</a>.</div>-->
							</div>
							<!--end::Heading-->
							<!--begin::Plans-->
							<div class="d-flex flex-column">
								<div class="row mt-10">
									<!--begin::Col-->
									<div class="col-lg-4 mb-10 mb-lg-0">
										<!--begin::Tabs-->
										<div class="nav flex-column">
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#detCuadro">
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" id="chkDetCuadro" name="det" value="1" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cuadro Comparativo</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#detCoti">
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" id="chkCot" type="radio" name="det" value="2" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cotizaciones</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#detCed">
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" id="chkCed" name="det" value="3" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Cedulas</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<!--begin::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#detCons">
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" id="chkConst" name="det" value="4" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">Constancias</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
											<!--end::Tab link-->
											<div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#detCuent">
												<!--end::Description-->
												<div class="d-flex align-items-center me-2">
													<!--begin::Radio-->
													<div class="form-check form-check-custom form-check-solid form-check-success me-6">
														<input class="form-check-input" type="radio" id="chkCuent" name="det" value="5" />
													</div>
													<!--end::Radio-->
													<!--begin::Info-->
													<div class="flex-grow-1">
														<h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">N° Cuentas</h2>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Description-->
											</div>
										</div>
										<!--end::Tabs-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-lg-8">
										<!--begin::Tab content-->
										<div class="tab-content rounded h-100 bg-light p-10">
											<!--begin::Tab Pane-->
											<div class="tab-pane fade " id="detCuadro">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark">Cuadros comparativos adjuntos</h2>
												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="mh-375px scroll-y me-n7 pe-7" id="contenedorDetCuadro">

													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Tab Pane-->
											<!--begin::Tab Pane-->
											<div class="tab-pane fade" id="detCoti">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark">Cotizaciones Adjuntas</h2>
												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="mh-375px scroll-y me-n7 pe-7 classCot" id="contenedordetCotiz">

													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Tab Pane-->
											<!--begin::Tab Pane-->
											<div class="tab-pane fade" id="detCed">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark">Cedulas adjuntas</h2>
												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="mh-375px scroll-y me-n7 pe-7 classCed" id="contenedordetCed">

													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Tab Pane-->
											<div class="tab-pane fade" id="detCons">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark">Constancias Adjuntas</h2>
												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="mh-375px scroll-y me-n7 pe-7 classConst" id="contenedordetConst">

													</div>
												</div>
												<!--end::Body-->
											</div>
											<div class="tab-pane fade" id="detCuent">
												<!--begin::Heading-->
												<div class="pb-5">
													<h2 class="fw-bolder text-dark">N° Cuentas Adjuntas</h2>
												</div>
												<!--end::Heading-->
												<!--begin::Body-->
												<div class="pt-1">
													<div class="mh-375px scroll-y me-n7 pe-7 classCuent" id="contenedordetCuent">

													</div>
												</div>
												<!--end::Body-->
											</div>
										</div>
										<!--end::Tab content-->
									</div>
									<!--end::Col-->
								</div>
							</div>
							<!--end::Plans-->
							<!--begin::Actions-->

							<!--end::Actions-->
						</div>
						<!--end::Modal body-->
					</form>
				</div>
				<!--end::Modal content-->
			</div>
			<!--end::Modal dialog-->
		</div>

		<div class="modal fade" tabindex="-1" id="kt_modal_pdfshow">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modal title</h5>
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
							<!--end::Svg Icon-->
						</div>
					</div>

					<div class="modal-body">
						<div class="externalFiles" >
							<iframe  id="canvasFile"
									src="" frameborder="0"
									width="100%" height="600"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Container-->
</div>
