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
						<h2 class="mb-1">Informe de Solicitudes</h2><br>
                        <div class="row col-12">
						<!--<button type="button" class="btn btn-danger" onclick="history.back()">
							
							<i class="fas fa-upload"></i>
							Volver</button>-->
						</div>
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
						<div class="mb-1 me-6">
							<!--begin::Checkbox-->
							<label for="listProv" class="form-label">Seleccionar un mes</label>
							<select  id="selectMes" class="form-select" data-control="select2">
								<?php
								setLocale(LC_TIME, "es_ES.UTF-8");
								$options = "";
								for ($i=1; $i <=12 ; $i++) {
									//@$value = ($i < 10) ? '0'.$i : $i;
									@$selectedOpt = ($i == date("m"))?'selected':'';
									$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.strftime("%B", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
								}
								echo @$options;
								?>
							</select>
						</div>
						<div class="mb-1">
							<!--begin::Checkbox-->
							<label for="listProv" class="form-label">Seleccionar un año</label>
							<select  id="selectAnio" class="form-select" data-control="select2">
								<option selected value=""></option>
							</select>
						</div>
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
			<div class="card-body">
				<div class="">
					<div>
						<!--begin::Table-->
						<table id="tblInformeSolic" class="table align-middle table-row-dashed fs-6 gy-5">
							<!--begin::Table head-->
							<thead>
							<!--begin::Table row-->
							<tr class="text-start text-gray-400 fw-bolder fs-7  gs-0">
								<th>Consecutivo</th>
								<th>Fecha Solicitud</th>
								<th>Descripcion Solicitud</th>
								<th>solicitante</th>
								<th>Area</th>
								<th>Autorizado por</th>
								<th rowspan="" class="text-center">Acciones</th>
								<th ></th>
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
