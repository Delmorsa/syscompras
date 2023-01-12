<script>
    $(document).ready(function(){
        autorizar();
        $("#listProv").select2({
			placeholder: '--- Seleccione un Proveedor ---',
			allowClear: true,
                ajax: {
                    url: '<?php echo base_url("index.php/mostrarProveedoresSAP")?>',
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
    });

    $("#listProv").on("change", function () { 
        if($(this).val()!=""){
            $("#listProvtxt").val($("#listProv option:selected").text());
        }else{
            $("#listProvtxt").val(null);
        }
     });

    function autorizar(){
        $("#modalTitle").text("Solicitud");
        //$("#detConsec").text(" n° "+consecutivo+" ");
        $("#modalSolicitud").modal("show");
        $("#tblAutSolicitudes").show();
        $("#tblDetSolicitudes").DataTable().destroy();
        $("#tblDetSolicitudes").hide();
        $("#chkAll").prop("checked",false);
        $(".check").prop("checked",false);
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
			"url": "<?php echo base_url("index.php/getSolicitudesDetOrden/").$this->uri->segment(3)?>",
			"type": "POST"
		},
        columns: [
                { data: "DescripcionArticulo"},
                { data: "DescripcionProv"},
                { data: "Proforma"},
                { data: "CantidadAut"},
                { data: "CantidadComp"},
                { data: "UnidadMedida"},
                { data: "Importe"},
                { data: "porcDesc"},
                { data: "montoDesc"},
                { data: "impuesto"},
                { data: "moneda"},
                { data: "subtotal"},
                { data: "total"},
                { data: "Acciones"}
            ],
            "drawCallback": function(settings){
                    $(".imp").select2({
                        placeholder: '-- --',
                        allowClear: true,
                            ajax: {
                                url: '<?php echo base_url("index.php/mostrarImpSAP")?>',
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
                                        res.push({id:data[i].Rate, text:data[i].Code});
                                    }
                                    return {
                                        results: res
                                    }
                                },
                                cache: true
                        }
                }
             ).trigger('change.select2');
           }
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
                cantSolic = $("#cantAut"+datos.IdDetallesSolicitud).val();
                $("#cantComp"+datos.IdDetallesSolicitud).val(cantSolic);
            }else{
                $("#chk"+datos.IdDetallesSolicitud).prop("checked",false);
                $("#cantComp"+datos.IdDetallesSolicitud).val(null);
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
                campo = $("#cantAut"+valor).val();
                $("#cantComp"+valor).val(campo);
                
            }else{
                $("#cantComp"+valor).val(null);
                if(checkeado == 0){
                    $("#chkAll").prop("checked",false);
                    $("#chkAll").on("change", function(){
                        if(this.checked==false){
                            $("#cantComp"+valor).val(null);
                        }
                    });
                }
            }
        });
    });

    $("#chkRetiene").change(function(){
        if($(this).prop("checked") == true){
            $("#divRetiene").show();
        }else{
            $("#divRetiene").hide();
        }
    });

    function subtotal(idDetalleSolicitud){
        let cantidad = $("#cantComp"+idDetalleSolicitud).val(),
            precio = $("#importe"+idDetalleSolicitud).val(),
            subtotal = 0;

        if(cantidad != "" && precio != ""){
            subtotal = Number(cantidad) * Number(precio)
            $("#subtotal"+idDetalleSolicitud).val(subtotal.toFixed(2));
        }else{
            $("#subtotal"+idDetalleSolicitud).val(null);
        }    
    }

    function descAndTotal(idDetalleSolicitud){
        let porcentDesc = $("#porcDesc"+idDetalleSolicitud).val(),
            porcentaje = 0,
            montoDesc = 0,
            Total = 0;

        if($("#subtotal"+idDetalleSolicitud).val() != null || $("#importe"+idDetalleSolicitud).val() != 0){
                if(porcentDesc != "" || porcentDesc != 0){
                    porcentaje = Number(porcentDesc)/100;
                    montoDesc = Number($("#subtotal"+idDetalleSolicitud).val()) * Number(porcentaje);
                    Total =  Number($("#subtotal"+idDetalleSolicitud).val()) - Number(montoDesc);

                    $("#montoDesc"+idDetalleSolicitud).val(montoDesc.toFixed(2));
                    $("#total"+idDetalleSolicitud).val(Total.toFixed(2));
                }else{
                    if(porcentDesc == 0){
                        $("#montoDesc"+idDetalleSolicitud).val(null);
                        $("#total"+idDetalleSolicitud).val($("#subtotal"+idDetalleSolicitud).val());
                    }
                }
            }else{
                $("#total"+idDetalleSolicitud).val(null);
            }
    }

    function aplicarImpuesto(idDetalleSolicitud){
        //let subtotal = $("#subtotal"+idDetalleSolicitud).val();
        let impuesto = $("#lisImpuesto"+idDetalleSolicitud).val();
        let total =  $("#total"+idDetalleSolicitud).val();
        let result = 0;
        let resulTotal = 0;
        if($("#lisImpuesto"+idDetalleSolicitud).val().trim() != ""){
            result = total * (Number(impuesto)/100);
            resulTotal = Number(total) + Number(result);
            $("#total"+idDetalleSolicitud).val(resulTotal.toFixed(2));
        }else{
            $("#lisImpuesto"+idDetalleSolicitud).on("select2:unselecting", function(e){
                
                $("#total"+idDetalleSolicitud).val(
                    Number(Number($("#subtotal"+idDetalleSolicitud).val())-Number($("#montoDesc"+idDetalleSolicitud).val())).toFixed(2)
                 );
            });
        }
    }

    $("#btnSaveOrden").on("click", function(){

        $("#loading").modal("show");
        let porcRetiene = "", comentRetiene = "";
        let bandera = true;
        let mayor = false;
        let campos, valido;
        campos = document.querySelectorAll("#campos select.valida ,input.valida ");
        valido = true;

        [].slice.call(campos).forEach(function (campo) {

            $("#" + campo.id).removeClass("is-invalid");
            $("#" + campo.id).next().find('.select2-selection').removeClass("is-invalid");

            if (campo.value.trim() === '') {
                valido = false;
                $("#" + campo.id).addClass("is-invalid");
                $("#" + campo.id).next().find('.select2-selection').addClass("is-invalid");
            }

        });

        if(valido){
           //TODO:Calcular datos y pasarlos al array, no tomar de la tabla

           let array = new Array(),
                    i = 0,
                    porcentajedesc = 0,
                    montoDesc = 0,
                    Totaldesc = 0,
                    t = $("#tblAutSolicitudes").DataTable();

				t.rows().eq(0).each(function (index) {
                        let row = t.row(index);
                        let datos = row.data();
                        $("#cantComp"+datos.IdDetallesSolicitud).removeClass("is-invalid");
                        $("#importe"+datos.IdDetallesSolicitud).removeClass("is-invalid");
                        $("#porcDesc"+datos.IdDetallesSolicitud).removeClass("is-invalid");
                        $("#lisImpuesto"+datos.IdDetallesSolicitud).next().find('.select2-selection').removeClass("is-invalid");

                        if(Number($("#cantComp"+datos.IdDetallesSolicitud).val()) >  Number($("#cantAut"+datos.IdDetallesSolicitud).val())){
                            bandera = false;
                            mayor = true;
                            return;
                        }else if($("#cantComp"+datos.IdDetallesSolicitud).val() != "" && $("#importe"+datos.IdDetallesSolicitud).val() != ""
                                    && $("#importe"+datos.IdDetallesSolicitud).val() != "" && $("#porcDesc"+datos.IdDetallesSolicitud).val() != ""
                                    && $("#porcDesc"+datos.IdDetallesSolicitud).val() && $("#lisImpuesto"+datos.IdDetallesSolicitud+" option:selected").text()!=""){
                                if($("#cantComp"+datos.IdDetallesSolicitud).val() > 0){
                                    array[i] = [];
                                    array[i][0] = datos.IdSolicitud;
                                    array[i][1] = datos.DescripcionArticulo;
                                    array[i][2] = $("#descProv"+datos.IdDetallesSolicitud).val();
                                    array[i][3] = $("#proforma"+datos.IdDetallesSolicitud).val();
                                    array[i][4] = $("#umedida"+datos.IdDetallesSolicitud).val();
                                    array[i][5] = $("#cantAut"+datos.IdDetallesSolicitud).val();
                                    array[i][6] = $("#cantComp"+datos.IdDetallesSolicitud).val();
                                    array[i][7] = $("#importe"+datos.IdDetallesSolicitud).val(); //precioAntDesc
                                    array[i][8] = $("#porcDesc"+datos.IdDetallesSolicitud).val();
                                    array[i][9] = (Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val())) * (Number($("#porcDesc"+datos.IdDetallesSolicitud).val())/100); //monto desc
                                    array[i][10] = $("#lisImpuesto"+datos.IdDetallesSolicitud+" option:selected").text(); //texto
                                    array[i][11] = $("#lisImpuesto"+datos.IdDetallesSolicitud+" option:selected").val();
                                    array[i][12] = $("#lisMoneda"+datos.IdDetallesSolicitud+" option:selected").val();
                                    array[i][14] = Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val());

                                    if($("#lisImpuesto"+datos.IdDetallesSolicitud+" option:selected").val().trim() != ""){
                                        porcentajedesc =  Number($("#lisImpuesto"+datos.IdDetallesSolicitud+" option:selected").val())/100 ;
                                        Totaldesc = (Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val())) - (Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val())) * (Number($("#porcDesc"+datos.IdDetallesSolicitud).val())/100); //monto desc
                                        montoDesc = (Number(porcentajedesc) * Number(Totaldesc))
                                        array[i][13] = montoDesc; //IVA
                                        array[i][15] =  Number(Totaldesc) + Number(montoDesc);
                                    }else{
                                        array[i][15] = (Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val())) - (Number($("#cantComp"+datos.IdDetallesSolicitud).val()) * Number($("#importe"+datos.IdDetallesSolicitud).val())) * (Number($("#porcDesc"+datos.IdDetallesSolicitud).val())/100); //monto desc
                                    }
                                    array[i][16] = datos.IdDetallesSolicitud;
                                    i++;
                                }        

                        }else{
                            
                            $("#loading").modal("hide");
                            $("#cantComp"+datos.IdDetallesSolicitud).addClass("is-invalid");
                            $("#importe"+datos.IdDetallesSolicitud).addClass("is-invalid");
                            $("#porcDesc"+datos.IdDetallesSolicitud).addClass("is-invalid");

                            bandera = false;
                            return;

                        }
					});

                    if(mayor){
                        $("#loading").modal("hide");
                        Swal.fire({
                                    text: "La cantidad ordenada sobrepasa la cantidad autorizada",
                                    icon: "warning",
                                    customClass: {
                                    confirmButton: "btn btn-primary"
                                    },
                                    confirmButtonText: "Cerrar",
                                    allowOutsideClick: false
                                });
                    }

                    if(bandera){
                        $("#loading").modal("hide");
                        let form_data = {
                            enc: [$("#idSolicitud").val(),$("#idOrden").val()],
                            detalle: JSON.stringify(array)
                        };
                        let mensaje = "", icon = "";
                        console.log(form_data);

                       $.ajax({
                            url: "<?php echo base_url("index.php/addItemOC")?>",
                            type: "POST",
                            data: form_data,
                            success: function(data){
                                $("#loading").modal("hide");
                                let obj = jQuery.parseJSON(data);
                                $.each(obj, function(i,key){
                                    mensaje = key["mensaje"];
                                    icon = key["tipo"];
                                });

                                Swal.fire({
                                    text: mensaje,
                                    icon: icon,
                                    customClass: {
                                    confirmButton: "btn btn-primary"
                                    },
                                    confirmButtonText: "Cerrar",
                                    allowOutsideClick: false
                                }).then((result)=>{
                                    autorizar();
                                });
                            }
                        });
                    }
        }else {
            $("#loading").modal("hide");

            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Todos los campos son obligatorios",
                confirmButtonText: "cerrar",
                customClass: {
                            confirmButton: "btn btn-primary"
                        }
            });
        }
    });
</script>