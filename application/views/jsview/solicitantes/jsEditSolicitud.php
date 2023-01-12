<script>
$(document).ready(function () {
    showSolicitudData();
    $.fileup({
            url: 'example.com/your/path?file_upload=1',
            inputID: 'fileUpload',
            queueID: 'upload-1-queue',
            onSuccess: function(response, file_number, file) {
                $.growl.notice({ title: "Upload success!", message: file.name });
            },
            onError: function(event, file, file_number) {
                $.growl.error({ message: "Upload error!" });
            }
        });
  });

  function showSolicitudData(){
      $("#loading").modal("show");
	  let tipo = '';
      $.ajax({
          url: "<?php echo base_url("index.php/editSolicitudAjax/".$this->uri->segment(2)."")?>",
          type: "POST",
          async: false,
          success: function (data) { 
                $("#loading").modal("hide");
                let obj = $.parseJSON(data);
                //console.log(obj.det);
                $.each(obj.enc, function (i, key) {
                    if(key.TipoSolicitud == "C"){
                        $("#chkCompra").prop("checked", true);
                        $("#chkCompra").addClass("active");
                    }else{
                        $("#chkServicio").prop("checked", true);
                        $("#chkServicio").addClass("active");
                    }
                    $("#idSolicitud").val(key.IdSolicitud);
                    $("#cons").val(key.Consecutivo);
                    $("#fechaSol").val(key.FechaSolicitud);
                    $("#descSol").val(key.DescripcionSolicitud);
					tipo = key.Prioridad;
                  });

				  switch (tipo) {
					  case 1:
						   $("#chkNormal").prop("checked", true);
						   $("#chkNormal").addClass("active");
						  break;
					  case 2:
						   $("#chkAlta").prop("checked", true);
						   $("#chkAlta").addClass("active");
						  break;
					  case 3:
						   $("#chkUrgente").prop("checked", true);
						   $("#chkUrgente").addClass("active");
						  break;
					  default:
						  break;
					}

                $.each(obj.det, function (i, key) {
                    $("#tblArticulos tbody").append(`
                        <tr>
                            <td>${key.CantidadSolicitud}</td>
                            <td>${key.UnidadMedida}</td>
                            <td>${key.CantidadAut}</td>
                            <td>${key.DescripcionArticulo}</td>
                        </tr>
                    `);
                  });  
               $("#tblArticulos").DataTable({
                   "info": false,
                   "order": false,
                   "filter": false,
                   "paging": false,
                   "destroy": true
               });   
           }
      });
  }

  $("#fileUpload").change(function(e){
    $("#loading").modal("show");
	let table = $("#tblArticulos").DataTable();
	table.destroy();
	if($(this).val() != ""){
	let reader = new FileReader();
	reader.readAsArrayBuffer(e.target.files[0]);
	reader.onload = function(e){
		let data = new Uint8Array(reader.result);
		let wb = XLSX.read(data, {type:'array'});
		let htmlstr = "<td>"+XLSX.write(wb,{sheet:"", type:'binary',bookType:'html'})+"</td>";
		$("#wrapper table tbody")[0].innerHTML += htmlstr;

		let cuerpo = $("#wrapper>table>tbody>tr>td>table>tbody").html();
		$("#wrapper").html("");
        $("#wrapper").append(` <table id="tblArticulos" class="table table-striped table-row-bordered table-responsive gy-5 gs-7" style="width:100%;">
                                                                <thead class="bg-primary">
                                                                    <tr class="fw-bold fs-6 text-white">
                                                                        <th>Cantidad Solicitada</th>
                                                                        <th>Unidad Medida</th>
                                                                        <th>Cantidad Autorizada</th>
                                                                        <th>Descripcion</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    ${cuerpo}
                                                                </tbody>
                                                            </table>`);
		$("#tblArticulos").DataTable({
				"autoWidth": false,
				"info": false,
				"sort": false,
				"processing": true,
				"destroy":true,
				"paging": false,
				"ordering": false,
				"searching":false,
				"order": [
					[0, "asc"]
				],
				/*"dom": 'T<"clear">lfrtip',
                 "tableTools": {
                     "sSwfPath": "< echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
                 },*/
				"pagingType": "full_numbers",
				"lengthMenu": [
					[10, 20, 100, -1],
					[10, 20, 100, "Todo"]
				],
				"language": {
					"info": "Registro _START_ a _END_ de _TOTAL_ deshueses",
					"infoEmpty": "Registro 0 a 0 de 0 deshueses",
					"zeroRecords": "No se encontro coincidencia",
					"infoFiltered": "(filtrado de _MAX_ registros en total)",
					"emptyTable": "NO HAY DATOS DISPONIBLES",
					"lengthMenu": '_MENU_ ',
					"search": '<i class=" material-icons">search</i>',
					"loadingRecords": "Cargando...",
					"paginate": {
						"first": "Primera",
						"last": "Última ",
						"next": "Siguiente",
						"previous": "Anterior"
					}
				}
		});
    }
	$("#loading").modal("hide");
}else{
		$("#wrapper").html('<table id="tblRemisiones" class="display table table-condensed table-bordered table-responsive table-striped mb-none table-sm"" style="width:100%">' +
                '        <thead>' +
                '            <tr>' +
                '                <th>Codigo</th>' +
                '                <th>Descripción</th>' +
                '                <th>GR</th>' +
								'                <th>Cantidad</th>' +
								'                <th>Cantidad LBS</th>' +
								'                <th>Precio</th>' +
                '            </tr>' +
                '        </thead>' +
                '        <tbody>'+
                '</tbody>');
		$("#tblRemisiones").DataTable({
				"autoWidth": false,
				"info": false,
				"sort": false,
				"destroy":true,
				"paging": false,
				"ordering": true,
				"searching":false,
				"order": [
					[0, "asc"]
				],
				/*"dom": 'T<"clear">lfrtip',
                 "tableTools": {
                     "sSwfPath": "< echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
                 },*/
				"pagingType": "full_numbers",
				"lengthMenu": [
					[10, 20, 100, -1],
					[10, 20, 100, "Todo"]
				],
				"language": {
					"info": "Registro _START_ a _END_ de _TOTAL_ deshueses",
					"infoEmpty": "Registro 0 a 0 de 0 deshueses",
					"zeroRecords": "No se encontro coincidencia",
					"infoFiltered": "(filtrado de _MAX_ registros en total)",
					"emptyTable": "NO HAY DATOS DISPONIBLES",
					"lengthMenu": '_MENU_ ',
					"search": '<i class=" material-icons">search</i>',
					"loadingRecords": "Cargando...",
					"paginate": {
						"first": "Primera",
						"last": "Última ",
						"next": "Siguiente",
						"previous": "Anterior"
					}
				}
		});
		$("#loading").modal("hide");
	}
});

