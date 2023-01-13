<div class="modal" data-bs-backdrop="static" id="loading" tabindex="-1" role="dialog"
	aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content" style="background-color:transparent;box-shadow: none; border: none;">
			<div class="text-center">
				<img width="130px" src="<?php echo base_url()?>assets/img/loading.gif">
			</div>
		</div>
	</div>
</div>


<!--<div class="position-fixed top-50 end-0 p-3 z-index-3">
    <div id="kt_docs_toast_toggle" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <span class="svg-icon svg-icon-2 svg-icon-primary me-3">...</span>
            <strong class="me-auto">Keenthemes</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>-->


<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script>
	var hostUrl = "";

</script>
<script src="<?php echo base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo base_url()?>/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="<?php echo base_url()?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="<?php echo base_url()?>/assets/js/widgets.bundle.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/widgets.js"></script>
<!--<script src="<?php echo base_url()?>/assets/js/custom/apps/chat/chat.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-campaign.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-app.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/upgrade-plan.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/type.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/budget.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/settings.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/team.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/targets.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/files.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/complete.js"></script>-->
<script src="<?php echo base_url()?>/assets/js/custom/modals/create-project/main.js"></script>
<script src="<?php echo base_url()?>/assets/js/custom/intro.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.form.min.js"></script>
<script src="<?php echo base_url()?>/assets/js/numeroALetras.js"></script>
<script src="<?php echo base_url()?>/assets/js/xlsx.full.min.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.growl.js"></script>
<script src="<?php echo base_url()?>/assets/js/fileup.js"></script>
<script src="<?php echo base_url()?>/assets/js/webix.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/nav.js?v=46"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/magnificPopUp.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/pivot.js"></script>

<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<script>
	let actual = "";
	$(document).ready(function () {
		pedirPermisoNotificacion();
		//$("#kt_flatpickr").flatpickr();

		conectadosCant();
		solicitudes();
		solicitudesAtorizadas();
		solicitudesAnula();
		solicitudesR();
		setInterval(function () {
			solicitudes();
			conectadosCant();
			solicitudesAtorizadas();
			solicitudesAnula();
			solicitudesR();
        },10000);

		
		var url = window.location.href;
        // passes on every "a" tag
        $(".aside-menu .menu-item a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).addClass("active");

                //for making parent of submenu active
               $(this).parent().parent().addClass("hover");
			   $(this).parent().parent().addClass("show");
            }
        });

	});


function conectadosCant() {
		let cantidad = "",
			imagen = "";
		$("#listaConect").html("");
		$("#uconectadosBagde").text("0");
		$("#uconectados").text("0");

		$.ajax({
			url: "<?php echo base_url("index.php/mostrarConectados ")?>",
			type: "POST",
			async: false,
			success: function (data) {
				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {
						if (key["Genero"] == 1) {
							imagen = "avatar_male.png";
						} else {
							imagen = "avatar_female.png";
						}

						cantidad = key["Conectados"];
						$("#listaConect").append(
							'<div class="d-flex flex-stack py-4" >' +
								'<div class="d-flex align-items-center">' +
									'<div class="symbol symbol-35px me-4">' +
										'<span class="symbol-label bg-light-info">' +
											'<span class="svg-icon svg-icon-3 svg-icon-info">' +
												'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
													'<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>' +
													'<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>' +
												'</svg>' +
											'</span>' +
										'</span>' +
									'</div>' +
									'<div class="mb-0 me-2">' +
										'<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">' +key["Nombre"] + '</a>' +'<div class="text-gray-400 fs-7">' + key["Correo"] + '</div>' +
									'</div>' +
								'</div>' +
									'<span class="badge badge-light fs-8">hace ' + key["TiempoActivo"] +'</span>' +
							'</div>');
					});
					$("#uconectadosBagde").text(cantidad);
					$("#uconectados").text(cantidad);
				}

			}
		});
}

