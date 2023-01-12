<script src="<?php echo base_url()?>assets/js/chartjs.js"></script>
<script>
    $(document).ready(function () { 
        showChart();
        chartPie();
     });


     function showChart(){
        let datos = new Array();
        $.ajax({
            url: 'estadoSolcitudes',
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
                  });
              }
        });
        const ctx = document.getElementById('myChart').getContext('2d');
        const mixedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: datos.K[0],
                    data: [datos.K[1], datos.K[2], datos.K[3], datos.K[4]],
                    // this dataset is drawn below
                    order: 1,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgb(255, 99, 132)'
                }, {
                    label: datos.M[0],
                    data: [datos.M[1], datos.M[2], datos.M[3], datos.M[4]],
                    type: 'bar',
                    // this dataset is drawn on top
                    order: 2,
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgb(255, 205, 86)'
                }],
                labels: ['Proceso', 'Cerrada', 'Rechazada', 'Anuladas']
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

     function chartPie(){
        let datos = new Array();
        let datosNum = new Array();
        $.ajax({
            url: 'contadorSolic',
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

</script>