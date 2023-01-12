<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-fluid">
		<!--begin::Navbar-->
		<div class="card mb-5 mb-xxl-8">
			<div class="card-body pt-9 pb-0">
				<!--begin::Details-->
				<div class="d-flex flex-wrap flex-sm-nowrap mb-6">
					<!--begin: Pic-->
					<div class="me-7 mb-4">
						<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
							<img src="<?php
							if($this->session->userdata("Genero") == 1){
								echo base_url().'/assets/img/user2.png"';
							}else{
								echo base_url().'/assets/img/female.jpg" ';
							}
							 ?>
							 alt="image" />
							<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle h-15px w-15px"></div>
						</div>
					</div>
					<!--end::Pic-->
					<!--begin::Info-->
					<div class="flex-grow-1">
						<!--begin::Title-->
						<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
							<!--begin::User-->
							<div class="d-flex flex-column">
								<div class="d-flex align-items-center mb-2">
									<a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">
										<?= $this->session->userdata("Name")?>
									</a>
									<a href="#">
										<!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
										<span class="svg-icon svg-icon-1 svg-icon-primary">
																<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																	<path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
																	<path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
																</svg>
															</span>
										<!--end::Svg Icon-->
									</a>
								</div>
								<div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
										<!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
										<span class="svg-icon svg-icon-4 me-1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
																<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
															</svg>
														</span>
										<!--end::Svg Icon--><?= $this->session->userdata("Puesto")?></a>
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
										<!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
										<span class="svg-icon svg-icon-4 me-1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
																<path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
															</svg>
														</span>
										<!--end::Svg Icon--><?= $this->session->userdata("Area")?></a>
									<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
										<!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
										<span class="svg-icon svg-icon-4 me-1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
																<path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
															</svg>
														</span>
										<!--end::Svg Icon--><?= $this->session->userdata("Correo")?></a>
								</div>
							</div>
							<!--end::User-->
						</div>
						<!--end::Title-->
						<!--begin::Stats-->
						<div class="d-flex flex-wrap justify-content-between">
							<!--begin::Info-->
							<div class="d-flex flex-column flex-grow-1 pe-8">
								<div class="d-flex flex-wrap">
									<div class="border border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3" >
										<span id="total"></span>
										<div class="fw-bold fs-6 text-gray-400">Total Solicitudes</div>
									</div>
									<div class="border border-dashed rounded min-w-125px py-2 px-4 me-6 mb-3">
										<span id="nuevas"></span>
										<div class="fw-bold fs-6 text-gray-400">Nuevas Solicitudes</div>
									</div>
									<div class="border border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
										<span id="atendidas"></span>
										<div class="fw-bold fs-6 text-gray-400">Solicitudes atendidas</div>
									</div>
								</div>
							</div>
							<!--end::Info-->
							<!--begin::Progress-->
							<!--<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
								<div class="d-flex justify-content-between w-100 mt-auto mb-2">
									<span class="fw-bold fs-6 text-gray-400">Profile Status</span>
									<span class="fw-bolder fs-6">68%</span>
								</div>
								<div class="h-5px mx-3 w-100 bg-light rounded mb-3">
									<div class="bg-primary rounded h-5px" role="progressbar" style="width: 68%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>-->
							<!--end::Progress-->
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Info-->
				</div>
				<!--end::Details-->
				<!--<div class="separator"></div>-->

			</div>
		</div>
		<!--end::Navbar-->
		<div class="row g-5 g-xxl-8">
			<div class="col-xl-8">
				<!--begin::Widget 9-->
				<div class="card">
					<!--begin::Body-->
					<div class="card-body pb-0">
						<div class="form" id="campos">
							<div class="row g-9 mb-8">
								<div class="col-md-6 fv-row">
									<label for="nombreuser" class="form-label required">Nombre Usuario</label>
									<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																 viewBox="0 0 24 24" fill="none">
																<path
																		d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
																		fill="black" />
																<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
																	  fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
										<input type="hidden" id="iduser" class="" />
										<input type="text" id="nombreuser" class="form-control"
											   placeholder="Nombre de usuario" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"
										value="<?= $this->session->userdata("User")?>"/>
									</div>
									<!--end::Input-->
								</div>
								<!--end::Col-->
							</div>
							<!--begin::Input group-->
							<!--begin::Col-->
							<div class="d-flex flex-column mb-7 fv-row">
								<!--begin::Input group-->
								<label for="nombre" class="form-label required">Nombre y Apellido</label>
								<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-3">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
															 viewBox="0 0 24 24" fill="none">
															<path opacity="0.3"
																  d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
																  fill="black" />
															<path
																	d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
																	fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</span>
									<input type="text" id="nombre" class="form-control"
										   placeholder="Ingresa el nombre y apellido" aria-label="Nombre"
										   aria-describedby="basic-addon1" autocomplete="off"
										   value="<?= $this->session->userdata("Name")?>"/>
								</div>
								<!--end::Input group-->
							</div>
							<div class="row g-12 mb-8">
								<div class="col-md-6 fv-row">
									<label for="nombreuser" class="form-label required">Puesto</label>
									<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
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
										<input type="text" id="puesto" class="form-control" placeholder="ingresa un puesto"
											   aria-label="Nombre" aria-describedby="basic-addon1" autocomplete="off"
											   value="<?= $this->session->userdata("Puesto")?>"/>
									</div>
									<!--end::Input-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-md-6 fv-row">
									<label for="correo" class="form-label required">Correo</label>
									<div class="input-group mb-5">
													<span class="input-group-text" id="basic-addon1">
														<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																 viewBox="0 0 24 24" fill="none">
																<path
																		d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
																		fill="black" />
																<path opacity="0.3"
																	  d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
																	  fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</span>
										<input type="text" id="correo" class="form-control"
											   placeholder="Ingresa un correo valido" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"
											   value="<?= $this->session->userdata("Correo")?>"/>
									</div>
									<!--end::Input-->
								</div>
								<!--end::Col-->
							</div>
							<div class="row g-12 mb-8">
								<div class="col-md-6 fv-row">
									<label for="listRoles" class="form-label required">Rol</label>
									<!--begin::Default example-->
									<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-muted svg-icon-2"><svg
																	xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																	viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	  fill="black" />
																<path
																		d="M12.0006 11.1542C13.1434 11.1542 14.0777 10.22 14.0777 9.0771C14.0777 7.93424 13.1434 7 12.0006 7C10.8577 7 9.92348 7.93424 9.92348 9.0771C9.92348 10.22 10.8577 11.1542 12.0006 11.1542Z"
																		fill="black" />
																<path
																		d="M15.5652 13.814C15.5108 13.6779 15.4382 13.551 15.3566 13.4331C14.9393 12.8163 14.2954 12.4081 13.5697 12.3083C13.479 12.2993 13.3793 12.3174 13.3067 12.3718C12.9257 12.653 12.4722 12.7981 12.0006 12.7981C11.5289 12.7981 11.0754 12.653 10.6944 12.3718C10.6219 12.3174 10.5221 12.2902 10.4314 12.3083C9.70578 12.4081 9.05272 12.8163 8.64456 13.4331C8.56293 13.551 8.49036 13.687 8.43595 13.814C8.40875 13.8684 8.41781 13.9319 8.44502 13.9864C8.51759 14.1133 8.60828 14.2403 8.68991 14.3492C8.81689 14.5215 8.95295 14.6757 9.10715 14.8208C9.23413 14.9478 9.37925 15.0657 9.52439 15.1836C10.2409 15.7188 11.1026 15.9999 11.9915 15.9999C12.8804 15.9999 13.7421 15.7188 14.4586 15.1836C14.6038 15.0748 14.7489 14.9478 14.8759 14.8208C15.021 14.6757 15.1661 14.5215 15.2931 14.3492C15.3838 14.2312 15.4655 14.1133 15.538 13.9864C15.5833 13.9319 15.5924 13.8684 15.5652 13.814Z"
																		fill="black" />
															</svg>
														</span>
													</span>
										<input readonly type="text" id="listRoles" class="form-control"
											   placeholder="Ingresa un correo valido" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"
											   value="<?= $this->session->userdata("Rol")?>"/>
									</div>
									<!--end::Default example-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-md-6 fv-row">
									<label for="listAreas" class="form-label required">Area</label>
									<!--begin::Default example-->
									<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-muted svg-icon-2"><svg
																	xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																	viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z"
																	  fill="black" />
																<path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="black" />
															</svg>
														</span>
													</span>
										<input type="text" readonly id="listAreas" class="form-control"
											   placeholder="Ingresa un correo valido" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"
											   value="<?= $this->session->userdata("Area")?>"/>
									</div>
									<!--end::Default example-->
								</div>
								<!--end::Col-->
							</div>
							<div class="row g-12 mb-8" style="display: none" id="divJefes">
								<div class="col-md-12 fv-row">
									<label for="listJefes" class="form-label required">Jefe asignado</label>
									<!--begin::Default example-->
									<div class="input-group flex-nowrap">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-muted svg-icon-2"><svg
																	xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																	viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	  fill="black" />
																<path
																		d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
																		fill="black" />
															</svg></span>
													</span>
										<input type="text" id="listJefes" class="form-control"
											   placeholder="Ingresa un correo valido" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"
											   value="<?= $this->session->userdata("Rol")?>"/>
									</div>
									<!--end::Default example-->
								</div>
								<!--end::Col-->
							</div>
							<div class="row g-12 mb-8">
								<div class="col-lg-6 mb-10 mb-lg-0">
									<label for="" class="form-label required">Genero</label>
									<!--begin::Tabs-->
									<div class="nav flex-column">
										<!--begin::Tab link-->
										<div id="btnMas" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
											 data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<?php
														$checked = "";
														if($this->session->userdata("Genero")==1){
															$checked = "checked";
														}else{
															$checked = "";
														}
													echo '<div
																class="form-check form-check-custom form-check-solid form-check-success me-6">
															<input id="chkmasculino" class="form-check-input" type="radio"
																   name="genero" '.$checked.' value="1" />
														</div>';
												?>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h6 class="d-flex align-items-center flex-wrap">Masculino
													</h6>
												</div>
												<!--end::Info-->
											</div>
										</div>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<div id="btnFem" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
											 data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
													<?php
														$checked = "";
														if($this->session->userdata("Genero")==2){
															$checked = "checked";
														}else{
															$checked = "";
														}

														echo '
															<div
																	class="form-check form-check-custom form-check-solid form-check-success me-6">
																<input id="chkfemenino" class="form-check-input" type="radio"
																	   name="genero" value="2" '.$checked.'/>
															</div>';
													?>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h6 class="d-flex align-items-center flex-wrap">Femenino
													</h6>
												</div>
												<!--end::Info-->
											</div>
										</div>
										<!--end::Tab link-->
									</div>
									<!--end::Tabs-->
								</div>

								<div class="col-lg-6">
									<label for="" class="form-label required">Autorización</label>
									<!--begin::Tabs-->
									<div class="nav flex-column">
										<!--begin::Tab link-->
										<div id="btnSoli" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
											 data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
													<?php
													$checked = "";
														if($this->session->userdata("Autoriza") == 0){
															$checked = "checked";
														}else{
															$checked = "";
														}
													echo '<div class="form-check form-check-custom form-check-solid form-check-success me-6">
													        <input id="chksolicita" class="form-check-input" type="radio"
														   name="permiso" value="1" '.$checked.' disabled/>
														   </div>';
													?>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h6 class="d-flex align-items-center flex-wrap">
														Solicita autorizacion
													</h6>
												</div>
												<!--end::Info-->
											</div>
										</div>
										<!--end::Tab link-->
										<!--begin::Tab link-->
										<div id="btnAut" class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
											 data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
											<!--end::Description-->
											<div class="d-flex align-items-center me-2">
												<!--begin::Radio-->
												<?php
													$checked = "";
													if($this->session->userdata("Autoriza") == 1){
														$checked = "checked";
													}else{
														$checked = "";
													}

													echo '<div
														class="form-check form-check-custom form-check-solid form-check-success me-6">
															<input id="chkautoriza" class="form-check-input" type="radio"
																   name="permiso" value="2" '.$checked.' disabled/>
														</div>';
												?>
												<!--end::Radio-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<h6 class="d-flex align-items-center flex-wrap">Autoriza solicitud
													</h6>
												</div>
												<!--end::Info-->
											</div>
										</div>
										<!--end::Tab link-->
									</div>
									<!--end::Tabs-->
								</div>
							</div>
							<!--<div class="text-center">
								<button type="button" id="btnActualizarUser"
										class="btn btn-lg btn-success w-50 mb-5">Actualizar</button>
							</div>-->
							<!--end::Actions-->
						</div>
						<br>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Widget 9-->
			</div>
			<div class="col-xl-4">
				<!--begin::Widget 12-->
				<div class="card mb-5 mb-xxl-8">
					<!--begin::Body-->
					<div class="card-body ">
						<!--begin::Header-->
						<div class="form" id="campos1">
							<div class="d-flex flex-column mb-7 fv-row">
								<!--begin::Input group-->
								<label for="nombre" class="form-label required">Contraseña actual</label>
								<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																 viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	  fill="black" />
																<path
																		d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
																		fill="black" />
															</svg>
														</span>
													<!--end::Svg Icon-->
												</span>
									<input type="password" id="passActual" class="form-control"
										   placeholder="Ingresa contraseña actual" aria-label="Nombre"
										   aria-describedby="basic-addon1" autocomplete="off"/>
								</div>
								<!--end::Input group-->
							</div>
							<div class="d-flex flex-column mb-7 fv-row">
								<!--begin::Input group-->
								<label for="nombre" class="form-label required">Confirmar contraseña</label>
								<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																 viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	  fill="black" />
																<path
																		d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
																		fill="black" />
															</svg>
														</span>
													<!--end::Svg Icon-->
												</span>
									<input type="password" id="passConfirm" class="form-control"
										   placeholder="Confirmar contraseña" aria-label="Nombre"
										   aria-describedby="basic-addon1" autocomplete="off"/>
								</div>
								<!--end::Input group-->
							</div>
							<div class="row g-12 mb-8">
								<div class="d-flex flex-column mb-7 fv-row">
									<!--begin::Input group-->
									<label for="nombre" class="form-label required">Nueva contraseña</label>
									<div class="input-group mb-5">
												<span class="input-group-text" id="basic-addon1">
													<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
													<span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																 viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
																	  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
																	  fill="black" />
																<path
																		d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
																		fill="black" />
															</svg>
														</span>
													<!--end::Svg Icon-->
												</span>
										<input type="password" id="passNew" class="form-control"
											   placeholder="Ingresa una nueva contraseña" aria-label="Nombre"
											   aria-describedby="basic-addon1" autocomplete="off"/>
									</div>
									<!--end::Input group-->
								</div>
							<div class="text-center">
								<button type="button" id="btnActualizarPass"
										class="btn btn-lg btn-success w-100 mb-5">Actualizar</button>
							</div>
							<!--end::Actions-->
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Widget 12-->
			</div>
		</div>
	</div>
	<!--end::Container-->
</div>
