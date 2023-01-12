<script>

    $(document).ready(function () {
        cargarSolicR();
      });

function cargarSolicR(){
		let table = $("#tblSolicitudes").DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
		"ajax": {
			"url": "compras_autorizadas/"+"R"+"/null",
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
                { data: "Opciones"}
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
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url()?>assets/img/loading.gif'></i></div>",
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
			}
			,
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
			    "processing": "<div class='text-center'>Procesando datos  <i><img width='30px' src='<?php echo base_url()?>assets/img/loading.gif'></i></div>",
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
				comentarioConfirma: $("#ComentRechaza").val()
			};
			console.log(form_data);
			let mensaje = '', icon = '', correo = '';
			$.ajax({
				url: "SolicConfirmar",
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
							if(icon != "error"){
								let nota = ``;
							sendMail(correo,
										"Solicitud confirmada",
										"<?php echo $this->session->userdata("Name")?> corrigió y confirmó la solicitud n° "+$("#consSolRechaza").text(),
										""+$("#ComentRechaza").val()+"",
										nota);
							}
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
				<p style="style="color:#ee4c50;margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
					${message4}
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
					cargarSolicR();
					$("#modalRechazo").modal("hide");
					$("#loading").modal("hide");
				});
			}
		});
}

</script>