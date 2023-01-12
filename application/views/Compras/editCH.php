					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="margin: 10px;">
						<!--begin::Container-->
						<div id="kt_content_container" class="container-fluid">
							<!--begin::Row-->
							<div class="row g-5">
								<!-- mb-xl-10 -->

								<!--begin::Col-->
								<div class="col-lg-12 col-xl-12">
									<!--begin::Chart widget 3-->
									<div class="card card-flush overflow-hidden h-md-100">
										<!--begin::Header-->
										<div class="card-header py-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">Reembolso Caja Chica </span>
												<!--<span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span>-->
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
											<!--begin::Statistics-->
											<div class="px-9 mb-5">
                                                <div class="d-flex flex-wrap">
                                                    <!--begin::Stat-->
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                            <span class="svg-icon svg-icon-2 svg-icon-info me-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                            <path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z" fill="black"/>
                                                                                            <path d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z" fill="black"/>
                                                                                        </svg>
                                                                                    </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="<?= $encabezado[0]["Consecutivo"]?>" data-kt-countup-prefix="#"><?= $encabezado[0]["Consecutivo"]?></div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">N° de Solicitud</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                            <span class="svg-icon svg-icon-2 svg-icon-danger me-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                            <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"/>
                                                                                            <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"/>
                                                                                            <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"/>
                                                                                        </svg>
                                                                                    </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="<?= $encabezado[0]["FechaSolicitud"]?>"><?= $encabezado[0]["FechaAutoriza"]?></div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">Fecha Solicitud</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                            <span class="svg-icon svg-icon-2 svg-icon-primary me-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                                                            <rect y="6" width="16" height="3" rx="1.5" fill="black"/>
                                                                                            <rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="black"/>
                                                                                            <rect opacity="0.3" width="12" height="3" rx="1.5" fill="black"/>
                                                                                        </svg>
                                                                                    </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix=""><?= $encabezado[0]["DescripcionSolicitud"]?></div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">Descripcion solicitud</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->

                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                            <span class="svg-icon svg-icon-2 svg-icon-info me-2">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                            <path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z" fill="black"/>
                                                                                            <path d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z" fill="black"/>
                                                                                        </svg>
                                                                                    </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="<?= $encOrden[0]["consecutivoCH"]?>" data-kt-countup-prefix="#"><?= $encOrden[0]["consecutivoCH"]?></div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">N° de Caja Chica</div>
                                                        <!--end::Label-->
                                                    </div>
                                                </div>
													<br>
												<div class="form" id="campos">
													<div class="row g-12 mb-8">
														<div class="col-md-3 fv-row">
															<label for="listProv" class="form-label required">Proveedor</label>
															<!--begin::Default example-->
															<div class="input-group flex-nowrap">
																<span class="input-group-text">
																	<span class="svg-icon svg-icon-info svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			 viewBox="0 0 24 24" fill="none">
																			<path
																					d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
																					fill="black" />
																			<path opacity="0.3"
																				  d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
																				  fill="black" />
																		</svg>
																	</span>
																</span>
                                                                <input id="idSolicitud" type="hidden"
                                                                    class="form-control" value="<?php echo $encOrden[0]["IdSolicitud"]?>" />
                                                                <input id="idorden" type="hidden"
                                                                    class="form-control" value="<?php echo $encOrden[0]["IdCajaChica"]?>" />
																<div class="overflow-hidden flex-grow-1">
																	<select id="listProv"
                                                                    class="form-select rounded-start-0 js-data-example-ajax">
													<option selected value="<?= $encOrden[0]["IdProveedor"]?>"><?= $encOrden[0]["Proveedor"]?></option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-md-3 fv-row">
															<label for="listProvtxt" class="form-label required">Beneficiario</label>
															<!--begin::Default example-->
															<div class="input-group flex-nowrap">
																<span class="input-group-text">
																	<span class="svg-icon svg-icon-info svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
                                                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
                                                                        </svg>
																	</span>
																</span>
																<!--<input id="idSolicitud" type="hidden"
																 class="form-control" value="<?php echo $this->uri->segment("2")?>" />-->
                                                                 <input id="listProvtxt" value="<?= $encOrden[0]["Proveedor"]?>" class="form-control valida" />
															</div>
														</div>
														<div class="col-md-2 fv-row">
															<label for="fecha" class="form-label required">Fecha Recibo</label>
															<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																	<span class="svg-icon svg-icon-info svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3"
																				d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
																				fill="black"></path>
																			<path
																				d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
																				fill="black"></path>
																			<path
																				d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
																				fill="black"></path>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
																<input id="fecha" value="<?= $encOrden[0]["fechaRecibo"]?>" data-date-format="yyyy-mm-dd" class="form-control valida" />
															</div>
															<!--end::Input-->
														</div>
														<div class="col-md-2 fv-row">
															<label for="factura" class="form-label required">Total</label>
															<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																	<span class="svg-icon svg-icon-info svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M18 20.3C20.2091 20.3 22 18.5092 22 16.3C22 14.0909 20.2091 12.3 18 12.3C15.7909 12.3 14 14.0909 14 16.3C14 18.5092 15.7909 20.3 18 20.3Z" fill="black"/>
                                                                            <path d="M18 18.3C17.4 18.3 17 17.9 17 17.3V15.3C17 14.7 17.4 14.3 18 14.3C18.6 14.3 19 14.7 19 15.3V17.3C19 17.9 18.6 18.3 18 18.3Z" fill="black"/>
                                                                            <path d="M14.4 18.1001C14.5 18.5001 14.4 19.0001 14 19.2001C13.8 19.3001 13.7 19.3 13.5 19.3C13.2 19.3 12.8 19.1 12.6 18.8V18.7001C12.1 18.9001 11.6 19.0001 11 19.1001V19.2001C11 19.8001 10.6 20.2001 10 20.2001C9.4 20.2001 9 19.8001 9 19.2001V19.1001C8.4 19.0001 7.89999 18.9001 7.39999 18.7001V18.8C7.19999 19.1 6.9 19.3 6.5 19.3C6.3 19.3 6.2 19.3001 6 19.2001C5.5 18.9001 5.40001 18.3 5.60001 17.8V17.7001C5.20001 17.4001 4.79999 17 4.39999 16.5H4.3C4.1 16.6 4 16.6001 3.8 16.6001C3.5 16.6001 3.09999 16.4001 2.89999 16.1001C2.59999 15.6001 2.8 15.0001 3.3 14.7001H3.39999C3.19999 14.2001 3.1 13.7001 3 13.1001C2.4 13.1001 2 12.7001 2 12.1001C2 11.5001 2.4 11.1001 3 11.1001H3.10001C3.20001 10.5001 3.3 10 3.5 9.5H3.39999C2.89999 9.2 2.8 8.6001 3 8.1001C3.3 7.6001 3.89999 7.50007 4.39999 7.70007H4.5C4.8 7.30007 5.2 6.9 5.7 6.5V6.40002C5.4 5.90002 5.60001 5.3 6.10001 5C6.60001 4.7 7.2 4.90002 7.5 5.40002V5.5C8 5.3 8.50001 5.2001 9.10001 5.1001V5C9.10001 4.4 9.50001 4 10.1 4C10.7 4 11.1 4.4 11.1 5V5.1001C11.7 5.2001 12.2 5.3 12.7 5.5V5.40002C13 4.90002 13.6 4.8 14.1 5C14.6 5.3 14.7 5.90002 14.5 6.40002V6.5C14.9 6.8 15.3 7.20007 15.7 7.70007H15.8C16.3 7.40007 16.9 7.6001 17.2 8.1001C17.5 8.6001 17.3 9.2 16.8 9.5H16.7C16.9 10 17 10.5001 17.1 11.1001H17.2C17.8 11.1001 18.2 11.5001 18.2 12.1001C16 12.1001 14.2 13.9001 14.2 16.1001C14 17.0001 14.2 17.6001 14.4 18.1001ZM11.8 8.40002H8.89999C8.59999 8.40002 8.4 8.5001 8.2 8.6001C8.1 8.7001 7.99999 9.00005 7.89999 9.30005L7.39999 11.9C7.39999 12.1 7.3 12.3 7.3 12.3C7.3 12.5 7.4 12.6001 7.5 12.7001C7.6 12.8001 7.8 12.9 8 12.9C8.2 12.9 8.40001 12.8001 8.60001 12.6001C8.90001 12.4001 9.1 12.3001 9.2 12.2001C9.3 12.1001 9.59999 12.1001 9.89999 12.1001C10.2 12.1001 10.4 12.2 10.6 12.3C10.8 12.4 11 12.6 11.1 12.9C11.2 13.2 11.3 13.5 11.3 13.8C11.3 14.1 11.2 14.4001 11.1 14.7001C11 15.0001 10.8 15.2 10.6 15.3C10.4 15.4 10.1 15.5 9.89999 15.5C9.59999 15.5 9.30001 15.4001 9.10001 15.2001C8.80001 15.0001 8.7 14.8 8.5 14.4C8.3 14 8.1 13.9 7.8 13.9C7.6 13.9 7.5 14.0001 7.3 14.1001C7.2 14.2001 7.10001 14.4 7.10001 14.5C7.10001 14.7 7.19999 15 7.39999 15.3C7.59999 15.6 7.9 15.9001 8.3 16.1001C8.7 16.3001 9.19999 16.5 9.89999 16.5C10.5 16.5 11 16.4001 11.5 16.1001C12 15.8001 12.3 15.5001 12.5 15.1001C12.7 14.7001 12.9 14.2001 12.9 13.6001C12.9 13.2001 12.8 12.9001 12.7 12.6001C12.6 12.3001 12.4 12 12.2 11.8C12 11.6 11.7 11.4 11.4 11.3C11.1 11.2 10.8 11.1001 10.4 11.1001C9.99999 11.1001 9.5 11.2 9 11.5L9.3 9.70007H11.9C12.2 9.70007 12.4 9.6 12.5 9.5C12.6 9.4 12.7 9.2 12.7 9C12.6 8.6 12.3 8.40002 11.8 8.40002Z" fill="black"/>
                                                                        </svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
																<input value="" readonly class="form-control valida" id="total" />
															</div>
															<!--end::Input-->
														</div>
													</div>
													<!-- <div class="row g-12 mb-8">
														<div class="col-md-2 fv-row">
															<label for="factura" class="form-label required">Factura #</label>
															<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<span class="svg-icon svg-icon-info svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M3 3V17H7V21H15V9H20V3H3Z" fill="black"/>
                                                                            <path d="M20 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V21C21 21.6 20.6 22 20 22ZM19 4H4V8H19V4ZM6 18H4V20H6V18ZM6 14H4V16H6V14ZM6 10H4V12H6V10ZM10 18H8V20H10V18ZM10 14H8V16H10V14ZM10 10H8V12H10V10ZM14 18H12V20H14V18ZM14 14H12V16H14V14ZM14 10H12V12H14V10ZM19 14H17V20H19V14ZM19 10H17V12H19V10Z" fill="black"/>
                                                                        </svg>
																	</span>
																</span>
																<input value="" class="form-control valida" id="factura" />
															</div>
														</div>
														<div class="col-md-2 fv-row">
															<label for="listImpuesto" class="form-label required">Impuesto</label>
															<div class="input-group flex-nowrap">
																<span class="input-group-text">
																	<span class="svg-icon svg-icon-info svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="black"/>
                                                                            <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="black"/>
                                                                        </svg>
																	</span>
																</span>
																<div class="overflow-hidden flex-grow-1">
																	<select id="listImpuesto"
																			class="form-select rounded-start-0 js-data-example-ajax valida">
																		<option selected value=""></option>
																	</select>
																</div>
															</div>
														</div>
													</div> -->
													<!--begin::Input group-->
													<!--begin::Col-->
													<div class="row g-12 mb-8">
														<div class="col-md-10 fv-row">
															<!--begin::Input group-->
															<label for="concepto" class="form-label required">Concepto</label>
															<div class="input-group">
																<span class="input-group-text">
																	<span class="svg-icon svg-icon-info svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"/>
                                                                            <rect x="6" y="12" width="7" height="2" rx="1" fill="black"/>
                                                                            <rect x="6" y="7" width="12" height="2" rx="1" fill="black"/>
                                                                        </svg>
																	</span>
																</span>
																<textarea id="concepto"  class="form-control valida" aria-label="With textarea"
																	style="height: 97px;"><?= $encOrden[0]["Concepto"]?></textarea>
															</div>
															<!--end::Input group-->
														</div>
                                                        <!-- <div class="col-md-2 fv-row">
                                                        <div class="text-left">
                                                            <button id="btnAddArt" class="btn btn-icon btn-block btn-success me-3 btn-hover-rise me-5" data-bs-toggle="tooltip" title="Agregar">
                                                                <span class="svg-icon svg-icon-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                                                    <path opacity="0.5" d="M12.4343 12.4343L10.75 10.75C10.3358 10.3358 9.66421 10.3358 9.25 10.75C8.83579 11.1642 8.83579 11.8358 9.25 12.25L12.2929 15.2929C12.6834 15.6834 13.3166 15.6834 13.7071 15.2929L19.25 9.75C19.6642 9.33579 19.6642 8.66421 19.25 8.25C18.8358 7.83579 18.1642 7.83579 17.75 8.25L13.5657 12.4343C13.2533 12.7467 12.7467 12.7467 12.4343 12.4343Z" fill="black"/>
                                                                    <path d="M8.43431 12.4343L6.75 10.75C6.33579 10.3358 5.66421 10.3358 5.25 10.75C4.83579 11.1642 4.83579 11.8358 5.25 12.25L8.29289 15.2929C8.68342 15.6834 9.31658 15.6834 9.70711 15.2929L15.25 9.75C15.6642 9.33579 15.6642 8.66421 15.25 8.25C14.8358 7.83579 14.1642 7.83579 13.75 8.25L9.56569 12.4343C9.25327 12.7467 8.74673 12.7467 8.43431 12.4343Z" fill="black"/>
                                                                </svg>
                                                                </span></button>


                                                                <button id="btnDelete" class="btn btn-icon btn-danger btn-hover-rise me-5" data-bs-toggle="tooltip" title="Eliminar"><span class="svg-icon svg-icon-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                                                    </svg>
                                                                </span></button>
                                                            </div>
														</div> -->
													</div>
													<div class="row g-12 mb-8 border rounded table-responsive">  
														<table style="width:100%" id="tblcajachica" class="table display compact table-sm table-striped table-row-dashed gy-5 gs-7">
														<thead class="">
																<tr class="fw-bold fs-6 text-muted ">
																	<th>Articulo <br> Solicitado</th>
																	<th>Articulo <br> según proveedor</th>
																	<th>N° Factura</th>
																	<th>Cantidad</th>
																	<th>Cantidad <br> Compra</th>
																	<th>Unidad <br> Medida</th>
																	<th>Precio</th>
																	<th>% Descuento</th>
																	<th>Monto <br> Descuento</th>
																	<th>Impuesto</th>
																	<th>Tipo moneda</th>
																	<th>SubTotal</th>
																	<th>Total</th>
																	<th class="w-10px pe-2">
																		Todos
																		<span class="badge badge-circle ms-2">
																			<div
																				class="form-check form-check-sm form-check-custom form-check-solid">
																				<input id="chkAll" class="form-check-input"
																					type="checkbox" value="" />
																			</div>
																		</span>
																	</th>
																</tr>
															</thead>
															<tbody class="fs-6">

															</tbody>
															<tfoot>
															<th style="font-weight: bold">Totales</th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th></th>
															<th>
																<input type="text" class="form-control form-control-transparent placeholder" id="sumaSubtotalFoot" value="" placeholder="0">
															</th>
															<th>
																<span style="display: none;" id="monedaValor1">CORDOBA</span>
																<span style="display: none;" id="monedaValor2">CORDOBAS</span>
																<input type="text" class="form-control form-control-transparent placeholder" id="sumaTotalFoot" value="" placeholder="0">
															</th>
															</tfoot>
														</table>

													</div>
													<div class="text-center">
														<button class="btn btn-primary me-3" id="btnSaveCaja">
															<i class="fa fa-save"></i>Guardar Datos
														</button>
														<a class="btn btn-danger" onclick="history.back()" href="javascript:void(0)">
															<span class="svg-icon svg-icon-muted svg-icon-2">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																	viewBox="0 0 24 24" fill="none">
																	<path
																		d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z"
																		fill="black" />
																	<path
																		d="M6.2238 13.2561C5.54282 12.5572 5.54281 11.4429 6.22379 10.7439L10.377 6.48107C10.8779 5.96697 11.75 6.32158 11.75 7.03934V16.9607C11.75 17.6785 10.8779 18.0331 10.377 17.519L6.2238 13.2561Z"
																		fill="black" />
																	<rect opacity="0.3" x="2" y="4" width="2" height="16" rx="1"
																		fill="black" />
																</svg>
															</span>
															Cancelar
														</a>
													</div>
													<!--end::Actions-->
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
