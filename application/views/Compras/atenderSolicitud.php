					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Container-->
						<div id="kt_content_container" class="container-fluid">
							<!--begin::Row-->
							<div class="row g-5" id="table-responsive-cliente">
								<!-- mb-xl-10 -->

								<!--begin::Col-->
								<div class="col-lg-12 col-xl-12">
									<!--begin::Chart widget 3-->
									<div class="card card-flush overflow-hidden h-md-100">
										<!--begin::Header-->
										<div class="card-header py-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">Solicitudes de compras</span>
												<!--<span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span>-->
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<ul class="nav nav-tabs  nav-pills nav-stretch fs-6 border-0">
													<li class="nav-item">
														<a id="navA" class="nav-link btn btn-flex btn-active-primary active"
															data-bs-toggle="tab" href="#kt_tab_pane_7">Abiertas</a>
													</li>
													<li class="nav-item">
														<a id="navP" class="nav-link btn btn-flex btn-active-warning"
															data-bs-toggle="tab" href="#panelProceso">En proceso</a>
													</li>
													<li class="nav-item">
														<a id="navS" class="nav-link btn btn-flex btn-active-success"
															data-bs-toggle="tab" href="#panelCerrado">Cerradas</a>
													</li>
													<li class="nav-item">
														<a id="navI" class="nav-link btn btn-flex btn-active-danger"
															data-bs-toggle="tab" href="#panelAnul">Anuladas</a>
													</li>
												</ul>
											</div>
											<!--end::Toolbar-->

										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-lg-stretch justify-content-sm-between">
															<div class="d-flex align-items-center overflow-auto pt-3 pt-sm-0">
																<div class="position-relative mb-4">
																	<div class="me-4">
																		<select class="form-select me-12 js-data-example-ajax" id="selectTipoSol">
																			<option value="S">Servicio</option>
																			<option value="C">Compras</option>
																		</select>
																	</div>

																</div>
																<!--<div class="position-relative mb-4">
																	<div class="me-4">
																		<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																				<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
																				<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
																			</svg>
																		</span>
																		<input type="text" class="form-control px-15" placeholder="buscar por fecha">
																	</div>

																</div>-->
																<div class="position-relative mb-4">
																	<div class="me-4">
																		<button id="btnRptOrdenes" class="btn btn-primary"> <i class="fas fa-chart-pie fa-fw"></i></button>
																	</div>

																</div>
															</div>
												</div>
											<!--begin::Statistics-->
											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
													<div class="px-9 mb-5">
														<table id="tblSolicitudes"
															class="table table-striped table-responsive table-row-bordered gy-5 gs-7">
															<thead class="">
																<tr class="fw-bold fs-4 text-muted">
																	<th>Consecutivo</th>
																	<th>Fecha Solicitud</th>
																	<th>Descripcion Solicitud</th>
																	<th>solicitante</th>
																	<th>Area</th>
																	<th>Autorizado por</th>
																	<th>Estado</th>
																	<th rowspan="" class="text-center">Acciones</th>
																	<th ></th>
																</tr>
																<tr class="fw-bold fs-4 text-muted">
																	<th class="tblSolicitudesSearch">Consecutivo</th>
																	<th class="tblSolicitudesSearchF">Fecha Solicitud</th>
																	<th class="tblSolicitudesSearch">Descripcion Solicitud</th>
																	<th class="tblSolicitudesSearch">solicitante</th>
																	<th class="tblSolicitudesSearch">Area</th>
																	<th class="tblSolicitudesSearchT"></th>
																	<th></th>
																	<th ></th>
																	<th ></th>
																</tr>
															</thead>
															<tbody>

															</tbody>
														</table>
													</div>
												</div>

												<div class="tab-pane fade" id="panelProceso" role="tabpanel">
													<div class="px-9 mb-5" >
														<table id="tblSolicitudesProceso"
															class="table table-striped table-responsive table-row-bordered gy-5 gs-7">
															<thead class="">
																<tr class="fw-bold fs-6 text-muted">
																	<!--<th class="text-start"></th>-->
																	<th>Agente <br> Compra</th>
																	<th>Consecutivo</th>
																	<th>Fecha Solicitud</th>
																	<th>Descripcion Solicitud</th>
																	<th>solicitante</th>
																	<th>Area</th>
																	<th>Autorizado por</th>
																	<th>Estado</th>
																	<th class="text-center">Acciones</th>
																	<th ></th>
																</tr>
																<tr>
																	<th></th>
																	<th class="tblSolicitudesProcesoSearch">Consecutivo</th>
																	<th class="tblSolicitudesProcesoSearchF">Fecha Solicitud</th>
																	<th class="tblSolicitudesProcesoSearch">Descripcion Solicitud</th>
																	<th class="tblSolicitudesProcesoSearch">solicitante</th>
																	<th class="tblSolicitudesProcesoSearch">Area</th>
																	<th class="tblSolicitudesProcesoSearchT">Autorizado por</th>
																	<th></th>
																	<th></th>
																	<th ></th>
																</tr>
															</thead>
															<tbody>

															</tbody>
														</table>
													</div>
												</div>

												<div class="tab-pane fade" id="panelCerrado" role="tabpanel">
													<div class="px-9 mb-5">
														<table id="tblSolicitudesCerrado"
															   class="table table-striped table-row-bordered gy-5 gs-7">
															<thead class="">
															<tr class="fw-bold fs-6 text-muted">
																<!--<th class="text-start"></th>-->
																<th>Agente <br> Compra</th>
																<th>Consecutivo</th>
																<th>Fecha Solicitud</th>
																<th>Descripcion Solicitud</th>
																<th>solicitante</th>
																<th>Area</th>
																<th>Autorizado por</th>
																<th>Estado</th>
																<th class="text-center">Acciones</th>
																<th ></th>
															</tr>
															<tr>
																	<th></th>
																	<th class="tblSolicitudesCerradoSearch">Consecutivo</th>
																	<th class="tblSolicitudesCerradoSearchF">Fecha Solicitud</th>
																	<th class="tblSolicitudesCerradoSearch">Descripcion Solicitud</th>
																	<th class="tblSolicitudesCerradoSearch">solicitante</th>
																	<th class="tblSolicitudesCerradoSearch">Area</th>
																	<th class="tblSolicitudesCerradoSearchT">Autorizado por</th>
																	<th></th>
																	<th></th>
																	<th ></th>
																</tr>
															</thead>
															<tbody>

															</tbody>
														</table>
													</div>
												</div>
												<div class="tab-pane fade" id="panelAnul" role="tabpanel">
													<div class="px-9 mb-5">
														<table id="tblSolicitudesAnulada"
															   class="table table-striped table-row-bordered gy-5 gs-7">
															<thead class="">
															<tr class="fw-bold fs-6 text-muted">
																<!--<th class="text-start"></th>-->
																<th>Agente <br> Compra</th>
																<th>Consecutivo</th>
																<th>Fecha Solicitud</th>
																<th>Descripcion Solicitud</th>
																<th>solicitante</th>
																<th>Area</th>
																<th>Autorizado por</th>
																<th>Estado</th>
																<th class="text-center">Acciones</th>
																<th ></th>
															</tr>
															<tr>
																	<th></th>
																	<th class="tblSolicitudesAnuladaSearch">Consecutivo</th>
																	<th class="tblSolicitudesAnuladaSearchF">Fecha Solicitud</th>
																	<th class="tblSolicitudesAnuladaSearch">Descripcion Solicitud</th>
																	<th class="tblSolicitudesAnuladaSearch">solicitante</th>
																	<th class="tblSolicitudesAnuladaSearch">Area</th>
																	<th class="tblSolicitudesAnuladaSearchT">Autorizado por</th>
																	<th></th>
																	<th></th>
																	<th ></th>
																</tr>
															</thead>
															<tbody>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Chart widget 3-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1"><?php echo date("Y") ?>&copy;</span>
								<a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary">Gerencia IT
									DELMOR</a>
							</div>
							<!--end::Copyright-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
					</div>
					<!--end::Wrapper-->
					</div>
					<!--end::Page-->
					</div>
					<!--end::Root-->
					<!--begin::Modals-->
					<!--begin::Modal - New Card-->
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
														<th>Ref</th>
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

					<div class="modal fade" id="modalOrdenes" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-fullscreen p-9">
							<!--begin::Modal content-->
							<div class="modal-content modal-rounded">
								<!--begin::Modal header-->
								<div class="modal-header">
								<h3>
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
										<span id="modalTitle"></span>Solictud N° <span id="detConsecOr"></span>
										<a href="javascript:void(0)" class="printSolic"><i class="fas fa-print text-success fs-2"></i></a>
										<span style="display: none;" id="IdSolic"></span>
										<span style="display: none;" id="IdOrden"></span>
									</h3>
									<!--begin::Modal title-->
									<div class="card-toolbar">
										<ul class="nav nav-tabs  nav-pills nav-stretch fs-6 border-0">
											<li class="nav-item">
												<a id="panelOC" class="nav-link btn btn-flex btn-active-primary "
													data-bs-toggle="tab" href="#OrdenCompra">Ordenes de Compras</a>
											</li>
											<li class="nav-item">
												<a id="panelOP" class="nav-link btn btn-flex btn-active-primary" data-bs-toggle="tab"
													href="#OrdenPago">Ordenes de Pago</a>
											</li>
											<li class="nav-item">
												<a id="panelCH" class="nav-link btn btn-flex btn-active-primary" data-bs-toggle="tab"
													href="#CajaChica">Caja Chica</a>
											</li>
										</ul>
									</div>
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
								<div class="modal-body">
									<div class="tab-content" id="myTabContent1">
										<div class="tab-pane fade" id="OrdenCompra" role="tabpanel">
											<div class="px-9 mb-5">
												<table id="tblOC"
													class="table table-striped table-row-bordered gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<!--<th class="text-start"></th>-->
															<th>ConsecutivoOC</th>
															<th>Fecha</th>
															<th>Proveedor</th>
															<th>Direccion</th>
															<th>Tiempo Entrega</th>
															<th class="text-end"></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="OrdenPago" role="tabpanel">
											<div class="px-9 mb-5">
												<table id="tblOP"
													class="table table-striped table-row-bordered gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<!--<th class="text-start"></th>-->
															<th>Consecutivo OP</th>
															<th>Proveedor</th>
															<th>Nombre <br> Cheque</th>
															<th>Cantidad</th>
															<th>Cantidad <br> Descripcion</th>
															<th>Concepto</th>
															<th>Retiene</th>
															<th>Comentario <br> Retiene</th>
															<th>Fecha</th>
															<th class="text-end"></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="CajaChica" role="tabpanel">
											<div class="px-9 mb-5">
												<table id="tblCH"
													class="table table-striped table-row-bordered gy-5 gs-7">
													<thead class="">
														<tr class="fw-bold fs-6 text-muted">
															<!--<th class="text-start"></th>-->
															<th>Consecutivo CH</th>
															<th>Fecha recibo</th>
															<th>Proveedor</th>
															<th>Concepto</th>
															<th>Total</th>
															<th class="text-end"></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!--begin::Form-->

									<!--end::Form-->
								</div>
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>
					<!--end::Modal - New Card-->
					<!--end::Modals-->
					<!--begin::Scrolltop-->
					<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
						<span class="svg-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
									fill="black" />
								<path
									d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
									fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Scrolltop-->
					<!--end::Main-->
					<div class="modal fade" id="modalRechazo" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2>
										<span class="svg-icon svg-icon-info svg-icon-2hx">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="black"/>
											<path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="black"/>
										</svg>
										</span>
										Rechazar Solicitud N° <span class="" id="consSolRechaza"></span>
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
										<div class="row g-12 mb-8">
											<!--begin::Input group-->
										<!--begin::Col-->
										<div class="col-md-12 fv-row">
											<!--begin::Input group-->
                                            <label for="ComentRechaza" class="form-label">Indique el motivo del rechazo</label>
											<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-info svg-icon-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"/>
														<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"/>
													</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
                                                <input type="hidden" id="idSolicitudComent" class="form-control"/>
												<input type="hidden" id="idUsuarioSolicitud" class="form-control"/>
												<input type="hidden" id="UsuarioSolicitud" class="form-control"/>
												<textarea id="ComentRechaza" class="form-control valida" aria-label="With textarea"
																	style="height: 97px;" placeholder="Ingrese un comentario"></textarea>
											</div>
										</div>
										</div>
										<div class="text-center">
											<button data-bs-dismiss="modal" type="button"
												class="btn btn-danger me-3">Cancelar</button>
											<button type="button" id="btnSaveComentario"
												class="btn btn-primary">Guardar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

