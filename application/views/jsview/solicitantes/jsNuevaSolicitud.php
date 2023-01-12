<script>
	$(document).ready(function () {
		let contador  = 0;
		$("#multiple").imageuploadify();
		$("#btnAddArt").click(function () {
			let cantidad = 0,
				umedida = "",
				cantaut = 0,
				descArt = "";
			cantidad = $("#cantidad").val();
			umedida = $("#umedida option:selected").val();
			cantaut = $("#cantaut").val();
			descArt = $("#descArt").val();

			if (cantidad == 0 || descArt == "" || umedida == "") {
				Swal.fire({
					text: "Los campos ''Cantidad Solicitada'', ''Descripcion del articulo'' y ''Unidad Medida'' son obligatorios",
					icon: "warning",
					buttonsStyling: false,
					confirmButtonText: "Cerrar",
					allowOutsideClick: false,
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			} else {

				let t = $("#tblArticulos").DataTable({
					"paging": false,
					"order": false,
					"info": false,
					"destroy": true,
					"scrollY": "300px",
					"scrollCollapse": true
				});

				t.row.add([
					Number(cantidad),
					umedida,
					Number(cantaut),
					descArt,
					`<div class="symbol symbol-circle symbol-50px overflow-hidden">
									<div class="symbol-label">
										<img src="${$(".imageuploadify-container img").attr("src")}" alt="Referencia" class="w-100 imgTabla${contador}">
									  </div>
								 </div>`

				]).draw(false);

				$("#cantidad").val("").focus();
				//$("#umedida").val("");
				$("#cantaut").val("");
				$("#descArt").val("");
				$(".imageuploadify-container").remove();
			}
			contador++;
		});
	});

$("body").on("click", "tr", function () {
	$(this).toggleClass("selected");
	if ($(this).hasClass("selected")) {
		$("#btnSaveSolic").hide();
	} else {
		$("#btnSaveSolic").show();
	}
});

$("#btnDelete").click(function () {
	let table = $("#tblArticulos").DataTable();
	table.row(".selected").remove().draw(false);
	$("#btnSaveSolic").show();
});

$("#btnSaveSolic").click(function () {
	let tipo = "",
		prioridad = 0,
		bandera = false,
		tipoText = "",
		save = false,
		array = new Array(),
		i = 0;
	let t = $("#tblArticulos").DataTable({
		"paging": false,
		"order": false,
		"info": false,
		"destroy": true,
		"scrollY": "100px",
		"scrollCollapse": true
	});
	if (!$("#chkCompra").hasClass("active") && !$("#chkServicio").hasClass("active")) {
		bandera = false;
		Swal.fire({
			text: "Debe seleccionar un tipo de solicitud",
			icon: "warning",
			buttonsStyling: false,
			confirmButtonText: "Cerrar",
			allowOutsideClick: false,
			customClass: {
				confirmButton: "btn btn-primary"
			}
		});
	}/*else if(!$("#chkNormal").hasClass("active") && !$("#chkAlta").hasClass("active") && !$("#chkUrgente").hasClass("active")){
		bandera = false;
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
	}*/
	else {
		bandera = true;
	}
	if (bandera) {
		if ($("#descSol").val() == "") {
			bandera = false;
			Swal.fire({
				text: "Debe ingresar una descripcion de la solicitud",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		} else {
			bandera = true;
		}
	}

	if (bandera) {
		if (!t.data().any()) {
			save = false;
			Swal.fire({
				text: "No ha agregado articulos a la solicitud",
				icon: "warning",
				buttonsStyling: false,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		} else {
			save = true;
		}
	}

	if (save) {
		if ($("#chkCompra").hasClass("active")) {
			tipo = "C";
			tipoText = "Compras";
		} else if ($("#chkServicio").hasClass("active")) {
			tipo = "S";
			tipoText = "Servicio";
		}

		if($("#chkNormal").hasClass("active")){
			prioridad = 1;
		}else if($("#chkAlta").hasClass("active")){
			prioridad = 2;
		}else if($("#chkUrgente").hasClass("active")){
			prioridad = 3;
		}

		let mensaje = "",
			icon = "",
			cons = "",
			estado = "",
			correos = "";
			form_data = new Object();
		t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
			array[i] = [];
			array[i][0] = datos[0];
			array[i][1] = datos[1];
			array[i][2] = datos[2];
			array[i][3] = datos[3];
			array[i][4] = $(".imgTabla"+i+"").attr("src");
			i++;
		});

		console.log(array);
		/*if ($("#idjefe").val() != "") {
			estado = "P";
			$("#loading").modal("show");
			Swal.fire({
				text: "Tu jefe tendrá que aprobar tu solicitud de " + tipoText + " para que ésta sea enviada al personal del área de Compras",
				icon: 'info',
				showCancelButton: true,
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger"
				},
				confirmButtonText: "Guardar",
				allowOutsideClick: false
			}).then((result) => {
				if(result.isConfirmed){
					form_data.encabezado = [$("#idjefe").val(), $("#idarea").val(), tipo, $("#fechaSol").val(), $("#descSol").val(),estado,0];
					form_data.detalles = JSON.stringify(array);
					$.ajax({
						url: "<?php echo base_url("index.php/guardarSolic")?>",
						type: "POST",
						data: form_data,
						success: function(data){
							$("#loading").modal("hide");
							let obj = jQuery.parseJSON(data);
							$.each(obj, function(i, key){
								mensaje = key["mensaje"];
								icon = key["tipo"];
								cons = key["cons"];
							});

							Swal.fire({
									text: mensaje,
									icon: icon,
									customClass: {
										confirmButton: "btn btn-primary"
									},
									confirmButtonText: "Cerrar",
									allowOutsideClick: false
								}).then((result) => {
									if(icon != "error"){
										sendMail(["<?php echo $this->session->userdata("CorreoJefe")?>"],
									 "<?php echo $this->session->userdata("Name")?> ha creado una solicitud de "+tipoText+" ",
									 "N° de solicitud "+cons,
									 " "+$("#descSol").val()+" ");
									}
								});
						}
					}); 
				}else{
					$("#loading").modal("hide");
				}
			});
		} else {
			estado = "Y";
			$("#loading").modal("show");
			form_data.encabezado = [0, $("#idarea").val(), tipo, $("#fechaSol").val(), $("#descSol").val(),estado,prioridad];
			form_data.detalles = JSON.stringify(array);
			console.log(form_data);
			$.ajax({
					url: "<?php echo base_url("index.php/guardarSolic")?>",
					type: "POST",
					data: form_data,
					success: function(data){
						$("#loading").modal("hide");
						let obj = jQuery.parseJSON(data);
						$.each(obj, function(i, key){
							mensaje = key["mensaje"];
							icon = key["tipo"];
							cons = key["cons"];
							correos = key["correo"];
						});

						Swal.fire({
								text: mensaje,
								icon: icon,
								customClass: {
									confirmButton: "btn btn-primary"
								},
								confirmButtonText: "Cerrar",
								allowOutsideClick: false
							}).then((result) => {
								if(icon != "error"){
																	
									sendMail(correos,
									 "<?php echo $this->session->userdata("Name")?> ha creado una solicitud de "+tipoText+" ",
									 "N° de solicitud "+cons,
									 " "+$("#descSol").val()+" ");
								}
							});
					}
				});
		}*/
	}
});

function sendMail(mailcompras1,message1,message2,message3){
	$("#loading").modal("show");
	let form_data = {
			from: mailcompras1,
			message: `
			<ul style="padding: 15px;">
              <li style="padding-bottom: 10px;">${message1}</li>
			  <li style="padding-bottom: 10px;">${message2}</li>
              <li style="padding-bottom: 10px;">Descripcion de la solicitud: ${message3}</li>
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
					location.reload();
				});
			}
		});
}
</script>