function solicitudesAtorizadas() {
		let cantidad = "",
			imagen = "";
		$("#listaAprob").html("");
		$("#solic").text("0");
		$("#jsolicitudes").text("0");

		$.ajax({
			url: "<?php echo base_url("index.php/SolicitudesAutNot")?>",
			type: "POST",
			async: false,
			success: function (data) {

				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {

						cantidad = key["Solicitudes"];
						$("#listaAprob").append(
							'<div class="d-flex flex-stack py-4" >' +
								'<div class="d-flex align-items-center">' +
									'<div class="symbol symbol-35px me-4">' +
										'<span class="symbol-label ">' +
											'<span class="svg-icon svg-icon-3 svg-icon-success">' +
												'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
													'<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>' +
													'<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>' +
												'</svg>' +
											'</span>' +
										'</span>' +
									'</div>' +
									'<div class="mb-0 me-2">' +
										'<a href="<?php base_url("index.php/Compras")?>" class="fs-6 text-gray-800 text-hover-primary fw-bolder">'+
										'La solcitud de '+key["Tipo"]+' '+key["Consecutivo"]+' fue aprovada</a>' +
										'<div class="text-gray-400 fs-7">' + key["Descripcion"] + '</div>' +
									'</div>' +
								'</div>' +
									'<span class="badge badge-light fs-8">hace ' + key["TiempoActivo"] +'</span>' +
							'</div>');
					});
					$("#solic").text(cantidad);
					$("#solicP").text(cantidad);
					$("#jsolicitudes").text(cantidad);
					if(cantidad > 0){
						if(cantidad == 1){
							showNotificationWeb('Tienes '+Number(cantidad)+' solicitud autorizada','Solicitudes');
						}else if(cantidad >= 2){
							showNotificationWeb('Tienes '+Number(cantidad)+' solicitudes autorizadas','Solicitudes');
						}
					}
				}
			}
		});
}

function solicitudes() {
		let cantidad = "",
			imagen = "";
		$("#listaSolic").html("");
		$("#badgesolicJefes").text("0");
		$("#solicitudes").text("0");

		$.ajax({
			url: "<?php echo base_url("index.php/SolicitudesJefe")?>",
			type: "POST",
			async: false,
			success: function (data) {

				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {

						/*if(actual != key["Solicitudes"]){
								toastr.options = {
									"closeButton": true,
									"debug": false,
									"newestOnTop": false,
									"progressBar": false,
									"positionClass": "toastr-top-right",
									"preventDuplicates": false,
									"onclick": null,
									"showDuration": "300",
									"hideDuration": "1000",
									"timeOut": "2000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "linear",
									"showMethod": "fadeIn",
									"hideMethod": "fadeOut"
								};

								toastr.success("El usuario "+key["Nombre"]+" te envió una nueva solicitud","nueva solictud de "+key["Tipo"]+"");
						}*/
						cantidad = key["Solicitudes"];
						$("#listaSolic").append(
							'<div class="d-flex flex-stack py-4" >' +
								'<div class="d-flex align-items-center">' +
									'<div class="symbol symbol-35px me-4">' +
										'<span class="symbol-label ">' +
											'<span class="svg-icon svg-icon-3 svg-icon-success">' +
												'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
													'<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>' +
													'<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>' +
												'</svg>' +
											'</span>' +
										'</span>' +
									'</div>' +
									'<div class="mb-0 me-2">' +
										'<a href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bolder">' +key["Nombre"] + '</a>' +
										'<div class="text-gray-400 fs-7">' + key["Descripcion"] + '</div>' +
									'</div>' +
								'</div>' +
									'<span class="badge badge-light fs-8">hace ' + key["TiempoActivo"] +'</span>' +
							'</div>');
					});
					$("#badgesolicJefes").text(cantidad);
					$("#solicitudes").text(cantidad);
				}
				if(cantidad > 0){
					showNotificationWeb('Tienes '+Number(cantidad)+' solicitud pendiente de autorizar','autSolicitudes');
				}
			}
		});
}