$("#cantidad").on("keyup", function () {
	$("#cantaut").val($(this).val());
  });

$("#btnAddArt").click(function () {
	let cantidad = 0,
		umedida = "",
		cantaut = 0,
		descArt = "";
	cantidad = $("#cantidad").val();
	umedida = $("#umedida option:selected").val();
	cantaut = $("#cantaut").val();
	descArt = $("#descArt").val();

	if (cantidad == 0 || descArt == "" || umedida == "" || cantaut == "") {
		Swal.fire({
			text: "Los campos ''Cantidad Solicitada'', ''Descripcion del articulo', ''Unidad Medida'' y ''Cantidad Autorizada''  son obligatorios",
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
			descArt
		]).draw(false);

		$("#cantidad").focus();
		$("#cantidad").val("");
		//$("#umedida").val("");
		$("#cantaut").val("");
		$("#descArt").val("");
	}
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

//
$("#btnSaveSolic").on("click", function () {
    Swal.fire({
			text: '<?php if ($this->session->userdata("Autoriza") != 1) {
				echo "Este proceso es irreversible. ¿Estas seguro que deseas modificar los artículos de esta solicitud? Tu Jefe deberà autorizar esta solicitud	nuevamente";
			} else {
				echo "Este proceso es irreversible. ¿Estas seguro que deseas modificar los artículos de esta solicitud?";
			}
			?>',
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
                let mensaje = "", icon = "",correo = '', aut = '',i = 0, 
				array = new Array(),prioridad ='', tipo ='', tipoText = '',
                t = $("#tblArticulos").DataTable({
                            "paging": false,
                                "order": false,
                                "info": false,
                                "destroy": true,
                                "scrollY": "100px",
                                "scrollCollapse": true
                    });
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
									t.rows().eq(0).each(function (index) {
                            let row = t.row(index);
                            let datos = row.data();
                            array[i] = [];
                            array[i][0] = datos[0];
                            array[i][1] = datos[1];
                            array[i][2] = datos[2];
                            array[i][3] = datos[3];
                            i++;
                        });
                        let form_data = {
                            idSolicitud: [$("#idSolicitud").val(), tipo, $("#descSol").val(),prioridad],
                            detalles: JSON.stringify(array)    
                        };

                        console.log(form_data);
                        $.ajax({
                            url: "<?php echo base_url("index.php/actualizarSolicitud")?>",
                            type: "POST",
                            data: form_data,
                            success: function(data){
                                $("#loading").modal("hide");
                                let obj = jQuery.parseJSON(data);
                                $.each(obj, function(i, key){
                                    mensaje = key["mensaje"];
                                    icon = key["tipo"];
									correo = key["correo"];
									aut = key["aut"];
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
                                            showSolicitudData();
                                            if(aut == true){
												sendMail(correo,
												"<?php echo $this->session->userdata("Name")?> ha modificado los datos de una solicitud",
												"N° de solicitud "+$("#cons").val(),
												" "+$("#descSol").val()+" ");
											}else{
												let sms = `<li style="padding-bottom: 10px;">Debes autorizar nuevamente esta solicitud</li>
												<li style="padding-bottom: 10px;">Descripcion de la solicitud: ${$("#descSol").val()}</li>`;
												sendMail(correo,
												"<?php echo $this->session->userdata("Name")?> ha modificado los datos de una solicitud",
												"N° de solicitud "+$("#cons").val(),
												""+sms+"");
											}
										}
                                    });
                            }
                        }); 
                    }
        });
});

function sendMail(mailcompras1,message1,message2,message3){
	$("#loading").modal("show");
	let form_data = {
			from: mailcompras1,
			message: `
			<ul style="padding: 15px;">
				${message3}
              <li style="padding-bottom: 10px;">${message1}</li>
			  <li style="padding-bottom: 10px;">${message2}</li>
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