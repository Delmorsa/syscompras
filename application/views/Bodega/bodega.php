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
					<div class="symbol symbol-circle me-6">
						<div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
							<!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
							<span class="svg-icon svg-icon-3x svg-icon-primary">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"/>
									<path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black"/>
									<path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"/>
									<path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black"/>
									<path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"/>
									<path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black"/>
									<path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"/>
									<path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black"/>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
					</div>
					<!--end::Icon-->
					<!--begin::Title-->
					<div class="d-flex flex-column">
						<h2 class="mb-1">Recepción de articulos a proveedores</h2>
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
						<button type="button" class="btn btn-primary" id="updateTabla" onclick="OCBodega()">
							<!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
							<i class="fas fa-upload"></i>
							<!--end::Svg Icon-->Actualizar datos</button>
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
							<a onclick="OPBodega()" class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Ordenes de Pago</a>
						</li>
						<li class="nav-item">
							<a onclick="OCBodega()" class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Ordenes de Compra</a>
						</li>
						<li class="nav-item">
							<a onclick="CHBodega()" class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6">Caja Chica</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade active show" id="kt_tab_pane_4" role="tabpanel">
							<!--begin::Table-->
							<table id="file_manager_listOP" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
								<!--begin::Table head-->
								<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bolder fs-7  gs-0">
									<th>Agente <br> Compra</th>
									<th>Solicitante</th>	
									<th>Area</th>
									<th class="">N° Solicitud</th>
									<th class="">N° Orden Pago</th>
									<th class="">Proveedor</th>
									<th class="">Cheque</th>
									<th class="">Concepto</th>
									<th class="">Total</th>
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
									<th>Agente <br> Compra</th>
									<th>Solicitante</th>
									<th>Area</th>
									<th>N° Solicitud</th>
									<th>N° Orden Compra</th>
									<th>Proveedor</th>
									<th>Direccion</th>
									<th>Total</th>
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
					   <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
							<table id="file_manager_listCH" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
								<!--begin::Table head-->
								<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bolder fs-7  gs-0">
									<th>Agente <br> Compra</th>
									<th>Solicitante</th>
									<th>Area</th>
									<th>N° Solicitud</th>
									<th>N° Caja Chica</th>
									<th>Proveedor</th>
									<th>fechaRecibo</th>
									<th>Concepto</th>
									<th>Total</th>
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
	</div>
	<!--end::Container-->
