<script>
	$(document).ready(function (){
		$('.table').on('show.bs.dropdown', function () {
			$('.table-responsive').css( "overflow", "inherit" );
		});

		$('.table').on('hide.bs.dropdown', function () {
			$('.table-responsive').css( "overflow", "auto" );
		});

		cargarSolicOP();
	});

	$("#updateTabla").click(function (){
		cargarSolicOP();
		cargarSolicOC();
	});

	function cargarSolicOP(){
		let table = $("#file_manager_list").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			ordering: false,
			"ajax": {
				"url": "mostrarOPDoc",
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
				{data: "Consecutivo"},
				{data: "ConsecutivoOP"},
				{data: "Nombre"},
				{data: "Proveedor"},
				{data: "NombreCheque"},
				{data: "Cantidad"},
				{data: "CantidadDesc"},
				{data: "Concepto"},
				{data: "Retiene"},
				{data: "ComentarioRetiene"},
				{data: "FechaCrea"},
				{data: "Opciones"}
			],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "desc"]
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
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url()?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function cargarSolicOC(){
		let table = $("#file_manager_listOC").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			ordering: false,
			"ajax": {
				"url": "mostrarOCDoc",
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
				{data: "Consecutivo"},
				{data: "ConsecutivoOC"},
				{data: "Nombre"},
				{data: "Proveedor"},
				{data: "Direccion"},
				{data: "TiempoEntrega"},
				{data: "FechaCrea"},
				{data: "Opciones"}
			],
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "Todo"]
			],
			"order": [
				[0, "desc"]
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
				"processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url()?>assets/img/loading.gif'></i></div>",
			},
			"dom":
				"<'row'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"

		});

	}

	function modalUpload(idorden,idsolicitud){
		$("#kt_modal_upload").modal("show");
		$("#idorden").val(idorden);
		$("#idsolicitud").val(idsolicitud);
	}

	$('input[type=radio][name=plan]').change(function() {
		switch (parseInt(this.value)) {
			case 1:
				$("#encModal").text("Adjuntar Cuadro Comparativo");
				$("#parametro").val(this.value);
				break;
			case 2:
				$("#encModal").text("Adjuntar cotizaciones");
				$("#parametro").val(this.value);
				break;
			case 3:
				$("#encModal").text("Adjuntar cedula");
				$("#parametro").val(this.value);
				break;
			case 4:
				$("#encModal").text("Adjuntar constancias");
				$("#parametro").val(this.value);
				break;
			case 5:
				$("#encModal").text("Adjuntar n° cuentas");
				$("#parametro").val(this.value);
				break;
		}
	});

	function loadFile(event){
		let output = document.getElementById('image');
		let file = document.getElementById('new_image');
		let ext = $("#new_image").val().split('.').pop();
		if(ext == "pdf"){
			$("#image").attr("src",'<?php echo base_url()?>assets/media/svg/files/pdf.svg');
		}else if(ext == "xls" || ext == "xlsx"){
			$("#image").attr("src",'<?php echo base_url()?>assets/media/svg/files/xlsx.png');
		}else{
			output.src = URL.createObjectURL(event.target.files[0]);
		}
		let size = parseFloat(file.files[0].size/1024).toFixed(2);
		$("#sizeFile").text("tamaño del archivo "+size+" KB");
	}

	$("#uploadFile").submit(function (event){
		let mensaje = "" ,tipo = "", percentText = "";
		let foto = $("#new_image").val();
		let parametro = $("#parametro").val(), url = "";
		switch (parseInt(parametro)) {
			case 1:
				url = "guarda cuadro";
				break;
			case 2:
				url = "guarda cotizacion";
				break;
			case 3:
				url = "guarda cedula";
				break;
			case 4:
				url = "guarda constancias";
				break;
			case 5:
				url = "guarda n° cuentas";
				break;
		}

		if(foto){
			event.preventDefault();
			$(this).ajaxSubmit({
				url: "subirDocumentos",
				beforeSubmit: function (){
					$(".progress-bar").css("width", "0%")
				},
				uploadProgress: function (event, posicion, total, porcentajeCompleto){
					let percentValor = porcentajeCompleto;
					$(".progress-bar").animate({
						width: ''+percentValor+'%'
					 }, {
							duration: 1500,
							step: function (x){
								percentText = Math.round(x * 100 / porcentajeCompleto);
								$("#progressText").text(percentText+"%");
								$(".progress-bar").css("width",percentText+"%");
							}
						}
					);
				},
				success: function (data){
					//console.log(url);
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {
						mensaje = key["mensaje"];
						tipo = key["tipo"];
					});

					Swal.fire({
						text: mensaje,
						icon: tipo,
						allowOutsideClick: false
					}).then((result) => {
						$("#kt_modal_upload").modal("hide");
						cargarSolicOP();
					});
				}
			});

		}else{
			event.preventDefault();
			Swal.fire({
				text: "Debe seleccionar un archivo",
				icon: "info",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		}
	});

	function detallesDoc(idOrdem,consOrden) {
		$("#detIdOrden").val(idOrdem)
		$("#detEnc").text("Documentos Adjuntos Orden #"+consOrden);
		$("#kt_modal_details").modal("show");
	}
/***************************************************************************/
	$("#chkDetCuadro").on("change", function (){
		$("#contenedorDetCuadro").html("");
		if($(this).prop("checked") == true){

			$.ajax({
				url: "getDocCuadros/"+$("#detIdOrden").val()+"/"+$(this).val(),
				type: "POST",
				async: true,
				success: function (data){
					if(data != ""){
						let obj = $.parseJSON(data);
						$.each(obj, function (i, key){
							$("#contenedorDetCuadro").append('<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">'+
								'<div class="d-flex align-items-center">'+
								'<div class="symbol symbol-35px symbol-circle">'+
								'<span class="symbol-label bg-light-'+key["clase"]+' text-'+key["clase"]+' fw-bold">'+
								'<i class="fas fa-file-'+key["extension"]+' text-'+key["clase"]+'"></i>'+
								'</span>'+
								'</div>'+
								'<div class="ms-6">'+
								'<a href="#" onclick="window.open('+"'"+key["documentoruta"]+"'"+')" class="d-flex align-items-center fs-7 fw-bolder text-dark text-hover-primary">'+key["documento"]+'' +
								''+key["estado"]+'</a>'+
								'<div class="fw-bold text-muted fs-7">'+key["fecha"]+'</div>'+
								'</div>'+
								'</div>'+
								'<div class="d-flex">'+
								'<div class="text-end">'+
								'<!--<div class="fs-5 fw-bolder text-dark">$23,000</div>-->'+
								''+key["opcion"]+''+
								'</div>'+
								'</div>'+
								'</div>');
						});
					}
				}
			});
		}else{
			$("#contenedorDetCuadro").html("");
		}
	});

	function bajaCuadros(idDoc){
		Swal.fire({
			text: "Este proceso es irreversible. ¿Estas seguro que deseas dar de baja este documento?",
			icon: 'question',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Dar de baja",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {
				let mensaje = '', tipo = '';
				let form_data = {
					idDoc: idDoc
				};

				$.ajax({
					url: "bajaCuadro",
					type: "POST",
					data: form_data,
					success: function(data){
						let obj = jQuery.parseJSON(data);
						$.each(obj, function(i, key){
							mensaje = key["mensaje"];
							tipo = key["tipo"];
						});

						Swal.fire({
							text: mensaje,
							icon: tipo,
							allowOutsideClick: false,
							customClass: {
								confirmButton: "btn btn-primary"
							}
						}).then((result) => {
							$("#chkDetCuadro").trigger("change");
						});
					}
				});
			}
		});
	}
	/**********************************************************************/

	$("#chkCot").on("change",function (){
		getDocumentos($(".classCot").attr("id"),$("#detIdOrden").val(),$(this).val(),$(this).attr("id"));
	});

	$("#chkCed").on("change",function (){
		getDocumentos($(".classCed").attr("id"),$("#detIdOrden").val(),$(this).val(),$(this).attr("id"));
	});

	$("#chkConst").on("change",function (){
		getDocumentos($(".classConst").attr("id"),$("#detIdOrden").val(),$(this).val(),$(this).attr("id"));
	});

	$("#chkCuent").on("change",function (){
		getDocumentos($(".classCuent").attr("id"),$("#detIdOrden").val(),$(this).val(),$(this).attr("id"));
	});

	function getDocumentos(idContenedor,idOrden,valroCheck,idCheck){
		debugger;
		$("#"+idContenedor).html("");
		if($("#"+idCheck).prop("checked") == true){

			$.ajax({
				url: "getDocumentos/"+idOrden+"/"+valroCheck,
				type: "POST",
				async: true,
				success: function (data){
					if(data != ""){
						let obj = $.parseJSON(data);
						$.each(obj, function (i, key){
							$("#"+idContenedor).append('<div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">'+
								'<div class="d-flex align-items-center">'+
								'<div class="symbol symbol-35px symbol-circle">'+
								'<span class="symbol-label bg-light-'+key["clase"]+' text-'+key["clase"]+' fw-bold">'+
								'<i class="fas fa-file-'+key["extension"]+' text-'+key["clase"]+'"></i>'+
								'</span>'+
								'</div>'+
								'<div class="ms-6">'+
								'<a onclick="modalPDF('+"'"+key["documentoruta"]+"'"+')" href="javascript:void(0)" class="d-flex align-items-center fs-7 fw-bolder text-dark text-hover-primary">'+key["documento"]+'' +
								'</a>'+
								'<div class="fw-bold text-muted fs-7">'+key["fecha"]+'</div>'+
								'</div>'+
								'</div>'+
								'<div class="d-flex">'+
								'<div class="text-end">'+
								'<!--<div class="fs-5 fw-bolder text-dark">$23,000</div>-->'+
								''+key["opcion"]+''+
								'</div>'+
								'</div>'+
								'</div>');
						});
					}
				}
			});
		}else{
			$("#"+idContenedor).html("");
		}
	}

	function eliminarDoc(idDoc,tipo,documento) {
		Swal.fire({
			text: "Este proceso es irreversible. ¿Estas seguro que deseas eliminar este documento?",
			icon: 'warning',
			showCancelButton: true,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Dar de baja",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {
				let mensaje = '', icon = '';
				let form_data = {
					idDoc: idDoc,
					tipo: tipo ,
					documento: documento
				};
				console.log(form_data);
				$.ajax({
					url: "elmiminarDoc",
					type: "POST",
					data: form_data,
					success: function(data){
						let obj = jQuery.parseJSON(data);
						$.each(obj, function(i, key){
							mensaje = key["mensaje"];
							icon = key["tipo"];
						});

						Swal.fire({
							text: mensaje,
							icon: icon,
							allowOutsideClick: false,
							customClass: {
								confirmButton: "btn btn-primary"
							}
						}).then((result) => {
							$("#chkCot").trigger("change");
							$("#chkCed").trigger("change");
							$("#chkConst").trigger("change");
							$("#chkCuent").trigger("change");
						});
					}
				});
			}
		});
	}

	function modalPDF(documento){
		$("#canvasFile").prop("src", documento);
		$("#kt_modal_pdfshow").modal("show");
	}

	$("#senMail").on("click", function (){
		let form_data = {
			from: "sistemas@delmor.com.ni",
			message: `
			<ul style="padding: 15px;">
              <li style="padding-bottom: 10px;">La solicitud N° IT-25032022-15 fue anulada por Alejandro Areas</li>
              <li style="padding-bottom: 10px;">Descripcion de la solicitud: Compras de escritorios para area de ventas</li>
            </ul>
			<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
			   <a href="<?= base_url("index.php/Compras")?>" style="color:#ee4c50;text-decoration:underline;">
				   Ingrese aqui para ver
			   </a>
			</p>
			`
		};
		$.ajax({
			url: "<?php echo base_url("index.php/sendMail")?>",
			type: "POST",
			data: form_data,
			success: function(){
				console.log("enviado");
			}
		});
	});
</script>