<div class="modal fade show" id="modalRptOrndenes" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
	<div class="modal-dialog modal-fullscreen p-9">
		<div class="modal-content modal-rounded">
			<div class="modal-header py-7 d-flex justify-content-between">
				<h2>Reporte Ordenes</h2>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
						</svg>
					</span>
				</div>
			</div>
			<div class="modal-body scroll-y m-5">
				<div class="px-9 mb-8">
					<div class="row g-12 mb-8">
						<div class="col-md-2 fv-row">
							<label for="nombreuser" class="form-label required">Consecutivo Solicitud</label>
							<div class="input-group mb-5">
								<span class="input-group-text" id="basic-addon1">
									<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
									<span class="svg-icon svg-icon-info svg-icon-3">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none">
											<path
												d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
												fill="black" />
												<path opacity="0.3"
													d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
													fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<input type="text" id="consOrdenSearch" class="form-control" placeholder="buscar por solicitud"
										aria-label="Nombre" aria-describedby="basic-addon1" autocomplete="off" />
									</div>
									<!--end::Input-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-md-2 fv-row">
									<label for="fechaInicioSearch" class="form-label required">Fecha inicio</label>
									<div class="input-group mb-5">
										<span class="input-group-text" id="basic-addon1">
											<span class="svg-icon svg-icon-info svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																			<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																			<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																		</svg>
													</span>
												</span>
												<input type="date" id="fechaInicioSearch" class="form-control"
												placeholder="" aria-label="Nombre"
												aria-describedby="basic-addon1" autocomplete="off" />
											</div>
											<!--end::Input-->
										</div>
										<div class="col-md-2 fv-row">
											<label for="fechaFinalSearch" class="form-label required">Fecha final</label>
											<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
											<span class="svg-icon svg-icon-info svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																			<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																			<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																		</svg>
																	</span>
												</span>
												<input type="date" id="fechaFinalSearch" class="form-control"
												placeholder="" aria-label="Nombre"
												aria-describedby="basic-addon1" autocomplete="off" />
											</div>
											<!--end::Input-->
										</div>
										<div class="col-md-3 fv-row">
												<label for="listProvSearch" class="form-label required">Seleccione un proveedor</label>
												<!--begin::Default example-->
												<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-info svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black"></path>
																			<path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="black"></path>
																		</svg>
																	</span>
													</span>
													<div class="overflow-hidden flex-grow-1">
														<select id="listProvSearch" class="form-select rounded-start-0 js-data-example-ajax"
															data-dropdown-parent="#modalRptOrndenes">
															<option selected value=""></option>
														</select>
													</div>
												</div>
												<!--end::Default example-->
										</div>
										<div class="col-md-3 fv-row">
											<div class="text-center ">
												<button type="button" id="btnFiltrarSearch" class="btn btn-primary">
													<i class="fas fa-search fa-fw fa-2x"></i>
													Filtrar
												</button>
											</div>
										</div>
										<!--end::Col-->
									</div>
					</div>
				<div class="px-9 mb-5">
					<table class="table  table-row-bordered gy-5 gs-7" id="tblSearchOrdenes">
						<thead>
							<tr>
								<th>Consecutivo</th>
								<th>Consecutivo <br> Orden</th>
								<th>Cod Proveedor</th>
								<th>Proveedor</th>
								<th>Concepto</th>
								<th>Fecha <br> Crea</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