</div>

			<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog mw-1000px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<path opacity="0.3"
													d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z"
													fill="black" />
												<path opacity="0.3"
													d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z"
													fill="black" />
												<path opacity="0.3"
													d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z"
													fill="black" />
												<path
													d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z"
													fill="black" />
											</svg>
										</span>
										<span id="modalTitle"></span><span id="detConsec"></span>
										<span style="display: none;" id="IdSolic1"></span>
										<a href="javascript:void(0)" class="printSolic"><i class="fas fa-print text-success fs-2"></i></a>
									</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<!--begin::Form-->
									<div class="form">
										<!--begin::Input group-->
										<!--begin::Col-->
										<div class="d-flex flex-column mb-12 fv-row">
											<table id="tblDetSolicitudes"
												class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
												<thead class="">
													<tr class="fw-bold fs-6 text-muted">
														<th>Cantidad <br> Solicitada</th>
														<th>Unidad <br> Medida</th>
														<th>Cantidad <br> Autorizada</th>
														<th>Articulo</th>
														<th>Estado</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
										<!--end::Col-->
										<!--end::Input group-->
										<!--begin::Actions-->

										<!-- botones <div class="text-center">
											<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>
											<button type="button" id="btnGuardarRol"
												class="btn btn-primary">Guardar</button>
                                                <button style="display: none;" type="button" id="btnActualizarRol"
												class="btn btn-primary">Actualizar</button>
										</div>-->
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>


					<div class="modal fade" id="modalSolicitudBodega" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-fullscreen p-9">
							<!--begin::Modal content-->
							<div class="modal-content  modal-rounded">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="black"/>
												<path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="black"/>
												<path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="black"/>
												<path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="black"/>
											</svg>
										</span>
										<span id="modalTitleBodega"></span><span id="detConsecBodega"></span>
									</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<!--begin::Form-->
									<div class="col-md-3 fv-row">
										<h4 for="" class="form-label"><span id="cons"></span></h4><br>
										<input type="hidden" id="idsolRecepcion">
										<input type="hidden" name="" id="mail">
										<input type="hidden" name="" id="mailCompra">
									</div>
									<br>
									<div class="form">
										<!--begin::Input group-->
										<!--begin::Col-->
										<div class="d-flex flex-column mb-12 fv-row">
                                                <table id="tblBodegas" style="display: none;" class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
                                                    <thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<th>Descripcion</th>
															<th>Proforma</th>
															<th>Unidad <br> Medida</th>
															<th>Cantidad <br> Pedido</th>
															<th>Precio</th>
															<th>Monto <br> Descuento</th>
															<th>Impuesto</th>
															<th>Monto <br> Impuesto</th>
															<th>Moneda</th>
															<th>SubTotal</th>
															<th>Total</th>
															<th class="required">Cantidad <br> Recibida</th>
															<th class="required">Comentarios</th>
                                                            <th class="w-10px pe-2">
                                                                Todos
                                                                <span class="badge badge-circle ms-2">
                                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="chkAll" class="form-check-input" type="checkbox" value="" />
                                                                    </div>
                                                                </span>
                                                            </th>
														</tr>
													</thead>
													<tbody>

                                                    </tbody>
                                                </table>
										</div>
										<!--end::Col-->
										<!--end::Input group-->
										<!--begin::Actions-->
										
										<div class="text-end" id="botones">
											<!--<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>-->
											<button type="button" id="btnRecepcion"
												class="btn btn-primary">Confirmar Recepción</button>
                                            <!--<button type="button" id="btnRechazarSolic"
												class="btn btn-danger me-3">Rechazar</button>-->    
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>	
					
					<div class="modal fade" id="modalSolicitudBodegaOP" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-fullscreen p-9">
							<!--begin::Modal content-->
							<div class="modal-content  modal-rounded">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="black"/>
												<path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="black"/>
												<path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="black"/>
												<path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="black"/>
											</svg>
										</span>
										<span id="modalTitleBodegaOP"></span><span id="detConsecBodegaOP"></span>
									</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<!--begin::Form-->
									<div class="col-md-3 fv-row">
										<h4 for="" class="form-label"><span id="consOP"></span></h4><br>
										<input type="hidden" id="idsolRecepcionOP">
										<input type="hidden" name="" id="mailOP">
										<input type="hidden" name="" id="mailCompraOP">
									</div>
									<br>
									<div class="form">
										<!--begin::Input group-->
										<!--begin::Col-->
										<div class="d-flex flex-column mb-12 fv-row">
                                                <table id="tblBodegasOP" style="display: none;" class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
                                                    <thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<th>Descripcion</th>
															<th>Proforma</th>
															<th>Unidad <br> Medida</th>
															<th>Cantidad <br> Pedido</th>
															<th>Precio</th>
															<th>Monto <br> Descuento</th>
															<th>Impuesto</th>
															<th>Monto <br> Impuesto</th>
															<th>Moneda</th>
															<th>SubTotal</th>
															<th>Total</th>
															<th class="required">Cantidad <br> Recibida</th>
															<th class="required">Comentarios</th>
                                                            <th class="w-10px pe-2">
                                                                Todos
                                                                <span class="badge badge-circle ms-2">
                                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="chkAllOP" class="form-check-input" type="checkbox" value="" />
                                                                    </div>
                                                                </span>
                                                            </th>
														</tr>
													</thead>
													<tbody>

                                                    </tbody>
                                                </table>
										</div>
										<!--end::Col-->
										<!--end::Input group-->
										<!--begin::Actions-->
										
										<div class="text-end" id="botonesOP">
											<!--<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>-->
											<button type="button" id="btnRecepcionOP"
												class="btn btn-primary">Confirmar Recepción</button>
                                            <!--<button type="button" id="btnRechazarSolic"
												class="btn btn-danger me-3">Rechazar</button>-->    
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>		

					<div class="modal fade" id="modalSolicitudBodegaCH" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-fullscreen p-9">
							<!--begin::Modal content-->
							<div class="modal-content  modal-rounded">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="black"/>
												<path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="black"/>
												<path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="black"/>
												<path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="black"/>
											</svg>
										</span>
										<span id="modalTitleBodegaCH"></span><span id="detConsecBodegaCH"></span>
									</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
												fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
													transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
													fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
									<!--begin::Form-->
									<div class="col-md-3 fv-row">
										<h4 for="" class="form-label"><span id="consCH"></span></h4><br>
										<input type="hidden" id="idsolRecepcionCH">
										<input type="hidden" name="" id="mailCH">
										<input type="hidden" name="" id="mailCompraCH">
									</div>
									<br>
									<div class="form">
										<!--begin::Input group-->
										<!--begin::Col-->
										<div class="d-flex flex-column mb-12 fv-row">
                                                <table id="tblBodegasCH" style="display: none;" class="table table-striped table-row-bordered table-responsive gy-5 gs-7">
                                                    <thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<th>Descripcion</th>
															<th>N° Factura</th>
															<th>Unidad <br> Medida</th>
															<th>Cantidad <br> Pedido</th>
															<th>Precio</th>
															<th>Monto <br> Descuento</th>
															<th>Impuesto</th>
															<th>Monto <br> Impuesto</th>
															<th>Moneda</th>
															<th>SubTotal</th>
															<th>Total</th>
															<th class="required">Cantidad <br> Recibida</th>
															<th class="required">Comentarios</th>
                                                            <th class="w-10px pe-2">
                                                                Todos
                                                                <span class="badge badge-circle ms-2">
                                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input id="chkAllCH" class="form-check-input" type="checkbox" value="" />
                                                                    </div>
                                                                </span>
                                                            </th>
														</tr>
													</thead>
													<tbody>

                                                    </tbody>
                                                </table>
										</div>
										<!--end::Col-->
										<!--end::Input group-->
										<!--begin::Actions-->
										
										<div class="text-end" id="botonesCH">
											<!--<button data-bs-dismiss="modal" type="button" id="modalRol"
												class="btn btn-danger me-3">Cancelar</button>-->
											<button type="button" id="btnRecepcionCH"
												class="btn btn-primary">Confirmar Recepción</button>
                                            <!--<button type="button" id="btnRechazarSolic"
												class="btn btn-danger me-3">Rechazar</button>-->    
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>	