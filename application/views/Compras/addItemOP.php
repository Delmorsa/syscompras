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
							<span class="card-label fw-bolder text-dark">Agregar Items a Orden de Pago </span>
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
										<div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="<?= $encabezado[0]["FechaSolicitud"]?>"><?= $encabezado[0]["FechaSolicitud"]?></div>
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
										<div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="<?= $encOrden[0]["ConsecutivoOP"]?>" data-kt-countup-prefix="#"><?= $encOrden[0]["ConsecutivoOP"]?></div>
									</div>
									<!--end::Number-->
									<!--begin::Label-->
									<div class="fw-bold fs-6 text-gray-400">N° de Orden</div>
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
												   class="form-control" value="<?php echo $encOrden[0]["IdOrdenPago"]?>" />
											<div class="overflow-hidden flex-grow-1">
												<select id="listProv"
														class="form-select rounded-start-0 js-data-example-ajax valida">
													<option selected value="<?= $encOrden[0]["IdProveedor"]?>"><?= $encOrden[0]["Proveedor"]?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2 fv-row">
										<label for="fechaSol" class="form-label required">Fecha</label>
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
											<input id="fechaOP" class="form-control valida" value="<?= date_format(new DateTime($encOrden[0]["FechaCrea"]),"Y-m-d")?>" readonly />
										</div>
										<!--end::Input-->
									</div>
									<div class="col-md-2 fv-row">
										<label for="fechaSol" class="form-label required">C$</label>
										<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																	<span class="svg-icon svg-icon-info svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			 viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3"
																				  d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z"
																				  fill="black" />
																			<path
																				d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z"
																				fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
											<input class="form-control valida" value="<?= number_format($encOrden[0]["Cantidad"],2)?>" id="cantidad" />
											<input class="form-control" type="hidden" value="<?= str_replace(",","",number_format($encOrden[0]["Cantidad"],2))?>" id="cantidadTxt1" />
										</div>
										<!--end::Input-->
									</div>
									<div class="col-md-4 fv-row">
										<label for="cantidadTxt" class="form-label required">La cantidad de</label>
										<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																	<span class="svg-icon svg-icon-info svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			 viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3"
																				  d="M20 18H4C3.4 18 3 17.6 3 17V7C3 6.4 3.4 6 4 6H20C20.6 6 21 6.4 21 7V17C21 17.6 20.6 18 20 18ZM12 8C10.3 8 9 9.8 9 12C9 14.2 10.3 16 12 16C13.7 16 15 14.2 15 12C15 9.8 13.7 8 12 8Z"
																				  fill="black" />
																			<path
																				d="M18 6H20C20.6 6 21 6.4 21 7V9C19.3 9 18 7.7 18 6ZM6 6H4C3.4 6 3 6.4 3 7V9C4.7 9 6 7.7 6 6ZM21 17V15C19.3 15 18 16.3 18 18H20C20.6 18 21 17.6 21 17ZM3 15V17C3 17.6 3.4 18 4 18H6C6 16.3 4.7 15 3 15Z"
																				fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
											<input value="<?= $encOrden[0]["CantidadDesc"]?>" style="text-transform: capitalize" class="form-control valida" id="cantidadTxt" />
										</div>
										<!--end::Input-->
									</div>
								</div>
								<div class="row g-12 mb-8">
								<div class="col-md-4 fv-row">
																<label for="Proveedor" class="form-label required">Proveedor</label>
																<div class="input-group mb-5">
																	<span class="input-group-text" id="basic-addon1">
																		<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																		<span class="svg-icon svg-icon-info svg-icon-3">
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
																		<!--end::Svg Icon-->
																	</span>
																	<input value="<?= $encOrden[0]["Proveedor"]?>" class="form-control valida" id="Proveedor" />
																</div>
																<!--end::Input-->
															</div>
									<div class="col-md-6 fv-row">
										<label for="Chequetxt" class="form-label required">Cheque a nombre de</label>
										<div class="input-group mb-5">
																	<span class="input-group-text" id="basic-addon1">
																		<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																		<span class="svg-icon svg-icon-info svg-icon-3">
																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																				<path d="M22 7H2V11H22V7Z" fill="black"/>
																				<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black"/>
																			</svg>
																		</span>
																		<!--end::Svg Icon-->
																	</span>
											<input value="<?= $encOrden[0]["NombreCheque"]?>" class="form-control valida" id="Chequetxt" />
										</div>
										<!--end::Input-->
									</div>
								</div>
								<!--begin::Input group-->
								<!--begin::Col-->
								<div class="row g-12 mb-8">
														<div class="col-md-6 fv-row">
															<!--begin::Input group-->
															<label for="concepto" class="form-label required">En concepto de</label>
															<div class="input-group">
																<span class="input-group-text">
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
																</span>
																<textarea id="concepto" class="form-control valida" aria-label="With textarea"
																	style="height: 97px;"><?= $encOrden[0]["Concepto"]?></textarea>
															</div>
															<!--end::Input group-->
														</div>
														<div class="col-md-6 fv-row">
															<label for="area" class="form-label">Comentario</label>
															<div class="input-group mb-5">
																<span class="input-group-text" id="basic-addon1">
																	<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
																	<span class="svg-icon svg-icon-info svg-icon-3">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			 viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3"
																				  d="M20 18H4C3.4 18 3 17.6 3 17V7C3 6.4 3.4 6 4 6H20C20.6 6 21 6.4 21 7V17C21 17.6 20.6 18 20 18ZM12 8C10.3 8 9 9.8 9 12C9 14.2 10.3 16 12 16C13.7 16 15 14.2 15 12C15 9.8 13.7 8 12 8Z"
																				  fill="black" />
																			<path
																					d="M18 6H20C20.6 6 21 6.4 21 7V9C19.3 9 18 7.7 18 6ZM6 6H4C3.4 6 3 6.4 3 7V9C4.7 9 6 7.7 6 6ZM21 17V15C19.3 15 18 16.3 18 18H20C20.6 18 21 17.6 21 17ZM3 15V17C3 17.6 3.4 18 4 18H6C6 16.3 4.7 15 3 15Z"
																					fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
																<textarea id="comentarioRetiene" class="form-control" aria-label="With textarea"
																		  style="height: 97px;"><?= $encOrden[0]["ComentarioRetiene"]?></textarea>
															</div>
															<!--end::Input-->
														</div>
													</div>
													<div class="row g-12 mb-8">
														<div class="col-md-2 fv-row">
														<!--begin::Checkbox-->
														<div class="form-check form-check-custom form-check-solid mb-5">
															<!--begin::Input-->
															<?php
																if($encOrden[0]["Retiene"] != ""){
																	echo '<input class="form-check-input me-3" name="checkbox_input" type="checkbox" checked id="chkRetiene" />';
																}else{
																	echo '<input class="form-check-input me-3" name="checkbox_input" type="checkbox" id="chkRetiene" />';
																}
															?>
															<!--end::Input-->

															<!--begin::Label-->
															<label class="form-check-label" for="chkRetiene">
																<div class="fw-bolder text-gray-800">Retiene</div>
															</label>
															<!--end::Label-->
														</div>
														<!--end::Checkbox-->
														</div>
													</div>
													<div class="row g-12 mb-8 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3" 
													 <?php if($encOrden[0]["Retiene"] != ""){echo 'style="display: block;"';}else{echo 'style="display: none;"';}?>
													  id="divRetiene">
														<div class="col-md-3 fv-row">
															<label for="area" class="form-label">Seleccione una opcion</label>
															<div class="input-group flex-nowrap">
																<span class="input-group-text">
																	<span class="svg-icon svg-icon-info svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path opacity="0.3" d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z" fill="black"/>
																			<path d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z" fill="black"/>
																		</svg>
																	</span>
																</span>
																<div class="overflow-hidden flex-grow-1">
																	<select id="ddlRetiene" class="form-select rounded-start-0" data-control="select2" data-allow-clear="true" data-placeholder="Selecione una opcion">
																		<?php
																			if($encOrden[0]["Retiene"] != ""){
																				echo '<option selected disabled value="'.$encOrden[0]["Retiene"].'">retiene '.$encOrden[0]["Retiene"].'</option>
																				<option  value="1% y 2%">retiene 1% y 2%</option>
																				<option  value="1%">retiene 1%</option>
																				<option  value="2%">retiene 2%</option>';		
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
								<div class="row g-12 mb-8 border rounded table-responsive">
									<table style="width:100%" id="tblAutSolicitudes" class="table display compact table-sm table-striped table-row-dashed gy-5 gs-7">
										<thead class="">
										<tr class="fw-bold fs-6 text-muted ">
											<th>Articulo <br> Solicitado</th>
											<th>Articulo <br> según proveedor</th>
											<th>Proforma</th>
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
																<span style="display: none;" id="monedaValor1"></span>
																<span style="display: none;" id="monedaValor2"></span>
																<input type="text" class="form-control form-control-transparent placeholder" id="sumaTotalFoot" value="<?= number_format($encOrden[0]["Cantidad"],2)?>" placeholder="0">
															</th>
															</tfoot>
									</table>

								</div>
								<div class="text-center">
									<button class="btn btn-primary me-3" id="btnSaveOrden">
										<i class="fa fa-save"></i>Agregar Articulos
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
