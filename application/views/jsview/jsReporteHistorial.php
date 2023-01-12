<script>
    $(document).ready(function () {  
        $("#fechaInicio,#fechaFin").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2022,
                "autoApply": true,
                maxYear: parseInt(moment().format("YYYY"),10),
                "locale":{
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
					format: "yyyy-MM-DD"
                }
            });
    });

    function reporteHistorial(fechaInicio,fechaFin){
        let table = $("#tblHistorial").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: false,
			destroy: true,
			"ajax": {
				"url": "mostrarHistorial/"+fechaInicio+"/"+fechaFin,
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
                { data: "Usuario"},
                { data: "Consecutivo"},
                { data: "FechaSolicitud"},
                { data: "DescripcionSolicitud"},
                { data: "estadoAct"},
                { data: "Opciones"},
				{ data: "ribbon"}
			],
			"lengthMenu": [
				[5,10, 25, 50, 100, -1],
				[5,10, 25, 50, 100, "Todo"]
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

	function mostrarHistorialChart(fechaInicio,fechaFin){
		$("canvas#myChart").remove();
		$("div.chartreport").append('<canvas id="myChart"></canvas>');
		let datos = new Array(); 
        $.ajax({
            url: 'mostrarHistorialChart/'+fechaInicio+"/"+fechaFin,
            type: 'GET',
            async: false,
            success: function (data) {
                let obj = $.parseJSON(data);
                $.each(obj, function (i,key) {
                    datos[i] = [];
                    datos[i][0] = key["Nombre"];
                    datos[i][1] = key["Proceso"];
                    datos[i][2] = key["Cerrada"];
                    datos[i][3] = key["Rechazada"];
                    datos[i][4] = key["Anuladas"];
					datos[i][5] = key["Abiertas"];
                  });
              }
        });
		//console.log(datos[0][0])
		const colors = ['rgb(79, 201, 218)','rgb(240, 100, 69)','rgb(184, 217, 53)','rgb(232, 196, 68)','rgb(79, 85, 218)','rgb(32, 146, 162)'];
        const ctx = document.getElementById('myChart').getContext('2d');
        const mixedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Abiertas','Proceso', 'Cerrada', 'Rechazada', 'Anuladas'],
				datasets: []
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
		
		for (let i = 0; i < datos.length; i++) {
			mixedChart.data.datasets.push({
				label: datos[i][0],
                data: [datos[i][5],datos[i][1], datos[i][2], datos[i][3], datos[i][4]],
                // this dataset is drawn below
                order: 1,
                borderColor: colors[i],
                backgroundColor: colors[i]
			});
		}	

		mixedChart.update();
	}

	function historialChartPie(fechaInicio,fechaFin){
		$("canvas#myChartPie").remove();
		$("div.chartreportPie").append('<canvas id="myChartPie"></canvas>');
		let datos = new Array();
        let datosNum = new Array();
        $.ajax({
            url: 'historialChartPie/'+fechaInicio+"/"+fechaFin,
            type: 'GET',
            async: false,
            success: function (data) {
                let obj = $.parseJSON(data);
                $.each(obj, function (i,key) {
                    datos[i] = key["Estado"];
                    datosNum[i] = key["CantSolicitudes"];
                  });
                  console.log(datos)
              }
        });
        const ctx = document.getElementById('myChartPie').getContext('2d');
        const mixedChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    label: 'prueba',
                    data: datosNum,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(240, 100, 69)',
                        'rgb(243, 242, 241)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                        'rgb(0, 204, 102)'
                    ]
                    // this dataset is drawn below
                }],
                labels: datos
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
	}	
	
	function historialPrioridad(fechaInicio,fechaFin){
		$("canvas#myChartPiePrio").remove();
		$("div.chartreportPrio").append('<canvas id="myChartPiePrio"></canvas>');
		let datos = new Array();
        let datosNum = new Array();
        $.ajax({
            url: 'historialPrioridad/'+fechaInicio+"/"+fechaFin,
            type: 'GET',
            async: false,
            success: function (data) {
                let obj = $.parseJSON(data);
                $.each(obj, function (i,key) {
                    datos[i] = key["Prioridad"];
                    datosNum[i] = key["CantSolicitudes"];
                  });
                  console.log(datos)
              }
        });
        const ctx = document.getElementById('myChartPiePrio').getContext('2d');
        const mixedChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    label: 'prueba',
                    data: datosNum,
                    backgroundColor: [
                        'rgb(0, 204, 102)',
						'rgb(255, 205, 86)',
                        'rgb(240, 100, 69)'
                    ]
                    // this dataset is drawn below
                }],
                labels: datos
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
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

    $("#btnHistory").click(function () {
        if($("#fechaInicio").val() == "" || $("#fechaFin").val() == ""){
            Swal.fire({
                        allowOutsideClick: false,
                        icon: "warning",
                        text: "Debe ingresar una fecha de inicio y una fecha final para poder generar el reporte",
                        confirmButtonText: "cerrar",
                        customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                    });
        }else if($("#fechaInicio").val() > $("#fechaFin").val()){
            Swal.fire({
                        allowOutsideClick: false,
                        icon: "warning",
                        text: "La fecha de inicio no puede ser mayor a la fecha final",
                        confirmButtonText: "cerrar",
                        customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                    });
        }else{
            reporteHistorial($("#fechaInicio").val(),$("#fechaFin").val());
			mostrarHistorialChart($("#fechaInicio").val(),$("#fechaFin").val());
			historialPrioridad($("#fechaInicio").val(),$("#fechaFin").val());
			historialChartPie($("#fechaInicio").val(),$("#fechaFin").val());
        }
    });
</script>