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
															data-bs-toggle="tab" href="#kt_tab_pane_7">Rechazadas</a>
													</li>
												</ul>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
													<div class="px-9 mb-5">
														<table id="tblSolicitudes"
															class="table table-striped table-responsive table-row-bordered gy-5 gs-7">
															<thead class="">
																<tr class="fw-bold fs-6 text-muted">
																	<th>Consecutivo</th>
																	<th>Fecha Solicitud</th>
																	<th>Descripcion Solicitud</th>
																	<th>solicitante</th>
																	<th>Area</th>
																	<th>Autorizado por</th>
																	<th>Estado</th>
																	<th class="text-center">Acciones</th>
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
								<span class="text-muted fw-bold me-1"><?php echo date("Y")?>&copy;</span>
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
										 Solicitud N° <span class="" id="consSolRechaza"></span>
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