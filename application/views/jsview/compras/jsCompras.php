<script>
    $(document).ready(function(){
        $("#selectTipoSol").select2({
			placeholder: '--- Seleccione un tipo ---',
			allowClear: true,
			width: '100%'
		}).val(null).trigger('change.select2');
		let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
        cargarSolicA(select);
    });

    $("#selectTipoSol").on("change", function(){
    	let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
    	if($("#navA").hasClass('active')){
			cargarSolicA(select);
    	}
		if($("#navP").hasClass('active')){
			cargarSolicP(select);
		}
		if($("#navS").hasClass('active')){
			cargarSolicS(select);
		}
		if($("#navI").hasClass('active')){
			cargarSolicI(select);
		}
    });

	$("#navA").click(function(){
		let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
		cargarSolicA(select);
	});
	$("#navP").click(function(){
		let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
		cargarSolicP(select);
	});
	$("#navS").click(function(){
		let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
		cargarSolicS(select);
	});
	$("#navI").click(function(){
		let select = ($("#selectTipoSol").val() == undefined) ? "null" : $("#selectTipoSol option:selected").val();
		cargarSolicI(select)
	});

    function cargarSolicA(select){
		let table = $("#tblSolicitudes").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        ordering: false,
        "autoWidth": false,
		"ajax": {
			"url": "compras_autorizadas/"+"A"+"/"+select,
			"type": "POST"
		},
        columns: [
                { data: "Consecutivo"},
                { data: "FechaSolicitud"},
                { data: "DescripcionSolicitud"},
                { data: "Solicitante"},
                { data: "Area"},
                { data: "Jefe"},
                { data: "Estado"},
                { data: "Opciones"},
				{ data: "ribbon"}
            ],
		"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"rowCallback": function( row, data, index ) {
				switch (data.Prioridad){
					case 1:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 2:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 3:
						$(row).addClass(""+data.ClassPri+"");
						break;
					default:
						$(row).addClass(""+data.ClassPri+"");
						break;
				}
			},
			"initComplete": function(settings, json){


				$("#tblSolicitudes thead .tblSolicitudesSearch").each(function(){
					let title = $(this).text();
					$(this).html('<input type="search" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudes thead .tblSolicitudesSearchF").each(function(){
					let title = $(this).text();
					$(this).html('<input type="date" id="fechaFilter" autocomplete="off" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudes thead .tblSolicitudesSearchT").each(function(){
					let title = $(this).text();
					$(this).html('<select class="form-select" name="" id="ddlSolicA">'+
									'<option value="" selected></option>'+
									'<option value="1">Normal</option>'+
									'<option value="2">Alta</option>'+
									'<option value="3">Urgente</option>'+
								  '</select>');
				});

				let tbl = $("#tblSolicitudes").DataTable();
				tbl.columns().every(function(){
					let that = this;
					$('input',this.header()).on("keyup change", function(){
						that.search(this.value).draw();
					});
					$('select',this.header()).on("change", function(){
						that.search(this.value).draw();
					});
				});
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});
	}

	function cargarSolicP(select){
		let table = $("#tblSolicitudesProceso").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        ordering: false,
        "autoWidth": false,
		"ajax": {
			"url": "compras_autorizadas/"+"P"+"/"+select,
			"type": "POST"
		},
        columns: [
			/*{
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            <button class="btn btn-small detalles">
							<span class="svg-icon svg-icon-danger svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
							<path d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z" fill="black"/>
							</svg></span>
                            </button>`;
                    }
                },*/
				{ data: "PersonalCompra"},
                { data: "Consecutivo"},
                { data: "FechaSolicitud"},
                { data: "DescripcionSolicitud"},
                { data: "Solicitante"},
                { data: "Area"},
                { data: "Jefe"},
                { data: "Estado"},
                { data: "Opciones"},
				{ data: "ribbon"}
            ],
		"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"rowCallback": function( row, data, index ) {
				switch (data.Prioridad){
					case 1:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 2:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 3:
						$(row).addClass(""+data.ClassPri+"");
						break;
					default:
						$(row).addClass(""+data.ClassPri+"");
						break;
				}
			},"initComplete": function(settings, json){
				$("#tblSolicitudesProceso thead .tblSolicitudesProcesoSearch").each(function(){
					let title = $(this).text();
					$(this).html('<input type="search" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesProceso thead .tblSolicitudesProcesoSearchF").each(function(){
					let title = $(this).text();
					$(this).html('<input type="date" id="fechaFilterP" autocomplete="off" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesProceso thead .tblSolicitudesProcesoSearchT").each(function(){
					let title = $(this).text();
					$(this).html('<select class="form-select" name="" id="ddlSolicP">'+
									'<option value="" selected></option>'+
									'<option value="1">Normal</option>'+
									'<option value="2">Alta</option>'+
									'<option value="3">Urgente</option>'+
								  '</select>');
				});

				let tbl = $("#tblSolicitudesProceso").DataTable();
				tbl.columns().every(function(){
					let that = this;
					$('input',this.header()).on("keyup change", function(){
						that.search(this.value).draw();
					});
					$('select',this.header()).on("change", function(){
						that.search(this.value).draw();
					});
				});
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function cargarSolicS(select){
		let table = $("#tblSolicitudesCerrado").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			ordering: false,
			"autoWidth": false,
			"ajax": {
				"url": "compras_autorizadas/"+"S"+"/"+select,
				"type": "POST"
			},
			columns: [
				/*{
						targets: 0,
						orderable: false,
						render: function (data) {
							return `
								<button class="btn btn-small detalles">
								<span class="svg-icon svg-icon-danger svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
								<path d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z" fill="black"/>
								</svg></span>
								</button>`;
						}
					},*/
				{ data: "PersonalCompra"},
				{ data: "Consecutivo"},
				{ data: "FechaSolicitud"},
				{ data: "DescripcionSolicitud"},
				{ data: "Solicitante"},
				{ data: "Area"},
				{ data: "Jefe"},
				{ data: "Estado"},
				{ data: "Opciones"},
				{ data: "ribbon"}
			],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
				"lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
					'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
					'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
					'</svg>',
				"loadingRecords": "",
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"rowCallback": function( row, data, index ) {
				switch (data.Prioridad){
					case 1:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 2:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 3:
						$(row).addClass(""+data.ClassPri+"");
						break;
					default:
						$(row).addClass(""+data.ClassPri+"");
						break;
				}
			},"initComplete": function(settings, json){
				$("#tblSolicitudesCerrado thead .tblSolicitudesCerradoSearch").each(function(){
					let title = $(this).text();
					$(this).html('<input type="search" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesCerrado thead .tblSolicitudesCerradoSearchF").each(function(){
					let title = $(this).text();
					$(this).html('<input type="date" id="fechaFilterP" autocomplete="off" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesCerrado thead .tblSolicitudesCerradoSearchT").each(function(){
					let title = $(this).text();
					$(this).html('<select class="form-select" name="" id="ddlSolicS">'+
									'<option value="" selected></option>'+
									'<option value="1">Normal</option>'+
									'<option value="2">Alta</option>'+
									'<option value="3">Urgente</option>'+
								  '</select>');
				});

				let tbl = $("#tblSolicitudesCerrado").DataTable();
				tbl.columns().every(function(){
					let that = this;
					$('input',this.header()).on("keyup change", function(){
						that.search(this.value).draw();
					});
					$('select',this.header()).on("change", function(){
						that.search(this.value).draw();
					});
				});
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function cargarSolicI(select){
		let table = $("#tblSolicitudesAnulada").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			ordering: false,
			"autoWidth": false,
			"ajax": {
				"url": "compras_autorizadas/"+"I"+"/"+select,
				"type": "POST"
			},
			columns: [
				/*{
						targets: 0,
						orderable: false,
						render: function (data) {
							return `
								<button class="btn btn-small detalles">
								<span class="svg-icon svg-icon-danger svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
								<path d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z" fill="black"/>
								</svg></span>
								</button>`;
						}
					},*/
				{ data: "PersonalCompra"},
				{ data: "Consecutivo"},
				{ data: "FechaSolicitud"},
				{ data: "DescripcionSolicitud"},
				{ data: "Solicitante"},
				{ data: "Area"},
				{ data: "Jefe"},
				{ data: "Estado"},
				{ data: "Opciones"},
				{ data: "ribbon"}
			],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
				"lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
					'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
					'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
					'</svg>',
				"loadingRecords": "",
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"rowCallback": function( row, data, index ) {
				switch (data.Prioridad){
					case 1:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 2:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 3:
						$(row).addClass(""+data.ClassPri+"");
						break;
					default:
						$(row).addClass(""+data.ClassPri+"");
						break;
				}
			},"initComplete": function(settings, json){
				$("#tblSolicitudesAnulada thead .tblSolicitudesAnuladaSearch").each(function(){
					let title = $(this).text();
					$(this).html('<input type="search" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesAnulada thead .tblSolicitudesAnuladaSearchF").each(function(){
					let title = $(this).text();
					$(this).html('<input type="date" id="fechaFilterP" autocomplete="off" class="form-control" placeholder="' + title + '" />');
				});

				$("#tblSolicitudesAnulada thead .tblSolicitudesAnuladaSearchT").each(function(){
					let title = $(this).text();
					$(this).html('<select class="form-select" name="" id="ddlSolicI">'+
									'<option value="" selected></option>'+
									'<option value="1">Normal</option>'+
									'<option value="2">Alta</option>'+
									'<option value="3">Urgente</option>'+
								  '</select>');
				});

				let tbl = $("#tblSolicitudesAnulada").DataTable();
				tbl.columns().every(function(){
					let that = this;
					$('input',this.header()).on("keyup change", function(){
						that.search(this.value).draw();
					});
					$('select',this.header()).on("change", function(){
						that.search(this.value).draw();
					});
				});
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	/*debugger;
	$('.dropdown').on('shown.bs.dropdown', function () {
		debugger;
          console.log($('#table-responsive-cliente').height() + 500)
          $("#table-responsive-cliente").css("height",$('#table-responsive-cliente').height() + 500 );
    });

    $('.dropdown').on('hide.bs.dropdown', function () {
           $("#table-responsive-cliente").css("height","auto");
    });*/

		$('.table').on('show.bs.dropdown', function () {
			//debugger;
			$('.table-responsive').css( "overflow", "inherit !important" );
			$('.table-responsive').css( "position", "relative !important" );
		});

		$('.table').on('hide.bs.dropdown', function () {
			$('.table-responsive').css( "overflow", "auto" );
		});

	function detalles(idsolicitud,consecutivo){
        $("#modalTitle").text("Detalle de solicitud");
        $("#detConsec").text(" n° "+consecutivo+" ");
		$("#IdSolic").text("");
		$("#IdSolic1").text(idsolicitud);
        $("#modalSolicitud").modal("show");
        let table = $("#tblDetSolicitudes").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "getSolicitudesDetAjax"+"/"+idsolicitud,
			"type": "POST"
		},
        columns: [
                { data: "CantidadSolicitud"},
                { data: "UnidadMedida"},
                { data: "CantidadAut"},
                { data: "DescripcionArticulo"},
                { data: "estadoAut"}
            ],
		"lengthMenu": [
				[5, 10, 25, 50, 100, -1],
				[5, 10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"
		});
    }

	function detallesOrdenes(idsolicitud,cons){
		$("#IdSolic1").text("");
		$("#IdSolic").text(idsolicitud);
		$("#detConsecOr").text(cons);
		mostrarOC(idsolicitud);
		$("#modalOrdenes").modal("show");
	}

	/********************************************************** */
	$("#panelOC").click(function(){
		mostrarOC($("#IdSolic").text());
	});

	$("#panelOP").click(function(){
		mostrarOP($("#IdSolic").text());
	});

	$("#panelCH").click(function (){
		mostrarCH($("#IdSolic").text());
	});

	function mostrarOC(idsolicitudS){
		let table = $("#tblOC").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
		"ajax": {
			"url": "mostrarOC/"+idsolicitudS,
			"type": "POST"
		},
        columns: [

                {data: "Consecutivo"},
				{data: "FechaOC"},
				{data: "Proveedor"},
				{data: "Direccion"},
				{data: "TiempoEntrega"},
				{data: "Opciones"}
				/*{
                    targets: 5,
                    orderable: false,
                    render: function (data) {
                        return `
                            <button class="btn btn-small detalles">
							<span class="svg-icon svg-icon-primary svg-icon-2">
									<i class="fas fa-info-circle text-primary fs-2"></i>
								</span>
                            </button>
							<button class="btn btn-small imprimirOC">
							<span class="svg-icon svg-icon-primary svg-icon-2">
									<i class="fas fa-print text-success fs-2"></i>
								</span>
                            </button>
							<button class="btn btn-small">
							  <span class="svg-icon svg-icon-primary svg-icon-2">
							     <i class="fas fa-print text-success fs-2"></i>
							   </span>
                            </button>-->`;
                    }
                }*/
            ],
		"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function mostrarOP(idsolicitudS){
		let table = $("#tblOP").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
		"ajax": {
			"url": "mostrarOP/"+idsolicitudS,
			"type": "POST"
		},
        columns: [
				 {data: "ConsecutivoOP"},
				 {data: "Proveedor"},
				 {data: "NombreCheque"},
				 {data: "Cantidad"},
				 {data: "CantidadDesc"},
				 {data: "Concepto"},
				 {data: "Retiene"},
				 {data: "ComentarioRetiene"},
				 {data: "FechaCrea"},
				 {data: "Opciones"}
				 /*{
                    targets: 9,
                    orderable: false,
                    render: function (datos) {
                        return `
                            <button class="btn btn-small detallesOP">
								<span class="svg-icon svg-icon-primary svg-icon-2">
									<i class="fas fa-info-circle text-primary fs-2"></i>
								</span>
                            </button>
							<button class="btn btn-small imprimirOP">
							  <span class="svg-icon svg-icon-primary svg-icon-2">
							     <i class="fas fa-print text-success fs-2"></i>
							   </span>
                            </button>
							<a href="viewAddItemOrder/2/${$("#IdSolic").text()}/${data}" class="btn btn-small">
								<span class="svg-icon svg-icon-primary svg-icon-2">
									<i class="fas fa-plus-square text-warning fs-2"></i>
								</span>
                            </a>`;
                    }
                }*/
            ],
		"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
			    "lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
														'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
														'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
													'</svg>',
                "loadingRecords": "",
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function mostrarCH(idsolicitudS){
		let table = $("#tblCH").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			"ajax": {
				"url": "mostrarCH/"+idsolicitudS,
				"type": "POST"
			},
			columns: [
				{data: "consecutivoCH"},
				{data: "fechaCrea"},
				{data: "Proveedor"},
				{data: "Concepto"},
				{data: "Total"},
				{data: "Opciones"}
				/*{
					targets: 4,
					orderable: false,
					render: function (data) {
						return `
                            <button class="btn btn-small detallesCH">
								<span class="svg-icon svg-icon-primary svg-icon-2">
									<i class="fas fa-info-circle text-primary fs-2"></i>
								</span>
                            </button>
							<button class="btn btn-small">
							  <span class="svg-icon svg-icon-primary svg-icon-2">
							     <i class="fas fa-print text-success fs-2"></i>
							   </span>
                            </button>`;
					}
				}*/
			],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "asc"]
			],
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
				"lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
					'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
					'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
					'</svg>',
				"loadingRecords": "",
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});
	}
    /******************************************************** */

	function mostrarDetalles(callback,id,div)
    {
		let subTotal = 0, total = 0;
        $.ajax({
            url: "mostrarDetOC/"+id,
            async: true,
            success: function(response){

                let thead = '',tbody='';
                if(response != "false"){
                    let obj = $.parseJSON(response);
					thead += "<th class='text-sm-center bg-primary'>Articulo</th>";
					thead += "<th class='text-sm-center bg-primary'>Articulo </br> Proveedor</th>";
					thead += "<th class='text-sm-center bg-primary'>N° Proforma</th>";
					thead += "<th class='text-sm-center bg-primary'>Unidad </br> Medida</th>";
					thead += "<th class='text-sm-center bg-primary'>Cantidad</th>";
					thead += "<th class='text-sm-center bg-primary'>Precio</th>"; //Ant. <br> Descuento
					thead += "<th class='text-sm-center bg-primary'>% Descuento</th>";
					thead += "<th class='text-sm-center bg-primary'>Monto </br> Descuento</th>";
					thead += "<th class='text-sm-center bg-primary'>Impuesto</th>";
					thead += "<th class='text-sm-center bg-primary'>% Impuesto</th>";
					thead += "<th class='text-sm-center bg-primary'>Moneda</th>";
					thead += "<th class='text-sm-center bg-primary'>ISC</th>";
					thead += "<th class='text-sm-center bg-primary'>IVA</th>";
					thead += "<th class='text-sm-center bg-primary'>SubTotal</th>";
					thead += "<th class='text-sm-center bg-primary'>Total</th>";
					thead += "<th class='text-sm-center bg-primary'>Acciones</th></tr>";

                    $.each(obj, function(i, item){
						subTotal += Number(item.SubTotal);
						total += Number(item.Total);
                        tbody += "<tr>"+
                           	"<td class='text-sm-start'>"+item.Articulo+"</td>"+
							"<td class='text-sm-start'>"+item.ArticuloProveedor+"</td>"+
							"<td class='text-sm-start'>"+item.NumProforma+"</td>"+
							"<td class='text-sm-start'>"+item.UnidadMedida+"</td>"+
							"<td class='text-sm-start'>"+item.Cantidad+"</td>"+
							"<td class='text-sm-start'>"+item.PrecioAntDescuento+"</td>"+
							"<td class='text-sm-start'>"+item.PorcentDescuento+"</td>"+
							"<td class='text-sm-start'>"+item.MontoDesc+"</td>"+
							"<td class='text-sm-start'>"+item.CodImpuesto+"</td>"+
							"<td class='text-sm-start'>"+item.PorcentImpuesto+"</td>"+
							"<td class='text-sm-start'>"+item.Moneda+"</td>"+
							"<td class='text-sm-start'>"+item.ISC+"</td>"+
							"<td class='text-sm-start'>"+item.IVA+"</td>"+
							"<td class='text-sm-start'>"+item.SubTotal+"</td>"+
							"<td class='text-sm-start'>"+item.Total+"</td>"+
							"<td class='text-sm-center'> <a href='viewEditOrder/1/"+$("#IdSolic").text()+"/"+item.IdOrdenCompra+"' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
										"<span class='svg-icon svg-icon-warning svg-icon-3'>"+
										"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
											"<path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>"+
											"<path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>"+
											"<path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>"+
										"</svg>"+
									"</span>"+
								"</a>"+

							 "<a onclick='jsbajaOrdenArt("+'"'+item.IdDetalleOC+'","1"'+")' href='javascript:void(0)' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
									"<span class='svg-icon svg-icon-danger svg-icon-3'>"+
										"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
											"<path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>"+
											"<path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>"+
											"<path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>"+
										"</svg>"+
									"</span>"+
								"</a></td>"+
							"</tr>";
                    });
					let tfoot = `
						<tfoot>
							<tr class="bg-warning">
								<th>Totales</th>
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
								<th></th>
								<th></th>
								<th>${subTotal.toFixed(2)}</th>
								<th>${total.toFixed(2)}</th>
								<th></th>
							</tr>
						</tfoot>
					`;
                    callback($("<table id='detOC' class='table table-row-dashed table-row-gray-300 table-bordered table-condensed table-striped '>"+ thead + tbody + tfoot +"</table>")).show();
                }else {
                    /*thead += "<th class='text-center bg-primary'>Numero</th>";
                    thead += "<th class='text-center bg-primary'>Codigo bascula</th>";
                    thead += "<th class='text-center bg-primary'>Hora</th>";
                    thead += "<th class='text-center bg-primary'>Peso de masa</th>";
                    thead += "<th class='text-center bg-primary'>Peso reg. en bascula</th>";
                    thead += "<th class='text-center bg-primary'>Diferencia</th></tr>";
                    tbody += '<tr >' +
                        "<td></td>"+
                        "<td></td>"+
                        "<td>No hay datos disponibles</td>"+
                        "<td></td>"+
                        "<td></td>"+
                        "<td></td>"+
                        '</tr>';
                    callback($('<table id="detMCPE" class="table table-bordered table-condensed table-striped">' + thead + tbody + '</table>')).show();*/
                }
            }
        });
    }

	$("#tblOC").on("click","tbody .detalles", function () {
        let table = $("#tblOC").DataTable();
        let tr = $(this).closest("tr");
        //$(this).addClass("detalleNumOrdOrange");
        let row = table.row(tr);
        let data = table.row($(this).parents("tr")).data();

        if(row.child.isShown())
        {
            row.child.hide();
            tr.removeClass("shown");
        }else{
            mostrarDetalles(row.child,data.IdOrdenCompra,data.IdOrdenCompra);
            tr.addClass("shown");
        }
    });

	$("#tblOP").on("click","tbody .imprimirOP", function () {
		let table = $("#tblOP").DataTable();
		let data = table.row($(this).parents("tr")).data();
		window.open('imprimirDocumentos/'+data.IdOrdenPago+'/2','_blank')

	});

	$("#tblOC").on("click","tbody .imprimirOC", function () {
		let table = $("#tblOC").DataTable();
		let data = table.row($(this).parents("tr")).data();
		window.open('imprimirDocumentos/'+data.IdOrdenCompra+'/1','_blank')
	});

	$(".printSolic").on("click", function (){
		let idSolic1 = $("#IdSolic1").text();
		let idSolic = $("#IdSolic").text();
		let disolic= "";
		if(idSolic1 == ""){
			disolic = idSolic;
		}else{
			disolic = idSolic1;
		}
		window.open('imprimirSolic/'+disolic+'','_blank')
	});

	function mostrarDetallesOP(callback,id,div)
    {
		let subTotal = 0, total = 0;
        $.ajax({
            url: "mostrarDetOP/"+id,
            async: true,
            success: function(response){

                let thead = '',tbody='';
                if(response != "false"){
                    let obj = $.parseJSON(response);
					thead += "<tr class='bg-warning'><th class='text-sm-center'>Articulo</th>";
					thead += "<th class='text-sm-center'>Articulo </br> Proveedor</th>";
					thead += "<th class='text-sm-center'>N° Proforma</th>";
					thead += "<th class='text-sm-center'>Unidad </br> Medida</th>";
					thead += "<th class='text-sm-center'>Cantidad</th>";
					thead += "<th class='text-sm-center'>Precio</th>"; //Ant. <br> Descuento
					thead += "<th class='text-sm-center'>% Descuento</th>";
					thead += "<th class='text-sm-center'>Monto </br> Descuento</th>";
					thead += "<th class='text-sm-center'>Impuesto</th>";
					thead += "<th class='text-sm-center'>% Impuesto</th>";
					thead += "<th class='text-sm-center'>Moneda</th>";
					thead += "<th class='text-sm-center'>ISC</th>";
					thead += "<th class='text-sm-center'>IVA</th>";
					thead += "<th class='text-sm-center'>SubTotal</th>";
					thead += "<th class='text-sm-center'>Total</th>";
					thead += "<th class='text-sm-center'>Acciones</th></tr>";

                    $.each(obj, function(i, item){
						subTotal += Number(item.SubTotal);
						total += Number(item.Total);
                        tbody += "<tr>"+
                           	"<td class='text-sm-start'>"+item.Articulo+"</td>"+
							"<td class='text-sm-start'>"+item.ArticuloProveedor+"</td>"+
							"<td class='text-sm-center'>"+item.NumProforma+"</td>"+
							"<td class='text-sm-center'>"+item.UnidadMedida+"</td>"+
							"<td class='text-sm-center'>"+item.Cantidad+"</td>"+
							"<td class='text-sm-center'>"+item.PrecioAntDescuento+"</td>"+
							"<td class='text-sm-center'>"+item.PorcentDescuento+"</td>"+
							"<td class='text-sm-center'>"+item.MontoDesc+"</td>"+
							"<td class='text-sm-center'>"+item.CodImpuesto+"</td>"+
							"<td class='text-sm-center'>"+item.PorcentImpuesto+"</td>"+
							"<td class='text-sm-center'>"+item.Moneda+"</td>"+
							"<td class='text-sm-center'>"+item.ISC+"</td>"+
							"<td class='text-sm-center'>"+item.IVA+"</td>"+
							"<td class='text-sm-center'>"+item.SubTotal+"</td>"+
							"<td class='text-sm-center'>"+item.Total+"</td>"+
							"<td class='text-sm-center'><a href='viewEditOrder/2/"+$("#IdSolic").text()+"/"+item.IdOrdenPago+"' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
										"<span class='svg-icon svg-icon-warning svg-icon-3'>"+
										"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
											"<path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>"+
											"<path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>"+
											"<path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>"+
										"</svg>"+
									"</span>"+
								"</a>"+


							"<a onclick='jsbajaOrdenArt("+'"'+item.IdDetalleOP+'","2"'+")' href='javascript:void(0)' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
									"<span class='svg-icon svg-icon-danger svg-icon-3'>"+
										"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
											"<path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>"+
											"<path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>"+
											"<path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>"+
										"</svg>"+
									"</span>"+
								"</a></td>"+
							"</tr>";
                    });

					let tfoot = `
					  <tfoot>
						<tr class='bg-warning'>
							<th>Totales</th>
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
							<th></th>
							<th></th>
							<th>${subTotal.toFixed(2)}</th>
							<th>${total.toFixed(2)}</th>
							<th></th>
						</tr>
					  </tfoot>
					`;
                    callback($("<table id='detOP' class='table table-row-dashed table-row-gray-300 table-bordered table-condensed table-striped '>"+ thead + tbody + tfoot +"</table>")).show();
				}else {
                    /*thead += "<th class='text-center bg-primary'>Numero</th>";
                    thead += "<th class='text-center bg-primary'>Codigo bascula</th>";
                    thead += "<th class='text-center bg-primary'>Hora</th>";
                    thead += "<th class='text-center bg-primary'>Peso de masa</th>";
                    thead += "<th class='text-center bg-primary'>Peso reg. en bascula</th>";
                    thead += "<th class='text-center bg-primary'>Diferencia</th></tr>";
                    tbody += '<tr >' +
                        "<td></td>"+
                        "<td></td>"+
                        "<td>No hay datos disponibles</td>"+
                        "<td></td>"+
                        "<td></td>"+
                        "<td></td>"+
                        '</tr>';
                    callback($('<table id="detMCPE" class="table table-bordered table-condensed table-striped">' + thead + tbody + '</table>')).show();*/
                }
            }
        });
    }

	$("#tblOP").on("click","tbody .detallesOP", function () {
		$("#IdOrden").text("");
        let table = $("#tblOP").DataTable();
        let tr = $(this).closest("tr");
        let row = table.row(tr);
        let data = table.row($(this).parents("tr")).data();
		$("#IdOrden").text(data.IdOrdenPago);

        if(row.child.isShown())
        {
            row.child.hide();
            tr.removeClass("shown");
        }else{
            mostrarDetallesOP(row.child,data.IdOrdenPago,data.IdOrdenPago);
            tr.addClass("shown");
        }
    });

	function mostrarDetallesCH(callback,id,div){
		let subTotal = 0, total = 0;
		$.ajax({
			url: "mostrarDetCH/"+id,
			async: true,
			success: function(response){

			let thead = '',tbody='';
			if(response != "false"){
				let obj = $.parseJSON(response);
				thead += "<tr class='bg-warning'><th class='text-sm-center'>Articulo</th>";
				thead += "<th class='text-sm-center'>Articulo </br> Proveedor</th>";
				thead += "<th class='text-sm-center'>N° Proforma</th>";
				thead += "<th class='text-sm-center'>Unidad </br> Medida</th>";
				thead += "<th class='text-sm-center'>Cantidad</th>";
				thead += "<th class='text-sm-center'>Precio</th>"; //Ant. <br> Descuento
				thead += "<th class='text-sm-center'>% Descuento</th>";
				thead += "<th class='text-sm-center'>Monto </br> Descuento</th>";
				thead += "<th class='text-sm-center'>Impuesto</th>";
				thead += "<th class='text-sm-center'>% Impuesto</th>";
				thead += "<th class='text-sm-center'>Moneda</th>";
				thead += "<th class='text-sm-center'>ISC</th>";
				thead += "<th class='text-sm-center'>IVA</th>";
				thead += "<th class='text-sm-center'>SubTotal</th>";
				thead += "<th class='text-sm-center'>Total</th>";
				thead += "<th class='text-sm-center'>Acciones</th></tr>";

				$.each(obj, function(i, item){
					subTotal += Number(item.SubTotal);
					total += Number(item.Total);
					tbody += "<tr>"+
						"<td class='text-sm-start'>"+item.Articulo+"</td>"+
						"<td class='text-sm-start'>"+item.ArticuloProveedor+"</td>"+
						"<td class='text-sm-center'>"+item.NumFactura+"</td>"+
						"<td class='text-sm-center'>"+item.UnidadMedida+"</td>"+
						"<td class='text-sm-center'>"+item.Cantidad+"</td>"+
						"<td class='text-sm-center'>"+item.PrecioAntDescuento+"</td>"+
						"<td class='text-sm-center'>"+item.PorcentDescuento+"</td>"+
						"<td class='text-sm-center'>"+item.MontoDesc+"</td>"+
						"<td class='text-sm-center'>"+item.CodImpuesto+"</td>"+
						"<td class='text-sm-center'>"+item.PorcentImpuesto+"</td>"+
						"<td class='text-sm-center'>"+item.Moneda+"</td>"+
						"<td class='text-sm-center'>"+item.ISC+"</td>"+
						"<td class='text-sm-center'>"+item.IVA+"</td>"+
						"<td class='text-sm-center'>"+item.SubTotal+"</td>"+
						"<td class='text-sm-center'>"+item.Total+"</td>"+
						"<td class='text-sm-center'><a href='viewEditOrder/3/"+$("#IdSolic").text()+"/"+item.IdCajaChica+"' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
									"<span class='svg-icon svg-icon-warning svg-icon-3'>"+
									"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
										"<path opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z' fill='black'/>"+
										"<path d='M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z' fill='black'/>"+
										"<path d='M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z' fill='black'/>"+
									"</svg>"+
								"</span>"+
							"</a>"+


						"<a onclick='jsbajaOrdenArt("+'"'+item.IdCajaChica+'","3"'+")' href='javascript:void(0)' class='btn btn-icon btn-sm btn-hover-rise me-5'>"+
								"<span class='svg-icon svg-icon-danger svg-icon-3'>"+
									"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>"+
										"<path d='M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z' fill='black'/>"+
										"<path opacity='0.5' d='M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z' fill='black'/>"+
										"<path opacity='0.5' d='M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z' fill='black'/>"+
									"</svg>"+
								"</span>"+
							"</a></td>"+
						"</tr>";
				});

				let tfoot = `
				<tfoot>
					<tr class='bg-warning'>
						<th>Totales</th>
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
						<th></th>
						<th></th>
						<th>${subTotal.toFixed(2)}</th>
						<th>${total.toFixed(2)}</th>
						<th></th>
					</tr>
				</tfoot>
				`;
				callback($("<table id='detOP' class='table table-row-dashed table-row-gray-300 table-bordered table-condensed table-striped '>"+ thead + tbody + tfoot +"</table>")).show();
			}else {
				/*thead += "<th class='text-center bg-primary'>Numero</th>";
				thead += "<th class='text-center bg-primary'>Codigo bascula</th>";
				thead += "<th class='text-center bg-primary'>Hora</th>";
				thead += "<th class='text-center bg-primary'>Peso de masa</th>";
				thead += "<th class='text-center bg-primary'>Peso reg. en bascula</th>";
				thead += "<th class='text-center bg-primary'>Diferencia</th></tr>";
				tbody += '<tr >' +
					"<td></td>"+
					"<td></td>"+
					"<td>No hay datos disponibles</td>"+
					"<td></td>"+
					"<td></td>"+
					"<td></td>"+
					'</tr>';
				callback($('<table id="detMCPE" class="table table-bordered table-condensed table-striped">' + thead + tbody + '</table>')).show();*/
			}
		  }
		});
	}

	$("#tblCH").on("click","tbody .detallesCH", function () {

		let table = $("#tblCH").DataTable();
		let tr = $(this).closest("tr");
		let row = table.row(tr);
		let data = table.row($(this).parents("tr")).data();

		if(row.child.isShown())
		{
			row.child.hide();
			tr.removeClass("shown");
		}else{
			mostrarDetallesCH(row.child,data.IdCajaChica,data.IdCajaChica);
			tr.addClass("shown");
		}
	});

	/*************************************************************************************************************/
	function editarCH(idDetCH){
		$("#divopcionesCH"+idDetCH).hide();
		$("#divmodificarCH"+idDetCH).show();
		$("#subtotalCH"+idDetCH).attr("readonly", false);
		$("#recibo"+idDetCH).attr("readonly", false);
		$("#concepto"+idDetCH).attr("readonly", false);
		$("#factura"+idDetCH).attr("readonly", false);
		$("#benef"+idDetCH).attr("readonly", false);
		$("#subtotalCH"+idDetCH).focus();
		$("#ddlCH"+idDetCH).prop("disabled",false)
	}

	function cancelEditarCH(idDetCH){
		$("#divopcionesCH"+idDetCH).show();
		$("#divmodificarCH"+idDetCH).hide();
		$("#subtotalCH"+idDetCH).attr("readonly", true);
		$("#recibo"+idDetCH).attr("readonly", true);
		$("#concepto"+idDetCH).attr("readonly", true);
		$("#factura"+idDetCH).attr("readonly", true);
		$("#benef"+idDetCH).attr("readonly", true);
		$("#subtotalCH"+idDetCH).blur();
		$("#ddlCH"+idDetCH).prop("disabled",true)
	}

	function calculosCH(idDetCH){
		let valor = $("#subtotalCH"+idDetCH).val(),
			impuesto = $("#ddlCH"+idDetCH+" option:selected").val(),
			resultado = 0;
		resultado = parseFloat(valor) * parseFloat(impuesto);
		resultado = parseFloat(valor) + parseFloat(resultado);

		$("#impCH"+idDetCH).val(impuesto);
		$("#totalCH"+idDetCH).val(parseFloat(resultado));
	}

	function actualizarCH(idDetCH){
		let mensaje = "", icon = "";
		let form_data = {
			idDetCH: idDetCH,
			fecha: $("#recibo"+idDetCH).val(),
			concepto: $("#concepto"+idDetCH).val(),
			numFac: $("#factura"+idDetCH).val(),
			benef: $("#benef"+idDetCH).val(),
			imp: $("#ddlCH"+idDetCH+" option:selected").text(),
			porcImp: $("#impCH"+idDetCH).val(),
			subTotal: $("#subtotalCH"+idDetCH).val(),
			total: $("#totalCH"+idDetCH).val()
		};

		$.ajax({
			url: "updateCajaChica",
			type: "POST",
			data: form_data,
			success: function (data){
				let obj = jQuery.parseJSON(data);
				$.each(obj, function (i, key){
					mensaje = key["mensaje"];
					icon = key["tipo"];
				});

				Swal.fire({
					allowOutsideClick: false,
					icon: icon,
					text: mensaje,
					confirmButtonText: "cerrar",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				}).then((result) => {
					mostrarDetallesCH();
				});
			}
		});

	}

	function cerrarSolicitud(idSolicitud,cons) {
		Swal.fire({
			title: `Solicitud n° ${cons}`,
			text: "Este proceso es irreversible. ¿Estas seguro que deseas cerrar esta solicitud?",
			icon: 'question',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Cerrar Solicitud",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {
				let mensaje = "", icon = "";
				$.ajax({
					url: "cerraSolicitud/"+idSolicitud,
					type: "POST",
					success: function (data){
						let obj = $.parseJSON(data);
						$.each(obj, function (i,key) {
							mensaje = key["mensaje"];
							icon = key["icon"];
						});

						Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false
						}).then((result) => {
							cargarSolicP();
						});
					}
				});
			}
		});
	}

	function anularSolicitud(idSolicitud,cons,bandera) {
		let texto = '' ,sms = '';
		if(bandera == "true"){
			texto = `<p>Este proceso es irreversible.</p>
					 <p>Esta Solicitud ya tiene ordenes vinculadas que también serán dadas de baja</p>
					 <p>¿Deseas anular esta solicitud?</p>`;
					 sms = 'Todas la ordenes relacionadas a esta solicitud han sido dados de baja';
		}else{
			texto = `<p>Este proceso es irreversible.</p>
					<p>¿Deseas anular esta solicitud?</p>`;
					sms = '';
		}
		Swal.fire({
			title: `Solicitud n° ${cons}`,
			html: texto,
			icon: 'question',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Anular Solicitud",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {
				$("#loading").modal("show");
				let mensaje = "", icon = "", correo = '';
				let form_data = {
					idsolicitud: idSolicitud,
					orden: bandera
				};
				$.ajax({
					url: "bajaSolicitud",
					type: "POST",
					data: form_data,
					success: function (data){
						$("#loading").modal("hide");
						let obj = $.parseJSON(data);
						$.each(obj, function (i,key) {
							mensaje = key["mensaje"];
							icon = key["tipo"];
							correo = key["correo"];
						});

						Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false
						}).then((result) => {
							cargarSolicA();
							cargarSolicP();
							sendMail(correo,
										"Solicitud anulada",
										"<?php echo $this->session->userdata("Name") ?> anuló tu solicitud n° "+cons,
										""+sms+"",
										"");
						});
					}
				});
			}
		});
	}

	function jsbajaOrden(idOrden,tipo){
		let texto = '';
		if(tipo == "1"){
			texto = `<p>Este proceso es irreversible. <br>
						Si ya tiene documentos adjuntos estos ya no podrán ser visualizados.</p>
					 <p>¿Deseas anular esta orden de compra?</p>`;
		}else if(tipo == 2){
			texto = `<p>Este proceso es irreversible. <br>
						Si ya tiene documentos adjuntos estos ya no podrán ser visualizados.</p>
					<p>¿Deseas anular esta orden de pago?</p>`;
		}else if(tipo == 3){
			texto = `<p>Este proceso es irreversible. <br>
						Si ya tiene documentos adjuntos estos ya no podrán ser visualizados.</p>
					<p>¿Deseas anular esta caja chica?</p>`;
		}
		Swal.fire({
			html: texto,
			icon: 'question',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Anular Orden",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if(result.isConfirmed){
				$("#loading").modal("show");
				let mensaje = '', icon = '';
				let form_data = {
					idOrden: idOrden,
					tipo: tipo
				};
				console.log(form_data);
				$.ajax({
					url: "bajaOrden",
					type: "POST",
					data: form_data,
					success: function (data) {
						$("#loading").modal("hide");
						let obj = $.parseJSON(data);
						$.each(obj, function (i, key) {
							mensaje = key["mensaje"];
							icon = key["tipo"];
						  });

						  Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false
						}).then((result) => {
							cargarSolicP();
							mostrarOC($("#IdSolic").text());
							mostrarOP($("#IdSolic").text());
							mostrarCH($("#IdSolic").text());
						});
					  }
				});
			}
		});
	}

	function jsbajaOrdenArt(idDetalle,tipo){
		let texto = '';
		if(tipo == "1"){
			texto = `<p>Este proceso es irreversible. <br>
						Al anular este articulo se eliminara de la orden actual y se sumara <br>
						nuevamente a la solicitud de compras o servicio.</p>
					 <p>¿Deseas anular este artículo para esta orden de compra?</p>`;
		}else{
			texto = `<p>Este proceso es irreversible. <br>
						Al anular este articulo se eliminara de la orden actual y se sumara <br>
						nuevamente a la solicitud de compras o servicio.</p>
					<p>¿Deseas anular este artículo para esta orden de pago?</p>`;
		}
		Swal.fire({
			html: texto,
			icon: 'question',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Anular Articulo",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if(result.isConfirmed){

				$("#loading").modal("show");
				let mensaje = '', icon = '';
				let form_data = {
					idDetalle: idDetalle,
					tipo: tipo
				};
				console.log(form_data);
				$.ajax({
					url: "bajaOrdenArticulos",
					type: "POST",
					data: form_data,
					success: function (data) {
						$("#loading").modal("hide");
						let obj = $.parseJSON(data);
						$.each(obj, function (i, key) {
							mensaje = key["mensaje"];
							icon = key["tipo"];
						  });

						  Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false
						}).then((result) => {
							cargarSolicP();
							mostrarOC($("#IdSolic").text());
							mostrarOP($("#IdSolic").text());
							mostrarCH($("#IdSolic").text());
						});
					  }
				});
			}
		});
	}


	function modalRechazo(idSolicitud, cons, solicitante,idsolicitante) {
		$("#idSolicitudComent").val(idSolicitud);
		$("#idUsuarioSolicitud").val(idsolicitante);
		$("#UsuarioSolicitud").val(solicitante);
		$("#consSolRechaza").text(cons);
		$("#ComentRechaza").val(`Estimad@ ${solicitante} `);
		//$("#ComentRechaza").prop("focus", true)
		$("#ComentRechaza").removeClass("is-invalid");
		$("#modalRechazo").modal("show");
	  }

	$("#btnSaveComentario").on("click", function () {
		$("#loading").modal("show");
		$("#ComentRechaza").removeClass("is-invalid");
		if($("#ComentRechaza").val() == ""){
			$("#ComentRechaza").addClass("is-invalid");
			$("#loading").modal("hide");
            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Debe ingresar un comentario",
                confirmButtonText: "cerrar",
                customClass: {
                            confirmButton: "btn btn-primary"
                        }
            });
		}else{
			let form_data = {
				idSolicitud: $("#idSolicitudComent").val(),
				consecutivo: $("#consSolRechaza").text(),
				comentarioRechazo: $("#ComentRechaza").val(),
				idSolicitante: $("#idUsuarioSolicitud").val(),
				solicitante: $("#UsuarioSolicitud").val()
			};
			console.log(form_data);
			let mensaje = '', icon = '', correo = '';
			$.ajax({
				url: "guardarSolRechazada",
				type: "POST",
				data: form_data,
				success: function (data) {
					$("#loading").modal("hide");
					let obj = $.parseJSON(data);
					$.each(obj, function (i, key) {
						mensaje = key["mensaje"];
						icon = key["tipo"];
						correo = key["correo"];
					  });

					  Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false
						}).then((result) => {
							let nota = `<i style="color:#ee4c50;">Nota: Debes corregir los datos de esta solicitud para que ésta pueda ser atendida por el personal de compras</i>`;
							sendMail(correo,
										"Solicitud rechazada",
										"<?php echo $this->session->userdata("Name") ?> rechazó tu solicitud n° "+$("#consSolRechaza").text(),
										""+$("#ComentRechaza").val()+"",
										nota);
						});
				  }
			});
		}
	  });

	  function sendMail(mailcompras1,message1,message2,message3,message4){
		$("#loading").modal("show");
		let form_data = {
				from: mailcompras1,
				message: `
				<ul style="padding: 15px;">
				<li style="padding-bottom: 10px;">${message1}</li>
				<li style="padding-bottom: 10px;">${message2}</li>
				<li style="padding-bottom: 10px;">${message3}</li>
				</ul>
				<p style="style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
					${message4}
				</p>
				`
			};
	    console.log(form_data);
		$.ajax({
			url: "<?php echo base_url("index.php/sendMail") ?>",
			type: "POST",
			data: form_data,
			success: function(){
				$("#loading").modal("show");
				console.log("enviado");
				Swal.fire({
					text: "Notificación enviada con éxito",
					icon: "success",
					customClass: {
						confirmButton: "btn btn-primary"
					},
					confirmButtonText: "Cerrar",
					allowOutsideClick: false
				}).then((result)=>{
					cargarSolicA();
					$("#modalRechazo").modal("hide");
					$("#loading").modal("hide");
				});
			}
		});
}

