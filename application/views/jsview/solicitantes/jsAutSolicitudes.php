<script>
    $(document).ready(function(){
        cargarSolic();
    });

    function cargarSolic(){
		let table = $("#tblSolicitudes").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "getSolicitudesAutAjax",
			"type": "POST"
		},
        columns: [
                { data: "Consecutivo"},
                { data: "FechaSolicitud"},
                { data: "DescripcionSolicitud"},
                { data: "FechaCrea"},
                { data: "estadoAct"},
                { data: "estadoAut"},
                { data: "Opciones"}
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

    function detalles(idsolicitud,consecutivo){
        $("#modalTitle").text("Detalle de solicitud");
        $("#detConsec").text(" n° "+consecutivo+" ");
        $("#tblAutSolicitudes").DataTable().destroy();
        $("#tblAutSolicitudes").hide();
        $("#tblDetSolicitudes").show();
        $("#modalSolicitud").modal("show")
        $("#botones").hide();
        let table = $("#tblDetSolicitudes").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: false,
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

    function autorizar(idsolicitud,consecutivo,correo){
        $("#modalTitle").text("Solicitud");
        $("#detConsec").text(" n° "+consecutivo+" ");
        $("#modalSolicitud").modal("show");
		$("#mail").val(correo);
        $("#tblAutSolicitudes").show();
        $("#tblDetSolicitudes").DataTable().destroy();
        $("#tblDetSolicitudes").hide();
        $("#chkAll").prop("checked",false);
        $(".check").prop("checked",false);
		$("#idSolicitudDenegar").val(idsolicitud);
        $("#botones").show();
        //(".badge-valida").hide();
        let table = $("#tblAutSolicitudes").DataTable({
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        "paging": false,
        "order": false,
        "info": false,
        "ordering": false,
		"ajax": {
			"url": "getSolicitudesAutDetAjax"+"/"+idsolicitud,
			"type": "POST"
		},
        columns: [
                { data: "CantidadSolicitud"},
                { data: "UnidadMedida"},
                { data: "CantidadAut"},
                { data: "DescripcionArticulo"},
                { data: "estadoAut"},
                { data: "Acciones"}
            ]
		});
    }

    $("#chkAll").on("change", function(){
        let t = $("#tblAutSolicitudes").DataTable();
        let cantSolic = 0;
        t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
            if($("#chkAll").prop("checked") == true){
                $("#badge"+datos.IdDetallesSolicitud).hide();
                $("#chk"+datos.IdDetallesSolicitud).prop("checked",true);
                cantSolic = $("#cantSolic"+datos.IdDetallesSolicitud).val();
                $("#cantAut"+datos.IdDetallesSolicitud).val(cantSolic);
            }else{
                $("#chk"+datos.IdDetallesSolicitud).prop("checked",false);
                $("#cantAut"+datos.IdDetallesSolicitud).val(null);
            }
		});
    });

    $("#tblAutSolicitudes tbody").on("click", ".check", function(){
        let table = $('#tblAutSolicitudes').DataTable(),
         checkeado = 0,
         valor = 0,
         campo = 0;

        valor = table.row( this.closest('tr') ).data().IdDetallesSolicitud;

        $("#chk"+valor).on("change", function(){
            checkeado = $(".check:checked").length;

            if(this.checked==true){
                campo = $("#cantSolic"+valor).val();
                $("#cantAut"+valor).val(campo);
                
            }else{
                $("#cantAut"+valor).val(null);
                if(checkeado == 0){
                    $("#chkAll").prop("checked",false);
                    $("#chkAll").on("change", function(){
                        if(this.checked==false){
                            $("#cantAut"+valor).val(null);
                        }
                    });
                }
            }
        });
    });

    function cantAutInput(IdDetallesSolicitud){
        if(Number($("#cantSolic"+IdDetallesSolicitud).val()) < Number($("#cantAut"+IdDetallesSolicitud).val())){
            $("#badge"+IdDetallesSolicitud).show();
            $("#chk"+IdDetallesSolicitud).prop("checked",false);
        }else if(Number($("#cantAut"+IdDetallesSolicitud).val()) == null || Number($("#cantAut"+IdDetallesSolicitud).val()) == 0){
            $("#badge"+IdDetallesSolicitud).hide();
            $("#chk"+IdDetallesSolicitud).prop("checked",false);
        }else{
            $("#badge"+IdDetallesSolicitud).hide();
            $("#chk"+IdDetallesSolicitud).prop("checked",true);
        }
    }

    $("#btnAutorizarSolic").on("click", function(){
        let checkeado = $(".check:checked").length;
		let array = new Array(),
		mensaje = "",
		icon = "",
		correo = new Array(),
		form_data = {},
		i = 0;
		if(!$("#chkNormal").hasClass("active") && !$("#chkAlta").hasClass("active") && !$("#chkUrgente").hasClass("active")){
			Swal.fire({
				text: "Debe seleccionar un nivel de prioridad",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		}else{
			if(checkeado >= 1){ //deberia ser 1 pero no deja rechazar xq debe haber un check
				$("#loading").modal("hide");
				Swal.fire({
					html: "<p>¿Esta segur@ que desea autorizar los artículos seleccionados?.</p>"+
						"<span class=''>Los articulos que deje si seleccionar o en 0 no serán tomados"+
						" en cuenta y se guardarán como rechazados</span>",
					icon: 'warning',
					showCancelButton: true,
					customClass: {
						confirmButton: "btn btn-primary",
						cancelButton: "btn btn-danger"
					},
					confirmButtonText: "Proceder",
					allowOutsideClick: false
				}).then((result) => {
					if (result.isConfirmed) {
						let estado = '';
						let prioridad = "";
						let prioridadtxt = "";
						$("#loading").modal("show");

						if($("#chkNormal").hasClass("active")){
							prioridad = 1;
						}else if($("#chkAlta").hasClass("active")){
							prioridad = 2;
						}else if($("#chkUrgente").hasClass("active")){
							prioridad = 3;
						}

						let t = $("#tblAutSolicitudes").DataTable();

						t.rows().eq(0).each(function (index) {
							let row = t.row(index);
							let datos = row.data();
							if($("#chk"+datos.IdDetallesSolicitud).prop("checked") == true){
								estado = "Y";
							}else{
								estado = "I";
							}

							array[i] = [];
							array[i][0] = datos.IdSolicitud;
							array[i][1] = datos.IdDetallesSolicitud;
							array[i][2] = $("#cantAut"+datos.IdDetallesSolicitud).val();
							array[i][3] = estado;
							i++;
						});

						form_data.datos = JSON.stringify(array);
						form_data.prioridad = prioridad;
						console.log(form_data);
						$.ajax({
							url: "autorizarSolicitud",
							type: "POST",
							data: form_data,
							success: function(data){
								$("#loading").modal("hide");
								let obj = jQuery.parseJSON(data);
								$.each(obj, function(i,key){
									mensaje = key["mensaje"];
									icon = key["tipo"];
									correo = key["correo"];  
								});

								Swal.fire({
									text: mensaje,
									icon: icon,
									buttonsStyling: false,
									confirmButtonText: "Cerrar",
									allowOutsideClick: false,
									customClass: {
										confirmButton: "btn btn-primary"
									}
								}).then((result)=>{
									$("#modalSolicitud").modal("hide");
									if(icon != "error"){
										//"logistica@delmor.com.ni","asistentecompras@delmor.com.ni","
										switch (prioridad) {
											case 1:
												prioridadtxt = "Normal";
												break;
											case 2:
												prioridadtxt = "Alta";
												break;
											case 3:
												prioridadtxt = "Urgente";
												break;
										}
										let concat = correo.concat($("#mail").val());
										sendMail(concat,
										"Solicitud aprobada",
										"<?php echo $this->session->userdata("Name")?> ha autorizado la solicitud "+$("#detConsec").text(),
										"Prioridad de la solicitud: "+ prioridadtxt);
									}								
								});
							}
						});

					}else{
						$("#loading").modal("hide");
					}
				});
			}else{
				Swal.fire({
					text: "No se ha seleccionado ningún artículo.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Cerrar",
					allowOutsideClick: false,
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			}
		}
    });

	$("#btnRechazarSolic").click(function () {
		let mensaje = "", icon = "", correo='',correo1='';
		Swal.fire({
			html: `<p>¿Esta segur@ que desea rechazar esta solicitud?.
					Esta operación no se puede revertir.</p>`,
			icon: 'warning',
			showCancelButton: true,
			buttonsStyling: false,
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger"
			},
			confirmButtonText: "Rechazar solicitud",
			cancelButtonText: "Cancelar",
			allowOutsideClick: false	
		}).then((result => {
			if (result.isConfirmed) {
				$("#loading").modal("show");
				$.ajax({
					url: "denegarSolicitud/"+$("#idSolicitudDenegar").val(),
					type: "POST",
					success: function(data){
						$("#loading").modal("hide");
						let obj = jQuery.parseJSON(data);
						$.each(obj, function(i,key){
							mensaje = key["mensaje"];
							icon = key["tipo"];
							correo = key["correo"];  
							correo1 = key["correoC"];
						});
						Swal.fire({
							text: mensaje,
							icon: icon,
							buttonsStyling: false,
							confirmButtonText: "Cerrar",
							allowOutsideClick: false,
							customClass: {
								confirmButton: "btn btn-primary"
							}
						}).then((result)=>{
							$("#modalSolicitud").modal("hide");
							if(icon != "error"){
								//"logistica@delmor.com.ni","asistentecompras@delmor.com.ni","
								/*switch (prioridad) {
									case 1:
										prioridadtxt = "Normal";
										break;
									case 2:
										prioridadtxt = "Alta";
										break;
									case 3:
										prioridadtxt = "Urgente";
										break;
								}*/
								let concat = correo.concat(correo1);
								sendMail(concat,
								"Solicitud denegada",
								"<?php echo $this->session->userdata("Name")?> ha denegado la solicitud "+$("#detConsec").text(),
								"Esta solicitud fué denegada, por lo tanto queda anulada automáticamente.");
							}
							cargarSolic();								
						});
					}
				});
			}
		}));
	});

	/*function bajaSolic(idSolicitud,idUsuarioSolicita,comentarioSolic,anula){
		let mensaje = "", icon = "";
		let form_data = {
			idSolicitud: idSolicitud,
			idUsuarioSolicita: idUsuarioSolicita,
			comentarioSolic: comentarioSolic,
			anula: anula
		};


		$.ajax({
			url: "bajaSolicitud",
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
					buttonsStyling: false,
					confirmButtonText: "Cerrar",
					allowOutsideClick: false,
					customClass: {
						confirmButton: "btn btn-primary"
					}
				}).then((result)=>{
					cargarSolic();
				});
			}
		});
	}

	function baja(idSolicitud,estado,estadoau){
		if(estado == "A" && estadoau == "Y"){
			Swal.fire({
				text: "¿Esta solicitud ya esta autorizada. Si procede con la"+ 
                "anulacion se enviara una solictud a su jefe para autorizar la anulacion",
				icon: 'warning',
				showCancelButton: true,
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger"
				},
				confirmButtonText: "Proceder",
				allowOutsideClick: false
			}).then((result) => {
				if (result.isConfirmed) {
					bajaSolic(idSolicitud,"","",true);
				}
			});
		}else{
			Swal.fire({
				text: "¿Estas seguro que deseas dar de baja esta solicitud? ",
				icon: 'warning',
				showCancelButton: true,
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger"
				},
				confirmButtonText: "Proceder",
				allowOutsideClick: false
			}).then((result) => {
				if (result.isConfirmed) {
					bajaSolic(idSolicitud,"","",false);
				}
			});
			
		}
		//bajaSolicitud
	}*/


	function sendMail(mailcompras1,message1,message2,message3){
	$("#loading").modal("show");
	let form_data = {
			from: mailcompras1,
			message: `
			<ul style="padding: 15px;">
              <li style="padding-bottom: 10px;">${message1}</li>
			  <li style="padding-bottom: 10px;">${message2}</li>
              <li style="padding-bottom: 10px;">${message3}</li>
            </ul>
			<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
			   <a href="192.168.1.203:8080/index.php/Compras" style="color:#ee4c50;text-decoration:underline;">
				   Ingrese aqui para ver
			   </a>
			</p>
			`
		};
		console.log(form_data);
		$.ajax({
			url: "<?php echo base_url("index.php/sendMail")?>",
			type: "POST",
			data: form_data,
			success: function(){
				$("#loading").modal("show");
				console.log(form_data);
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
					cargarSolic();
					$("#loading").modal("hide");
				});
			}
		});
}
</script>
