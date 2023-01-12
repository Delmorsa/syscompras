<script>
    $(document).ready(function () {
        OCBodega();
		OPBodega();
        $('.table').on('show.bs.dropdown', function () {
			//debugger;
			$('.table-responsive').css( "overflow", "inherit !important" );
			$('.table-responsive').css( "position", "relative !important" );
		});

		$('.table').on('hide.bs.dropdown', function () {
			$('.table-responsive').css( "overflow", "auto" );
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
      });
	  function OPBodega() {
        let table = $("#file_manager_listOP").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: true,
			destroy: true,
			ordering: false,
			"ajax": {
				"url": "mostrarOPBodega",
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
				{data: "Personal"},
				{data: "Solicitante"},
                {data: "Area"},
                {data: "Consecutivo"},
				{data: "ConsecutivoOP"},
				{data: "Proveedor"},
				{data: "NombreCheque"},
				{data: "Concepto"},
				{data: "Total"},
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
    
    function OCBodega() {
        let table = $("#file_manager_listOC").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: true,
			destroy: true,
			ordering: false,
			"ajax": {
				"url": "mostrarOCBodega",
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
				{data: "Personal"},
				{data: "Solicitante"},
                {data: "Area"},
                {data: "Consecutivo"},
				{data: "ConsecutivoOC"},
				{data: "Proveedor"},
				{data: "Direccion"},
				{data: "Total"},
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

	  function CHBodega() {
        let table = $("#file_manager_listCH").DataTable({
			searchDelay: 500,
			processing: true,
			serverSide: true,
			stateSave: true,
			destroy: true,
			ordering: false,
			"ajax": {
				"url": "mostrarCHBodega",
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
				{data: "Personal"},
                {data: "Solicitante"},
                {data: "Area"},
                {data: "Consecutivo"},
				{data: "ConsecutivoCH"},
				{data: "Proveedor"},
				{data: "fechaRecibo"},
				{data: "Concepto"},
				{data: "Total"},
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

    function autorizar(idsolicitud,consecutivo,correo,cons,correoCompra,idsolRec){
        $("#modalTitleBodega").text("Solicitud");
        $("#detConsecBodega").text(" n° "+consecutivo+" ");
        $("#cons").text("Orden n° "+cons+" ");
        $("#modalSolicitudBodega").modal("show");
		$("#idsolRecepcion").val(idsolRec);
		$("#mail").val(correo);
		$("#mailCompra").val(correoCompra);
        $("#tblBodegas").show();
       /* $("#tblDetSolicitudes").DataTable().destroy();
        $("#tblDetSolicitudes").hide();*/
        $("#chkAll").prop("checked",false);
        $(".check").prop("checked",false);
        $("#botones").show();
        //(".badge-valida").hide();
        let table = $("#tblBodegas").DataTable({
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        "paging": false,
        "order": false,
        "info": false,
        "ordering": false,
		"ajax": {
			"url": "getDetOrdenOC"+"/"+idsolicitud,
			"type": "POST"
		},
        columns: [
				{ data: "ArticuloProveedor"},
				{ data: "NumProforma"},
				{ data: "UnidadMedida"},
				{ data: "Cantidad"},
				{ data: "PrecioAntDescuento"},
				{ data: "MontoDesc"},
				{ data: "CodImpuesto"},
				{ data: "IVA"},
				{ data: "Moneda"},
				{ data: "SubTotal"},
				{ data: "Total"},
				{ data: "CantidadRec"},
				{ data: "comentarios"},
                { data: "Acciones"}
            ]
		});
    }

	$("#chkAll").on("change", function(){
        let t = $("#tblBodegas").DataTable();
        let cantSolic = 0;
        t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
            if($("#chkAll").prop("checked") == true){
                if(!$("#chk"+datos.IdDetalleOC).is(":disabled")){
					$("#chk"+datos.IdDetalleOC).prop("checked",true);
					cantSolic = $("#cantSolic"+datos.IdDetalleOC).val();
					$("#cantReceived"+datos.IdDetalleOC).val(cantSolic);
				}
            }else{
				if(!$("#chk"+datos.IdDetalleOC).is(":disabled")){
					$("#chk"+datos.IdDetalleOC).prop("checked",false);
                	$("#cantReceived"+datos.IdDetalleOC).val(null);
				}
            }
		});
    });

	$("#tblBodegas tbody").on("click", ".check", function(){
        let table = $('#tblBodegas').DataTable(),
         checkeado = 0,
         valor = 0,
         campo = 0;

        valor = table.row( this.closest('tr') ).data().IdDetalleOC;

        $("#chk"+valor).on("change", function(){
            checkeado = $(".check:checked").length;

            if(this.checked==true){
                campo = $("#cantSolic"+valor).val();
                $("#cantReceived"+valor).val(campo);
                
            }else{
                $("#cantReceived"+valor).val(null);
                if(checkeado == 0){
                    $("#chkAll").prop("checked",false);
                    $("#chkAll").on("change", function(){
                        if(this.checked==false){
                            $("#cantReceived"+valor).val(null);
                        }
                    });
                }
            }
        });
    });

	function cantRecepcion(IdDetalleOC){
        if($("#cantSolic"+IdDetalleOC).val() !=  $("#cantReceived"+IdDetalleOC).val()){
            $("#chk"+IdDetalleOC).prop("checked",false);
        }else if($("#cantReceived"+IdDetalleOC).val() == null || $("#cantReceived"+IdDetalleOC).val() == 0){
            $("#chk"+IdDetalleOC).prop("checked",false);
		}else{
            $("#chk"+IdDetalleOC).prop("checked",true);
        }
    }

	$("#btnRecepcion").on("click", function(){
        //let checkeado = $(".check:checked").length;
		$("#loading").modal("show");
		let array = new Array(), i = 0, estado = '';
		let t = $("#tblBodegas").DataTable();
		let articulos = new Array();
		let cantidades = new Array();
		let entrega = '', comentarios = '', bandera = true;

		t.rows().eq(0).each(function (index) {
				let row = t.row(index);
				let datos = row.data();
				// if($("#chk"+datos.IdDetalleOC).prop("checked") == true){
				// 	estado = "Y";
				// }
				$("#Comment"+datos.IdDetalleOC).removeClass("is-invalid");
				if($("#cantReceived"+datos.IdDetalleOC).val() != "" && $("#cantReceived"+datos.IdDetalleOC).val() != 0){
					if(!$("#chk"+datos.IdDetalleOC).is(":disabled")){
						if($("#cantSolic"+datos.IdDetalleOC).val() !=  $("#cantReceived"+datos.IdDetalleOC).val()){
							estado = "P"; //parcial
							entrega = 'Parcial';
							
							if($("#Comment"+datos.IdDetalleOC).val() == ""){
								bandera = false
								$("#Comment"+datos.IdDetalleOC).addClass("is-invalid");
							}else{
								bandera = true;
								comentarios = `<li>Comentario: ${$("#Comment"+datos.IdDetalleOC).val()}</li>`;
							}
						}else if($("#cantSolic"+datos.IdDetalleOC).val() ==  $("#cantReceived"+datos.IdDetalleOC).val()){
							if(bandera){
								estado = "B"; //en bodega
								entrega = 'Completa';
								if($("#Comment"+datos.IdDetalleOC).val() != ""){
									comentarios = `<li>Comentario: ${$("#Comment"+datos.IdDetalleOC).val()}</li>`;
								}else{
									comentarios = '';
								}
							}
						}else{
							bandera = true;
							estado = null;
							entrega = '';
						}
							if(bandera){
								array[i] = [];
								array[i][0] = datos.IdDetalleOC;
								array[i][1] = $("#cantReceived"+datos.IdDetalleOC).val();
								array[i][2] = $("#Comment"+datos.IdDetalleOC).val();
								array[i][3] = estado;
								articulos[i] = `<li style="padding-bottom: 10px;">
													${datos.ArticuloProveedor}
													<ul style="list-style-type: none !important; padding: 15px;">
														<li>Cantidad recibida: ${$("#cantReceived"+datos.IdDetalleOC).val()} de ${$("#cantSolic"+datos.IdDetalleOC).val()}</li>
														<li>Recepción ${entrega}</li>
														${comentarios}
													</ul>
												</li>`;
								array[i][4] = datos.IdOrdenCompra;
								/*array[i][5] = $("#mail").val(); //usuario
								array[i][6] = $("#mailCompra").val(); //compra*/
								i++;
							}
					}
				}
        });
		if(array.length > 0 && bandera != false){
			//console.log(array);
			let mensaje = '', icon = '', cerrar = '', solicCerrada = '';
			let form_data = {
				idsolicitud: $("#idsolRecepcion").val(),
				detalles: JSON.stringify(array),
				tipo: 1
			};

			console.log(form_data);

			$.ajax({
				url: "recepcionarArticulos",
				type: "POST",
				data: form_data,
				success: function (data) {
					$("#loading").modal("hide");
					let obj = $.parseJSON(data);
					$.each(obj, function(i,key){
						mensaje = key["mensaje"];
						icon = key["icon"];
						cerrar = key["cerrar"];
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
						if(cerrar == true){
							solicCerrada = `<li style="color:#027A4A;padding-bottom: 10px; font-weight:bold;">Solicitud  ${$("#detConsecBodega").text()} Cerrada</li>`;
							sendMail([""+$("#mailCompra").val()+"",""+$("#mail").val()+""],
								""+articulos.join(" ")+"", ""+solicCerrada+"");
						}else{
							solicCerrada = '';
							sendMail([""+$("#mailCompra").val()+"",""+$("#mail").val()+""],
								""+articulos.join(" ")+"",""+solicCerrada+"");
						}
					});
				  }
			});
		}else{
			$("#loading").modal("hide");
			Swal.fire({
					text: "Si la recepcion de artículos es parcial debe indicar el motivo en la caja de comentario.",
					icon: "warning",
					customClass: {
						confirmButton: "btn btn-primary"
					},
					confirmButtonText: "Cerrar",
					allowOutsideClick: false
			});
		}	
	});



	/***************************************************************** */

	function autorizarOP(idsolicitud,consecutivo,correo,cons,correoCompra,idsolRec){
        $("#modalTitleBodegaOP").text("Solicitud");
        $("#detConsecBodegaOP").text(" n° "+consecutivo+" ");
        $("#consOP").text("Orden n° "+cons+" ");
        $("#modalSolicitudBodegaOP").modal("show");
		$("#idsolRecepcionOP").val(idsolRec);
		$("#mailOP").val(correo);
		$("#mailCompraOP").val(correoCompra);
        $("#tblBodegasOP").show();
       /* $("#tblDetSolicitudes").DataTable().destroy();
        $("#tblDetSolicitudes").hide();*/
        $("#chkAllOP").prop("checked",false);
        $(".checkOP").prop("checked",false);
        $("#botonesOP").show();
        //(".badge-valida").hide();
        let table = $("#tblBodegasOP").DataTable({
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        "paging": false,
        "order": false,
        "info": false,
        "ordering": false,
		"ajax": {
			"url": "getDetOrdenOP"+"/"+idsolicitud,
			"type": "POST"
		},
        columns: [
				{ data: "ArticuloProveedor"},
				{ data: "NumProforma"},
				{ data: "UnidadMedida"},
				{ data: "Cantidad"},
				{ data: "PrecioAntDescuento"},
				{ data: "MontoDesc"},
				{ data: "CodImpuesto"},
				{ data: "IVA"},
				{ data: "Moneda"},
				{ data: "SubTotal"},
				{ data: "Total"},
				{ data: "CantidadRec"},
				{ data: "comentarios"},
                { data: "Acciones"}
            ]
		});
    }

	$("#chkAllOP").on("change", function(){
        let t = $("#tblBodegasOP").DataTable();
        let cantSolic = 0;
        t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
            if($("#chkAllOP").prop("checked") == true){
                if(!$("#chkOP"+datos.IdDetalleOP).is(":disabled")){
					$("#chkOP"+datos.IdDetalleOP).prop("checked",true);
					cantSolic = $("#cantSolicOP"+datos.IdDetalleOP).val();
					$("#cantReceivedOP"+datos.IdDetalleOP).val(cantSolic);
				}
            }else{
				if(!$("#chkOP"+datos.IdDetalleOP).is(":disabled")){
					$("#chkOP"+datos.IdDetalleOP).prop("checked",false);
                	$("#cantReceivedOP"+datos.IdDetalleOP).val(null);
				}
            }
		});
    });

	$("#tblBodegasOP tbody").on("click", ".checkOP", function(){
        let table = $('#tblBodegasOP').DataTable(),
         checkeado = 0,
         valor = 0,
         campo = 0;

        valor = table.row( this.closest('tr') ).data().IdDetalleOP;

        $("#chkOP"+valor).on("change", function(){
            checkeado = $(".checkOP:checked").length;

            if(this.checked==true){
                campo = $("#cantSolicOP"+valor).val();
                $("#cantReceivedOP"+valor).val(campo);
                
            }else{
                $("#cantReceivedOP"+valor).val(null);
                if(checkeado == 0){
                    $("#chkAllOP").prop("checked",false);
                    $("#chkAllOP").on("change", function(){
                        if(this.checked==false){
                            $("#cantReceivedOP"+valor).val(null);
                        }
                    });
                }
            }
        });
    });

	function cantRecepcionOP(IdDetalleOP){
        if($("#cantSolicOP"+IdDetalleOP).val() !=  $("#cantReceivedOP"+IdDetalleOP).val()){
            $("#chkOP"+IdDetalleOP).prop("checked",false);
        }else if($("#cantReceivedOP"+IdDetalleOP).val() == null || $("#cantReceivedOP"+IdDetalleOP).val() == 0){
            $("#chkOP"+IdDetalleOP).prop("checked",false);
		}else{
            $("#chkOP"+IdDetalleOP).prop("checked",true);
        }
    }

	$("#btnRecepcionOP").on("click", function(){
        //let checkeado = $(".check:checked").length;
		$("#loading").modal("show");
		let array = new Array(), i = 0, estado = '';
		let t = $("#tblBodegasOP").DataTable();
		let articulos = new Array();
		let cantidades = new Array();
		let entrega = '', comentarios = '', bandera = true;

		t.rows().eq(0).each(function (index) {
				let row = t.row(index);
				let datos = row.data();
				// if($("#chk"+datos.IdDetalleOC).prop("checked") == true){
				// 	estado = "Y";
				// }
				$("#CommentOP"+datos.IdDetalleOP).removeClass("is-invalid");
				if($("#cantReceivedOP"+datos.IdDetalleOP).val() != "" && $("#cantReceivedOP"+datos.IdDetalleOP).val() != 0){
					if(!$("#chkOP"+datos.IdDetalleOP).is(":disabled")){
						if($("#cantSolicOP"+datos.IdDetalleOP).val() !=  $("#cantReceivedOP"+datos.IdDetalleOP).val()){
							estado = "P"; //parcial
							entrega = 'Parcial';
							
							if($("#CommentOP"+datos.IdDetalleOP).val() == ""){
								bandera = false
								$("#CommentOP"+datos.IdDetalleOP).addClass("is-invalid");
							}else{
								bandera = true;
								comentarios = `<li>Comentario: ${$("#CommentOP"+datos.IdDetalleOP).val()}</li>`;
							}
						}else if($("#cantSolicOP"+datos.IdDetalleOP).val() ==  $("#cantReceivedOP"+datos.IdDetalleOP).val()){
							if(bandera){
								estado = "B"; //en bodega
								entrega = 'Completa';
								if($("#CommentOP"+datos.IdDetalleOP).val() != ""){
									comentarios = `<li>Comentario: ${$("#CommentOP"+datos.IdDetalleOP).val()}</li>`;
								}else{
									comentarios = '';
								}
							}
						}else{
							bandera = true;
							estado = null;
							entrega = '';
						}
							if(bandera){
								array[i] = [];
								array[i][0] = datos.IdDetalleOP;
								array[i][1] = $("#cantReceivedOP"+datos.IdDetalleOP).val();
								array[i][2] = $("#CommentOP"+datos.IdDetalleOP).val();
								array[i][3] = estado;
								articulos[i] = `<li style="padding-bottom: 10px;">
													${datos.ArticuloProveedor}
													<ul style="list-style-type: none !important; padding: 15px;">
														<li>Cantidad recibida: ${$("#cantReceivedOP"+datos.IdDetalleOP).val()} de ${$("#cantSolicOP"+datos.IdDetalleOP).val()}</li>
														<li>Recepción ${entrega}</li>
														${comentarios}
													</ul>
												</li>`;
								array[i][4] = datos.IdOrdenPago;
								/*array[i][5] = $("#mail").val(); //usuario
								array[i][6] = $("#mailCompra").val(); //compra*/
								i++;
							}
					}
				}
        });
		if(array.length > 0 && bandera != false){
			//console.log(array);
			let mensaje = '', icon = '', cerrar = '', solicCerrada = '';
			let form_data = {
				idsolicitud: $("#idsolRecepcionOP").val(),
				detalles: JSON.stringify(array),
				tipo: 2
			};

			console.log(form_data);

			$.ajax({
				url: "recepcionarArticulos",
				type: "POST",
				data: form_data,
				success: function (data) {
					$("#loading").modal("hide");
					let obj = $.parseJSON(data);
					$.each(obj, function(i,key){
						mensaje = key["mensaje"];
						icon = key["icon"];
						cerrar = key["cerrar"];
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
						if(cerrar == true){
							solicCerrada = `<li style="color:#027A4A;padding-bottom: 10px; font-weight:bold;">Solicitud  ${$("#detConsecBodegaOP").text()} Cerrada</li>`;
							sendMail([""+$("#mailCompraOP").val()+"",""+$("#mailOP").val()+""],
								""+articulos.join(" ")+"", ""+solicCerrada+"");
						}else{
							solicCerrada = '';
							sendMail([""+$("#mailCompraOP").val()+"",""+$("#mailOP").val()+""],
								""+articulos.join(" ")+"",""+solicCerrada+"");
						}
					});
				  }
			});
		}else{
			$("#loading").modal("hide");
			Swal.fire({
					text: "Si la recepcion de artículos es parcial debe indicar el motivo en la caja de comentario.",
					icon: "warning",
					customClass: {
						confirmButton: "btn btn-primary"
					},
					confirmButtonText: "Cerrar",
					allowOutsideClick: false
			});
		}	
	});

	/***************************************************************** */

	function autorizarCH(idsolicitud,consecutivo,correo,cons,correoCompra,idsolRec){
        $("#modalTitleBodegaCH").text("Solicitud");
        $("#detConsecBodegaCH").text(" n° "+consecutivo+" ");
        $("#consCH").text("Orden n° "+cons+" ");
        $("#modalSolicitudBodegaCH").modal("show");
		$("#idsolRecepcionCH").val(idsolRec);
		$("#mailCH").val(correo);
		$("#mailCompraCH").val(correoCompra);
        $("#tblBodegasCH").show();
       /* $("#tblDetSolicitudes").DataTable().destroy();
        $("#tblDetSolicitudes").hide();*/
        $("#chkAllCH").prop("checked",false);
        $(".checkCH").prop("checked",false);
        $("#botonesCH").show();
        //(".badge-valida").hide();
        let table = $("#tblBodegasCH").DataTable({
        processing: true,
        serverSide: true,
        stateSave: false,
        destroy: true,
        "paging": false,
        "order": false,
        "info": false,
        "ordering": false,
		"ajax": {
			"url": "getDetOrdenCH"+"/"+idsolicitud,
			"type": "POST"
		},
        columns: [
				{ data: "ArticuloProveedor"},
				{ data: "NumFactura"},
				{ data: "UnidadMedida"},
				{ data: "Cantidad"},
				{ data: "PrecioAntDescuento"},
				{ data: "MontoDesc"},
				{ data: "CodImpuesto"},
				{ data: "IVA"},
				{ data: "Moneda"},
				{ data: "SubTotal"},
				{ data: "Total"},
				{ data: "CantidadRec"},
				{ data: "comentarios"},
                { data: "Acciones"}
            ]
		});
    }

	$("#chkAllCH").on("change", function(){
        let t = $("#tblBodegasCH").DataTable();
        let cantSolic = 0;
        t.rows().eq(0).each(function (index) {
			let row = t.row(index);
			let datos = row.data();
            if($("#chkAllCH").prop("checked") == true){
                if(!$("#chkCH"+datos.idDetCH).is(":disabled")){
					$("#chkCH"+datos.idDetCH).prop("checked",true);
					cantSolic = $("#cantSolicCH"+datos.idDetCH).val();
					$("#cantReceivedCH"+datos.idDetCH).val(cantSolic);
				}
            }else{
				if(!$("#chkCH"+datos.idDetCH).is(":disabled")){
					$("#chkCH"+datos.idDetCH).prop("checked",false);
                	$("#cantReceivedCH"+datos.idDetCH).val(null);
				}
            }
		});
    });

	$("#tblBodegasCH tbody").on("click", ".checkCH", function(){
        let table = $('#tblBodegasCH').DataTable(),
         checkeado = 0,
         valor = 0,
         campo = 0;

        valor = table.row( this.closest('tr') ).data().idDetCH;

        $("#chkCH"+valor).on("change", function(){
            checkeado = $(".checkCH:checked").length;

            if(this.checked==true){
                campo = $("#cantSolicCH"+valor).val();
                $("#cantReceivedCH"+valor).val(campo);
                
            }else{
                $("#cantReceivedCH"+valor).val(null);
                if(checkeado == 0){
                    $("#chkAllCH").prop("checked",false);
                    $("#chkAllCH").on("change", function(){
                        if(this.checked==false){
                            $("#cantReceivedCH"+valor).val(null);
                        }
                    });
                }
            }
        });
    });

	function cantRecepcionCH(IdDetalleCH){
        if($("#cantSolicCH"+IdDetalleCH).val() !=  $("#cantReceivedCH"+IdDetalleCH).val()){
            $("#chkCH"+IdDetalleCH).prop("checked",false);
        }else if($("#cantReceivedCH"+IdDetalleCH).val() == null || $("#cantReceivedCH"+IdDetalleCH).val() == 0){
            $("#chkCH"+IdDetalleCH).prop("checked",false);
		}else{
            $("#chkCH"+IdDetalleCH).prop("checked",true);
        }
    }

	$("#btnRecepcionCH").on("click", function(){
        //let checkeado = $(".check:checked").length;
		$("#loading").modal("show");
		let array = new Array(), i = 0, estado = '';
		let t = $("#tblBodegasCH").DataTable();
		let articulos = new Array();
		let cantidades = new Array();
		let entrega = '', comentarios = '', bandera = true;

		t.rows().eq(0).each(function (index) {
				let row = t.row(index);
				let datos = row.data();
				// if($("#chk"+datos.IdDetalleOC).prop("checked") == true){
				// 	estado = "Y";
				// }
				$("#CommentCH"+datos.idDetCH).removeClass("is-invalid");
				if($("#cantReceivedCH"+datos.idDetCH).val() != "" && $("#cantReceivedCH"+datos.idDetCH).val() != 0){
					if(!$("#chkCH"+datos.idDetCH).is(":disabled")){
						if($("#cantSolicCH"+datos.idDetCH).val() !=  $("#cantReceivedCH"+datos.idDetCH).val()){
							estado = "P"; //parcial
							entrega = 'Parcial';
							
							if($("#CommentCH"+datos.idDetCH).val() == ""){
								bandera = false
								$("#CommentCH"+datos.idDetCH).addClass("is-invalid");
							}else{
								bandera = true;
								comentarios = `<li>Comentario: ${$("#CommentCH"+datos.idDetCH).val()}</li>`;
							}
						}else if($("#cantSolicCH"+datos.idDetCH).val() ==  $("#cantReceivedCH"+datos.idDetCH).val()){
							if(bandera){
								estado = "B"; //en bodega
								entrega = 'Completa';
								if($("#CommentCH"+datos.idDetCH).val() != ""){
									comentarios = `<li>Comentario: ${$("#CommentCH"+datos.idDetCH).val()}</li>`;
								}else{
									comentarios = '';
								}
							}
						}else{
							bandera = true;
							estado = null;
							entrega = '';
						}
							if(bandera){
								array[i] = [];
								array[i][0] = datos.idDetCH;
								array[i][1] = $("#cantReceivedCH"+datos.idDetCH).val();
								array[i][2] = $("#CommentCH"+datos.idDetCH).val();
								array[i][3] = estado;
								articulos[i] = `<li style="padding-bottom: 10px;">
													${datos.ArticuloProveedor}
													<ul style="list-style-type: none !important; padding: 15px;">
														<li>Cantidad recibida: ${$("#cantReceivedCH"+datos.idDetCH).val()} de ${$("#cantSolicCH"+datos.idDetCH).val()}</li>
														<li>Recepción ${entrega}</li>
														${comentarios}
													</ul>
												</li>`;
								array[i][4] = datos.IdCajaChica;
								/*array[i][5] = $("#mailCH").val(); //usuario
								array[i][6] = $("#mailCompraCH").val(); //compra*/
								i++;
							}
					}
				}
        });
		if(array.length > 0 && bandera != false){
			//console.log(array);
			let mensaje = '', icon = '', cerrar = '', solicCerrada = '';
			let form_data = {
				idsolicitud: $("#idsolRecepcionCH").val(),
				detalles: JSON.stringify(array),
				tipo: 3
			};

			console.log(form_data);

			$.ajax({
				url: "recepcionarArticulos",
				type: "POST",
				data: form_data,
				success: function (data) {
					$("#loading").modal("hide");
					let obj = $.parseJSON(data);
					$.each(obj, function(i,key){
						mensaje = key["mensaje"];
						icon = key["icon"];
						cerrar = key["cerrar"];
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
						if(cerrar == true){
							solicCerrada = `<li style="color:#027A4A;padding-bottom: 10px; font-weight:bold;">Solicitud  ${$("#detConsecBodegaCH").text()} Cerrada</li>`;
							sendMail([""+$("#mailCompraCH").val()+"",""+$("#mailCH").val()+""],
								""+articulos.join(" ")+"", ""+solicCerrada+"");
						}else{
							solicCerrada = '';
							sendMail([""+$("#mailCompraCH").val()+"",""+$("#mailCH").val()+""],
								""+articulos.join(" ")+"",""+solicCerrada+"");
						}
					});
				  }
			});
		}else{
			$("#loading").modal("hide");
			Swal.fire({
					text: "Si la recepcion de artículos es parcial debe indicar el motivo en la caja de comentario.",
					icon: "warning",
					customClass: {
						confirmButton: "btn btn-primary"
					},
					confirmButtonText: "Cerrar",
					allowOutsideClick: false
			});
		}	
	});
	/******************************************************************* */


	function sendMail(mailcompras1,message1,message2){
	$("#loading").modal("show");
	let form_data = {
			from: mailcompras1,
			message: `
			<p style="padding: 15px;">Los siguientes artículos ya fueron recepcionados en Bodega:</p>
			<ul style="padding: 15px;">
				${message2}
				<li style="padding-bottom: 10px;">Solicitud correspondiente 
				   ${$("#detConsecBodegaOP").text()} 
				   ${$("#detConsecBodega").text()}
				   ${$("#detConsecBodegaCH").text()}

				   </li>
					<ul>
						${message1}
					</ul>
				</li>
            </ul>
			<p style="margin:0;font-size:12px;line-height:24px;font-family:Arial,sans-serif;">
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
				//$("#loading").modal("show");
				//console.log(form_data);
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
					$("#loading").modal("hide");
				});
			}
		});
}
	
</script>