$("#btnRptOrdenes").click(function(){
	/*$("#fechaInicioSearch,#fechaFinalSearch").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        "autoApply": true,
        maxYear: parseInt(moment().format("YYYY"),10),
        	"locale":{
        	"applyLabel": "Aplicar",
        	"cancelLabel": "Cancelar",
		format: "yyyy-MM-DD"
        }
    });*/
	$("#listProvSearch").select2({
			placeholder: '--- Seleccione un Proveedor ---',
			allowClear: true,
                ajax: {
                    url: '<?php echo base_url("index.php/mostrarProveedoresSAP") ?>',
                    dataType: 'json',
                    type: "POST",
                    quietMillis: 100,
                    data: function (params) {
                        let queryParameters = {
                            q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        let res = [];
                        for(let i  = 0 ; i < data.length; i++) {
                            res.push({id:data[i].CardCode, text:data[i].CardName});
                        }
                        return {
                            results: res
                        }
                    },
                    cache: true
                }
        }
       ).trigger('change.select2');
	$("#modalRptOrndenes").modal("show");
});

$("#btnFiltrarSearch").click(function() {
	let fechaInicioSearch = new Date($("#fechaInicioSearch").val()),
	fechaFinalSearch = new Date($("#fechaFinalSearch").val());

	if ($("#fechaInicioSearch").val() == "" || $("#fechaFinalSearch").val() == "") {
			Swal.fire({
				text: "Rangos de fecha obligatorio.",
				icon: "error",
				customClass: {
					confirmButton: "btn btn-danger"
				},
				confirmButtonText: "Cerrar",
				allowOutsideClick: false
			});
	}else{
		if(fechaInicioSearch > fechaFinalSearch){
			Swal.fire({
				text: "La fecha inicial no puede ser mayor que la fecha final.",
				icon: "error",
				customClass: {
					confirmButton: "btn btn-danger"
				},
				confirmButtonText: "Cerrar",
				allowOutsideClick: false
			});
		}else{
			let form_data = {
				cons: $("#consOrdenSearch").val(),
				fechaInicio: $("#fechaInicioSearch").val(),
				fechaFinal: $("#fechaFinalSearch").val(),
				proveedor: $("#listProvSearch option:selected").val()
			};


		let table = $("#tblSearchOrdenes").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
            scrollX: false,
			destroy: true,
			"ajax": {
				"url": "rptOrdenesHistorial",
				"type": "POST",
                "data": form_data
			},
			columns: [
	            {data: "Consecutivo"},
	            {data: "ConsecutivoOrden"},
	            {data: "IdProveedor"},
	            {data: "Proveedor"},
	            {data: "Concepto"},
	            {data: "FechaCrea"},
	            {data: "Acciones"}
			],
			//order: [[0,"asc"]],
            rowGroup:{
                dataSrc:"Consecutivo",
                className: "bg-primary"
            },columnDefs: [ {
                targets: [0],
                visible: false
            } ],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			/*"order": [
				[0, "asc"]
			],*/
			"language": {
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
				"lengthMenu": "Mostrar _MENU_  registros en tabla",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"search": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'+
					'<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"></path>'+
					'<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"></path>'+
					'</svg>',
				"loadingRecords": "",
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url() ?>assets/img/loading.gif'></i></div>",
			},
			/*"rowCallback": function( row, data, index ) {
				switch (data.Prioridad){
					case 1:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 2:
						$(row).addClass(""+data.ClassPri+"");
						break;
					case 3:
						$(row).addClass(""+data.ClassPri+"");
						break;
					default:
						$(row).addClass(""+data.ClassPri+"");
						break;
				}
			},*/
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});
	  }
	}
});


</script>
