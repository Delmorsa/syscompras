<script>
    $(document).ready(function(){
        solic();
    });

    //btnActualizarUser
    $("#btnActualizarPass").on("click", function(){
        $("#loading").modal("show");
        let campos, valido, bandera = false;
	    campos = document.querySelectorAll("#campos1 input.form-control");
	    valido = true;

    [].slice.call(campos).forEach(function (campo) {
            $("#" + campo.id).removeClass("is-invalid");
            if (campo.value.trim() === '') {
                valido = false;
                $("#" + campo.id).addClass("is-invalid");
            }
        });

        if(valido){
            $("#passConfirm").removeClass("is-invalid");
            $("#passActual").removeClass("is-invalid");
            if($("#passConfirm").val() != $("#passActual").val()){
                bandera = false;
                $("#loading").modal("hide");
                $("#passConfirm").addClass("is-invalid");
                $("#passActual").addClass("is-invalid");
                Swal.fire({
                    allowOutsideClick: false,
                    icon: "warning",
                    text: "Las contraseñas no coinciden",
                    confirmButtonText: "cerrar",
                    customClass: {
                                confirmButton: "btn btn-primary"
                            }
                });
            }else{
                bandera = true;
            }

            if(bandera){
                   let mensaje = '', icon = '';
                   let form_data = {
                      pass: $("#passActual").val(),
                      newPass: $("#passNew").val()
                   };
                  $.ajax({
                      url: "actualizarPass",
                      type: "POST",
                      data: form_data,
                      success: function (data) {
                        $("#loading").modal("hide");
                          let obj = $.parseJSON(data);
                          $.each(obj, function (i, key) {
                              mensaje = key["mensaje"];
                              icon = key["tipo"];
                            });
                          Swal.fire({
                              text: mensaje,
                              icon: icon,
                              allowOutsideClick: false,
                              confirmButtonText: "cerrar",
                              customClass: {
                                confirmButton: "btn btn-primary"
                            }
                          }).then((result) => {
                              location.reload();
                          });      
                        }
                  });  
            }

        } else {
            $("#loading").modal("hide");
            Swal.fire({
                allowOutsideClick: false,
                icon: "warning",
                text: "Todos los campos contraseña son obligatorios",
                confirmButtonText: "cerrar",
                customClass: {
                            confirmButton: "btn btn-primary"
                        }
            });
        }
    });

    function solic(){
        let total =  0, nuevas = 0, atendidas = 0;
        $.ajax({
            url: "datosSolic",
            type: "POST",
            success: function (data) {
                let obj = $.parseJSON(data);
                $.each(obj, function(i, key){
                    total = key["totalSolic"];
                    nuevas = key["nuevasSolic"]
                    atendidas = key["solicAtendidas"]
                });
                $("#total").html(`<div class="fs-1 fw-bolder" data-kt-countup="true"  data-kt-countup-value="${total}" data-kt-countup-prefix="">${total}</div>`);
                $("#nuevas").html(`<div class="fs-1 fw-bolder" data-kt-countup="true" data-kt-countup-value="${nuevas}">${nuevas}</div>`);
                $("#atendidas").html(`<div class="fs-1 fw-bolder" data-kt-countup="true" data-kt-countup-value="${atendidas}">${atendidas}</div>`);
              }
        });
        /*total
        nuevas
        atendidas*/
    }
</script>