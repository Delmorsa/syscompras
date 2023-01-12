<script>
    $(document).ready(function(){
        cargarSolicAnula();
    });

    function cargarSolicAnula(){
		let table = $("#tblSolicitudesAnula").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "cargarSolicAnula",
			"type": "POST"
		},
        columns: [
                { data: "Consecutivo"},
                { data: "FechaSolicitud"},
                { data: "DescripcionSolicitud"},
                { data: "Nombre"},
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
        $("#modalSolicitud").modal("show");
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

    function anular(idsolicitud,cons){
        Swal.fire({
				text: "¿Esta segur@ que desea proceder con esta anulación",
				icon: 'warning',
				showCancelButton: true,
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger"
				},
				confirmButtonText: "Proceder",
				allowOutsideClick: false
			}).then((resulta) => {
				if (resulta.isConfirmed) {
					Swal.fire({
						html: '<div class="d-flex flex-column mb-7 fv-row">'+
														'<label for="descSol" class="form-label required">Comentario anulación</label>'+
														'<div class="input-group">'+
                                                            
                                                            '<textarea required id="comentarioSolicAnul" class="form-control" aria-label="With textarea" style="height: 97px;"></textarea>'+
                                                        '</div>'+
													'</div>',
						allowOutsideClick: false,
						showCancelButton: true,
						customClass: {
						confirmButton: "btn btn-primary",
						cancelButton: "btn btn-danger"
					},
					confirmButtonText: "Anular",
					cancelButtonText: "Cancelar",
					}).then((result) =>{
						if(result.isConfirmed){
                            $("#loading").modal("show")

							if($("#comentarioSolicAnul").val() != ""){
                                let mensaje = '', icon = '', correo='',correo1='', 
                                form_data = {
                                    idSolicitud: idsolicitud,
                                    comentarioAnula: $("#comentarioSolicAnul").val()
                                };

								$.ajax({
                                    url: "anularSolicitud",
                                    type: "POST",
                                    data: form_data,
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
											let concat = correo.concat(correo1);
											sendMail(concat,
										"Solicitud anulada",
										"<?php echo $this->session->userdata("Name")?> anuló la solicitud n° "+cons,
										"Se anuló esta solicitud a petición del usuario");
										});
                                    }
                                });

							}else{
                                $("#loading").modal("hide");
								Swal.fire({
									text: "debe introducir un comentario",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Cerrar",
									allowOutsideClick: false,
									customClass: {
										confirmButton: "btn btn-primary"
									}
								});
							}
						}else{
							$("#loading").modal("hide");
						}
					});
				}
			});
    }

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
				<p style="style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
				</p>
				`
			};
	  console.log(form_data);
		$.ajax({
			url: "<?php echo base_url("index.php/sendMail")?>",
			type: "POST",
			data: form_data,
			success: function(){
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
</script>