function solicitudesR() {
		let cantidad = "",
			imagen = "";
		$("#listaRechaz").html("");
		$("#jsolicitudesr").text("0");

		$.ajax({
			url: "<?php echo base_url("index.php/mostrarSolicitudesRechazadas")?>",
			type: "POST",
			async: false,
			success: function (data) {

				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {

						cantidad = key["Solicitudes"];
						$("#listaRechaz").append(
							'<div class="d-flex flex-stack py-4" >' +
								'<div class="d-flex align-items-center">' +
									'<div class="symbol symbol-35px me-4">' +
										'<span class="symbol-label ">' +
											'<span class="svg-icon svg-icon-3 svg-icon-danger">' +
												'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
													'<path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>' +
													'<path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>' +
												'</svg>' +
											'</span>' +
										'</span>' +
									'</div>' +
									'<div class="mb-0 me-2">' +
										'<a href="<?php base_url("index.php/rechazadas")?>" class="fs-7 text-gray-800 text-hover-primary fw-bolder">'+
										''+key["Consecutivo"]+'</a>' +
										'<div class="text-gray-400 fs-7">comentario: ' + key["comentario"] + '</div>' +
									'</div>' +
								'</div>' +
									'<span class="badge badge-light fs-8">hace ' + key["TiempoActivo"] +'</span>' +
							'</div>');
					});
					$("#solicR").text(cantidad);
					$("#solicRN").text(cantidad);
					$("#jsolicitudesr").text(cantidad);
					if(cantidad > 0){
						if(cantidad==1){
							showNotificationWeb('Tienes '+Number(cantidad)+' solicitud rechazada','rechazadas');
						}else if(cantidad >= 2){
							showNotificationWeb('Tienes '+Number(cantidad)+' solicitudes rechazadas','rechazadas');
						}
					}
				}
			}
		});
}

function solicitudesAnula() {
		let cantidad = "";
		$("#badgemenucant").hide();
		$("#badgemenucant").text("");

		$.ajax({
			url: "<?php echo base_url("index.php/mostrarSolicitudesAnul")?>",
			type: "POST",
			async: false,
			success: function (data) {
				if (data != "") {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (i, key) {
						if(actual != key["SolicitudesAnula"]){
								toastr.options = {
									"closeButton": true,
									"debug": false,
									"newestOnTop": false,
									"progressBar": false,
									"positionClass": "toastr-top-right",
									"preventDuplicates": false,
									"onclick": null,
									"showDuration": "300",
									"hideDuration": "1000",
									"timeOut": "2000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "linear",
									"showMethod": "fadeIn",
									"hideMethod": "fadeOut"
								};

								toastr.error("Tienes nuevas solicitudes de anulación");
						}
						cantidad = key["SolicitudesAnula"];
						actual = key["SolicitudesAnula"];
					});
					$("#badgemenucant").show();
					$("#badgemenucant").text(cantidad);
					if(cantidad>0){
						showNotificationWeb('Tienes '+Number(cantidad)+' solicitudes de anulación','anularSolic');
					}
				}else{
					actual = 0;
				}
			}
		});
}


//funciones para pedir permisos de notifications
 function checkNotificationPromise() { 
	try {
		Notification.requestPermission().then();
	} catch (e) {
		return false;
	}
	return true
  }

  function pedirPermisoNotificacion() {
	function handlePermission(permission) { 
		if(Notification.permission === "denied" || Notification.permission === "default"){
			Notification.requestPermission();
		}
	}

	if(!('Notification' in window)){
		alert("Este navegador no admite notificaciones");
	}else{
		if(checkNotificationPromise()){
			Notification.requestPermission().then((permission)=>{
				handlePermission(permission);
			});
		}else{
			Notification.requestPermission(function (permission) {
				handlePermission(permission);
			});
		}
	}
  }

  function showNotificationWeb(texto,url) { 
	if(window.Notification && Notification.permission === "granted"){
		let img = '<?php echo base_url()?>/assets/img/LOGO.png';
		let i = 0;
		//renotify: true,
		let n = new Notification("<?php echo basename(FCPATH)?>", {tag: 'soManyNotification',body: texto,vibrate: [200, 100, 200],icon: img,tag: "sysComprasNotification"});
		/*document.addEventListener("visibilitychange", function () { 
			//si la pestaña se vuelve visible se borra la notificacion
			if(document.visibilityState === 'visible'){
				n.close();
			}
		 });*/

		n.onclick = function (event) {
			event.preventDefault();
			window.open('<?php echo base_url("index.php/")?>'+url);
		}
	}
  }
</script>
</body>
<!--end::Body-->

</html>
